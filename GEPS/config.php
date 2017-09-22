<?php
$isLocal = true;

setlocale (LC_TIME, 'fr_FR.utf8','fra');

$fichiermdp = fopen('tsmdp.txt', 'r+');
$tsmdp = fgets($fichiermdp);
fclose($fichiermdp);

//$tsmdp = 'privateroomoftheloom';

if(isset($_COOKIE['accept_cookie'])) {
   $showcookie = false;
} else {
   $showcookie = true;
}
require_once('footer.php');
?>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>