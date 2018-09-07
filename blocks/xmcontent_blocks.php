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
	$contentHandler  = $helper->getHandler('xmcontent_content');
	$helper->loadLanguage('main');
	
	$content = $contentHandler->get($options[0]);	
	// permission to view
	$gpermHandler = xoops_getHandler('groupperm');
	$groups        = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	$moduleHandler = $helper->getModule();
	$perm_view = $gpermHandler->checkRight('xmcontent_contentview', $options[0], $groups, $moduleHandler->getVar('mid'), false);
	if (!$perm_view || 0 == $content->getVar('content_status')) {
		$block = array();
	} else{
		// css
		if (true == $helper->getConfig('options_css', 0) && '' != $content->getVar('content_css')){
			$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/uploads/xmcontent/css/' . $content->getVar('content_css'));
		}
		// template
		if (true == $helper->getConfig('options_template', 0) && '' != $content->getVar('content_template')){
			$block['template'] = XOOPS_ROOT_PATH . '/uploads/xmcontent/templates/' . $content->getVar('content_template');
		}
		$block['title'] = $content->getVar('content_title');
		$block['text' ] = str_replace('[break_dsc]', '', $content->getVar('content_text', 'show'));
		$block['dotitle'] = $content->getVar('content_dotitle');
	}	
	return $block;
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