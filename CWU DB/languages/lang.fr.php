<?php
/*
------------------
Language: Francais
------------------
*/
 
$lang = array();
 
//Login

$lang['LOGIN_NAME'] = 'Entrez votre nom et appuyer sur entrer';
$lang['LOGIN_PASS'] = 'Entrez votre mdp et appuyer sur entrer';
$lang['LOGIN_SOUV'] = 'Rester Connecté';
$lang['LOGIN_ERR_NAME_1'] = 'Erreur DATA: Nom Inconnu de la Data Base CWU';
$lang['LOGIN_ERR_NAME_2'] = 'Erreur DATA: Nom complet requis (Prénom et Nom)';
$lang['LOGIN_ERR_EMAIL_1'] = 'Erreur DATA: Email inconnu de la Data Base CWU Admins';
$lang['LOGIN_ERR_MDP_1'] = 'Erreur DATA: Le mot de passe ne correspond pas,';

// Dashbord
 
$lang['DASH_TITLE'] = 'Tableau de bord';
$lang['DASH_WELCOME'] = 'Bienvenue';
$lang['DASH_ADD'] = 'Ajouter un dossier';
$lang['DASH_SEARCH'] = 'Rechercher un dossier';
$lang['DASH_SEARCH_HACKED'] = 'R3ch3r@ch3r un d055i_3r';
$lang['DASH_LOGOUT'] = 'Déconnexion';
$lang['DASH_BEFORE'] = 'La première étape avant tout, serait de vous enregistrer.';
$lang['DASH_BEFORE_ADD'] = 'Cliquez sur le bouton «Ajouter un dossier» pour créer un nouveau dossier et renseignez-y vos informations.';
$lang['DASH_BEFORE_ADD_DINSC'] = 'Le bouton «Ajouter un dossier» permet de créer un nouveau dossier.';
$lang['DASH_BEFORE_SEARCH'] = 'Le bouton «Rechercher un dossier» sert à trouver un dossier, vous pouvez y renseigner le nom complet d\'un citoyen ou son CID.';
$lang['DASH_BEFORE_LOGOUT'] = 'Le bouton «Déconnexion» vous permet de vous déconnecter, si vous aviez coché la case «Rester Connecté», celle-ci ne prendra plus effet.';

// Add

$lang['ADD_FNAME'] = 'Prénom';
$lang['ADD_LNAME'] = 'Nom';
$lang['ADD_DESC_PH'] = 'Ex: Cheveux brun, barbe de trois jours, etc...';
$lang['ADD_OBSERV_PH'] = 'Commentez...';
$lang['ADD_GENERATE'] = 'Dossier Généré';
$lang['ADD_ERR_1_1'] = 'Dossier enregistré !';
$lang['ADD_ERR_1_2'] = 'Retour au tableau de bord';
$lang['ADD_ERR_2'] = 'Erreur DATA: Points de Loyauté Erronés';
$lang['ADD_ERR_3'] = 'Erreur DATA: Identité déjà utilisée. Contactez la PC pour relocalisation';
$lang['ADD_ERR_4'] = 'Erreur DATA: CID Corrompu';
$lang['ADD_ERR_5'] = 'Erreur DATA: CID Erroné (Trop Court)';
$lang['ADD_ERR_6'] = 'Erreur DATA: CID ou Points de Loyauté Erronés (Non numérique)';
$lang['ADD_ERR_7'] = 'Erreur DATA: Donnés Erronés (Prenom et Nom: 255 char max. | CID: 5 char max. | Point de Loyauté: 3 char max.)';
$lang['ADD_ERR_8'] = 'Erreur DATA: Informations manquantes';

// Dossier

$lang['FILE_TITLE'] = 'Dossier';
$lang['FILE_OF'] = 'Dossier du CID';
$lang['FILE_FULLNAME'] = 'Nom Complet';
$lang['FILE_PLOYAUTE'] = 'Points de Loyauté';
$lang['FILE_PANTI'] = 'Points d\'Anti-Citoyenté';
$lang['FILE_STATUS'] = 'Statut';
$lang['FILE_STATUS_1'] = 'Anti-Citoyen';
$lang['FILE_STATUS_2'] = 'Citoyen';
$lang['FILE_STATUS_3'] = 'En attente de test Loyaliste';
$lang['FILE_STATUS_4'] = 'Loyaliste';
$lang['FILE_STATUS_5'] = 'DCP R';
$lang['FILE_STATUS_6'] = 'DCP I';
$lang['FILE_STATUS_7'] = 'DCP C';
$lang['FILE_STATUS_8'] = 'Superviseur';
$lang['FILE_DESC'] = 'Description Physique';
$lang['FILE_OBSERV'] = 'Observation';
$lang['FILE_DELFILE'] = 'Supprimer le dossier';
$lang['FILE_AST'] = '* Tapez '.htmlspecialchars("<br/>").' pour effectuer un saut de ligne';
$lang['FILE_ERR_1'] = 'Erreur DATA: CID Corrompu';
$lang['FILE_ERR_2'] = 'Erreur DATA: CID Erroné';
$lang['FILE_ERR_3'] = 'Erreur DATA: Identité déjà utilisée. Contactez la PC pour relocalisation';
$lang['FILE_ERR_4'] = 'Erreur DATA: Donnés Erronés';
$lang['FILE_ERR_5'] = 'Erreur DATA: Donné Erroné';

// Search

$lang['SEARCH_BAR'] = 'Recherche...';
$lang['SEARCH_SEEFILE'] = 'Voir le dossier';
$lang['SEARCH_ERR_1_1'] = 'Aucun résultat pour le CID #';
$lang['SEARCH_ERR_1_2'] = 'Ajouter à la Data Base';
$lang['SEARCH_ERR_2_1'] = 'Erreur DATA:';
$lang['SEARCH_ERR_2_2'] = 'citoyens nommé(e)s';
$lang['SEARCH_ERR_2_3'] = ', contactez la PC pour relocalisation';
$lang['SEARCH_ERR_3'] = 'Erreur DATA: Aucun résultat pour le citoyen';

// Admin

$lang['ADMIN_TITLE'] = 'Tableau de bord Admin';
$lang['ADMIN_SUPERVISOR'] = 'Vos CWU Autorisé';
$lang['ADMIN_BEFORE'] = 'La première étape avant tout, serait d\'enregistré un CWU.';
$lang['ADMIN_BEFORE_ADD'] = 'Cliquez sur le bouton «Ajouter un CWU» pour en ajouter et renseignez-y les informations néssésaires.';
$lang['ADMIN_BEFORE_SEARCH'] = 'Le bouton «Rechercher un CWU» sert à modifier ou supprimer un CWU, vous devez y renseigner le nom du CWU ou son pseudo.';
$lang['ADMIN_BEFORE_LOGOUT'] = 'Le bouton «Déconnexion» vous permet de vous déconnecter.';
$lang['ADMIN_ADD'] = 'Ajouter un CWU';
$lang['ADMIN_SEARCH'] = 'Rechercher un CWU';
$lang['ADMIN_EXP'] = 'Expiration de votre abonnement';

// Admin Add

$lang['ADD_ADMIN_PSEUDO'] = 'Pseudo';
$lang['ADD_ADMIN_MDP'] = 'Mot de passe';
$lang['ADD_ADMIN_GENERATE'] = 'CWU ajouté';
$lang['ADD_ADMIN_ERR_1_1'] = 'CWU ajouté !';
$lang['ADD_ADMIN_ERR_1_2'] = 'Retour au tableau de bord';
$lang['ADD_ADMIN_ERR_2'] = 'Erreur DATA: Pseudo déjà utilisé';
$lang['ADD_ADMIN_ERR_3'] = 'Erreur DATA: Nom complet déjà utilisé';
$lang['ADD_ADMIN_ERR_4'] = 'Erreur DATA: Donnés Erronés (Prenom, Nom et Pseudo: 255 char max.)';
$lang['ADD_ADMIN_ERR_5'] = 'Erreur DATA: Informations manquantes';

// Search Admin

$lang['SEARCH_ADMIN_TITLE'] = 'Rechercher un CWU';
$lang['SEARCH_ADMIN_ERR_1'] = 'Erreur DATA: Nom complet requis (Prénom et Nom) ou Pseudo';
$lang['SEARCH_ADMIN_ERR_2'] = 'Erreur DATA: Aucun résultat pour le Pseudo';
$lang['SEARCH_ADMIN_ERR_3'] = 'Erreur DATA: Aucun résultat pour le CWU';
$lang['SEARCH_ADMIN_ERR_2_2'] = 'CWUs nommé(e)s';

// Dossier Admin

$lang['FILE_ADMIN_TITLE'] = 'Dossier CWU';
$lang['FILE_ADMIN_OF'] = 'Dossier du CWU';
$lang['FILE_ADMIN_MDP_2'] = 'Le mot de passe est crypter';
$lang['FILE_ADMIN_DELMSG'] = 'Êtes-vous certain de vouloir supprimer ce profil ?';
$lang['FILE_ADMIN_ERR_1'] = 'Erreur DATA: Pseudo déjà utilisé';
$lang['FILE_ADMIN_ERR_2'] = 'Erreur DATA: Pseudo erroné';
$lang['FILE_ADMIN_ERR_3'] = 'Erreur DATA: Nom déjà utilisé';

// Others

$lang['COPYRIGHT'] = 'GEPS Conception | Tous droits réservées';
$lang['RETURN'] = 'Retour';
$lang['SAVE'] = 'Enregistrer';
$lang['CANCEL'] = 'Annuler';
$lang['MODIFY'] = 'Modifier';
$lang['DEL'] = 'Supprimer';
$lang['FILTER'] = 'Filtre';
$lang['SEARCHED'] = 'Recherché';
$lang['LOSTED'] = 'Disparu';
$lang['DEAD'] = 'Décédé';
$lang['ALLFILE'] = 'Tout (Peut lagguer)';
$lang['RECOMP'] = 'Récompenser';
$lang['REPRIM'] = 'Réprimander';
$lang['ADMIN_BUY'] = 'Acheter l\'accès à la Data Base pour mon serveur';
$language = 'fr';

?>
