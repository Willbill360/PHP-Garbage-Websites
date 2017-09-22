<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
//Inclusion des fichiers nessaisaire
include_once('config.php');

//Code de vérification et d'ajout d'utilisateur
if(isset($_POST['forminscription']))
{
	//Récuperation des informations des champs et sécurisation
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	$pseudolength = strlen($pseudo);
	$date = ucfirst(strftime('%A, le %d %B %Y'));
	$grade = 0;
	$asTS = 'Non';
	$monthLeft = -1;
	$nom = htmlspecialchars(ucfirst(strtolower($_POST['nom'])));
	$prenom = htmlspecialchars(ucfirst(strtolower($_POST['prenom'])));
	$age = htmlspecialchars($_POST['age']);
	$pays = htmlspecialchars($_POST['pays']);
	$nomlength = strlen($nom);
	$prenomlength = strlen($prenom);
	$agelength = strlen($age);

	//Récuperation de l'ip de l'utilisateur (sur notre site on pouvais rechercher par ip ou dekoi deminme)
	if($isLocal == true){
		$ip = 'Mon Ip de Test';
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	//Recuperation de la valeur du sexe etape #1
	if(isset($_POST['sexe'])) {
		$sex_val = ceil($_POST['sexe']);
	} else {
		$sex_val = 0;
	}
	//Recuperation de la valeur du sexe etape #2
	if(isset($_POST['sexe'])){
		if($sex_val == 1) {
		    $sexe = "Homme";
		} else if($sex_val == 2) {
		    $sexe = "Femme";
		} else if($sex_val == 3) {
		    $sexe = "Autre";
		}
	}
	//On vérifie si tous les champs ont été rempli
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['age']))
	{
		//On vérifie qu'il ne sont pas plus qu eleur limite (String <= 255, interger <= 11)
		if($pseudolength <= 255 AND $nomlength <= 255 AND $prenomlength <= 255 AND $agelength <= 11)
		{
			//On vérifie que l'age est numérique
			if(is_numeric($age))
			{
				//On vérifie que le sexe a été spécifier
				if($sex_val != 0)
				{
					//On vérifie que le pays à été spécifier
					if($pays != 'Rien')
					{
						//On vérifier que le capchat a été remplie (tu peut changer la clé par la tienne)
						require('API/ReCapchat/autoload.php');
						$recaptcha = new \ReCaptcha\ReCaptcha('6LcPSyMTAAAAAF72GIed9Kfp7PkgHxXWisH3lfRj');
						$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
						if ($resp->isSuccess())
						{
							//On vérifie si les réglements on été cocher
							if(isset($_POST['policies']))
							{
								//On vérifie si les champs des deux mail sont identiques
								if($mail == $mail2)
								{
									//On vérifie que le mail est un mail et non autre chose avec un @
									if(filter_var($mail, FILTER_VALIDATE_EMAIL))
									{
										//On vérifie que le mail n'a jamais été utiliser pour senregistrer
										$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
										$reqmail->execute(array($mail));
										$mailexist = $reqmail->rowCount();
										if($mailexist == 0)
										{
											//Si la case recevoir des news a été cocher
											if(isset($_POST['getmail'])){
												$insertnews = $bdd->prepare("INSERT INTO newslester(pseudo, mail) VALUES(?, ?)");
												$insertnews->execute(array($pseudo, $mail));
											}
											//on vérifie que les mots de passes sont identique (version hasher en sha1)
											if($mdp == $mdp2)
											{
												//On insert dans la bdd le nouvel utilisateur
												$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse, ip, nom, prenom, age, sexe, pays, insc_date, grade, asTS, monthLeft) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
												$insertmbr->execute(array($pseudo, $mail, $mdp, $ip, $nom, $prenom, $age, $sexe, $pays, $date, $grade, $asTS, $monthLeft));
												$erreur = "Votre compte a bien été créé ! <a style=\"text-decoration: none;\" href=\"connexion\">Se connecter</a>";
											}
											else //Je pense qu'en lisant les erreur tu comprends a quoi elle serve
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
								$erreur = "Veuillez lire les CGU et CGV puis cochez la case !";
							}
						}
						else
						{
							$erreur = "Capchat invalide ou non rempli !";
						}
					}
					else
					{
						$erreur = "Veuillez choisir un pays !";
					}
				}
				else
				{
					$erreur = "Veuillez choisir un sexe !";
				}
			}
			else
			{
				$erreur = "Votre âge n'est pas numérique !";
			}
		}
		else
		{
			$erreur = "Nom, Prenom, Pseudo, Pays ou Âge trop long ! (255 char max. ou 11 char max. pour l'age)";
		}
	}
	else 
	{
		$erreur = "Tous les champs doivent être completé ! ";
	}
}

?>
<html>
	<head>
		<title>G.E.P.S - Inscription</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
											<li><a href="connexion">Connexion Membres</a></li>
											<li><a href="#"></a></li>
											<li><a href="politiques">Politiques</a></li>
											<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H4HEVACEMT6MW">Nous supporter</a></li>
											<div style="margin-top:50px;z-index:20000;position: fixed;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
							<h2>Inscription Membres G.E.P.S.</h2>
							<p>Formulaire d'inscription à l'espace membre</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<section>
								<!-- Foermulaire d'inscription -->
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
													<input type="text" placeholder="Votre pseudo (In-Game)" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;} ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<input type="text" placeholder="Votre âge" id="age" name="age" value="<?php if(isset($age)){echo $age;} ?>"/>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<select name="sexe">
														<option value="0">-- Votre sexe --</option>
														<option value="1" <?php if(isset($sexe) AND $sexe=='Homme'){echo 'selected';} ?>>Homme</option>
														<option value="2" <?php if(isset($sexe) AND $sexe=='Femme'){echo 'selected';} ?>>Femme</option>
														<option value="3" <?php if(isset($sexe) AND $sexe=='Autre'){echo 'selected';} ?>>Autre</option>
													</select>
												</div>
												<div class="6u 12u$(xsmall)" style="float:none;">
													<select name="pays">
														<option value="Rien">-- Votre pays --</option>
														<option value="Afghanistan">Afghanistan </option>
														<option value="Afrique Centrale">Afrique Centrale </option>
														<option value="Afrique du sud">Afrique du Sud </option>
														<option value="Albanie">Albanie </option>
														<option value="Algerie" <?php if(isset($pays) AND $pays=='Algerie'){echo 'selected';} ?>>Algerie </option>
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
														<option value="Belgique" <?php if(isset($pays) AND $pays=='Belgique'){echo 'selected';} ?>>Belgique </option>
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
														<option value="Canada" <?php if(isset($pays) AND $pays=='Canada'){echo 'selected';} ?>>Canada </option>
														<option value="Canaries" <?php if(isset($pays) AND $pays=='Canaries'){echo 'selected';} ?>>Canaries </option>
														<option value="Cap vert" <?php if(isset($pays) AND $pays=='Cap vert'){echo 'selected';} ?>>Cap_Vert </option>
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
														<option value="Cote d'Ivoire" <?php if(isset($pays) AND $pays=='Cote d\'Ivoire'){echo 'selected';} ?>>Côte d'Ivoire </option>
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
														<option value="France" <?php if(isset($pays) AND $pays=='France'){echo 'selected';} ?>>France </option>
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
														<option value="Guyane Francaise" <?php if(isset($pays) AND $pays=='Guyane Francaise'){echo 'selected';} ?>>Guyane Francaise </option>
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
														<option value="Mariannes du Nord" <?php if(isset($pays) AND $pays=='Mariannes du Nord'){echo 'selected';} ?>>Mariannes du Nord </option>
														<option value="Maroc">Maroc </option>
														<option value="Marshall">Marshall </option>
														<option value="Martinique">Martinique </option>
														<option value="Maurice" <?php if(isset($pays) AND $pays=='Maurice'){echo 'selected';} ?>>Maurice </option>
														<option value="Mauritanie">Mauritanie </option>
														<option value="Mayotte">Mayotte </option>
														<option value="Mexique">Mexique </option>
														<option value="Micronesie">Micronesie </option>
														<option value="Midway">Midway </option>
														<option value="Moldavie">Moldavie </option>
														<option value="Monaco" <?php if(isset($pays) AND $pays=='Monaco'){echo 'selected';} ?>>Monaco </option>
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
												<div class="6u$ 12u$(xsmall)" style="float:none;">
													<div class="g-recaptcha" data-sitekey="6LcPSyMTAAAAAHKa1IvPFcbZYO1DpIT9n1Qq5tXS"></div>
												</div>
												<div style="width:70%;" class="6u$ 12u$(small)">
													<input checked type="checkbox" id="getmail" name="getmail">
													<label for="getmail">En cochant cette case, vous acceptez de recevoir des newsletters conformement à nos politiques de confidentialité (<a href="//www.iubenda.com/privacy-policy/7848856" class="iubenda-black iub-legal-only iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>). Vous pourez vous désabonnez à tout moment.</label>
												</div>
												<div style="width:70%;" class="6u$ 12u$(small)">
													<input type="checkbox" id="policies" name="policies">
													<label for="policies">En cochant cette case, vous attestez que vous avez lu et compris nos <a href="politiques#cgu">Conditions Générales 
														d'Utilisation (CGU)</a>, nos <a href="politiques#cgv">Conditions Générales de Vente (CGV)</a> et nos Politiques de Confidentialité 
														(<a href="//www.iubenda.com/privacy-policy/7848856" class="iubenda-black iub-legal-only iubenda-embed" title="Privacy Policy">Privacy Policy
													</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")
													[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}
													else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>).</label>
												</div>
												<div class="12u$">
													<ul class="actions">
														<li><input name="forminscription" type="submit" value="S'inscrire" class="special" /></li>
														<li><input type="reset" value="Reset" /></li>
													</ul>
												</div>
											</div>
										</form>
										<!-- jusque ici -->
									</section>
									<!-- on affiche lerreur sil y en a une seulement si il y en a une -->
									<?php
										if(isset($erreur))
										{
											echo $erreur;
										}
									?>
									<!-- jusque ici -->
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
