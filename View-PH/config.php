<?php
$isLocal = true;

setlocale (LC_TIME, 'fr_FR.utf8','fra');

if($isLocal == true) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=member_space_viewph', 'root', '');
} else {
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u931876504_mbr', 'u931876504_ph', 'O4f4DuWmjV');
}

if(isset($_COOKIE['accept_cookie'])) {
   $showcookie = false;
} else {
   $showcookie = true;
}
require_once('footer.php');
?>