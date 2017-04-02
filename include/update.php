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

function xoops_module_update_xmcontent(XoopsModule $module, $previousVersion = null) {
    echo 'Version ' . $previousVersion;
    // Passage de la version 0.1 à 0.2
    if ($previousVersion <= 20) {
        //Ajout des champs content_css et content_template (Passage de la version 0.1 à 0.2)
        $db = XoopsDatabaseFactory::getDatabaseConnection();
        $sql = "ALTER TABLE `" . $db->prefix('xmcontent_content') . "` ADD `content_css` VARCHAR( 255 ) NOT NULL;";
        $db->query($sql);
        $sql = "ALTER TABLE `" . $db->prefix('xmcontent_content') . "` ADD `content_template` VARCHAR( 255 ) NOT NULL;";
        $db->query($sql);
        
        //Ajout de plusieurs dossiers dans uploads (Passage de la version 0.1 à 0.2)
        $namemodule = 'xmcontent';
        $indexFile = XOOPS_ROOT_PATH . '/modules/' . $namemodule . '/include/index.html';
        
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
    }
    // Passage de la version 0.21 à 0.3
    if ($previousVersion <= 21) {
        $db = XoopsDatabaseFactory::getDatabaseConnection();
        $sql = "ALTER TABLE `" . $db->prefix('xmcontent_content') . "` ADD `content_docomment` TINYINT( 1 ) NOT NULL DEFAULT '0';";
        $db->query($sql);
    }
    return true;
}