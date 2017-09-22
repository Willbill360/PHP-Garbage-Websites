<?php
//Création du cookie accept_cookie pour que ne saffiche plus pour un ans (Duré max par la loi)
setcookie('accept_cookie', true, time() + 365*24*3600, '/', null, false, true);
//Si il y a une page précédente naviguer sur le site (c a dire la page actuel que l'utilisateur utilise existe)
if(isset($_SERVER['HTTP_REFERER']) AND !empty($_SERVER['HTTP_REFERER'])) {
	header('Location:'.$_SERVER['HTTP_REFERER']);
} else {
  //Sinon on redirectionne vers la page dacceuil (lien complet pas la page car il ne sont pas sur une page du site normalement)
	header('Location: http://mcgeps.ca/');
}

?>
