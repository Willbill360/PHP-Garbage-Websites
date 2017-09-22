<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php

include_once('config.php');

if(isset($_POST['forminscription']))
{
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	$date = ucfirst(strftime('%A, le %d %B %Y'));
	$grade = 0;
	$total = 0;
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$fnumber = htmlspecialchars($_POST['fnumber']);
	$nomlength = strlen($nom);
	$prenomlength = strlen($prenom);
	$fnumberlength = strlen($fnumber);
	$maillength = strlen($mail);
	$mail2length = strlen($mail2);
	$mdplength = strlen($mdp);
	$mdp2length = strlen($mdp2);
	if($isLocal == true){
		$ip = 'Mon Ip de Test';
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	if(!empty($_POST['fnumber']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
	{
		if($fnumberlength <= 11 AND $nomlength <= 255 AND $prenomlength <= 255 AND $maillength <= 255 AND $mail2length <= 255 AND $mdplength <= 255 AND $mdp2length <= 255)
		{
			if(is_numeric($fnumber))
			{
					
				if($mail == $mail2)
				{
					if(filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
						if($mailexist == 0)
						{
									
							if($mdp == $mdp2)
							{
								$reqfiche = $bdd->prepare("SELECT * FROM membres WHERE fnumber = ?");
								$reqfiche->execute(array($fnumber));
								$ficheexist = $reqfiche->rowCount();
								if($ficheexist == 0) {
									// L'url du fichier
									$url = 'http://choix.csphares.qc.ca/Dossiers/Photos/'.$fnumber.'.jpg';
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
									if ($content === false) {
										$erreur = "Votre numéro de fiche n'est pas valide !";
									} else {
										// Sinon, si c'est bon, on sauvegarde le fichier
										$test = file_put_contents($path.'/'.$name,$content);
										if ($test === false) {
										  $msg = "Impossible de sauvegarder la photo.";
										}
										// Tout est OK
										$insertmbr = $bdd->prepare("INSERT INTO membres(fnumber, ip, insc_date, nom, prenom, mail, motdepasse, grade, total) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
										$insertmbr->execute(array($fnumber, $ip, $date, $nom, $prenom, $mail, $mdp, $grade, $total));
										$erreur = "Votre compte a bien été créé ! <a style=\"text-decoration: none;\" href=\"connexion\">Se connecter</a>";
									}
								} else {
									$insertmbr = $bdd->prepare("UPDATE membres SET ip = ?, insc_date = ?, nom = ?, prenom = ?, mail = ?, motdepasse = ?, grade = ?, total = ? WHERE fnumber = ?");
									$insertmbr->execute(array($ip, $date, $nom, $prenom, $mail, $mdp, $grade, $total, $fnumber));
									$erreur = "Votre compte a bien été créé ! <a style=\"text-decoration: none;\" href=\"connexion\">Se connecter</a>";
								}
							}
							else
							{
								$erreur = "Vos mots de passes ne corespondent pas !";
							}
						}
						else
						{
							$erreur = "Adresse email déjà utilisée !";
						}
					}
					else
					{
						$erreur = "Votre adresse email n'est pas valide !";
					}
				}
				else
				{
					$erreur = "Vos adresses email ne corespondent pas !";
				}		
			}
			else
			{
				$erreur = "Votre numéro de fiche n'est pas numérique !";
			}
		}
		else
		{
			$erreur = "Nom, Prenom, Numéro de fiche, E-Mail ou Mot de passe trop long ! (255 char max.)";
		}
	}
	else 
	{
		$erreur = "Tous les champs doivent être completé !";
	}
}
?>
<html>
	<head>
		<title>ViewPH - Inscription</title>
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
								<h1> Inscription </h1>
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
						<article id="main" class="special">
							<section class="wrapper style5">
							<div class="inner">
								<section>
										<h4 style="margin-bottom:0px;">Inscription</h4><p style="font-size:65%;">Vous posédez déja un compte ? <a href="connexion">Connectez-vous ici !</a></p>
										<form method="post" action="">
											<div class="row uniform">
												<div class="6u 12u$(xsmall)" style="float:none;">
													<input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)){echo $nom;} ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<input type="text" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)){echo $prenom;} ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<input type="text" placeholder="Votre numéro de fiche" id="fnumber" name="fnumber" value="<?php if(isset($fnumber)){echo $fnumber;} ?>"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<input type="email" placeholder="Votre email" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail;} ?>"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<input type="email" placeholder="Confirmez votre email" id="mail2" name="mail2" value="<?php if(isset($mail2)){echo $mail2;} ?>"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<input type="password" placeholder="Mot de passe" id="mdp" name="mdp"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<input type="password" placeholder="Comfirmez mot de passe" id="mdp2" name="mdp2"/>
												</div>
												<div class="12u$">
													<ul class="actions">
														<li><input name="forminscription" type="submit" value="S'inscrire" class="special" /></li>
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