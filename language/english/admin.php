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
// all
define('_AM_XMCONTENT_ACTION', 'Action');
define('_AM_XMCONTENT_ADD', 'Add');
define('_AM_XMCONTENT_CLONE', 'Clone');
define('_AM_XMCONTENT_CONTENT_COPY', 'Copy: ');
define('_AM_XMCONTENT_DEL', 'Delete');
define('_AM_XMCONTENT_EDIT', 'Edit');
define('_AM_XMCONTENT_NO', 'No');
define('_AM_XMCONTENT_REDIRECT_SAVE', 'Successfully saved');
define('_AM_XMCONTENT_YES', 'Yes');
define('_AM_XMCONTENT_VIEW', 'View Details');

// index
define('_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED', 'You have not installed the xmdoc module, this module is required if you want to add documents to your content');
define('_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE', 'You must enable in xmcontent preferences the use of xmdoc (if you want to add documents)');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTINSTALLED', 'You have not installed the xmsocial module, this module is required if you want to rate content or to add social media');
define('_MA_XMNEWS_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATE', 'You must enable in preferences the use of xmsocial (if you want to rate content)');
define('_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATESOCIAL', 'You must activate the use of xmsocial in the module preferences (if you want to add social media) ');

// content
define('_AM_XMCONTENT_CONTENT_ADD', 'Add a content');
define('_AM_XMCONTENT_CONTENT_CSS', 'CSS file');
define('_AM_XMCONTENT_CONTENT_DESCRIPTION', 'Meta description');
define('_AM_XMCONTENT_CONTENT_DESCRIPTION_DSC', 'The meta description tag provides a description to search engines for displaying results.');
define('_AM_XMCONTENT_CONTENT_DOCOMMENT', 'View comments');
define('_AM_XMCONTENT_CONTENT_DOMAIL', 'View the mail icon');
define('_AM_XMCONTENT_CONTENT_DOPDF', 'View the pdf icon');
define('_AM_XMCONTENT_CONTENT_DOPRINT', 'View the print icon');
define('_AM_XMCONTENT_CONTENT_DORATING', 'View rating');
define('_AM_XMCONTENT_CONTENT_DOSOCIAL', 'View social icons');
define('_AM_XMCONTENT_CONTENT_DOTITLE', 'Show Title');
define('_AM_XMCONTENT_CONTENT_GROUPSVIEW', 'Select groups that can view this content');
define('_AM_XMCONTENT_CONTENT_GROUPSEDIT', 'Select groups that can edit this content');
define('_AM_XMCONTENT_CONTENT_INFORMATION', 'Informations');
define('_AM_XMCONTENT_CONTENT_KEYWORD', 'Meta keywords');
define('_AM_XMCONTENT_CONTENT_KEYWORD_DSC', 'The keywords meta tag is a series of keywords that represents the content of your news. Type in keywords with each separated by a comma in between. (Ex. XOOPS, PHP, mySQL, portal system).');
define('_AM_XMCONTENT_CONTENT_LIST', 'List of content');
define('_AM_XMCONTENT_CONTENT_LOGO', 'Logo file');
define('_AM_XMCONTENT_CONTENT_MAINDISPLAY', 'Displayed on the main page');
define('_AM_XMCONTENT_CONTENT_PATH', 'Files are in: %s');
define('_AM_XMCONTENT_CONTENT_STATUS', 'Status');
define('_AM_XMCONTENT_CONTENT_STATUS_A', 'Active');
define('_AM_XMCONTENT_CONTENT_STATUS_NA', 'Disabled');
define('_AM_XMCONTENT_CONTENT_SUREDEL', 'Sure to delete this content? %s');
define('_AM_XMCONTENT_CONTENT_SURECLONE', 'Sure to clone this content? %s');
define('_AM_XMCONTENT_CONTENT_TEMPLATE', 'Template file');
define('_AM_XMCONTENT_CONTENT_TEXT', "Text");
define('_AM_XMCONTENT_CONTENT_TEXT_DESC', "Use the delimiter <span style='color:orange'>[break_dsc]</span> to define the size of the short description.<br> The short description is used in the homepage of the module
<br><br>Use the delimiter <span style='color:orange'>[pageid=X]</span> to include another xmcontent page in this page. <span style='color:orange'>X</span><br>is the page id<br>
<span style='color:red'>Important:</span> Cascading inclusions (page 1 which includes page 2 which includes page 3) does not work. Inclusions in the short description on the module index page do not work.");
define('_AM_XMCONTENT_CONTENT_TITLE', 'Title');
define('_AM_XMCONTENT_CONTENT_UPLOAD', 'Upload');
define('_AM_XMCONTENT_CONTENT_UPLOADSIZE', 'Maximum size: %s kB');
define('_AM_XMCONTENT_CONTENT_WEIGHT', 'Weight');

// permission
define('_AM_XMCONTENT_PERMISSION_VIEW', 'View permissions');
define('_AM_XMCONTENT_PERMISSION_VIEW_DSC', 'Choose the groups that can see the following content');
define('_AM_XMCONTENT_PERMISSION_EDIT', 'Modify permissions');
define('_AM_XMCONTENT_PERMISSION_EDIT_DSC', 'Choose the groups that can modify the following content');

// error
define('_AM_XMCONTENT_ERROR_CONTENT', 'There are no contents in the database');
define('_AM_XMCONTENT_ERROR_WEIGHT', 'Weight must be a number');
define('_AM_XMCONTENT_ERROR_INCLUDE', 'The page with id %s could not be included!');
