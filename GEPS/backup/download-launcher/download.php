<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
$disabled = 0;
if (isset($_POST['validate'])){
	require('../API/ReCapchat/autoload.php');
	$recaptcha = new \ReCaptcha\ReCaptcha('6Lf8SSMTAAAAANEHv9TWUCYxlEvH4SYtZ9Jr6vzt');
	$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
	if ($resp->isSuccess())
	{
		//echo '<a id="downloadLink" href="download-launcher/MC_G.E.P.S._Launcher.jar">click here to get your file</a>.';
		$erreur = 'Merci d\'avoir télécharger le launcher, amusez-vous bien sur G.E.P.S.';
		$disabled = 1;
	}
	else {
		$erreur = 'Veuillez remplir le capchat !';
	}
}
?>
<html>
	<head>
		<title>G.E.P.S - Download</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script> 
			var downloadTimeout = setTimeout(
			    function() {
			        window.location = document.getElementById('downloadLink').href;
			    },
			    2000
			);
		</script>
	</head>
	<body>
		<?php include_once("../analyticstracking.php") ?>
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

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Download du launcher G.E.P.S.</h2>
						</header>
						<section class="wrapper style5">
							<div align="center" class="inner">
								
								<p <?php if ($disabled == 1) echo 'style="display:none;"' ?>>Pour télécharger le launcher, veuillez remplir le capchat et appuyer sur « Valider ».</p>
								<form method="POST" <?php if ($disabled == 1) echo 'style="display:none;"' ?>>
									<div class="g-recaptcha" data-sitekey="6Lf8SSMTAAAAAM-M8TQ7s5oMDwFn5J8ECSAADtP_" <?php if ($disabled == 1) echo 'style="display:none;"' ?>></div><br/>
									<input type="submit" name="validate" value="Valider" class="button special" <?php if ($disabled == 1) echo 'disabled="disabled" style="display:none;"' ?>/>
								</form>
								<?php
									if(isset($erreur))
									{
										echo $erreur;
									}
								?>
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