<?php
session_start();
include_once('config.php');
ob_start();

if(isset($_POST['pseudo'], $_POST['email'], $_POST['mdp'], $_POST['serveur'], $_POST['time'])) {
  if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['serveur']) AND !empty($_POST['time'])) {
    ob_end_clean();
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['email']);
    $mdp = sha1(htmlspecialchars($_POST['mdp']));
    $serveur = strtolower(htmlspecialchars($_POST['serveur']));
    $time = htmlspecialchars($_POST['time']);

    if(is_numeric($time)){
    $reqserv = $bdd->prepare("SELECT * FROM abonnement WHERE serveur = ?");
    $reqserv->execute(array($serveur));
    $servexist = $reqserv->rowCount();
    if($servexist == 0) {
      echo 'ok';
    }
    else
    {
      echo 'Ce serveur est déjà inscrit';
    }
  }
  else
  {
     echo htmlspecialchars('Le nombre de mois n\'est pas numérique');
  }
  }
  else
  {
    echo 'Tous les champs doivent être rempli';
  }

} else if (isset($_POST['month'])) {
  $date = date('Y-m-d');
  $enddate = date('Y-m-d',strtotime('+'.htmlspecialchars($_POST['month']).' month',strtotime($date)));
  echo $date.','.$enddate;
}
?>
