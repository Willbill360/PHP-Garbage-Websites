<?php
  session_start();
  include_once('config.php');

  if(isset($_GET['id']) && $_GET['id'] == $_SESSION['id']) {
    $reqmyqual = $bdd->prepare("SELECT * FROM qualifications WHERE matricule = ?");
    $reqmyqual->execute(array($_SESSION['matricule']));
    $reqprimrapport = $bdd->prepare("SELECT * FROM rapportsprimaire WHERE division = ? AND statut = 'opened' ORDER BY id DESC");
    $reqprimrapport->execute(array($_SESSION['division']));
    $reqclosedrapport = $bdd->prepare("SELECT * FROM rapportsprimaire WHERE division = ? AND statut = 'closed' ORDER BY id DESC");
    $reqclosedrapport->execute(array($_SESSION['division']));
    $reqintero = $bdd->prepare("SELECT * FROM interogatoires WHERE createur_matricule = ? ORDER BY id DESC");
    $reqintero->execute(array($_SESSION['matricule']));
    $reqmissions = $bdd->prepare("SELECT * FROM missions WHERE matricule = ? ORDER BY id DESC");
    $reqmissions->execute(array($_SESSION['matricule']));

    $reqcmb = $bdd->query("SELECT * FROM users ORDER BY numericalgrade DESC");
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
    <div class="responsive-navigation visible-sm visible-xs">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars fa-2x"></i>
        </a>
        <div class="responsive_menu">
            <ul class="main_menu">
                <li><a class="show-1 homebutton" href="#"><i class="fa fa-home"></i>Home</a></li>
                <div class="menu-connected">
                <li><a class="show-2" href="#"><i class="fa fa-archive"></i>Mon Casier</a></li>
                <li><a class="show-3" href="#"><i class="fa fa-list"></i>Liste MPF</a></li>
                <li><a href="deconnexion"><i class="fa fa-sign-out"></i>Déconnexion</a></li>
                </div>
            </ul> <!-- /.main_menu -->
        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->

    <div class="main-content" style="font-size: 16px;">
        <div class="container">
            <div class="row">

                <!-- Static Menu -->
                <div class="col-md-2 visible-md visible-lg" style="margin: 200px auto;">
                    <div class="main_menu">
                        <ul class="menu">
                            <li><a class="show-1 homebutton" href="#" data-toggle="tooltip" data-original-title="Home"><i class="fa fa-home"></i></a></li>
                            <div class="menu-connected">
                            <li><a class="show-2" href="#" data-toggle="tooltip" data-original-title="Mon Casier"><i class="fa fa-user fa-archive"></i></a></li>
                            <li><a class="show-3" href="#" data-toggle="tooltip" data-original-title="Liste MPF"><i class="fa fa-list"></i></a></li>
                            <li><a href="deconnexion" data-original-title="Déconnexion"><i class="fa fa-sign-out"></i></a></li>
                            </div>
                        </ul>
                    </div> <!-- /.main-menu -->
                </div> <!-- /.col-md-2 -->

                <!-- Begin Content -->
                <div class="col-md-10">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="templatemo_logo">
                                <a href="#">
                                    <img src="images/Logo-1.png" alt="Genius">
                                </a>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-12 -->
                    </div> <!-- /.row -->


                    <div id="menu-container">
                        
                        <div id="menu-1" class="content home">
                            <div class="page-header">
                                <h2 class="page-title">Infos</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner">
                                <div class="row">
                                    <p>
                                        Salutation <?=$_SESSION['matricule'];?>,<br/> Ceci est la data réservé à l'usage de la milice. Vous y trouverez des fonctionnalités utiles pour vos opérations et autres procédures.
                                    </p>
                                    <br/>
                                    <p>
                                        L'onglet « Mon Casier » répertorie votre carrière, vos qualifications et vos missions.<br/>
                                        Vous pourrez aussi y remplir vos rapport (Unité Jury seulement) et vos rapports d'interrogatoire.<br/>
                                        Ainsi que voir la liste des unités dans l'onglet « Liste MPF ».<br/>
                                    </p>
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->
                        </div> <!-- /.homepage -->

                        <div id="menu-2" class="content casier">
                            <div class="page-header">
                                <h2 class="page-title">Mon Casier</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="widget-title">Fiche personnel</h3>
                                        <div align="center" style="float:none;margin:auto;" class="col-md-4 col-sm-6">
                                            <div class="team-member">
                                                <!-- <div class="member-thumb">
                                                    <img src="images/<?=$_SESSION['division'];?>.png" alt="">
                                                </div> -->
                                                <div class="member-infos" style="font-size: 14px;">
                                                    <h4 class="member-name"><?=$_SESSION['matricule'];?></h4>
                                                    <?php
                                                        if($reqmyqual->rowCount() > 0) {
                                                            while ($userqual = $reqmyqual->fetch()) {
                                                    ?>
                                                        <span class="member-role"><?=$userqual['qualification'];?></span>
                                                    <?php 
                                                            } 
                                                        } else {
                                                            echo '<span class="member-role">Aucunes qualifications précises</span>';
                                                        }
                                                    ?>
                                                    <p class="member-desc" style="font-size: 16px;">
                                                        Rapports: <?php $openrap = $reqprimrapport->rowCount(); $closerap = $reqclosedrapport->rowCount(); echo $openrap + $closerap; ?><br/>
                                                        Interogatoires: <?=$reqintero->rowCount();?><br/>
                                                        Missions: <?=$reqmissions->rowCount();?><br/>
                                                    </p>
                                                </div>
                                            </div>
                                        </div> <!-- /.col-md-4 -->
                                    </div> <!-- /.col-md-7 -->
                                </div> <!-- /.row -->
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Rapport Ouvert</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-rapportopen">
                                    <div class="col-md-4 col-sm-6">
                                    <a href="addrapport">
                                        <div class="team-member">
                                            <div class="member-infos" style="border:5px solid #FFF;background:transparent;height: 325px;">
                                                <div><i style="margin-top: 100px;color:#FFF;" class="fa fa-plus fa-5x" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                    </div> <!-- /.col-md-4 -->
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
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Rapport Fermer</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-rapportclose">
                                    <?php
                                        if($reqclosedrapport->rowCount() > 0) {
                                            while ($closedrapport = $reqclosedrapport->fetch()) {
                                    ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="team-member">
                                            <div class="member-infos">
                                                <h4 class="member-name">Rapport du: <br/><?=$closedrapport['createur_matricule'];?></h4>
                                                <span class="member-role" style="font-size: 14px;">Créé le: <?=$closedrapport['date_creation'];?></span>
                                                <p class="member-desc rapportpreview" style="font-size:16px;height: 150px;"><?=$closedrapport['rapport'];?></p>
                                                <a href="rapport?idrapport=<?=$closedrapport['id'];?>" class="member-social mainBtn" style="padding:10px;">
                                                    Voir le rapport au complet
                                                </a>
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <?php
                                            }
                                        } else {
                                            echo '<span style="margin-left:30px;">Aucun rapport fermer à afficher</span>';
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
                                    <div class="col-md-4 col-sm-6">
                                    <a href="addintero">
                                        <div class="team-member">
                                            <div class="member-infos" style="border:5px solid #FFF;background:transparent;height: 400px;">
                                                <div><i style="margin-top: 150px;color:#FFF;" class="fa fa-plus fa-5x" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                    </div> <!-- /.col-md-4 -->
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
                                        }
                                    ?>
                                    </div>
                                    </div> <!-- /.row -->
                                </div> <!-- /.our-team -->
                                <div class="our-team">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="widget-title">Mes missions</h3>
                                        </div> <!-- /.col-md-12 -->
                                    </div> <!-- /.row -->
                                    <div class="row">
                                    <div class="slidesick-mission">
                                    <div class="col-md-4 col-sm-6">
                                    <?php if($_SESSION['numericalgrade'] >= 8) { ?>
                                    <a href="addmission?mat=<?=$_SESSION['matricule'];?>">
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
                            </div> <!-- /.content-inner -->
                        </div> <!-- /.about-us -->

                        <div id="menu-3" class="content listmpf">
                            <div class="page-header">
                                <h2 class="page-title">Liste des unités de la milice</h2>
                                <?php if($_SESSION['matricule'] == "ADMIN") { ?>
                                    <div class="pull-right" style="margin-top: -20px;"><a href="useredit">Ajouter une unité</a></div>
                                <?php } ?>
                            </div> <!-- /.page-header -->
                            <div class="content-inner">
                                <div class="row">
                                    <div class="col-md-6" style="visibility: hidden;">
                                        <h3 class="widget-title">Division CMB</h3>
                                    </div> <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="filter-work pull-right">
                                            <a href="#nogo" class="toggle-filter">Filtre</a>
                                            <ul class="filter-controls controls">
                                                <li class="filter" data-filter="all" style="border-top:1px solid #fff;">Toutes les unités</li>
                                                <li class="filter" data-filter="CMB">CMB</li>
                                                <li class="filter" data-filter="HAMMER">HAMMER</li>
                                                <li class="filter" data-filter="MACE">MACE</li>
                                                <li class="filter" data-filter="SPEAR">SPEAR</li>
                                                <li class="filter" data-filter="JURY">JURY</li>
                                                <li class="filter" data-filter="VICE" style="border-bottom:1px solid #fff;">VICE</li>
                                                <li class="filter" data-filter="rct">RCT</li>
                                                <li class="filter" data-filter="05">05</li>
                                                <li class="filter" data-filter="04">04</li>
                                                <li class="filter" data-filter="03">03</li>
                                                <li class="filter" data-filter="02">02</li>
                                                <li class="filter" data-filter="01">01</li>
                                                <li class="filter" data-filter="AdJ">AdJ</li>
                                                <li class="filter" data-filter="SqL">SqL</li>
                                                <li class="filter" data-filter="DeL">DeL</li>
                                                <li class="filter" data-filter="SeC" style="border-bottom:1px solid #fff;">SeC</li>
                                            </ul>
                                        </div> <!-- /.filter-work -->
                                    </div> <!-- /.col-md-6 -->
                                </div> <!-- /.row -->
                                <div class="row">
                                    <div id="Grid">
                                        <?php
                                            if($reqcmb->rowCount() > 0) {
                                                while ($cmbdivision = $reqcmb->fetch()) {
                                                    if($cmbdivision['matricule'] != "ADMIN") {
                                        ?>
                                        <a id="unite-viewer" href="viewcase?id=<?=$cmbdivision['id'];?>">
                                        <div class="col-md-4 col-sm-6 mix <?=$cmbdivision['grade'];?> <?=$cmbdivision['division'];?>">
                                            <div class="gallery-item">
                                                <div class="gallery-thumb">
                                                    <img style="background-color:#fff;" draggable="false" src="images/<?=$cmbdivision['division'];?>.png" alt="">
                                                </div> <!-- /.gallery-thumb -->
                                                <div class="gallery-content">
                                                    <h4 class="gallery-title" id="gallery-title" align="center"><?=$cmbdivision['matricule'];?></h4>
                                                </div> <!-- /.gallery-content -->
                                            </div> <!-- /.gallery-item -->
                                        </div> <!-- /.col-md-4 -->
                                        </a>
                                        <?php
                                                }
                                            }
                                        } else {
                                            echo 'Aucune unité visible';
                                        }
                                        ?>
                                    </div> <!-- /#Grid -->
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->

                        </div> <!-- /.our-gallery -->

                        <div id="menu-4" class="content">
                            <div class="page-header">
                                <h2 class="page-title">Our Services</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="widget-title">Web Design and Development</h3>
                                    </div> <!-- /.col-md-12 -->
                                </div> <!-- /.row -->
                                <div class="row services">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-heart-o"></i>
                                                    </div>
                                                    <h4 class="service-title">HTML5 CSS3</h4>
                                                </div>
                                            </div>
                                            <div class="body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna felis, laoreet sed pulvinar mattis, aliquet non mauris.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-flask"></i>
                                                    </div>
                                                    <h4 class="service-title">Web Marketing</h4>
                                                </div>
                                            </div>
                                            <div class="body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna felis, laoreet sed pulvinar mattis, aliquet non mauris.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <h4 class="service-title">Cost Effective</h4>
                                                </div>
                                            </div>
                                            <div class="body">Download free <a rel="nofollow" href="http://www.tooplate.com">templates</a> for your websites. Nullam viverra dolor fermentum erat ullamcorper, sit amet mattis nibh tempus.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-eye"></i>
                                                    </div>
                                                    <h4 class="service-title">Retina Ready</h4>
                                                </div>
                                            </div>
                                            <div class="body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna felis, laoreet sed pulvinar mattis, aliquet non mauris.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-mobile-phone"></i>
                                                    </div>
                                                    <h4 class="service-title">Responsive</h4>
                                                </div>
                                            </div>
                                            <div class="body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna felis, laoreet sed pulvinar mattis, aliquet non mauris.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="service">
                                            <div class="header">
                                                <div class="header-bg"></div>
                                                <div class="service-header">
                                                    <div class="icon">
                                                        <i class="fa fa-cogs"></i>
                                                    </div>
                                                    <h4 class="service-title">Settings</h4>
                                                </div>
                                            </div>
                                            <div class="body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna felis, laoreet sed pulvinar mattis, aliquet non mauris.</div>
                                        </div>
                                    </div> <!-- /.col-md-4 -->
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->

                        </div> <!-- /.services -->

                        <div id="menu-5" class="content">
                            <div class="page-header">
                                <h2 class="page-title">Stay In Touch</h2>
                            </div> <!-- /.page-header -->
                            <div class="content-inner">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="widget-title">Send a message</h3>
                                        <p>Feel free to send us a message regarding this Genius HTML5 template. Pellentesque pulvinar, orci vel scelerisque suscipit, libero justo laoreet felis, ac consectetur est nisi quis ligula. Maecenas nec felis elit.</p>
                                        <div class="row contact-form">
                                            <div class="col-md-4">
                                                <label for="name-id">Your Name:</label>
                                                <input name="name-id" type="text" id="name-id" maxlength="40">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email-id">E-mail:</label>
                                                <input name="email-id" type="text" id="email-id" maxlength="40">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="subject-id">Subject:</label>
                                                <input name="subject-id" type="text" id="subject-id" maxlength="60">
                                            </div>
                                        </div> <!-- /.contact-form -->
                                        <p class="full-row">
                                            <label for="message">Message:</label>
                                            <textarea name="message" id="message" rows="6"></textarea>
                                        </p>
                                        <input class="mainBtn" type="submit" name="" value="Send Message">
                                    </div> <!-- /.col-md-8 -->
                                    <div class="col-md-4">
                                        <div class="information">
                                            <h3 class="widget-title">Information</h3>
                                            <ul class="our-location">
                                                <li><span><i class="fa fa-map-marker"></i>Address:</span>120 Nullam viverra dolor</li>
                                                <li><span><i class="fa fa-map-marker"></i>Phone:</span>010-020-0210</li>
                                                <li><span><i class="fa fa-map-marker"></i>Email:</span><a href="mailto:info@company.com">info@company.com</a></li>
                                            </ul>
                                        </div> <!-- /.information -->
                                        <div class="google-map">
                                            <h3 class="widget-title">Our Location</h3>
                                            <div class="contact-map">
                                                <div class="google-map-canvas" id="map-canvas" style="height: 200px;">
                                                </div>
                                            </div> <!-- /.contact-map -->
                                        </div> <!-- /.google-map -->
                                    </div> <!-- /.col-md-4 -->
                                </div> <!-- /.row -->
                            </div> <!-- /.content-inner -->

                        </div> <!-- /.stay-in-touch -->
                        
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
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false
          });
          $('.slidesick-mission').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false
          });
          $('.slidesick-rapportclose').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false
          });
          $('.slidesick-rapportopen').slick({
            slidesToShow: 3,
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
    header('Location: index');
}
?>
