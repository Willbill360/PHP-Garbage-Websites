<?php
  session_start();
  include_once('config.php');

  if(isset($_SESSION['id'])) {
    if(isset($_GET['id'])) {
        $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $requser->execute(array(htmlspecialchars($_GET['id'])));
        $curuser = $requser->fetch();

        $reqmyqual = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ?");
        $reqmyqual->execute(array($curuser['matricule']));
        $reqprimrapport = $bdd->prepare("SELECT * FROM rapportsprimaire WHERE division = ? ORDER BY id DESC");
        $reqprimrapport->execute(array($curuser['division']));
        $reqintero = $bdd->prepare("SELECT * FROM interogatoires WHERE createur_matricule = ? ORDER BY id DESC");
        $reqintero->execute(array($curuser['matricule']));
        $reqmissions = $bdd->prepare("SELECT * FROM missions WHERE matricule = ? ORDER BY id DESC");
        $reqmissions->execute(array($curuser['matricule']));
        $reqlavage = $bdd->prepare("SELECT * FROM lavagescerveau WHERE matricule = ? ORDER BY id DESC");
        $reqlavage->execute(array($curuser['matricule']));

        if(isset($_POST['view_cancel'])) {
            header('Location: dashboard?id='.$_SESSION['id']);
        }

        if(isset($_POST['qual_submit'])) {
            if(isset($_POST['qual_select']) AND !empty($_POST['qual_select'])) {
                $newqual = htmlspecialchars($_POST['qual_select']);
                $testqual = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ? AND qualification = ?");
                $testqual->execute(array($curuser['matricule'], $newqual));
                $qualexist = $testqual->rowCount();
                if($qualexist == 0) {
                    if($newqual == "Qualification de Tireur d'Élite") {
                        $insertnewqual = $bdd->prepare("INSERT INTO qualifications(qualification, matricule) VALUES(?, ?)");
                        $insertnewqual->execute(array($newqual, $curuser['matricule']));
                        header('Refresh:0');
                    } elseif($newqual == "Qualification en Ingénérie Niveau 1") {
                        $testquallvl2 = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ? AND qualification = ?");
                        $testquallvl2->execute(array($curuser['matricule'], "Qualification en Ingénérie Niveau 2"));
                        $quallvl2exist = $testquallvl2->rowCount();
                        if($quallvl2exist == 1) {
                            $curqual = $testquallvl2->fetch();
                            $upatequal = $bdd->prepare("UPDATE qualifications SET qualification = ? WHERE qualification = ?");
                            $upatequal->execute(array($newqual, $curqual['qualification']));
                            header('Refresh:0');
                        } else {
                            $insertnewqual = $bdd->prepare("INSERT INTO qualifications(qualification, matricule) VALUES(?, ?)");
                            $insertnewqual->execute(array($newqual, $curuser['matricule']));
                            header('Refresh:0');
                        }
                    } elseif($newqual == "Qualification en Mécanique Niveau 1") {
                        $testquallvl2 = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ? AND qualification = ?");
                        $testquallvl2->execute(array($curuser['matricule'], "Qualification en Mécanique Niveau 2"));
                        $quallvl2exist = $testquallvl2->rowCount();
                        if($quallvl2exist == 1) {
                            $curqual = $testquallvl2->fetch();
                            $upatequal = $bdd->prepare("UPDATE qualifications SET qualification = ? WHERE qualification = ?");
                            $upatequal->execute(array($newqual, $curqual['qualification']));
                            header('Refresh:0');
                        } else {
                            $insertnewqual = $bdd->prepare("INSERT INTO qualifications(qualification, matricule) VALUES(?, ?)");
                            $insertnewqual->execute(array($newqual, $curuser['matricule']));
                            header('Refresh:0');
                        }
                    } elseif($newqual == "Qualification en Ingénérie Niveau 2") {
                        $testquallvl2 = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ? AND qualification = ?");
                        $testquallvl2->execute(array($curuser['matricule'], "Qualification en Ingénérie Niveau 1"));
                        $quallvl2exist = $testquallvl2->rowCount();
                        if($quallvl2exist == 1) {
                            $curqual = $testquallvl2->fetch();
                            $upatequal = $bdd->prepare("UPDATE qualifications SET qualification = ? WHERE qualification = ?");
                            $upatequal->execute(array($newqual, $curqual['qualification']));
                            header('Refresh:0');
                        } else {
                            $insertnewqual = $bdd->prepare("INSERT INTO qualifications(qualification, matricule) VALUES(?, ?)");
                            $insertnewqual->execute(array($newqual, $curuser['matricule']));
                            header('Refresh:0');
                        }
                    } elseif($newqual == "Qualification en Mécanique Niveau 2") {
                        $testquallvl2 = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ? AND qualification = ?");
                        $testquallvl2->execute(array($curuser['matricule'], "Qualification en Mécanique Niveau 1"));
                        $quallvl2exist = $testquallvl2->rowCount();
                        if($quallvl2exist == 1) {
                            $curqual = $testquallvl2->fetch();
                            $upatequal = $bdd->prepare("UPDATE qualifications SET qualification = ? WHERE qualification = ?");
                            $upatequal->execute(array($newqual, $curqual['qualification']));
                            header('Refresh:0');
                        } else {
                            $insertnewqual = $bdd->prepare("INSERT INTO qualifications(qualification, matricule) VALUES(?, ?)");
                            $insertnewqual->execute(array($newqual, $curuser['matricule']));
                            header('Refresh:0');
                        }
                    }
                } else {
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
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
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
                            <div class="page-header" style="margin-bottom: 30px;">
                                <h2 class="page-title">Informations</h2>
                                <?php if($_SESSION['matricule'] == "ADMIN") { ?>
                                    <div class="pull-right" style="margin-top: -20px;"><a href="useredit?id=<?=$curuser['id']?>">Modifier l'unité</a></div>
                                <?php } ?>
                            </div> <!-- /.page-header -->
                             <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                    <p><b>Maticule:</b> <?=$curuser['matricule'];?></p>
                                    <p><b>Nombre de rapport:</b> <?=$reqprimrapport->rowCount();?></p>
                                    <p><b>Nombre d'intérogatoire:</b> <?=$reqintero->rowCount();?></p>
                                    <p><b>Nombre de missions:</b> <?=$reqmissions->rowCount();?></p>
                                    <?php if($_SESSION['numericalgrade'] >= 8 && $curuser['id'] != $_SESSION['id']) { ?>
                                        <p><b>Nombre de lavage de cerveau:</b> <?=$reqlavage->rowCount();?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="page-header" style="border-top:1px solid #a71e2b;margin-bottom: 30px;">
                                <h2 class="page-title">Qualifications</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner" style="padding-top: 0px;">
                                <div class="row">
                                    <?php
                                        if($reqmyqual->rowCount() > 0) {
                                            while ($userqual = $reqmyqual->fetch()) {
                                    ?>
                                        <p><?=$userqual['qualification'];?></p>
                                    <?php 
                                            } 
                                        } else {
                                            echo '<p>Aucunes qualifications précises</p>';
                                        }
                                    ?>
                                    <?php if($_SESSION['numericalgrade'] >= 7) { ?>
                                        <form class="contact-form" method="POST">
                                            <label>Ajout</label>
                                            <select name="qual_select" style="width: 50%;">
                                                <option value="Qualification en Ingénérie Niveau 1">Qualification en Ingénérie Niveau 1</option>
                                                <option value="Qualification en Ingénérie Niveau 2">Qualification en Ingénérie Niveau 2</option>
                                                <option value="Qualification en Mécanique Niveau 1">Qualification en Mécanique Niveau 1</option>
                                                <option value="Qualification en Mécanique Niveau 2">Qualification en Mécanique Niveau 2</option>
                                                <option value="Qualification de Tireur d'Élite">Qualification de Tireur d'Élite</option>
                                            </select>
                                            <input type="submit" name="qual_submit" id="qual_submit" class="mainBtn" style="width: 49%;" value="Ajouter une qualification">
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="page-header" style="border-top:1px solid #a71e2b;margin-bottom: 30px;">
                                <h2 class="page-title">Carrière</h2>
                            </div> <!-- /.page-header -->
                             <div class="content-inner" style="padding-top: 0px;">
                                <?php if($_SESSION['numericalgrade'] >= 8 && $curuser['id'] != $_SESSION['id']) { ?>
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Lavage de cerveau</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-rapportopen">
                                    <div class="col-md-4 col-sm-6">
                                        <a href="addbrainwash?id=<?=$curuser['id'];?>">
                                            <div class="team-member">
                                                <div class="member-infos" style="border:5px solid #FFF;background:transparent;height: 325px;">
                                                    <div><i style="margin-top: 100px;color:#FFF;" class="fa fa-plus fa-5x" aria-hidden="true"></i></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                        if($reqlavage->rowCount() > 0) {
                                            while ($lavage = $reqlavage->fetch()) {
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="team-member">
                                            <div class="member-infos">
                                                <h4 class="member-name">Effectué par:<br/> <?=$lavage['matricule'];?></h4>
                                                <span class="member-role" style="font-size: 14px;">Date: <?=$lavage['date_creation'];?></span><br/>
                                                <span class="member-role" style="font-size: 14px;">Stage: <?=$lavage['stage'];?></span>
                                                <p class="member-desc rapportpreview" style="font-size:16px;height: 150px;">
                                                    <b>Raison:</b><br/><?=$lavage['raison'];?>
                                                </p>
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                            }
                                        } else {
                                            echo '<span style="margin-left:30px;">Aucun lavage de cerveau à afficher</span>';
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <?php } ?>
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Rapport</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-rapportopen">
                                    <?php
                                        if($reqprimrapport->rowCount() > 0) {
                                            while ($primrapport = $reqprimrapport->fetch()) {
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="team-member">
                                            <div class="member-infos">
                                                <h4 class="member-name">Rapport du: <br/><?=$primrapport['createur_matricule'];?></h4>
                                                <span class="member-role" style="font-size: 14px;">Créé le: <?=$primrapport['date_creation'];?></span>
                                                <p class="member-desc rapportpreview" style="font-size:16px;height: 150px;"><?=$primrapport['rapport'];?></p>
                                                <a href="rapport?idrapport=<?=$primrapport['id'];?>" class="member-social mainBtn" style="padding:10px;">
                                                    Voir le rapport au complet
                                                </a>
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                            }
                                        } else {
                                            echo '<span style="margin-left:30px;">Aucun rapport à afficher</span>';
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Interogatoires</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-intero">
                                    <?php
                                        if($reqintero->rowCount() > 0) {
                                            while ($interouser = $reqintero->fetch()) {
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="team-member">
                                            <div class="member-infos">
                                                <h4 class="member-name">Interrogatoire de: <br/><?=$interouser['nom_sujet'];?></h4>
                                                <span class="member-role" style="font-size:14px;"">Interrogé le: <?=$interouser['date_creation'];?></span>
                                                <p class="member-desc rapportpreview" style="font-size:16px;height: 250px;">
                                                    <b>Technique de torture utilisé:</b><br/> <?=$interouser['technique'];?><br/>
                                                    <b>Outil de torture utilisé:</b><br/> <?=$interouser['outil'];?><br/>
                                                    <b>Décès du sujet:</b><br/> <?=$interouser['deces_sujet'];?><br/>
                                                    <b>Infos récupérées:</b><br/><textarea disabled style="max-width:100%;max-height:111px;width:100%;height:111px;overflow-y:scroll;background-color:#fff;"><?=$interouser['infos_recup'];?></textarea><br/>
                                                </p>
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                            }
                                        } else {
                                            echo '<span style="margin-left:30px;">Aucun interogatoire à afficher</span>';
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Missions</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-mission">
                                    <?php if($_SESSION['numericalgrade'] >= 8) { ?>
                                        <div class="col-md-4 col-sm-6">
                                        <a href="addmission?mat=<?=$curuser['matricule'];?>">
                                            <div class="team-member">
                                                <div class="member-infos" style="border:5px solid #FFF;background:transparent;height: 325px;">
                                                    <div><i style="margin-top: 100px;color:#FFF;" class="fa fa-plus fa-5x" aria-hidden="true"></i></div>
                                                </div>
                                            </div>
                                        </a>
                                        </div> <!-- /.col-md-4 -->
                                    <?php } ?>
                                    <?php
                                        if($reqmissions->rowCount() > 0) {
                                            while ($usermission = $reqmissions->fetch()) {
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="team-member">
                                            <div class="member-infos">
                                                <h4 class="member-name">Émise part: <br/><?=$usermission['emeteur_matricule'];?></h4>
                                                <span class="member-role" style="font-size: 14px;">Créé le: <?=$usermission['date_creation'];?></span>
                                                <p class="member-desc rapportpreview" style="font-size:16px;height: 175px;"><textarea disabled style="max-width:100%;max-height:190px;height:190px;width:100%;background-color:#fff;"><?=$usermission['mission'];?></textarea></p>
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                            }
                                        } else {
                                            echo '<span style="margin-left:30px;">Aucune mission à afficher</span>';
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <div class="our-team">
                                <form class="contact-form" method="POST">
                                    <input type="submit" name="view_cancel" id="view_cancel" class="mainBtn" style="width: 49%;" value="Retour">
                                </form>
                            </div>
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
    <script type="text/javascript" src="slick/slick.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('.slidesick-intero').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: false
          });
          $('.slidesick-mission').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: false
          });
          $('.slidesick-rapportopen').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: false
          });
        });
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
