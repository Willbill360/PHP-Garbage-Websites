<?php
if(!isset($_SESSION['id']) AND isset($_COOKIE['nom']) AND isset($_COOKIE['password']) AND !empty($_COOKIE['nom']) AND !empty($_COOKIE['password']))
{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND motdepasse = ?");
		$requser->execute(array($_COOKIE['nom'], $_COOKIE['password']));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['nom'] = $userinfo['nom'];
			$_SESSION['grade'] = $userinfo['grade'];
			header("Location: tableau-de-bord?id=".$_SESSION['id']);
		}
}

?>