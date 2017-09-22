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

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

/*require('API/JsonApi/JSONAPI.php');
 
//on remplie les paramètres de connection à JSONAPI
 
$ip = 'craft44.crystal-serv.com'; // Ip du serveur
$port = 26208; //port du plugin (par défaut : 20059)
$user = 'admin'; //nom d'utilisateur
$pass = 'CCa310sT5b'; //mot de passe
$salt ='salt'; //phrase clé²
$api = new JSONAPI($ip, $port, $user, $pass, $salt);*/
?>
<?php
	if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
?>
<html>
	<head>
		<title>G.E.P.S - Espace Membre</title>
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
											<li><a href="editionprofil">&nbsp;&nbsp;&nbsp;&nbsp;Editer mon profil</a></li>
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
							<h2>Espace Membre G.E.P.S.</h2>
						</header>
						<section class="wrapper style5">
							<div align="center" class="inner">
								<h2>Mon profil</h2>
								<br>
								<br>
								<table class="table-wrapper">
									<tbody>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Nom Complet</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['prenom']; ?> <?php echo $userinfo['nom']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Pseudo</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['pseudo']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Âge</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['age']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Adresse Email</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['mail']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Pays</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['pays']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Sexe</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['sexe']; ?></h5></td>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Grade</h5></td>                           <?php //	0 = Joueur | 1 = Fonda | 2 = Modo | 3 = Admin | 4 = Youtuber ?>
											<?php if($userinfo['grade'] == 0) {?>
												<td><h5 style="text-transform:none;">Joueur</h5></td>
											<?php } else if ($userinfo['grade'] == 1) {?>
												<td><h5 style="text-transform:none;">Fondateur</h5></td>
											<?php } else if ($userinfo['grade'] == 2) {?>
												<td><h5 style="text-transform:none;">Modo</h5></td>
											<?php } else if ($userinfo['grade'] == 3) {?>
												<td><h5 style="text-transform:none;">Admin</h5></td>
											<?php } else if ($userinfo['grade'] == 4) {?>
												<td><h5 style="text-transform:none;">Youtubeur</h5></td>
											<?php }?>
										</tr>
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Date d'inscription</h5></td>
											<td><h5 style="text-transform:none;"><?php echo $userinfo['insc_date']; ?></h5></td>
										</tr>
										<!--<tr>
											<td style="vertical-align:top;"><h5><img class="money" src="images/UM.png" /></h5></td>
											<td><h5>
												<?php

													//$getBalance = $api->call('econ.getBalance', array(''.$userinfo['pseudo'].''));
													//$balance = $getBalance['0']['success'];
													//echo $balance;
	                							?>
                							</h5></td>
										</tr>-->
										<tr>
											<td style="vertical-align:top;"><h5 style="text-transform:none;">Skin</h5></td>
											<td><iframe src="3d-skin-viewer.php?id=<?=$userinfo['pseudo'];?>" width="100%" height="300px" frameborder="0" scrolling="no"></iframe></td>
										</tr>
									</tbody>
								</table>
								<div style="margin-top:20px;" class="6u 12u$(medium)">
									<ul class="actions fit">
										<li><a href="editionprofil" class="button fit special">Editer mon profil</a></li>
										<li><a href="boutique" class="button fit special">Boutique</a></li>
									</ul>
									<ul class="actions fit">
										<li><a href="rapport" class="button fit special">Rédaction</a></li>
										<li><a href="forum" class="button fit special">Forum</a></li>
									</ul>
									<!--<ul class="actions fit">
										<li><a href="vote" class="button fit special">Voter</a></li>
									</ul>-->
								</div>
								
								<?php if(isset($_SESSION['grade']) AND $_SESSION['grade']==1) { ?>
								<br/>
								<br>
								<br>
								<hr>
								<br/>
								<h2>Espace Administration G.E.P.S.</h2>
								<br>
									<div style="margin-top:20px;" class="6u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="console" class="button fit special">Console</a></li>
										</ul>
									</div>
									<div style="margin-top:20px;" class="6u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="profil-browser" class="button fit special">Rechercher un joueur</a></li>
										</ul>
									</div>
									<div style="margin-top:20px;" class="6u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="rapport-browser" class="button fit special">Voir les rédactions</a></li>
										</ul>
									</div>
									<div style="margin-top:20px;" class="6u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="admin-forum" class="button fit special">Administration Forum</a></li>
										</ul>
									</div>
									<div style="margin-top:20px;" class="6u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="update-tsmdp" class="button fit special">Mettre à jour le MDP des Salons privés</a></li>
										</ul>
									</div>
								<?php } ?>
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
} else {
		header("Location: connexion");
	}
?>