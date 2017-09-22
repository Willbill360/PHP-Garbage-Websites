<?php
//On commence la session
session_start();
  //On tue les cookies
	unset($_COOKIE['email']);
    unset($_COOKIE['password']);
    setcookie('email', null, -1, '/');
    setcookie('password', null, -1, '/');
	$_SESSION = array();
  //On détruit et on ferme la session
	session_destroy();
  //On redirectionne vers connection
	header("Location: connexion");
?>
