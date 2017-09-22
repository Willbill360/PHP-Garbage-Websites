<?php
session_start();
	unset($_COOKIE['matricule']);
  unset($_COOKIE['password']);
  setcookie('matricule', null, -1, '/');
  setcookie('password', null, -1, '/');
	$_SESSION = array();
	session_destroy();
	header("Location: index");
?>
