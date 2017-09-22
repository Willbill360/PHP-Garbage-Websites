<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM fiches WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

?>
<?php
  if(isset($_SESSION['id'])) {

    if(isset($_POST['sup'])) {
      $delfiche = ("DELETE FROM fiches WHERE id =".$userinfo['id']);
      $bdd->exec($delfiche);
      header('Location: search');
    }

    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= 3) {
      $_GET['page'] = intval($_GET['page']);
      $pageCourante = $_GET['page'];
    } else {
      $pageCourante = 1;
    }

    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($_SESSION['id']));
    $memberinfo = $requser->fetch();

    $reqloc = $bdd->prepare('SELECT * FROM localisation WHERE id_user = ? AND serveur = ? ORDER BY id DESC');
    $reqloc->execute(array($getid, $_SESSION['serveur']));
    $reqlog = $bdd->prepare('SELECT * FROM logs WHERE id_fiche = ? AND serveur = ? ORDER BY id DESC');
    $reqlog->execute(array($getid, $_SESSION['serveur']));
    $reqtrav = $bdd->prepare('SELECT * FROM travaux WHERE id_fiche = ? AND serveur = ? ORDER BY id DESC');
    $reqtrav->execute(array($getid, $_SESSION['serveur']));

    if(isset($_POST['annul'])) {
      if(isset($_POST['hiden_id']) AND !empty($_POST['hiden_id'])) {
        $id = htmlspecialchars($_POST['hiden_id']);
        $ins = $bdd->prepare('UPDATE travaux SET statut = \'Annuler\' WHERE id = ?');
        $ins->execute(array($id));
        header('Location: fiche?id='.$userinfo['id'].'&page=2');
      }
    }
    if(isset($_POST['term'])) {
      if(isset($_POST['hiden_id']) AND !empty($_POST['hiden_id'])) {
        if(isset($_POST['paie']) AND !empty($_POST['paie'])) {
          $id = htmlspecialchars($_POST['hiden_id']);
          $paie = htmlspecialchars($_POST['paie']);
          $ins = $bdd->prepare('UPDATE travaux SET paie = ? WHERE id = ?');
          $ins->execute(array($paie, $id));
          $insstat = $bdd->prepare('UPDATE travaux SET statut = \'Terminer\' WHERE id = ?');
          $insstat->execute(array($id));
          header('Location: fiche?id='.$userinfo['id'].'&page=2');
        } else {
          $error = "Veuillez remplir le champs";
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $lang['FILE_TITLE'] ?> - Data Base CWU</title>
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
            <h2><?= $lang['FILE_OF'] ?> <?php echo $userinfo['cid']; ?></h2>
            <div class="paddtop105" style="padding-bottom:0;">
              <div class="mainleft" id="mainleft" style="height:690px;">
              <?php if($pageCourante == 1) { $count = 0;?>
                <div>
                  <img align="left" src="img/<?php if($userinfo['ployaute'] <= 19) {echo 'citoyen';}
                  else if($userinfo['ployaute'] >= 20 AND $userinfo['ployaute'] <= 39) {echo 'loyaliste';}
                  else if($userinfo['ployaute'] >= 40) {echo 'cwu';}?>.jpg" style="position:relative;" class="rank" />
                  <?php if($userinfo['panti'] >= 50) {
                    $search = 1;
                    $insertsearch = $bdd->prepare("UPDATE fiches SET search = ? WHERE id = ? AND serveur = ?");
                    $insertsearch->execute(array($search, $userinfo['id'], $_SESSION['serveur']));
                    } ?>
                  <?php if($userinfo['search'] == 1 or $userinfo['panti'] >= 50) { $count = $count + 1;?>
                    <div class="imgWrap" style="z-index: 3;">
                      <img align="left" src="img/search.png" style="position:absolute;left: 5%;" />
                      <p class="imgDescription">La PC recherche activement ce citoyen</p>
                    </div>
                  <?php } ?>
                  <?php if($userinfo['lost'] == 1) { $count = $count + 1;?>
                    <div class="imgWrap" style="z-index: 2;">
                      <img align="left" src="img/lost.png" style="position:absolute;left: 5%;<?php if($userinfo['search'] == 1 or $userinfo['panti'] >= 50) { echo "margin-top:100px;"; } ?>" />
                      <p class="imgDescription">Ce citoyen est disparu</p>
                    </div>
                  <?php } ?>
                  <?php if($userinfo['dead'] == 1) { ?>
                    <div class="imgWrap" style="z-index: 1;">
                      <img align="left" src="img/dead.png" alt="Mort" title="Mort" style="position:absolute;left: 5%;<?php if($count == 1) { echo "margin-top:100px;"; } else if($count == 2) {echo "margin-top:200px";} ?>" />
                      <p class="imgDescription">Ce citoyen est décédé</p>
                    </div>
                  <?php } ?>
                </div>
                <table class="table-wrapper" style="width: 50%;float:right;">
                  <input type="hidden" class="serverSession" data-value="<?= $_SESSION['serveur'] ?>" />
                  <tbody>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5>CID</h5></td>
                      <td class="cid1"><h5><?php echo $userinfo['cid']; ?></h5></td>
                      <td class="cid2"><h5><input type="text" class="cid" placeholder="12345" maxlength="5" style="width:100%;" value="<?php echo $userinfo['cid']; ?>"/></h5><h5 class="ciderror"><div align="center" class="ciderrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_FULLNAME'] ?></h5></td>
                      <td class="nom1"><h5><?php echo $userinfo['prenom']; ?> <?php echo $userinfo['nom']; ?></h5></td>
                      <td class="nom2"><h5><input type="text" class="prenom" placeholder="John" maxlength="255" style="float: left;border-right: 1px solid #000;" value="<?php echo $userinfo['prenom']; ?>"> <input type="text" placeholder="Doe" maxlength="255" class="nom" style="border-left: 1px solid #000;" value="<?php echo $userinfo['nom']; ?>"></h5><h5 class="nomerror"><div align="center" class="nomerrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_PLOYAUTE'] ?></h5></td>
                      <td class="ployaute1"><h5><?php echo $userinfo['ployaute']; ?></h5></td>
                      <td class="ployaute2"><h5><input type="text" class="ployaute" placeholder="0" maxlength="3" style="width:100%;" value="<?php echo $userinfo['ployaute']; ?>"/></h5><h5 class="ployauteerror"><div align="center" class="ployauteerrortxt" style="color:red;">erreur</div></h5></td>
                    </tr>
                    <tr style="background:transparent;" class="panti">
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_PANTI'] ?></h5></td>
                      <td class="panti1"><h5><?php echo $userinfo['panti']; ?></h5></td>
                    </tr>
                    <tr style="background:transparent;">
                      <td style="vertical-align:top;"><h5><?= $lang['FILE_STATUS'] ?></h5></td>
                      <?php if($userinfo['ployaute'] <= -1 or $userinfo['panti'] >= 50) {?>
                        <td><h5><?= $lang['FILE_STATUS_1'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 0 AND $userinfo['ployaute'] <= 14) {?>
                        <td><h5><?= $lang['FILE_STATUS_2'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 15 AND $userinfo['ployaute'] <= 19) {?>
                        <td><h5><?= $lang['FILE_STATUS_3'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 20 AND $userinfo['ployaute'] <= 39) {?>
                        <td><h5><?= $lang['FILE_STATUS_4'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 40 AND $userinfo['ployaute'] <= 59) {?>
                        <td><h5><?= $lang['FILE_STATUS_5'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 60 AND $userinfo['ployaute'] <=79) {?>
                        <td><h5><?= $lang['FILE_STATUS_6'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 80 AND $userinfo['ployaute'] <= 99) {?>
                        <td><h5><?= $lang['FILE_STATUS_7'] ?></h5></td>
                      <?php } else if ($userinfo['ployaute'] >= 100) {?>
                        <td><h5><?= $lang['FILE_STATUS_8'] ?></h5></td>
                      <?php }?>
                    </tr>
                  </tbody>
                </table>
                <div align="center" style="<?php if($memberinfo['grade'] != "mpf") { echo "width:50%;"; } ?>float:right;">
                  <div align="center" class="btn-box" style="float:left;">
                    <a href="search" class="img-btn return animsition-link">
                      <img align="center" src="img/left-arrow.png" style="" class="btn-img" />
                      <p><?= $lang['RETURN'] ?></p>
                    </a>
                    <a class="img-btn cancel">
                      <img align="center" src="img/cancel.png" style="" class="btn-img" />
                      <p><?= $lang['CANCEL'] ?></p>
                    </a>
                  </div>
                  <?php if($memberinfo['grade'] != "mpf") { ?>
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
                  <?php } else if($memberinfo['grade'] == "mpf") { ?>
                    <div align="center" class="btn-box" style="float:left;">
                    <a class="img-btn recomp">
                      <img align="center" src="img/recompenser.png" style="" class="btn-img" />
                      <p><?= $lang['RECOMP'] ?></p>
                    </a>
                    </div>
                    <div align="center" class="btn-box" style="float:right;">
                    <a class="img-btn reprim">
                      <img align="center" src="img/reprimander.png" style="" class="btn-img" />
                      <p><?= $lang['REPRIM'] ?></p>
                    </a>
                  </div>
                  <?php } ?>
                </div>
                <?php } else if($pageCourante == 2){ ?>
                  <h4 style="margin-top:-20px;padding-top:0;">Appartements Récents</h4>
                  <input type="hidden" class="serverSession" data-value="<?= $_SESSION['serveur'] ?>" />
                  <?php if($memberinfo['grade'] != "mpf") { ?>
                  <p style="float:left;">CCH&nbsp;</p>
                  <input type="text" class="cch" id="cch" name="cch" maxlength="3" onchange="this.value = this.value.toUpperCase();" style="text-transform:uppercase;width:50px;float:left;margin-bottom:30px;" placeholder="X" />
                  <p style="float:left;margin-left: 10px;">Étage #&nbsp;</p>
                  <input type="text" class="etg" id="etg" name="etg" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width:50px;float:left;margin-bottom:30px;" placeholder="#" />
                  <p style="float:left;margin-left: 10px;">Porte #&nbsp;</p>
                  <input type="text" class="porte" id="porte" name="porte" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width:50px;float:left;margin-bottom:30px;" placeholder="#" />
                  <div align="center" class="btn-box" style="float:right;width:50px;height:50px;margin-top:-8px;margin-right:16%;margin-bottom:30px;">
                    <a class="img-btn plus" style="width:auto;height:auto;">
                      <img align="center" src="img/plus.png" style="width:50px;margin-top:0;" class="btn-img" />
                    </a>
                  </div>
                  <h5 class="locerror"><div align="center" class="locerrortxt" style="color:red;">erreur</div></h5>
                  <?php } ?>
                  <div class="contsuperviseur" id="contsuperviseur" style="height:500px;">
                  <table class="table-wrapper">
                    <tbody>
                    <?php while($locinfo = $reqloc->fetch()) { ?>
                      <tr style="background:transparent;">
                        <?php
                          $formatloc1 = str_replace('CCH:', 'CCH:<span style="font-weight:300;">', $locinfo['localisation']);
                          $formatloc2 = str_replace('Étage #', '</span>, Étage <span style="font-weight:300;">#', $formatloc1);
                          $formatloc3 = str_replace('Porte #', '</span>, Porte <span style="font-weight:300;">#', $formatloc2);
                        ?>
                        <td><h5><?= $formatloc3 ?></h5></td>
                        <td><h5><?= $locinfo['date'] ?></h5></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                <?php } else if($pageCourante == 3 ) { ?>
                  <h4 style="margin-top:-20px;padding-top:0;">Status</h4>
                  <input type="hidden" class="serverSession" data-value="<?= $_SESSION['serveur'] ?>" />
                  <div align="center" class="souv">
                    <input type="checkbox" id="search" name="search" class="input_class_checkbox" <?php if($userinfo['search'] == 1 or $userinfo['panti'] >= 50) { echo "checked"; } ?>>
                    <label for="search" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recherché activement</label>
                  </div>
                  <div align="center" class="souv">
                    <input type="checkbox" id="lost" name="lost" class="input_class_checkbox" <?php if($userinfo['lost'] == 1) { echo "checked"; } ?>>
                    <label for="lost" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Citoyen Disparu</label>
                  </div>
                  <div align="center" class="souv">
                    <input type="checkbox" id="dead" name="dead" class="input_class_checkbox" <?php if($userinfo['dead'] == 1) { echo "checked"; } ?>>
                    <label for="dead" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Citoyen Décédé</label>
                  </div>
                   <div align="center" class="btn-box" style="margin-left: 40%;">
                   <a class="img-btn savestat">
                      <img align="center" src="img/save.png" style="" class="btn-img" />
                      <p><?= $lang['SAVE'] ?></p>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- END Left -->
        <!-- START Right -->
        <div class="colw_6 alomdebe">
          <div class="colw_12 alomdebe white paddtop105 hei100 wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s">
            <img align="right" src="img/cwu-logo-black.png" style="" class="cwu-logo" />
            <?php if($pageCourante == 1) { ?>
              <tr>
                <td style="vertical-align:top;"><h5 style="margin-top: 60px;"><?= $lang['FILE_DESC'] ?><span class="ast"> *</span></h5></td>
                <td><h5 class="desc1" style="width:100%;height:250px;overflow-y:scroll;"><?php echo htmlspecialchars_decode($userinfo['desc_phys'], ENT_NOQUOTES); ?></h5></td>
                <td><textarea class="remarquefiche desc2"><?php echo str_replace('<br/>','<br/>&#13;&#10;',htmlspecialchars_decode($userinfo['desc_phys'], ENT_NOQUOTES)); ?></textarea></td>
              </tr>
              <tr>
                <td style="vertical-align:top;"><h5 style="margin-top:30px;"><?= $lang['FILE_OBSERV'] ?><span class="ast"> *</span></h5></td>
                <td><h5 class="desc1" style="width:100%;height:250px;overflow-y:scroll;"><?php echo htmlspecialchars_decode($userinfo['observation'], ENT_NOQUOTES); ?></h5></td>
                <td><textarea class="remarquefiche observ2"><?php echo str_replace('<br/>','<br/>&#13;&#10;',htmlspecialchars_decode($userinfo['observation'], ENT_NOQUOTES)); ?></textarea></td>
              </tr>
              <span class="ast"><h5><?= $lang['FILE_AST'] ?></h5>
                <form method="POST">
                  <div align="center" class="btn-box" style="float:right;margin-top:-40px;height:50%;">
                    <input style="height: 5%;background: none;padding-top: 0;" name="sup" type="submit" class="img-btn" value="<?= $lang['FILE_DELFILE'] ?>">
                  </div>
                </form>
              </span>
              <?php } else if($pageCourante == 2){ ?>
                  <h4 style="margin-top:70px;">Travaux Récents</h4>
                  <?php if($memberinfo['grade'] != "mpf") { ?>
                  <div class="travauxrec">
                  <input type="text" class="trav" id="trav" name="trav" maxlength="255" style="float:left;margin-bottom:30px;" placeholder="Travail assigné" />
                  </div>
                  <div align="center" class="btn-box" style="float:right;width:50px;height:50px;margin-top:-8px;margin-right:16%;margin-bottom:30px;">
                    <a class="img-btn plus-trav" style="width:auto;height:auto;">
                      <img align="center" src="img/plus.png" style="width:50px;margin-top:0;" class="btn-img" />
                    </a>
                  </div>
                  <p style="color:white;">errorplacehiddenfeature</p>
                  <p> </p>
                  <h5 class="traverror"><div align="center" class="traverrortxt" style="color:red;">erreur</div></h5>
                  <?php if(isset($error)) { ?>
                    <h5><div align="center" style="color:red;"><?= $error ?></div></h5>
                  <?php } ?>
                  <?php } ?>
                  <div class="contsuperviseur" id="contsuperviseur" style="width: 100%;height:500px;">
                  <table class="table-wrapper">
                    <tbody>
                    <?php while($travinfo = $reqtrav->fetch()) { ?>
                      <tr style="background:transparent;">
                        <?php
                          //$formatloc1 = str_replace('CCH:', 'CCH:<span style="font-weight:300;">', $locinfo['localisation']);
                          //$formatloc2 = str_replace('Étage #', '</span>, Étage <span style="font-weight:300;">#', $formatloc1);
                          //$formatloc3 = str_replace('Porte #', '</span>, Porte <span style="font-weight:300;">#', $formatloc2);
                        ?>
                        <td><h5><?= $travinfo['travail'] ?> assigné par <?= $travinfo['assigneur'] ?></h5></td>
                        <td><h5>
                          <?php
                            if($travinfo['statut'] == 'Terminer') {
                          ?>
                            Paie: <?= $travinfo['paie'] ?>
                          <?php } else if($travinfo['statut'] == 'Annuler') { ?>
                            Annuler 
                          <?php } else if($travinfo['statut'] == 'En cours') { ?>
                            <form method="POST">
                              <input type="hidden" name="hiden_id" value="<?= $travinfo['id'] ?>"/>
                                <div class="trav1">
                                  <input type="text" class="paie" id="paie" name="paie" style="float:left;border:2px solid;margin-right:10px;" maxlength="255" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width:70px;border:2px solid;" placeholder="Paie" />
                                  <input type="submit" name="term" value="Terminer" class="term btn-term-ann"></input>
                                </div>
                                <div class="trav2">
                                  <a class="terminated" style="cursor: pointer;font-size: 13px;">Terminer</a>
                                  /
                                  <input type="submit" name="annul" value="Annuler" class="annul btn-term-ann"></input>
                                </div>
                            </form>
                          <?php } ?>
                        </h5></td>
                        <td><h5><?= $travinfo['date'] ?></h5></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                <?php } else if($pageCourante == 3){ ?>
                  <h4 style="margin-top:70px;">Logs Récents</h4>
                  <div class="contsuperviseur" id="contsuperviseur" style="height:550px;">
                    <table class="table-wrapper">
                      <tbody>
                        <?php while($loginfo = $reqlog->fetch()) { ?>
                          <tr style="background:transparent;">
                            <td><h5><?= $loginfo['modif'] ?> modifié par <?= $loginfo['pseudo_modifier'] ?></h5></td>
                            <td><h5><?= $loginfo['date'] ?></h5></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                <?php } ?>
              <div style="right: 50px;bottom: 60px;position:absolute;" class="page">
                 <?php
                  if($memberinfo['grade'] == "mpf" OR $memberinfo['grade'] == "adm") {
                    $c = 3;
                  } else {
                    $c = 2;
                  }
                   for($i=1;$i<=$c;$i++) {
                      if($i == $pageCourante) {
                        if($i == 1) {
                          $float = 'left';
                        } else if($i == 2) {
                          $float == 'right';
                        }
                        echo '<div class="btn-box" style="width:30px;height:30px;float:'.$float.';" align="center"><a class="button not-active page img-btn" style="vertical-align:sub;width:30px;height:30px;">'.$i.'</a></div> ';
                      } else {
                        if($i == 1) {
                          $float = 'left';
                        } else if($i == 2) {
                          $float == 'right';
                        }
                        echo '<div class="btn-box active" style="width:30px;height:30px;float:'.$float.';" align="center"><a class="button page img-btn" style="vertical-align:sub;width:30px;height:30px;" href="fiche?id='.$userinfo['id'].'&page='.$i.'">'.$i.'</a></div> ';
                      }
                   }
                  ?>
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

<?php

  $error_file_1 = $lang['FILE_ERR_1'];
  echo "var err_file_1 = '{$error_file_1}';";
  $error_file_2 = $lang['FILE_ERR_2'];
  echo "var err_file_2 = '{$error_file_2}';";
  $error_file_3 = $lang['FILE_ERR_3'];
  echo "var err_file_3 = '{$error_file_3}';";
  $error_file_4 = $lang['FILE_ERR_4'];
  echo "var err_file_4 = '{$error_file_4}';";
  $error_file_5 = $lang['FILE_ERR_5'];
  echo "var err_file_5 = '{$error_file_5}';";

?>
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
    $('.locerror').hide();
    $('.traverror').hide();
    $('.ast').hide();
    $('.page').show();
    $('.panti').show();
    $('.trav1').hide();
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
    $('.panti').hide();
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
    $('.panti').show();
  });

  $('a.save').click(function(){
      var cid = $('input.cid').val();
      var prenom = $('input.prenom').val();
      var nom = $('input.nom').val();
      var ployaute = $('input.ployaute').val();
      var desc = $('textarea.desc2').val();
      var observ = $('textarea.observ2').val();
      var serveur = $(".serverSession").data('value');
      $.ajax({ url: 'fichesave.php',
        data: {id: <?= $userinfo['id'] ?>, cid: cid, prenom: prenom, nom: nom, ployaute: ployaute, desc: desc, observ: observ, serveur: serveur},
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
  });
  $('a.plus').click(function(){
    var cch = $('input.cch').val();
    var etg = $('input.etg').val();
    var porte = $('input.porte').val();
    var serveur = $(".serverSession").data('value');
    $.ajax({ url: 'fichesave.php',
      data: {id: <?= $userinfo['id'] ?>, cch: cch, etg: etg, porte: porte, serveur: serveur},
      type: 'POST',
      success: function(output) {
        if(output == err_file_5) {
          $(".locerrortxt").html(output);
          $('.locerror').show();
        } else {
          location.reload(true);
        }
      }
    });
  });
  $('a.plus-trav').click(function(){
    var trav = $('input.trav').val();
    var serveur = $(".serverSession").data('value');
    $.ajax({ url: 'fichesave.php',
      data: {id: <?= $userinfo['id'] ?>, trav: trav, serveur: serveur},
      type: 'POST',
      success: function(output) {
        if(output == err_file_5) {
          $(".traverrortxt").html(output);
          $('.traverror').show();
        } else {
          location.reload(true);
        }
      }
    });
  });
  $('a.terminated').click(function(){
    $('.trav1').show();
    $('.trav2').hide();
  });
  $('a.recomp').click(function(){
    var serveur = $(".serverSession").data('value');
    $.ajax({ url: 'fichesave.php',
      data: {id: <?= $userinfo['id'] ?>, type: "recomp", serveur: serveur},
      type: 'POST',
      success: function(output) {
        if(output == "something") {
          $(".pluserrortxt").html(output);
          $('.pluserror').show();
        } else {
          location.reload(true);
        }
      }
    });
  });
  $('a.reprim').click(function(){
    var serveur = $(".serverSession").data('value');
    $.ajax({ url: 'fichesave.php',
      data: {id: <?= $userinfo['id'] ?>, type: "reprim", serveur: serveur},
      type: 'POST',
      success: function(output) {
        if(output == "something") {
          $(".pluserrortxt").html(output);
          $('.pluserror').show();
        } else {
          location.reload(true);
        }
      }
    });
  });
  $('a.savestat').click(function(){
    var serveur = $(".serverSession").data('value');
    if ($('#search').is(":checked"))
    {
      var search = 1;
    } else {
      var search = 0;
    }
    if ($('#lost').is(":checked"))
    {
      var lost = 1;
    } else {
      var lost = 0;
    }
    if ($('#dead').is(":checked"))
    {
      var dead = 1;
    } else {
      var dead = 0;
    }
    $.ajax({ url: 'fichesave.php',
      data: {id: <?= $userinfo['id'] ?>, search: search, lost: lost, dead: dead, serveur: serveur},
      type: 'POST',
      success: function(output) {
        if(output == "something") {
          $(".pluserrortxt").html(output);
          $('.pluserror').show();
        } else {
          location.reload(true);
        }
      }
    });
  });
</script>
<script type="text/javascript">
window.setTimeout(function(){
  $('.row').css('background', 'white');
}, 2500);
</script> 
<script type="text/javascript">
var right=$('#mainleft').height();
var left=$('#contsuperviseur').height();
var w1=$('#mainleft').width();
var w2=$('#contsuperviseur').width();
if(w1<w2)
{
    $('#mainleft').width(w2);
}
else
{
    $('#contsuperviseur').width(w1);
}
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
