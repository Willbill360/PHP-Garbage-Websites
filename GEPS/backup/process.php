<?php
session_start();

include_once('config.php');

if($isLocal == true) {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
} else {
  $bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '0Otfk4rNnz');
}

include_once('cookieconnect.php');

if(isset($_SESSION['id']) AND isset($_SESSION['mLeft']) AND !isset($_COOKIE['tsbought'])) {

$insertts = $bdd->prepare("UPDATE membres SET asTS = ? WHERE id = ?");
$insertts->execute(array('Oui', $_SESSION['id']));

$reqmail = $bdd->prepare("SELECT * FROM tsmdp WHERE mail = ?");
$reqmail->execute(array($_SESSION['mail']));
$mailexist = $reqmail->rowCount();
if($mailexist == 0) {
  $insertnews = $bdd->prepare("INSERT INTO tsmdp(id, pseudo, mail) VALUES(?, ?, ?)");
  $insertnews->execute(array($_SESSION['id'], $_SESSION['pseudo'], $_SESSION['mail']));

  $mail = $_SESSION['mail']; // Déclaration de l'adresse de destination.
  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
  {
    $passage_ligne = "\r\n";
  }
  else
  {
    $passage_ligne = "\n";
  }
  //=====Déclaration des messages au format HTML.
  $message_html = '
  <html>
           <head>
             <meta charset="utf-8" />
           </head>
           <body>
             <font color="#303030";>
               <div align="center">
                 <table width="600px">
                   <tr>
                     <td>
                       <div align="center">Bonjour <b>'.$_SESSION['pseudo'].'</b>,<br/>
                       Merci d\'avoir acheté un salon privé TeamSpeak.<br/>
                       Le mot de passe est : <b>'.$tsmdp.'</b><br/>
                       À bientôt sur <a href="http://mcgeps.ca/">mcgeps.ca</a> !
                       </div>
                     </td>
                   </tr>
                   <tr>
                     <td align="center">
                       <font size="2">
                         Ceci est un email automatique, merci de ne pas y répondre
                       </font>
                     </td>
                   </tr>
                 </table>
               </div>
             </font>
           </body>
           </html>
  ';
  //==========
   
  //=====Création de la boundary
  $boundary = "-----=".md5(rand());
  //==========
   
  //=====Définition du sujet.
  $sujet = "Mot de passe des salons prives TeamSpeak";
  //=========
   
  //=====Création du header de l'e-mail.
  $header = "From: \"G.E.P.S.\"<noreply@mcgeps.ca>".$passage_ligne;
  $header.= "Reply-to: \"G.E.P.S.\" <noreply@mcgeps.ca>".$passage_ligne;
  $header.= "MIME-Version: 1.0".$passage_ligne;
  $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
  //==========
   
  //=====Création du message.
  $message = $passage_ligne."--".$boundary.$passage_ligne;
  //==========
  $message.= $passage_ligne."--".$boundary.$passage_ligne;
  //=====Ajout du message au format HTML
  $message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
  $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  $message.= $passage_ligne.$message_html.$passage_ligne;
  //==========
  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  //==========
   
  //=====Envoi de l'e-mail.
  mail($mail,$sujet,$message,$header);
  //==========
}

if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 1) {
  $insertmonthleft = $bdd->prepare("UPDATE membres SET monthLeft = ? WHERE id = ?");
  $insertmonthleft->execute(array('0', $_SESSION['id']));
  $insertmonthleftts = $bdd->prepare("UPDATE tsmdp SET monthLeft = ? WHERE id = ?");
  $insertmonthleftts->execute(array('0', $_SESSION['id']));
  setcookie('tsbought', 'c4ca4238a0b923820dcc509a6f75849b', time() + 28*24*3600, '/', null, false, true);
} else if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 6) {
  $insertmonthleft = $bdd->prepare("UPDATE membres SET monthLeft = ? WHERE id = ?");
  $insertmonthleft->execute(array('5', $_SESSION['id']));
  $insertmonthleftts = $bdd->prepare("UPDATE tsmdp SET monthLeft = ? WHERE id = ?");
  $insertmonthleftts->execute(array('5', $_SESSION['id']));
  setcookie('tsbought', '1679091c5a880faf6fb5e6087eb1b2dc', time() + 178*24*3600, '/', null, false, true);
} else if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 12) {
  $insertmonthleft = $bdd->prepare("UPDATE membres SET monthLeft = ? WHERE id = ?");
  $insertmonthleft->execute(array('11', $_SESSION['id']));
  $insertmonthleftts = $bdd->prepare("UPDATE tsmdp SET monthLeft = ? WHERE id = ?");
  $insertmonthleftts->execute(array('11', $_SESSION['id']));
  setcookie('tsbought', 'c20ad4d76fe97759aa27a0c99bff6710', time() + 360*24*3600, '/', null, false, true);
}

header( 'refresh:1;url=index' );
} else {
  header( 'Location: index' );
}
?>
<link rel="stylesheet" href="assets/css/main.css" />
<link rel="icon" type="image/ico" href="images/favicon.ico"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
<h1 align="center" style="margin-top:100px;">Redirection en cour...</h1>
<?php  var_dump($_SESSION['mLeft']) ?>