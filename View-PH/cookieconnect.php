<?php
if(!isset($_SESSION['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password']))
{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($_COOKIE['email'], $_COOKIE['password']));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['fnumber'] = $userinfo['fnumber'];
			$_SESSION['mail'] = $userinfo['mail'];
			$_SESSION['grade'] = $userinfo['grade'];
			$_SESSION['total'] = $userinfo['total'];
			header("Location: profil?id=".$_SESSION['id']);

			$line = "[".date('Y-m-d] [H:i:s') . "] - $_SERVER[REMOTE_ADDR]";
			file_put_contents('connexion.log', $line . PHP_EOL, FILE_APPEND);
		}
}

?>