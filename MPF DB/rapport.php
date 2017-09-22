<?php
  session_start();
  include_once('config.php');

  if(isset($_SESSION['id'])) {
    if(isset($_GET['idrapport'])) {
        $rapportid = htmlspecialchars($_GET['idrapport']);

        $reqrapport = $bdd->prepare("SELECT * FROM rapportsprimaire WHERE id = ?");
        $reqrapport->execute(array($rapportid));
        $rapportinfos = $reqrapport->fetch();
        $reqrapportsec = $bdd->prepare("SELECT * FROM rapportssecondaire WHERE rapportprim_id = ?");
        $reqrapportsec->execute(array($rapportid));

        if(isset($_POST['rapport_cancel'])) {
          header('Location: dashboard?id='.$_SESSION['id']);
        } elseif (isset($_POST['rapport_close'])) {
            $closerap = $bdd->prepare("UPDATE rapportsprimaire SET statut = ? WHERE id = ?");
            $closerap->execute(array("closed", $rapportid));
            header('Refresh:0');
        } elseif (isset($_POST['rapport_submit'])) {
          if(isset($_POST['rapport_txt'])) {
              if(strlen($_POST['rapport_txt']) <= 255) {
                  $rapport = htmlspecialchars($_POST['rapport_txt']);
                  $date = date("Y-m-d");
                  $insertrap = $bdd->prepare("INSERT INTO rapportssecondaire(rapportprim_id, createur_matricule, date_creation, rapport) VALUES(?, ?, ?, ?)");
                  $insertrap->execute(array($rapportid, $_SESSION['matricule'], $date, $rapport));
                  header('Refresh:0');
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

    <div class="main-content">
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

                        <div id="menu-1" class="content home indexMenu" style="display: none;font-size: 16px;">
                            <div class="page-header">
                                <h2 class="page-title">Rapport n°<?=$rapportinfos['id'];?></h2>
                            </div> <!-- /.page-header -->
                             <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                    <br/>
                                    <p><b>Créateur:</b> <?=$rapportinfos['createur_matricule'];?></p>
                                    <p><b>Date de création:</b> <?=$rapportinfos['date_creation'];?></p>
                                    <p><b>Rapport:</b><br/><?=$rapportinfos['rapport'];?></p>
                                    <?php if($_SESSION['matricule'] == $rapportinfos['createur_matricule'] && $rapportinfos['statut'] == "opened") { ?>
                                        <br/>
                                        <form class="contact-form" method="POST">
                                            <input type="submit" name="rapport_close" id="rapport_close" class="mainBtn" style="width: 49%;" value="Fermer le rapport">
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                             <div class="page-header" style="border-top:1px solid #a71e2b;margin-bottom: 30px;">
                                <h2 class="page-title">Rapports secondaires</h2>
                            </div> <!-- /.page-header -->
                            <?php
                                if($reqrapportsec->rowCount() > 0) {
                                    while ($rapportsecondaireinfos = $reqrapportsec->fetch()) {
                            ?>
                            <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                    <p><b>Créateur:</b> <?=$rapportsecondaireinfos['createur_matricule'];?></p>
                                    <p><b>Date de création:</b> <?=$rapportsecondaireinfos['date_creation'];?></p>
                                    <p><b>Rapport:</b><br/><?=$rapportsecondaireinfos['rapport'];?></p>
                                </div>
                            </div>
                            <?php
                                    }
                                } else {
                                    echo '<span style="margin-left:30px;margin-top:30px;">Aucun rapport secondaire à afficher</span>';
                                }
                            ?>
                            <?php
                                if($rapportinfos['statut'] == "opened") {
                            ?>
                            <div class="page-header" style="border-top:1px solid #a71e2b;">
                                <h2 class="page-title">Créé un rapport secondaire</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                <form class="contact-form" method="POST">
                                    <label>Rapport</label>
                                    <textarea style="max-width:100%;width:100%;" name="rapport_txt" id="rapport_txt" placeholder="Le sujet a part la suite été intérogé..."></textarea>
                                    <input type="submit" name="rapport_cancel" id="rapport_cancel" class="mainBtn" style="width: 49%;" value="Annuler/Retour">
                                    <input type="submit" name="rapport_submit" id="rapport_submit" class="mainBtn" style="width: 49%; float: right;" value="Soumettre">
                                </form>
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->
                            <?php } else { ?>
                                <form class="contact-form" method="POST" style="margin-left: 30px;">
                                    <input type="submit" name="rapport_cancel" id="rapport_cancel" class="mainBtn" style="width: 49%;" value="Retour">
                                </form>
                            <?php } ?>
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
    header('Location: dashboard?id='.$_SESSION['id']);
 }
 } else {
    header('Location: index');
 }
?>
