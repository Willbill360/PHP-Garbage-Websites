<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

?>
<?php
  if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
    $name = preg_split("[\s]",$userinfo['nom']);
    $nameCount = count($name);
    $reqnom = $bdd->prepare("SELECT * FROM fiches WHERE prenom = ? AND nom = ?");
    $reqnom->execute(array($name[0], $name[1]));
    $nomexist = $reqnom->rowCount();
    if($nomexist == 1) {
      $requser = $bdd->prepare('SELECT * FROM fiches WHERE prenom = ? AND nom = ?');
      $requser->execute(array($name[0], $name[1]));
      $ficheinfo = $requser->fetch();
    }
    $fichiermdp = fopen('specialmdp.txt', 'r+');
    $specialmdp = fgets($fichiermdp);
    fclose($fichiermdp);

    $msgimp = $bdd->query('SELECT * FROM msgimp WHERE id = 1');
    $msgimp = $msgimp->fetch();

    if(isset($_POST['save'])) {
      if(!empty($_POST['tcontenu'])) {
        $cont = htmlspecialchars($_POST['tcontenu']);
        $ins = $bdd->prepare('UPDATE msgimp SET contenu = ? WHERE id = 1');
        $ins->execute(array($cont));
        header('Location: tableau-de-bord?id='.$_SESSION['id']);
      } else {
        $cont = "Il n'y a rien d'important.";
        $ins = $bdd->prepare('UPDATE msgimp SET contenu = ? WHERE id = 1');
        $ins->execute(array($cont));
        header('Location: tableau-de-bord?id='.$_SESSION['id']);
      }
    }

    require_once('API/JBBcode/Parser.php');
    $parser = new JBBCode\Parser();
    $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
    $parser->addBBCode("quote", '<blockquote>{param}</blockquote>');
    $parser->addBBCode("code", '<pre class="code">{param}</pre>', false, false, 1);
    $parser->addBBCode("s", '<strike>{param}</strike>');
    $parser->addBBCode("sup", '<sup>{param}</sup>');
    $parser->addBBCode("sub", '<sub>{param}</sub>');
    $parser->addBBCode("list", '<ul>{param}</ul>');
    $parser->addBBCode("list2", '<ol>{param}</ol>');
    $parser->addBBCode("*", '<li>{param}</li>');
    $parser->addBBCode("xsmall", '<font size="2">{param}</font>');
    $parser->addBBCode("small", '<font size="3">{param}</font>');
    $parser->addBBCode("normal", '<font size="4">{param}</font>');
    $parser->addBBCode("large", '<font size="5">{param}</font>');
    $parser->addBBCode("xlarge", '<font size="6">{param}</font>');
    $parser->addBBCode("left", '<p style="text-align:left">{param}</p>');
    $parser->addBBCode("center", '<p style="text-align:center">{param}</p>');
    $parser->addBBCode("right", '<p style="text-align:right">{param}</p>');
    $parser->addBBCode("table", '<table>{param}</table>');
    $parser->addBBCode("tr", '<tr>{param}</tr>');
    $parser->addBBCode("td", '<td>{param}</td>');
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['DASH_TITLE'] ?> - Data Base CWU</title>
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
<link rel="stylesheet" href="css/wbbtheme.css" />
<link href="css/lightgallery.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.scrollex.min.js"></script>
<script src="js/jquery.scrolly.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery.wysibb.js"></script>
<script src="js/jquery.wysibb.fr.js"></script>
<script>
   $(function() {
     var optionsWbb = {
      lang: "fr"
     }
     $("#wysibb2").wysibb(optionsWbb);
   })
</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
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
          <div class="colw_12 alomdebe white padd5555 hei100 wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s">
            <h2><?= $lang['DASH_WELCOME'] ?> <?= $userinfo['nom'] ?></h2>
            <div class="paddtop105">
              <div class="mainleft">
                <div class="right" style="float:right;width:50%;">
                  <?php if($nomexist == 1) { ?>
                    <?php if($userinfo['grade'] != "mpf") { ?>
                      <br/>
                      <br/>
                      <p><?= $lang['DASH_BEFORE_ADD_DINSC'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                       <p><?= $lang['DASH_BEFORE_SEARCH'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <p><?= $lang['DASH_BEFORE_LOGOUT'] ?></p>
                      <?php } ?>
                    <!-- <img src="img/<?php if($ficheinfo['ployaute'] <= 19) {echo 'citoyen';} 
                    else if($ficheinfo['ployaute'] >= 20 AND $ficheinfo['ployaute'] <= 39) {echo 'loyaliste';} 
                    else if($ficheinfo['ployaute'] >= 40) {echo 'cwu';}?>.jpg" /> -->
                    <?php } else { ?>
                      <p><?= $lang['DASH_BEFORE'] ?></p>
                      <?php if($userinfo['grade'] != "mpf") { ?>
                      <p><?= $lang['DASH_BEFORE_ADD'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <?php } ?>
                      <p><?= $lang['DASH_BEFORE_SEARCH'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <p><?= $lang['DASH_BEFORE_LOGOUT'] ?></p>
                    <?php } ?>
                </div>
                <?php if($userinfo['grade'] != "mpf") { ?>
                <div align="center" class="btn-box">
                  <a href="add" class="img-btn animsition-link">
                    <img align="center" src="img/man-plus.png" style="" class="btn-img" />
                    <p><?= $lang['DASH_ADD'] ?></p>
                  </a>
                </div>
                <?php } ?>
                <div align="center" class="btn-box">
                  <a href="search" class="img-btn animsition-link">
                    <img align="center" src="img/man-search.png" style="" class="btn-img" />
                    <p><?= $lang['DASH_SEARCH'] ?></p>
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
        <div class="colw_6 alomdebe">
          <div class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s">
            <img align="right" src="img/cwu-logo-black.png" style="" class="cwu-logo" />
            <div class="paddtop105">
                <h4>Message Important</h4>
                <p style="width: 100%;height: 500px;overflow-y: auto;" class="msg1"><?php $parser->parse($msgimp['contenu']); echo $parser->getAsHtml(); ?></p>
                <?php if($userinfo['grade'] == "adm") { ?>
                <div class="msg2">
                  <form method="POST">
                    <textarea id="wysibb2" placeholder="Contenu" name="tcontenu"></textarea>
                    <input type="submit" name="save" value="Sauvegarder" style="cursor:pointer;float:right;" class="save"></input>
                  </form>
                </div>
                <a style="cursor:pointer;" class="edit">Modifier</a>
                <a style="cursor:pointer;" class="cancel">Annuler</a>
                <?php } ?>
                <h5 style="position: absolute;right: 20px;bottom: 5px;z-index: 1;">Code d'accès spécial: <?= $specialmdp ?></h5>
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
<script type="text/javascript">
window.setTimeout(function(){
  $('.row').css('background', 'white');
}, 2500);
</script> 
<?php if($userinfo['grade'] == "adm") { ?>
<script type="text/javascript">
$(document).ready(function(){ 
  $('a.save').hide();
  $('a.cancel').hide();
  $('.msg2').hide();
});
$('a.edit').click(function(){
  $('a.edit').hide();
  $('a.save').show();
  $('a.cancel').show();
  $('.msg1').hide();
  $('.msg2').show();
});
$('a.cancel').click(function(){
  $('a.edit').show();
  $('a.save').hide();
  $('a.cancel').hide();
  $('.msg1').show();
  $('.msg2').hide();
});
</script>
<?php } ?>
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
