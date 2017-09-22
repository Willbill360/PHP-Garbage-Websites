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


if(isset($_SESSION['id'])) {
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	
	if(isset($_POST['maj'])){

		if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
	      	$newnom = htmlspecialchars($_POST['newnom']);
	      	$newnomlenght = strlen($newnom);
	    	if ($newnomlenght <= 255) {
		    	$insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
		    	$insertnom->execute(array($newnom, $_SESSION['id']));
		      	header('Location: profil?id='.$_SESSION['id']);
	  		} else {
	        	$msg = "Nom trop long ! (255 char max.)";
	      	}
	    }

	    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
	      	$newprenom = htmlspecialchars($_POST['newprenom']);
	      	$newprenomlenght = strlen($newprenom);
	    	if ($newprenomlenght <= 255) {
		      	$insertprenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
		      	$insertprenom->execute(array($newprenom, $_SESSION['id']));
		      	header('Location: profil?id='.$_SESSION['id']);
		    } else {
	        	$msg = "Prénom trop long ! (255 char max.)";
	      	}
	    }
	   
	    if(isset($_POST['newfnumber']) AND !empty($_POST['newfnumber']) AND $_POST['newfnumber'] != $user['fnumber']) {
	      	$newfnumber = htmlspecialchars($_POST['newfnumber']);
	      	$newfnumberlenght = strlen($newfnumber);
	    	if ($newfnumberlenght <= 11) {
	      		$insertage = $bdd->prepare("UPDATE membres SET fnumber = ? WHERE id = ?");
	      		$insertage->execute(array($newfnumber, $_SESSION['id']));
	      		header('Location: profil?id='.$_SESSION['id']);
	      	} else {
	        	$msg = "Numéro de fiche trop long ! (11 char max.)";
	      	}
	    }

	    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
	      	$newmail = htmlspecialchars($_POST['newmail']);
	      	$newmaillenght = strlen($newmail);
	    	if ($newmaillenght <= 255) {
	      		$insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
	     		$insertmail->execute(array($newmail, $_SESSION['id']));
	      		header('Location: profil?id='.$_SESSION['id']);
	  		} else {
	        	$msg = "E-Mail trop long ! (255 char max.)";
	      	}
	    }
	   
	    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
	      	$mdp1 = sha1($_POST['newmdp1']);
	      	$mdp2 = sha1($_POST['newmdp2']);
	      	$newmdp1lenght = strlen($mdp1);
	      	$newmdp2lenght = strlen($mdp2);
	    	if ($newmdp1lenght <= 255 AND $newmdp2lenght <= 255) {
	      		if($mdp1 == $mdp2) {
	        		$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
	        		$insertmdp->execute(array($mdp1, $_SESSION['id']));
	        		header('Location: profil?id='.$_SESSION['id']);
	      		} else {
	        		$msg = "Vos deux mots de passes ne correspondent pas !";
	      		}
	      	} else {
	        	$msg = "Vos mots de passe sont trop long ! (255 char max.)";
	      	}
	    }

		if(isset($_POST['newnom']) AND $_POST['newnom'] == $user['nom'])
   		{
			header('Location: profil?id='.$_SESSION['id']);
   		}

    }

    if(isset($_POST['return']))
    {
		header('Location: profil?id='.$_SESSION['id']);
    }

    if(isset($_SESSION['sup'])){
   		$sup2 = $_SESSION['sup'];
	 } else {
		$_SESSION['sup'] = 0;
		$sup2 = 0;
	 }

    if(isset($_POST['sup']))
    {
   		$sup2 = $sup2 + 1;
   		$_SESSION['sup'] = $sup2;
   		$msg = "Êtes-vous sûr que vous voulez supprimer votre profil ? C'est irréversible...";

   		if(isset($_SESSION['sup']) AND $_SESSION['sup'] == 2){
		   	$delprof = ("DELETE FROM membres WHERE id =".$_SESSION['id']);
			$bdd->exec($delprof);
			if($_SESSION['mail'] == $usernews['mail']){
				$delmail = ("DELETE FROM newslester WHERE mail ='".$_SESSION['mail']."'");
				$bdd->exec($delmail);
			}
			if($_SESSION['id'] == $userts['id']){
				$delts = ("DELETE FROM tsmdp WHERE id =".$_SESSION['id']);
				$bdd->exec($delts);
			}
			header("Location: index");
   		}
    }
?>
<html>
	<head>
		<title>ViewPH - Édition Profil</title>
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
								<h1> Édition espace membre </h1>
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
				<div class="wrapper style1">

					<div class="container">
						<article id="main" class="special">
							<section class="wrapper style5">
							<div class="inner">
								<section>
										<h4 style="margin-bottom:0px;">Édition</h4>
										<form name="form" method="post" action="">
											<div style="margin-left:0.1px;" class="row uniform">
												<div class="6u 12u$(xsmall)" style="float:none;">
													<label>Nom:</label>
													<input type="text" placeholder="Nom" id="newnom" name="newnom" value="<?php echo $user['nom']; ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<label>Prénom:</label>
													<input type="text" placeholder="Prénom" id="newprenom" name="newprenom" value="<?php echo $user['prenom']; ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<label>Numéro de fiche:</label>
													<input type="text" placeholder="Numéro de fiche" id="newfnumber" name="newfnumber" value="<?php echo $user['fnumber']; ?>"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<label>Email:</label>
													<input type="email" placeholder="Email" id="newmail" name="newmail" value="<?php echo $user['mail']; ?>"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<label>Mot de passe:</label>
													<input type="password" placeholder="Mot de passe" id="newmdp1" name="newmdp1"/>
												</div>
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<input type="password" placeholder="Comfirmez mot de passe" id="newmdp2" name="newmdp2"/>
												</div>
												<div class="12u$">
													<ul class="actions">
														<li><input name="maj" type="submit" value="Mettre à jour mon profil" class="special" /></li>
														<li><input name="return" type="submit" value="Annuler" /></li>
														<li><input name="sup" type="submit" value="Supprimer mon profil" class="" /></li>
													</ul>
												</div>
											</div>
										</form>
									</section>
									<?php if(isset($msg)) { echo $msg;} ?>
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
}
else
{
	header("Location: connexion");
}
?>