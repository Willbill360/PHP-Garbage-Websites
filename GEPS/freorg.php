<?php
session_start();

include_once('config.php');

if($isLocal == true) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
} else {
	$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u924407628_mbre', 'u924407628_geps', '0Otfk4rNnz');
}

include('cookieconnect.php');

if(isset($_SESSION['grade']) AND $_SESSION['grade'] == 1) {
	if(isset($_GET['act']) AND isset($_GET['type']) AND isset($_GET['id'])) {
		$action = htmlspecialchars($_GET['act']);
		$type = htmlspecialchars($_GET['type']);
		$id = htmlspecialchars($_GET['id']);

			if ($type == 'cat') {
				$reqcat = $bdd->prepare("SELECT * FROM f_categories WHERE id = ?");
				$reqcat->execute(array($id));
				$catexist = $reqcat->rowCount();
				if($catexist == 1)
				{
					$cat = $reqcat->fetch();
					if ($action == 'del') {
						$delcat = ("DELETE FROM f_categories WHERE id =".$id);
						$bdd->exec($delcat);
						header("Location: admin-forum");
					} else if ($action == 'lock') {
						$sql = "UPDATE f_categories SET status = 'close' WHERE id = ".$cat['ord_id'];
						$insertcat1 = $bdd->exec($sql);
						header("Location: admin-forum");
					} else if ($action == 'unlock') {
						$sql = "UPDATE f_categories SET status = 'open' WHERE id = ".$cat['ord_id'];
						$insertcat1 = $bdd->exec($sql);
						header("Location: admin-forum");
					} else if ($action == 'up') {
						if ($cat['ord_id'] != 1) {
							$upid = $cat['ord_id'] - 1;
							$tempid = 0;
							$newupid = $cat['ord_id'];
							$sql = "UPDATE f_categories SET temp_id = ".$cat['ord_id']. " WHERE ord_id = ".$upid;
							$insertcat1 = $bdd->exec($sql);
							echo 'ad-done1:';
							$sql2 = "UPDATE f_categories SET temp_id = ".$upid. " WHERE ord_id = ".$cat['ord_id'];
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done2:';
					    	$reqtid = $bdd->query("SELECT temp_id FROM f_categories WHERE temp_id =".$upid);
					    	$temp_id = $reqtid->fetch();
							$sql2 = "UPDATE f_categories SET ord_id = ".$temp_id['temp_id']. " WHERE temp_id = ".$upid;
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done3:';
					    	$reqtid2 = $bdd->query("SELECT temp_id FROM f_categories WHERE temp_id =".$cat['ord_id']);
					    	$temp_id2 = $reqtid2->fetch();
							$sql3 = "UPDATE f_categories SET ord_id = ".$temp_id2['temp_id']. " WHERE temp_id = ".$cat['ord_id'];
							$insertcat2 = $bdd->exec($sql3);
							echo ':ad-done4';
							header("Location: admin-forum");
						} else {
							header("Location: admin-forum");
						}
					} else if ($action == 'down') {
						$reqid = $bdd->query('SELECT ord_id FROM f_categories ORDER BY ord_id DESC LIMIT 1');
						while($theid = $reqid->fetch()) {
							$lastid = $theid['ord_id'];
						}
						if ($cat['ord_id'] != $lastid) {
							$upid = $cat['ord_id'] + 1;
							$tempid = 0;
							$newupid = $cat['ord_id'];
							$sql = "UPDATE f_categories SET temp_id = ".$cat['ord_id']. " WHERE ord_id = ".$upid;
							$insertcat1 = $bdd->exec($sql);
							echo 'ad-done1:';
							$sql2 = "UPDATE f_categories SET temp_id = ".$upid. " WHERE ord_id = ".$cat['ord_id'];
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done2:';
					    	$reqtid = $bdd->query("SELECT temp_id FROM f_categories WHERE temp_id =".$upid);
					    	$temp_id = $reqtid->fetch();
							$sql2 = "UPDATE f_categories SET ord_id = ".$temp_id['temp_id']. " WHERE temp_id = ".$upid;
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done3:';
					    	$reqtid2 = $bdd->query("SELECT temp_id FROM f_categories WHERE temp_id =".$cat['ord_id']);
					    	$temp_id2 = $reqtid2->fetch();
							$sql3 = "UPDATE f_categories SET ord_id = ".$temp_id2['temp_id']. " WHERE temp_id = ".$cat['ord_id'];
							$insertcat2 = $bdd->exec($sql3);
							echo ':ad-done4';
							header("Location: admin-forum");
						} else {
							header("Location: admin-forum");
						}
					} else {
						header("Location: admin-forum");
					}
				} else {
					echo 'not found';
				}
			} else if ($type == 'subcat') {
				$reqscat = $bdd->prepare("SELECT * FROM f_sous_categories WHERE id = ?");
				$reqscat->execute(array($id));
				$scatexist = $reqscat->rowCount();
				if($scatexist == 1)
				{
					$scat = $reqscat->fetch();
					if ($action == 'del') {
						$delscat = ("DELETE FROM f_sous_categories WHERE id =".$id);
						$bdd->exec($delscat);
						header("Location: admin-forum");
					} else if ($action == 'up') {
						if ($scat['ord_id'] != 1) {
							$upid = $scat['ord_id'] - 1;
							$tempid = 0;
							$newupid = $scat['ord_id'];
							$sql = "UPDATE f_sous_categories SET temp_id = ".$scat['ord_id']. " WHERE ord_id = ".$upid;
							$insertcat1 = $bdd->exec($sql);
							echo 'ad-done1:';
							$sql2 = "UPDATE f_sous_categories SET temp_id = ".$upid. " WHERE ord_id = ".$scat['ord_id'];
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done2:';
					    	$reqtid = $bdd->query("SELECT temp_id FROM f_sous_categories WHERE temp_id =".$upid);
					    	$temp_id = $reqtid->fetch();
							$sql2 = "UPDATE f_sous_categories SET ord_id = ".$temp_id['temp_id']. " WHERE temp_id = ".$upid;
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done3:';
					    	$reqtid2 = $bdd->query("SELECT temp_id FROM f_sous_categories WHERE temp_id =".$scat['ord_id']);
					    	$temp_id2 = $reqtid2->fetch();
							$sql3 = "UPDATE f_sous_categories SET ord_id = ".$temp_id2['temp_id']. " WHERE temp_id = ".$scat['ord_id'];
							$insertcat2 = $bdd->exec($sql3);
							echo ':ad-done4';
							header("Location: admin-forum");
						} else {
							header("Location: admin-forum");
						}
					} else if ($action == 'down') {
						$reqid = $bdd->query('SELECT ord_id FROM f_sous_categories ORDER BY ord_id DESC LIMIT 1');
						while($theid = $reqid->fetch()) {
							$lastid = $theid['ord_id'];
						}
						if ($scat['ord_id'] != $lastid) {
							$upid = $scat['ord_id'] + 1;
							$tempid = 0;
							$newupid = $scat['ord_id'];
							$sql = "UPDATE f_sous_categories SET temp_id = ".$scat['ord_id']. " WHERE ord_id = ".$upid;
							$insertcat1 = $bdd->exec($sql);
							echo 'ad-done1:';
							$sql2 = "UPDATE f_sous_categories SET temp_id = ".$upid. " WHERE ord_id = ".$scat['ord_id'];
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done2:';
					    	$reqtid = $bdd->query("SELECT temp_id FROM f_sous_categories WHERE temp_id =".$upid);
					    	$temp_id = $reqtid->fetch();
							$sql2 = "UPDATE f_sous_categories SET ord_id = ".$temp_id['temp_id']. " WHERE temp_id = ".$upid;
							$insertcat2 = $bdd->exec($sql2);
							echo ':ad-done3:';
					    	$reqtid2 = $bdd->query("SELECT temp_id FROM f_sous_categories WHERE temp_id =".$scat['ord_id']);
					    	$temp_id2 = $reqtid2->fetch();
							$sql3 = "UPDATE f_sous_categories SET ord_id = ".$temp_id2['temp_id']. " WHERE temp_id = ".$scat['ord_id'];
							$insertcat2 = $bdd->exec($sql3);
							echo ':ad-done4';
							header("Location: admin-forum");
						} else {
							header("Location: admin-forum");
						}
					} else {
						header("Location: admin-forum");
					}
				} else {
					echo 'not found';
				}
			}
	}
	else
	{
		echo 'Erreur ation, type ou id manquant !';
	}
}
else
{
	header("Location: connexion");
}
?>