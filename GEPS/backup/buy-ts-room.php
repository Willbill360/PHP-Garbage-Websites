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

include_once('cookieconnect.php');

if(isset($_POST['os0'])) {
	$prix_format = ceil($_POST['os0']);
} else {
	$prix_format = 0;
}
//Reel =  RVZ4KNHDTMVYE
//Sandbox =  GWQLWK7436CYJ
if(!isset($_COOKIE['tsbought'])) {
	if($prix_format == 1) {
		$month = 1;
		$_SESSION['mLeft'] = $month;
		header('refresh:0;url=https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RVZ4KNHDTMVYE&os0=1+Mois&currency_code=EUR');
	} else if($prix_format == 6) {
		$month = 6;
		$_SESSION['mLeft'] = $month;
		header('refresh:0;url=https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RVZ4KNHDTMVYE&os0=6+Mois&currency_code=EUR');
	} else if($prix_format == 12) {
		$month = 12;
		$_SESSION['mLeft'] = $month;
		header('refresh:0;url=https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RVZ4KNHDTMVYE&os0=12+Mois&currency_code=EUR');
	} else {
		$month = 0;
	}
} else {
	$error = 'Achat impossible pour le moment. Si vous avez acheté dernièrement un salon privé, vous ne pouvez pas en racheter avant la date d\'échéance. Désolé pour les désagréments. Contactez un membres du staff, Merci !';
}

?>
<?php
	if(isset($_SESSION['id'])) {
?>
<html>
	<head>
		<title>G.E.P.S - Achat</title>
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
											<li><a href="editionprofil">&nbsp;&nbsp;&nbsp;&nbsp;Editer mon profil</a></li>
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
							<h2>Achat</h2>
							<p>Acheter un salon privé TeamSpeak</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">   <!-- <label>Choisissez le nomdres de mois :</label> -->
								<p align="center">Vous pouvez acheter un salon privé sur le TeamSpeak de G.E.P.S.. Le mot de passe des salons vous serra envoyé par email. Après l'achat, veuillez appuyer sur
									« Return to G.E.P.S. » afin que votre achat soit pris en compte et recevoir votre mot de passe. Merci de votre collaboration.</p><br/>
								<form align="center" action="" method="post" target="_top">
									<input type="hidden" name="cmd" value="_s-xclick">
									<input type="hidden" name="hosted_button_id" value="RVZ4KNHDTMVYE">
									<table>
									<label>Choisissez le nomdres de mois :</label>
									<tr></tr><tr><td><select name="os0">
										<option <?php if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 1) {echo "selected";} ?> value="1 Mois">1 Mois €1.00 EUR</option>
										<option <?php if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 6) {echo "selected";} ?> value="6 Mois">6 Mois €5.00 EUR</option>
										<option <?php if(isset($_SESSION['mLeft']) AND $_SESSION['mLeft'] == 12) {echo "selected";} ?> value="12 Mois">12 Mois €10.00 EUR</option>
									</select> </td></tr>
									</table>
									<input type="hidden" name="currency_code" value="EUR">
									<input type="image" src="http://mcgeps.ca/images/buy-withpaypal-button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
								<?php if(isset($error)){echo $error;} ?>
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