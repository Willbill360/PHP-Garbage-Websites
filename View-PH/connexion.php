<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();
session_destroy();
session_start();
include_once('config.php');

include('cookieconnect.php');

if(isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			if(isset($_POST['rememberme']))
			{
				setcookie('password', $mdpconnect, time() + 365*24*3600, '/', null, false, true);
				setcookie('email', $mailconnect, time() + 365*24*3600, '/', null, false, true);
			}
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['fnumber'] = $userinfo['fnumber'];
			$_SESSION['mail'] = $userinfo['mail'];
			$_SESSION['grade'] = $userinfo['grade'];
			$_SESSION['total'] = $userinfo['total'];
			header("Location: profil?id=".$_SESSION['id']);

			$line = "[".date('Y-m-d] [H:i:s') . "] - $_SERVER[REMOTE_ADDR]";
			file_put_contents('connexion.log', $line . PHP_EOL, FILE_APPEND);
		}
		else
		{
			$erreur = "Mauvais email ou mot de passe !";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complété !";
	}
}
?>
<html>
	<head>
		<title>ViewPH - Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1>Connexion Membres</h1>
								<p>Formulaire de connexion à l'espace membre</p>
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index">Accueil</a></li>
								<li><a href="connexion">Connexion</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<div class="wrapper style1">

					<div class="container">
						
						<section class="wrapper style5">
							<div class="inner">
								<section>
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
												<label style="color:#000;" for="rememberme">Se souvenir de moi</label>
											</div>
											<div class="12u$">
												<ul class="actions">
													<li><input name="formconnexion" type="submit" value="Se connecter" class="special" /></li>
													<li><input type="reset" value="Reset" /></li>
												</ul>
								 			</div>
										</div>
									</form>
								</section>
								<?php
									if(isset($erreur))
									{
										echo $erreur;
									}
								?>
							</div>
						</section>
					</div>

				</div>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

						</div>
						<div style="margin-top:30px;" class="row">
							<div class="12u">

								<!-- Copyright -->
									<div style="font-size:100%;" class="copyright">
										<ul class="menu">
											<li>&copy; ViewPH. Tous droits réservés.</li>
										</ul>
									</div>

							</div>

						</div>
					</div>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.onvisible.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>