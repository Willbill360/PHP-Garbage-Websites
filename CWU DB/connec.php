<?php
session_start();
ob_start();
include_once('config.php');

if(isset($_POST['nom']) AND !empty($_POST['nom'])) {
	$fullname = htmlspecialchars($_POST['nom']);

	if(isset($_POST['pass']) AND !empty($_POST['pass'])) {
		$pass = sha1(htmlspecialchars($_POST['pass']));
		if(isset($_POST['admin']) AND $_POST['admin'] == 1) {
			$requser = $bdd->prepare("SELECT * FROM admins WHERE mail = ? AND motdepasse = ?");
		    $requser->execute(array($fullname, $pass));
		    $userexist = $requser->rowCount();
		    if($userexist == 1){
		    	$userinfo = $requser->fetch();
		    	$_SESSION['id'] = $userinfo['id'];
			    $_SESSION['pseudo'] = $userinfo['pseudo'];
			    $_SESSION['nom'] = $userinfo['nom'];
			    $_SESSION['grade'] = $userinfo['grade'];
			    $_SESSION['serveur'] = $userinfo['serveur'];
			    echo 'okpass,'.$userinfo['id'].',';
		    }
		    else
		    {
		    	echo $lang['LOGIN_ERR_MDP_1'];
		    }
		} else {
			$fichiermdp = fopen('specialmdp.txt', 'r+');
	    $specialmdp = fgets($fichiermdp);
	    fclose($fichiermdp);
	    if($pass == sha1(htmlspecialchars($specialmdp))) {
	    	$_SESSION['id'] = 53;
			  $_SESSION['pseudo'] = 'root';
			  $_SESSION['nom'] = 'root';
			  $_SESSION['grade'] = 'root';
			  $_SESSION['serveur'] = 'any';
	    	echo 'okroot,';
	    } else {
				$requser = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND motdepasse = ?");
		    $requser->execute(array($fullname, $pass));
		    $userexist = $requser->rowCount();
		    if($userexist == 1)
		    {
		    	if(isset($_POST['souv']) AND $_POST['souv'] == 1) {
		    		setcookie('password', $pass, time() + 365*24*3600, '/', null, false, true);
	        		setcookie('nom', $fullname, time() + 365*24*3600, '/', null, false, true);
		    	}
		    	$userinfo = $requser->fetch();
		    	$_SESSION['id'] = $userinfo['id'];
			    $_SESSION['pseudo'] = $userinfo['pseudo'];
			    $_SESSION['nom'] = $userinfo['nom'];
			    $_SESSION['serveur'] = $userinfo['serveur'];
		    	echo 'okpass,'.$userinfo['id'].',';
		    }
		    else
		    {
		    	echo $lang['LOGIN_ERR_MDP_1'];
		    }
			}
		}
	}
		if (filter_var($fullname, FILTER_VALIDATE_EMAIL)) {
	    	$reqnom = $bdd->prepare("SELECT * FROM admins WHERE mail = ?");
			$reqnom->execute(array($fullname));
			$nomexist = $reqnom->rowCount();
			if($nomexist == 1) {
				echo 'okuser';
			}
			else
			{
				echo $lang['LOGIN_ERR_EMAIL_1'];
			}
		} else {
		    $name = preg_split("[\s]",$fullname);
			$nameCount = count($name);
			if($nameCount == 2) {
				$reqnom = $bdd->prepare("SELECT * FROM membres WHERE nom = ?");
			    $reqnom->execute(array($fullname));
			    $nomexist = $reqnom->rowCount();
			    if($nomexist == 1) {
					echo 'okuser';
				}
				else
				{
					echo $lang['LOGIN_ERR_NAME_1'];
				}
			}
			else if ($nameCount == 1 AND $fullname == "root") {
				echo 'okuser2';
			} 
			else
			{
				echo $lang['LOGIN_ERR_NAME_2'];
			}
		}
	}

?>
