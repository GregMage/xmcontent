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
include 'header.php';
$xoopsOption['template_main'] = 'xmcontent_viewcontent.tpl';
include_once XOOPS_ROOT_PATH.'/header.php';

$content_id = XoopsRequest::getInt('content_id', 0);

if ($content_id == 0){
	redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
	exit();
}
$content= $content_Handler->get($content_id);

if (count($content) == 0){
	redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
	exit();
}

if ($content->getVar('content_status') == 0){
	redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NACTIVE);
	exit();
}

// permission to view
$gperm_Handler = xoops_gethandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
    $groups = XOOPS_GROUP_ANONYMOUS;
}
$perm_view = $gperm_Handler->checkRight('xmcontent_contentview', $content_id, $groups, $xoopsModule->getVar('mid'), false);
if (!$perm_view) {
	redirect_header('index.php', 2, _NOPERM);
    exit();
}


$xoopsTpl->assign('content_title', $content->getVar('content_title'));
$xoopsTpl->assign('content_text', $content->getVar('content_text', 'show'));
$xoopsTpl->assign('content_dopdf', $content->getVar('content_dopdf'));
$xoopsTpl->assign('content_doprint', $content->getVar('content_doprint'));
$xoopsTpl->assign('content_dosocial', $content->getVar('content_dosocial'));
$xoopsTpl->assign('content_domail', $content->getVar('content_domail'));
$xoopsTpl->assign('content_dotitle', $content->getVar('content_dotitle'));


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', strip_tags($content->getVar('content_title') . ' - ' . $xoopsModule->name()));
//description
if ($content->getVar('content_mdescription') == ''){
	$xoTheme->addMeta('meta', 'description', $content->getVar('content_title'));
} else {
	$xoTheme->addMeta('meta', 'description', $content->getVar('content_mdescription'));
}

//keywords
$xoTheme->addMeta('meta', 'keywords', $content->getVar('content_mkeyword'));

include XOOPS_ROOT_PATH.'/footer.php';