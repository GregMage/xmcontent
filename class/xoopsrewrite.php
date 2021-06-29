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
 * Rewrite class for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        class
 * @since          1.0
 * @min_xoops      2.5.10
 * @author         ForMuss - Email:<nicolas.andricq@gmail.com> - Website:<http://xoops.org>
 */



 class XoopsRewrite 
 {
    /**
     * Create title for URL rewrite
     *
     * @param  string $content  Text for create URL
     * @param int     $urw      La limite basse pour créer les mots
     * @return string  URL text
     * 
     */
    public static function makeSeoUrl($content, $urw = 1)
    {
        $s       = "ÀÁÂÃÄÅÒÓÔÕÖØÈÉÊËÇÌÍÎÏÙÚÛÜÑàáâãäåòóôõöøèéêëçìíîïùúûüÿñ '()";
        $r       = 'AAAAAAOOOOOOEEEECIIIIUUUUYNaaaaaaooooooeeeeciiiiuuuuyn----';
        $content = static::unhtml($content); // First, remove html entities
        $content = strtr($content, $s, $r);
        $content = strip_tags($content);
        $content = mb_strtolower($content);
        $content = htmlentities($content, ENT_QUOTES | ENT_HTML5); // TODO: Vérifier
        $content = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $content);
        $content = html_entity_decode($content);
        $content = str_ireplace('quot', ' ', $content);
        $content = preg_replace("/'/i", ' ', $content);
        $content = preg_replace('/-/i', ' ', $content);
        $content = preg_replace('/[[:punct:]]/i', '', $content);

        // Selon option mais attention au fichier .htaccess !
        // $content = eregi_replace('[[:digit:]]','', $content);
        $content = preg_replace('/[^a-z|A-Z|0-9]/', '-', $content);

        $words    = explode(' ', $content);
        $keywords = '';
        foreach ($words as $word) {
            if (mb_strlen($word) >= $urw) {
                $keywords .= '-' . trim($word);
            }
        }
        if (!$keywords) {
            $keywords = '-';
        }
        // Supprime les tirets en double
        $keywords = str_replace('---', '-', $keywords);
        $keywords = str_replace('--', '-', $keywords);
        // Supprime un éventuel tiret à la fin de la chaine
        if ('-' == mb_substr($keywords, mb_strlen($keywords) - 1, 1)) {
            $keywords = mb_substr($keywords, 0, -1);
        }

        return $keywords;
    }

    /**
     * Replace html entities with their ASCII equivalent
     *
     * @param  string $chaine The string undecode
     * @return string The undecoded string
     */
    public static function unhtml($chaine)
    {
        $search = $replace = [];
        $chaine = html_entity_decode($chaine);

        for ($i = 0; $i <= 255; ++$i) {
            $search[]  = '&#' . $i . ';';
            $replace[] = chr($i);
        }
        $replace[] = '...';
        $search[]  = '';
        $replace[] = "'";
        $search[]  = '';
        $replace[] = "'";
        $search[]  = '';
        $replace[] = '-';
        $search[]  = '&bull;'; // $replace[] = '';
        $replace[] = '';
        $search[]  = '&mdash;';
        $replace[] = '-';
        $search[]  = '&ndash;';
        $replace[] = '-';
        $search[]  = '&shy;';
        $replace[] = '"';
        $search[]  = '&quot;';
        $replace[] = '&';
        $search[]  = '&amp;';
        $replace[] = '';
        $search[]  = '&circ;';
        $replace[] = '¡';
        $search[]  = '&iexcl;';
        $replace[] = '¦';
        $search[]  = '&brvbar;';
        $replace[] = '¨';
        $search[]  = '&uml;';
        $replace[] = '¯';
        $search[]  = '&macr;';
        $replace[] = '´';
        $search[]  = '&acute;';
        $replace[] = '¸';
        $search[]  = '&cedil;';
        $replace[] = '¿';
        $search[]  = '&iquest;';
        $replace[] = '';
        $search[]  = '&tilde;';
        $replace[] = "'";
        $search[]  = '&lsquo;'; // $replace[]='';
        $replace[] = "'";
        $search[]  = '&rsquo;'; // $replace[]='';
        $replace[] = '';
        $search[]  = '&sbquo;';
        $replace[] = "'";
        $search[]  = '&ldquo;'; // $replace[]='';
        $replace[] = "'";
        $search[]  = '&rdquo;'; // $replace[]='';
        $replace[] = '';
        $search[]  = '&bdquo;';
        $replace[] = '';
        $search[]  = '&lsaquo;';
        $replace[] = '';
        $search[]  = '&rsaquo;';
        $replace[] = '<';
        $search[]  = '&lt;';
        $replace[] = '>';
        $search[]  = '&gt;';
        $replace[] = '±';
        $search[]  = '&plusmn;';
        $replace[] = '«';
        $search[]  = '&laquo;';
        $replace[] = '»';
        $search[]  = '&raquo;';
        $replace[] = '×';
        $search[]  = '&times;';
        $replace[] = '÷';
        $search[]  = '&divide;';
        $replace[] = '¢';
        $search[]  = '&cent;';
        $replace[] = '£';
        $search[]  = '&pound;';
        $replace[] = '¤';
        $search[]  = '&curren;';
        $replace[] = '¥';
        $search[]  = '&yen;';
        $replace[] = '§';
        $search[]  = '&sect;';
        $replace[] = '©';
        $search[]  = '&copy;';
        $replace[] = '¬';
        $search[]  = '&not;';
        $replace[] = '®';
        $search[]  = '&reg;';
        $replace[] = '°';
        $search[]  = '&deg;';
        $replace[] = 'µ';
        $search[]  = '&micro;';
        $replace[] = '¶';
        $search[]  = '&para;';
        $replace[] = '·';
        $search[]  = '&middot;';
        $replace[] = '';
        $search[]  = '&dagger;';
        $replace[] = '';
        $search[]  = '&Dagger;';
        $replace[] = '';
        $search[]  = '&permil;';
        $replace[] = 'Euro';
        $search[]  = '&euro;'; // $replace[]=''
        $replace[] = '¼';
        $search[]  = '&frac14;';
        $replace[] = '½';
        $search[]  = '&frac12;';
        $replace[] = '¾';
        $search[]  = '&frac34;';
        $replace[] = '¹';
        $search[]  = '&sup1;';
        $replace[] = '²';
        $search[]  = '&sup2;';
        $replace[] = '³';
        $search[]  = '&sup3;';
        $replace[] = 'á';
        $search[]  = '&aacute;';
        $replace[] = 'Á';
        $search[]  = '&Aacute;';
        $replace[] = 'â';
        $search[]  = '&acirc;';
        $replace[] = 'Â';
        $search[]  = '&Acirc;';
        $replace[] = 'à';
        $search[]  = '&agrave;';
        $replace[] = 'À';
        $search[]  = '&Agrave;';
        $replace[] = 'å';
        $search[]  = '&aring;';
        $replace[] = 'Å';
        $search[]  = '&Aring;';
        $replace[] = 'ã';
        $search[]  = '&atilde;';
        $replace[] = 'Ã';
        $search[]  = '&Atilde;';
        $replace[] = 'ä';
        $search[]  = '&auml;';
        $replace[] = 'Ä';
        $search[]  = '&Auml;';
        $replace[] = 'ª';
        $search[]  = '&ordf;';
        $replace[] = 'æ';
        $search[]  = '&aelig;';
        $replace[] = 'Æ';
        $search[]  = '&AElig;';
        $replace[] = 'ç';
        $search[]  = '&ccedil;';
        $replace[] = 'Ç';
        $search[]  = '&Ccedil;';
        $replace[] = 'ð';
        $search[]  = '&eth;';
        $replace[] = 'Ð';
        $search[]  = '&ETH;';
        $replace[] = 'é';
        $search[]  = '&eacute;';
        $replace[] = 'É';
        $search[]  = '&Eacute;';
        $replace[] = 'ê';
        $search[]  = '&ecirc;';
        $replace[] = 'Ê';
        $search[]  = '&Ecirc;';
        $replace[] = 'è';
        $search[]  = '&egrave;';
        $replace[] = 'È';
        $search[]  = '&Egrave;';
        $replace[] = 'ë';
        $search[]  = '&euml;';
        $replace[] = 'Ë';
        $search[]  = '&Euml;';
        $replace[] = '';
        $search[]  = '&fnof;';
        $replace[] = 'í';
        $search[]  = '&iacute;';
        $replace[] = 'Í';
        $search[]  = '&Iacute;';
        $replace[] = 'î';
        $search[]  = '&icirc;';
        $replace[] = 'Î';
        $search[]  = '&Icirc;';
        $replace[] = 'ì';
        $search[]  = '&igrave;';
        $replace[] = 'Ì';
        $search[]  = '&Igrave;';
        $replace[] = 'ï';
        $search[]  = '&iuml;';
        $replace[] = 'Ï';
        $search[]  = '&Iuml;';
        $replace[] = 'ñ';
        $search[]  = '&ntilde;';
        $replace[] = 'Ñ';
        $search[]  = '&Ntilde;';
        $replace[] = 'ó';
        $search[]  = '&oacute;';
        $replace[] = 'Ó';
        $search[]  = '&Oacute;';
        $replace[] = 'ô';
        $search[]  = '&ocirc;';
        $replace[] = 'Ô';
        $search[]  = '&Ocirc;';
        $replace[] = 'ò';
        $search[]  = '&ograve;';
        $replace[] = 'Ò';
        $search[]  = '&Ograve;';
        $replace[] = 'º';
        $search[]  = '&ordm;';
        $replace[] = 'ø';
        $search[]  = '&oslash;';
        $replace[] = 'Ø';
        $search[]  = '&Oslash;';
        $replace[] = 'õ';
        $search[]  = '&otilde;';
        $replace[] = 'Õ';
        $search[]  = '&Otilde;';
        $replace[] = 'ö';
        $search[]  = '&ouml;';
        $replace[] = 'Ö';
        $search[]  = '&Ouml;';
        $replace[] = '';
        $search[]  = '&oelig;';
        $replace[] = '';
        $search[]  = '&OElig;';
        $replace[] = '';
        $search[]  = '&scaron;';
        $replace[] = '';
        $search[]  = '&Scaron;';
        $replace[] = 'ß';
        $search[]  = '&szlig;';
        $replace[] = 'þ';
        $search[]  = '&thorn;';
        $replace[] = 'Þ';
        $search[]  = '&THORN;';
        $replace[] = 'ú';
        $search[]  = '&uacute;';
        $replace[] = 'Ú';
        $search[]  = '&Uacute;';
        $replace[] = 'û';
        $search[]  = '&ucirc;';
        $replace[] = 'Û';
        $search[]  = '&Ucirc;';
        $replace[] = 'ù';
        $search[]  = '&ugrave;';
        $replace[] = 'Ù';
        $search[]  = '&Ugrave;';
        $replace[] = 'ü';
        $search[]  = '&uuml;';
        $replace[] = 'Ü';
        $search[]  = '&Uuml;';
        $replace[] = 'ý';
        $search[]  = '&yacute;';
        $replace[] = 'Ý';
        $search[]  = '&Yacute;';
        $replace[] = 'ÿ';
        $search[]  = '&yuml;';
        $replace[] = '';
        $search[]  = '&Yuml;';
        $chaine    = str_replace($search, $replace, $chaine);

        return $chaine;
    }
 }