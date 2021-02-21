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
include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmcontent_action.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$op = Request::getCmd('op', '');
// Get start pager
$start = Request::getInt('start', 0);
$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

if ($op == 'edit' || $op == 'save') {
    switch ($op) {

        // Edit
        case 'edit':
			$content_id = Request::getInt('content_id', 0);
			if ($content_id == 0) {
                $xoopsTpl->assign('error_message', _AM_XMCONTENT_ERROR_CONTENT);
            } else {
				$obj  = $contentHandler->get($content_id);
				if (empty($obj)){
					$xoopsTpl->assign('error_message', _AM_XMCONTENT_ERROR_CONTENT);
				} else {
					$permHelper->checkPermissionRedirect('xmcontent_contentedit', $obj->getVar('content_id'), 'index.php', 2, _NOPERM);
					$form = $obj->getForm();
					$xoopsTpl->assign('form', $form->render());
				}
            }
            break;

        // Save
        case 'save':
			$content_id = Request::getInt('content_id', 0);
			// Get Permission to edit in category
			$permHelper->checkPermissionRedirect('xmcontent_contentedit', $content_id, 'index.php', 2, _NOPERM);
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }            
            if ($content_id == 0) {
                redirect_header('index.php', 3, _AM_XMCONTENT_ERROR_CONTENT);
            } else {
                $obj = $contentHandler->get($content_id);
            }
            $error_message = $obj->saveContent($contentHandler, 'viewcontent.php');
            if ($error_message != '') {
                $xoopsTpl->assign('error_message', $error_message);
				$form = $obj->getForm();
                $xoopsTpl->assign('form', $form->render());
            }
            break;
    }
} else {
    redirect_header('index.php', 2, _NOPERM);
}
include XOOPS_ROOT_PATH . '/footer.php';
