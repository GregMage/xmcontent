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
use Xmf\Module\Helper;
/**
 * Class XmnewsUtility
 */
class XmcontentUtility
{

	public static function includeContent($text)
    {
		include __DIR__ . '/../include/common.php';
		$helper = Helper::getHelper('xmcontent');
		$permHelper = new Helper\Permission('xmcontent');
		$nb_pageid = mb_substr_count($text, '[pageid=');
		$error_include = '';
		$warning_include = '';
		if ($nb_pageid > 0){
			for ($i = 1; $i <= $nb_pageid; $i++) {
				$pos_d = strpos($text,'[pageid=') + 8;
				$pos_f = strpos($text,']', $pos_d) - $pos_d;
				$id = substr($text, $pos_d, $pos_f);
				if (mb_substr_count($text, '[pageid=' . $id . ']') > 1){
					$nb_pageid = $nb_pageid - (mb_substr_count($text, '[pageid=' . $id . ']') - 1);
				}
				if ($permHelper->checkPermission('xmcontent_contentview', $id) === false){
					$text = str_replace('[pageid=' . $id . ']', '', $text);
					if($helper->getConfig('options_warning', '') != ''){
						$warning_include = $helper->getConfig('options_warning', '');
					}
				} else {
					$includecontent = $contentHandler->get($id);
					if (empty($includecontent)) {
						$newtext = '';
						if($helper->getConfig('options_include', 0) == 1){
							$error_include .= sprintf(_AM_XMCONTENT_ERROR_INCLUDE, $id) . '<br>'; 
						}
					} else {
						$newtext = str_replace('[break_dsc]', '', $includecontent->getVar('content_text', 'show'));
					}	
					// Vérification pour empécher les includes multiples
					$new_nb_pageid = mb_substr_count($newtext, '[pageid=');
					if ($new_nb_pageid > 0){
						for ($j = 1; $j <= $new_nb_pageid; $j++) {
							$pos_d = strpos($newtext,'[pageid=') + 8;
							$pos_f = strpos($newtext,']', $pos_d) - $pos_d;
							$newid = substr($newtext, $pos_d, $pos_f);
							$newtext = str_replace('[pageid=' . $newid . ']', '', $newtext);
						}
					}			
					$text = str_replace('[pageid=' . $id . ']', $newtext, $text);
				}
			}
		}
		$content['text'] = $text;
		$content['error'] = $error_include;
		$content['warning'] = $warning_include;
        return $content;
    }
}
