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
 * Class xmcontent_list
 */
class xmcontent_list extends XoopsLists
{
	/**
	 * gets list of css file names in a certain directory
	 * @param        $dirname
	 * @param string $prefix
	 * @return array
	 */
	public static function getCssListAsArray($dirname, $prefix = '')
	{
		$filelist = array();
		if ($handle = opendir($dirname)) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/(\.css)$/i', $file) && !is_dir($file)) {
					$file            = $prefix . $file;
					$filelist[$file] = $prefix . $file;
				}
			}
			closedir($handle);
			asort($filelist);
			reset($filelist);
		}

		return $filelist;
	}
		/**
	 * gets list of template file names in a certain directory
	 * @param        $dirname
	 * @param string $prefix
	 * @return array
	 */
	public static function getTemplateListAsArray($dirname, $prefix = '')
	{
		$filelist = array();
		if ($handle = opendir($dirname)) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/(\.htm|\.html|\.xhtml|\.tpl)$/i', $file) && !is_dir($file)) {
					if ("index.html" != $file){
						$file            = $prefix . $file;
						$filelist[$file] = $prefix . $file;
					}
				}
			}
			closedir($handle);
			asort($filelist);
			reset($filelist);
		}

		return $filelist;
	}
}
