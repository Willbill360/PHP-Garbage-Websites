<?php
session_start();
session_destroy();
session_start();
include_once('config.php');
include('cookieconnect.php');

if(isset($_POST['formconnexion']))
{
  $nomconnect = htmlspecialchars($_POST['nomconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($nomconnect) AND !empty($mdpconnect))
  {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND motdepasse = ?");
    $requser->execute(array($nomconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if($userexist == 1)
    {
      if(isset($_POST['rememberme']))
      {
        setcookie('password', $mdpconnect, time() + 365*24*3600, '/', null, false, true);
        setcookie('nom', $nomconnect, time() + 365*24*3600, '/', null, false, true);
      }
      if($isLocal == true){
        $ip = 'Mon Ip de Test';
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['nom'] = $userinfo['nom'];
      $_SESSION['grade'] = $userinfo['grade'];
      header("Location: tableau-de-bord?id=".$_SESSION['id']);
    }
    else
    {
      $erreur = "Mauvais nom ou mot de passe !";
    }
  }
  else
  {
    $erreur = "Tous les champs doivent être complété !";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Base CWU</title>
<meta property="og:url" content="http://mcgesp.ca" />
<meta property="og:type" content="website" />
<meta property="og:title" content="GEPS - Réseau multigaming" />
<meta property="og:description" content="Réseau multigaming | Hébergement | Conception" />
<meta property="og:image" content="http://mcgeps.ca/modpack/logo.png" />
<meta name="description" content="Base de données premium pour serveur HL2RP" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="robots" content="index,follow,all" />
<meta name="keywords" content="HL2RP, CWU, Civil Worker Union, Base de données" />
<meta name="author" content="GEPS" />
<link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="css/grid.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/overlay.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<!-- <script language="JavaScript" type="text/javascript">
 
// Un tableau qui va contenir toutes tes images.
var images = new Array();
images.push("img/hl2rp-1.jpg");
images.push("img/hl2rp-4.jpg");
images.push("img/hl2rp-5.jpg");
//images.push("3.jpg");
 
var pointeur = 0;
 
function ChangerImage(){
document.getElementById("hero").style.background = "url('"+images[pointeur]+"') no-repeat center center fixed";
 
if(pointeur < images.length - 1){
pointeur++;
}
else{
pointeur = 0;
}
 
setTimeout("ChangerImage()", 10000)
}
 
// Charge la fonction
window.onload = function(){
ChangerImage();
}
</script> -->
</head>
<body>
<div class="animsition-overlay">
  <div id="section-1">
    <header class="main_h">
      <div class="menufix"> <a class="logo" href="index.html"><img src="images/logo-sample.png" alt="Hello"></a>
        <div class="mobile-toggle"> <span></span> <span></span> <span></span> </div>
        <nav>
          <ul>
            <li><a class="out active animsition-link" href="index.php">HOME</a></li>
            <li class="line"><a class="out animsition-link" href="company.php">COMPANY</a></li>
            <li class="line"><a class="out animsition-link" href="service.php">SERVICES</a></li>
            <li class="line"><a class="out animsition-link" href="blog.php">BLOG</a></li>
            <li class="line"><a class="out animsition-link" href="gallery.php">GALLERY</a></li>
            <li class="line"><a class="out animsition-link" href="contact.php">CONTACT</a></li>
          </ul>
        </nav>
      </div>
      <!-- / row --> 
      
    </header>
    <div class="hero" id="hero">
      <h1 id="title-1">Data Base<em>CWU</em></h1>
      <!-- Contents -->
      <div class="grid">
        <div class="row paddtop100">
          <div class="col_12">
            <form method="post" action="">
              <div class="label-home">Nom (In-Game): </div>
              <input type="text" name="nomconnect" id="nomconnect" value="" placeholder="Nom (In-Game)" />
              <div class="spacer"></div>
              <div class="label-home">Mot de passe: </div>
              <input type="password" name="mdpconnect" id="mdpconnect" value="" placeholder="Mot de passe" />
              <div class="spacer"></div>
              <div align="center" class="souv">
                <input type="checkbox" id="rememberme" name="rememberme" class="input_class_checkbox">
                <label for="rememberme">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rester Connecté</label>
              </div>
              <div class="spacer"></div>
              <div class="btn-co">
                <input name="formconnexion" type="submit" value="Se connecter" />
              </div>
              <?php
                if(isset($erreur))
                {
                  echo '<div align="center" style="color:red;margin-top:30px;">'.$erreur.'</div>';
                }
              ?>
            </form>
          </div>
        </div>
      </div>


    <!--
      <div class="social-btn-container"> <span class="social-btn-box"> <a href="#" class="google-plus-btn"><i class="fa fa-google-plus"></i></a> </span>
        <span class="social-btn-box"> <a href="#" class="facebook-btn"><i class="fa fa-facebook"></i></a> </span>
        <span class="social-btn-box"> <a href="#"><i class="fa fa-twitter"></i></a> </span>
        <span class="social-btn-box"> <a href="#" class="linkedin-btn"><i class="fa fa-linkedin"></i></a> </span>
        <span class="social-btn-box"> <a href="#" class="youtube-btn"><i class="fa fa-youtube"></i></a> </span>
      </div> 
    -->
    </div>
    <!-- /.hero --> 
  </div>
  <!-- END #section-1 -->
    
    <p class="dolje">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
  </div>
  <!-- END #section-credits --> 
</div>
<!-- END .animsition-overla --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/animsition.min.js"></script> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
<script src="js/jquery.parallax-scroll.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.cbpQTRotator.min.js"></script> 
<script>
    $(document).ready(function() {
     
      $("#owl-partners").owlCarousel({
     
          autoPlay: 4000, 
          stopOnHover : true,
          pagination : false,
          items : 5,
          itemsDesktop : [1199,4],
          itemsDesktopSmall : [959,3]     
      });     
    });
</script> 
<script>
	$( function() {
	$( '#cbp-qtrotator' ).cbpQTRotator();					
	});
</script> 
<script src="js/functions.js"></script> 
<script src="js/particle.js"></script> 
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15815880-3']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>