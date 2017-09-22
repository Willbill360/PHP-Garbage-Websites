<?php
session_start();

include_once('config.php');

if(isset($_POST['id'], $_POST['serveur']) AND $_POST['id'] > 0 AND !empty($_POST['id']) AND !empty($_POST['serveur'])) {
   $getid = intval($_POST['id']);
   $serveur = htmlspecialchars($_POST['serveur']);

   if(isset($_POST['admin']) AND $_POST['admin'] == true) {
   		$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ? AND serveur = ?');
		$requser->execute(array($getid, $serveur));
		$userinfo = $requser->fetch();

		if(isset($_POST['action']) AND $_POST['action'] == 'delete') {
			$delfiche = ("DELETE FROM membres WHERE id =".$userinfo['id']." AND serveur =".$serveur);
      		$bdd->exec($delfiche);
      		echo 'deleted';
		} else {
			if(isset($_POST['pseudo'], $_POST['prenom'], $_POST['nom'], $_POST['mdp'])) {
				$pseudo = htmlspecialchars($_POST['pseudo']);
			   	$prenom = htmlspecialchars($_POST['prenom']);
			   	$nom = htmlspecialchars($_POST['nom']);
			   	$mdp = sha1(htmlspecialchars($_POST['mdp']));
			   	$fullname = $prenom.' '.$nom;

			   	if(!empty($prenom) AND !empty($nom)){
					if($pseudo != $userinfo['pseudo']) {
						$pseudoLenght = strlen($pseudo);
						if($pseudoLenght <= 255 AND !empty($pseudo)) {
							$reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND serveur = ?");
					        $reqpseudo->execute(array($pseudo, $serveur));
					        $pseudoexist = $reqpseudo->rowCount();
					        if($pseudoexist == 0) {
								$insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ? ANd serveur = ?");
								$insertpseudo->execute(array($pseudo, $userinfo['id'], $serveur));
								echo 'ok';
							}
							else
							{
								echo $lang['FILE_ADMIN_ERR_1'];
							}
						}
						else
						{
							echo $lang['FILE_ADMIN_ERR_2'];
						}
					}
					if($fullname != $userinfo['nom']) {
						$nomLenght = strlen($fullname);
						if($nomLenght <= 255) {
							$sql = "SELECT * FROM membres WHERE nom LIKE '%".$nom."%' AND serveur = '".$serveur."' ORDER BY id ASC";
							$reqnom = $bdd->query($sql);
				            $nomexist = $reqnom->rowCount();
				            if($nomexist == 0) {
								$insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ? AND serveur = ?");
								$insertnom->execute(array($fullname, $userinfo['id'], $serveur));
							}
							else
							{
								echo $lang['FILE_ADMIN_ERR_3'];
							}
						}
						else
						{
							echo $lang['FILE_ERR_4'];
						}
					}
					if($mdp != $userinfo['motdepasse'] AND !empty($mdp)) {
						$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ? AND serveur = ?");
						$insertmdp->execute(array($mdp, $userinfo['id'], $serveur));
					}
				}
				else
				{
					echo $lang['FILE_ERR_4'];
				}
			}
		}
   } else {
			$requser = $bdd->prepare('SELECT * FROM fiches WHERE id = ? AND serveur = ?');
			$requser->execute(array($getid, $serveur));
			$userinfo = $requser->fetch();

				if(isset($_POST['cch']) AND isset($_POST['etg']) AND isset($_POST['porte'])) {
	   		$cch = htmlspecialchars($_POST['cch']);
	   		$etg = htmlspecialchars($_POST['etg']);
	   		$porte = htmlspecialchars($_POST['porte']);
	   		if(!empty($cch) AND !empty($etg) AND !empty($porte)) {
	   			if(strlen($cch) <= 255 AND strlen($etg) <= 255 AND strlen($porte) <= 255) {
	   				$date = date('Y-m-d');
	   				$loc = "CCH: ".$cch." Étage #".$etg." Porte #".$porte;
	   				$insertloc = $bdd->prepare("INSERT INTO localisation(id_user, localisation, date, serveur) VALUES(?, ?, ?, ?)");
            $insertloc->execute(array($userinfo['id'], $loc, $date, $serveur));
            $date = date('Y-m-d');
            $modif = 'Appartement';
            $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
            $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
	   			}
	   			else
	   			{
	   				echo $lang['FILE_ERR_5'];
	   			}
	   		}
	   		else
	   		{
	   			echo $lang['FILE_ERR_5'];
	   		}
	   	} if(isset($_POST['trav'])) {
	   		$trav = htmlspecialchars($_POST['trav']);
	   		if(!empty($trav)) {
	   			if(strlen($trav) <= 255) {
	   				$date = date('Y-m-d');
	   				$inserttrav = $bdd->prepare("INSERT INTO travaux(id_fiche, travail, assigneur, paie, statut, date, serveur) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $inserttrav->execute(array($userinfo['id'], $trav, $_SESSION['nom'], 0, 'En cours', $date, $serveur));
            $date = date('Y-m-d');
            $modif = 'Travaux';
            $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
            $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
	   			}
	   			else
	   			{
	   				echo $lang['FILE_ERR_5'];
	   			}
	   		}
	   		else
	   		{
	   			echo $lang['FILE_ERR_5'];
	   		}
	   	} else {
	   		if(isset($_POST['type']) AND $_POST['type'] == "recomp") {
	   			if($userinfo['panti'] >= 0) {
		   			$newpanti = $userinfo['panti'] - 1;
		   			$insertployaute = $bdd->prepare("UPDATE fiches SET panti = ? WHERE id = ? AND serveur = ?");
						$insertployaute->execute(array($newpanti, $userinfo['id'], $serveur));
						$date = date('Y-m-d');
          	$modif = 'Récompensement';
       			$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
        		$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
        		if($userinfo['panti'] - 1 == 49) {
        			$search = 0;
        			$insertsearch = $bdd->prepare("UPDATE fiches SET search = ? WHERE id = ? AND serveur = ?");
							$insertsearch->execute(array($search, $userinfo['id'], $serveur));
        		}
				}
				echo 'ok';
	   		} else if(isset($_POST['type']) AND $_POST['type'] == "reprim") {
	   			if($userinfo['panti'] <= 1000 AND $userinfo['panti'] >= 0) {
		   			$newpanti = $userinfo['panti'] + 1;
		   			$newployaute = $userinfo['ployaute'] - 1;
		   			$insertpanti = $bdd->prepare("UPDATE fiches SET panti = ? WHERE id = ? AND serveur = ?");
						$insertpanti->execute(array($newpanti, $userinfo['id'], $serveur));
						$insertployaute = $bdd->prepare("UPDATE fiches SET ployaute = ? WHERE id = ? AND serveur = ?");
						$insertployaute->execute(array($newployaute, $userinfo['id'], $serveur));
						$date = date('Y-m-d');
        		$modif = 'Réprimende';
        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
        		$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
				}
				echo 'ok';
	   		} else {
	   			if(isset($_POST['search']) AND isset($_POST['lost']) AND isset($_POST['dead'])) {
	   				$search = intval($_POST['search']);
	   				$lost = intval($_POST['lost']);
	   				$dead = intval($_POST['dead']);
	   				if($userinfo['search'] != $search) {
	   					$insertsearch = $bdd->prepare("UPDATE fiches SET search = ? WHERE id = ? AND serveur = ?");
							$insertsearch->execute(array($search, $userinfo['id'], $serveur));
							if($userinfo['panti'] >= 50) {
								$newpanti = 49;
								$insertpanti = $bdd->prepare("UPDATE fiches SET panti = ? WHERE id = ? AND serveur = ?");
								$insertpanti->execute(array($newpanti, $userinfo['id'], $serveur));
							}
							$date = date('Y-m-d');
	        		$modif = 'Statut Recherché';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
	   				}
	   				if($userinfo['lost'] != $lost) {
	   					$insertlost = $bdd->prepare("UPDATE fiches SET lost = ? WHERE id = ? AND serveur = ?");
							$insertlost->execute(array($lost, $userinfo['id'], $serveur));
							$date = date('Y-m-d');
	        		$modif = 'Statut Disparu';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
	   				}
	   				if($userinfo['dead'] != $dead) {
	   					$insertdead = $bdd->prepare("UPDATE fiches SET dead = ? WHERE id = ? AND serveur = ?");
							$insertdead->execute(array($dead, $userinfo['id'], $serveur));
							$date = date('Y-m-d');
	        		$modif = 'Statut Décédé';
	        		$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
	        		$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
	   				}
	   				echo 'ok';
	   			} else {
				   	if(isset($_POST['cid'], $_POST['prenom'], $_POST['nom'], $_POST['ployaute'], $_POST['desc'], $_POST['observ'])) {
					   	$cid = htmlspecialchars($_POST['cid']);
					   	$prenom = htmlspecialchars($_POST['prenom']);
					   	$nom = htmlspecialchars($_POST['nom']);
					   	$ployaute = htmlspecialchars($_POST['ployaute']);
					   	$desc = htmlspecialchars($_POST['desc']);
					   	$observ = htmlspecialchars($_POST['observ']);
					   	if(!empty($prenom) AND !empty($nom)){
							if($cid != $userinfo['cid']) {
								$cidLenght = strlen($cid);
								if($cidLenght == 5 AND !empty($cid)) {
									$reqcid = $bdd->prepare("SELECT * FROM fiches WHERE cid = ? AND serveur = ?");
						        $reqcid->execute(array($cid, $serveur));
						        $cidexist = $reqcid->rowCount();
						        if($cidexist == 0) {
										$insertcid = $bdd->prepare("UPDATE fiches SET cid = ? WHERE id = ? AND serveur = ?");
										$insertcid->execute(array($cid, $userinfo['id'], $serveur));
										$date = date('Y-m-d');
		          			$modif = 'CID';
		          			$insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
		          			$insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
										echo 'ok';
									}
									else
									{
										echo $lang['FILE_ERR_1'];
									}
								}
								else
								{
									echo $lang['FILE_ERR_2'];
								}
							}
							if($prenom != $userinfo['prenom']) {
								$prenomLenght = strlen($prenom);
								if($prenomLenght <= 255) {
									$insertprenom = $bdd->prepare("UPDATE fiches SET prenom = ? WHERE id = ? AND serveur = ?");
									$insertprenom->execute(array($prenom, $userinfo['id'], $serveur));
									$date = date('Y-m-d');
					        $modif = 'Prénom';
					        $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
					        $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
								}
							}
							if($nom != $userinfo['nom']) {
								$nomLenght = strlen($nom);
								if($nomLenght <= 255) {
									$reqnom = $bdd->prepare("SELECT * FROM fiches WHERE nom = ?");
						            $reqnom->execute(array($nom));
						            $nomexist = $reqnom->rowCount();
						            if($nomexist == 0) {
										$insertnom = $bdd->prepare("UPDATE fiches SET nom = ? WHERE id = ? AND serveur = ?");
										$insertnom->execute(array($nom, $userinfo['id'], $serveur));
										$date = date('Y-m-d');
					          $modif = 'Nom';
					          $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
					          $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
									}
									else
									{
										echo $lang['FILE_ERR_3'];
									}
								}
								else
								{
									echo $lang['FILE_ERR_4'];
								}
							}
							if($ployaute != $userinfo['ployaute']) {
								$ployauteLenght = strlen($ployaute);
								if($ployauteLenght <= 3) {
									$insertployaute = $bdd->prepare("UPDATE fiches SET ployaute = ? WHERE id = ? AND serveur = ?");
									$insertployaute->execute(array($ployaute, $userinfo['id'], $serveur));
									$date = date('Y-m-d');
					        $modif = 'P. Loyauté';
					        $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
					        $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
								}
								else
								{
									echo $lang['FILE_ERR_5'];
								}
							}
							if($desc != $userinfo['desc_phys']) {
								if(empty($desc)){
									$desc = 'N/A';
								}
								$insertdesc = $bdd->prepare("UPDATE fiches SET desc_phys = ? WHERE id = ? AND serveur = ?");
								$insertdesc->execute(array($desc, $userinfo['id'], $serveur));
								$date = date('Y-m-d');
					      $modif = 'Desc. Phys.';
					      $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
					      $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
							}
							if($observ != $userinfo['observation']) {
								if(empty($observ)){
									$observ = 'N/A';
								}
								$insertobserv = $bdd->prepare("UPDATE fiches SET observation = ? WHERE id = ? AND serveur = ?");
								$insertobserv->execute(array($observ, $userinfo['id'], $serveur));
								$date = date('Y-m-d');
					      $modif = 'Observation';
					      $insertlog = $bdd->prepare("INSERT INTO logs(id_fiche, pseudo_modifier, date, serveur, modif) VALUES(?, ?, ?, ?, ?)");
					      $insertlog->execute(array($userinfo['id'], $_SESSION['pseudo'], $date, $serveur, $modif));
							}
						}
						else
						{
							echo $lang['FILE_ERR_4'];
						}
				}
				else
				{
					echo $lang['FILE_ERR_4'];
				}
			}
			}
		}
	}
}
?>
