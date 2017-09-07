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

function xmcontent_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    $sql = "SELECT content_id, content_title, content_text FROM ".$xoopsDB->prefix("xmcontent_content")." WHERE content_status != 0";

    if ( is_array($queryarray) && $count = count($queryarray) )
    {
        $sql .= " AND ((content_title LIKE '%$queryarray[0]%' OR content_text LIKE '%$queryarray[0]%')";

        for($i=1;$i<$count;$i++)
        {
            $sql .= " $andor ";
            $sql .= "(content_title LIKE '%$queryarray[$i]%' OR content_text LIKE '%$queryarray[$i]%')";
        }
        $sql .= ")";
    }

    $sql .= " ORDER BY content_weight DESC";
    $result = $xoopsDB->query($sql,$limit,$offset);
    $ret = array();
    $i = 0;
    while($myrow = $xoopsDB->fetchArray($result))
    {
        $ret[$i]["image"] = "assets/images/xmcontent_search.png";
        $ret[$i]["link"] = "viewcontent.php?content_id=" . $myrow["content_id"];
        $ret[$i]["title"] = $myrow["content_title"];
        $i++;
    }

    return $ret;
}