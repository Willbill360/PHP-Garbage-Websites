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

$fiche = $bdd->query('SELECT * FROM membres ORDER BY fnumber ASC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
   $fiche = $bdd->query('SELECT * FROM membres WHERE fnumber LIKE "%'.$q.'%" ORDER BY fnumber ASC');
   if($fiche->rowCount() == 0) {
      $fiche = $bdd->query('SELECT * FROM membres WHERE CONCAT(fnumber, nom, prenom, mail, ip) LIKE "%'.$q.'%" ORDER BY fnumber ASC');
   }
}

?>
<?php
	if(isset($_SESSION['grade']) AND $_SESSION['grade'] >= 1) {
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
								<h1>Visualisateur de toutes les fiches</h1>
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
								<form method="GET">
									<div class="6u$ 12u$(xsmall)" style="float:none;">
										<input type="text" name="q" placeholder="Recherche..." value="<?php if(isset($q)){echo $q;} ?>"/><br/>
									</div>
								</form>
								<header>
								<section class="carousel">
								<?php if($fiche->rowCount() > 0) { ?>
									<?php while($a = $fiche->fetch()) { ?>
										<article style="margin-top:3%;padding-bottom:0px;">
											<a class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="fiches/<?= $a['fnumber'] ?>.jpg" alt="" /></a>
											<header>
												<h3>Fiche n&#186; <?= $a['fnumber'] ?></h3>
												<?php  if($_SESSION['grade'] == 2) { ?>
													<?php if($a['insc_date'] == 'Not Registered') { ?>
														<?php if($a['nom'] != 'Not Registered') { ?>
															<p style="margin-bottom:0px;"><?= $a['prenom']." "; ?><?= $a['nom']; ?></p>
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
														<p style="margin-bottom:0px;"><?= $a['prenom']." "; ?><?= $a['nom']; ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $a['ip'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $a['mail'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;">Grade: <?= $a['grade'] ?></p>
														<p style="margin-bottom:0px;margin-top:0px;"><?= $a['insc_date'] ?></p>
														<p style="margin-top:0px;">Total: <?= $a['total'] ?></p>
													<?php } ?>
												<?php } else { ?>
													<?php if($a['insc_date'] == 'Not Registered') { ?>
														<p>Indisponible</p>
													<?php } else { ?>
														<p><?= $a['prenom']." "; ?><?= $a['nom']; ?></p>
													<?php } ?>
												<?php } ?>
											</header>
										</article>
									<?php } ?>
										</section>
								</header>
								<?php } else { ?>
									Aucun résultat pour: <?= $q ?>...
								<?php } ?>
								<div style="margin-top:80px;" class="6u 12u$(medium)">
									<ul style="margin-bottom:0px;" class="actions fit">
										<li><a href="profil?id=<?= $_SESSION['id'] ?>" class="button fit special">Retour</a></li>
									</ul>
								</div>
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