<?php
session_start();
	unset($_COOKIE['nom']);
    unset($_COOKIE['password']);
    setcookie('nom', null, -1, '/');
    setcookie('password', null, -1, '/');
	$_SESSION = array();
	session_destroy();
	header("Location: index");
?>