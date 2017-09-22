<?php session_start();
 
//---------------------------- Fonction pour rendre lisible un tableau de donnée (array) ---------------------------
error_reporting(0);
function preint_r($array)
{
echo '<pre>';
print_r($array);
echo '</pre>';
}
 
//--------------------------------- On teste la connection au serveur Minecraft ------------------------------------
 
$check_server = @fsockopen('craft44.crystal-serv.com', '26205', $errno, $errstr, 1);
 
//------------------------------------- On inclue le fichier JSONAPI.php -------------------------------------------
 
require('API/JsonApi/JSONAPI.php');
 
//on remplie les paramètres de connection à JSONAPI
 
$ip = 'craft44.crystal-serv.com'; // Ip du serveur
$port = 26208; //port du plugin (par défaut : 20059)
$user = 'admin'; //nom d'utilisateur
$pass = 'CCa310sT5b'; //mot de passe
$salt ='salt'; //phrase clé²
$api = new JSONAPI($ip, $port, $user, $pass, $salt);
 
//-------- fonction pour stocker les différents statut et message de nos conditions et conversion en json -------------
 
function message($status,$msg){
        $content_message = array('status'=>''.$status.'','msg'=>''.$msg.'');
        echo json_encode($content_message);
}
 
//----- Connection à la base de donnéees MYSQL pour gérer les votants (joueurs qui ont voté ou voteront) -------
include_once('config.php');

try {
   if($isLocal == true) {
        $dns = 'mysql:host=localhost;dbname=espace_membre';
        $login = 'root';
        $pass = '';
    } else {
        $dns = 'mysql:host=localhost;dbname=espace_membre';
        $login = 'root';
        $pass = '0Otfk4rNnz';
    }
 
  // Options de connection
  $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );
  $connexion_bdd = new PDO( $dns, $login, $pass, $options );
 
  $connexion_bdd->exec('CREATE TABLE IF NOT EXISTS `user_vote` ( `id` int(11) NOT NULL AUTO_INCREMENT, `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `date_vote` datetime NOT NULL, `counter_vote` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
 
} catch ( Exception $e ) {
  //echo "Connection à MySQL impossible : ", $e->getMessage();
        $msg = 'Impossible de se connecter à la base de donnée';
        message('error',$msg);
  die();
}
 
function message_error_query_bdd(){
        $msg = 'Une erreur est survenu durant le traitement de votre requête <br />';
        message('error',$msg);
}
//---------------------------- Fonction pour comparer la date du jour à une date antérieur ----------------------------
 
function compare_date($new_date,$old_date){
 
                $interval_days = (strtotime(''.$new_date.'') - strtotime(''.$old_date.''));
 
                $nbr_days = $interval_days/86400; //--- 86400 = 24h
                return $nbr_days;
}
 
//--------------------- Function pour récupérer le nombre de vote d'un service (annuaire Minecraft) --------------------
 
//Il est possible qu'un annuaire ne vous autorise pas à récupérer les votes de votre page par cette méthode
//Par exemple serveurs-minecraft.org n'autorise pas la récupération des votes pour éviter l'incitation aux votes -_-'
 
//Grâce à la magie des expressions régulières (les symboles bizarres ci-dessous :D), on récupère les compteurs de vote de chaque site :)
function get_vote($url){
    $lines = @file(''.$url.''); //on renseigne l'url souhaitée
    if($lines){
     foreach ($lines as $line_num => $line) {
            $line = strip_tags($line);
            $count = preg_match_all('/(votes|votants|total)\s?([:]?)\s?([0-9]+[0-9]?)|([0-9]+[0-9]?)\s?(votes|votants|total)/i', $line, $matches);
            for ($i = 0; $i < $count; $i++) {
            $ps[] = $matches[0][$i];
            }
        }
        
        $response = filter_var($ps[$i], FILTER_SANITIZE_NUMBER_INT);
        //var_dump($ps);
        //var_dump('Response:'.$response);
        return trim($response);
    }
    else {
        $msg = 'La récupération des votes de l’url : '.$url.' est impossible.';
        message('error',$msg);
        return false;
    }
}
 
//------- Si vous avez un système de membre sur votre site, récupérez le user de l'utilisateur qui est logué.--------
 
$user = $_SESSION['pseudo']; //on récupère l'utilisateur sans quoi aucune action ne sera faite
 
$vote = $_GET['vote']; //on stocke l'état du paramètre vote (off : aucune action de l'utilisateur | on : action de l'utilisateur)
 
$list_services = $_GET['list_services']; //on stock tous les services ainsi que leur lien pour précharger la valeur initiale des compteurs de vote présent sur chacune de leur page
 
 
if(isset($_GET['service_selected'])) {
$array_service_selected = $_GET['service_selected'];
}
 
$today = date("Y-m-d"); // on stocke la date du jour (incontournable pour la comparaison et l'enregistrement des dates)
 
//---------- on teste une requête pour vérifier la connection à JSONAPI et si l'utilisateur est renseigné --------------
 
$test_query_jsonapi = $api->call('getServer');
$state_jsonapi_and_user=false;
 
if($check_server == false){$msg = 'Désolé, mais le serveur est éteint';}
elseif(empty($test_query_jsonapi)){$msg = 'L’ip ou le port sont incorrect';}
elseif($test_query_jsonapi['0']['result'] == 'error'){$msg = 'L’utilisateur, le mot de passe ou la phrase clé comporte une erreur';}
elseif(empty($user)){$msg = 'Aucun utilisateur n’est renseigné';}
else{$state_jsonapi_and_user=true;}
 
//----- Si on rencontre un problème avec JSONAPI ou avec l'utilisateur, on envoie le message d'erreur en question ------
if($state_jsonapi_and_user==false){
                message('error',$msg);
}
 
//-------------------------------- si tout va bien, on peut commencer à travailler :) ----------------------------------
elseif($vote=='off') {
        //on trie tous les services et leur lien ; grâce à la fonction "get_vote()" on récupère la valeur de leur compteur respectif et on les stocks dans des session ($_SESSION[]) pour les comparer avec le vote de nos utilisateurs.
 
        foreach ($list_services as $key => $value) {
            //var_dump($list_services);
                $getVote = get_vote($value);    
                $_SESSION[''.$key.''] = $getVote;
        }
        if($getVote == true){
        //Ancien solde (argent disponible avant le give)
 
                $getBalance = $api->call('econ.getBalance', array(''.$user.''));
                $old_Balance = $getBalance['0']['success'];
                
                        $msg = 'Vous possédez '.$old_Balance.' <img class="money" src="images/UM.png" />';
                        message('info',$msg);
        }
}
else {
 
        foreach ($array_service_selected as $key => $value) {
                $service_selected_name = $key;
                $service_selected_link = $value;
        }
 
        //on prépare la fonction new_vote() qui vérifiera si le joueur à bien voté et procédera à l'enregistrement du vote et à l'envoi d'argent dans le jeu
 
                function new_vote($bdd_action, $bdd_counter_vote){
 
                        //pour utiliser les variables qui sont à l'extérieur de la fonction new_vote, il faut leur assigner le mot clé global
                        global $connexion_bdd, $user, $service_selected_name, $service_selected_link, $today;
 
                        function giveMoney(){
                                global $api, $user, $service_selected_name, $old_Balance;
                                $howMuch = 500;
                                $depositPlayer = $api->call("econ.depositPlayer", array(''.$user.'',''.$howMuch.''));
                                $amount = $depositPlayer['0']['success']['amount'];
                                $new_balance = $depositPlayer['0']['success']['balance'];
 
                                $msg = 'Votre vote sur '.$service_selected_name.' à bien été pris en compte. Vous avez donc recu : '.$amount.' <img class="money" src="images/UM.png" /> ! | Ancien solde : '.$old_Balance.' <img class="money" src="images/UM.png" /> | Nouveau solde : '.$new_balance.' <img class="money" src="images/UM.png" />';
                                message('ok',$msg);
 
                                $api->call("runConsoleCommand", array('mail send '.$user.' '.$amount.' UM ont été ajouté à votre compte.'));
                        }
 
                        //on vérifie quel est le service choisit par l'utilisateur et on compare les votes
 
                        $current_vote = get_vote(''.$service_selected_link.'');
                       
                        if($current_vote == true){
                            //$current_vote = $current_vote+1;
                            ($_SESSION[''.$service_selected_name.'']!=$current_vote) ? $user_voted=true : $user_voted=false;
                            //var_dump('current_vote: '.$current_vote);
                            //var_dump('Service_vote:'.$_SESSION[''.$service_selected_name.'']);
                            //var_dump('User votyed: '.$user_voted);
                            //Si l'utilisateur à bien voté, on le paie :)
                            if($user_voted == true){
     
                                    //on vérifie si c'est un nouvel enregistrement, si c'est le cas, on crée une nouvelle entrée
                                    if($bdd_action=='new'){
     
                                            $insert = $connexion_bdd->prepare('INSERT INTO user_vote VALUES( NULL, :user, :service, :date_vote, :counter_vote)');
                                            try {
                                              // On envois la requète
                                              $success = $insert->execute(array(
                                                'user'=>''.$user.'',
                                                'service'=>''.$service_selected_name.'',
                                                'date_vote'=>''.$today.'',
                                                'counter_vote'=>'1'
                                              ));
     
                                                    if( $success ) {
                                                                    giveMoney();
                                                    }
                                                   
                                            }
                                            catch( Exception $e ){
                                                    //echo 'Erreur de requète INSERT : ', $e->getMessage();
                                                    message_error_query_bdd();
                                            }
     
                                    }
                                    //Si le joueur à déjà voté pour le service que l'on a questionné plus haut, on mets à jour l'entrée en question
                                    else {
     
                                            $update = $connexion_bdd->prepare('UPDATE user_vote SET date_vote = :date_vote, counter_vote = :counter_vote WHERE user = :user AND service = :service');
                                            $counter_vote = $bdd_counter_vote+1;
                                            try {
                                              // On envois la requète
     
                                                    $success = $update->execute(array(
                                                            'date_vote'=>''.$today.'',
                                                            'counter_vote'=>''.$counter_vote.'',
                                                        'user'=>''.$user.'',
                                                        'service'=>''.$service_selected_name.''        
                                                    ));
     
                                                    if( $success ) {
                                                                    giveMoney();
                                                    }
     
                                            }
                                            catch( Exception $e ){
                                                    //echo 'Erreur de requète UPDATE : ', $e->getMessage();
                                                    message_error_query_bdd();
                                            }
     
                                    }
     
                            }
                            else {
                                    $msg = 'Il semble que vous n’ayez pas voté, vous ne serez donc pas payé :)';
                                    message('warning',$msg);
                            }
                        } // fin de la vérification de la validité de la variable $current_vote
                }
 
                try {
 
                $args = ' user_vote WHERE user="'.$user.'" AND service="'.$service_selected_name.'" ';
 
                //on vérifie si le joueur à déjà voté pour le service en question et si oui, on vérifie la date
                $nRows = $connexion_bdd->query(' select count(*) from '.$args.' ')->fetchColumn();
 
                        if($nRows==1){
 
                                  $select = $connexion_bdd->query(' select * from '.$args.' ');
                                  $select->setFetchMode(PDO::FETCH_OBJ);
                                  $data = $select->fetch();
 
                                  $old_date =  $data->date_vote;
 
                                        //on récupère l'ancienne date et on la compare avec celle du jour    
                                        $days = compare_date($today,$old_date);
 
                                        //le joueur n'a le droit de voter qu'une seule fois par jour et par service, si il tente de voter une
                                        //seconde fois pour gagner plus d'argent, il ne pourra pas car il faut 1 journée d'interval minimum.
                                        if($days==0){
                                                        $msg = 'Vous avez déjà voté pour '.$service_selected_name.' aujourd’hui, recommencer demain :)';
                                                        message('warning',$msg);
                                        }
                                        else{
                                        $counter_vote = $data->counter_vote;
                                                new_vote("update", $counter_vote);
                                        }
 
                        }
 
                        else{
                                new_vote("new", NULL);
                        }
                }
                catch ( Exception $e ) {
                        //echo 'Erreur de requète : ', $e->getMessage();
                        message_error_query_bdd();
                }
 
}
?>