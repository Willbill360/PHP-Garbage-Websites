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
  if(isset($_SESSION['id'])) {

    $name = preg_split("[\s]",$userinfo['nom']);
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['FILE_ADMIN_TITLE'] ?> - Data Base CWU</title>
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
          <div class="colw_12 alomdebe white padd5555 hei100 wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s">
            <h2><?= $lang['FILE_ADMIN_OF'] ?> <?php echo $userinfo['nom']; ?></h2>
            <div class="paddtop105">
              <div class="mainleft">
                <table>
                  <input type="hidden" class="serverSession" data-value="<?= $_SESSION['serveur'] ?>" />
                  <tbody>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['ADD_ADMIN_PSEUDO'] ?></h5></td>
                      <td class="cid1"><h5><?php echo $userinfo['pseudo']; ?></h5></td>
                      <td class="cid2"><h5><input type="text" class="cid" maxlength="255" style="width:100%;" value="<?php echo $userinfo['pseudo']; ?>"/></h5><h5 class="ciderror"><div align="center" class="ciderrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_FULLNAME'] ?></h5></td>
                      <td class="nom1"><h5><?php echo $userinfo['nom']; ?></h5></td>
                      <td class="nom2"><h5><input type="text" class="prenom" placeholder="John" maxlength="255" style="float: left;border-right: 1px solid #000;" value="<?php echo $name[0]; ?>"> <input type="text" placeholder="Doe" maxlength="255" class="nom" style="border-left: 1px solid #000;" value="<?php echo $name[1]; ?>"></h5><h5 class="nomerror"><div align="center" class="nomerrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['ADD_ADMIN_MDP'] ?></h5></td>
                      <td class="ployaute1"><h5><?= $lang['FILE_ADMIN_MDP_2'] ?></h5></td>
                      <td class="ployaute2"><h5><input type="text" class="ployaute" style="width:100%;" /></h5><h5 class="ployauteerror"><div align="center" class="ployauteerrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                  </tbody>
                </table>
                <div align="center" style="width:50%;float:right;" class="contbtn">
                  <div align="center" class="btn-box" style="float:left;">
                    <a href="search-admin" class="img-btn return animsition-link">
                      <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
                      <p><?= $lang['RETURN'] ?></p>
                    </a>
                    <a class="img-btn cancel">
                      <img align="center" src="img/cancel.png" style="" class="btn-img" />
                      <p><?= $lang['CANCEL'] ?></p>
                    </a>
                  </div>
                  <div align="center" class="btn-box delete" style="float:right;">
                    <a class="img-btn delete">
                      <img align="center" src="img/delete.png" onclick="delbox()" class="btn-img" />
                      <p><?= $lang['DEL'] ?></p>
                    </a>
                  </div>
                  <div align="center" class="btn-box" style="float:right;">
                    <a class="img-btn edit">
                      <img align="center" src="img/edit.png" style="" class="btn-img" />
                      <p><?= $lang['MODIFY'] ?></p>
                    </a>
                    <a class="img-btn save">
                      <img align="center" src="img/save.png" style="" class="btn-img" />
                      <p><?= $lang['SAVE'] ?></p>
                    </a>
                  </div>
                  <p id="demo"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Left -->
        <!-- START Right -->
        <div class="colw_6 alomdebe">
          <div class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s">
            <img align="right" src="img/cwu-logo-black-admin.png" style="" class="cwu-logo" />
              
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
<?php

  $error_file_1 = $lang['FILE_ADMIN_ERR_1'];
  echo "var err_file_1 = '{$error_file_1}';";
  $error_file_2 = $lang['FILE_ADMIN_ERR_2'];
  echo "var err_file_2 = '{$error_file_2}';";
  $error_file_3 = $lang['FILE_ADMIN_ERR_3'];
  echo "var err_file_3 = '{$error_file_3}';";
  $error_file_4 = $lang['FILE_ERR_4'];
  echo "var err_file_4 = '{$error_file_4}';";
  $delete_msg = $lang['FILE_ADMIN_DELMSG'];
  echo "var del_msg = '{$delete_msg}';";

?>
function delbox(){
  var r = confirm(del_msg);
  if (r == true) {
      x = "delete";
      $.ajax({ url: 'fichesave.php',
        data: {id: <?= $userinfo['id'] ?>, admin: 'true', action: x},
        type: 'POST',
        success: function(output) {
          if(output == 'deleted') {
            window.location.href = "search-admin";
          }
        }
      });
  }
}
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
    $('a.save').hide();
    $('a.cancel').hide();
    $('.cid2').hide();
    $('.nom2').hide();
    $('.ployaute2').hide();
    $('.desc2').hide();
    $('.observ2').hide();
    $('.ciderror').hide();
    $('.nomerror').hide();
    $('.ployauteerror').hide();
    $('.ast').hide();
    $('.delete').hide();
  });
  $('a.edit').click(function(){
    $('a.edit').hide();
    $('a.save').show();
    $('a.return').hide();
    $('a.cancel').show();
    $('.cid1').hide();
    $('.cid2').show();
    $('.nom1').hide();
    $('.nom2').show();
    $('.ployaute1').hide();
    $('.ployaute2').show();
    $('.desc1').hide();
    $('.desc2').show();
    $('.observ1').hide();
    $('.observ2').show();
    $('.ast').show();
    $('.delete').show();
    $('.contbtn').css('width', 'auto');
  });
  $('a.cancel').click(function(){
    $('a.edit').show();
    $('a.save').hide();
    $('a.return').show();
    $('a.cancel').hide();
    $('.cid1').show();
    $('.cid2').hide();
    $('.nom1').show();
    $('.nom2').hide();
    $('.ployaute1').show();
    $('.ployaute2').hide();
    $('.desc1').show();
    $('.desc2').hide();
    $('.observ1').show();
    $('.observ2').hide();
    $('.ast').hide();
    $('.delete').hide();
    $('.contbtn').css('width', '50%');
  });
  $('a.save').click(function(){
      var pseudo = $('input.cid').val();
      var prenom = $('input.prenom').val();
      var nom = $('input.nom').val();
      var mdp = $('input.ployaute').val();
      var serveur = $(".serverSession").data('value');
      $.ajax({ url: 'fichesave.php',
        data: {id: <?= $userinfo['id'] ?>, admin: 'true', pseudo: pseudo, prenom: prenom, nom: nom, mdp: mdp, serveur: serveur},
        type: 'POST',
        success: function(output) {
          if(output == err_file_1 || output == err_file_2) {
            $(".ciderrortxt").html(output);
            $('.ciderror').show();
          } else if (output == err_file_3 || output == err_file_4) {
            $(".nomerrortxt").html(output);
            $('.nomerror').show();
          } else if (output == err_file_5) {
            $(".ployauteerrortxt").html(output);
            $('.ployauteerror').show();
          } else {
            location.reload(true);
          }
        }
      });
      //location.reload(true); 
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
