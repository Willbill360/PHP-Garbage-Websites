<?php
error_reporting(0);
$id = 2504017;
if (isset($_POST ['launch'])) {
	$x = 0;
	if(isset($_POST['id'])) {
		$id = htmlspecialchars($_POST['id']);
	}
	for ($x = 0; $x <= 50; $x++) {
		$id = $id+1;
		// L'url du fichier
		$url = 'http://choix.csphares.qc.ca/Dossiers/Photos/'.$id.'.jpg';
		// Le chemin de sauvegarde
		$path = 'theimage';
		// On coupe le chemin
		$exp = explode('/',$url);
		// On recup l'adresse du serveur
		$serv = $exp[0].'//'.$exp[2];
		// On recup le nom du fichier
		$name = array_pop($exp);
		// On genere le contexte (pour contourner les protections anti-leech)
		$xcontext = stream_context_create(array("http"=>array("header"=>"Referer: ".$serv."\r\n")));
		// On tente de recuperer l'image
		$content = file_get_contents($url,false,$xcontext);
		if ($content === false) {
		  //echo "\nPhoto introuvable.<br/>";
		} else {
			// Sinon, si c'est bon, on sauvegarde le fichier
			/*$test = file_put_contents($path.'/'.$name,$content);
			if ($test === false) {
			  echo "\nImpossible de sauvegarder le fichier.";
			  exit(1);
			} */
			// Tout est OK
			//echo "\nPhoto trouvé.<br/>";
			echo "<br/><img style=\"width:300px:heigth:360px;\" src=\"".$url."\"/><br/>";
			echo "N° de fiche: ".$id."<br/>";
		}
	}
}
?>
<form style="margin-left:30px;" method="post" action="">
	<br/><input type="text" name="id" value="<?php if(isset($id)){echo $id;}?>"/><br/><br/>
	<input type="submit" name="launch" />
</form>