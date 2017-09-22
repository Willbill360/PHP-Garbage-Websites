<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_SESSION['id'])) {

$showfiche = 0;
if(isset($_GET['prenom'], $_GET['nom']) AND !empty($_GET['prenom']) AND !empty($_GET['nom'])) {
  $prenom = htmlspecialchars($_GET['prenom']);
  $nom = htmlspecialchars($_GET['nom']);
}
if(isset($_GET['pseudo']) AND !empty($_GET['pseudo'])) {
  $pseudo = htmlspecialchars($_GET['pseudo']);
}

if(isset($_POST['formadd']))
{

  $nom = htmlspecialchars(ucfirst(strtolower($_POST['nom'])));
  $prenom = htmlspecialchars(ucfirst(strtolower($_POST['prenom'])));
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $unhashedmdp = htmlspecialchars($_POST['mdp']);
  $mdp = sha1($unhashedmdp);
  $nomlength = strlen($nom);
  $prenomlength = strlen($prenom);
  $pseudolength = strlen($pseudo);
  $fullname = $prenom.' '.$nom;

  if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mdp']))
  {
    
    if($nomlength <= 255 AND $prenomlength <= 255 AND $pseudolength <= 255)
    {   
      $reqnom = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND serveur = ?");
      $reqnom->execute(array($fullname, $_SESSION['serveur']));
      $nomexist = $reqnom->rowCount();
      if($nomexist == 0) {
        $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND serveur = ?");
        $reqpseudo->execute(array($pseudo, $_SESSION['serveur']));
        $pseudoexist = $reqpseudo->rowCount();
        if($pseudoexist == 0) {
          
            $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, nom, motdepasse, serveur) VALUES(?, ?, ?, ?)");
            $insertmbr->execute(array($pseudo, $fullname, $mdp, $_SESSION['serveur']));
            $erreur = "<span style=\"color:green;\" >".$lang['ADD_ADMIN_ERR_1_1']." </span><a class=\"animsition-link\" style=\"text-decoration: none;\" href=\"admin?id=".$_SESSION['id']."\">".$lang['ADD_ERR_1_2']."</a>";
            $showfiche = 1;
          
        } 
        else
        {
          $erreur = $lang['ADD_ADMIN_ERR_2'];
        }
      } 
      else
      {
        $erreur = $lang['ADD_ADMIN_ERR_3'];
      }
    }
    else
    {
      $erreur = $lang['ADD_ADMIN_ERR_4'];
    }
  }
  else 
  {
    $erreur = $lang['ADD_ADMIN_ERR_5'];
  }
}


?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['ADMIN_ADD'] ?> - Data Base CWU</title>
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
      <div class="row">
        <!-- START Left -->
        <div class="colw_6 alomdebe">
          <div class="colw_12 alomdebe white padd5555 wow hei100 fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s">
            <h2><?= $lang['ADMIN_ADD'] ?></h2>
            <div class="paddtop105">
              <div class="mainleft">
                <form method="post" action="">
                  <div class="label-home"><?= $lang['ADD_FNAME'] ?>: </div>
                  <input type="text" name="prenom" id="prenom" maxlength="255" value="<?php if(isset($prenom)){echo $prenom;} ?>" />
                  <div class="spacer"></div>
                  <div class="label-home"><?= $lang['ADD_LNAME'] ?>: </div>
                  <input type="text" name="nom" id="nom" maxlength="255" value="<?php if(isset($nom)){echo $nom;} ?>" />
                  <div class="spacer"></div>
                  <div class="label-home"><?= $lang['ADD_ADMIN_PSEUDO'] ?>: </div>
                  <input type="text" name="pseudo" id="pseudo" maxlength="255" value="<?php if(isset($pseudo)){echo $pseudo;} ?>" />
                  <div class="spacer"></div>
                  <div class="label-home"><?= $lang['ADD_ADMIN_MDP'] ?>: </div>
                  <input type="text" name="mdp" id="mdp" maxlength="255" autocomplete="off" value="<?php if(isset($unhashedmdp)){echo $unhashedmdp;} ?>" />
                  <div class="spacer"></div>
                  <div align="center" style="width:50%;margin:0 25%;">
                  <div align="center" class="btn-box" style="float:left;">
                    <a href="admin?id=<?= $_SESSION['id'] ?>" class="img-btn animsition-link">
                      <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
                      <p><?= $lang['RETURN'] ?></p>
                    </a>
                  </div>
                  <div align="center" class="btn-box" style="float:right;">
                    <input name="formadd" type="submit" class="img-btn" value="<?= $lang['SAVE'] ?>">
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- END Left -->
        <!-- START Right -->
        <div class="colw_6 alomdebe">
          <div <?php if($showfiche == 1) {echo "style=\"border-left:1px solid #000;\"";} ?> class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight errside" data-wow-duration="2s" data-wow-delay=".5s">
            <img align="right" src="img/cwu-logo-black-admin.png" style="" class="cwu-logo" />
            <?php if($showfiche == 1) { ?>
            <h2 style="margin-top:-50px;"><?= $lang['ADD_ADMIN_GENERATE'] ?></h2>
            <div class="paddtop105">
            <div class="mainright">
              <table class="table-wrapper">
                  <tbody>
                    <tr>
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_FULLNAME'] ?></h5></td>
                      <td><h5><?php echo $prenom; ?> <?php echo $nom; ?></h5></td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top;"><h5><?= $lang['ADD_ADMIN_PSEUDO'] ?></h5></td>
                      <td><h5><?php echo $pseudo; ?></h5></td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top;"><h5><?= $lang['ADD_ADMIN_MDP'] ?></h5></td>
                      <td><h5><?php echo $unhashedmdp; ?></h5></td>
                    </tr>
                  </tbody>
                </table>
                <?php } ?>
                 <?php
                    if(isset($erreur))
                    {
                      if($showfiche == 1) {$marginTop = '30px';} else {$marginTop = '40%';}
                      echo '<div align="center" style="color:red;margin-top:'.$marginTop.';">'.$erreur.'</div>';
                    }
                  ?>
            </div>
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
setTimeout(
  function() 
  {
    $('.row').css('overflow', 'visible');
  }, 3000);
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
        <script type="text/javascript">
window.setTimeout(function(){
  $('.row').css('background', 'white');
}, 2500);
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
