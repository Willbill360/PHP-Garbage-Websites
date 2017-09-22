<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

?>
<?php
  if(isset($_SESSION['id']) AND $_SESSION['id'] == 53) {
    if(isset($_SESSION['mrest'])) {
      if($_SESSION['mrest'] <= 0) {
        session_destroy();
        header('Location: index');
      }
    } else { 
      $_SESSION['mrest'] = 3;
    }
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hacking - Data Base CWU</title>
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
  <div class="backimg" id="section-door" style="background: #000;">
  <div style="color:red;"></div>
    <div class="grid flex">
      <div class="row">
      <div class="padd5555" style="width: 50%">
      <p style="color:#d3d3d3;">Légende:<br/><span style="color:#41ba5d;">Vert = Ajouter</span><br/><span style="color:#dd5a49;">Rouge = Retirer</span><br/>Utilisé le racourci «CTRL-F» pour trouver un citoyen<br/><br/><br/></p>
      <?php 
        $requser = $bdd->query("SELECT * FROM fiches ORDER BY id");
        $count = 0;
        while($userinfo = $requser->fetch()) {
          $count = $count + 1;
      ?>
      <p style="color:#d3d3d3;">Nom: <?= $userinfo['prenom'] ?> <?= $userinfo['nom'] ?><br/>
      CID:<?= $userinfo['cid'] ?><br/>
      Point de Loyauté: <?= $userinfo['ployaute'] ?><br/>
      Point d'Anti-Citoyeneté: <?= $userinfo['panti'] ?><?php if($userinfo['panti'] > 0) { ?><a href="hackedmodif?act=panti&type=rem&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Remettre à zéro <span style="color:#dd5a49;">(-)</span></a><?php } ?><br/>
      Status: <?php $searched = 0;$losted = 0;$deaded = 0; if($userinfo['dead'] == 1 AND $userinfo['search'] == 0 AND $userinfo['lost'] == 0) { echo "Décédé"; } 
      else if($userinfo['search'] == 1 AND $userinfo['dead'] == 0 AND $userinfo['lost'] == 0) { echo "Recherché"; $searched = 1; }
      else if($userinfo['lost'] == 1 AND $userinfo['search'] == 0 AND $userinfo['dead'] == 0) { echo "Disparu"; $losted = 1; }
      else if($userinfo['dead'] == 1 AND $userinfo['search'] == 1 AND $userinfo['lost'] == 0) { echo "Décédé, Recherché"; $searched = 1; $deaded = 1; }
      else if($userinfo['dead'] == 1 AND $userinfo['lost'] == 1 AND $userinfo['search'] == 0) { echo "Décédé, Disparu"; $losted = 1; $deaded = 1; }
      else if($userinfo['search'] == 1 AND $userinfo['lost'] == 1 AND $userinfo['dead'] == 0) { echo "Recherché, Disparu"; $searched = 1; $losted = 1;}
      else if($userinfo['dead'] == 1 AND $userinfo['search'] == 1 AND $userinfo['lost'] == 1) { echo "Décédé, Recherché, Disparu"; $searched = 1; $losted = 1; $deaded = 1; }
      else { echo "En vie et aucun problème avec la PC";}
       ?>
      <?php if($searched == 1) { ?>
        <a href="hackedmodif?act=search&type=rem&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Recherché <span style="color:#dd5a49;">(-)</span></a>
      <?php } else { ?>
        <a href="hackedmodif?act=search&type=add&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Recherché <span style="color:#41ba5d;">(+)</span></a>
      <?php } ?>
      <?php if($losted == 1) { ?>
        <a href="hackedmodif?act=lost&type=rem&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Disparu <span style="color:#dd5a49;">(-)</span></a>
      <?php } else { ?>
        <a href="hackedmodif?act=lost&type=add&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Disparu <span style="color:#41ba5d;">(+)</span></a>
      <?php } ?>
      <?php if($deaded == 1) { ?>
        <a href="hackedmodif?act=dead&type=rem&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Décédé <span style="color:#dd5a49;">(-)</span></a>
      <?php } else { ?>
        <a href="hackedmodif?act=dead&type=add&id=<?=$userinfo['cid']?>" style="margin-left:15px;font-size:11px;vertical-align:top;overflow:auto;">Décédé <span style="color:#41ba5d;">(+)</span></a>
      <?php } ?>
      </p>
      <br/>
      <br/>
      <?php } ?>
      <div style="position:fixed;right:10px;bottom:5px;z-index:1;width:25%;height:100px;border:2px solid red;">
        <p align="center" style="color:#d3d3d3;">Modification restante: <?= $_SESSION['mrest'] ?></p>
        <div align="center"><p style="color:#d3d3d3;">Il vous reste <span style="color:red;" id="time"></span> secondes pour faire votre prochaine modif !</p></div>
      </div>
        <p class="dolje" id="cpright">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
        </div>
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

  function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 1,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
window.setTimeout(function(){
        var red = 0;
        //Move to a new location or you can do something else
        //window.location.href = "hackedsearch";
        function bg() {
          if (red === 1) {
            $('.row').css('background-color', '#000');
            red = 0;
          } else {
            $('.row').css('background-color', 'rgba(255, 0, 0, 0.65)');
            red = 1;
          }
        };
        window.setInterval(function(){
          bg();
        }, 500);
    }, 55000);
window.setTimeout(function(){
  window.location.href = "index";
}, 61000);
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
