<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
//On commence la session puis la ferme et la reouvre pour avoir une nouvelle session vierge
session_start();
session_destroy();
session_start();
//Inclusion des fichiers élémentaires
include_once('config.php');
include('cookieconnect.php');

//Code de vérification du formulaire de connexion
if(isset($_POST['formconnexion']))
{
	//Récupération des valeurs des champs et sécurisation
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	//Si les champs ne sont pas vide alors on continue
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		//Connexion à la bdd
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		//On compte le nombre de ligne existant avec les identifiant donnée dans les champs
		$userexist = $requser->rowCount();
		//Si l'utilisateur existe alors
		if($userexist == 1)
		{
			//Si l'utilisateur a chochez la case de co auto
			if(isset($_POST['rememberme']))
			{
				//On créé les cookies de connexion
				setcookie('password', $mdpconnect, time() + 365*24*3600, '/', null, false, true);
				setcookie('email', $mailconnect, time() + 365*24*3600, '/', null, false, true);
			}
			//Création des variables de sessions
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail'];
			$_SESSION['grade'] = $userinfo['grade'];
			//Redirection vers la page du profil
			header("Location: profil?id=".$_SESSION['id']);
		}
		else //Si les champs ne sont pas bon
		{
			$erreur = "Mauvais email ou mot de passe !";
		}
	}
	else //Si les champs ne sont pas rempli
	{
		$erreur = "Tous les champs doivent être complété !";
	}
}

?>
<html>
	<head>
		<title>G.E.P.S - Connexion</title>
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
											<li><a href="connexion">Connexion Membres</a></li>
											<li><a href="#"></a></li>
											<li><a href="politiques">Politiques</a></li>
											<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H4HEVACEMT6MW">Nous supporter</a></li>
											<div style="margin-top:50px;z-index:20000;position: fixed;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
							<h2>Connexion Membres G.E.P.S.</h2>
							<p>Formulaire de connexion à l'espace membre</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<section>
								<!-- Ici le code du formulaire -->
									<h4 style="margin-bottom:0px;">Connexion</h4><p style="font-size:65%;">Vous ne posédez pas encore de compte ? <a href="inscription">Inscrivez-vous ici !</a></p>
									<form method="post" action="">
										<div class="row uniform">
											<div class="6u 12u$(xsmall)">
												<input type="email" name="mailconnect" id="mailconnect" value="" placeholder="Email" />
											</div>
											<div class="6u$ 12u$(xsmall)">
												<input type="password" name="mdpconnect" id="mdpconnect" value="" placeholder="Mot de passe" />
											</div>
											<div class="6u$ 12u$(small)">
												<input type="checkbox" id="rememberme" name="rememberme">
												<label for="rememberme">Se souvenir de moi</label>
											</div>
											<div class="12u$">
												<ul class="actions">
													<li><input name="formconnexion" type="submit" value="Se connecter" class="special" /></li>
													<li><input type="reset" value="Reset" /></li>
												</ul>
								 			</div>
										</div>
									</form>
									<!-- Jusque ici -->
								</section>
								<!-- Si une erreur existe on affiche lerreur (permet de cacher le champs si pas derreur ou au reload) -->
								<?php
									if(isset($erreur))
									{
										echo $erreur;
									}
								?>
								<!-- Jusque ici -->
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
				// Button du back to top (toute la balise script)
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
