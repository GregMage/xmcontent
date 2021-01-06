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
include __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'xmcontent_viewcontent.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$content_id = XoopsRequest::getInt('content_id', 0);
$xoopsTpl->assign('content_id', $content_id);

if (0 == $content_id) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
    exit();
}
$content = $contentHandler->get($content_id);

if (empty($content)) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NOCONTENT);
    exit();
}

if (0 == $content->getVar('content_status')) {
    redirect_header('index.php', 2, _AM_XMCONTENT_VIEWCONTENT_NACTIVE);
    exit();
}

// permission to view
if ($permHelper->checkPermission('xmcontent_contentview', $content_id) === false){
	redirect_header('index.php',2, _NOPERM);
}

// permission to edit
$xoopsTpl->assign('perm_edit', $permHelper->checkPermission('xmcontent_contentedit', $content_id));

// css
if (true == $helper->getConfig('options_css', 0) && '' != $content->getVar('content_css')){
	$xoTheme->addStylesheet( XOOPS_URL . '/uploads/xmcontent/css/' . $content->getVar('content_css'), null );
}
// template
if (true == $helper->getConfig('options_template', 0) && '' != $content->getVar('content_template')){
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
//xmdoc
if (xoops_isActiveModule('xmdoc') && $helper->getConfig('options_xmdoc', 0) == 1) {
    xoops_load('utility', 'xmdoc');
    XmdocUtility::renderDocuments($xoopsTpl, $xoTheme, 'xmcontent', $content_id);
} else {
    $xoopsTpl->assign('xmdoc_viewdocs', false);
}
//xmsocial
if (xoops_isActiveModule('xmsocial') && $helper->getConfig('options_xmsocial', 0) == 1) {
    xoops_load('utility', 'xmsocial');
	$xmsocial_arr = XmsocialUtility::renderRating($xoTheme, 'xmcontent', $content_id, 5, $content->getVar('content_rating'), $content->getVar('content_votes'));
	$xoopsTpl->assign('xmsocial_arr', $xmsocial_arr);
	$xoopsTpl->assign('dorating', $content->getVar('content_dorating'));
} else {
    $xoopsTpl->assign('dorating', false);
}
//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', \Xmf\Metagen::generateSeoTitle($content->getVar('content_title') . '-' . $xoopsModule->name()));
//description
if ('' == $content->getVar('content_mdescription')) {
    $xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription($content->getVar('content_text'), 30));
} else {
    $xoTheme->addMeta('meta', 'description', $content->getVar('content_mdescription'));
}
//keywords
if ('' == $content->getVar('content_mkeyword')) {
    $keywords = \Xmf\Metagen::generateKeywords($content->getVar('content_text'), 10);    
    $xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
} else {
    $xoTheme->addMeta('meta', 'keywords', $content->getVar('content_mkeyword'));
}
include XOOPS_ROOT_PATH.'/include/comment_view.php';
include XOOPS_ROOT_PATH . '/footer.php';
