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


// IMPORTANT: The basis of this class comes from "Publisher"

xoops_load('XoopsForm');

/**
 * Form that will output formatted as a HTML table
 *
 * No styles and no JavaScript to check for required fields.
 */
class XmcontentBlockForm extends XoopsForm
{
    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct('', '', '');
    }

    /**
     * render
     *
     * @return string
     */
    public function render()
    {
        $ret = '<table border="0" width="100%">' . NWLINE;
        foreach ($this->getElements() as $ele) {
            if (!$ele->isHidden()) {
				$ret .= '<tr><td style="vertical-align: top; width: 250px;">';
				$ret .= '<span style="font-weight: bold;">' . $ele->getCaption() . '</span>';
				if (isset($eleDesc) && $eleDesc == $ele->getDescription()) {
					$ret .= '<br><br><span style="font-weight: normal;">' . $eleDesc . '</span>';
				}
				$ret .= '</td><td>' . $ele->render() . '</td></tr>';
            } else {
				$ret .= $ele->render();
			}
        }
        $ret .= '</table>';

        return $ret;
    }
}
