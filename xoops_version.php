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

$modversion['dirname']        = basename(__DIR__);
$modversion['name']           = ucfirst(basename(__DIR__));
$modversion['version']        = '1.7.0-Alpha';
$modversion['description']    = _MI_XMCONTENT_DESC;
$modversion['credits']        = 'G. Mage';
$modversion['author']         = 'G. Mage';
$modversion['nickname']       = 'Mage';
$modversion['license']        = 'GNU GPL';
$modversion['license_url']    = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']       = 1;
$modversion['image']          = 'assets/images/xmcontent_logo.png';
$modversion['dirmoduleadmin'] = 'Frameworks/moduleclasses';
$modversion['icons16']        = 'Frameworks/moduleclasses/icons/16';
$modversion['icons32']        = 'Frameworks/moduleclasses/icons/32';
$modversion['help']           = 'page=help';

//about
$modversion['release_date']        = '2022/01/29';
$modversion['module_website_url']  = 'www.monxoops.fr/';
$modversion['module_website_name'] = 'MonXoops';
$modversion['min_php']             = '7.1';
$modversion['min_xoops']           = '2.5.11-Beta2';
$modversion['min_db']              = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xmcontent_search';

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName']            = 'content_id';
$modversion['comments']['pageName']            = 'viewcontent.php';
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'content_com_approve';
$modversion['comments']['callback']['update']  = 'content_com_update';

//install and update
$modversion['onInstall']        = 'include/install.php';
$modversion['onUpdate']         = 'include/update.php';

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Admin Templates
$modversion['templates'][] = ['file' => 'xmcontent_admin_content.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'xmcontent_admin_permission.tpl', 'description' => '', 'type' => 'admin'];

// Templates
$modversion['templates'][] = ['file' => 'xmcontent_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmcontent_viewcontent.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmcontent_action.tpl', 'description' => ''];

// Blocks
$modversion['blocks'][] = array(
    'file'        => 'xmcontent_blocks.php',
    'name'        => _MI_XMCONTENT_BLOCK_DEFAULT,
    'description' => _MI_XMCONTENT_BLOCK_DEFAULT_DESC,
    'show_func'   => 'block_xmcontent_show',
    'edit_func'   => 'block_xmcontent_edit',
	'options'     => '0',
    'template'    => 'xmcontent_block.tpl'
);


// Menu
$modversion['hasMain'] = 1;

// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][1] = 'xmcontent_content';

// Pref.
$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTENT_PREF_HEAD_REWRITE',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

$modversion['config'][] = [
    'name'        => 'urlrewriting',
    'title'       => '_MI_XMCONTENT_PREF_REWRITE',
    'description' => '_MI_XMCONTENT_PREF_REWRITE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
$modversion['config'][] = [
    'name'        => 'rewritename',
    'title'       => '_MI_XMCONTENT_PREF_REWRITE_NAME',
    'description' => '_MI_XMCONTENT_PREF_REWRITE_NAME_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'content',
];

$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTENT_PREF_HEAD_INDEX',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

$modversion['config'][] = array(
    'name'        => 'index_columncontent',
    'title'       => '_MI_XMCONTENT_PREF_COLUMNCONTENT',
    'description' => '_MI_XMCONTENT_PREF_COLUMNCONTENT_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 2,
    'options'     => array(1 => 1, 2 => 2, 3 => 3, 4 => 4)
);

if (xoops_isActiveModule('xmcontent')) {
	$contentHandler = xoops_getModuleHandler('xmcontent_content', 'xmcontent');
	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('content_weight ASC, content_title');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('content_status', 1));
	$content_arr = $contentHandler->getall($criteria);
	$content[0] = _MI_XMCONTENT_PREF_CONTENTINDEX_ALL;
	foreach (array_keys($content_arr) as $i) {
		$content[$content_arr[$i]->getVar('content_id')] = $content_arr[$i]->getVar('content_title');
	}
} else {
	$content[0] = _MI_XMCONTENT_PREF_CONTENTINDEX_ALL;
}
$modversion['config'][] = array(
    'name'        => 'index_content',
    'title'       => '_MI_XMCONTENT_PREF_CONTENTINDEX',
    'description' => '_MI_XMCONTENT_PREF_CONTENTINDEX_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 0,
    'options'     => array_flip($content)
);

$modversion['config'][] = array(
    'name'        => 'index_header',
    'title'       => '_MI_XMCONTENT_PREF_HEADER',
    'description' => '_MI_XMCONTENT_PREF_HEADER_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'index_footer',
    'title'       => '_MI_XMCONTENT_PREF_FOOTER',
    'description' => '_MI_XMCONTENT_PREF_FOOTER_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);
$modversion['config'][] = array(
    'name'        => 'index_perpage',
    'title'       => '_MI_XMCONTENT_PREF_INDEXPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
);
$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTENT_PREF_HEAD_OPTIONS',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);
$modversion['config'][] = array(
    'name'        => 'options_css',
    'title'       => '_MI_XMCONTENT_PREF_CSS',
    'description' => '_MI_XMCONTENT_PREF_CSS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);
$modversion['config'][] = array(
    'name'        => 'options_template',
    'title'       => '_MI_XMCONTENT_PREF_TEMPLATE',
    'description' => '_MI_XMCONTENT_PREF_TEMPLATE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);
$modversion['config'][] = [
    'name'        => 'options_xmdoc',
    'title'       => '_MI_XMCONTENT_PREF_XMDOC',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];
$modversion['config'][] = [
    'name'        => 'options_xmsocial',
    'title'       => '_MI_XMCONTENT_PREF_XMSOCIAL',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];
$modversion['config'][] = [
    'name'        => 'options_xmsocial_social',
    'title'       => '_MI_XMCONTENT_PREF_XMSOCIALSOCIAL',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];
$modversion['config'][] = array(
    'name'        => 'options_warning',
    'title'       => '_MI_XMCONTENT_PREF_WARNING',
    'description' => '_MI_XMCONTENT_PREF_WARNING_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => _MI_XMCONTENT_PREF_WARNING_DEFAULT
);
$modversion['config'][] = [
    'name'        => 'options_include',
    'title'       => '_MI_XMCONTENT_PREF_INCLUDE',
    'description' => '_MI_XMCONTENT_PREF_INCLUDE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];
$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTENT_PREF_HEAD_ADMIN',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

xoops_load('xoopseditorhandler');
$editorHandler         = XoopsEditorHandler::getInstance();
$modversion['config'][] = array(
    'name'        => 'admin_editor',
    'title'       => '_MI_XMCONTENT_PREF_EDITOR',
    'description' => '',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => array_flip($editorHandler->getList())
);

$modversion['config'][] = array(
    'name'        => 'admin_perpage',
    'title'       => '_MI_XMCONTENT_PREF_ADMINPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
);
