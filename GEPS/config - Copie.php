<?php
//Si on est en local | true = locale - false = sur l'hébergeur | à chnager manuellement
$isLocal = true;
//Défini la langue utilisé pour plusieur fonction en php | ex: date
setlocale (LC_TIME, 'fr_FR.utf8','fra');
//Connexion à la base de données
if($isLocal == true) {
  //Connexion SQL lorsque l'on est en local
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
} else {
  //Connexion SQL de l'hébergeur
  $bdd = new PDO('mysql:host=158.69.207.102;dbname=espace_membre', 'root', '0Otfk4rNnz');
}

//Faire apparaitre le boîte d'acceptation des cookies si le cookie accept_cookie n'existe pas
if(isset($_COOKIE['accept_cookie'])) {
   $showcookie = false;
} else {
   $showcookie = true;
}
//Inclusion du footer | Mauvaise interpretation car c'est en fait la boite des cookies
require_once('footer.php');
?>
