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

if(isset($_POST['mdpts'])){
	$newmdp = htmlspecialchars($_POST['mdpts']);
}

if(isset($_POST['update'])) {
	$fichiermdp = fopen('tsmdp.txt', 'w+');
	fseek($fichiermdp, 0);
	fputs($fichiermdp, $newmdp);
	fclose($fichiermdp);
	$reqts = $bdd->query('SELECT * FROM tsmdp ORDER BY id ASC');
	while($userts = $reqts->fetch()){

		if($userts['monthLeft'] == '0') {
			$sql = ("DELETE FROM tsmdp WHERE id =".$userts['id']);
			$bdd->exec($sql);
			$insertmonthleft = $bdd->prepare("UPDATE membres SET monthLeft = ?, asTS = ? WHERE id = ?");
         	$insertmonthleft->execute(array('-1','Non', $_SESSION['id']));
		} else if($userts['monthLeft'] >=1) {
			$mLeft = $userts['monthLeft'];
			$mLeft = $mLeft - 1;
			$insertmonthleftts = $bdd->prepare("UPDATE tsmdp SET monthLeft = ? WHERE id = ?");
         	$insertmonthleftts->execute(array($mLeft, $_SESSION['id']));
         	$insertmonthleft = $bdd->prepare("UPDATE membres SET monthLeft = ? WHERE id = ?");
         	$insertmonthleft->execute(array($mLeft, $_SESSION['id']));

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
		}
	}
	header('refresh:1;url=profil?id='.$_SESSION['id']);
}

if(isset($_POST['return'])) {
	header('Location: profil?id='.$_SESSION['id']);
}
?>
<?php
	if(isset($_SESSION['grade']) AND $_SESSION['grade'] == 1) {
?>
<html>
	<head>
		<title>G.E.P.S - Update MDP</title>
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
							<h2>Mise à jour du mot de passe</h2>
							<p>des salons privés TeamSpeak</p>
						</header>
						<section class="wrapper style5">
							<div align="center" class="inner">
								<form method="post" action="">
									<div class="6u 12u$(xsmall)" style="float:none;">
										<label for="mdpts">Mot de passe:</label>
										<input type="text" placeholder="Nouveau Mot de Passe" id="mdpts" name="mdpts" autocomplete="off" value="<?php if(isset($tsmdp)){echo $tsmdp;}else{echo $newmdp;} ?>"/>
									</div>
									<div style="margin-top:30px;" class="12u$">
										<ul class="actions">
											<li><input name="update" type="submit" value="Mettre à jour" class="special" /></li>
											<li><input type="submit" name="return" value="Retour" /></li>
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
}
else
{
	header("Location: connexion");
}
?>