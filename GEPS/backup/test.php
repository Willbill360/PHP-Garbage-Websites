<?php 
gen_name();
	function gen_name($nb_caractere = 5)
	{
			global $mot_de_passe;
	        $mot_de_passe = "";
	       
	        $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
	        $longeur_chaine = strlen($chaine);
	       
	        for($i = 1; $i <= $nb_caractere; $i++)
	        {
	            $place_aleatoire = mt_rand(0,($longeur_chaine-1));
	            $mot_de_passe .= $chaine[$place_aleatoire];
	        }

	        return $mot_de_passe;
	}

if(isset($mot_de_passe))
{
	echo $mot_de_passe;
}
?>
<form method="POST" action="">
	<li><input name="gen" type="submit" value="Generate" class="special" /></li>
</form>