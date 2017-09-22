<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);

?>
<?php
  if(isset($_SESSION['id']) AND $getid == $_SESSION['id']) {

    $fichiermdp = fopen('specialmdp.txt', 'r+');
    $specialmdp = fgets($fichiermdp);
    fclose($fichiermdp);

    $code = mt_rand(1000000, 9999999);
    $fichiermdp = fopen('specialmdp.txt', 'w+');
    fwrite($fichiermdp, $code);
    fclose($fichiermdp);
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
<link href="css/lightgallery.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
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
          <div class="colw_12 alomdebe white padd5555 hei100 wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s" style="background: black;">
          <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="600px" height="100px" viewBox="0 0 6000 100">
            <style type="text/css">
            <![CDATA[
              text {
                filter: url(#filter);
                fill: white;
                  font-family: 'Share Tech Mono', sans-serif;
                  font-size: 100px;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                    }
            ]]>
            </style>
              <defs>
                <filter id="filter">
                    <feFlood flood-color="black" result="black" />
                    <feFlood flood-color="red" result="flood1" />
                    <feFlood flood-color="limegreen" result="flood2" />
                  <feOffset in="SourceGraphic" dx="3" dy="0" result="off1a"/>
                  <feOffset in="SourceGraphic" dx="2" dy="0" result="off1b"/>
                  <feOffset in="SourceGraphic" dx="-3" dy="0" result="off2a"/>
                  <feOffset in="SourceGraphic" dx="-2" dy="0" result="off2b"/>
                    <feComposite in="flood1" in2="off1a" operator="in"  result="comp1" />
                    <feComposite in="flood2" in2="off2a" operator="in" result="comp2" />
                    <feMerge x="0" width="100%" result="merge1">
                    <feMergeNode in = "black" />
                    <feMergeNode in = "comp1" />
                    <feMergeNode in = "off1b" />
                    <animate 
                      attributeName="y" 
                        id = "y"
                        dur ="4s"
                        
                        values = '104px; 104px; 30px; 105px; 30px; 2px; 2px; 50px; 40px; 105px; 105px; 20px; 6ßpx; 40px; 104px; 40px; 70px; 10px; 30px; 104px; 102px'

                        keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

                        repeatCount = "indefinite" />
                    <animate attributeName="height" 
                        id = "h" 
                        dur ="4s"
                        
                        values = '10px; 0px; 10px; 30px; 50px; 0px; 10px; 0px; 0px; 0px; 10px; 50px; 40px; 0px; 0px; 0px; 40px; 30px; 10px; 0px; 50px'

                        keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

                        repeatCount = "indefinite" />
                    </feMerge>
                  <feMerge x="0" width="100%" y="60px" height="65px" result="merge2">
                    <feMergeNode in = "black" />
                    <feMergeNode in = "comp2" />
                    <feMergeNode in = "off2b" />
                    <animate attributeName="y" 
                        id = "y"
                        dur ="4s"
                        values = '103px; 104px; 69px; 53px; 42px; 104px; 78px; 89px; 96px; 100px; 67px; 50px; 96px; 66px; 88px; 42px; 13px; 100px; 100px; 104px;' 
                        keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513; 0.548; 0.577; 0.613; 1'
                        repeatCount = "indefinite" />
                    <animate attributeName="height" 
                        id = "h"
                        dur = "4s"
                      values = '0px; 0px; 0px; 16px; 16px; 12px; 12px; 0px; 0px; 5px; 10px; 22px; 33px; 11px; 0px; 0px; 10px'
                        keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513;  1'
                        repeatCount = "indefinite" />
                    </feMerge>
                  <feMerge>
                    <feMergeNode in="SourceGraphic" />
                    <feMergeNode in="merge1" /> 
                  <feMergeNode in="merge2" />
                    </feMerge>
                  </filter>
              </defs>
            </svg>
              <h2 style="color:white;"><text id="op" class="thetext" x="0" y="100"><?= $lang['DASH_WELCOME'] ?>_root</text></h2>
            <!-- <section class="london">
              <div class="container">
                <h1 id="op" class="thetext" style="color:#dedede;" >Aqtobe KTL 2011-2016</h1>
              </div>
            </section> -->
            <div class="paddtop105">
              <div class="mainleft">
                <div class="right" style="float:right;width:50%;">
                      <p><text id="op2" class="thetext2" x="0" y="0" style="font-size: inherit;"><?= $lang['DASH_BEFORE_ADD'] ?></text></p>
                      <br/>
                      <br/>
                      <br/>
                        <p id="op4" class="thetext4" style="font-size: inherit; font-style:inherit;color:#d3d3d3;"><?= $lang['DASH_BEFORE_SEARCH'] ?></p>
                      <br/>
                      <br/>
                      <br/>
                        <p id="op6" class="thetext6" style="color:#d3d3d3;"><?= $lang['DASH_BEFORE_LOGOUT'] ?></p>
                </div>
                <div align="center" class="btn-box">
                  <a href="transition?go=search" class="img-btn animsition-link">
                    <img align="center" src="img/man-search-white.png" style="" class="btn-img himg1" />
                      <p id="op3" class="thetext3"><?= $lang['DASH_SEARCH_HACKED'] ?></p>
                  </a>
                </div>
                 <div align="center" class="btn-box">
                  <a href="deconnexion" class="img-btn">
                    <img align="center" src="img/deconnexion-white.png" style="" class="btn-img himg2" />
                    <p><text id="op5" class="thetext5" x="0" y="0" style="font-size: inherit;"><?= $lang['DASH_LOGOUT'] ?></text></p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Left -->
        <!-- START Right -->
        <div class="colw_6 alomdebe">
          <div class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s" style="background: black;">
            <img align="right" src="img/cwu-logo-black.png" style="" class="cwu-logo" />
            <div class="paddtop105">
                <table class="table-wrapper" style="border-collapse:initial;">
                  <tbody>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op7" class="thetext7" style="color:#d3d3d3;">CID</h5></td>
                      <td><h5 id="op8" class="thetext8" style="color:#d3d3d3;"><?= $specialmdp ?></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op9" class="thetext9" style="color:#d3d3d3;"><?= $lang['FILE_FULLNAME'] ?></h5></td>
                      <td><h5 id="op10" class="thetext10" style="color:#d3d3d3;">root</h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op11" class="thetext11" style="color:#d3d3d3;"><?= $lang['FILE_PLOYAUTE'] ?></h5></td>
                      <td><h5 id="op12" class="thetext12" style="color:#d3d3d3;"><?php $failint = 3402823669209384634633746074317682114558; echo $failint; ?></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op13" class="thetext13" style="color:#d3d3d3;"><?= $lang['FILE_STATUS'] ?></h5></td>
                        <td><h5 id="op14" class="thetext14" style="color:#d3d3d3;"><?= $lang['FILE_STATUS_2'] ?></h5></td>
                        <td><h5 id="op15" class="thetext15" style="color:#d3d3d3;"><?= $lang['FILE_STATUS_4'] ?></h5></td>
                        <td><h5 id="op16" class="thetext16" style="color:#d3d3d3;"><?= $lang['FILE_STATUS_6'] ?></h5></td>
                        <td><h5 id="op17" class="thetext17" style="color:#d3d3d3;"><?= $lang['FILE_STATUS_7'] ?></h5></td>
                    </tr>
                     <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op18" class="thetext18" style="color:#d3d3d3;"><?= $lang['FILE_DESC'] ?></h5></td>
                      <td><h5 id="op19" class="thetext19" class="desc1" style="height:100px;color:#d3d3d3;"> Test </h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5 id="op20" class="thetext20" style="color:#d3d3d3;"><?= $lang['FILE_OBSERV'] ?></h5></td>
                      <td><h5 id="op21" class="thetext21" class="desc1" style="height:100px;color:#d3d3d3;"> Test </h5></td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div> 
        </div>
        <!-- END Right -->

        <p class="dolje">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
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
  var SPY = function() {
  function e(a, d, b) {
    var c, f, g, h;
    b == a.length ? k.animationComplete = !0 : (g = d.innerHTML, h = Math.floor(21 * Math.random() + 5), c = 32 === a[b] ? 32 : a[b] - h, f = setInterval(function() {
      d.innerHTML = g + String.fromCharCode(c);
      c == a[b] ? (clearInterval(f), c = 32, b++, setTimeout(function() {
        e(a, d, b);
      }, 10)) : c++;
    }, 5));
  }
  var k = {};
  return k = {animationComplete:!1, text:function(a) {
    this.animationComplete = !1;
    a = document.getElementById(a);
    for (var d = a.innerHTML, b = [], c = 0;c < d.length;c++) {
      b.push(d.charCodeAt(c));
    }
    a.innerHTML = "";
    e(b, a, 0);
  }};
}();


$( 'document' ).ready(function() {
  
  // Hide header
  $( '.thetext' ).hide();
  $( '.thetext2' ).hide();
  $( '.thetext3' ).hide();
  $( '.thetext4' ).hide();
  $( '.thetext5' ).hide();
  $( '.thetext6' ).hide();
  $( '.thetext7' ).hide();
  $( '.thetext8' ).hide();
  $( '.thetext9' ).hide();
  $( '.thetext10' ).hide();
  $( '.thetext11' ).hide();
  $( '.thetext12' ).hide();
  $( '.thetext13' ).hide();
  $( '.thetext14' ).hide();
  $( '.thetext15' ).hide();
  $( '.thetext16' ).hide();
  $( '.thetext17' ).hide();
  $( '.thetext18' ).hide();
  $( '.thetext19' ).hide();
  $( '.thetext20' ).hide();
  $( '.thetext21' ).hide();
  $( '.himg1' ).hide();
  $( '.himg2' ).hide();
  // Transition background
  $( '.london' ).fadeIn( 1200 );
  
  
  // Timeout for crypto text
  setTimeout( function() { 
    $( '.thetext' ).fadeIn( 'slow' );
      SPY.text( 'op' );
  }, 1000);
  setTimeout( function() { 
    $( '.thetext2' ).fadeIn( 'slow' );
      SPY.text( 'op2' );
  }, 2000);
  setTimeout( function() { 
    $( '.thetext3' ).fadeIn( 'slow' );
    $( '.himg1' ).fadeIn( 'slow' );
      SPY.text( 'op3' );
  }, 3000);
  setTimeout( function() { 
    $( '.thetext4' ).fadeIn( 'slow' );
      SPY.text( 'op4' );
  }, 4000);
  setTimeout( function() { 
    $( '.thetext5' ).fadeIn( 'slow' );
    $( '.himg2' ).fadeIn( 'slow' );
      SPY.text( 'op5' );
  }, 5000);
  setTimeout( function() { 
    $( '.thetext6' ).fadeIn( 'slow' );
      SPY.text( 'op6' );
  }, 6000);
  setTimeout( function() { 
    $( '.thetext7' ).fadeIn( 'slow' );
    $( '.thetext8' ).fadeIn( 'slow' );
    $( '.thetext9' ).fadeIn( 'slow' );
    $( '.thetext10' ).fadeIn( 'slow' );
    $( '.thetext11' ).fadeIn( 'slow' );
    $( '.thetext12' ).fadeIn( 'slow' );
    $( '.thetext13' ).fadeIn( 'slow' );
    $( '.thetext14' ).fadeIn( 'slow' );
    $( '.thetext15' ).fadeIn( 'slow' );
    $( '.thetext16' ).fadeIn( 'slow' );
    $( '.thetext17' ).fadeIn( 'slow' );
    $( '.thetext18' ).fadeIn( 'slow' );
    $( '.thetext19' ).fadeIn( 'slow' );
    $( '.thetext20' ).fadeIn( 'slow' );
    $( '.thetext21' ).fadeIn( 'slow' );
      SPY.text( 'op7' );
      SPY.text( 'op8' );
      SPY.text( 'op9' );
      SPY.text( 'op10' );
      SPY.text( 'op11' );
      SPY.text( 'op12' );
      SPY.text( 'op13' );
      SPY.text( 'op14' );
      SPY.text( 'op15' );
      SPY.text( 'op16' );
      SPY.text( 'op17' );
      SPY.text( 'op18' );
      SPY.text( 'op19' );
      SPY.text( 'op20' );
      SPY.text( 'op21' );
  }, 7000);
  
});
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
window.setTimeout(function(){
  $('.row').css('background', 'black');
}, 2500);
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
  } else {
    header("Location: index");
  }
?>
