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
// all
define('_AM_XMCONTENT_ACTION', 'Action');
define('_AM_XMCONTENT_ADD', 'Ajouter');
define('_AM_XMCONTENT_CLONE', 'Cloner');
define('_AM_XMCONTENT_CONTENT_COPY', 'Copie: ');
define('_AM_XMCONTENT_DEL', 'Effacer');
define('_AM_XMCONTENT_EDIT', 'Modifier');
define('_AM_XMCONTENT_NO', 'Non');
define('_AM_XMCONTENT_REDIRECT_SAVE', 'Enregistré avec succès');
define('_AM_XMCONTENT_YES', 'Oui');
define('_AM_XMCONTENT_VIEW', 'Voir les détails');

// index
define('_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTINSTALLED', 'Vous n\'avez pas installé le module xmdoc, ce module est requis si vous souhaitez ajouter des documents à votre contenu');
define('_MA_XMCONTENT_INDEXCONFIG_XMDOC_WARNINGNOTACTIVATE', 'Vous devez activer dans les préférences xmcontent l\'utilisation de xmdoc (si vous souhaitez ajouter des documents)');
define('_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTINSTALLED', 'Vous n\'avez pas installé le module xmsocial, ce module est requis si vous souhaitez évaluer les contenus ou ajouter des médias sociaux');
define('_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATE', 'Vous devez activer dans les préférences du module l\'utilisation de xmsocial (si vous souhaitez évaluer les contenus)');
define('_MA_XMCONTENT_INDEXCONFIG_XMSOCIAL_WARNINGNOTACTIVATESOCIAL', 'Vous devez activer dans les préférences du module l\'utilisation de xmsocial (si vous souhaitez ajouter des médias sociaux)');

// content
define('_AM_XMCONTENT_CONTENT_ADD', 'Ajouter un contenu');
define('_AM_XMCONTENT_CONTENT_CSS', 'Fichier CSS');
define('_AM_XMCONTENT_CONTENT_DESCRIPTION', 'Meta description');
define('_AM_XMCONTENT_CONTENT_DESCRIPTION_DSC', 'La balise méta description permet de fournir une description aux moteurs de recherches pour l\'affichage des résultats.');
define('_AM_XMCONTENT_CONTENT_DOCOMMENT', 'Voir les commentaires');
define('_AM_XMCONTENT_CONTENT_DOMAIL', 'Voir l\'icône email');
define('_AM_XMCONTENT_CONTENT_DOPDF', 'Voir l\'icône pdf');
define('_AM_XMCONTENT_CONTENT_DOPRINT', 'Voir l\'icône d\'impression');
define('_AM_XMCONTENT_CONTENT_DORATING', 'Afficher la note');
define('_AM_XMCONTENT_CONTENT_DOSOCIAL', 'Voir les icônes média sociaux');
define('_AM_XMCONTENT_CONTENT_DOTITLE', 'Montrer le titre');
define('_AM_XMCONTENT_CONTENT_GROUPSVIEW', 'Sélectionner les groupes pouvant voir ce contenu');
define('_AM_XMCONTENT_CONTENT_GROUPSEDIT', 'Sélectionner les groupes pouvant modifier ce contenu');
define('_AM_XMCONTENT_CONTENT_INFORMATION', 'Informations');
define('_AM_XMCONTENT_CONTENT_KEYWORD', 'Meta keywords');
define('_AM_XMCONTENT_CONTENT_KEYWORD_DSC', 'La balise méta keywords est une série de mots clés qui représentent le contenu de vos actualités. Tapez des mots-clés séparés par une virgule. (Ex. XOOPS, PHP, MySQL, système de portail).');
define('_AM_XMCONTENT_CONTENT_LIST', 'Liste des contenus');
define('_AM_XMCONTENT_CONTENT_LOGO', 'Fichier logo');
define('_AM_XMCONTENT_CONTENT_MAINDISPLAY', 'Afficher sur la page principale');
define('_AM_XMCONTENT_CONTENT_PATH', 'Les fichiers sont dans : %s');
define('_AM_XMCONTENT_CONTENT_STATUS', 'Statut');
define('_AM_XMCONTENT_CONTENT_STATUS_A', 'Activé');
define('_AM_XMCONTENT_CONTENT_STATUS_NA', 'Désactivé');
define('_AM_XMCONTENT_CONTENT_SUREDEL', 'Voulez-vous supprimer ce contenu? %s');
define('_AM_XMCONTENT_CONTENT_SURECLONE', 'Êtes vous sur de vouloir cloner ce contenu? %s');
define('_AM_XMCONTENT_CONTENT_TEMPLATE', 'Fichier modèle');
define('_AM_XMCONTENT_CONTENT_TEXT', "Texte<br /><br />Utilisez le délimiteur <span style='color:blue'>[break_dsc]</span> pour définir la taille de la description courte. <br> La description courte est utilisée sur la page d'accueil du module");
define('_AM_XMCONTENT_CONTENT_TEXT_DESC', "Utilisez le délimiteur <span style='color:orange'>[break_dsc]</span> pour définir la taille de la description courte.<br> La description courte est utilisée sur la page d'accueil du module
<br><br>Utilisez le délimiteur <span style='color:orange'>[pageid=X]</span> pour inclure une autre page xmcontent dans cette page (plusieurs inclusions possible). <span style='color:orange'>X</span><br>est l'id de la page<br>
<span style='color:red'>Important:</span> Les inclusions en cascade (page 1 qui intégre la page 2 qui intégre la page 3) ne fonctionne pas. Les inclusions dans la description courte de l'index du module ne fonctionnent pas.");
define('_AM_XMCONTENT_CONTENT_TIPS', 'Vous utilisez le module xlanguage pour votre site internet.<br> Pour que la balise [break_dsc] fonctionne correctement vous devez la placer dans chacune des traductions. Il en va de même pour la balise [pageid=X]');
define('_AM_XMCONTENT_CONTENT_TITLE', 'Titre');
define('_AM_XMCONTENT_CONTENT_UPLOAD', 'Télécharger');
define('_AM_XMCONTENT_CONTENT_UPLOADSIZE', 'Taille maximum : %s Ko');
define('_AM_XMCONTENT_CONTENT_WEIGHT', 'Poids');

// permission
define('_AM_XMCONTENT_PERMISSION_VIEW', 'Autorisation de voir un contenu');
define('_AM_XMCONTENT_PERMISSION_VIEW_DSC', 'Choisissez les groupes qui peuvent voir les contenus suivants');
define('_AM_XMCONTENT_PERMISSION_EDIT', 'Autorisation pour modifier un contenu');
define('_AM_XMCONTENT_PERMISSION_EDIT_DSC', 'Choisissez les groupes qui peuvent modifier les contenus suivants');

// error
define('_AM_XMCONTENT_ERROR_CONTENT', 'Il n\'y a pas de contenu dans la base de données');
define('_AM_XMCONTENT_ERROR_WEIGHT', 'Le poids doit être un nombre');
define('_AM_XMCONTENT_ERROR_INCLUDE', 'La page avec l\'id %s n\'a pas pu être incluse!');
