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
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u924407628_mbre', 'u924407628_geps', '0Otfk4rNnz');
}

include('cookieconnect.php');

?>
<html>
	<head>
		<title>G.E.P.S - Politiques</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
		<script type="text/javascript">
			function showHide() {
			var ctn = document.getElementById('cgv');
			ctn.display = ctn.display == 'none' ? 'block' : 'none';
			}
		</script>
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
							<h2>Politiques Et Conditions</h2>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<h3>Conditions générales de vente (CGV)</h3>
								<input class="spoilerbutton button fit" type="button" value="Afficher" onclick="this.value=this.value=='Afficher'?'Cacher':'Afficher';"/>
								<div class="spoiler"><div>
									<div id="cgv" class="cgv">
										<p>Entre la Société Gamecraft Experimentation Project Server, représentée par M. William GAGNON et Mathieu LAGACÉ, en qualité de gérant,
											dûment habilité aux fins des présentes. La société peut être jointe par email à l'adress suivante: <a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>.<br/><br/>
											Ci-après le « Vendeur » ou la « Société ».<br/><br/>
											D’une part,<br/>
											Et la personne physique ou morale procédant à l’achat de produits ou services de la société, Ci-après, « l’Acheteur », ou « le Client »<br/><br/>
											D’autre part,<br/>
											Il a été exposé et convenu ce qui suit :<br/><br/>
											<strong>PREAMBULE</strong><br/>
											Le Vendeur est éditeur de produits et de services de vente exclusivement à destination de consommateurs, commercialisés par l’intermédiaire de ses sites
											Internet (http://mcgeps.ca).<br>
											La liste et le descriptif des biens et services proposés par la Société peuvent être consultés sur les sites susmentionnés.<br/><br/>
											<strong>Article 1 : Objet</strong><br>
											Les présentes Conditions Générales de Vente déterminent les droits et obligations des parties dans le cadre de la vente en ligne de Produits proposés par le Vendeur.<br><br>
											<strong>Article 2 : Dispositions générales</strong><br>
											Les présentes Conditions Générales de Vente (CGV) s’appliquent à toutes les ventes de Produits, effectuées au travers des sites Internet de la Société qui sont partie 
											intégrante du Contrat entre l’Acheteur et le Vendeur. Le Vendeur se réserve la possibilité de modifier les présentes, à tout moment par la publication d’une nouvelle version 
											sur son site Internet. Les CGV applicables alors sont celles étant en vigueur à la date du paiement (ou du premier paiement en cas de paiements multiples) de la commande. 
											Ces CGV sont consultables sur le site Internet de la Société à l'adresse suivante : <a href="http://mcgeps.ca/prolitiques">http://mcgeps.ca/prolitiques</a> . La Société s’assure 
											également que leur acceptation soit claire et sans réserve en mettant en place une case à cocher et un clic de validation. Le Client déclare avoir pris connaissance de 
											l’ensemble des présentes Conditions Générales de Vente, et le cas échéant des Conditions Particulières de Vente liées à un produit ou à un service, et les accepter sans restriction 
											ni réserve. Le Client reconnaît qu’il a bénéficié des conseils et informations nécessaires afin de s’assurer de l’adéquation de l’offre à ses besoins. Le Client déclare être en 
											mesure de contracter légalement en vertu des lois françaises ou valablement représenter la personne physique ou morale pour laquelle il s’engage. Sauf preuve contraire les informations 
											enregistrées par la Société constituent la preuve de l’ensemble des transactions.<br><br>
											<strong>Article 3 : Prix</strong><br>
											Les prix des produits vendus au travers des sites Internet sont indiqués en Euros hors taxes et précisément déterminés sur les pages de descriptifs des Produits. Ils sont également 
											indiqués en euros toutes taxes comprises (TVA + autres taxes éventuelles) sur la page de commande des produits, et hors frais spécifiques d'expédition. Pour tous les produits expédiés 
											hors Union européenne et/ou DOM-TOM, le prix est calculé hors taxes automatiquement sur la facture. Des droits de douane ou autres taxes locales ou droits d'importation ou taxes d'état 
											sont susceptibles d'être exigibles dans certains cas. Ces droits et sommes ne relèvent pas du ressort du Vendeur. Ils seront à la charge de l'acheteur et relèvent de sa responsabilité 
											(déclarations, paiement aux autorités compétentes, etc.). Le Vendeur invite à ce titre l'acheteur à se renseigner sur ces aspects auprès des autorités locales correspondantes. La Société 
											se réserve la possibilité de modifier ses prix à tout moment pour l’avenir. Les frais de télécommunication nécessaires à l’accès aux sites Internet de la Société sont à la charge du Client. 
											Le cas échéant également, les frais de livraison.<br><br>
											<strong>Article 4 : Conclusion du contrat en ligne</strong><br>
											Le Client devra suivre une série d’étapes spécifiques à chaque Produit offert par le Vendeur pour pouvoir réaliser sa commande. Toutefois, les étapes décrites ci-après sont systématiques :<br>
											➢ Information sur les caractéristiques essentielles du Produit ;<br>
											➢ Choix du Produit, le cas échéant de ses options et indication des données essentielles du Client (identification, adresse…) ;<br>
											➢ Acceptation des présentes Conditions Générales de Vente.<br>
											➢ Vérification des éléments de la commande et, le cas échéant, correction des erreurs.<br>
											➢ Suivi des instructions pour le paiement, et paiement des produits.<br>
											➢ Livraison des produits. Le Client recevra alors confirmation par courrier électronique du paiement de la commande, ainsi qu’un accusé de réception de la commande la confirmant. 
											Il recevra un exemplaire .pdf des présentes conditions générales de vente. Pour les produits livrés, cette livraison se fera à l’adresse indiquée par le Client. Aux fins de bonne 
											réalisation de la commande, et conformément à l’article 1316-1 du Code civil, le Client s’engage à fournir ses éléments d’identification véridiques.<br>
											Le Vendeur se réserve la possibilité de refuser la commande, par exemple pour toute demande anormale, réalisée de mauvaise foi ou pour tout motif légitime.<br><br>
											<strong>Article 5 : Produits et services</strong><br>
											Les caractéristiques essentielles des biens, des services et leurs prix respectifs sont mis à disposition de l’acheteur sur les sites Internet de la société. Le client atteste avoir 
											reçu un détail des frais de livraison ainsi que les modalités de paiement, de livraison et d’exécution du contrat. Le Vendeur s’engage à honorer la commande du Client dans la limite des 
											stocks de Produits disponibles uniquement. A défaut, le Vendeur en informe le Client. Ces informations contractuelles sont présentées en détail et en langue française. Conformément à la 
											loi française, elles font l’objet d’un récapitulatif et d’une confirmation lors de la validation de la commande. Les parties conviennent que les illustrations ou photos des produits offerts 
											à la vente n’ont pas de valeur contractuelle. La durée de validité de l’offre des Produits ainsi que leurs prix est précisée sur les sites Internet de la Société, ainsi que la durée 
											minimale des contrats proposés lorsque ceux-ci portent sur une fourniture continue ou périodique de produits ou services. Sauf conditions particulières, les droits concédés au titre des 
											présentes le sont uniquement à la personne physique signataire de la commande (ou la personne titulaire de l’adresse email communiqué).Conformément aux dispositions légales en matière de 
											conformité et de vices cachés, le Vendeur rembourse ou échange les produits défectueux ou ne correspondant pas à la commande. Le remboursement peut être demandé de la manière 
											suivante : Le Client doit contacter le Vendeur à l'adresse «<a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>» ou par le service vocal TeamSpeak à l'adresse « ts.mcgeps.ca » en 
											s'adrassant aux membres titulaires du poste «Fondateur».<br><br>
											<strong>Article 6 : Clause de réserve de propriété</strong><br>
											Les produits demeurent la propriété de la Société jusqu’au complet paiement du prix.<br><br>
											<strong>Article 7 : Modalités de livraison</strong>
											Les produits sont livrés à l'adresse de livraison qui a été indiquée lors de la commande et le délai indiqué. Ce délai ne prend pas en compte le délai de préparation de la commande.<br>
											Lorsque la livraison nécessite une prise de rendez-vous avec le Client Le Client doit contacter le Vendeur à l'adresse «<a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>» ou par le 
											service vocal TeamSpeak à l'adresse « ts.mcgeps.ca » en s'adrassant aux membres titulaires du poste «Fondateur».<br>
											Lorsque le Client commande plusieurs produits en même temps ceux-ci peuvent avoir des délais de livraison différents.<br>
											En cas de retard d’expédition le Client doit contacter le Vendeur à l'adresse «<a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>» ou par le service vocal TeamSpeak à l'adresse
											 « ts.mcgeps.ca » en s'adrassant aux membres titulaires du poste «Fondateur».<br>
											En cas de retard de livraison, le Client dispose de la possibilité de résoudre le contrat dans les conditions et modalités définies à l’Article L 138-2 du Code de la consommation. 
											Le Vendeur procède alors au remboursement du produit et aux frais « aller » dans les conditions de l’Article L 138-3 du Code de la consommation.<br>
											Le Vendeur rappelle qu’au moment où le Client pend possession physiquement des produits, les risques de perte ou d’endommagement des produits lui est transféré. Il appartient au Client 
											de notifier au transporteur toute réserves sur le produit livré.<br><br>
											<strong>Article 8 : Disponibilité et présentation</strong><br>
											Les commandes seront traitées dans la limite de nos stocks disponibles ou sous réserve des stocks disponibles chez nos fournisseurs. En cas d’indisponibilité d’un article pour une 
											période supérieure à 7 jours ouvrables, vous serez immédiatement prévenu des délais prévisibles de livraison et la commande de cet article pourra être annulée sur simple demande. 
											Le Client pourra alors demander un avoir pour le montant de l’article ou son remboursement.<br><br>
											<strong>Article 9 : Paiement</strong><br>
											Le paiement est exigible immédiatement à la commande, y compris pour les produits en précommande. Le Client peut effectuer le règlement par carte de paiement ou chèque bancaire. 
											Les cartes émises par des banques domiciliées hors de France doivent obligatoirement être des cartes bancaires internationales (Mastercard ou Visa).Le paiement sécurisé en ligne par carte 
											bancaire est réalisé par notre prestataire de paiement. Les informations transmises sont chiffrées dans les règles de l’art et ne peuvent être lues au cours du transport sur le 
											réseau.<br>
											Une fois le paiement lancé par le Client, la transaction est immédiatement débitée après vérification des informations. Conformément à l’article L. 132-2 du Code monétaire et financier, 
											l’engagement de payer donné par carte est irrévocable. En communiquant ses informations bancaires lors de la vente, le Client autorise le Vendeur à débiter sa carte du montant relatif au 
											prix indiqué. Le Client confirme qu’il est bien le titulaire légal de la carte à débiter et qu’il est légalement en droit d’en faire usage. En cas d’erreur, ou d’impossibilité de débiter 
											la carte, la Vente est immédiatement résolue de plein droit et la commande annulée.<br><br>
											<strong>Article 10 : Délai de rétractation</strong><br>
											Conformément à l’article L. 121-20 du Code de la consommation, « le consommateur dispose d’un délai de quatorze jours francs pour exercer son droit de rétractation sans avoir à justifier 
											de motifs ni à payer de pénalités, à l’exception, le cas échéant, des frais de retour ». « Le délai mentionné à l’alinéa précédent court à compter de la réception pour les biens ou de 
											l’acceptation de l’offre pour les prestations de services ». Le droit de rétractation peut être exercé en contactant la Société de la manière suivante : Le Client doit contacter le Vendeur 
											à l'adresse «<a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>» ou par le service vocal TeamSpeak à l'adresse « ts.mcgeps.ca » en s'adrassant aux membres titulaires 
											du poste «Fondateur».<br>
											<!-- Nous informons les Clients que conformément à l’article L. 121-20-2 du Code de la consommation, ce droit de rétractation ne peut être exercé pour _______ (décrire les biens non sujets 
											à ces dispositions).<br> -->
											En cas d’exercice du droit de rétractation dans le délai susmentionné, seul le prix du ou des produits achetés et les frais d’envoi seront remboursés, les frais de retour restent à la 
											charge du Client.<br>
											Les retours des produits sont à effectuer dans leur état d'origine et complets (emballage, accessoires, notice...) de sorte qu'ils puissent être recommercialisés à l’état neuf ; ils doivent 
											si possible être accompagnés d’une copie du justificatif d'achat.<br>
											Conformément aux dispositions légales, vous trouverez ci-après le formulaire-type de rétractation à nous adresser à l’adresse 
											suivante : <a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a><br>
											Procédure de remboursement : Suite à la demande de remboursement, si le Client à réellement effectué l'achat aupparavant et que celui-ci n'a pas expiré, le Vendeur effectue le 
											virement de l'argent par l'intermédiaire du service bancaire Paypal vers le compte Paypal du Client grâce aux infomations recueillis à l'inscription du Client.<br><br>
											<strong>Article 11 : Garanties</strong>
											Conformément à la loi, le Vendeur assume deux garanties : de conformité et relative aux vices cachés des produits. Le Vendeur rembourse l'acheteur ou échange les produits apparemment 
											défectueux ou ne correspondant pas à la commande effectuée.<br>
											La demande de remboursement doit s'effectuer de la manière suivante : Le Client doit contacter le Vendeur à l'adresse «<a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a>» ou par le service vocal TeamSpeak à l'adresse
											 « ts.mcgeps.ca » en s'adrassant aux membres titulaires du poste «Fondateur».
											Le Vendeur rappelle que le consommateur :<br>
											- dispose d'un délai de 2 ans à compter de la délivrance du bien pour agir auprès du Vendeur<br>
											- qu'il peut choisir entre le remplacement et la réparation du bien sous réserve des conditions prévues par l'art. apparemment défectueux ou ne correspondant<br>
											- qu'il est dispensé d'apporter la preuve l’existence du défaut de conformité du bien durant les six mois suivant la délivrance du bien.<br>
											- que, sauf biens d’occasion, ce délai sera porté à 24 mois à compter du 18 mars 2016<br>
											- que le consommateur peut également faire valoir la garantie contre les vices cachés de la chose vendue au sens de l’article 1641 du code civil et, dans cette hypothèse, il peut 
											choisir entre la résolution de la vente ou une réduction du prix de vente (dispositions des articles 1644 du Code Civil).<br>
											Garanties complémentaires : Aucune.<br><br>
											<strong>Article 12 : Réclamations</strong><br>
											Le cas échéant, l’Acheteur peut présenter toute réclamation en contactant la société au moyen des coordonnées suivantes <a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a> ou par le 
											service vocal TeamSpeak à l'adresse « ts.mcgeps.ca » en s'adrassant aux membres titulaires du poste «Fondateur».<br><br>
											<strong>Article 13 : Droits de propriété intellectuelle</strong><br>
											Les marques, noms de domaines, produits, logiciels, images, vidéos, textes ou plus généralement toute information objet de droits de propriété intellectuelle sont et restent la propriété 
											exclusive du vendeur. Aucune cession de droits de propriété intellectuelle n’est réalisée au travers des présentes CGV. Toute reproduction totale ou partielle, modification ou utilisation 
											de ces biens pour quelque motif que ce soit est strictement interdite.<br><br>
											<strong>Article 14 : Force majeure</strong><br>
											L’exécution des obligations du vendeur au terme des présentes est suspendue en cas de survenance d’un cas fortuit ou de force majeure qui en empêcherait l’exécution. Le vendeur avisera 
											le client de la survenance d’un tel évènement dès que possible.<br><br>
											<strong>Article 15 : nullité et modification du contrat</strong><br>
											Si l’une des stipulations du présent contrat était annulée, cette nullité n’entraînerait pas la nullité des autres stipulations qui demeureront en vigueur entre les parties. Toute 
											modification contractuelle n’est valable qu’après un accord écrit et signé des parties.<br><br>
											<strong>Article 16 : Protection des données personnelles</strong><br>
											Conformément à la Loi Informatique et Libertés du 6 janvier 1978, vous disposez des droits d’interrogation, d’accès, de modification, d’opposition et de rectification sur les données 
											personnelles vous concernant. En adhérant à ces conditions générales de vente, vous consentez à ce que nous collections et utilisions ces données pour la réalisation du présent contrat. 
											En saisissant votre adresse email sur l’un des sites de notre réseau, vous recevrez des emails contenant des informations et des offres promotionnelles concernant des produits édités par 
											la Société et de ses partenaires. Vous pouvez vous désinscrire à tout instant. Il vous suffit pour cela de cliquer sur le lien présent à la fin de nos emails ou de contacter le responsable 
											du traitement (la Société) par lettre RAR. Nous effectuons sur l’ensemble de nos sites un suivi de la fréquentation.<br><br>
											<strong>Article 17 : Droit applicable</strong><br>
											Toutes les clauses figurant dans les présentes conditions générales de vente, ainsi que toutes les opérations d’achat et de vente qui y sont visées, seront soumises au droit français.<br><br>
											Nos conditions générales de vente ont été élaborées à partir d'un modèle libre et gratuit qui peut être téléchargé sur le 
											site <a href="https://www.donneespersonnelles.fr/">https://www.donneespersonnelles.fr/</a>
										</p>
									</div>
								</div></div><br/><br/><br/>
								<h3>CONDITIONS GÉNÉRALES D'UTILISATION DU SITE G.E.P.S.</h3>
								<input class="spoilerbutton button fit" type="button" value="Afficher" onclick="this.value=this.value=='Afficher'?'Cacher':'Afficher';"/>
								<div class="spoiler"><div>
									<div id="cgu" class="cgu">
										<p>
											<strong>ARTICLE 1. INFORMATIONS LÉGALES</strong><br/>
											En vertu de l'article 6 de la Loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé dans cet article l'identité des différents intervenants 
											dans le cadre de sa réalisation et de son suivi.<br/><br/>
											Le site G.E.P.S. est édité par :<br/>
											Monsieur William GAGNON et Monsieur Mathieu LAGACÉ,<br/>
											Adresse e-mail : contact@geps.ca<br/><br/>
											Le directeur de publication du site est :<br/>
											Monsieur William GAGNON.<br/><br/>
											Le site G.E.P.S. est hébergé par :<br/>
											Hostinger International Ltd., dont le siège est situé 61 Rue Lordou Vironos 6023 Larnaca, Chypre<br/><br/>
											<strong>ARTICLE 2. PRÉSENTATION DU SITE</strong><br/>
											Le site G.E.P.S. a pour objet :<br/>
											De rallier sa communauté au tour d'une même plateforme et d’offrir à ses joueurs la meilleur expérience de jeu.<br/><br/>
											<strong>ARTICLE 3. CONTACT</strong><br/>
											Pour toute question ou demande d'information concernant le site, ou tout signalement de contenu ou d'activités illicites, l'utilisateur peut contacter l'éditeur à l'adresse e-mail 
											suivante: <a href="mailto:contact@mcgeps.ca">contact@mcgeps.ca</a> ou se rendre sur le server vocal TeamSpeak (ts.mcgeps.ca) et accusé de réception à un membre titulaire du 
											poste « Fondateur ».<br/><br/>
											<strong>ARTICLE 4. ACCEPTATION DES CONDITIONS D'UTILISATION</strong><br/>
											L'accès et l'utilisation du site sont soumis à l'acceptation et au respect des présentes Conditions Générales d'Utilisation.<br/>
											L'éditeur se réserve le droit de modifier, à tout moment et sans préavis, le site et des services ainsi que les présentes CGU, notamment pour s'adapter aux évolutions du 
											site par la mise à disposition de nouvelles fonctionnalités ou la suppression ou la modification de fonctionnalités existantes.<br/>
											Il est donc conseillé à l'utilisateur de se référer avant toute navigation à la dernière version des CGU, accessible à tout moment sur le site. En cas de désaccord avec les CGU, 
											aucun usage du site ne saurait être effectué par l'utilisateur.<br/><br/>
											<strong>ARTICLE 5. ACCÈS ET NAVIGATION</strong><br/>
											L'éditeur met en œuvre les solutions techniques à sa disposition pour permettre l'accès au site 24 heures sur 24, 7 jours sur 7. Il pourra néanmoins à tout moment suspendre, 
											limiter ou interrompre l'accès au site ou à certaines pages de celui-ci afin de procéder à des mises à jours, des modifications de son contenu ou tout autre action jugée nécessaire au 
											bon fonctionnement du site.<br/>
											La connexion et la navigation sur le site G.E.P.S. valent acceptation sans réserve des présentes Conditions Générales d'Utilisation, quelques soient les moyens techniques d'accès et 
											les terminaux utilisés.<br/>
											Les présentes CGU s'appliquent, en tant que de besoin, à toute déclinaison ou extension du site sur les réseaux sociaux et/ou communautaires existants ou à venir.<br/><br/>
											<strong>ARTICLE 6. GESTION DU SITE</strong><br/>
											Pour la bonne gestion du site, l'éditeur pourra à tout moment :<br/>
											- suspendre, interrompre ou limiter l'accès à tout ou partie du site, réserver l'accès au site, ou à certaines parties du site, à une catégorie déterminée d'internaute ;<br/>
											- supprimer toute information pouvant en perturber le fonctionnement ou entrant en contravention avec les lois nationales ou internationales, ou avec les règles de la Nétiquette ;<br/>
											- suspendre le site afin de procéder à des mises à jour.<br/><br/>
											<strong>ARTICLE 7. SERVICES RÉSERVÉS AUX UTILISATEURS INSCRITS</strong><br/><br/>
											<strong>7.1 INSCRIPTION</strong><br/>
											L'accès à certains services et notamment à tous les services payants, est conditionné par l'inscription de l'utilisateur.<br/>
											L'inscription et l'accès aux services du site sont réservés exclusivement aux personnes physiques capables juridiquement, ayant rempli et validé le formulaire d'inscription 
											disponible en ligne sur le site G.E.P.S., ainsi que les présentes Conditions Générales d'Utilisation.<br/>
											Lors de son inscription, l'utilisateur s'engage à fournir des informations exactes, sincères et à jour sur sa personne et son état civil. L'utilisateur devra en outre procéder à 
											une vérification régulière des données le concernant afin d'en conserver l'exactitude.<br/>
											L'utilisateur doit ainsi fournir impérativement une adresse e-mail valide. Une adresse de 
											messagerie électronique ne peut être utilisée plusieurs fois pour s'inscrire aux services.<br/>
											Toute communication réalisée par G.E.P.S. et ses partenaires est en conséquence réputée avoir été réceptionnée et lue par l'utilisateur. Ce dernier s'engage donc à consulter 
											régulièrement les messages reçus sur cette adresse e-mail et à répondre dans un délai raisonnable si cela est nécessaire.<br/>
											Une seule inscription aux services du site est admise par personne physique.<br/>
											L'utilisateur se voit attribuer un identifiant lui permettant d'accéder à un espace dont l'accès lui est réservé (ci-après "Espace personnel"), 
											en complément de la saisie de son mot de passe.<br/>
											L'identifiant et le mot de passe sont modifiables en ligne par l'utilisateur dans son Espace personnel. Le mot de passe est personnel et confidentiel, l'utilisateur 
											s'engage ainsi à ne pas le communiquer à des tiers.<br/>
											G.E.P.S. se réserve en tout état de cause la possibilité de refuser ou résilié une demande d'inscription aux services en cas de non-respect par l'Utilisateur des dispositions des présentes 
											Conditions Générales d'Utilisation.<br/><br/>
											<strong>7.2 DÉSINSCRIPTION</strong><br/>
											L'utilisateur régulièrement inscrit pourra à tout moment demander sa désinscription en se rendant sur la page dédiée dans son Espace personnel. Toute désinscription du site sera 
											effective immédiatement après que l'utilisateur ait rempli le formulaire prévu à cet effet.<br/><br/>
											<strong>ARTICLE 8. RESPONSABILITÉS</strong><br/>
											L'éditeur n'est responsable que du contenu qu'il a lui-même édité.<br/>
											L'éditeur n'est pas responsable :<br/>
											- en cas de problématiques ou défaillances techniques, informatiques ou de compatibilité du site avec un matériel ou logiciel quel qu'il soit ;<br/>
											- des dommages directs ou indirects, matériels ou immatériels, prévisibles ou imprévisibles résultant de l'utilisation ou des difficultés d'utilisation du site ou de ses services ;<br/>
											- des caractéristiques intrinsèques de l'Internet, notamment celles relatives au manque de fiabilité et au défaut de sécurisation des informations y circulant ;<br/>
											- des contenus ou activités illicites utilisant son site et ce, sans qu'il en ait pris dûment connaissance.<br/>
											Par ailleurs, le site ne saurait garantir l'exactitude, la complétude, et l'actualité des informations qui y sont diffusées.<br/>
											L'utilisateur est responsable :<br/>
											- de la protection de son matériel et de ses données ;<br/>
											- de l'utilisation qu'il fait du site ou de ses services ;<br/>
											- s'il ne respecte ni la lettre, ni l'esprit des présentes CGU.<br/><br/>
											<strong>ARTICLE 9. LIENS HYPERTEXTES</strong><br/>
											Le site peut contenir des liens hypertextes pointant vers d'autres sites internet sur lesquels G.E.P.S. n'exerce pas de contrôle. Malgré les vérifications préalables et régulières 
											réalisés par l'éditeur, celui-ci décline tout responsabilité quant aux contenus qu'il est possible de trouver sur ces sites.<br/>
											L'éditeur autorise la mise en place de liens hypertextes vers toute page ou document de son site sous réserve que la mise en place de ces liens ne soit pas réalisée à des fins 
											commerciales ou publicitaires.<br/>
											En outre, l'information préalable de l'éditeur du site est nécessaire avant toute mise en place de lien hypertexte.<br/>
											Sont exclus de cette autorisation les sites diffusant des informations à caractère illicite, violent, polémique, pornographique, xénophobe ou pouvant porter atteinte 
											à la sensibilité du plus grand nombre.<br/>
											Enfin, G.E.P.S. se réserve le droit de faire supprimer à tout moment un lien hypertexte pointant vers son site, si le site l'estime non conforme à sa politique éditoriale.<br/><br/>
											<strong>ARTICLE 10. COLLECTE DE DONNÉES</strong><br/>
											Le site est conforme aux dispositions de la 
											Loi n° 78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés, dite Loi "Informatique et Libertés". En vertu des dispositions de la loi précitée, 
											l'utilisateur bénéficie, notamment, d'un droit d'opposition (articles 32 et 38), d'accès (articles 38 et 39) et de rectification (article 40) des données le concernant.<br/>
											Pour faire usage de l'un des droits précités, l'utilisateur doit s'adresser à l'éditeur en le contactant par e-mail à l'adresse suivante : contact@mcgeps.ca, en précisant 
											ses nom, prénom(s), adresse et adresse(s) e-mail.<br/><br/>
											<strong>ARTICLE 11. COOKIES</strong><br/>
											Le site a éventuellement recours aux techniques de "cookies" lui permettant de traiter des statistiques et des informations sur le trafic, de faciliter la navigation et 
											d'améliorer le service pour le confort de l'utilisateur, lequel peut s'opposer à l'enregistrement de ces "cookies" en configurant son logiciel de navigation.<br/><br/>
											<strong>ARTICLE 12. PROPRIÉTÉ INTELLECTUELLE</strong><br/>
											La structuration du site mais aussi les textes, graphiques, images, photographies, sons, vidéos et applications informatiques qui le composent sont la propriété de l'éditeur et 
											sont protégés comme tels par les lois en vigueur au titre de la propriété intellectuelle.<br/>
											Toute représentation, reproduction, adaptation ou exploitation partielle ou totale des contenus, marques déposées et services proposés par le site, par quelque procédé que ce soit, 
											sans l'autorisation préalable, expresse et écrite de l'éditeur, est strictement interdite et serait susceptible de constituer une contrefaçon au sens des articles L. 335-2 et suivants 
											du Code de la propriété intellectuelle. Et ce, à l'exception des éléments expressément désignés comme libres de droits sur le site.<br/>
											L'accès au site ne vaut pas reconnaissance d'un droit et, de manière générale, ne confère aucun droit de propriété intellectuelle relatif à un élément du site, lesquels restent la 
											propriété exclusive de l'éditeur.<br/>
											Il est interdit à l'utilisateur d'introduire des données sur le site qui modifieraient ou qui seraient susceptibles d'en modifier le contenu ou l'apparence.<br/><br/>
											<strong>ARTICLE 13. DROIT APPLICABLE ET JURIDICTION COMPETENTE</strong><br/>
											Les règles en matière de droit, applicables aux contenus et aux transmissions de données sur et autour du site, sont déterminées par la loi française. En cas de litige, 
											n'ayant pu faire l'objet d'un accord à l'amiable, seuls les tribunaux Canadiens du ressort de la cour d'appel du Québec sont compétents.<br/><br/>
											Le site G.E.P.S. vous souhaite une excellente navigation !<br/>
										</p>
									</div>
								</div></div>
								<h3>Politique de Confidentialité</h3>
								<a href="//www.iubenda.com/privacy-policy/7848856" class="iubenda-black iub-legal-only iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
								<div class="notification-box">
									<div id="cookie_box" class="item cookie-alert">
										<a href="#main">Haut</a>
									</div>
								</div>
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