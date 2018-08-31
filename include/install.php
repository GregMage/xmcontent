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

function xoops_module_install_xmcontent()
{
    $namemodule = 'xmcontent';
	$indexFile = XOOPS_ROOT_PATH . '/modules/' . $namemodule . '/include/index.html';
    $blankFile = XOOPS_ROOT_PATH . '/modules/' . $namemodule . '/assets/images/blank.gif';
    //Creation ".$namemodule."/
    $dir = XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '';
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
		copy($indexFile, XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/index.html');
    }
    chmod($dir, 0777);

    //Creation ".$namemodule."/css/
    $dir = XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/css';
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
		copy($indexFile, XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/css/index.html');
    }
    chmod($dir, 0777);
    
    //Creation ".$namemodule."/templates
    $dir = XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/templates';
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
		copy($indexFile, XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/templates/index.html');
    }
    chmod($dir, 0777);
	
	//Creation ".$namemodule."/images
    $dir = XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/images';
    if (!is_dir($dir)) {
        mkdir($dir, 0777);
		copy($indexFile, XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/images/index.html');
    }
    chmod($dir, 0777);
	
	//Copy blank.gif		
	copy($blankFile, XOOPS_ROOT_PATH . '/uploads/' . $namemodule . '/images/blank.gif');
    return true;
}
