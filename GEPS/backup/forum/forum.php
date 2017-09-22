<?php
require('php/config.php'); /* Contient la connexion à la $bdd */
require('php/functions.php'); /* Mes fonctions */
$categories = $bdd->query('SELECT * FROM f_categories ORDER BY ord_id');
$subcat = $bdd->prepare('SELECT * FROM f_sous_categories WHERE id_categorie = ? ORDER BY ord_id');
require('views/forum.view.php');
?>