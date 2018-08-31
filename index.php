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
include __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'xmcontent_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$keywords = '';

$xoopsTpl->assign('index_header', $xoopsModuleConfig['index_header']);
$xoopsTpl->assign('index_footer', $xoopsModuleConfig['index_footer']);
$xoopsTpl->assign('index_columncontent', $xoopsModuleConfig['index_columncontent']);
// Get start pager
$start = XoopsRequest::getInt('start', 0);
// Criteria
$criteria = new CriteriaCompo();
$criteria->setSort('content_weight ASC, content_title');
$criteria->setOrder('ASC');
$criteria->setStart($start);
$criteria->setLimit($nb_limit);
$criteria->add(new Criteria('content_status', 1));
$criteria->add(new Criteria('content_maindisplay', 1));
$content_arr         = $contentHandler->getall($criteria);
$content_count_total = $contentHandler->getCount($criteria);
$content_count       = count($content_arr);
$xoopsTpl->assign('content_count', $content_count);
$count     = 1;
$count_row = 1;
if ($content_count > 0) {
    foreach (array_keys($content_arr) as $i) {
        $content_id       = $content_arr[$i]->getVar('content_id');
        $content['id']    = $content_id;
        $content['title'] = $content_arr[$i]->getVar('content_title');
        $content['logo'] = $url_logo . $content_arr[$i]->getVar('content_logo');
		$text             = $content_arr[$i]->getVar('content_text');		
		//short description
		if (true == $helper->getConfig('options_template', 0) && '' != $content_arr[$i]->getVar('content_template')){
			if (false == strpos($text, '[break_dsc]')){
				$content['text'] = $text;
			}else{
				$content['text'] = substr($text,0,strpos($text,'[break_dsc]'));
			}
		} else {
			if (false == strpos($text, '[break_dsc]')){
				$content['text'] = '';
			}else{
				$content['text'] = substr($text,0,strpos($text,'[break_dsc]'));
			}
		}		
        $content['count'] = $count;
        if ($count_row == $count) {
            $content['row'] = true;
            $count_row      = $count_row + $xoopsModuleConfig['index_columncontent'];
        } else {
            $content['row'] = false;
        }
        if ($count == $content_count) {
            $content['end'] = true;
        } else {
            $content['end'] = false;
        }
        $xoopsTpl->append_by_ref('content', $content);
        $count++;
        $keywords .= $content['title'] . ',';
        unset($content);
    }
    // Display Page Navigation
    if ($content_count_total > $nb_limit) {
        $nav = new XoopsPageNav($content_count_total, $nb_limit, $start, 'start');
        $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
    }
}
//SEO
//description
$xoTheme->addMeta('meta', 'description', strip_tags($xoopsModule->name()));
//keywords
$keywords = substr($keywords, 0, -1);
$xoTheme->addMeta('meta', 'keywords', $keywords);

include XOOPS_ROOT_PATH . '/footer.php';
