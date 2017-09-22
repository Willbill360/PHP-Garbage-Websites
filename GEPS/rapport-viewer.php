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
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u924407628_mbre', 'u924407628_geps', '0Otfk4rNnz');
}

include_once('cookieconnect.php');

$result;

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM rapport WHERE id = ?');
   $requser->execute(array($getid));
   $rapportinfo = $requser->fetch();

   $msg_lenght = strlen($rapportinfo['message']);

	function sendMail($content, $themail) {
		$mail = $themail; // Déclaration de l'adresse de destination.
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
				<title>G.E.P.S. - Screenshot</title>
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
								<h2>Screenshot</h2>
							</header>
							<section class="wrapper style5">
								<div class="inner">
								<!-- MESSAGE START -->
									<table width="600px">
		                 			<tr>
		                   	  			<td>
		                   	  				'.$content.'
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
								<li>&copy; G.E.P.S.</li><li>Design: <a href="http://xxthegamecraft.xyz">XxTheGamecraftxX</a></li>
							</ul>
						</footer>
					</div>
				</body>
			</html>
		  ';
		  //=====Création de la boundary
		  $boundary = "-----=".md5(rand());
		  //==========
		   
		  //=====Définition du sujet.
		  $sujet = "Retour soumission de screenshot";
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

	if (isset($_POST['sup'])){
   		$sql = ("DELETE FROM rapport WHERE id =".$getid);
		$bdd->exec($sql);
		if ($rapportinfo['type'] == 'Screenshot') {
			unlink($rapportinfo['message']);   
			$content = '<div style="color:#000;" align="center">Désolé '.$rapportinfo['pseudo_sender'].',
			mais votre screenshot du server n\'a été accepter. Il ne répondait pas à nos critaires.<br/>
			</div>';
			$themail = $rapportinfo['mail_sender'];
			sendMail($content, $themail);
		}
		header('Location: rapport-browser');
   }

   if (isset($_POST['accept'])) {
   		$fname = substr($rapportinfo['message'], strpos($rapportinfo['message'], "/") + 1);    
		rename($rapportinfo['message'], 'images/user_src/'.$fname);
		$imgpath = 'images/user_src/'.$fname;
   		$insertschot = $bdd->prepare("INSERT INTO screenshot_more(id_sender, pseudo_sender, img) VALUES(?, ?, ?)");
		$insertschot->execute(array($rapportinfo['id_sender'], $rapportinfo['pseudo_sender'], $imgpath));
		$content = '<div style="color:#000;" align="center">Félicitation '.$rapportinfo['pseudo_sender'].'
		votre screenshot du server à été accepté !<br/>
		<a href="http://mcgeps.ca/encore_plus">Le voir en ligne</a>.
		</div>';
		$themail = $rapportinfo['mail_sender'];
		sendMail($content, $themail);
		$sql = ("DELETE FROM rapport WHERE id =".$getid);
		$bdd->exec($sql);
		header('Location: rapport-browser');
   }

?>
<?php
	if(isset($_SESSION['grade']) AND $_SESSION['grade'] == 1) {
?>
<html>
	<head>
		<title>G.E.P.S - Visualisateur de rapport</title>
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
											<li><a href="boutique">&nbsp;&nbsp;&nbsp;&nbsp;Boutique</a></li>
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
							<h2>Visualisateur de profil</h2>
						</header>
						<section class="wrapper style5">
							<div align="center" class="inner">
								<h2>Rapport de <?php echo $rapportinfo['pseudo_sender']; ?></h2>
								<br>
								<br>
								<table class="table-wrapper">
									<tbody>
										<tr>
											<td><h5 style="text-transform:none;">ID Demandeur</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['id_sender']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">IP Demandeur</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['ip']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">Pseudo Demandeur</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['pseudo_sender']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">Email Demandeur</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['mail_sender']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">ID rédaction</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['id']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">Date de rédaction</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['thedate']; ?></h5></td>
										</tr>
										<tr>
											<td><h5 style="text-transform:none;">Type de rédaction</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $rapportinfo['type']; ?></h5></td>
										</tr>
										<tr>
											<?php if($rapportinfo['type'] != 'Screenshot') { ?>
											
												<td><h5 style="text-transform:none;">Raison/Explication</h5></td>
												<?php $mess = chunk_split($rapportinfo['message'], 75, "\n\r"); ?>
												<td><h5 style="width:250px;text-transform:none;"><?php echo $mess; ?></h5></td>
											
											<?php } else { ?>
												<td><h5 style="text-transform:none;">Le screenshot</h5></td>
												<td><img src="<?php echo $rapportinfo['message']; ?>" /><td>
											<?php } ?>
										</tr>
									</tbody>
								</table>
								<form method="POST" action="">
									<div style="margin-top:20px;" class="8u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="rapport-browser" class="button fit special">Retour</a></li>
											<?php if($rapportinfo['type'] == 'Screenshot') { ?>
												<li><input type="submit" class="button fit" name="accept" value="Accepter"/></li>
											<?php } ?>
											<li><input type="submit" class="button fit" name="sup" value="Supprimer"/></li>
										</ul>
									</div>
								</form>
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
							<li>&copy; G.E.P.S.</li><li>Design: <a href="http://xxthegamecraft.xyz">XxTheGamecraftxX</a></li>
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
		header("Location: connexion");
	}
?>
<?php   
}
?>