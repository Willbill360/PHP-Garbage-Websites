<?php
session_start();

include_once('cookieconnect.php');
include_once('config.php');
?>

<html>
    <head>
            <title>G.E.P.S - Console Admin</title>
            <link rel="icon" type="image/ico" href="images/favicon.ico"/>
			<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    </head>
    <body style="background:#171717; overflow:hidden;">
    	<?php include_once("analyticstracking.php") ?>
    	<a style="z-index:-1;overflow:hidden;" href="profil?id=<?= $_SESSION['id']; ?>" class="button">Retour</a>
        <iframe style="margin-top:-5px;" src="http://craft44.crystal-serv.com:4567/" width="100%" height="101%" frameborder="0" scrolling="no"></iframe>
    </body>
</html>