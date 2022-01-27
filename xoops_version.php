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
 * @since        1.0.0
 * @min_xoops    2.5.11 Beta1
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use XoopsModules\Wgevents\Helper;

require_once \dirname(__DIR__) . '/wgevents/preloads/autoloader.php';

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);
// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_WGEVENTS_NAME,
    'version'             => '1.0.0',
    'description'         => \_MI_WGEVENTS_DESC,
    'author'              => 'Goffy - Wedega',
    'author_mail'         => 'webmaster@wedega.com',
    'author_website_url'  => 'https://xoops.wedega.com',
    'author_website_name' => 'XOOPS Project on Wedega',
    'credits'             => 'Goffy, XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/wgevents/docs/release_info file',
    'release_date'        => '2022/01/04',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/wgevents/docs/install.txt',
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.11 Beta1',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5', 'mysqli' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    'release'             => '25.12.2021',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin templates
    ['file' => 'wgevents_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_events.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_categories.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_registrations.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_additionals.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_answers.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_textblocks.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_addtypes.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_logs.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_accounts.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_maintenance.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgevents_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'wgevents_header.tpl', 'description' => ''],
    ['file' => 'wgevents_additionals.tpl', 'description' => ''],
    ['file' => 'wgevents_additionals_item.tpl', 'description' => ''],
    ['file' => 'wgevents_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'wgevents_calendar.tpl', 'description' => ''],
    ['file' => 'wgevents_events.tpl', 'description' => ''],
    ['file' => 'wgevents_events_index_list.tpl', 'description' => ''],
    ['file' => 'wgevents_events_item_details.tpl', 'description' => ''],
    ['file' => 'wgevents_events_item_list.tpl', 'description' => ''],
    ['file' => 'wgevents_index.tpl', 'description' => ''],
    ['file' => 'wgevents_registrations.tpl', 'description' => ''],
    ['file' => 'wgevents_registrations_item.tpl', 'description' => ''],
    ['file' => 'wgevents_textblocks.tpl', 'description' => ''],
    ['file' => 'wgevents_textblocks_list.tpl', 'description' => ''],
    ['file' => 'wgevents_textblocks_item.tpl', 'description' => ''],
    ['file' => 'wgevents_search.tpl', 'description' => ''],
    ['file' => 'wgevents_footer.tpl', 'description' => ''],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'wgevents_events',
    'wgevents_categories',
    'wgevents_registrations',
    'wgevents_registrations_hist',
    'wgevents_additionals',
    'wgevents_answers',
    'wgevents_answers_hist',
    'wgevents_textblocks',
    'wgevents_addtypes',
    'wgevents_logs',
    'wgevents_accounts',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/search.inc.php',
    'func' => 'wgevents_search',
];

$helper = Helper::getInstance();
$permissionsHandler = $helper->getHandler('Permissions');
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME1,
        'url'  => 'index.php',
    ];
    // Sub events
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME2,
        'url'  => 'events.php',
    ];
    if ($permissionsHandler->getPermEventsSubmit()) {
        // Sub Submit
        $modversion['sub'][] = [
            'name' => \_MI_WGEVENTS_SMNAME10,
            'url' => 'events.php?op=list&amp;filter=me',
        ];
    }
    if ($permissionsHandler->getPermEventsSubmit()) {
        // Sub Submit
        $modversion['sub'][] = [
            'name' => \_MI_WGEVENTS_SMNAME3,
            'url' => 'events.php?op=new',
        ];
    }
    if ($permissionsHandler->getPermRegistrationsSubmit()) {
        $modversion['sub'][] = [
            'name' => \_MI_WGEVENTS_SMNAME5,
            'url'  => 'registrations.php?op=listmy',
        ];
    }
    if ($helper->getConfig('cal_page')) {
        // calendar
        $modversion['sub'][] = [
            'name' => \_MI_WGEVENTS_SMNAME6,
            'url' => 'calendar.php',
        ];
    }
    /*

    // Sub Submit

    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME6,
        'url'  => 'additionals.php?op=new',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME7,
        'url'  => 'answers.php?op=new',
    ];
    // Sub textblocks
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME8,
        'url'  => 'textblocks.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGEVENTS_SMNAME9,
        'url'  => 'textblocks.php?op=new',
    ];
    */
}
// ------------------- Default Blocks ------------------- //
// Events last
$modversion['blocks'][] = [
    'file'        => 'events.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_LAST,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgevents_events_show',
    'edit_func'   => 'b_wgevents_events_edit',
    'template'    => 'wgevents_block_events.tpl',
    'options'     => 'last|5|25|0',
];
// Events new
$modversion['blocks'][] = [
    'file'        => 'events.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_NEW,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgevents_events_show',
    'edit_func'   => 'b_wgevents_events_edit',
    'template'    => 'wgevents_block_events.tpl',
    'options'     => 'new|5|25|0',
];
/*

// Events top
$modversion['blocks'][] = [
    'file'        => 'events.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_TOP,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgevents_events_show',
    'edit_func'   => 'b_wgevents_events_edit',
    'template'    => 'wgevents_block_events.tpl',
    'options'     => 'top|5|25|0',
];
*/
// Events random
$modversion['blocks'][] = [
    'file'        => 'events.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_RANDOM,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgevents_events_show',
    'edit_func'   => 'b_wgevents_events_edit',
    'template'    => 'wgevents_block_events.tpl',
    'options'     => 'random|5|25|0',
];
// ------------------- Spotlight Blocks ------------------- //
// Events spotlight
$modversion['blocks'][] = [
    'file'        => 'events_spotlight.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgevents_events_spotlight_show',
    'edit_func'   => 'b_wgevents_events_spotlight_edit',
    'template'    => 'wgevents_block_events_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
// Event calendar min
$modversion['blocks'][] = [
    'file'        => 'calendar.php',
    'name'        => \_MI_WGEVENTS_EVENTS_BLOCK_CAL,
    'description' => \_MI_WGEVENTS_EVENTS_BLOCK_CAL_DESC,
    'show_func'   => 'b_wgevents_calendar_show',
    'edit_func'   => 'b_wgevents_calendar_edit',
    'template'    => 'wgevents_block_calendar.tpl',
    'options'     => 'simplecalendar|5',
];
// ------------------- Config ------------------- //
// ------------------- Group header: Display ------------------- //
// group header
$modversion['config'][] = [
    'name'        => 'group_display',
    'title'       => '\_MI_WGEVENTS_GROUP_DISPLAY',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Editor Admin
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_admin',
    'title'       => '\_MI_WGEVENTS_EDITOR_ADMIN',
    'description' => '\_MI_WGEVENTS_EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => \array_flip($editorHandler->getList()),
];
// Editor User
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_user',
    'title'       => '\_MI_WGEVENTS_EDITOR_USER',
    'description' => '\_MI_WGEVENTS_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => \array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'admin_maxchar',
    'title'       => '\_MI_WGEVENTS_ADMIN_MAXCHAR',
    'description' => '\_MI_WGEVENTS_ADMIN_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 50,
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'user_maxchar',
    'title'       => '\_MI_WGEVENTS_USER_MAXCHAR',
    'description' => '\_MI_WGEVENTS_USER_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 200,
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_WGEVENTS_ADMIN_PAGER',
    'description' => '\_MI_WGEVENTS_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 20,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_WGEVENTS_USER_PAGER',
    'description' => '\_MI_WGEVENTS_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Show copyright
$modversion['config'][] = [
    'name'        => 'show_copyright',
    'title'       => '\_MI_WGEVENTS_SHOWCOPYRIGHT',
    'description' => '\_MI_WGEVENTS_SHOWCOPYRIGHT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Show Breadcrumbs
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_WGEVENTS_SHOW_BREADCRUMBS',
    'description' => '\_MI_WGEVENTS_SHOW_BREADCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Table type
$modversion['config'][] = [
    'name'        => 'table_type',
    'title'       => '\_MI_WGEVENTS_TABLE_TYPE',
    'description' => '\_MI_WGEVENTS_TABLE_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 'bordered',
    'options'     => ['bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed'],
];
// Panel by
$modversion['config'][] = [
    'name'        => 'panel_type',
    'title'       => '\_MI_WGEVENTS_PANEL_TYPE',
    'description' => '\_MI_WGEVENTS_PANEL_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];
// ------------------- Group header: Calendar ------------------- //
$modversion['config'][] = [
    'name'        => 'group_cal',
    'title'       => '\_MI_WGEVENTS_GROUP_CAL',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Show calendar page
$modversion['config'][] = [
    'name'        => 'cal_page',
    'title'       => '\_MI_WGEVENTS_CAL_PAGE',
    'description' => '\_MI_WGEVENTS_CAL_PAGE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// First day of week in calendar
$modversion['config'][] = [
    'name'        => 'cal_firstday',
    'title'       => '\_MI_WGEVENTS_CAL_FIRSTDAY',
    'description' => '\_MI_WGEVENTS_CAL_FIRSTDAY_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [\_MI_WGEVENTS_CAL_SUNDAY => 0,
                        \_MI_WGEVENTS_CAL_MONDAY => 1,
                        \_MI_WGEVENTS_CAL_TUESDAY => 2,
                        \_MI_WGEVENTS_CAL_WEDNESDAY => 3,
                        \_MI_WGEVENTS_CAL_THURSDAY => 4,
                        \_MI_WGEVENTS_CAL_FRIDAY => 5,
                        \_MI_WGEVENTS_CAL_SATURDAY => 6
                     ],
];
// Show calendar on index page
$modversion['config'][] = [
    'name'        => 'cal_index',
    'title'       => '\_MI_WGEVENTS_CAL_INDEX',
    'description' => '\_MI_WGEVENTS_CAL_INDEX_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// ------------------- Group header: Upload ------------------- //
$modversion['config'][] = [
    'name'        => 'group_upload',
    'title'       => '\_MI_WGEVENTS_GROUP_UPLOAD',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = wgeventsReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = wgeventsReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . \_MI_WGEVENTS_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
// Uploads : maxsize of image
$modversion['config'][] = [
    'name'        => 'maxsize_image',
    'title'       => '\_MI_WGEVENTS_MAXSIZE_IMAGE',
    'description' => '\_MI_WGEVENTS_MAXSIZE_IMAGE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes_image',
    'title'       => '\_MI_WGEVENTS_MIMETYPES_IMAGE',
    'description' => '\_MI_WGEVENTS_MIMETYPES_IMAGE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
    'name'        => 'maxwidth_image',
    'title'       => '\_MI_WGEVENTS_MAXWIDTH_IMAGE',
    'description' => '\_MI_WGEVENTS_MAXWIDTH_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
$modversion['config'][] = [
    'name'        => 'maxheight_image',
    'title'       => '\_MI_WGEVENTS_MAXHEIGHT_IMAGE',
    'description' => '\_MI_WGEVENTS_MAXHEIGHT_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];
// ------------------- Group header: Formats ------------------- //
$modversion['config'][] = [
    'name'        => 'group_formats',
    'title'       => '\_MI_WGEVENTS_GROUP_FORMATS',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Comma separator
$modversion['config'][] = [
    'name'        => 'sep_comma',
    'title'       => '\_MI_WGEVENTS_SEP_COMMA',
    'description' => '\_MI_WGEVENTS_SEP_COMMA_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '.',
];
// Thousands separator
$modversion['config'][] = [
    'name'        => 'sep_thousand',
    'title'       => '\_MI_WGEVENTS_SEP_THSD',
    'description' => '\_MI_WGEVENTS_SEP_THSD_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => ',',
];
// ------------------- Group header: Features ------------------- //
$modversion['config'][] = [
    'name'        => 'group_features',
    'title'       => '\_MI_WGEVENTS_GROUP_FEATURES',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// use registration system
$modversion['config'][] = [
    'name'        => 'use_register',
    'title'       => '\_MI_WGEVENTS_USE_REGISTER',
    'description' => '\_MI_WGEVENTS_USE_REGISTER_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// use registration history
$modversion['config'][] = [
    'name'        => 'use_register_hist',
    'title'       => '\_MI_WGEVENTS_USE_REGISTER_HIST',
    'description' => '\_MI_WGEVENTS_USE_REGISTER_HIST_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// use logs
$modversion['config'][] = [
    'name'        => 'use_logst',
    'title'       => '\_MI_WGEVENTS_USE_LOGS',
    'description' => '\_MI_WGEVENTS_USE_LOGS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// use google maps
$modversion['config'][] = [
    'name'        => 'use_gm',
    'title'       => '\_MI_WGEVENTS_USE_GM',
    'description' => '\_MI_WGEVENTS_USE_GM_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// use wgEvents module
$modversion['config'][] = [
    'name'        => 'use_wggallery',
    'title'       => '\_MI_WGEVENTS_USE_WGGALLERY',
    'description' => '\_MI_WGEVENTS_USE_WGGALLERY_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// ------------------- Group header: Index page ------------------- //
$modversion['config'][] = [
    'name'        => 'group_index',
    'title'       => '\_MI_WGEVENTS_GROUP_INDEX',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Show module description
$modversion['config'][] = [
    'name'        => 'index_header',
    'title'       => '\_MI_WGEVENTS_INDEXHEADER',
    'description' => '\_MI_WGEVENTS_INDEXHEADER_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => \_MI_WGEVENTS_DESC,
];
// ------------------- Group header: Misc ------------------- //
$modversion['config'][] = [
    'name'        => 'group_misc',
    'title'       => '\_MI_WGEVENTS_GROUP_MISC',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '\_MI_WGEVENTS_KEYWORDS',
    'description' => '\_MI_WGEVENTS_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'wgevents, events, categories, registrations, additionals, answers, textblocks, addtypes',
];
// Paypal ID
$modversion['config'][] = [
    'name'        => 'donations',
    'title'       => '\_MI_WGEVENTS_IDPAYPAL',
    'description' => '\_MI_WGEVENTS_IDPAYPAL_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'textbox',
    'default'     => 'XYZ123',
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_WGEVENTS_MAINTAINEDBY',
    'description' => '\_MI_WGEVENTS_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.org/modules/newbb',
];
// Advertise
$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => '\_MI_WGEVENTS_ADVERTISE',
    'description' => '\_MI_WGEVENTS_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];
// Bookmarks
$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => '\_MI_WGEVENTS_BOOKMARKS',
    'description' => '\_MI_WGEVENTS_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// ------------------- Notifications ------------------- //
$modversion['hasNotification'] = 0;
/*
$modversion['hasNotification'] = 1;
$modversion['notification'] = [
    'lookup_file' => 'include/notification.inc.php',
    'lookup_func' => 'wgevents_notify_iteminfo',
];
// Categories of notification
// Global Notify
$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => \_MI_WGEVENTS_NOTIFY_GLOBAL,
    'description'    => '',
    'subscribe_from' => ['index.php', 'events.php', 'registrations.php'],
];
// Event Notify
$modversion['notification']['category'][] = [
    'name'           => 'events',
    'title'          => \_MI_WGEVENTS_NOTIFY_EVENT,
    'description'    => '',
    'subscribe_from' => 'events.php',
    'item_name'      => 'ev_id',
    'allow_bookmark' => 1,
];
// Registration Notify
$modversion['notification']['category'][] = [
    'name'           => 'registrations',
    'title'          => \_MI_WGEVENTS_NOTIFY_REGISTRATION,
    'description'    => '',
    'subscribe_from' => 'registrations.php',
    'item_name'      => 'reg_id',
    'allow_bookmark' => 1,
];
// Global events notification
// GLOBAL_NEW Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_new',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_GLOBAL_NEW,
    'caption'       => \_MI_WGEVENTS_NOTIFY_GLOBAL_NEW_CAPTION,
    'description'   => '',
    'mail_template' => 'global_new_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_GLOBAL_NEW_SUBJECT,
];
// GLOBAL_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_modify',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_GLOBAL_MODIFY,
    'caption'       => \_MI_WGEVENTS_NOTIFY_GLOBAL_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_modify_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_GLOBAL_MODIFY_SUBJECT,
];
// GLOBAL_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_delete',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_GLOBAL_DELETE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_GLOBAL_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_delete_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_GLOBAL_DELETE_SUBJECT,
];
// GLOBAL_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_approve',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => \_MI_WGEVENTS_NOTIFY_GLOBAL_APPROVE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_GLOBAL_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_approve_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_GLOBAL_APPROVE_SUBJECT,
];
// Event notifications for items
// EVENT_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'event_modify',
    'category'      => 'events',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_EVENT_MODIFY,
    'caption'       => \_MI_WGEVENTS_NOTIFY_EVENT_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'event_modify_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_EVENT_MODIFY_SUBJECT,
];
// EVENT_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'event_delete',
    'category'      => 'events',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_EVENT_DELETE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_EVENT_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'event_delete_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_EVENT_DELETE_SUBJECT,
];
// EVENT_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'event_approve',
    'category'      => 'events',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_EVENT_APPROVE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_EVENT_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'event_approve_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_EVENT_APPROVE_SUBJECT,
];
// REGISTRATION_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'registration_modify',
    'category'      => 'registrations',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_REGISTRATION_MODIFY,
    'caption'       => \_MI_WGEVENTS_NOTIFY_REGISTRATION_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'registration_modify_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_REGISTRATION_MODIFY_SUBJECT,
];
// REGISTRATION_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'registration_delete',
    'category'      => 'registrations',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_REGISTRATION_DELETE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_REGISTRATION_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'registration_delete_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_REGISTRATION_DELETE_SUBJECT,
];
// REGISTRATION_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'registration_approve',
    'category'      => 'registrations',
    'admin_only'    => 0,
    'title'         => \_MI_WGEVENTS_NOTIFY_REGISTRATION_APPROVE,
    'caption'       => \_MI_WGEVENTS_NOTIFY_REGISTRATION_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'registration_approve_notify',
    'mail_subject'  => \_MI_WGEVENTS_NOTIFY_REGISTRATION_APPROVE_SUBJECT,
];
*/