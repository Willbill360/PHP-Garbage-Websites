<?php
  session_start();
  include_once('config.php');

  if(isset($_SESSION['id'])) {

    if(isset($_POST['intero_cancel'])) {
        header('Location: dashboard?id='.$_SESSION['id']);
    } elseif (isset($_POST['intero_submit'])) {
        if(isset($_POST['intero_sujet']) && isset($_POST['intero_technique']) && isset($_POST['intero_outil']) && isset($_POST['intero_deces']) && isset($_POST['intero_infos'])) {
            if(strlen($_POST['intero_sujet']) <= 255 && strlen($_POST['intero_technique']) <= 255 && strlen($_POST['intero_outil']) <= 255 && strlen($_POST['intero_deces']) <= 255) {
                $sujet = htmlspecialchars($_POST['intero_sujet']);
                $technique = htmlspecialchars($_POST['intero_technique']);
                $outil = htmlspecialchars($_POST['intero_outil']);
                $deces = htmlspecialchars($_POST['intero_deces']);
                $infos = htmlspecialchars($_POST['intero_infos']);
                $date = date("Y-m-d");
                $insertintero = $bdd->prepare("INSERT INTO interogatoires(createur_matricule, date_creation, nom_sujet, technique, infos_recup, deces_sujet, outil) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $insertintero->execute(array($_SESSION['matricule'], $date, $sujet, $technique, $infos, $deces, $outil));
                header('Location: dashboard?id='.$_SESSION['id']);
            }
        }
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title>Data Milice UWG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
<!--
Genius Template
http://www.templatemo.com/tm-402-genius
Modified and PHP by: William Gagnon | wilgagnon@hotmail.com
-->
    <meta name="author" content="templatemo">
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    
    <!-- CSS Bootstrap & Custom -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/templatemo_style.css" rel="stylesheet" media="screen">
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    
    <!-- JavaScripts -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/modernizr.js"></script>
    <!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
        </div>
    <![endif]-->
</head>
<body>
    
    
    <div class="bg-image"></div>
    <div class="overlay-bg"></div>

    
    <!-- <div class="container language-select visible-md visible-lg">
        <div class="row">
            <div class="col-md-12">
                <select name="cat2" id="cat2" class="postform">
                    <option value="0">-> Language Selection <-</option>
                    <option class="level-0" value="1">English</option>
                    <option class="level-0" value="2">Français</option>
                </select>
            </div>  /.col-md-12
        </div>  /.row
    </div>  /.language-select -->

    <!-- This one in here is responsive menu for tablet and mobiles -->
    <div class="responsive-navigation visible-sm visible-xs" style="visibility: hidden;">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars fa-2x"></i>
        </a>
        <div class="responsive_menu">
            <ul class="main_menu">
                <li><a class="show-1 homebutton" href="#"><i class="fa fa-home"></i>Home</a></li>
                <div class="menu-connected">
                <li><a class="show-2" href="#"><i class="fa fa-archive"></i>Mon Casier</a></li>
                <li><a class="show-3" href="#"><i class="fa fa-list"></i>Liste MPF</a></li>
                <li><a class="show-5" href="#"><i class="fa fa-sign-out"></i>Déconnexion</a></li>
                </div>
            </ul> <!-- /.main_menu -->
        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->

    <div class="main-content" style="font-size: 16px;">
        <div class="container">
            <div class="row">

                <!-- Static Menu -->
                <div class="col-md-2 visible-md visible-lg" style="visibility: hidden;">
                    <div class="main_menu">
                        <ul class="menu">
                            <li><a class="show-1 homebutton" href="#" data-toggle="tooltip" data-original-title="Home"><i class="fa fa-home"></i></a></li>
                            <div class="menu-connected">
                            <li><a class="show-2" href="#" data-toggle="tooltip" data-original-title="Mon Casier"><i class="fa fa-user fa-archive"></i></a></li>
                            <li><a class="show-3" href="#" data-toggle="tooltip" data-original-title="Liste MPF"><i class="fa fa-list"></i></a></li>
                            <li><a class="show-5" href="#" data-toggle="tooltip" data-original-title="Déconnexion"><i class="fa fa-sign-out"></i></a></li>
                            </div>
                        </ul>
                    </div> <!-- /.main-menu -->
                </div> <!-- /.col-md-2 -->

                <!-- Begin Content -->
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="templatemo_logo">
                                <a href="#">
                                    <img src="images/Logo-1.png" alt="Civil Protection">
                                </a>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-12 -->
                    </div> <!-- /.row -->


                    <div id="menu-container">

                        <div id="menu-1" class="content home indexMenu" style="display: none;">
                            <div class="page-header">
                                <h2 class="page-title">Rapport d'interrogatoire</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                <form class="contact-form" method="POST">
                                    <label>Nom de l'intérogé</label>
                                    <input type="text" name="intero_sujet" id="intero_sujet" placeholder="John Doe" />
                                    <label style="width:51%;">Technique d'intérogatoire utilisé</label>
                                    <label>Outil d'intérogatoire utilisé</label>
                                    <input type="text" name="intero_technique" id="intero_technique" placeholder="Cassage des falanges" style="width:49%"/>
                                    <input type="text" name="intero_outil" id="intero_outil" placeholder="Pince" style="width:49%;float:right;" /><br/>
                                    <label>Décès du sujet</label>
                                    <input type="text" name="intero_deces" id="intero_deces" placeholder="Affirmatif" />
                                    <label>Informations récupérées</label>
                                    <textarea style="max-width:100%;width:100%;" name="intero_infos" id="intero_infos" placeholder="La position de la cible XYZ est dans l'édifice nord du sud à l'ouest de l'est."></textarea>
                                    <input type="submit" name="intero_cancel" id="intero_cancel" class="mainBtn" style="width: 49%;" value="Annuler">
                                    <input type="submit" name="intero_submit" id="intero_submit" class="mainBtn" style="width: 49%; float: right;" value="Soumettre">
                                </form>
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->
                        </div> <!-- /.homepage -->

                        <div class="site-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <p align="center" class="copyright-text">Copyright &copy; 2017 William Gagnon et Union War Gaming 
                                    </p>
                                </div>
                            </div>
                        </div> <!-- /.site-footer -->

                    </div> <!-- /.content-holder -->
                
                </div> <!-- /.col-md-10 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.main-content -->

    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/templatemo_custom.js"></script>
    <script>
        function initialize() {
          var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(16.832179,96.134976)
          };

          var map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);
        }

        function loadScript() {
          var script = document.createElement('script');
          script.type = 'text/javascript';
          script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
              'callback=initialize';
          document.body.appendChild(script);
        }

    </script>
<!-- templatemo 402 genius -->
</body>
</html>
<?php
 } else {
    header('Location: index');
 }
?>
