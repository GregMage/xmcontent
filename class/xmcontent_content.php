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
use Xmf\Request;
use Xmf\Module\Helper;
use XoopsModules\Xmcontent;

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmcontent_content
 */
class xmcontent_content extends XoopsObject
{
    // constructor
    /**
     * xmcontent_content constructor.
     */
    public function __construct()
    {
        $this->initVar('content_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('content_title', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('content_text', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('content_status', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_mkeyword', XOBJ_DTYPE_TXTAREA, '', false);
        $this->initVar('content_mdescription', XOBJ_DTYPE_TXTAREA, '', false);
        $this->initVar('content_maindisplay', XOBJ_DTYPE_INT, 1, false, 1);
		$this->initVar('content_logo', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('content_weight', XOBJ_DTYPE_INT, 0, false, 5);
		$this->initVar('content_css', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('content_template', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('content_rating', XOBJ_DTYPE_OTHER, null, false, 10);
        $this->initVar('content_votes', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('content_docomment', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dopdf', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_doprint', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dosocial', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dorating', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_domail', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dotitle', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @return mixed
     */
    public function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }

    /**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
        $upload_size = 500000;
		if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		include_once 'list.php';
		$helper = \Xmf\Module\Helper::getHelper('xmcontent');

        //form title
        $title = $this->isNew() ? sprintf(_AM_XMCONTENT_ADD) : sprintf(_AM_XMCONTENT_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('content_id', $this->getVar('content_id')));
            $status = $this->getVar('content_status');
            $weight = $this->getVar('content_weight');
        } else {
            $status = 1;
            $weight = 0;
        }

        // title
        $form->addElement(new XoopsFormText(_AM_XMCONTENT_CONTENT_TITLE, 'content_title', 50, 100, $this->getVar('content_title')), true);
		$form->setExtra('enctype="multipart/form-data"');

        // text
        $editor_configs           = array();
        $editor_configs['name']   = 'content_text';
        $editor_configs['value']  = $this->getVar('content_text', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('admin_editor', 'Plain Text');
		$text = new XoopsFormEditor(_AM_XMCONTENT_CONTENT_TEXT, 'content_text', $editor_configs);
		$text->setDescription(_AM_XMCONTENT_CONTENT_TEXT_DESC);
		if (true == $helper->getConfig('options_template', 0)){
			$form->addElement($text, false);
		} else {
			$form->addElement($text, true);
		}
		//xmdoc
        if (xoops_isActiveModule('xmdoc') && $helper->getConfig('options_xmdoc', 0) == 1) {
            xoops_load('utility', 'xmdoc');
            XmdocUtility::renderDocForm($form, 'xmcontent', $this->getVar('content_id'));
        }
		
		// xmsocial
		if (xoops_isActiveModule('xmsocial') && $helper->getConfig('options_xmsocial_social', 0) == 1) {
			xoops_load('utility', 'xmsocial');
			XmsocialUtility::renderSocialForm($form, 'xmcontent', $this->getVar('content_id'));
		}
		
		// template
		if (true == $helper->getConfig('options_template', 0)){
			$uploadirectory = '/uploads/xmcontent/templates';
			$value_template      = $this->getVar('content_template') ? $this->getVar('content_template') : '';
			$content_template    = new XoopsFormElementTray(_AM_XMCONTENT_CONTENT_TEMPLATE  . '<br /><br />' . sprintf(_AM_XMCONTENT_CONTENT_UPLOADSIZE, $upload_size/1000), '<br />');
			$path_template       = sprintf(_AM_XMCONTENT_CONTENT_PATH, $uploadirectory);
			$list_template       = new XoopsFormSelect($path_template, 'content_template', $value_template);
			$list_file_template  = xmcontent_list::getTemplateListAsArray(XOOPS_ROOT_PATH . $uploadirectory);
			$list_template->addOption("" , '');
			foreach ($list_file_template as $list_file) {
				$list_template->addOption("$list_file", $list_file);
			}
			$content_template->addElement($list_template, false);
			$file_template = new XoopsFormElementTray('<br />', '<br /><br />');
			$file_template->addElement(new XoopsFormFile(_AM_XMCONTENT_CONTENT_UPLOAD, 'content_template', $upload_size), false);
			$file_template->addElement(new XoopsFormLabel(''), false);
			$content_template->addElement($file_template);
			$form->addElement($content_template);
		} else {
			$form->addElement(new XoopsFormHidden('content_template', ''));
		}
		
		// css
		if (true == $helper->getConfig('options_css', 0)){
			$uploadirectory = '/uploads/xmcontent/css';
			$value_css      = $this->getVar('content_css') ? $this->getVar('content_css') : '';
			$content_css    = new XoopsFormElementTray(_AM_XMCONTENT_CONTENT_CSS  . '<br /><br />' . sprintf(_AM_XMCONTENT_CONTENT_UPLOADSIZE, $upload_size/1000), '<br />');
			$path_css       = sprintf(_AM_XMCONTENT_CONTENT_PATH, $uploadirectory);
			$list_css       = new XoopsFormSelect($path_css, 'content_css', $value_css);
			$list_file_css  = xmcontent_list::getCssListAsArray(XOOPS_ROOT_PATH . $uploadirectory);
			$list_css->addOption("" , '');
			foreach ($list_file_css as $list_file) {
				$list_css->addOption("$list_file", $list_file);
			}
			$content_css->addElement($list_css, false);
			$file_css = new XoopsFormElementTray('<br />', '<br /><br />');
			$file_css->addElement(new XoopsFormFile(_AM_XMCONTENT_CONTENT_UPLOAD, 'content_css', $upload_size), false);
			$file_css->addElement(new XoopsFormLabel(''), false);
			$content_css->addElement($file_css);
			$form->addElement($content_css);
		} else {
			$form->addElement(new XoopsFormHidden('content_css', ''));
		}
		
		// logo
        $blank_img       = $this->getVar('content_logo') ?: 'blank.gif';
        $uploadirectory  = '/uploads/xmcontent/images';
        $imgtray_img     = new XoopsFormElementTray(_AM_XMCONTENT_CONTENT_LOGO . '<br><br>' . sprintf(_AM_XMCONTENT_CONTENT_UPLOADSIZE, $upload_size / 1000), '<br>');
        $imgpath_img     = sprintf(_AM_XMCONTENT_CONTENT_PATH, $uploadirectory);
        $imageselect_img = new XoopsFormSelect($imgpath_img, 'content_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadirectory);
        $imageselect_img->addOption("$blank_img", $blank_img);
        foreach ($image_array_img as $image_img) {
            $imageselect_img->addOption("$image_img", $image_img);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"content_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadirectory . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' style='max-width:100px'>"));
        $fileseltray_img = new XoopsFormElementTray('<br>', '<br><br>');
        $fileseltray_img->addElement(new XoopsFormFile(_AM_XMCONTENT_CONTENT_UPLOAD, 'content_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);

        // weight
        $form->addElement(new XoopsFormText(_AM_XMCONTENT_CONTENT_WEIGHT, 'content_weight', 5, 5, $weight), true);

        // status
        $form_status = new XoopsFormRadio(_AM_XMCONTENT_CONTENT_STATUS, 'content_status', $status);
        $options     = array(1 => _AM_XMCONTENT_CONTENT_STATUS_A, 0 => _AM_XMCONTENT_CONTENT_STATUS_NA,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        // keyword
		$keyword = new XoopsFormTextArea(_AM_XMCONTENT_CONTENT_KEYWORD, 'content_mkeyword', $this->getVar('content_mkeyword', 'e'), 2, 60);
		$keyword->setDescription(_AM_XMCONTENT_CONTENT_KEYWORD_DSC);
		$form->addElement($keyword, false);

        // description
		$description = new XoopsFormTextArea(_AM_XMCONTENT_CONTENT_DESCRIPTION, 'content_mdescription', $this->getVar('content_mdescription', 'e'), 2, 60);
		$description->setDescription(_AM_XMCONTENT_CONTENT_DESCRIPTION_DSC);
		$form->addElement($description, false);

        // maindisplay
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_MAINDISPLAY, 'content_maindisplay', $this->getVar('content_maindisplay')));
        
        // docomment
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOCOMMENT, 'content_docomment', $this->getVar('content_docomment')));

        // dopdf for next version (Xoops 2.6)
        //$form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOPDF, 'content_dopdf', $this->getVar('content_dopdf')));
        $form->addElement(new XoopsFormHidden('content_dopdf', 0));

        // doprint for next version (Xoops 2.6)
        //$form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOPRINT, 'content_doprint', $this->getVar('content_doprint')));
        $form->addElement(new XoopsFormHidden('content_doprint', 0));

        // dosocial for next version (Xoops 2.6)
        //$form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOSOCIAL, 'content_dosocial', $this->getVar('content_dosocial')));
        $form->addElement(new XoopsFormHidden('content_dosocial', 0));
		
		// dorating
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DORATING, 'content_dorating', $this->getVar('content_dorating')));

        // domail for next version (Xoops 2.6)
        //$form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOMAIL, 'content_domail', $this->getVar('content_domail')));
        $form->addElement(new XoopsFormHidden('content_domail', 0));

        // dotitle
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOTITLE, 'content_dotitle', $this->getVar('content_dotitle')));

        // permission
		if ($helper->isUserAdmin() == true){
			$permHelper = new Helper\Permission();
			$form->addElement($permHelper->getGroupSelectFormForItem('xmcontent_contentview', $this->getVar('content_id'), _AM_XMCONTENT_CONTENT_GROUPSVIEW, 'xmcontent_contentview_perms', true));
			$form->addElement($permHelper->getGroupSelectFormForItem('xmcontent_contentedit', $this->getVar('content_id'), _AM_XMCONTENT_CONTENT_GROUPSEDIT, 'xmcontent_contentedit_perms', true));
		}
		$form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    /**
     * Returns the url to use to access the category taking into account the preferences of the module
     *
     * @return string The url to use
     */
    public function getLink()
    {
        $helper = Helper::getHelper('xmcontent');
        $rewrite = $helper->getConfig('urlrewriting', 0);
        $url = '';
        if($rewrite == 1) {
            $url = XOOPS_URL . '/' . \Xmf\Metagen::generateSeoTitle($helper->getConfig('rewritename', 'content') . ' ' . $this->getVar('content_id') . ' ' . $this->getVar('content_title', 'n'), '.html');
        } else {
            $url = XOOPS_URL . '/modules/xmcontent/viewcontent.php?content_id=' . $this->getVar('content_id');
        }
        return $url;
    }
	
	public function saveContent($contentHandler, $action = false)
    {
        global $xoopsUser;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';
        $helper = Helper::getHelper('xmcontent');
        $error_message = '';

		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		// test error
        if ((int)$_REQUEST['content_weight'] == 0 && $_REQUEST['content_weight'] != '0') {
            $error_message .= _AM_XMCONTENT_ERROR_WEIGHT . '<br>';
            $this->setVar('content_weight', 0);
        }		
		//css
		if (true == $helper->getConfig('options_css', 0)){
			if (UPLOAD_ERR_NO_FILE != $_FILES['content_css']['error']) {
				$uploader_css = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . '/xmcontent/css/', array('text/css'), $upload_size, null, null);
				if ($uploader_css->fetchMedia('content_css')) {
					if (!$uploader_css->upload()) {
						$message_error .= 'Css -' .$uploader_css->getErrors() . '<br />';
					} else {
						$this->setVar('content_css', $uploader_css->getSavedFileName());
					}
				} else {
					$message_error .= 'Css -' . $uploader_css->getErrors();
				}
			} else {
				$this->setVar('content_css', $_POST['content_css']);
			}
		}else{
			$this->setVar('content_css', '');
		}
		//template
		if (true == $helper->getConfig('options_template', 0)){
			if (UPLOAD_ERR_NO_FILE != $_FILES['content_template']['error']) {
				$uploader_template = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . '/xmcontent/templates/', array('text/html','tpl/html'), $upload_size, null, null);
				if ($uploader_template->fetchMedia('content_template')) {
					if (!$uploader_template->upload()) {
						$message_error .= 'Template -' . $uploader_template->getErrors() . '<br />';
					} else {
						$this->setVar('content_template', $uploader_template->getSavedFileName());
					}
				} else {
					$message_error .= 'Template -' . $uploader_template->getErrors();
				}
			} else {
				$this->setVar('content_template', $_POST['content_template']);
			}
		}else{
			$this->setVar('content_template', '');
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
                    $this->setVar('content_logo', $uploader_content_img->getSavedFileName());
                }
            } else {
                $message_error .= $uploader_content_img->getErrors();
            }
        } else {
            $this->setVar('content_logo', Xmf\Request::getString('content_logo', ''));
        }
		
        $this->setVar('content_title', Request::getString('content_title', ''));
        $this->setVar('content_text', Request::getText('content_text', ''));
        $this->setVar('content_status', Request::getInt('content_status', 0));
		$this->setVar('content_mkeyword', Request::getString('content_mkeyword', ''));
		$this->setVar('content_mdescription', Request::getString('content_mdescription', ''));
        $this->setVar('content_maindisplay', Request::getInt('content_maindisplay', 1));
        $this->setVar('content_docomment', Request::getInt('content_docomment', 1));
        $this->setVar('content_dopdf', Request::getInt('content_dopdf', 1));
        $this->setVar('content_doprint', Request::getInt('content_doprint', 1));
        $this->setVar('content_dosocial', Request::getInt('content_dosocial', 1));
        $this->setVar('content_dorating', Request::getInt('content_dorating', 1));
        $this->setVar('content_domail', Request::getInt('content_domail', 1));
        $this->setVar('content_dotitle', Request::getInt('content_dotitle', 1));
		$this->setVar('content_weight', Request::getInt('content_weight', 0));
        if ($error_message == '') {
            if ($contentHandler->insert($this)) {
				// permissions
				if ($this->get_new_enreg() == 0){
					$content_id = $this->getVar('content_id');
				} else {
					$content_id = $this->get_new_enreg();
				}
                $permHelper = new Helper\Permission();
                // permission xmcontent_contentview
                $groups_view = Request::getArray('xmcontent_contentview_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmcontent_contentview', $content_id, $groups_view);
				// permission xmcontent_contentedit
                $groups_edit = Request::getArray('xmcontent_contentedit_perms', [], 'POST');
                $permHelper->savePermissionForItem('xmcontent_contentedit', $content_id, $groups_edit);

				//xmdoc
                if (xoops_isActiveModule('xmdoc') && $helper->getConfig('options_xmdoc', 0) == 1) {
                    xoops_load('utility', 'xmdoc');
                    $error_message .= XmdocUtility::saveDocuments('xmcontent', $content_id);
                }
				// xmsocial
				if (xoops_isActiveModule('xmsocial') && $helper->getConfig('options_xmsocial_social', 0) == 1) {
					xoops_load('utility', 'xmsocial');
					$error_message .= XmsocialUtility::saveSocial('xmcontent', $content_id);
				}
				if ($action == 'viewcontent.php'){
					redirect_header('viewcontent.php?content_id=' . $content_id, 2, _AM_XMCONTENT_REDIRECT_SAVE);
				} else {
					redirect_header($action, 2, _AM_XMCONTENT_REDIRECT_SAVE);
				}
            } else {
                $error_message =  $this->getHtmlErrors();
            }
        }
        return $error_message;
    }
}

/**
 * Class xmcontentxmcontent_contentHandler
 */
class xmcontentxmcontent_contentHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmcontentxmcontent_contentHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'xmcontent_content', 'xmcontent_content', 'content_id', 'content_title');
    }
}
