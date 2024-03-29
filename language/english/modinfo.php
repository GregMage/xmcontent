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
// The name of this module
define('_MI_XMCONTENT_NAME', 'Content');
define('_MI_XMCONTENT_DESC', 'Content module');

// Admin menu
define('_MI_XMCONTENT_MENU_HOME', 'Home');
define('_MI_XMCONTENT_MENU_HOME_DESC', 'Go back to homepage');
define('_MI_XMCONTENT_MENU_CONTENT', 'Contents');
define('_MI_XMCONTENT_MENU_CONTENT_DESC', 'List of contents');
define('_MI_XMCONTENT_MENU_PERMISSION', 'Permissions');
define('_MI_XMCONTENT_MENU_ABOUT', 'About');
define('_MI_XMCONTENT_MENU_ABOUT_DESC', 'About this module');
define('_MI_XMCONTENT_MENU_HELP', 'Help');
define('_MI_XMCONTENT_MENU_HELP_DESC', 'Module help');

// Block
define('_MI_XMCONTENT_BLOCK_DEFAULT', 'Content');
define('_MI_XMCONTENT_BLOCK_DEFAULT_DESC', 'Display a content');

// Pref.
define('_MI_XMCONTENT_PREF_HEAD_REWRITE',"<span style='font-size: large; font-weight: bold;'>URL Rewrite</span>");
define('_MI_XMCONTENT_PREF_REWRITE','Use URL Rewriting ?');
define('_MI_XMCONTENT_PREF_REWRITE_DESC','Activate the URL Rewriting for all the module');
define('_MI_XMCONTENT_PREF_REWRITE_NAME','Name display in the URL');
define('_MI_XMCONTENT_PREF_REWRITE_NAME_DESC','The name must be the same in .htaccess file');
define('_MI_XMCONTENT_PREF_HEAD_INDEX', "<span style='font-size: large; font-weight: bold;'>Index</span>");
define('_MI_XMCONTENT_PREF_COLUMNCONTENT', 'Number of column for content View');
define('_MI_XMCONTENT_PREF_COLUMNCONTENT_DESC', 'Number of content that can be viewed in index: 1, 2, 3 or 4 columns');
define('_MI_XMCONTENT_PREF_CONTENTINDEX', 'Content to display on index page');
define('_MI_XMCONTENT_PREF_CONTENTINDEX_ALL', 'All contents');
define('_MI_XMCONTENT_PREF_CONTENTINDEX_DESC', 'Choose the content to display. To display all contents, you have to update the module!');
define('_MI_XMCONTENT_PREF_HEADER', 'Header index page');
define('_MI_XMCONTENT_PREF_HEADER_DESC', 'Set HTML codes to show in index page');
define('_MI_XMCONTENT_PREF_FOOTER', 'Footer index page');
define('_MI_XMCONTENT_PREF_FOOTER_DESC', 'Set HTML codes to show in index page');
define('_MI_XMCONTENT_PREF_INDEXPERPAGE', 'Number of items per page in the Index view');
define('_MI_XMCONTENT_PREF_HEAD_OPTIONS', "<span style='font-size: large; font-weight: bold;'>Options</span>");
define('_MI_XMCONTENT_PREF_CSS', 'Use a css file personalized by content');
define('_MI_XMCONTENT_PREF_CSS_DESC', 'If this option is enabled, you can add a custom css to a content');
define('_MI_XMCONTENT_PREF_TEMPLATE', 'Use a template file personalized by content');
define('_MI_XMCONTENT_PREF_TEMPLATE_DESC', 'If this option is enabled, you can add a custom template to a content');
define('_MI_XMCONTENT_PREF_XMDOC', 'Use xmdoc module to add document');
define('_MI_XMCONTENT_PREF_XMSOCIAL', 'Use xmsocial module to rate content');
define('_MI_XMCONTENT_PREF_XMSOCIALSOCIAL', 'Use the xmsocial module to display sharing links for social networks');
define('_MI_XMCONTENT_PREF_WARNING', 'Warning message if the user does not have access to the content that is included');
define('_MI_XMCONTENT_PREF_WARNING_DESC', 'The message is used to inform the user that he does not have access to certain pages included in the main page (inclusion with the delimiter <span style="color:orange">[pageid=X]</span>. If you don\'t want a message, leave this field blank.');
define('_MI_XMCONTENT_PREF_WARNING_DEFAULT', 'You don\'t have access to the whole page!');
define('_MI_XMCONTENT_PREF_INCLUDE', 'Display an error message if a page cannot be included');
define('_MI_XMCONTENT_PREF_INCLUDE_DESC', 'If a page cannot be included with the delimiter <span style="color:orange">[pageid=X]</span> (non-existent page, id error, ...), an error message appears at the bottom of the main page (only for administrators).');
define('_MI_XMCONTENT_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMCONTENT_PREF_EDITOR', 'Text Editor');
define('_MI_XMCONTENT_PREF_ADMINPERPAGE', 'Number of items per page in the Admin view');
