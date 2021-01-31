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

require __DIR__ . '/admin_header.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('index.php');
$moduleAdmin->addConfigModuleVersion('system', 212);

// xmdoc
if (xoops_isActiveModule('xmdoc')){
	if ($helper->getConfig('options_xmdoc', 0) == 1) {
		$moduleAdmin->addConfigModuleVersion('xmdoc', 100);
	} else {
		$moduleAdmin->addConfigWarning(_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE);
	}
} else {
	$moduleAdmin->addConfigWarning(_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED);
}
// xmsocial
if (xoops_isActiveModule('xmsocial')){
	if ($helper->getConfig('options_xmsocial', 0) == 1 && $helper->getConfig('options_xmsocial_social', 0) == 1){
		$moduleAdmin->addConfigModuleVersion('xmsocial', 100);
	} else {
		if ($helper->getConfig('options_xmsocial', 0) != 1) {
			$moduleAdmin->addConfigWarning(_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATE);
		}
		if ($helper->getConfig('options_xmsocial_social', 0) != 1) {
			$moduleAdmin->addConfigWarning(_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATESOCIAL);
		}
	}
} else {
	$moduleAdmin->addConfigWarning(_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTINSTALLED);
}
// folder
$folder = array(XOOPS_ROOT_PATH . '/uploads/xmcontent/', XOOPS_ROOT_PATH . '/uploads/xmcontent/css',
               XOOPS_ROOT_PATH . '/uploads/xmcontent/templates', XOOPS_ROOT_PATH . '/uploads/xmcontent/images');
foreach (array_keys( $folder) as $i) {
    $moduleAdmin->addConfigBoxLine($folder[$i], 'folder');
    $moduleAdmin->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}
$moduleAdmin->displayIndex();

require __DIR__ . '/admin_footer.php';