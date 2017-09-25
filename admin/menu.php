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

defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

$moduleHandler = xoops_getHandler('module');
$module        = $moduleHandler->getByDirname(basename(dirname(__DIR__)));
$pathIcon32    = '../../' . $module->getInfo('icons32');
xoops_loadLanguage('modinfo', $module->dirname());

$adminmenu[] = [
    'title' => _MI_XMCONTENT_MENU_HOME,
    'link'  => 'admin/index.php',
    'desc'  => _MI_XMCONTENT_MENU_HOME_DESC,
    'icon'  => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _MI_XMCONTENT_MENU_CONTENT,
    'link'  => 'admin/content.php',
    'desc'  => _MI_XMCONTENT_MENU_CONTENT_DESC,
    'icon'  => $pathIcon32 . '/content.png',
];

$adminmenu[] = [
    'title' => _MI_XMCONTENT_MENU_ABOUT,
    'link'  => 'admin/about.php',
    'desc'  => _MI_XMCONTENT_MENU_ABOUT_DESC,
    'icon'  => $pathIcon32 . '/about.png',
];
