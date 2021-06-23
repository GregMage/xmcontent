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
use Xmf\Module\Helper;
function block_xmcontent_show($options) {	
	global $xoopsUser;
	$helper = Helper::getHelper('xmcontent');
	$permHelper = new Helper\Permission('xmcontent');
	$contentHandler  = $helper->getHandler('xmcontent_content');
	$helper->loadLanguage('main');
	$helper->loadLanguage('admin');
	include_once __DIR__ . '/../class/utility.php';
	
	if ($options[0] != 0){	
		$content = $contentHandler->get($options[0]);
		// permission to view
		$gpermHandler = xoops_getHandler('groupperm');
		$groups        = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
		$moduleHandler = $helper->getModule();
		$perm_view = $gpermHandler->checkRight('xmcontent_contentview', $options[0], $groups, $moduleHandler->getVar('mid'), false);
		if (!$perm_view || 0 == $content->getVar('content_status')) {
			$block = array();
		} else{
			// permission to edit
			$block['perm_edit'] = $permHelper->checkPermission('xmcontent_contentedit', $options[0]);
			// css
			if (true == $helper->getConfig('options_css', 0) && '' != $content->getVar('content_css')){
				$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/uploads/xmcontent/css/' . $content->getVar('content_css'));
			}
			// template
			if (true == $helper->getConfig('options_template', 0) && '' != $content->getVar('content_template')){
				$block['template'] = XOOPS_ROOT_PATH . '/uploads/xmcontent/templates/' . $content->getVar('content_template');
			}
			$block['title'] = $content->getVar('content_title');
			$new_content = XmcontentUtility::includeContent(str_replace('[break_dsc]', '', $content->getVar('content_text', 'show')));
			$block['text'] = $new_content['text'];
			$block['error'] = $new_content['error'];
			$block['warning'] = $new_content['warning'];
			$block['id'] = $options[0];
			$block['dotitle'] = $content->getVar('content_dotitle');
			//xmsocial
			if (xoops_isActiveModule('xmsocial') && $helper->getConfig('options_xmsocial', 0) == 1) {
				xoops_load('utility', 'xmsocial');
				$xmsocial_arr = XmsocialUtility::renderRating($GLOBALS['xoTheme'], 'xmcontent', $options[0], 5, $content->getVar('content_rating'), $content->getVar('content_votes'));
				$block['xmsocial_arr'] = $xmsocial_arr;
				$block['dorating'] = $content->getVar('content_dorating');
			} else {
				$block['dorating'] = $content->getVar('content_dorating');
			}
		}
		return $block;
	} else {
		return array();
	}
}

function block_xmcontent_edit($options) {
	$helper = Helper::getHelper('xmcontent');
	$contentHandler  = $helper->getHandler('xmcontent_content');

	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('content_weight ASC, content_title');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('content_status', 1));
	$content_arr = $contentHandler->getall($criteria);
	
	include_once XOOPS_ROOT_PATH . '/modules/xmcontent/class/blockform.php';
    xoops_load('XoopsFormLoader');

    $form = new XmcontentBlockForm();
	$content = new XoopsFormSelect('', 'options[0]', $options[0], 5, false);
	$content->addOption(0, '--');
	foreach (array_keys($content_arr) as $i) {
		$content->addOption($content_arr[$i]->getVar('content_id'), $content_arr[$i]->getVar('content_title'));
	}	
	$form->addElement($content);

	return $form->render();
}