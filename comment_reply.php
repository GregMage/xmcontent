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
use \Xmf\Request;
include_once dirname(dirname(__DIR__)) . '/mainfile.php';

$com_itemid = Request::getInt('com_itemid', 0, 'GET');
if ($com_itemid > 0) {
    // permission to view
    $gpermHandler = xoops_getHandler('groupperm');
    if (is_object($xoopsUser)) {
        $groups = $xoopsUser->getGroups();
    } else {
        $groups = XOOPS_GROUP_ANONYMOUS;
    }
    $perm_view = $gpermHandler->checkRight('xmcontent_contentview', $com_itemid, $groups, $xoopsModule->getVar('mid'), false);
    if (!$perm_view) {
        redirect_header(XOOPS_URL, 2, _NOPERM);
        exit();
    }
    // Get handler
    $contentHandler = xoops_getModuleHandler('xmcontent_content', 'xmcontent');
    $content = $contentHandler->get($com_itemid);
    if (0 == $content->getVar('content_docomment')) {
        redirect_header(XOOPS_URL, 2, _NOPERM);
        exit();
    }
	xoops_load('utility', 'xmcontent');
    $com_replytitle = XmcontentUtility::TagSafe($content->getVar('content_title'));

    include_once $GLOBALS['xoops']->path('include/comment_reply.php');
}
