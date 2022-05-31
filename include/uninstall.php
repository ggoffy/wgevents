<?php

/**
 * uninstall.php - cleanup on module uninstall
 *
 * @author          XOOPS Module Development Team
 * @copyright       {@link https://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            https://xoops.org XOOPS
 */

use XoopsModules\Wgevents;

/**
 * Prepares system prior to attempting to uninstall module
 * @param \XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to uninstall, false if not
 */
function xoops_module_pre_uninstall_wgevents(\XoopsModule $module)
{
    // Do some synchronization
    return true;
}

/**
 * Performs tasks required during uninstallation of the module
 * @param \XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if uninstallation successful, false if not
 */
function xoops_module_uninstall_wgevents(\XoopsModule $module)
{
    $moduleDirName      = \basename(\dirname(__DIR__));
    $moduleDirNameUpper = \mb_strtoupper($moduleDirName);

    $helper = Wgevents\Helper::getInstance();
    $utility = new Wgevents\Utility();

    $success = true;
    $helper->loadLanguage('admin');

    //------------------------------------------------------------------
    // Remove uploads folder (and all subfolders) if they exist
    //------------------------------------------------------------------
    $uploads_dir = $GLOBALS['xoops']->path("uploads/{$moduleDirName}");
    $dirInfo = new \SplFileInfo($uploads_dir);
    if ($dirInfo->isDir()) {
        // The directory exists so delete it
        if (!$utility::rrmdir($uploads_dir)) {
            $module->setErrors(\sprintf(\constant('CO_' . $moduleDirNameUpper . '_ERROR_BAD_DEL_PATH'), $uploads_dir));
            $success = false;
        }
    }
    unset($dirInfo);

    //------------------------------------------------------------------
    // Rename uploads folder to BAK and add date to name
    // NOT USED CURRENTLY
    //------------------------------------------------------------------
    /*
    $uploadDirectory = $GLOBALS['xoops']->path("uploads/$moduleDirName");
    $dirInfo = new \SplFileInfo($uploadDirectory);
    if ($dirInfo->isDir()) {
        // The directory exists so rename it
        $date = date('Y-m-d');
        if (!\rename($uploadDirectory, $uploadDirectory . "_bak_$date")) {
            $module->setErrors(\sprintf(\constant('CO_' . $moduleDirNameUpper . '_ERROR_BAD_DEL_PATH'), $uploadDirectory));
            $success = false;
        }
    }
    unset($dirInfo);
    */
    /*
    //------------ START ----------------
    //------------------------------------------------------------------
    // Remove xsitemap.xml from XOOPS root folder if it exists
    //------------------------------------------------------------------
    $xmlfile = $GLOBALS['xoops']->path('xsitemap.xml');
    if (\is_file($xmlfile)) {
        if (false === ($delOk = \unlink($xmlfile))) {
            $module->setErrors(\sprintf(\_AM_WGEVENTS_ERROR_BAD_REMOVE, $xmlfile));
        }
    }
    return $success && $delOk; // use this if you're using this routine
    */

    return $success;
    //------------ END  ----------------
}
