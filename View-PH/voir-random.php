<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	session_start();

	error_reporting(0);

	include_once('config.php');

	include_once('cookieconnect.php');

	$requser = $bdd->prepare('SELECT total FROM membres WHERE id = ?');
   	$requser->execute(array($_SESSION['id']));
   	$userinfo = $requser->fetch();

   	$total = $userinfo['total'];
   	$found = 0;
	$useragent=$_SERVER['HTTP_USER_AGENT'];
?>
<?php
	if(isset($_SESSION['id'])) {
?>
<html>
	<head>
		<title>ViewPH - Voir Aléatoire</title>
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
								<h1> Voir des photos (Aléatoire) </h1>
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
									<div id="hidable">
										<p>
											Pour voir des photos aléatoirement, veuillez cliquer sur le bouton « Commencer » ci-dessous.
											Vous verrez alors des photos de cartes étudiantes aléatoires. Vous pourrez cliquer sur celles-ci pour 
											avoir accès à d'autres informations. Nous espèrons que vous allez apprécier notre API. Nous tenons à préciser 
											qu'il n'est pas terminé donc se peut qu'aucunes requêtes n'aboutissent, si tel est le cas, cliquer sur « Continuer ». 
											Il peut arriver que le chargement de la page soit lent (15-30 sec), c'est qu'il y a beaucoup de requêtes effectuées en même temps.
											Nous en sommes désolé, merci de votre compréhention.
										</p>
										<form method="post">
											<input type="submit" name="start" value="Commencer" />
									</div>
									<?php if(isset($_POST['start'])) { ?>
										<style type="text/css">#hidable{display:none;}</style>
										<section class="carousel">
											<?php
												$randchoice = rand(1,2);
												if ($randchoice == 1) {
													$randfnumber = rand(2400000, 2409000);
												} else {
													$randfnumber = rand(2500000, 2509000);
												}
												$id = $randfnumber;
												for ($x = 0; $x <= 10; $x++) {
													// L'url du fichier
													$url = 'http://choix.csphares.qc.ca/Dossiers/Photos/'.$id.'.jpg';
													// Le chemin de sauvegarde
													$path = 'fiches';
													// On coupe le chemin
													$exp = explode('/',$url);
													// On recup l'adresse du serveur
													$serv = $exp[0].'//'.$exp[2];
													// On recup le nom du fichier
													$name = array_pop($exp);
													// On genere le contexte (pour contourner les protections anti-leech)
													$xcontext = stream_context_create(array("http"=>array("header"=>"Referer: ".$serv."\r\n")));
													// On tente de recuperer l'image
													$content = file_get_contents($url,false,$xcontext);
													if ($content === false or $id == 2504017) {
													  //echo "\nPhoto introuvable.<br/>".$id;
													} else {
														$reqfiche = $bdd->prepare("SELECT * FROM membres WHERE fnumber = ?");
														$reqfiche->execute(array($id));
														$ficheexist = $reqfiche->rowCount();
														if($ficheexist == 0) {
															// Sinon, si c'est bon, on sauvegarde le fichier
															$test = file_put_contents($path.'/'.$name,$content);
															if ($test === false) {
															  echo "\nImpossible de sauvegarder le fichier.";
															  exit(1);
															}
															// Tout est OK
															//echo "\nPhoto trouvé.<br/>";
															$total = $total + 1;
															$_SESSION['total'] = $total;
															$found = $found + 1;
															$inserttotal = $bdd->prepare("UPDATE membres SET total = ? WHERE id = ?");
				    										$inserttotal->execute(array($total, $_SESSION['id']));
				    										$insertfiche = $bdd->prepare("INSERT INTO membres(fnumber, ip, insc_date, nom, prenom, mail, motdepasse, grade, total) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
															$insertfiche->execute(array($id, 'Not Registered', 'Not Registered', 'Not Registered', 'Not Registered', 'Not Registered', 'Not Registered', -1, -1));
			    										}
														
											?>
											<article style="margin-top:3%;">
												<a href="view?fiche=<?php echo $id?>" class="image featured"><img ondragstart="return false;" style="margin-left:9%;margin-top:7%;width:82%;height:85%;" src="fiches/<?= $id ?>.jpg" alt="" /></a>
												<header>
													<h3><a href="view?fiche=<?php echo $id?>">Fiche n&#186; <?= $id;?></a></h3>
												</header>
											</article>
											<?php }
												} 
												$id = $id + 1;
												$line = "[".date('Y-m-d') . "] - ".$randfnumber." - ".$found;
												file_put_contents('RandomNumber.log', $line . PHP_EOL, FILE_APPEND);
											?>
											
										</section>
										<form method="post">
											<h4><?= $total ?> photos trouvées depuis votre inscription.</h4><br/>
											<?php if($_SESSION['grade'] == 2) { ?>
												<h4>Nombre random: <?= $randfnumber ?></h4><br/>
												<h4>Trouvé:  <?= $found ?></h4><br/>
											<?php } ?>
											<input type="submit" name="start" value="Continuer" />
										</form>
									<?php } ?>
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