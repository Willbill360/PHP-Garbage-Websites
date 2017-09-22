<?php
$isLocal = true;

setlocale (LC_TIME, 'fr_FR.utf8','fra');

if($isLocal == true) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=mpf_bdd', 'root', '');
  //echo "<script>document.write('<script src=\"http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1\"></' + 'script>')</script>";
} else {
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u254698105_mpf', 'u254698105_mpf', 'YPT5Urt22PB4');
}
/*
if(isset($_COOKIE['accept_cookie'])) {
   $showcookie = false;
} else {
   $showcookie = true;
}
require_once('footer.php');

if(isset($_GET['lang']))
{
$lang = $_GET['lang'];
 
// register the session and set the cookie
$_SESSION['lang'] = $lang;
 
setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isset($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isset($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'fr';
}
 
switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;
 
  case 'fr':
  $lang_file = 'lang.fr.php';
  break;
 
  default:
  $lang_file = 'lang.fr.php';
 
}
 
include_once 'languages/'.$lang_file;
*/
?>
