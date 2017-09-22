<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

$str = 'pseudo=aw&mail=wilgagnon@yahoo.com&mdp=Papapa28&serv=awa&time=3&price=24&date=2016-08-11&exp=2016-11-11';
$expstr = explode('&', $str);
foreach ($expstr as $element => $info) {
  $eplodedexp[$element] = explode('=', $info);
}
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acheter l'acces a la data base - Data Base CWU</title>
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
      <div class="beta wow column zoomIn" style="margin-top: 5%;">
        <div align="center">
          <h5 id="timeh5"><input name="time" id="time" type="text" required="true" style="color:#000;border: 2px solid #000;float:none;width:25%;" placeholder="Nombre de mois (Ex: 3)"/> X 2€/Mois<br/>20% rabais à partir de 3 mois, 30% à partir de 6 mois, 35% à partir de 12mois</h5><h5 class="moiserror"><div align="center" class="moiserrortxt" style="color:red;">erreur</div></h5>
          <h5 id="pseudoh5"><input name="pseudo" id="pseudo" type="text" style="color:#000;border: 2px solid #000;float:none;width:25%;" placeholder="Votre pseudo"/></h5><h5 class="pseudoerror"><div align="center" class="pseudoerrortxt" style="color:red;">erreur</div></h5>
          <h5 id="mailh5"><input name="email" id="mail" type="text" style="color:#000;border: 2px solid #000;float:none;width:25%;" placeholder="Votre email"/></h5><h5 class="mailerror"><div align="center" class="mailerrortxt" style="color:red;">erreur</div></h5>
          <h5 id="mdph5"><input name="mdp" id="mdp" type="password" style="color:#000;border: 2px solid #000;float:none;width:25%;" placeholder="Votre mot de passe"/></h5><h5 class="mdperror"><div align="center" class="mdperrortxt" style="color:red;">erreur</div></h5>
          <h5 id="serveurh5"><input name="serveur" id="serveur" type="text" style="color:#000;border: 2px solid #000;float:none;width:25%;" placeholder="Votre serveur"/></h5><h5 class="serveurerror"><div align="center" class="serveurerrortxt" style="color:red;">erreur</div></h5>
          <h5 class="recap">Récapitulatif de la commande</h5>
          <table class="recap" style="width:50%;">
            <tbody>
              <tr>
                <td style="vertical-align:top;"><h5>Pseudo</h5></td>
                <td><h5 class="pseudo2">XXXX</h5></td>
              </tr>
              <tr>
                <td style="vertical-align:top;"><h5>Email</h5></td>
                <td><h5 class="email2">XXXX</h5></td>
              </tr>
              <tr>
                <td style="vertical-align:top;"><h5>Mot de passe</h5></td>
                <td><h5 class="mdp2">XXXX</h5></td>
              </tr>
               <tr>
                <td style="vertical-align:top;"><h5>Nom du serveur</h5></td>
                <td><h5 class="servname">XXXX</h5></td>
              </tr>
               <tr>
                <td style="vertical-align:top;"><h5>Prix</h5></td>
                <td><h5 class="price">XXXX</h5></td>
              </tr>
              
            </tbody>
          </table>
        </div>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="POST">
          <input name="amount" id="amount" type="hidden" value="100" />
          <input name="currency_code" type="hidden" value="EUR" />
          <input name="shipping" type="hidden" value="0.00" />
          <input name="tax" type="hidden" value="0.00" />
          <input name="return" type="hidden" value="htt://cwu.esy.es/sucess" />
          <input name="cancel_return" type="hidden" value="http://cwu.esy.es/" />
          <input name="notify_url" type="hidden" value="http://cwu.esy.es/paypal-ipn.php" />
          <input name="cmd" type="hidden" value="_xclick" />
          <input name="business" type="hidden" value="contact@cwu.esy.es" />
          <input name="item_name" type="hidden" value="Data Base CWU" />
          <input name="no_note" type="hidden" value="1" />
          <input name="lc" type="hidden" value="FR" />
          <input name="bn" type="hidden" value="PP-BuyNowBF" />
          <input name="custom" id="custom" type="hidden" value="XXXX" />
          <div style="width:25%;margin:auto;">
            <div align="center" class="checkout" style="float:right;">
              <input type="submit" value="Acheter l'accès" class="btn primary img-btn">
            </div>
            <div align="center" class="btn-box return" style="margin:30px auto;float:left;">
              <a href="index" class="img-btn return animsition-link">
                <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
                <p><?= $lang['RETURN']?></p>
              </a>    
            </div>
            <div align="center" class="btn-box return2" style="margin:30px auto;float:left;">
              <a onclick="lastpage()" class="img-btn return2">
                <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
                <p><?= $lang['RETURN']?></p>
              </a>    
            </div>
            <div align="center" class="btn-box continue" style="margin:30px auto;float:right;">
              <a onclick="nextpage()" class="img-btn continue">
                <img align="center" src="img/right-arrow.png" style="" class="btn-img" />
                <p>Continuer</p>
              </a>    
            </div>
          </div>
        </form>
      </div>
    </div>
    <h5 class="globerror"><div align="center" class="globerrortxt" style="color:red;">error</div></h5>
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
$('.moiserror').hide();
$('.pseudoerror').hide();
$('.mailerror').hide();
$('.mdperror').hide();
$('.serveurerror').hide();
$('.globerror').hide();
$('.checkout').hide();
$('.return2').hide();
$('.recap').hide();
var date_achat = '';
var date_exp = '';
$('#time').focusout(function() {
  $.ajax({ url: 'check-buy.php',
    data: {month: $('#time').val()},
    type: 'POST',
    success: function(output) {
      var theOutput = output.split(",");
      date_achat = theOutput[0];
      date_exp = theOutput[1];
    }
  });
});

function nextpage() {
  $.ajax({ url: 'check-buy.php',
    data: {pseudo: $('#pseudo').val(), email: $('#mail').val(), mdp: $('#mdp').val(), serveur: $('#serveur').val(), time: $('#time').val()},
    type: 'POST',
    success: function(output) {
      if(output == 'Tous les champs doivent être rempli') {
        $(".globerrortxt").html(output);
        $('.globerror').show();
      } else if (output == 'Ce serveur est déjà inscrit') {
        $(".globerrortxt").html(output);
        $('.globerror').show();
      } else if (output == 'ok') {
        var reduc = 0;
        if ($('#time').val() <= 2) {
          var reduc = 0;
        } else if ($('#time').val() >= 3 && $('#time').val() <= 5) {
          var reduc = $('#time').val()*2*(20/100);
        } else if ($('#time').val() >= 6 && $('#time').val() <= 12) {
          var reduc = $('#time').val()*2*(30/100);
        } else {
          var reduc = $('#time').val()*2*(35/100);
        }
        var amount = $('#time').val()*2-reduc;
        $('#amount').val(amount);
        $('.price').html(amount+'€, Économie: '+reduc+'€');
        $('.servname').html($('#serveur').val());
        $('.pseudo2').html($('#pseudo').val());
        $('.email2').html($('#mail').val());
        $('.mdp2').html($('#mdp').val());
        $('#custom').val('pseudo='+$('#pseudo').val()+'&mail='+$('#mail').val()+'&mdp='+$('#mdp').val()+'&serv='+$('#serveur').val()+'&time='+$('#time').val()+'&price='+amount+'&date='+date_achat+'&exp='+date_exp);
        $('.continue').hide();
        $('.checkout').show();
        $('.return').hide();
        $('.return2').show();
        $('#timeh5').hide();
        $('#pseudoh5').hide();
        $('#mailh5').hide();
        $('#mdph5').hide();
        $('#serveurh5').hide();
        $('.globerror').hide();
        $('.recap').show();
      } else if (output == "Le nombre de mois n'est pas numérique") {
        $(".globerrortxt").html(output);
        $('.globerror').show();
      } else {
        $(".globerrortxt").html('Une erreur est survenue');
        $('.globerror').show();
      }
    }
  });
}
function lastpage() {
  $('.continue').show();
  $('.checkout').hide();
  $('.return').show();
  $('.return2').hide();
  $('#timeh5').show();
  $('#pseudoh5').show();
  $('#mailh5').show();
  $('#mdph5').show();
  $('#serveurh5').show();
  $('.recap').hide();
}

document.getElementById('time').addEventListener('keydown', function(e) {
    var key   = e.keyCode ? e.keyCode : e.which;
    
    if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
         (key == 65 && ( e.ctrlKey || e.metaKey  ) ) || 
         (key >= 35 && key <= 40) ||
         (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
         (key >= 96 && key <= 105)
       )) e.preventDefault();
});

/*$(document).keydown(function(event){
    if(event.keyCode==123){
      return false;
    }
    else if (event.ctrlKey && event.shiftKey && event.keyCode==73){        
      return false;
    }
});

$(document).on("contextmenu",function(e){        
   e.preventDefault();
});*/
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
