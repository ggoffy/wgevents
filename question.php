<?php declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgEvents module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgevents
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use Xmf\Request;
use XoopsModules\Wgevents;
use XoopsModules\Wgevents\{
    Constants,
    Common
};

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgevents_question.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op      = Request::getCmd('op', 'list');
$queId   = Request::getInt('id');
$queEvid = Request::getInt('evid');
$start   = Request::getInt('start');
$limit   = Request::getInt('limit', $helper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgevents_url', \WGEVENTS_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_INDEX, 'link' => 'index.php'];

$GLOBALS['xoopsTpl']->assign('addEvid', $queEvid);

switch ($op) {
    case 'show':
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
        $GLOBALS['xoTheme']->addScript(\WGEVENTS_URL . '/assets/js/jquery-ui.min.js');
        $GLOBALS['xoTheme']->addScript(\WGEVENTS_URL . '/assets/js/sortables.js');

        // check whether there are textblocks available
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $crTextblock = new \CriteriaCompo();
        $crTextblock->add(new \Criteria('class', Constants::TEXTBLOCK_CLASS_PUBLIC));
        $crTextblock->add(new \Criteria('submitter', $uidCurrent), 'OR');
        $textblocksCount = $textblockHandler->getCount($crTextblock);
        $GLOBALS['xoopsTpl']->assign('textblocksCount', $textblocksCount);

        // get default fields
        $regdefaults = [];
        $regdefaults[] = [
            'type_text' => \_MA_WGEVENTS_FIELD_TEXTBOX,
            'caption' => \_MA_WGEVENTS_REGISTRATION_FIRSTNAME,
            'value_list' => '',
            'placeholder' => \_MA_WGEVENTS_REGISTRATION_FIRSTNAME_PLACEHOLDER,
            'required' => \_YES,
            'print' => \_YES
        ];
        $regdefaults[] = [
            'type_text' => \_MA_WGEVENTS_FIELD_TEXTBOX,
            'caption' => \_MA_WGEVENTS_REGISTRATION_LASTNAME,
            'value_list' => '',
            'placeholder' => \_MA_WGEVENTS_REGISTRATION_LASTNAME_PLACEHOLDER,
            'required' => \_YES,
            'print' => \_YES
        ];
        $regdefaults[] = [
            'type_text' => \_MA_WGEVENTS_FIELD_TEXTBOX,
            'caption' => \_MA_WGEVENTS_REGISTRATION_EMAIL,
            'value_list' => '',
            'placeholder' => \_MA_WGEVENTS_REGISTRATION_EMAIL_PLACEHOLDER,
            'required' => \_YES,
            'print' => \_YES
        ];
        $GLOBALS['xoopsTpl']->assign('regdefaults', $regdefaults);

        //get event details
        $eventObj = $eventHandler->get($queEvid);
        $evName = $eventObj->getVar('name');
        $evSubmitter = $eventObj->getVar('submitter');
        $evStatus = $eventObj->getVar('status');
        $keywords[] = $evName;

        // Breadcrumbs
        if ('' !== $evName) {
            $xoBreadcrumbs[] = ['title' => $evName];
        }
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_QUESTIONS_LIST];

        // get question fields
        $crQuestion = new \CriteriaCompo();
        $crQuestion->add(new \Criteria('evid', $queEvid));
        $questionsCount = $questionHandler->getCount($crQuestion);
        $GLOBALS['xoopsTpl']->assign('questionsCount', $questionsCount);
        $crQuestion->setSort('weight ASC, id');
        $crQuestion->setOrder('DESC');
        $crQuestion->setStart($start);
        $crQuestion->setLimit($limit);
        if ($questionsCount > 0) {
            $questionsAll = $questionHandler->getAll($crQuestion);
            $questions = [];
            $evName = '';
            $evSubmitter = 0;
            $evStatus = 0;
            // Get All Question
            foreach (\array_keys($questionsAll) as $i) {
                $questions[$i] = $questionsAll[$i]->getValuesQuestions();
            }
            $GLOBALS['xoopsTpl']->assign('questions', $questions);
            unset($questions);
            // Display Navigation
            if ($questionsCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($questionsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            $GLOBALS['xoopsTpl']->assign('eventName', $evName);
            $permEdit = $permissionsHandler->getPermQuestionsAdmin($evSubmitter, $evStatus);
            $GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
            $GLOBALS['xoopsTpl']->assign('wgevents_icons_url_16', \WGEVENTS_ICONS_URL_16);

            $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($evName . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));

        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('question.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        if ($queId > 0) {
            $questionObj = $questionHandler->get($queId);
        } else {
            $questionObj = $questionHandler->create();
        }
        $questionObj->setVar('evid', $queEvid);
        $queType = Request::getInt('type');
        $questionObj->setVar('fdid', $queType);
        $fieldObj = $fieldHandler->get($queType);
        $fieldType = $fieldObj->getVar('type');
        $questionObj->setVar('type', $fieldType);
        $questionObj->setVar('caption', Request::getString('caption'));
        $questionObj->setVar('desc', Request::getText('desc'));
        $queValuesText = '';
        $queValues = Request::getString('values');
        if ('' !== $queValues) {
            if (Constants::FIELD_COMBOBOX == $fieldType ||
                Constants::FIELD_SELECTBOX == $fieldType ||
                Constants::FIELD_RADIO == $fieldType ||
                Constants::FIELD_CHECKBOX == $fieldType) {
                $queValuesText = \serialize(\preg_split('/\r\n|\r|\n/', $queValues));
            } else {
                $tmpArr = [$queValues];
                $queValuesText = \serialize($tmpArr);
            }
        }
        $questionObj->setVar('values', $queValuesText);
        $questionObj->setVar('placeholder', Request::getString('placeholder'));
        $questionObj->setVar('required', Request::getInt('required'));
        $questionObj->setVar('print', Request::getInt('print'));
        $questionObj->setVar('weight', Request::getInt('weight'));
        if (Request::hasVar('datecreated_int')) {
            $questionObj->setVar('datecreated', Request::getInt('datecreated_int'));
        } else {
            $questionDatecreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('datecreated'));
            $questionObj->setVar('datecreated', $questionDatecreatedObj->getTimestamp());
        }
        $questionObj->setVar('submitter', Request::getInt('submitter'));
        // Insert Data
        if ($questionHandler->insert($questionObj)) {
            // redirect after insert
            \redirect_header('question.php?op=list&amp;evid=' . $queEvid . '&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_WGEVENTS_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $questionObj->getHtmlErrors());
        $form = $questionObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save_textblock':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('question.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        $weight = $questionHandler->getNextWeight($queEvid);
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;

        $cbTextblocks = Request::getArray('cbTextblock');
        $errors = '';
        foreach (\array_keys($cbTextblocks) as $i) {
            $textblockObj = $textblockHandler->get($i);

            $questionObj = $questionHandler->create();
            $questionObj->setVar('evid', $queEvid);
            $questionObj->setVar('fdid', Constants::FIELD_LABEL);
            $fieldObj = $fieldHandler->get(Constants::FIELD_LABEL);
            $questionObj->setVar('type', $fieldObj->getVar('type'));
            $questionObj->setVar('caption', $textblockObj->getVar('name'));
            $questionObj->setVar('desc', $textblockObj->getVar('text'));
            $questionObj->setVar('values', '');
            $questionObj->setVar('placeholder', '');
            $questionObj->setVar('required', 0);
            $questionObj->setVar('print', 0);
            $questionObj->setVar('weight', $weight);
            $questionObj->setVar('datecreated', \time());
            $questionObj->setVar('submitter', $uidCurrent);
            // Insert Data
            if (!$questionHandler->insert($questionObj)) {
                $errors .= $questionHandler.getHtmlErrors();
            }
            $weight++;
        }
        if ('' === $errors) {
            // redirect after insert
            \redirect_header('question.php?op=list&amp;evid=' . $queEvid . '&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_WGEVENTS_FORM_OK);
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $errors);
        }
        break;
    case 'newset':
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        $questionHandler->createQuestionsDefaultset($queEvid);
        \redirect_header('question.php?op=list&amp;evid=' . $queEvid . '&amp;start=' . $start . '&amp;limit=' . $limit, 0, \_MA_WGEVENTS_FORM_OK);
        break;
    case 'add_textblock':
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_TEXTBLOCK_ADD];

        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $crTextblock = new \CriteriaCompo();
        $crTextblock->add(new \Criteria('class', Constants::TEXTBLOCK_CLASS_PUBLIC));
        $crTextblock->add(new \Criteria('submitter', $uidCurrent), 'OR');
        $textblocksCount = $textblockHandler->getCount($crTextblock);
        $GLOBALS['xoopsTpl']->assign('textblocksCount', $textblocksCount);
        if ($textblocksCount > 0) {
            $crTextblock->setStart($start);
            $crTextblock->setLimit($limit);
            $textblocksAll = $textblockHandler->getAll($crTextblock);
            $formTextblockSelect = $textblockHandler->getFormSelect($textblocksAll);

            $GLOBALS['xoopsTpl']->assign('formTextblockSelect', $formTextblockSelect->render());
            unset($textblocks);
            // Display Navigation
            if ($textblocksCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($textblocksCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        }
        break;
    case 'new':
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        $GLOBALS['xoTheme']->addScript(\WGEVENTS_URL . '/assets/js/forms.js');
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_QUESTION_ADD];
        // Form Create
        $questionObj = $questionHandler->create();
        $questionObj->setVar('evid', $queEvid);
        $form = $questionObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'test':
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => $eventObj->getVar('name')];
        // Form Create
        $registrationObj = $registrationHandler->create();
        $registrationObj->setVar('evid', $queEvid);
        $form = $registrationObj->getForm('', true);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $eventObj = $eventHandler->get($queEvid);
        // Check permissions
        if (!$permissionsHandler->getPermQuestionsAdmin($eventObj->getVar('submitter'), $eventObj->getVar('status'))) {
            \redirect_header('index.php?op=list', 3, \_NOPERM);
        }
        $GLOBALS['xoTheme']->addScript(\WGEVENTS_URL . '/assets/js/forms.js');
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_QUESTION_EDIT];
        // Check params
        if (0 === $queId) {
            \redirect_header('question.php?op=list', 3, \_MA_WGEVENTS_INVALID_PARAM);
        }
        // Get Form
        $questionObj = $questionHandler->get($queId);
        $questionObj->start = $start;
        $questionObj->limit = $limit;
        $form = $questionObj->getForm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_QUESTION_CLONE];
        // Request source
        $queIdSource = Request::getInt('id_source');
        // Check params
        if (0 === $queIdSource) {
            \redirect_header('question.php?op=list', 3, \_MA_WGEVENTS_INVALID_PARAM);
        }
        // Get Form
        $questionObjSource = $questionHandler->get($queIdSource);
        $questionObj = $questionHandler->create();
        $questionObj->setVar('evid', $questionObjSource->getVar('evid'));
        $questionObj->setVar('fdid', $questionObjSource->getVar('fdid'));
        $questionObj->setVar('type', $questionObjSource->getVar('type'));
        $questionObj->setVar('caption', $questionObjSource->getVar('caption'));
        $questionObj->setVar('desc', $questionObjSource->getVar('desc'));
        $questionObj->setVar('values', $questionObjSource->getVar('values'));
        $questionObj->setVar('placeholder', $questionObjSource->getVar('placeholder'));
        $questionObj->setVar('required', $questionObjSource->getVar('required'));
        $questionObj->setVar('print', $questionObjSource->getVar('print'));
        $questionObj->setVar('weight', $questionObjSource->getVar('weight'));
        $form = $questionObj->getForm('question.php?op=save');
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        unset($questionObjSource);
        break;
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_WGEVENTS_QUESTION_DELETE];
        // Check params
        if (0 === $queId) {
            \redirect_header('question.php?op=list', 3, \_MA_WGEVENTS_INVALID_PARAM);
        }
        $questionObj = $questionHandler->get($queId);
        $queEvid = $questionObj->getVar('evid');
        if (isset($_REQUEST['ok']) && 1 === (int)$_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('question.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($questionHandler->delete($questionObj)) {
                \redirect_header('question.php?list&amp;evid=' . $queEvid, 3, \_MA_WGEVENTS_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $questionObj->getHtmlErrors());
            }
        } else {
            $customConfirm = new Common\Confirm(
                ['ok' => 1, 'id' => $queId, 'evid' => $queEvid, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_WGEVENTS_CONFIRMDELETE_QUESTION, $questionObj->getVar('caption')), \_MA_WGEVENTS_CONFIRMDELETE_TITLE, \_MA_WGEVENTS_CONFIRMDELETE_LABEL);
            $form = $customConfirm->getFormConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'order':
        $order = $_POST['order'];
        for ($i = 0, $iMax = \count($order); $i < $iMax; $i++) {
            $questionObj = $questionHandler->get($order[$i]);
            $questionObj->setVar('weight', $i + 1);
            $questionHandler->insert($questionObj);
        }
        break;
}

// Keywords
wgeventsMetaKeywords($helper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
wgeventsMetaDescription(\_MA_WGEVENTS_QUESTIONS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \WGEVENTS_URL.'/question.php');
$GLOBALS['xoopsTpl']->assign('wgevents_upload_url', \WGEVENTS_UPLOAD_URL);

require __DIR__ . '/footer.php';
