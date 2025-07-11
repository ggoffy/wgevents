<?php declare(strict_types=1);

namespace XoopsModules\Wgevents;

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

use XoopsModules\Wgevents;


/**
 * Class Object Handler Log
 */
class LogHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgevents_log', Log::class, 'id', 'text');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param $fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null)
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Log in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLogs($start = 0, $limit = 0, $sort = 'id', $order = 'DESC')
    {
        $crCountLogs = new \CriteriaCompo();
        $crCountLogs = $this->getLogsCriteria($crCountLogs, $start, $limit, $sort, $order);
        return $this->getCount($crCountLogs);
    }

    /**
     * Get All Log in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLogs($start = 0, $limit = 0, $sort = 'id', $order = 'DESC')
    {
        $crAllLogs = new \CriteriaCompo();
        $crAllLogs = $this->getLogsCriteria($crAllLogs, $start, $limit, $sort, $order);
        return $this->getAll($crAllLogs);
    }

    /**
     * Get Criteria Log
     * @param        $crLog
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLogsCriteria($crLog, int $start, int $limit, string $sort, string $order)
    {
        $crLog->setStart($start);
        $crLog->setLimit($limit);
        $crLog->setSort($sort);
        $crLog->setOrder($order);
        return $crLog;
    }

    /**
     * Create new Log
     * @param string $text
     * @return void
     */
    public function createLog(string $text)
    {
        $helper = \XoopsModules\Wgevents\Helper::getInstance();

        if ($helper->getConfig('use_logs') > 0) {
            $logSubmitter = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
            $logObj = $this->create();
            // Set Vars
            $logObj->setVar('text', $text);
            $logObj->setVar('datecreated', \time());
            $logObj->setVar('submitter', $logSubmitter);
            // Insert Data
            $this->insert($logObj);
        }
    }
}
