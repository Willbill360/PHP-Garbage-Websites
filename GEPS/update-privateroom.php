<?php
session_start();

include_once('config.php');

if($isLocal == true) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
} else {
	$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '0Otfk4rNnz');
}

$curdate = date('Y-m-d');

$login="serveradmin"; // Login d'un utilisateur query
$password= "zxW21Y2i"; // Pass de cet utilisateur
$ip="ts.mcgeps.ca"; // Ip ou nom de domaine du serveur
$portquery="10011"; // Port du serveur query
$portserver="9987"; // Port du serveur TS

require_once("API/TeamSpeak3/TeamSpeak3.php");
// On initial ts
TeamSpeak3::init();
// On se connecte en query
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$login.":".$password.
"@".$ip.":".$portquery."/?server_port=".$portserver);

$reqts = $bdd->query('SELECT * FROM tsmdp ORDER BY id ASC');
while($userts = $reqts->fetch()){

	if($userts['EndTsTime'] == $curdate) {
		$sql = ("DELETE FROM tsmdp WHERE id =".$userts['id']);
		$bdd->exec($sql);
		$insertmonthleft = $bdd->prepare("UPDATE membres SET EndTsTime = ?, asTS = ? WHERE id = ?");
     	$insertmonthleft->execute(array('-1','Non', $_SESSION['id']));
     	$thechan = $ts3_VirtualServer->channelGetByName($userts['chanName']);
		$cid = $thechan->getId();
		$ts3_VirtualServer->channelDelete ($cid, $force=FALSE);
		echo "Chan ".$userts['chanName']." supprimé";
		$mail = $userts['mail']; // Déclaration de l'adresse de destination.
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
		                       <div align="center">Bonjour <b>'.$userts['pseudo'].'</b>,<br/>
		                       Votre salon privé TeamSpeak à été supprimé puisqu\'il est arrivé a échéance. 
		                       Vous pouvez le relouer à partir de l\'onglet boutique de notre site web.<br/>
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
		  $sujet = "[GEPS] - Suppression de votre salon privé TeamSpeak";
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
	} else
	{
		echo "Nothing append";
	}
}
?>