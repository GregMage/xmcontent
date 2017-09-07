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

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

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
        $this->initVar('content_weight', XOBJ_DTYPE_INT, 0, false, 5);
		$this->initVar('content_css', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('content_template', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('content_docomment', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dopdf', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_doprint', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dosocial', XOBJ_DTYPE_INT, 1, false, 1);
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
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		include_once 'list.php';
        global $xoopsModuleConfig;

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
        $form->addElement(new XoopsFormText(_AM_XMCONTENT_CONTENT_TITLE, 'content_title', 50, 255, $this->getVar('content_title')), true);
		$form->setExtra('enctype="multipart/form-data"');

        // text
        $editor_configs           = array();
        $editor_configs['name']   = 'content_text';
        $editor_configs['value']  = $this->getVar('content_text', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $xoopsModuleConfig['admin_editor'];
        $form->addElement(new XoopsFormEditor(_AM_XMCONTENT_CONTENT_TEXT, 'content_text', $editor_configs), true);

        // weight
        $form->addElement(new XoopsFormText(_AM_XMCONTENT_CONTENT_WEIGHT, 'content_weight', 5, 5, $weight), true);

        // status
        $form_status = new XoopsFormRadio(_AM_XMCONTENT_CONTENT_STATUS, 'content_status', $status);
        $options     = array(1 => _AM_XMCONTENT_CONTENT_STATUS_A, 0 => _AM_XMCONTENT_CONTENT_STATUS_NA,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        // keyword
        $form->addElement(new XoopsFormTextArea(_AM_XMCONTENT_CONTENT_KEYWORD, 'content_mkeyword', $this->getVar('content_mkeyword', 'e'), 2, 60), false);

        // description
        $form->addElement(new XoopsFormTextArea(_AM_XMCONTENT_CONTENT_DESCRIPTION, 'content_mdescription', $this->getVar('content_mdescription', 'e'), 2, 60), false);

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

        // domail for next version (Xoops 2.6)
        //$form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOMAIL, 'content_domail', $this->getVar('content_domail')));
        $form->addElement(new XoopsFormHidden('content_domail', 0));

        // dotitle
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTENT_CONTENT_DOTITLE, 'content_dotitle', $this->getVar('content_dotitle')));
		
		// css
		if ($xoopsModuleConfig['options_css'] == true){
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
		
		// template
		if ($xoopsModuleConfig['options_template'] == true){
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

        // permission
        $memberHandler = xoops_getHandler('member');
        $group_list     = $memberHandler->getGroupList();
        $gpermHandler  = xoops_getHandler('groupperm');
        $full_list      = array_keys($group_list);
        global $xoopsModule;
        if (!$this->isNew()) {
            $groups_ids_view               = $gpermHandler->getGroupIds('xmcontent_contentview', $this->getVar('content_id'), $xoopsModule->getVar('mid'));
            $groups_ids_view               = array_values($groups_ids_view);
            $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_XMCONTENT_CONTENT_GROUPSVIEW, 'groups_view[]', $groups_ids_view);
        } else {
            $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_XMCONTENT_CONTENT_GROUPSVIEW, 'groups_view[]', $full_list);
        }
        $groups_news_can_view_checkbox->addOptionArray($group_list);
        $form->addElement($groups_news_can_view_checkbox);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
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
