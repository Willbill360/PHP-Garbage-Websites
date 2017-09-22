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

if(isset($_SESSION['id'])) {
   $getid = intval($_SESSION['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
?>
<html>
	<head>
		<title>G.E.P.S - Vote</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="icon" type="image/ico" href="images/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
 		
        $(document).ready(function(){

                function getJSONAPI(voted,service_selected) {
 
                        var dataService,href;
                        var list_services = {};
 
                        $('.service').each(function(){
                                dataService = $(this).attr('data-service');
                                href = $(this).find('a').attr('href');
 
                        list_services[dataService] = href;
 
                        });
 
                        var vote,status,msg;
 
                        (voted) ? vote = 'on' : vote = 'off';
 
                        jQuery.ajax({
                          url: 'action_bouton_vote.php',
                          type: 'GET',
                          dataType: 'json',
                          data: {vote : ''+vote+'', list_services : list_services, service_selected : service_selected},
                          beforeSend:function(){
                          $('#results').html('<p class="info"><img src="http://www.domaine-lafage.com/skin/frontend/colinus/lafage/images/loading.gif" /></p>');
                          },
                          complete: function(xhr, textStatus) {
                            //called when complete
                          },
                          success: function(data, textStatus, xhr) {
 
                                status = data.status;
                                msg = data.msg;
 
                                        switch (status) {
                                                case "error":
                                                        $('#results').html('<p class="error">'+msg+'</p>');
                                                break;
                                                case "info":
                                                        $('#results').html('<p class="info">'+msg+'</p>');
                                                break;
                                                case "warning":
                                                        $('#results').html('<p class="warning">'+msg+'</p>').queue(setTimeout(getJSONAPI,5000)).dequeue();
                                                break;
 
                                                default:
                                                        $('#results').html('<p class="ok">'+msg+'</p>').queue(setTimeout(getJSONAPI,5000)).dequeue();
                                                break;
                                        }
 
                          },
                          error: function(xhr, textStatus, errorThrown) {
                            $('#results').html('<p class="error">Error !!!!: ' + textStatus + errorThrown +'</p>');
                            console.log(textStatus + errorThrown);
                            console.warn(xhr.responseText);
                          }
                        });
                };
                getJSONAPI();
 
                $(".button_vote").click(function(e){ e.preventDefault();
 
                        var service = $(this).parent().attr("data-service"); //identifier le service pour lequel on vote
                        var href = $(this).prev().attr("href");
                        var service_selected = {}
                        service_selected[service] = href;
 
                        getJSONAPI(true,service_selected);
 
                });
        });
 
        </script>
 
        <!-- _________ DANS CETTE PARTIE, ON DECORE NOTRE LIEN POUR CREER UN JOLIE BOUTON ______-->
 
        <style type="text/css">
	        #service_list {
	        }
	        /* on détermine une couleur pour chaque type de message que nous renvera notre page action_bouton_vote.php */
	        .error,.warning,.ok,.info{
	        	font-size:15px; padding:8px; width:400px; height: auto; text-align:center; font-weight:bold; border-top: solid 1px black; border-bottom: solid 1px black;box-sizing: border-box;
	        }                
	        .error {background-color:#f5d1d3;}.warning{background-color:#fcf7d9;}.ok {background-color:#e3ebc6;}.info {background-color:#f2f2f2;}
	        /* on décore notre lien */
	        .service {width:auto;}
            .link_vote {text-decoration:none; color:#0000FF;}
            .button_vote {float:right;}
        </style>
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
							<h2>Espace de vote G.E.P.S.</h2>
							<p>Aidez nous à grandir !</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<div id="results" align="center"></div>
								<div id="service_list">
		                        <div class="service" data-service="mcserv">
		                        	<!-- http://www.mcserv.org/GEPS_9147.html -->
	                                <a href="http://www.mcserv.org/MadInCRAFT-Survival_6986.html" class="button special" title="Votez sur McServ" target="_blanck">Votez sur McServ</a>
	                                <button class="button_vote button" >Recevoir PV</button>
		                        </div>
		                        <div class="service" data-service="top-serveurs-minecraft">
		                            <a href="http://top-serveurs-minecraft.fr/fiche_serveur.php?id=3417#a" class="button special" title="Votez sur top-serveur-minecraft" target="_blanck">Votez sur top-serveurs-minecraft</a>
		                            <button class="button_vote button" >Recevoir PV</button>
		                        </div>
		                       <div class="service" data-service="minecraftservers">
	                                <a href="http://www.serveurs-minecraft.org/vote.php?id=46955" class="button special" title="Votez sur minecraftservers" target="_blanck">Votez sur minecraftservers</a>
	                                <button class="button_vote button" >Recevoir PV</button>
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
<?php
	} else {
		header("Location: connexion");
	}
?>
<?php   
}
?>