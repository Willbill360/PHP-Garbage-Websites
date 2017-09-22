<?php
	require('JSONAPI.php');

	function preint_r($array)
	   {
	      echo '<pre>';
	      print_r($array);
	      echo '</pre>';
	      echo '<br>';
	   }
	   
	$ip = "craft44.crystal-serv.com"; // Ip du serveur
	$port = 26208; //port du plugin jsonapi(par défaut : 20059)
	$port2 = 26205; //port du serveur
	$utilisateur ="admin"; //nom d'utilisateur jsonapi
	$motdepasse ="CCa310sT5b"; //mot de passe jsonapi
	$salt ="salt";
	$timeout = "10";
	$api = new JSONAPI($ip, $port, $utilisateur, $motdepasse, $salt);
	                     
	//recup info joueur en ligne                     
	$result_getPlayers = $api->call("getPlayerCount");
	$playercount = $result_getPlayers['0']["success"];
	var_dump($result_getPlayers);

	//recup info joueur max
	$result_getPlayerLimit = $api->call("getPlayerLimit");
	$playermax = $result_getPlayerLimit['0']["success"];
	var_dump($result_getPlayerLimit);

	//joueur en ligne
	echo '<p><span style="color: #000000;">'.$playercount.'</span> / '.$playermax.'</p>';
?>