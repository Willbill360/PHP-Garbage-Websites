<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();

include_once('config.php');

if($isLocal == true) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
} else {
	$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '0Otfk4rNnz');
}

include('cookieconnect.php');

if(isset($_POST['envoi'])) {
	$type_int = ceil($_POST['type-rapport']);
	$thedate = ucfirst(strftime('%A, le %d %B %Y'));
	$id_sender = $_SESSION['id'];
	$pseudo_sender = $_SESSION['pseudo'];
	$mail_sender = $_SESSION['mail'];
	$reqid = $bdd->query('SELECT id FROM rapport ORDER BY id DESC LIMIT 1');
	while($theid = $reqid->fetch()) {
		$previd = $theid['id'];
		$lastid = $previd + 1;
	}
	if($isLocal == true){
		$ip = 'Mon Ip de Test';
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
} else {
	$type_int = 0;
}

if($type_int == 1) {
	$type = 'Demande de ban';
	$pseudo_joueur = htmlspecialchars($_POST['pseudo_joueur']);
	$raison = htmlspecialchars($_POST['raison']);
	$raison_nl2br = nl2br($raison);
	$message = 'Accusé: '.$pseudo_joueur.'<br/> Raison: '.$raison_nl2br;
	$insertrap = $bdd->prepare("INSERT INTO rapport(ip, id_sender, pseudo_sender, mail_sender, thedate, type, message) VALUES(?, ?, ?, ?, ?, ?, ?)");
	$insertrap->execute(array($ip, $id_sender, $pseudo_sender, $mail_sender, $thedate, $type, $message));
  	sendMail($type, $lastid);
} else if($type_int == 2) {
	$type = 'Demande de rétrogradation';
	$pseudo_staff = htmlspecialchars($_POST['pseudo_staff']);
	$raison = htmlspecialchars($_POST['raison']);
	$raison_nl2br = nl2br($raison);
	$message = 'Accusé: '.$pseudo_staff.'<br/> Raison: '.$raison_nl2br;
	$insertrap = $bdd->prepare("INSERT INTO rapport(ip, id_sender, pseudo_sender, mail_sender, thedate, type, message) VALUES(?, ?, ?, ?, ?, ?, ?)");
	$insertrap->execute(array($ip, $id_sender, $pseudo_sender, $mail_sender, $thedate, $type, $message));
	sendMail($type, $lastid);
} else if($type_int == 3) {
	$type = 'Bug';
	$bug_type = $_POST['serv-mc'];
	$explication = htmlspecialchars($_POST['explain']);
	$explication_nl2br = nl2br($explication);
	$message = 'Type de bug: '.$bug_type.'<br/> Explication: '.$explication_nl2br;
	$insertrap = $bdd->prepare("INSERT INTO rapport(ip, id_sender, pseudo_sender, mail_sender, thedate, type, message) VALUES(?, ?, ?, ?, ?, ?, ?)");
	$insertrap->execute(array($ip, $id_sender, $pseudo_sender, $mail_sender, $thedate, $type, $message));
	sendMail($type, $lastid);
} else if($type_int == 4) {
	$type = 'Screenshot';
	$file = htmlspecialchars(basename($_FILES['theimage']['name']));
	gen_name();
	$s = explode(".",$file);
	$s[0]=$name;
	$fichier = htmlspecialchars(implode(".",$s));
	uploadimg($fichier);
	$message = htmlspecialchars("upload/".$fichier);
	if(!isset($erreur)){
		$insertrap = $bdd->prepare("INSERT INTO rapport(ip, id_sender, pseudo_sender, mail_sender, thedate, type, message) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$insertrap->execute(array($ip, $id_sender, $pseudo_sender, $mail_sender, $thedate, $type, $message));
		sendMail($type, $lastid);
	}
} else {
	$type = 'Rien';
}

function sendMail($type, $lastid) {
	$mail = 'contact@mcgeps.ca'; // Déclaration de l'adresse de destination.
  	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
  	{
   	 $passage_ligne = "\r\n";
  	}
  	else
  	{
   	 $passage_ligne = "\n";
 	 }
 	 				/*		<table width="600px">
	                 			<tr>
	                   	  			<td>
	                       				<div align="center"><b>'.$_SESSION['pseudo'].'</b>
	                       				vien d\'envoyer un rapport de type:<b>'.$type.'</b>.<br/>
	                       				<a href="http://mcgeps.ca/rapport-browser">Voir en ligne</a>.
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
	                 		</table> */
  	//=====Déclaration des messages au format HTML.
 	$message_html = '
 	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
	<html>
		<head>
			<title>G.E.P.S. - Nouveau Rapport</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="http://mcgeps.ca/assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="http://mcgeps.ca/assets/css/main.css" />
			<!--[if lte IE 8]><link rel="stylesheet" href="http://mcgeps.ca/assets/css/ie8.css" /><![endif]-->
			<!--[if lte IE 9]><link rel="stylesheet" href="http://mcgeps.ca/assets/css/ie9.css" /><![endif]-->
			<link rel="icon" type="image/ico" href="http://mcgeps.ca/images/favicon.ico"/>
			<link rel="shortcut icon" type="image/x-icon" href="http://mcgeps.ca/images/favicon.png">
		</head>
		<body>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="http://mcgeps.ca/index">G.E.P.S.</a></h1>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Nouvelle Rédation</h2>
						</header>
						<section class="wrapper style5">
							<div class="inner">
							<!-- MESSAGE START -->
								<table width="600px">
	                 			<tr>
	                   	  			<td>
	                       				<div style="color:#000;" align="center">'.$_SESSION['pseudo'].'
	                       				vien d\'envoyer rédaction de type: '.$type.'.<br/>
	                       				<a href="http://mcgeps.ca/rapport-viewer?id='.$lastid.'">Voir en ligne</a>.
					                    </div>
	                     			</td>
	                   			</tr>
	                   			<tr>
	                    			<td align="center">
	                       				<font size="2" color="#000">
	                        				Ceci est un email automatique, merci de ne pas y répondre
	                       				</font>
	                     			</td>
	                   			</tr>
	                 		</table>
	                 		<!-- MESSAGE END -->
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; G.E.P.S</li><li>Design: <a href="http://xxthegamecraft.xyz">XxTheGamecraftxX</a></li>
						</ul>
					</footer>
				</div>
			</body>
		</html>
	  ';
	  //==========Déclaration des messages au format TEXTE.
	  $message_txt = $_SESSION['pseudo'].'
	  vien d\'envoyer une rédaction de type: '.$type.' avec l\'id: '.$lastid.'.
	  ';
	  //=====Création de la boundary
	  $boundary = "-----=".md5(rand());
	  //==========
	   
	  //=====Définition du sujet.
	  $sujet = "Nouvelle Rédation";
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
	  //=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
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
	  header('refresh:0;url=profil?id='.$_SESSION['id']);
}
function gen_name($nb_caractere = 5)
{
		global $name;
        $name = "";
       
        $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ0123456789@&";
        $longeur_chaine = strlen($chaine);
       
        for($i = 1; $i <= $nb_caractere; $i++)
        {
            $place_aleatoire = mt_rand(0,($longeur_chaine-1));
            $name .= $chaine[$place_aleatoire];
        }

        return $name;
}
function uploadimg($fichier) {
	global $erreur;
	$dossier = 'upload/';
	$taille = filesize($_FILES['theimage']['tmp_name']);
	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	$extension = strrchr($_FILES['theimage']['name'], '.'); 
	//Début des vérifications de sécurité...
	if(in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		if($taille!=false)
		{
			//S'il n'y a pas d'erreur, on upload
			if(!isset($erreur)){
			//On formate le nom du fichier ici...
				$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
				if(move_uploaded_file($_FILES['theimage']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
				{
					//echo 'Upload effectué avec succès !';
				}
				else //Sinon (la fonction renvoie FALSE).
				{
					//echo 'Echec de l\'upload !';
					$erreur = 'Echec de l\'upload !';
					return $erreur;
				}
			} else {
				//echo 'il y aune erreur';
				$erreur = 'Il y aune erreur !';
				return $erreur;
			}
		} else {
			//echo 'Le fichier est trop gros...';
			$erreur = 'Le fichier est trop gros !';
			return $erreur;
		}
	} else {
		//echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
		$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg !';							// Vérifier si le type de fichier marche !!!!!!!
		return $erreur;
	}
}

if(isset($_POST['return'])) {
	header('Location: profil?id='.$_SESSION['id']);
}

?>
<?php 
	if (isset($_SESSION['id'])) {
?>
<html>
	<head>
		<title>G.E.P.S - Rédaction</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	</head>
	<body>
		<?php include_once("analyticstracking.php") ?>
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index">G.E.P.S.</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index">Accueil</a></li>
											<li><a href="encore_plus">Encore plus !</a></li>
											<li><a href="nous_rejoindre">Nous rejoindre</a></li>
											<li><a href="le_project">Le project</a></li>
											<li><a href="#"></a></li>
											<li>-= Espace Membres =-</li>
											<li><a href="profil?id=<?php echo $_SESSION['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;Retour au profil</a></li>
											<li><a href="editionprofil">&nbsp;&nbsp;&nbsp;&nbsp;Editer mon profil</a></li>
											<li><a href="deconnexion">&nbsp;&nbsp;&nbsp;&nbsp;Déconnexion</a></li>
											<li><a href="#"></a></li>
											<li><a href="politiques">Politiques</a></li>
											<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H4HEVACEMT6MW">Nous supporter</a></li>
											<div style="margin-top:30px;z-index:20000;position: fixed;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
												<!-- Menu Big Rect -->
												<ins class="adsbygoogle"
												     style="display:inline-block;width:336px;height:280px"
												     data-ad-client="ca-pub-9083504882836474"
												     data-ad-slot="5881557940"></ins>
												<script>
												(adsbygoogle = window.adsbygoogle || []).push({});
											</script></div>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Espace Rédaction</h2>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<form method="post" action="" enctype="multipart/form-data">
									<div class="row uniform">
										<div class="6u 12u$(xsmall)" style="float:none;">
											<select name="type-rapport">
												<option value="0">-- Type de rédaction --</option>
												<option value="1">Demande de ban</option>
												<option value="2">Demande de rétrogradation</option>
												<option value="3">Sopumettre un Bug trouvé</option>
												<option value="4">Soumettre un screenshot (Page «Encore Plus !»)</option>
											</select>
										</div>
										<div class="6u 12u$(xsmall)" style="float:none;">
											<input type="text" placeholder="Pseudo du joueur" id="pseudo_joueur" name="pseudo_joueur" value="<?php if(isset($pseudo_joueur)){echo $pseudo_joueur;} ?>"/>
											<input type="text" placeholder="Pseudo membre du staff" id="pseudo_staff" name="pseudo_staff" value="<?php if(isset($pseudo_staff)){echo $pseudo_staff;} ?>"/>
										</div>
										<div style="margin-bottom:30px;" id="bug-type" class="4u 12u$(small)">
												<input type="radio" id="bug-type-site" name="serv-mc" value="Site Web">
												<label for="bug-type-site">Site Web</label>
										</div>
										<div style="margin-bottom:30px;" id="bug-type-2" class="4u 12u$(small)">
												<input type="radio" id="bug-type-ts" name="serv-mc" value="TeamSpeak">
												<label for="bug-type-ts">Serveur TeamSpeak</label>
										</div>
										<div style="margin-bottom:30px;" id="bug-type-3" class="4u 12u$(small)">
												<input type="radio" id="bug-type-mc" name="serv-mc" value="Serv Mc">
												<label for="bug-type-mc">Serveur Minecraft</label>
										</div> <!-- faire bug TS -->
										<div class="6u 12u$(xsmall)" style="float:none;">
											<textarea placeholder="Raison..." id="raison" name="raison"><?php if(isset($raison_nl2br)){echo $raison_nl2br;} ?></textarea>
											<textarea placeholder="Expliquez..." id="explain" name="explain"><?php if(isset($explication_nl2br)){echo $explication_nl2br;} ?></textarea>
										</div>
										<div class="6u 12u$(xsmall)" id="theimage" style="float:none;">
											<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
											<input style="color:#000;" type="file" name="theimage"><p>(MAX: 1 Mo)</p>
										</div>
										<div id="send_mess" style="width:auto;" class="6u 12u$(xsmall)" style="float:none;">
											<p>Appuyez sur « Envoyer » et un membre du staff vous contacteras dans les 24h.</p>
										</div>
										<div class="12u$">
											<ul class="actions">
												<li id="return-2"><input name="return" type="submit" value="Retour" class="special" /></li>
												<li id="send"><input name="envoi" type="submit" value="Envoyer" class="special" /></li>
												<li id="reset"><input type="reset" value="Reset" /></li>
												<li id="return"><input name="return" type="submit" value="Retour" /></li>
											</ul>
										</div>
									</div>
								</form>
								<?php
									if(isset($erreur))
									{
										echo $erreur;
									}
								?>
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; G.E.P.S</li><li>Design: <a href="http://xxthegamecraft.xyz">XxTheGamecraftxX</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
 
	    			$('#pseudo_joueur').hide(); //cache le champ par défaut
	    			$('#pseudo_staff').hide();
	    			$('#raison').hide();
	    			$('#explain').hide();
	    			$('#bug-type').hide();
	    			$('#bug-type-2').hide();
	    			$('#bug-type-3').hide();
	    			$('#send_mess').hide();
	    			$('#send').hide();
	    			$('#reset').hide();
	    			$('#return').hide();
	    			$('#theimage').hide();
	     	
	    			$('select[name="type-rapport"]').change(function() { // lorsqu'on change de valeur dans la list
	    				var valeur = $(this).val(); // valeur sélectionné
	     
	        			if(valeur != '0') { // si pas vide
	           	 			if(valeur == '1') { // si 1
	            			    $('#pseudo_joueur').show();
	            			    $('#raison').show(); 
	            			    $('#pseudo_staff').hide(); 
	            			    $('#explain').hide();
	    						$('#bug-type').hide();
	    						$('#bug-type-2').hide();
	    						$('#bug-type-3').hide();
	    						$('#send_mess').show();
	    						$('#send').show();
	    						$('#reset').show();
	    						$('#return').show();
	    						$('#return-2').hide();
	    						$('#theimage').hide();
	          			  	} else if(valeur == '2') {
	          			  		$('#pseudo_staff').show();
	            			    $('#raison').show();
	            			    $('#pseudo_joueur').hide();
	            			    $('#explain').hide();
	    						$('#bug-type').hide();
	    						$('#bug-type-2').hide();
	    						$('#bug-type-3').hide();
	    						$('#send_mess').show();
	    						$('#send').show();
	    						$('#reset').show();
	    						$('#return').show();
	    						$('#return-2').hide();
	    						$('#theimage').hide();
	            			} else if(valeur == '3') {
								$('#explain').show();
								$('#bug-type').show();
								$('#bug-type-2').show();
								$('#bug-type-3').show();
	            				$('#pseudo_joueur').hide();
	           	 		    	$('#pseudo_staff').hide(); 
	           	 		    	$('#raison').hide();
	    						$('#send_mess').show();
	           	 		    	$('#send').show();
	    						$('#reset').show();
	    						$('#return').show();
	    						$('#return-2').hide();
	    						$('#theimage').hide();
	           	 		    } else if(valeur == '4') {
	           	 		    	$('#send_mess').show();
								$('#explain').hide();
								$('#bug-type').hide();
								$('#bug-type-2').hide();
								$('#bug-type-3').hide();
	            				$('#pseudo_joueur').hide();
	           	 		    	$('#pseudo_staff').hide(); 
	           	 		    	$('#raison').hide();
	           	 		    	$('#send').show();
	    						$('#reset').show();
	    						$('#return').show();
	    						$('#return-2').hide();
	    						$('#theimage').show();
	          			  	} else {
	          			  		$('#pseudo_joueur').hide();
	           	 		    	$('#pseudo_staff').hide(); 
	           	 		    	$('#raison').hide();
	           	 		    	$('#explain').hide();
	    						$('#bug-type').hide();
	    						$('#bug-type-2').hide();
	    						$('#bug-type-3').hide();
	    						$('#send_mess').hide();
	    						$('#send').hide();
	    						$('#reset').hide();
	    						$('#return').show();
	    						$('#return-2').hide();
	    						$('#theimage').hide();
	           	 		    }
	       				} else {
	       					$('#pseudo_joueur').hide();
	       					$('#pseudo_staff').hide(); 
	       					$('#raison').hide();
	       					$('#explain').hide();
	    					$('#bug-type').hide();
	    					$('#bug-type-2').hide();
	    					$('#bug-type-3').hide();
	    					$('#send_mess').hide();
	    					$('#send').hide();
	    					$('#reset').hide();
	    					$('#return').hide();
	    					$('#theimage').hide();
	    					$('#return-2').show();
	       				}
	  	  			});
 
				});
			</script>
			<script type="text/javascript">
				// create the back to top button
				$('body').prepend('<a href="#" style="text-decoration: none;" class="back-to-top">Back to Top</a>');

				var amountScrolled = 300;

				$(window).scroll(function() {
					if ( $(window).scrollTop() > amountScrolled ) {
						$('a.back-to-top').fadeIn('slow');
					} else {
						$('a.back-to-top').fadeOut('slow');
					}
				});

				$('a.back-to-top, a.simple-back-to-top').click(function() {
					$('html, body').animate({
						scrollTop: 0
					}, 700);
					return false;
				});
			</script>
	</body>
</html>
<?php 
} else {
	header('Location: connexion');
}
?>