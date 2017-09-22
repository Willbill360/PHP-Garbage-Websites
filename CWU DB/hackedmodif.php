<?php
session_start();

include_once('config.php');
include('cookieconnect.php');

if(isset($_SERVER['HTTP_REFERER'])) {
	if(isset($_SESSION['id']) AND $_SESSION['id'] == 53 AND isset($_SESSION['mrest'])) {
		if(isset($_GET['act']) AND isset($_GET['type']) AND isset($_GET['id'])) {
			$action = htmlspecialchars($_GET['act']);
			$type = htmlspecialchars($_GET['type']);
			$id = htmlspecialchars($_GET['id']);
				if ($type == 'rem') {
					$reqfiche = $bdd->prepare("SELECT * FROM fiches WHERE cid = ?");
					$reqfiche->execute(array($id));
					$ficheexist = $reqfiche->rowCount();
					if($ficheexist == 1)
					{
						$ficheinfo = $reqfiche->fetch();
						if ($action == 'search') {
							$remsearch = $bdd->prepare("UPDATE fiches SET search = 0 WHERE cid =".$id);
							$remsearch->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Rechercher';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							//$delcat = ("DELETE FROM f_categories WHERE id =".$id);
							//$bdd->exec($delcat);
							header("Location: hackedsearch");
						} else if ($action == 'lost') {
							$remlost = $bdd->prepare("UPDATE fiches SET lost = 0 WHERE cid =".$id);
							$remlost->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Disparu';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							header("Location: hackedsearch");
						} else if ($action == 'dead') {
							$remdead = $bdd->prepare("UPDATE fiches SET dead = 0 WHERE cid =".$id);
							$remdead->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Décédé';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							header("Location: hackedsearch");
						} else if ($action == 'panti') {
							$rempanti = $bdd->prepare("UPDATE fiches SET panti = 0 WHERE cid =".$id);
							$rempanti->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Point d\'Anti-Citoyenneté';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							header("Location: hackedsearch");
						}
					}
				} else if ($type == 'add') {
					$reqfiche = $bdd->prepare("SELECT * FROM fiches WHERE cid = ?");
					$reqfiche->execute(array($id));
					$ficheexist = $reqfiche->rowCount();
					if($ficheexist == 1)
					{
						$ficheinfo = $reqfiche->fetch();
						if ($action == 'search') {
							$addsearch = $bdd->prepare("UPDATE fiches SET search = 1 WHERE cid =".$id);
							$addsearch->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Recherché';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							//$delcat = ("DELETE FROM f_categories WHERE id =".$id);
							//$bdd->exec($delcat);
							header("Location: hackedsearch");
						} else if ($action == 'lost') {
							$addlost = $bdd->prepare("UPDATE fiches SET lost = 1 WHERE cid =".$id);
							$addlost->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Disparu';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							header("Location: hackedsearch");
						} else if ($action == 'dead') {
							$adddead = $bdd->prepare("UPDATE fiches SET dead = 1 WHERE cid =".$id);
							$adddead->execute(array($id));
							$date = date('Y-m-d');
	        		$modif = 'Décédé';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($ficheinfo['id'], 'root', $date, 'uwg', $modif));
	        		$_SESSION['mrest'] = $_SESSION['mrest'] - 1;
							header("Location: hackedsearch");
						}
					}
				} else {
					echo 'not found';
					echo $action."/";
					echo $type."/";
					echo $id."/";
				}
		}
		else
		{
			echo 'Erreur ation, type ou id manquant !';
		}
	}
	else
	{
		header("Location: index");
	}
}
else
{
	header("Location: index");
}
?>
