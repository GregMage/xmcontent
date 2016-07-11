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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class xmcontent_content extends XoopsObject
{
// constructor
    function __construct()
    {
        $this->initVar('content_id',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('content_title',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('content_text',XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('content_status', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_mkeyword', XOBJ_DTYPE_TXTAREA, '', false);
        $this->initVar('content_mdescription', XOBJ_DTYPE_TXTAREA, '', false);
        $this->initVar('content_maindisplay', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_weight', XOBJ_DTYPE_INT, 0, false, 5);
        $this->initVar('content_dopdf', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_doprint', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dosocial', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_domail', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('content_dotitle', XOBJ_DTYPE_INT, 1, false, 1);
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }
    function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }
    function xmcontent_content()
    {
        $this->__construct();
    }
    function getForm($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
        
        $form = new XoopsThemeForm(_AM_XMCONTACT_EDITSTATUS, 'form', $action, 'post', true);
        
        // submitter
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBMITTER, $this->getVar('request_name'), 'name'));
        // subject
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBJECT, $this->getVar('request_subject'), 'subject'));    
        // status
        $status = new XoopsFormRadio(_AM_XMCONTACT_STATUS, 'request_status', $this->getVar('request_status'));
        $options = array('0' =>_AM_XMCONTACT_REQUEST_STATUS_NR, '1' => _AM_XMCONTACT_REQUEST_STATUS_R);
        $status->addOptionArray($options);
        $form->addElement($status);

        $form->addElement(new XoopsFormHidden('request_id', $this->getVar('request_id')));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

class xmcontentxmcontent_contentHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "xmcontent_content", 'xmcontent_content', 'content_id', 'content_title');
    }
}