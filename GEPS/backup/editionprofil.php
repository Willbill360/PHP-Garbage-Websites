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


if(isset($_SESSION['id'])) {
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	$requsernews = $bdd->prepare("SELECT * FROM newslester WHERE mail = ?");
	$requsernews->execute(array($_SESSION['mail']));
	$usernews = $requsernews->fetch();
	$requserts = $bdd->prepare("SELECT * FROM tsmdp WHERE id = ?");
	$requserts->execute(array($_SESSION['id']));
	$userts = $requserts->fetch();
	
	if(isset($_POST['maj'])){
	if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
   		$newpseudo = htmlspecialchars($_POST['newpseudo']);
    	$newpseudolenght = strlen($newpseudo);
    	if ($newpseudolenght <= 255)  {
	    	$insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
	    	$insertpseudo->execute(array($newpseudo, $_SESSION['id']));
	    	header('Location: profil?id='.$_SESSION['id']);
  		} else {
  			$msg = 'Nouveau pseudo trop long ! (255 char max.)';
  		}
   }

   if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
      	$newnom = htmlspecialchars(ucfirst(strtolower($_POST['newnom'])));
      	$newnomlenght = strlen($newnom);
      	if ($newnomlenght <= 255)  {
	      	$insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
	      	$insertnom->execute(array($newnom, $_SESSION['id']));
	      	header('Location: profil?id='.$_SESSION['id']);
  		} else {
  			$msg = 'Nouveau nom trop long ! (255 char max.)';
  		}
   }

   if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
      	$newprenom = htmlspecialchars(ucfirst(strtolower($_POST['newprenom'])));
      	$newprenomlenght = strlen($newprenom);
      	if ($newprenomlenght <= 255)  {
	      	$insertprenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
	      	$insertprenom->execute(array($newprenom, $_SESSION['id']));
	      	header('Location: profil?id='.$_SESSION['id']);
 		} else {
  			$msg = 'Nouveau prénom trop long ! (255 char max.)';
  		}
   }
   
   if(isset($_POST['newage']) AND !empty($_POST['newage']) AND $_POST['newage'] != $user['age']) {
     	$newage = htmlspecialchars($_POST['newage']);
      	$newagelenght = strlen($newage);
      	if ($newagelenght <= 11)  {
      		if(is_numeric($newage)) {
	      		$insertage = $bdd->prepare("UPDATE membres SET age = ? WHERE id = ?");
	      		$insertage->execute(array($newage, $_SESSION['id']));
	      		header('Location: profil?id='.$_SESSION['id']);
      		} else {
  				$msg = 'Votre âge n\'est pas numérique !';
  			}
  		} else {
  			$msg = 'Nouvel âge trop long ! (11 char max.)';
  		}
   }

   if(isset($_POST['newpays']) AND !empty($_POST['newpays']) AND $_POST['newpays'] != $user['pays']) {
      	$newpays = htmlspecialchars($_POST['newpays']);
      	$insertpays = $bdd->prepare("UPDATE membres SET pays = ? WHERE id = ?");
      	$insertpays->execute(array($newpays, $_SESSION['id']));
      	header('Location: profil?id='.$_SESSION['id']);
   }

   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      	$newmail = htmlspecialchars($_POST['newmail']);
      	$newmaillenght = strlen($newmail);
      	if ($newmaillenght <= 255) {
      		$insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      		$insertmail->execute(array($newmail, $_SESSION['id']));
      		header('Location: profil?id='.$_SESSION['id']);
      	} else {
  			$msg = 'Nouveau email trop long ! (255 char max.)';
  		}
   }
   
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = htmlspecialchars(sha1($_POST['newmdp1']));
      $mdp2 = htmlspecialchars(sha1($_POST['newmdp2']));
      $newmdp1lenght = strlen($newmdp1);
      $newmdp2lenght = strlen($newmdp2);
      if($mdp1 == $mdp2) {
      	if ($newmdp1lenght <= 255 AND $newmdp2lenght <= 255) {
         	$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         	$insertmdp->execute(array($mdp1, $_SESSION['id']));
         	header('Location: profil?id='.$_SESSION['id']);
     	} else {
         	$msg = "Vos mots de passes sont trop long ! (255 char max.)";
      	}
      } else {
         $msg = "Vos deux mots de passes ne correspondent pas !";
      }
   }
   
   if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'] AND $_POST['newnom'] == $user['nom'] AND $_POST['newprenom'] == $user['prenom'] AND $_POST['newage'] == $user['age'] AND $_POST['newpays'] == $user['pays'] AND $_POST['newmail'] == $user['mail'])
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
		<title>G.E.P.S - Édition Profil</title>
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
							<h2>Édition Espace Membres G.E.P.S.</h2>
							<p>Formulaire d'édition de l'espace membre</p>
						</header>
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
													<label>Pseudo:</label>
													<input type="text" placeholder="Pseudo" id="newpseudo" name="newpseudo" value="<?php echo $user['pseudo']; ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<label>Âge:</label>
													<input type="text" placeholder="Âge" id="newage" name="newage" value="<?php echo $user['age']; ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<label>Pays:</label>
													<select name="newpays" id="newpays">
														<option value="Afghanistan">Afghanistan </option>
														<option value="Afrique Centrale">Afrique Centrale </option>
														<option value="Afrique du sud">Afrique du Sud </option>
														<option value="Albanie">Albanie </option>
														<option value="Algerie" <?php if($user['pays']=='Algerie'){echo 'selected';} ?>>Algerie </option>
														<option value="Allemagne">Allemagne </option>
														<option value="Andorre">Andorre </option>
														<option value="Angola">Angola </option>
														<option value="Anguilla">Anguilla </option>
														<option value="Arabie Saoudite">Arabie Saoudite </option>
														<option value="Argentine">Argentine </option>
														<option value="Armenie">Armenie </option>
														<option value="Australie">Australie </option>
														<option value="Autriche">Autriche </option>
														<option value="Azerbaidjan">Azerbaidjan </option>
														<option value="Bahamas">Bahamas </option>
														<option value="Bangladesh">Bangladesh </option>
														<option value="Barbade">Barbade </option>
														<option value="Bahrein">Bahrein </option>
														<option value="Belgique" <?php if($user['pays']=='Belgique'){echo 'selected';} ?>>Belgique </option>
														<option value="Belize">Belize </option>
														<option value="Benin">Benin </option>
														<option value="Bermudes">Bermudes </option>
														<option value="Bielorussie">Bielorussie </option>
														<option value="Bolivie">Bolivie </option>
														<option value="Botswana">Botswana </option>
														<option value="Bhoutan">Bhoutan </option>
														<option value="Boznie Herzegovine">Boznie Herzegovine </option>
														<option value="Bresil">Bresil </option>
														<option value="Brunei">Brunei </option>
														<option value="Bulgarie">Bulgarie </option>
														<option value="Burkina Faso">Burkina Faso </option>
														<option value="Burundi">Burundi </option>
														<option value="Caiman">Caiman </option>
														<option value="Cambodge">Cambodge </option>
														<option value="Cameroun">Cameroun </option>
														<option value="Canada" <?php if($user['pays']=='Canada'){echo 'selected';} ?>>Canada </option>
														<option value="Canaries" <?php if($user['pays']=='Canaries'){echo 'selected';} ?>>Canaries </option>
														<option value="Cap vert" <?php if($user['pays']=='Cap vert'){echo 'selected';} ?>>Cap_Vert </option>
														<option value="Chili">Chili </option>
														<option value="Chine">Chine </option>
														<option value="Chypre">Chypre </option>
														<option value="Colombie">Colombie </option>
														<option value="Comores">Colombie </option>
														<option value="Congo">Congo </option>
														<option value="Congo democratique">Congo democratique </option>
														<option value="Cook">Cook </option>
														<option value="Coree du Nord">Coree du Nord </option>
														<option value="Coree du Sud">Coree du Sud </option>
														<option value="Costa Rica">Costa Rica </option>
														<option value="Cote d'Ivoire" <?php if($user['pays']=='Cote d\'Ivoire'){echo 'selected';} ?>>Côte d'Ivoire </option>
														<option value="Croatie">Croatie </option>
														<option value="Cuba">Cuba </option>
														<option value="Danemark">Danemark </option>
														<option value="Djibouti">Djibouti </option>
														<option value="Dominique">Dominique </option>
														<option value="Egypte">Egypte </option>
														<option value="Emirats Arabes Unis">Emirats Arabes Unis </option>
														<option value="Equateur">Equateur </option>
														<option value="Erythree">Erythree </option>
														<option value="Espagne">Espagne </option>
														<option value="Estonie">Estonie </option>
														<option value="Etats Unis">Etats Unis </option>
														<option value="Ethiopie">Ethiopie </option>
														<option value="Falkland">Falkland </option>
														<option value="Feroe">Feroe </option>
														<option value="Fidji">Fidji </option>
														<option value="Finlande">Finlande </option>
														<option value="France" <?php if($user['pays']=='France'){echo 'selected';} ?>>France </option>
														<option value="Gabon">Gabon </option>
														<option value="Gambie">Gambie </option>
														<option value="Georgie">Georgie </option>
														<option value="Ghana">Ghana </option>
														<option value="Gibraltar">Gibraltar </option>
														<option value="Grece">Grece </option>
														<option value="Grenade">Grenade </option>
														<option value="Groenland">Groenland </option>
														<option value="Guadeloupe">Guadeloupe </option>
														<option value="Guam">Guam </option>
														<option value="Guatemala">Guatemala</option>
														<option value="Guernesey">Guernesey </option>
														<option value="Guinee">Guinee </option>
														<option value="Guinee Bissau">Guinee Bissau </option>
														<option value="Guinee equatoriale">Guinee_Equatoriale </option>
														<option value="Guyana">Guyana </option>
														<option value="Guyane Francaise" <?php if($user['pays']=='Guyane Francaise'){echo 'selected';} ?>>Guyane Francaise </option>
														<option value="Haiti">Haiti </option>
														<option value="Hawaii">Hawaii </option>
														<option value="Honduras">Honduras </option>
														<option value="Hong Kong">Hong Kong </option>
														<option value="Hongrie">Hongrie </option>
														<option value="Inde">Inde </option>
														<option value="Indonesie">Indonesie </option>
														<option value="Iran">Iran </option>
														<option value="Iraq">Iraq </option>
														<option value="Irlande">Irlande </option>
														<option value="Islande">Islande </option>
														<option value="Israel">Israel </option>
														<option value="Italie">italie </option>
														<option value="Jamaique">Jamaique </option>
														<option value="Jan Mayen">Jan Mayen </option>
														<option value="Japon">Japon </option>
														<option value="Jersey">Jersey </option>
														<option value="Jordanie">Jordanie </option>
														<option value="Kazakhstan">Kazakhstan </option>
														<option value="Kenya">Kenya </option>
														<option value="Kirghizstan">Kirghizistan </option>
														<option value="Kiribati">Kiribati </option>
														<option value="Koweit">Koweit </option>
														<option value="Laos">Laos </option>
														<option value="Lesotho">Lesotho </option>
														<option value="Lettonie">Lettonie </option>
														<option value="Liban">Liban </option>
														<option value="Liberia">Liberia </option>
														<option value="Liechtenstein">Liechtenstein </option>
														<option value="Lituanie">Lituanie </option>
														<option value="Luxembourg">Luxembourg </option>
														<option value="Lybie">Lybie </option>
														<option value="Macao">Macao </option>
														<option value="Macedoine">Macedoine </option>
														<option value="Madagascar">Madagascar </option>
														<option value="Madere">Madere </option>
														<option value="Malaisie">Malaisie </option>
														<option value="Malawi">Malawi </option>
														<option value="Maldives">Maldives </option>
														<option value="Mali">Mali </option>
														<option value="Malte">Malte </option>
														<option value="Man">Man </option>
														<option value="Mariannes du Nord" <?php if($user['pays']=='Mariannes du Nord'){echo 'selected';} ?>>Mariannes du Nord </option>
														<option value="Maroc">Maroc </option>
														<option value="Marshall">Marshall </option>
														<option value="Martinique">Martinique </option>
														<option value="Maurice" <?php if($user['pays']=='Maurice'){echo 'selected';} ?>>Maurice </option>
														<option value="Mauritanie">Mauritanie </option>
														<option value="Mayotte">Mayotte </option>
														<option value="Mexique">Mexique </option>
														<option value="Micronesie">Micronesie </option>
														<option value="Midway">Midway </option>
														<option value="Moldavie">Moldavie </option>
														<option value="Monaco" <?php if($user['pays']=='Monaco'){echo 'selected';} ?>>Monaco </option>
														<option value="Mongolie">Mongolie </option>
														<option value="Montserrat">Montserrat </option>
														<option value="Mozambique">Mozambique </option>
														<option value="Namibie">Namibie </option>
														<option value="Nauru">Nauru </option>
														<option value="Nepal">Nepal </option>
														<option value="Nicaragua">Nicaragua </option>
														<option value="Niger">Niger </option>
														<option value="Nigeria">Nigeria </option>
														<option value="Niue">Niue </option>
														<option value="Norfolk">Norfolk </option>
														<option value="Norvege">Norvege </option>
														<option value="Nouvelle Caledonie">Nouvelle Caledonie </option>
														<option value="Nouvelle Zelande">Nouvelle Zelande </option>
														<option value="Oman">Oman </option>
														<option value="Ouganda">Ouganda </option>
														<option value="Ouzbekistan">Ouzbekistan </option>
														<option value="Pakistan">Pakistan </option>
														<option value="Palau">Palau </option>
														<option value="Palestine">Palestine </option>
														<option value="Panama">Panama </option>
														<option value="Papouasie Nouvelle Guinee">Papouasie Nouvelle Guinee </option>
														<option value="Paraguay">Paraguay </option>
														<option value="Pays Bas">Pays Bas </option>
														<option value="Perou">Perou </option>
														<option value="Philippines">Philippines </option>
														<option value="Pologne">Pologne </option>
														<option value="Polynesie">Polynesie </option>
														<option value="Porto Rico">Porto Rico </option>
														<option value="Portugal">Portugal </option>
														<option value="Qatar">Qatar </option>
														<option value="Republique Dominicaine">Republique Dominicaine </option>
														<option value="Republique Tcheque">Republique Tcheque </option>
														<option value="Reunion">Reunion </option>
														<option value="Roumanie">Roumanie </option>
														<option value="Royaume Uni">Royaume Uni </option>
														<option value="Russie">Russie </option>
														<option value="Rwanda">Rwanda </option>
														<option value="Sahara Occidental">Sahara Occidental </option>
														<option value="Sainte Lucie">Sainte Lucie </option>
														<option value="Saint Marin">Saint Marin </option>
														<option value="Salomon">Salomon </option>
														<option value="Salvador">Salvador </option>
														<option value="Samoa Occidentales">Samoa Occidentales</option>
														<option value="Samoa Americaine">Samoa Americaine </option>
														<option value="Sao Tome et Principe">Sao Tome et Principe </option>
														<option value="Senegal">Senegal </option>
														<option value="Seychelles">Seychelles </option>
														<option value="Sierra Leone">Sierra Leone </option>
														<option value="Singapour">Singapour </option>
														<option value="Slovaquie">Slovaquie </option>
														<option value="Slovenie">Slovenie</option>
														<option value="Somalie">Somalie </option>
														<option value="Soudan">Soudan </option>
														<option value="Sri Lanka">Sri Lanka </option>
														<option value="Suede">Suede </option>
														<option value="Suisse">Suisse </option>
														<option value="Surinam">Surinam </option>
														<option value="Swaziland">Swaziland </option>
														<option value="Syrie">Syrie </option>
														<option value="Tadjikistan">Tadjikistan </option>
														<option value="Taiwan">Taiwan </option>
														<option value="Tonga">Tonga </option>
														<option value="Tanzanie">Tanzanie </option>
														<option value="Tchad">Tchad </option>
														<option value="Thailande">Thailande </option>
														<option value="Tibet">Tibet </option>
														<option value="Timor Oriental">Timor Oriental </option>
														<option value="Togo">Togo </option>
														<option value="Trinite et Tobago">Trinite et Tobago </option>
														<option value="Tristan da cunha">Tristan de cuncha </option>
														<option value="Tunisie">Tunisie </option>
														<option value="Turkmenistan">Turmenistan </option>
														<option value="Turquie">Turquie </option>
														<option value="Ukraine">Ukraine </option>
														<option value="Uruguay">Uruguay </option>
														<option value="Vanuatu">Vanuatu </option>
														<option value="Vatican">Vatican </option>
														<option value="Venezuela">Venezuela </option>
														<option value="Vierges Americaines">Vierges Americaines </option>
														<option value="Vierges Britanniques">Vierges Britanniques </option>
														<option value="Vietnam">Vietnam </option>
														<option value="Wake">Wake </option>
														<option value="Wallis et Futuma">Wallis et Futuma </option>
														<option value="Yemen">Yemen </option>
														<option value="Yougoslavie">Yougoslavie </option>
														<option value="Zambie">Zambie </option>
														<option value="Zimbabwe">Zimbabwe </option>
													</select>
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