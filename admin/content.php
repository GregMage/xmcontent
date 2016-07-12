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
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
require dirname(__FILE__) . '/header.php';

// Header
xoops_cp_header();


// Get Action type
$op = XoopsRequest::getCmd('op', 'list');

switch ($op) {
    // list of content
    case 'list':
        default:
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
        $xoTheme->addScript('browse.php?Frameworks/jquery/plugins/jquery.tablesorter.js');
        $xoTheme->addScript('modules/system/js/admin.js');
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('content.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTENT_CONTENT_ADD, 'content.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        // Get start pager
        $start = XoopsRequest::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('content_weight ASC, content_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $content_arr = $content_Handler->getall($criteria);
        $content_count = $content_Handler->getCount($criteria);
        $xoopsTpl->assign('content_count', $content_count);

        if ($content_count > 0) {
            foreach (array_keys($content_arr) as $i) {
                $content_id = $content_arr[$i]->getVar('content_id');
                $content['id'] = $content_id;
                $content['title'] = $content_arr[$i]->getVar('content_title');
                $content['weight'] = $content_arr[$i]->getVar('content_weight');
                $content['status'] = $content_arr[$i]->getVar('content_status');

                $xoopsTpl->append_by_ref('content', $content);
                unset($content);
            }
            // Display Page Navigation
            if ($content_count > $nb_limit) {
                $nav = new XoopsPageNav($content_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else{
            $xoopsTpl->assign('message_error', _AM_XMCONTENT_ERROR_CONTENT);
        }
        break;
        
    // view content
    case 'view':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('content.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTENTT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        
        $xoopsTpl->assign('view', 'view');
        
        $content_id = XoopsRequest::getInt('content_id', 0);
        $content = $content_Handler->get($content_id);
        
        if ($content->getVar('content_status') == 0){
            $status = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTENT_CONTENT_STATUS_NA . '</span>';
        } else {
            $status = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTENT_CONTENT_STATUS_A . '</span>';
        }

        /*$request_arr = array(_AM_XMCONTACT_CATEGORY => $category_title,
                             _AM_XMCONTACT_REQUEST_SUBJECT => $request->getVar('request_subject'),
                             _AM_XMCONTACT_REQUEST_SUBMITTER => $request->getVar('request_name'),
                             _AM_XMCONTACT_REQUEST_SUBJECT => $request->getVar('request_subject'),
                             _AM_XMCONTACT_REQUEST_EMAIL => $request->getVar('request_email'),
                             _AM_XMCONTACT_REQUEST_PHONE => $request->getVar('request_phone'),
                             _AM_XMCONTACT_REQUEST_IP => $request->getVar('request_ip'),
                             _AM_XMCONTACT_REQUEST_DATES => formatTimestamp($request->getVar('request_date_e')),
                             _AM_XMCONTACT_REQUEST_DATER => $date_r,
                             _AM_XMCONTACT_STATUS => $status,
                             _AM_XMCONTACT_REQUEST_MESSAGE => $request->getVar('request_message', 'show'),
                             );*/

        $xoopsTpl->assign('content_arr', $content_arr);
        $xoopsTpl->assign('content_id', $content_id);
        break;

    // add content
    case 'add':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('content.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTENTT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        
        // Create form
        $obj  = $content_Handler->create();
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // edit content
    case 'edit':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('content.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTENT_CONTENT_ADD, 'content.php?op=add', 'add');
        $admin_class->addItemButton(_AM_XMCONTENTT_CONTENT_LIST, 'content.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        
        // Create form
        $obj  = $content_Handler->get($start = XoopsRequest::getInt('content_id', 0));
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // del content
    case 'del':
        // Create form
        $content_id = XoopsRequest::getInt('content_id', 0);
        $obj  = $content_Handler->get($content_id);

        if (isset($_POST['ok']) && $_POST['ok'] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('content.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($content_Handler->delete($obj)) {
                redirect_header('content.php', 2, _AM_XMCONTENT_REDIRECT_SAVE);
            } else {
                xoops_error($obj->getHtmlErrors());
            }
        } else {
            xoops_confirm(array(
                              'ok' => 1,
                              'content_id' => $content_id,
                              'op' => 'del'), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTENT_CONTENT_SUREDEL, $obj->getVar('content_title')));
        }
        break;
    // save content
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('content.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($_POST['content_id'])) {
            $obj = $content_Handler->get(XoopsRequest::getInt('content_id', 0));
        } else {
            $obj = $content_Handler->create();
        }
        
        $message_error = '';
        $content_id = XoopsRequest::getInt('content_id', 0, 'POST');
        $content['title'] = XoopsRequest::getString('content_title', '', 'POST');
        $content['text'] = XoopsRequest::getString('content_text', '', 'POST');
        $content['weight'] = $_POST['content_weight'];
        $content['status'] = XoopsRequest::getInt('content_status', 0, 'POST');
        $content['mkeyword'] = XoopsRequest::getString('content_mkeyword', '', 'POST');
        $content['mdescription'] = XoopsRequest::getString('content_mdescription', '', 'POST');
        $content['maindisplay'] = XoopsRequest::getInt('content_maindisplay', 0, 'POST');
        $content['dopdf'] = XoopsRequest::getInt('content_dopdf', 0, 'POST');
        $content['doprint'] = XoopsRequest::getInt('content_doprint', 0, 'POST');
        $content['dosocial'] = XoopsRequest::getInt('content_dosocial', 0, 'POST');
        $content['domail'] = XoopsRequest::getInt('content_domail', 0, 'POST');
        $content['dotitle'] = XoopsRequest::getInt('content_dotitle', 0, 'POST');
        // error
        if (intval($content['weight'])==0 && $content['weight'] != '0') {
            $message_error .= _AM_XMCONTENT_ERROR_WEIGHT . '<br>';
            $content['weight'] = 0;
        }
        $obj->setVar('content_title', $content['title']);
        $obj->setVar('content_text', $content['text']);
        $obj->setVar('content_weight', $content['weight']);
        $obj->setVar('content_status', $content['status']);
        $obj->setVar('content_mkeyword', $content['mkeyword']);
        $obj->setVar('content_mdescription', $content['mdescription']);
        $obj->setVar('content_maindisplay', $content['maindisplay']);
        $obj->setVar('content_dopdf', $content['dopdf']);
        $obj->setVar('content_doprint', $content['doprint']);
        $obj->setVar('content_dosocial', $content['dosocial']);
        $obj->setVar('content_domail', $content['domail']);
        $obj->setVar('content_dotitle', $content['dotitle']);

        if ($message_error != '') {
            // Define button addItemButton
            $admin_class->addItemButton(_AM_XMCONTENTT_CONTENT_LIST, 'content_.php', 'list');
            $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
            $xoopsTpl->assign('message_error', $message_error);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }else{
            if ($content_Handler->insert($obj)) {
                redirect_header('content.php', 2, _AM_XMCONTENT_REDIRECT_SAVE);
            }else {
                $xoopsTpl->assign('message_error', $obj->getHtmlErrors());
            }
        }
        break;

    // update status
    case 'content_update_status':
        $content_id = XoopsRequest::getInt('content_id', 0);
        if ($content_id > 0) {
            $obj = $content_Handler->get($content_id);
            $old = $obj->getVar('content_status');
            $obj->setVar('content_status', !$old);
            if ($content_Handler->insert($obj)) {
                exit;
            }
            echo $obj->getHtmlErrors();
        }
        break;
}

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontent/templates/admin/xmcontent_content.tpl');
xoops_cp_footer();