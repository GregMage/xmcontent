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
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
require dirname(__FILE__) . '/header.php';

// header
xoops_cp_header();

// request
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('content_status', 1));
$content_active = $content_Handler->getCount($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('content_status', 0));
$content_nactive = $content_Handler->getCount($criteria);
$admin_class->addInfoBox(_AM_XMCONTENT_INDEX_CONTENT);
$admin_class->addInfoBoxLine(_AM_XMCONTENT_INDEX_CONTENT, _AM_XMCONTENT_INDEX_CONTENT_ACTIVE, $content_active, 'green');
$admin_class->addInfoBoxLine(_AM_XMCONTENT_INDEX_CONTENT, _AM_XMCONTENT_INDEX_CONTENT_NACTIVE, $content_nactive, 'red');

$xoopsTpl->assign('navigation', $admin_class->addNavigation('index.php'));
$xoopsTpl->assign('renderindex', $admin_class->renderIndex());

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontent/templates/admin/xmcontent_index.tpl');

xoops_cp_footer();