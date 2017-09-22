<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();

include_once('config.php');

include_once('cookieconnect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

?>
<?php
	if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
?>
<html>
	<head>
		<title>ViewPH - Profil</title>
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
								<h1>Espace membre ViewPH</h1>
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index">Accueil</a></li>
								<li><a href="deconnexion">Déconnexion</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<div class="wrapper style1">

					<div class="container">
						
						<article id="main" class="special">
							<div align="center" class="inner">
								<h2>Mon profil</h2>
								<br>
								<br>
								<table align="center" class="table-wrapper">
									<tbody>
										<tr>
											<td><h5>Nom</h5></td>
											<td><h5><?php echo $userinfo['nom']; ?></h5></td>
										</tr>
										<tr>
											<td><h5>Prénom</h5></td>
											<td><h5><?php echo $userinfo['prenom']; ?></h5></td>
										</tr>
										<tr>
											<td><h5>Numéro de fiche</h5></td>
											<td><h5><?php echo $userinfo['fnumber']; ?></h5></td>
										</tr>
										<tr>
											<td><h5>Adresse Email</h5></td>
											<td><h5><?php echo $userinfo['mail']; ?></h5></td>
										</tr>
										<tr>
											<td><h5>Date d'inscription</h5></td>
											<td><h5><?php echo $userinfo['insc_date']; ?></h5></td>
										</tr>
										<tr>
											<td><h5>Total de photo trouvé</h5></td>
											<td><h5><?php echo $userinfo['total']; ?></h5></td>
										</tr>
									</tbody>
								</table>
								<div style="margin-top:20px;" class="7u 12u$(medium)">
									<ul class="actions fit">
										<li><a href="voir-spec" class="button fit special">Voir des photos (Spécifique)</a></li>
										<li><a href="voir-random" class="button fit special">Voir des photos (Aléatoire)</a></li>
										<li><a href="editionprofil" style="margin-top:5px;" class="button fit special">Éditer mon profil</a></li>
									</ul>
								</div>
								<?php if($userinfo['grade'] >= 1) { ?> <?php //	0 = Normal | 1 = Firend | 2 = Admin	?>
									<hr/>
									<h2>Espace VIP</h2>
									<div style="margin-top:20px;" class="7u 12u$(medium)">
										<ul class="actions fit">
											<li><a href="viewall" class="button fit special">Voir toutes les photos</a></li>
										</ul>
									</div>
								<?php } ?>
							</div>
						</article>
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
<?php
	} else {
		header("Location: connexion");
	}
?>
<?php   
}
?>