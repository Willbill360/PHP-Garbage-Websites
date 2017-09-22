<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	include_once('config.php');
	//include_once('API/JsonApi/info-jsonapi.php');
?>
<html>
	<head>
		<title>G.E.P.S - Accueil</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	</head>
	<body class="landing">
		<?php include_once("analyticstracking.php") ?>
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
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
											<div style="margin-top:50px;z-index:10000;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>G.E.P.S.</h2>
							<p>Serveur Minecraft Ultra Hardcore<br />
							plus de 90 mods actifs<br />
							100 % gratuit <br />
							24h/24h !!
							<!-- <?php 
							//etat serv (online/offline)
								if ($ip and $port2 and $timeout) {
								    $verbinding =  @fsockopen($ip, $port2, $errno, $errstr, $timeout);
								}
								if($verbinding) {
								    echo "<p>Serveur: <span style='color: #00ff00;'>Online</span></p></span><br/>";
								}
								else {
								    echo "<p>Serveur: <span style='color: #ff0000;'>Offline</span></p></span><br/>";
								}
							?>--></p>
							<ul class="actions">
								<li><a href="http://play.mcgeps.ca:26207/" class="button special">Voir la dynmap</a></li>
							</ul>
						</div>
						<a href="#one" class="more scrolly">Apprenez en plus !</a>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style1 special">
						<div class="inner">
							<header class="major">
								<h2>G</h2>ame <h2>E</h2>xpérimentation <h2>P</h2>roject <h2>S</h2>erver<br />
								
								<p>Est un serveur Minecraft Ultra Hardcore moddé et Québecois, avec un staff actif et des possibilités pour tous !</p>
							</header>
							<ul class="icons major">
								<li><span class="icon fa-flask major style1"><span class="label">Lorem</span></span></li>
								<li><span class="icon fa-comments major style2"><span class="label">Ipsum</span></span></li>
								<li><span class="icon fa-cogs major style3"><span class="label">Dolor</span></span></li>
							</ul>
						</div>
					</section>

				<!-- Two -->
					<section id="two" class="wrapper alt style2">
						<section class="spotlight">
							<div class="image"><img src="images/pic01.jpg" alt="" /></div><div class="content">
								<h2>Biome Ô Plenty<br />
								De nouveaux biomes à découvrir !</h2>
								<p>Avec ce mod très connu vous pourrez découvrir plus de 75 nouveaux biomes, de quoi transformer votre jeux !</p>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="images/pic02.jpg" alt="" /></div><div class="content">
								<h2>Applied Energistics 2<br />
								Le stockage simplifié</h2>
								<p>Mare de rangé vos coffres ? Profitez de la référence dans le stockage avec Applied Energistics 2 !</p>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="images/pic03.jpg" alt="" /></div><div class="content">
								<h2>Une expérience visuelle...<br />
								surprennante</h2>
								<p>Le mod Shaders ainsi que Better Foliage transformeront totalement les ombres et l'éclairage et amélioreront votre aventure comme jamais.</p>
							</div>
						</section>
					</section>

				<!-- Three -->
					<section id="three" class="wrapper style3 special">
						<div class="inner">
							<header class="major">
								<h2>G.E.P.S. un serveur nouveau genre</h2>
								<p>Avec un staff toujours ouvert à de nouvelles propositions, G.E.P.S. est un arrêt incontournable 
								pour tout les joueurs voulant commencer quelque chose de nouveau dans un univers aux possibilitées multipliées.
								Les cubos sont assurés pas le célèbre plugin Grief Prevention qui permet, grâce a un simple bâton, de protèger une zone allant jusqu'à 2 000 000 bloc² !
								</p>
							</header>
							<ul class="features">
								<li class="icon fa-laptop">
									<h3>Nécessité</h3>
									<p>Pour lancer les modpacks il est OBLIGATOIRE d'avoir Java 64bits et un minimum de 4 Go de RAM. Un bon PC est donc recommandé.</p>
								</li>
								<li class="icon fa-headphones">
									<h3>Serveur vocal</h3>
									<p>Rejoingnez nous sur notre TeamSpeak : ts.mcgeps.ca:10197</p>
								</li>
								<li class="icon fa-heart-o">
									<h3>Vous aimez le serveur ?</h3>
									<p>Faite le découvrir à vos amis, à votre famille, à la planète !</p>
								</li>	
							</ul>
						</div>
					</section>

				<!-- CTA -->
					<section id="cta" class="wrapper style4">
						<div class="inner">
							<header>
								<h2>Rejoignez nous !</h2>
								<p>Et commencer quelque chose de nouveau !</p>
							</header>
							<ul class="actions vertical">
								<li><a href="nous_rejoindre" class="button fit special">Commencer !</a></li>
								<li><a href="encore_plus" class="button fit">Encore plus !</a></li>
							</ul>
						</div>
					</section>

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
							<li>Votez pour <a href="http://www.mcserv.org/GEPS_9147.html">mon serveur</a> sur <a href="http://www.mcserv.org/">McServ.org</a><li><br/>
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

	</body>
</html>