<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_SESSION['id'])) {
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['SEARCH_ADMIN_TITLE'] ?> - Data Base CWU</title>
<meta property="og:url" content="http://mcgesp.ca" />
<meta property="og:type" content="website" />
<meta property="og:title" content="GEPS - Réseau multigaming" />
<meta property="og:description" content="Réseau multigaming | Hébergement | Conception" />
<meta property="og:image" content="http://mcgeps.ca/modpack/logo.png" />
<meta name="category" content="games">
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
<link rel="stylesheet" href="css/banner.css">
<link rel="stylesheet" href="css/you-video.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
<div class="animsition-overlay">
  <div id="languages">
      <a href="?lang=en"><img src="img/en.png"></a>
      <a href="?lang=fr"><img src="img/fr.png"></a>
    </div>
  <div class="grid flex16">
    <div class="row paddtop5">
      <div class="beta wow column zoomIn" style="margin-top: 20%;">
        <form method="GET" action="">
          <div align="center" class="box">
            <div class="container-4">
              <input type="text" id="q" name="q" placeholder="<?= $lang['SEARCH_BAR'] ?>" onkeyup="recupvaleur(this.value)" value="<?php if(isset($q)){echo $q;} ?>"/>
              <button class="iconsearch"><i class="fa fa-search"></i></button>
            </div>
           </div>
        </form>
          <?php
            if(isset($_GET['q']) AND !empty($_GET['q'])) {
              $q = htmlspecialchars($_GET['q']);
              $name = preg_split("[\s]",$q);
              $nameCount = count($name);
                if($nameCount == 2) {
                  $requser = $bdd->query("SELECT * FROM membres WHERE nom = '".$q."' AND serveur = '".$_SESSION['serveur']."'"); //"SELECT * FROM fiches WHERE prenom = '".$q."'"
                  $userexist = $requser->rowCount();
                  if($userexist == 1){
                    $userinfo = $requser->fetch();
                    header('Location: fiche-admin?id='.$userinfo['id']);
                  } else if($userexist >= 2) { ?>
                    <div align="center" style="margin-top:50px;"><p style="color:red;"><?= $lang['SEARCH_ERR_2_1'] ?> <?= $userexist ?> <?= $lang['SEARCH_ADMIN_ERR_2_2'] ?> <?= $q ?><?= $lang['SEARCH_ERR_2_3'] ?></p></div>
                  <?php } else { ?>
                    <div align="center" style="margin-top:50px;"><p style="color:red;"><?= $lang['SEARCH_ADMIN_ERR_3'] ?> <?= $q ?> <a href="add-admin?prenom=<?= $name[0] ?>&nom=<?= $name[1] ?>"><?= $lang['SEARCH_ERR_1_2'] ?></a></p></div>
                 <?php }
               } else if($nameCount == 1) {
                  $requser = $bdd->query("SELECT * FROM membres WHERE pseudo = '".$q."' AND serveur = '".$_SESSION['serveur']."'"); //"SELECT * FROM fiches WHERE prenom = '".$q."'"
                  $userexist = $requser->rowCount();
                  if($userexist == 1){
                    $userinfo = $requser->fetch();
                    header('Location: fiche-admin?id='.$userinfo['id']);
                  } else { ?>
                    <div align="center" style="margin-top:50px;"><p style="color:red;"><?= $lang['SEARCH_ADMIN_ERR_2'] ?> <?= $q ?> <a href="add-admin?pseudo=<?= $q ?>"><?= $lang['SEARCH_ERR_1_2'] ?></a></p></div>
                 <?php }
                } else { ?>
                  <div align="center" style="margin-top:50px;"><p style="color:red;"><?= $lang['SEARCH_ADMIN_ERR_1']?></p></div>
               <?php }
              
            }
          ?>
          <div align="center" class="btn-box" style="margin:30px auto;">
            <a href="admin?id=<?= $_SESSION['id'] ?>" class="img-btn return animsition-link">
              <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
              <p><?= $lang['RETURN']?></p>
            </a>    
          </div>
      </div>
    </div>
  <!-- End GRID --> 
  </div>
</div>
<p class="dolje" style="color:#000;">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
<!-- END .animsition-overlaj --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/animsition.min.js"></script> 
<script>
$(".enticlick").click(function() {
  window.location = $(this).find("a").attr("href"); 
  return false;
});
</script> 
<script src="js/functions.js"></script> 
<script src="js/you-video.js"></script> 
<script type="text/javascript">
function recupvaleur(valeurChamp) {
  if(isNaN(valeurChamp) == true)
{
  //alert('valeurChamp n\'est pas un nombre');
  $("#q").attr('maxlength','255');
}
else
{
  //alert('valeurChamp est un nombre');
  $("#q").attr('maxlength','5');
}
}
</script>
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