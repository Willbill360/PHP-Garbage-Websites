<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM admins WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

?>
<?php
  if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
    if($userinfo['serveur'] != '2--allserverisevilandiknowthatsoidontgiveashit--2') {
      $reqcwu = $bdd->prepare("SELECT * FROM membres WHERE serveur = ?");
      $reqcwu->execute(array($userinfo['serveur']));
      $cwuexist = $reqcwu->rowCount();
    } else {
      $cwuexist = 1;
      $reqcwu = $bdd->query("SELECT * FROM membres WHERE serveur = '".$_SESSION['serveur']."'");
    }
    $reqabo = $bdd->prepare("SELECT * FROM abonnement WHERE serveur = ?");
    $reqabo->execute(array($userinfo['serveur']));
    $aboinfo = $reqabo->fetch();
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['ADMIN_TITLE'] ?> - Data Base CWU</title>
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
<link rel="stylesheet" href="css/social.css">
<link rel="stylesheet" href="css/imgover.css">
<link rel="stylesheet" href="css/triangle.css">
<link href="css/lightgallery.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
<div class="animsition-overlay">
  
  <!-- END #section-2 -->
  <div id="languages">
      <a href="?lang=en"><img src="img/en.png"></a>
      <a href="?lang=fr"><img src="img/fr.png"></a>
    </div>
  <div class="backimg" id="section-door">
    <div class="grid flex">
      <div class="row" style="overflow:hidden;">
        <!-- START Left -->
        <div class="colw_6 alomdebe" id="fdiv">
          <div class="colw_12 alomdebe white padd5555 hei100 wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s">
            <h2><?= $lang['DASH_WELCOME'] ?> <?= $userinfo['pseudo'] ?></h2>
            <div class="paddtop105">
              <div class="mainleft" id="mainleft">
                <div class="right" style="float:right;width:50%;">
                  <?php if($cwuexist >= 1) { ?>
                    <h4><?= $lang['ADMIN_SUPERVISOR'] ?></h4>
                    <div class="contsuperviseur" id="contsuperviseur">
                      <?php while($cwuinfo = $reqcwu->fetch()) { ?>
                        <h5 style="padding-bottom:0;"><?= $cwuinfo['nom']?></h5>
                      <?php } ?>
                    </div>
                    <?php } else { ?>
                      <p><?= $lang['ADMIN_BEFORE'] ?></p>
                      <p><?= $lang['ADMIN_BEFORE_ADD'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <p><?= $lang['ADMIN_BEFORE_SEARCH'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <p><?= $lang['ADMIN_BEFORE_LOGOUT'] ?></p>
                    <?php } ?>
                </div>
                <div align="center" class="btn-box">
                  <a href="add-admin" class="img-btn animsition-link">
                    <img align="center" src="img/man-plus.png" style="" class="btn-img" />
                    <p><?= $lang['ADMIN_ADD'] ?></p>
                  </a>
                </div>
                <div align="center" class="btn-box">
                  <a href="search-admin" class="img-btn animsition-link">
                    <img align="center" src="img/man-search.png" style="" class="btn-img" />
                    <p><?= $lang['ADMIN_SEARCH'] ?></p>
                  </a>
                </div>
                 <div align="center" class="btn-box">
                  <a href="deconnexion" class="img-btn">
                    <img align="center" src="img/deconnexion.png" style="" class="btn-img" />
                    <p><?= $lang['DASH_LOGOUT'] ?></p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Left -->
        <!-- START Right -->
        <div class="colw_6 alomdebe" id="sdiv">
          <div class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s">
            <img align="right" src="img/cwu-logo-black-admin.png" style="" class="cwu-logo" />
            <div class="paddtop105">
              <h4 style="margin-top:5%;"><?= $lang['ADMIN_EXP'] ?></h4>
              <h5><?php echo $aboinfo['date_exp']; ?></h5>       
              </div>
          </div> 
        </div>
        <!-- END Right -->

        <p class="dolje" style="color:#000;">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
      </div>
      <!-- END row --> 
      
    </div>
    <!-- END .GRID FLEX --> 
    
  </div>
  <!-- END #section-door --> 
</div>
<!-- END .animsition-overla --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/lightgallery-all.min.js"></script>
<script type="text/javascript">
var right=$('#mainleft').height();
var left=$('#contsuperviseur').height();
if(left>right)
{
    $('#mainleft').height(left);
}
else
{
    $('#contsuperviseur').height(right);
}
setTimeout(
  function() 
  {
    $('.row').css('overflow', 'visible');
  }, 3000);
$(document).ready(function(){
  
  /*var fdiv = $("#fdiv").height();
  var sdiv = $("#sdiv").height();
  var winh = $(window).height();
  console.log(fdiv);
  console.log(sdiv);
  console.log(winh);
  if(fdiv>sdiv){
    $("#sdiv").height( fdiv );
    $("#fdiv").height( fdiv );
    $('.row').css('height',  fdiv);
    $('body').css('height',  fdiv);
  } else {
    $("#fdiv").height( sdiv );
    $("#sdiv").height( sdiv );
    $('.row').css('height', sdiv);
    $('body').css('height', sdiv);
  }*/
});
</script>
<script type="text/javascript">
window.setTimeout(function(){
  $('.row').css('background', 'white');
}, 2500);
</script> 
<script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
    $('#lightgallery2').lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,		
		speed: 1200
    });
	    $('#gallery-99').lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,		
		speed: 1200
    });
        </script> 
<script src="js/functions.js"></script> 
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
<?php
  } else {
    header("Location: index");
  }
?>
<?php   
  } else {
    header("Location: index");
  }
?>
