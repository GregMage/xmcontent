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
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('content.php');

// Get Action type
$op = Request::getCmd('op', 'list');
//title
$title = Request::getString('title', '');
$xoopsTpl->assign('title', $title);		
// Status		
$fcontent_status = Request::getInt('fcontent_status', 10);
$xoopsTpl->assign('fcontent_status', $fcontent_status);

switch ($op) {
    // list of content
    case 'list':
    default:
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
        $xoTheme->addScript('browse.php?Frameworks/jquery/plugins/jquery.tablesorter.js');
        $xoTheme->addScript('modules/system/js/admin.js');
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTENT_CONTENT_ADD, 'content.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Get start pager
        $start = Request::getInt('start', 0);
		$xoopsTpl->assign('filter', true);
        $status_options         = [1 => _AM_XMCONTENT_CONTENT_STATUS_A, 0 => _AM_XMCONTENT_CONTENT_STATUS_NA];
		$content_status_options = '<option value="10"' . ($fcontent_status == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
        foreach (array_keys($status_options) as $i) {
            $content_status_options .= '<option value="' . $i . '"' . ($fcontent_status == $i ? ' selected="selected"' : '') . '>' . $status_options[$i] . '</option>';
        }
        $xoopsTpl->assign('content_status_options', $content_status_options);
        // Criteria
        $criteria = new CriteriaCompo();
		if ($title != ''){
			$criteria->add(new Criteria('content_title', '%' . $title . '%', 'LIKE'));
		}
		if ($fcontent_status != 10){
			$criteria->add(new Criteria('content_status', $fcontent_status));
		} 
        $criteria->setSort('content_weight ASC, content_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $content_arr   = $contentHandler->getall($criteria);
        $content_count = $contentHandler->getCount($criteria);
        $xoopsTpl->assign('content_count', $content_count);

        if ($content_count > 0) {
            foreach (array_keys($content_arr) as $i) {
                $content_id        = $content_arr[$i]->getVar('content_id');
                $content['id']     = $content_id;
                $content['title']  = $content_arr[$i]->getVar('content_title');
                $content['weight'] = $content_arr[$i]->getVar('content_weight');
                $content['status'] = $content_arr[$i]->getVar('content_status');
                if (0 == $content_arr[$i]->getVar('content_maindisplay')) {
                    $content['maindisplay'] = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
                } else {
                    $content['maindisplay'] = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
                }
                if (0 == $content_arr[$i]->getVar('content_dotitle')) {
                    $content['dotitle'] = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
                } else {
                    $content['dotitle'] = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
                }
                $xoopsTpl->append_by_ref('content', $content);
                unset($content);
            }
            // Display Page Navigation
            if ($content_count > $nb_limit) {
                $nav = new XoopsPageNav($content_count, $nb_limit, $start, 'start', 'fcontent_status=' . $fcontent_status .'&title=' . $title);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('message_error', _AM_XMCONTENT_ERROR_CONTENT);
        }
        break;

    // view content
    case 'view':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTENT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');

        $xoopsTpl->assign('view', 'view');

        $content_id = Request::getInt('content_id', 0);
        $content    = $contentHandler->get($content_id);

        if (0 == $content->getVar('content_status')) {
            $status = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_CONTENT_STATUS_NA . '</span>';
        } else {
            $status = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_CONTENT_STATUS_A . '</span>';
        }
        if (0 == $content->getVar('content_maindisplay')) {
            $maindisplay = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $maindisplay = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        if (0 == $content->getVar('content_docomment')){
            $docomment = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $docomment = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        // for next version (Xoops 2.6)
        /*if ($content->getVar('content_dopdf') == 0){
            $dopdf = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $dopdf = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        if ($content->getVar('content_doprint') == 0){
            $doprint = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $doprint = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }*/
		if ($content->getVar('content_dorating') == 0){
            $dorating = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $dorating = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        /*if ($content->getVar('content_dosocial') == 0){
            $dosocial = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $dosocial = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        if ($content->getVar('content_domail') == 0){
            $domail = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $domail = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }*/
        if (0 == $content->getVar('content_dotitle')) {
            $dotitle = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_NO . '</span>';
        } else {
            $dotitle = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_YES . '</span>';
        }
        $content_arr = array(
            _AM_XMCONTENT_CONTENT_TITLE       => $content->getVar('content_title'),
            _AM_XMCONTENT_CONTENT_TEXT        => $content->getVar('content_text', 'show'),
			_AM_XMCONTENT_CONTENT_LOGO        => '<img src="' . $url_logo . $content->getVar('content_logo') . '" alt="' . $content->getVar('content_title') . '" style="max-width:150px">',
            _AM_XMCONTENT_CONTENT_WEIGHT      => $content->getVar('content_weight'),
            _AM_XMCONTENT_CONTENT_STATUS      => $status,
            _AM_XMCONTENT_CONTENT_KEYWORD     => $content->getVar('content_mkeyword'),
            _AM_XMCONTENT_CONTENT_DESCRIPTION => $content->getVar('content_mdescription'),
            _AM_XMCONTENT_CONTENT_MAINDISPLAY => $maindisplay,
            _AM_XMCONTENT_CONTENT_DOCOMMENT => $docomment,
            /*_AM_XMCONTENT_CONTENT_DOPDF => $dopdf,
            _AM_XMCONTENT_CONTENT_DOPRINT => $doprint,*/
            _AM_XMCONTENT_CONTENT_DORATING => $dorating,
            /*_AM_XMCONTENT_CONTENT_DOSOCIAL => $dosocial,
            _AM_XMCONTENT_CONTENT_DOMAIL => $domail,*/
            _AM_XMCONTENT_CONTENT_DOTITLE     => $dotitle
        );
        $xoopsTpl->assign('content_arr', $content_arr);
        $xoopsTpl->assign('content_id', $content_id);
        break;

    // add content
    case 'add':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTENT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());

        // Create form
        $obj  = $contentHandler->create();
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // edit content
    case 'edit':
		// Module admin
		$moduleAdmin->addItemButton(_AM_XMCONTENT_CONTENT_ADD, 'content.php?op=add', 'add');
        $moduleAdmin->addItemButton(_AM_XMCONTENT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());

        // Create form
        $obj  = $contentHandler->get(Request::getInt('content_id', 0));
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // del content
    case 'del':
        // Create form
        $content_id = Request::getInt('content_id', 0);
        $obj        = $contentHandler->get($content_id);

        if (isset($_POST['ok']) && 1 == $_POST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('content.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($contentHandler->delete($obj)) {
				//xmdoc
				if (xoops_isActiveModule('xmdoc') && $helper->getConfig('options_xmdoc', 0) == 1) {
					xoops_load('utility', 'xmdoc');
					XmdocUtility::delDocdata('xmcontent', $content_id);
				}
				//xmsocial
				if (xoops_isActiveModule('xmsocial') && $helper->getConfig('options_xmsocial', 0) == 1) {
					xoops_load('utility', 'xmsocial');
					$error_message .= XmsocialUtility::delRatingdata('xmcontent', $content_id);
					if ($helper->getConfig('options_xmsocial_social', 0) == 1) {
						$error_message .= XmsocialUtility::delSocialdata('xmcontent', $content_id);
					}
				}
				//Del logo
				if ($obj->getVar('content_logo') != 'blank.gif') {
					// Test if the image is used
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('content_logo', $obj->getVar('content_logo')));
					$content_count = $contentHandler->getCount($criteria);
					if ($content_count == 0){
						$uploadirectory = '/xmcontent/images/';
						$urlfile = XOOPS_UPLOAD_PATH . $uploadirectory . $obj->getVar('content_logo');
						if (is_file($urlfile)) {
							chmod($urlfile, 0777);
							unlink($urlfile);
						}
					}
				}
				// Del permissions
				$permHelper = new \Xmf\Module\Helper\Permission();
				$permHelper->deletePermissionForItem('xmcontent_contentview', $content_id);
                redirect_header('content.php', 2, _AM_XMCONTENT_REDIRECT_SAVE);
            } else {
                xoops_error($obj->getHtmlErrors());
            }
        } else {
            xoops_confirm(array(
                              'ok'         => 1,
                              'content_id' => $content_id,
                              'op'         => 'del'
                          ), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTENT_CONTENT_SUREDEL, $obj->getVar('content_title')));
        }
        break;
    // save content
    case 'save':
		if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('content.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $content_id = Request::getInt('content_id', 0);
        if ($content_id == 0) {
            $obj = $contentHandler->create();
        } else {
            $obj = $contentHandler->get($content_id);
        }
        $error_message = $obj->saveContent($contentHandler, '/modules/xmcontent/admin/content.php?fcontent_status=' . $fcontent_status . '&title=' . $title);
        if ($error_message != ''){
            $xoopsTpl->assign('message_error', $error_message);
			$form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }        
        break;

    // clone
    case 'clone':
        $content_id = Request::getInt('content_id', 0);
        $content    = $contentHandler->get($content_id);
        if (isset($_POST['ok']) && 1 == $_POST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('content.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $newobj = $contentHandler->create();
            $newobj->setVar('content_title', _AM_XMCONTENT_CONTENT_COPY . $content->getVar('content_title'));
            $newobj->setVar('content_text', $content->getVar('content_text','n'));
			$newobj->setVar('content_logo', $content->getVar('content_logo'));
            $newobj->setVar('content_weight', 0);
            $newobj->setVar('content_status', $content->getVar('content_status'));
            $newobj->setVar('content_mkeyword', $content->getVar('content_mkeyword'));
            $newobj->setVar('content_mdescription', $content->getVar('content_mdescription'));
            $newobj->setVar('content_maindisplay', $content->getVar('content_maindisplay'));
            $newobj->setVar('content_docomment', $content->getVar('content_docomment'));
            $newobj->setVar('content_dopdf', $content->getVar('content_dopdf'));
            $newobj->setVar('content_doprint', $content->getVar('content_doprint'));
            $newobj->setVar('content_dosocial', $content->getVar('content_dosocial'));
            $newobj->setVar('content_domail', $content->getVar('content_domail'));
            $newobj->setVar('content_dotitle', $content->getVar('content_dotitle'));
            if ($contentHandler->insert($newobj)) {
                // clone permissions
                $perm_id       = $newobj->get_new_enreg();
                $module_mid    = $xoopsModule->getVar('mid');
                $gpermHandler  = xoops_getHandler('groupperm');
                $groups        = array_values($gpermHandler->getGroupIds('xmcontent_contentview', $content_id, $module_mid));
                if (0 != count($groups)) {
                    foreach ($groups as $group_id) {
                        $gpermHandler->addRight('xmcontent_contentview', $perm_id, $group_id, $module_mid);
                    }
                }
				$groups = array_values($gpermHandler->getGroupIds('xmcontent_contentedit', $content_id, $module_mid));
                if (0 != count($groups)) {
                    foreach ($groups as $group_id) {
                        $gpermHandler->addRight('xmcontent_contentedit', $perm_id, $group_id, $module_mid);
                    }
                }
                redirect_header('content.php', 2, _AM_XMCONTENT_REDIRECT_SAVE);
                exit;
            }
            $xoopsTpl->assign('message_error', $newobj->getHtmlErrors());
        } else {
            xoops_confirm(array(
                              'ok'         => 1,
                              'content_id' => $content_id,
                              'op'         => 'clone'
                          ), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTENT_CONTENT_SURECLONE, $content->getVar('content_title')));
        }
        break;

    // update status
    case 'content_update_status':
        $content_id = Request::getInt('content_id', 0);
        if ($content_id > 0) {
            $obj = $contentHandler->get($content_id);
            $old = $obj->getVar('content_status');
            $obj->setVar('content_status', !$old);
            if ($contentHandler->insert($obj)) {
                exit;
            }
            $xoopsTpl->assign('message_error', $obj->getHtmlErrors());
        }
        break;
}
// Call template file
$xoopsTpl->display("db:xmcontent_admin_content.tpl");
require __DIR__ . '/admin_footer.php';
