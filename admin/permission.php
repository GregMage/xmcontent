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

use Xmf\Module\Admin; 
use Xmf\Request;

require __DIR__ . '/admin_header.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('permission.php');

// Get permission
$permission = Request::getInt('permission', 1);

// Category
$criteria = new CriteriaCompo();
$criteria->setSort('content_weight ASC, content_title');
$criteria->setOrder('ASC');
$content_arr = $contentHandler->getall($criteria);
if (count($content_arr) > 0) {
	$tab_perm = [1 => _AM_XMCONTENT_PERMISSION_VIEW, 2 => _AM_XMCONTENT_PERMISSION_EDIT];
	$permission_options = '';
	foreach (array_keys($tab_perm) as $i) {
		$permission_options .= '<option value="' . $i . '"' . ($permission == $i ? ' selected="selected"' : '') . '>' . $tab_perm[$i] . '</option>';
	}
	$xoopsTpl->assign('permission_options', $permission_options);
	
	switch ($permission) {
		case 1:    // View permission abstract
			$formTitle = _AM_XMCONTENT_PERMISSION_VIEW;
			$permissionName = 'xmcontent_contentview';
			$permissionDescription = _AM_XMCONTENT_PERMISSION_VIEW_DSC;
			foreach (array_keys($content_arr) as $i) {
				$global_perms_array[$i] = $content_arr[$i]->getVar('content_title');
			}
			break;

		case 2:    // Edit/appove permission
			$formTitle = _AM_XMCONTENT_PERMISSION_EDIT;
			$permissionName = 'xmcontent_contentedit';
			$permissionDescription = _AM_XMCONTENT_PERMISSION_EDIT_DSC;
			foreach (array_keys($content_arr) as $i) {
				$global_perms_array[$i] = $content_arr[$i]->getVar('content_title');
			}
			break;
	}
	$permissionsForm = new XoopsGroupPermForm($formTitle, $helper->getModule()->getVar('mid'), $permissionName, $permissionDescription, 'admin/permission.php?permission=' . $permission);
	foreach ($global_perms_array as $perm_id => $permissionName) {
		$permissionsForm->addItem($perm_id , $permissionName) ;
	}
	$xoopsTpl->assign('form', $permissionsForm->render());
} else {
	$xoopsTpl->assign('error_message', _AM_XMCONTENT_ERROR_CONTENT);
}


$xoopsTpl->display("db:xmcontent_admin_permission.tpl");

require __DIR__ . '/admin_footer.php';
