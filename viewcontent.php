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
include __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'xmcontent_viewcontent.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$content_id = XoopsRequest::getInt('content_id', 0);

if ($content_id == 0) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
    exit();
}
$content = $contentHandler->get($content_id);

if (count($content) == 0) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
    exit();
}

if ($content->getVar('content_status') == 0) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NACTIVE);
    exit();
}

// permission to view
$gpermHandler = xoops_getHandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
    $groups = XOOPS_GROUP_ANONYMOUS;
}
$perm_view = $gpermHandler->checkRight('xmcontent_contentview', $content_id, $groups, $xoopsModule->getVar('mid'), false);
if (!$perm_view) {
    redirect_header('index.php', 2, _NOPERM);
    exit();
}
// css
if ($xoopsModuleConfig['options_css'] == true && $content->getVar('content_css') != ''){
	$xoTheme->addStylesheet( XOOPS_URL . '/uploads/xmcontent/css/' . $content->getVar('content_css'), null );
}
// template
if ($xoopsModuleConfig['options_template'] == true && $content->getVar('content_template') != ''){
	$xoopsTpl->assign('content_template', XOOPS_ROOT_PATH . "/uploads/xmcontent/templates/" . $content->getVar('content_template'));
}

$xoopsTpl->assign('content_title', $content->getVar('content_title'));
$xoopsTpl->assign('content_text' , str_replace('[break_dsc]', '', $content->getVar('content_text', 'show')));
$xoopsTpl->assign('content_docomment', $content->getVar('content_docomment'));
$xoopsTpl->assign('content_dopdf', $content->getVar('content_dopdf'));
$xoopsTpl->assign('content_doprint', $content->getVar('content_doprint'));
$xoopsTpl->assign('content_dosocial', $content->getVar('content_dosocial'));
$xoopsTpl->assign('content_domail', $content->getVar('content_domail'));
$xoopsTpl->assign('content_dotitle', $content->getVar('content_dotitle'));

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', \Xmf\Metagen::generateSeoTitle($content->getVar('content_title') . '-' . $xoopsModule->name()));
//description
if ($content->getVar('content_mdescription') == '') {    
    $xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription($content->getVar('content_text'), 30));
} else {
    $xoTheme->addMeta('meta', 'description', $content->getVar('content_mdescription'));
}
//keywords
if ($content->getVar('content_mkeyword') == '') {
    $keywords = \Xmf\Metagen::generateKeywords($content->getVar('content_text'), 10);    
    $xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
} else {
    $xoTheme->addMeta('meta', 'keywords', $content->getVar('content_mkeyword'));
}
include XOOPS_ROOT_PATH.'/include/comment_view.php';
include XOOPS_ROOT_PATH . '/footer.php';
