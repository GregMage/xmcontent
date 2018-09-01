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
 * xmarticle module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
$path = dirname(dirname(dirname(__DIR__)));
require_once $path . '/mainfile.php';
require_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';
include_once XOOPS_ROOT_PATH . '/class/pagenav.php';


class_exists('\Xmf\Module\Admin') or die('XMF is required.');

use Xmf\Module\Helper;

$helper = Helper::getHelper(basename(dirname(__DIR__)));

// Load language files
$helper->loadLanguage('main');

// Config
$nb_limit   = $xoopsModuleConfig['admin_perpage'];
$url_logo   = XOOPS_UPLOAD_URL . '/xmcontent/images/';
$upload_size = 500000;

// Get handler
$contentHandler = xoops_getModuleHandler('xmcontent_content', 'xmcontent');
xoops_cp_header();
