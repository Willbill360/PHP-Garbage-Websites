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
?>
<html>
	<head>
		<title>ViewPH - Accueil</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	</head>
	<body  oncontextmenu="return false" class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="index" id="logo">ViewPH</a></h1>
								<hr />
								<p>Voyez la photo g&ecirc;nante des gens que vous rencontrez chaque jour !</p>
							</header>
							<footer>
								<a href="connexion" class="button circled scrolly">D&eacute;buter</a>
							</footer>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index">Accueil</a></li>
								<li><a href="connexion">Connexion</a></li>
							</ul>
						</nav>

				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Voici les 10 derni&egrave;res personnes trouv&eacute;es.</h2>
						<p>
							On esp&egrave;re que ce n'est pas vous !
						</p>
					</header>
				</section>

			<!-- Carousel -->
				<section class="carousel">
					<div class="reel">
						<?php if(isset($_SESSION['id'])) { 
							$reqfiche = $bdd->query('SELECT fnumber FROM membres ORDER BY id DESC LIMIT 10');
							while($thefnumber = $reqfiche->fetch()) {
								$prevfnumber = $thefnumber['fnumber'];
						?>
							<article>
								<a href="view?fiche=<?= $prevfnumber ?>" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="fiches/<?= $prevfnumber ?>.jpg" alt="" /></a>
								<header>
									<h3><a href="view?fiche=<?= $prevfnumber ?>">Fiche n&#186; <?= $prevfnumber ?></a></h3>
								</header>
							</article>
						<?php } } else {?>
						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic01.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic02.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic03.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic04.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic05.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic01.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic02.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic03.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic04.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>

						<article>
							<a href="connexion" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="images/pic05.jpg" alt="" /></a>
							<header>
								<h3><a href="connexion">Connectez-vous !</a></h3>
							</header>
						</article>
						<?php } ?>
					</div>
				</section>

			<!-- Main -->
				<div class="wrapper style2">

					<article style="padding-top:30px;" id="main" class="container special">
						<header>
							<h2>Pourquoi nous existons ?</h2>
							<p>
								Une simple histoire de faille...
							</p>
						</header>
						<p>
							Par un beau jour ensoleillé, l'équipe de ViewPH à remarqué cetaines failles dans
							les systèmes de la Commission Scolaire et du Paul-Hubert... Alors nous avons décidé de l'exploiter !
							Et c'est justement parce que nous ne voulions pas garder ces trésors pour nous seuls que nous avons créé ce site.
							Nous somme conscient que les photos de cartes étudiantes que nous avons récupérées sont sensibles et
							parfois gênantes, nous en sommes sincèrement désolé et c'est pourquoi nous vous proposons d'effacer
							votre photo de nos systèmes si tel est le cas... Mais avouez que c'est assez drole !
						</p>
					</article>

				</div>

			<!-- Features -->
				<div class="wrapper style1">

					<section id="features" class="container special">
						<header>
							<h2>Qui sommes nous ?</h2>
							<p>C'est une bonne question...</p>
						</header>
						<p>
							Nous croyons que garder notre identité secrète est justifié, et nous
							ne la divulgerons en aucun cas et sous aucun prétexte... Vraiment désolé.
							Mais l'anonymat c'est beaucoup plus mystérieux... Nous pourions être votre 
							voisin, votre soeur, votre frère et c'est ça qui est le fun !
						</p>
					</section>

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
											<li>&copy; ViewPH. Tous droits r&eacute;serv&eacute;s.</li>
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