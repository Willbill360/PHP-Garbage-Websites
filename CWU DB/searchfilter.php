<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_SESSION['id'])) {
    if(isset($_GET['filter']) AND !empty($_GET['filter'])) {
      $_SESSION['rawfilter'] = htmlspecialchars($_GET['filter']);
    }
    if(isset($_SESSION['rawfilter']) AND $_SESSION['rawfilter'] == "search") {
      $thefilter = "Recherché";
      $fiches = $bdd->query('SELECT * FROM fiches WHERE search = 1 ORDER BY id ASC');
      if(isset($_GET['q']) AND !empty($_GET['q'])) {
         $q = htmlspecialchars($_GET['q']);
         $fiches = $bdd->query('SELECT * FROM fiches WHERE search = 1 AND cid LIKE "%'.$q.'%" ORDER BY id ASC');
         if($fiches->rowCount() == 0) {
            $fiches = $bdd->query('SELECT * FROM fiches WHERE search = 1 AND CONCAT(prenom, nom, cid) LIKE "%'.$q.'%" ORDER BY id ASC');
         }
       }
     } else if(isset($_SESSION['rawfilter']) AND $_SESSION['rawfilter'] == "lost") {
      $thefilter = "Disparu";
      $fiches = $bdd->query('SELECT * FROM fiches WHERE lost = 1 ORDER BY id ASC');
      if(isset($_GET['q']) AND !empty($_GET['q'])) {
         $q = htmlspecialchars($_GET['q']);
         $fiches = $bdd->query('SELECT * FROM fiches WHERE lost = 1 AND cid LIKE "%'.$q.'%" ORDER BY id ASC');
         if($fiches->rowCount() == 0) {
            $fiches = $bdd->query('SELECT * FROM fiches WHERE lost = 1 AND CONCAT(prenom, nom, cid) LIKE "%'.$q.'%" ORDER BY id ASC');
         }
       }
     } else if(isset($_SESSION['rawfilter']) AND $_SESSION['rawfilter'] == "dead") {
      $thefilter = "Décédé";
      $fiches = $bdd->query('SELECT * FROM fiches WHERE dead = 1 ORDER BY id ASC');
      if(isset($_GET['q']) AND !empty($_GET['q'])) {
         $q = htmlspecialchars($_GET['q']);
         $fiches = $bdd->query('SELECT * FROM fiches WHERE dead = 1 AND cid LIKE "%'.$q.'%" ORDER BY id ASC');
         if($fiches->rowCount() == 0) {
            $fiches = $bdd->query('SELECT * FROM fiches WHERE dead = 1 AND CONCAT(prenom, nom, cid) LIKE "%'.$q.'%" ORDER BY id ASC');
         }
       }
     } else if(isset($_SESSION['rawfilter']) AND $_SESSION['rawfilter'] == "all") {
      $thefilter = "Tout";
      $fiches = $bdd->query('SELECT * FROM fiches ORDER BY id ASC');
      if(isset($_GET['q']) AND !empty($_GET['q'])) {
         $q = htmlspecialchars($_GET['q']);
         $fiches = $bdd->query('SELECT * FROM fiches WHERE cid LIKE "%'.$q.'%" ORDER BY id ASC');
         if($fiches->rowCount() == 0) {
            $fiches = $bdd->query('SELECT * FROM fiches WHERE CONCAT(prenom, nom, cid) LIKE "%'.$q.'%" ORDER BY id ASC');
         }
       }
     }
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['DASH_SEARCH'] ?> - Data Base CWU</title>
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
  <div class="backimg" id="section-7">
    <div class="bghover7 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".1s">
      <div class="grid flex">
        <div class="row paddtop5">
        <form method="GET" action="">
          <div align="center" class="box">
            <div class="container-4">
              <input type="text" id="q" name="q" placeholder="<?= $lang['SEARCH_BAR'] ?>" value="<?php if(isset($q)){echo $q;} ?>"/>
              <button class="iconsearch"><i class="fa fa-search"></i></button>
            </div>
            <p> *Attention: Entrez un CID, un prénom ou un nom, mais pas un nom complet. </p>
            <a href="search"><?= $lang['RETURN'] ?></a>
           </div>
        </form>
        <?php if($fiches->rowCount() > 0) { ?>
        <div class="grid flex16">
          <div class="row paddtop5">
            <?php while($dossier = $fiches->fetch()) { ?>
            <div class="col_3 beta boxwsha font90 column2 <?php if($fiches->rowCount() <= 8) { echo 'wow'; } ?> fadeInUpBig" data-wow-duration="1s" data-wow-delay=".3s" style="z-index: 2;visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUpBig; height: 515px;">
              <h4><?= $dossier['prenom'] ?> <?= $dossier['nom'] ?></h4>
              <h5>CID: <?= $dossier['cid'] ?></h5>
              <div style="margin-bottom: 130px;">
              <?php $count = 0; if($dossier['search'] == 1 or $dossier['panti'] >= 50) { $count = $count + 1;?>
                    <div class="imgWrap" style="z-index: 3;">
                      <img align="left" src="img/search.png" style="position:absolute;left: 5%;" />
                      <p class="imgDescription" style="margin-bottom: 50px;">La PC recherche activement ce citoyen</p>
                    </div>
                  <?php } ?>
                  <?php if($dossier['lost'] == 1) { $count = $count + 1;?>
                    <div class="imgWrap" style="z-index: 2;">
                      <img align="left" src="img/lost.png" style="position:absolute;left: 5%;<?php if($dossier['search'] == 1 or $dossier['panti'] >= 50) { echo "margin-left:100px;"; } ?>" />
                      <p class="imgDescription" style="margin-bottom: 50px;">Ce citoyen est disparu</p>
                    </div>
                  <?php } ?>
                  <?php if($dossier['dead'] == 1) { ?>
                    <div class="imgWrap">
                      <img align="left" src="img/dead.png" alt="Mort" title="Mort" style="position:absolute;left: 5%;<?php if($count == 1) { echo "margin-left:100px;"; } else if($count == 2) {echo "margin-left:200px";} ?>" />
                      <p class="imgDescription" style="margin-bottom: 50px;">Ce citoyen est décédé</p>
                    </div>
                  <?php } ?>
                  <?php if($count == 0) { echo "Le citoyen n'a rien a se reproché de grave.";} ?>
              </div>
              <a href="fiche?id=<?= $dossier['id'] ?>" style="z-index: 1;" class="btn-seefile"><?= $lang['SEARCH_SEEFILE'] ?></a>
            </div>
            <!-- END col_3 -->
             <?php } ?>
          
        </div>
        <!-- END col_3 --> 
        
      </div>
      <!-- END row -->
      <?php } else { ?>
            <p align="center">Aucun résultat <?php if(isset($q)) { ?> pour: <?= $q ?><?php } ?> dans le filtre <?= $thefilter ?></p>
          <?php } ?>
        
        <!-- END row --> 
      </div>
      <!-- END .GRID FLEX --> 
    </div>
    <!-- END bghover --> 
  </div>
  <!-- END #section-3 -->
        
  <p class="dolje" style="color:#000;z-index: 0;bottom: -32px;">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
</div>
<!-- END row --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/animsition.min.js"></script> 
<script src="js/lightgallery-all.min.js"></script> 
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
