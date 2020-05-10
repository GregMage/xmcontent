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
		//title
		$title = Request::getString('title', '');
		$xoopsTpl->assign('title', $title);		
		// Status		
        $content_status = Request::getInt('content_status', 10);
        $xoopsTpl->assign('content_status', $content_status);
        $status_options         = [1 => _AM_XMCONTENT_CONTENT_STATUS_A, 0 => _AM_XMCONTENT_CONTENT_STATUS_NA];
		$content_status_options = '<option value="10"' . ($content_status == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
        foreach (array_keys($status_options) as $i) {
            $content_status_options .= '<option value="' . $i . '"' . ($content_status == $i ? ' selected="selected"' : '') . '>' . $status_options[$i] . '</option>';
        }
        $xoopsTpl->assign('content_status_options', $content_status_options);
        // Criteria
        $criteria = new CriteriaCompo();
		if ($title != ''){
			$criteria->add(new Criteria('content_title', '%' . $title . '%', 'LIKE'));
		}
		if ($content_status != 10){
			$criteria->add(new Criteria('content_status', $content_status));
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
                $nav = new XoopsPageNav($content_count, $nb_limit, $start, 'start', 'content_status=' . $content_status .'&title=' . $title);
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
        }
        if ($content->getVar('content_dosocial') == 0){
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
            _AM_XMCONTENT_CONTENT_DOPRINT => $doprint,
            _AM_XMCONTENT_CONTENT_DOSOCIAL => $dosocial,
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
        if (isset($_POST['content_id'])) {
            $obj = $contentHandler->get(Request::getInt('content_id', 0));
        } else {
            $obj = $contentHandler->create();
        }

        $message_error           = '';
        $content_id              = Request::getInt('content_id', 0, 'POST');
        $content['title']        = Request::getString('content_title', '', 'POST');
        $content['text']         = Request::getText('content_text', '', 'POST');
        $content['weight']       = $_POST['content_weight'];
        $content['status']       = Request::getInt('content_status', 0, 'POST');
        $content['mkeyword']     = Request::getString('content_mkeyword', '', 'POST');
        $content['mdescription'] = Request::getString('content_mdescription', '', 'POST');
        $content['maindisplay']  = Request::getInt('content_maindisplay', 0, 'POST');
        $content['docomment']    = Request::getInt('content_docomment', 0, 'POST');
        $content['dopdf']        = Request::getInt('content_dopdf', 0, 'POST');
        $content['doprint']      = Request::getInt('content_doprint', 0, 'POST');
        $content['dosocial']     = Request::getInt('content_dosocial', 0, 'POST');
        $content['domail']       = Request::getInt('content_domail', 0, 'POST');
        $content['dotitle']      = Request::getInt('content_dotitle', 0, 'POST');
        // error
        if (0 == (int)$content['weight'] && '0' != $content['weight']) {
            $message_error .= _AM_XMCONTENT_ERROR_WEIGHT . '<br>';
            $content['weight'] = 0;
        }
		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		//css
		if (true == $helper->getConfig('options_css', 0)){
			if (UPLOAD_ERR_NO_FILE != $_FILES['content_css']['error']) {
				$uploader_css = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . '/xmcontent/css/', array('text/css'), $upload_size, null, null);
				if ($uploader_css->fetchMedia('content_css')) {
					if (!$uploader_css->upload()) {
						$message_error .= 'Css -' .$uploader_css->getErrors() . '<br />';
					} else {
						$obj->setVar('content_css', $uploader_css->getSavedFileName());
					}
				} else {
					$message_error .= 'Css -' . $uploader_css->getErrors();
				}
			} else {
				$obj->setVar('content_css', $_POST['content_css']);
			}
		}else{
			$obj->setVar('content_css', '');
		}
		//template
		if (true == $helper->getConfig('options_template', 0)){
			if (UPLOAD_ERR_NO_FILE != $_FILES['content_template']['error']) {
				$uploader_template = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . '/xmcontent/templates/', array('text/html','tpl/html'), $upload_size, null, null);
				if ($uploader_template->fetchMedia('content_template')) {
					if (!$uploader_template->upload()) {
						$message_error .= 'Template -' . $uploader_template->getErrors() . '<br />';
					} else {
						$obj->setVar('content_template', $uploader_template->getSavedFileName());
					}
				} else {
					$message_error .= 'Template -' . $uploader_template->getErrors();
				}
			} else {
				$obj->setVar('content_template', $_POST['content_template']);
			}
		}else{
			$obj->setVar('content_template', '');
		}
		//logo
        $uploadirectory = '/xmcontent/images';
        if ($_FILES['content_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_content_img = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . $uploadirectory, ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'], $upload_size, null, null);
            if ($uploader_content_img->fetchMedia('content_logo')) {
                $uploader_content_img->setPrefix('content_');
                if (!$uploader_content_img->upload()) {
                    $message_error .= $uploader_content_img->getErrors() . '<br>';
                } else {
                    $obj->setVar('content_logo', $uploader_content_img->getSavedFileName());
                }
            } else {
                $message_error .= $uploader_content_img->getErrors();
            }
        } else {
            $obj->setVar('content_logo', Xmf\Request::getString('content_logo', ''));
        }
		
        $obj->setVar('content_title', $content['title']);
        $obj->setVar('content_text', $content['text']);
        $obj->setVar('content_weight', $content['weight']);
        $obj->setVar('content_status', $content['status']);
        $obj->setVar('content_mkeyword', $content['mkeyword']);
        $obj->setVar('content_mdescription', $content['mdescription']);
        $obj->setVar('content_maindisplay', $content['maindisplay']);
        $obj->setVar('content_docomment', $content['docomment']);
        $obj->setVar('content_dopdf', $content['dopdf']);
        $obj->setVar('content_doprint', $content['doprint']);
        $obj->setVar('content_dosocial', $content['dosocial']);
        $obj->setVar('content_domail', $content['domail']);
        $obj->setVar('content_dotitle', $content['dotitle']);

        if ('' != $message_error) {
            // Define button addItemButton
            $admin_class->addItemButton(_AM_XMCONTENT_CONTENT_LIST, 'content.php', 'list');
            $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
            $xoopsTpl->assign('message_error', $message_error);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        } else {
            if ($contentHandler->insert($obj)) {
                // update permissions
                $newcontent_id = $obj->get_new_enreg();
                $perm_id       = $content_id > 0 ? $content_id : $newcontent_id;
                $gpermHandler = xoops_getHandler('groupperm');
                $criteria      = new CriteriaCompo();
                $criteria->add(new Criteria('gperm_itemid', $perm_id, '='));
                $criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'), '='));
                $criteria->add(new Criteria('gperm_name', 'xmcontent_contentview', '='));
                $gpermHandler->deleteAll($criteria);
                if (isset($_POST['groups_view'])) {
                    foreach ($_POST['groups_view'] as $onegroup_id) {
                        $gpermHandler->addRight('xmcontent_contentview', $perm_id, $onegroup_id, $xoopsModule->getVar('mid'));
                    }
                }
				//xmdoc
                if (xoops_isActiveModule('xmdoc') && $helper->getConfig('options_xmdoc', 0) == 1) {
                    xoops_load('utility', 'xmdoc');
                    $error_message .= XmdocUtility::saveDocuments('xmcontent', $perm_id);
                }
                redirect_header('content.php', 2, _AM_XMCONTENT_REDIRECT_SAVE);
            } else {
                $xoopsTpl->assign('message_error', $obj->getHtmlErrors());
            }
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
                $gpermHandler = xoops_getHandler('groupperm');
                $groups        = array_values($gpermHandler->getGroupIds('xmcontent_contentview', $content_id, $module_mid));
                if (0 != count($groups)) {
                    foreach ($groups as $group_id) {
                        $gpermHandler->addRight('xmcontent_contentview', $perm_id, $group_id, $module_mid);
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
