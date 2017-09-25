<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmcontent module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
include_once $GLOBALS['xoops']->path('Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
require_once dirname(dirname(__DIR__)) . '/system/include/functions.php';
include_once XOOPS_ROOT_PATH . '/class/pagenav.php';

global $xoopsModule;
XoopsLoad::load('XoopsRequest');

// Config
$nb_limit   = $xoopsModuleConfig['admin_perpage'];
$pathIcon16 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons16');
$pathIcon32 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons32');
$upload_size = 500000;
// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));
$admin_class = new ModuleAdmin();

// Get handler
$contentHandler = xoops_getModuleHandler('xmcontent_content', 'xmcontent');
