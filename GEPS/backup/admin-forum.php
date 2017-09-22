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

include('cookieconnect.php');

$req_cat_scat = $bdd->query("SELECT *, f_categories.nom catname, f_categories.id catid, f_sous_categories.id subid FROM f_categories RIGHT JOIN f_sous_categories ON f_categories.id = f_sous_categories.id_categorie ORDER BY f_categories.ord_id, f_sous_categories.ord_id");
$cat_scat = $req_cat_scat->fetch();

$lcat = "Categorie";

$categories = $bdd->query('SELECT * FROM f_categories ORDER BY nom');
$sous_categories = $bdd->query('SELECT * FROM f_sous_categories');

if (isset($_POST['ajcat']) AND !empty($_POST['cat'])) {
	$catname = htmlspecialchars($_POST['cat']);
	$reqordid = $bdd->query('SELECT ord_id FROM f_categories ORDER BY id DESC LIMIT 1');
	while($ordid = $reqordid->fetch()){
		$neword_id = $ordid['ord_id'] + 1;
		var_dump($neword_id);
	}
	$insertcat = $bdd->prepare("INSERT INTO f_categories(ord_id, nom) VALUES(?, ?)");
	$insertcat->execute(array($neword_id,$catname));
	header('refresh:0');
}

if (isset($_POST['ajscat']) AND !empty($_POST['scat'])) {
	$scatname = htmlspecialchars($_POST['scat']);
	$scatid = htmlspecialchars($_POST['categoriefetch']);
	$reqordid = $bdd->query('SELECT ord_id FROM f_sous_categories ORDER BY id DESC LIMIT 1');
	while($ordid = $reqordid->fetch()) {
		$neword_id = $ordid['ord_id'] + 1;
	}
	$insertscat = $bdd->prepare("INSERT INTO f_sous_categories(ord_id, id_categorie, nom) VALUES(?, ?, ?)");
	$insertscat->execute(array($neword_id,$scatid,$scatname));
	header('refresh:0');
}

if(isset($_POST['return'])) {
	header('Location: profil?id='.$_SESSION['id']);
}
?>
<?php
	if(isset($_SESSION['grade']) AND $_SESSION['grade'] == 1) {
?>
<html>
	<head>
		<title>G.E.P.S - Administration Du Forum</title>
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
							<h2>Administration du forum</h2>
						</header>
						<section class="wrapper style5">
							<div class="inner" style="overflow-y:auto;">
								<div style="float:right;overflow:hidden;">
								<label>Réorganisation</label><br/>
								<div style="margin-top:-2em;overflow:hidden;width:250%;">
								<?php while($cat_scat = $req_cat_scat->fetch()) {
									while ($cat_scat['catname'] != $lcat) { ?>
										<p class="catname" style="margin: 2em 0 0 0;overflow:hidden;"><?= $cat_scat['catname']; ?><a href="freorg?act=up&type=cat&id=<?=$cat_scat['catid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Monter</a><a href="freorg?act=down&type=cat&id=<?=$cat_scat['catid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Descendre</a><?php if($cat_scat[4]=='open') { ?><a href="freorg?act=lock&type=cat&id=<?=$cat_scat['catid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Verrouiller</a><?php } else { ?><a href="freorg?act=unlock&type=cat&id=<?=$cat_scat['catid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Déverrouiller</a><?php } ?><a href="freorg?act=del&type=cat&id=<?=$cat_scat['catid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Supprimer</a></p>
									<?php $lcat = $cat_scat['catname'];
								} ?>
									<p style="margin:0;overflow:hidden;">&nbsp;&nbsp;&nbsp;&nbsp;<?= $cat_scat['nom']; ?><a href="freorg?act=up&type=subcat&id=<?=$cat_scat['subid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Monter</a><a href="freorg?act=down&type=subcat&id=<?=$cat_scat['subid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Descendre</a><a href="freorg?act=del&type=subcat&id=<?=$cat_scat['subid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Supprimer</a></p>
								<?php } ?>
								</div>
							</div>
								<form method="POST" action="">
									<div class="12u$(medium)" style="width:50%;margin-left:5px;">
										<ul class="actions">
											<label for="cat">Nouvelle Catégorie</label>
											<input style="z-index:200000;" type="text" name="cat" placeholder="Nouvelle Catégorie" id="cat"/>
											<input style="margin-top:10px;" type="submit" name="ajcat" value="Ajouter" />
										</ul>
									</div>
								</form>
								<form method="POST" action="">
									<div class="12u$(medium)" style="width:50%;margin-left:5px;">
										<ul class="actions">
											<label for="scat">Nouvelle Sous-Catégorie</label>
											<select name="categoriefetch">
	                                          <?php while($c = $categories->fetch()) { ?>
	                                          	<option value="<?= $c['id'] ?>"><?= $c['nom'] ?></option>
	                                          <?php } ?>
		                                    </select>
											<input style="margin-top:10px;" type="text" name="scat" placeholder="Nouvelle Sous-Catégorie" id="scat"/>
											<input style="margin-top:10px;" type="submit" name="ajscat" value="Ajouter" />
										</ul>
									</div>
								</form>
								<form align="center" method="POST" action="">
									<div style="margin-top:30px;" class="12u$(medium)">
										<ul class="actions">
											<input type="submit" class="special" name="return" value="Retour" />
										</ul>
									</div>
								</form>
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
}
else
{
	header("Location: connexion");
}
?>