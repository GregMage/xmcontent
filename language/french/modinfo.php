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
define('_MI_XMCONTENT_NAME', 'Contenu');
define('_MI_XMCONTENT_DESC', 'Module de contenu');

// Admin menu
define('_MI_XMCONTENT_MENU_HOME', 'Accueil');
define('_MI_XMCONTENT_MENU_HOME_DESC', 'Retournez à la page d\'accueil');
define('_MI_XMCONTENT_MENU_CONTENT', 'Contenu');
define('_MI_XMCONTENT_MENU_CONTENT_DESC', 'Liste des contenu');
define('_MI_XMCONTENT_MENU_PERMISSION', 'Autorisations');
define('_MI_XMCONTENT_MENU_ABOUT', 'A propos');
define('_MI_XMCONTENT_MENU_ABOUT_DESC', 'A propos de ce module');
define('_MI_XMCONTENT_MENU_HELP', 'Aide');
define('_MI_XMCONTENT_MENU_HELP_DESC', 'Aide du module');

// Block
define('_MI_XMCONTENT_BLOCK_DEFAULT', 'Contenu');
define('_MI_XMCONTENT_BLOCK_DEFAULT_DESC', 'Afficher un contenu');

// Pref.
define('_MI_XMCONTENT_PREF_HEAD_REWRITE',"<span style='font-size: large; font-weight: bold;'>Réécriture d'URL </span>");
define('_MI_XMCONTENT_PREF_REWRITE','Utiliser la réécriture d\'URL ?');
define('_MI_XMCONTENT_PREF_REWRITE_DESC','Activer la réécriture d\'URL pour tout le module');
define('_MI_XMCONTENT_PREF_REWRITE_NAME','Affichage du nom dans l\'URL ');
define('_MI_XMCONTENT_PREF_REWRITE_NAME_DESC','Le nom doit être le même dans le fichier .htaccess');
define('_MI_XMCONTENT_PREF_HEAD_INDEX', "<span style='font-size: large; font-weight: bold;'>Index</span>");
define('_MI_XMCONTENT_PREF_COLUMNCONTENT', 'Nombre de colonne(s) pour afficher le contenu');
define('_MI_XMCONTENT_PREF_COLUMNCONTENT_DESC', 'Choisissez le nombre de colonne(s) pouvant être visualisée(s) dans l\'index: 1, 2, 3 ou 4 colonnes');
define('_MI_XMCONTENT_PREF_CONTENTINDEX', 'Contenu à afficher sur la page d\'index');
define('_MI_XMCONTENT_PREF_CONTENTINDEX_ALL', 'Tous les contenus');
define('_MI_XMCONTENT_PREF_CONTENTINDEX_DESC', 'Choisissez le contenu à afficher. Pour afficher tout le contenu, vous devez mettre à jour le module !');
define('_MI_XMCONTENT_PREF_HEADER', 'En-tête de la page d\'index');
define('_MI_XMCONTENT_PREF_HEADER_DESC', 'Utilisez du code HTML à afficher dans la page d\'index');
define('_MI_XMCONTENT_PREF_FOOTER', 'Pied de la page d\'index');
define('_MI_XMCONTENT_PREF_FOOTER_DESC', 'Utilisez du code HTML à afficher dans la page d\'index');
define('_MI_XMCONTENT_PREF_INDEXPERPAGE', 'Nombre d\'éléments à afficher sur la page d\'index');
define('_MI_XMCONTENT_PREF_HEAD_OPTIONS', "<span style='font-size: large; font-weight: bold;'>Options</span>");
define('_MI_XMCONTENT_PREF_CSS', 'Utiliser un fichier css personnalisé pour les pages de contenu');
define('_MI_XMCONTENT_PREF_CSS_DESC', 'Si cette option est activée, vous pouvez ajouter un fichier CSS personnalisé à un contenu.');
define('_MI_XMCONTENT_PREF_TEMPLATE', 'Utiliser un fichier modèle personnalisé par contenu');
define('_MI_XMCONTENT_PREF_TEMPLATE_DESC', 'Si cette option est activée, vous pouvez ajouter un modèle personnalisé à un contenu.');
define('_MI_XMCONTENT_PREF_XMDOC', 'Utiliser le module xmdoc pour ajouter un document');
define('_MI_XMCONTENT_PREF_XMSOCIAL', 'Utiliser le module xmsocial pour noter un contenu');
define('_MI_XMCONTENT_PREF_XMSOCIALSOCIAL', 'Utiliser le module xmsocial pour afficher des liens de partage pour les réseaux sociaux');
define('_MI_XMCONTENT_PREF_WARNING', 'Message d\'avertissement si l\'utilisateur n\'a pas accès au contenu qui est inclu');
define('_MI_XMCONTENT_PREF_WARNING_DESC', 'Le message sert à informer l\'utilisateur qu\'il n\'a pas accès à certaines pages inclulses dans la page principale(inclusion avec le délimiteur <span style="color:orange">[pageid=X]</span>. Si vous ne voulez pas de message, laissez ce champ vide.');
define('_MI_XMCONTENT_PREF_WARNING_DEFAULT', 'Vous n\'avez pas accès à l\'ensemble de la page!');
define('_MI_XMCONTENT_PREF_INCLUDE', 'Afficher un message d\'erreur si une page ne peut pas être incluse');
define('_MI_XMCONTENT_PREF_INCLUDE_DESC', 'Si une page ne peut pas être incluse avec le délimiteur <span style="color:orange">[pageid=X]</span> (page inexistante, erreur d\'id, ...), un message d\'erreur apparait en bas de la page pricipale (uniquement pour les administrateurs).');
define('_MI_XMCONTENT_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMCONTENT_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMCONTENT_PREF_ADMINPERPAGE', 'Nombre d\'éléments par page dans la vue Admin');
