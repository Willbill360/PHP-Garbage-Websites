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

if(isset($_GET['fiche']) AND $_GET['fiche'] > 0) {
   $getfiche = intval($_GET['fiche']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE fnumber = ?');
   $requser->execute(array($getfiche));
   $userinfo = $requser->fetch();

?>
<?php
	if(isset($_SESSION['id'])) {
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
	<body oncontextmenu="return false" class="no-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1>Visualisateur de fiche</h1>
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index">Accueil</a></li>
								<li><a href="profil?id=<?php echo $_SESSION['id']; ?>">Retour au profil</a></li>
								<li><a href="deconnexion">Déconnexion</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<div style="background:none;" class="wrapper style1">

					<div class="container">
						<article id="main" class="special">
							<div align="center" class="inner">
								<header>
										<section class="carousel">
											<article style="padding-bottom:0px;">
												<a class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="fiches/<?= $userinfo['fnumber'] ?>.jpg" alt="" /></a>
												<header>
													<h3>Fiche n&#186; <?= $userinfo['fnumber'] ?></h3>
													<?php  if($_SESSION['grade'] == 2) { ?>
													<?php if($userinfo['insc_date'] == 'Not Registered') { ?>
														<?php if($userinfo['nom'] != 'Not Registered') { ?>
															<p style="margin-bottom:0px;"><?= $userinfo['prenom']." "; ?><?= $userinfo['nom']; ?></p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-top:0px;">Indisponible</p>
														<?php } else { ?>
															<p style="margin-bottom:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-bottom:0px;margin-top:0px;">Indisponible</p>
															<p style="margin-top:0px;">Indisponible</p>
														<?php } ?>
													<?php } else { ?>
														<p style="margin-bottom:0px;"><?= $userinfo['prenom']." "; ?><?= $userinfo['nom']; ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $userinfo['ip'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $userinfo['mail'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;">Grade: <?= $userinfo['grade'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $a['insc_date'] ?></p>
														<p style="margin-top:0px;">Total: <?= $userinfo['total'] ?></p>
													<?php } ?>
												<?php } else { ?>
													<?php if($userinfo['insc_date'] == 'Not Registered') { ?>
														<p>Indisponible</p>
													<?php } else { ?>
														<p><?= $userinfo['prenom']." "; ?><?= $userinfo['nom']; ?></p>
													<?php } ?>
												<?php } ?>
												</header>
											</article>
										</section>
										<div style="margin-top:80px;" class="6u 12u$(medium)">
									<ul style="margin-bottom:0px;" class="actions fit">
										<li><a href="<?php if(isset($_SERVER['HTTP_REFERER']) AND !empty($_SERVER['HTTP_REFERER'])) {echo $_SERVER['HTTP_REFERER'];}else{echo 'index';} ?>" class="button fit special">Retour</a></li>
									</ul>
								</div>
								</header>
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