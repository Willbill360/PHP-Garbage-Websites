<?php
session_start();
session_destroy();
session_start();
include_once('config.php');
include('cookieconnect.php');

?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
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
<link rel="stylesheet" type="text/css" href="css/stylelogin.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/overlay.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link href='//fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
    function hideURLbar(){ window.scrollTo(0,1); } </script>
<script language="JavaScript" type="text/javascript">
 
// Un tableau qui va contenir toutes tes images.
var images = new Array();
images.push("img/hl2rp-6.jpg");
//images.push("3.jpg");
 
var pointeur = 0;
 
function ChangerImage(){
//document.getElementById("hero").style.background = "url('"+images[pointeur]+"') no-repeat center center fixed";
$("#hero").css("background-image", "url('"+images[pointeur]+"')");
 
if(pointeur < images.length - 1){
pointeur++;
}
else{
pointeur = 0;
}

setTimeout("ChangerImage()", 5000)
}
 
// Charge la fonction
window.onload = function(){
ChangerImage();
}
</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div class="animsition-overlay">
  <div id="section-1">
    <div id="languages">
      <a href="?lang=en"><img src="img/en.png"></a>
      <a href="?lang=fr"><img src="img/fr.png"></a>
    </div>
    <div class="hero" id="hero">
      <h1 id="title-1">Data Base<em>CWU</em></h1>
      <!-- Contents -->
      <div class="grid">
        <div class="row paddtop100">
          <div class="col_12">
            <div class="thelogin">
              <div id="wrapper">
                <div id="boxy-login-wrapper">
                  <form id="boxy-login-form" name="boxy-login-form" method="POST"> 
                    <fieldset>
                      <div class="boxy-form-inner rotateFirst3d">
                        <span class="end-cap left"><i class="glyphicon glyphicon-user fa fa-user" id="loginform" style="top: 5px;left: 4px;"></i></span>
                      </div>
                    </fieldset>
                    <div class="login" style="left:20%;">
                    <div class="arrow-up"></div>
                      <div class="formholder">
                        <div class="randompad">
                           <fieldset>
                              <p class="name hidden" style="color:#000;" id="name">Temp_Name</p>
                              <input type="text" name="nom" id="nom" placeholder="<?= $lang['LOGIN_NAME'] ?>" />
                              <input type="password" name="password" id="password" placeholder="<?= $lang['LOGIN_PASS'] ?>" />
                              <div align="center" class="souv">
                                <input type="checkbox" id="rememberme" name="rememberme" class="input_class_checkbox">
                                <label for="rememberme" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $lang['LOGIN_SOUV'] ?></label>
                              </div>
                              <p align="center" style="color:red;margin-top:10px;" id="error">Temp_Error</p>
                              <!-- <input type="submit" id="login" value="Se Connecter" /> -->
                           </fieldset>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
    <p class="dolje">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p><p class="adminco"><a href="buy-access"><?= $lang['ADMIN_BUY'] ?></a></p>
  </div>
  <!-- END #section-credits --> 
</div>
<!-- <div style="margin-top:-180px;">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      CWU BDD
       <ins class="adsbygoogle"
           style="display:inline-block;width:728px;height:90px"
           data-ad-client="ca-pub-9083504882836474"
           data-ad-slot="2475039941"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
END .animsition-overla -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/animsition.min.js"></script> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
<script src="js/jquery.parallax-scroll.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.cbpQTRotator.min.js"></script> 
<script type="text/javascript">
/*$(document).keypress("a",function(e) {
  if(e.ctrlKey)
    alert("Ctrl+C was pressed!!");
});*/
/*$(document).keyup(function(e){
      //CTRL + ENTER keydown combo
      //console.log(e.keyCode);
      if(e.ctrlKey && e.keyCode == 13){
        console.log("CTRL+ENTER");
      }
      if(e.keyCode == 13 && !e.ctrlKey){
        console.log("Enter");
      }
});*/
</script>
<script type="text/javascript">
<?php

  $err_name_1 = $lang['LOGIN_ERR_NAME_1'];
  echo "var error_name_1 = '{$err_name_1}';";
  $err_name_2 = $lang['LOGIN_ERR_NAME_2'];
  echo "var error_name_2 = '{$err_name_2}';";
  $err_mdp_1 = $lang['LOGIN_ERR_MDP_1'];
  echo "var error_mdp_1 = '{$err_mdp_1}';";
  $err_mail_1 = $lang['LOGIN_ERR_EMAIL_1'];
  echo "var error_mail_1 = '{$err_mail_1}';";

?>
</script>
<script src="js/loginform.js"></script>
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
