<?php
/******************************************************************************/
/*                                                                            */
/*                       __        ____                                       */
/*                 ___  / /  ___  / __/__  __ _____________ ___               */
/*                / _ \/ _ \/ _ \_\ \/ _ \/ // / __/ __/ -_|_-<               */
/*               / .__/_//_/ .__/___/\___/\_,_/_/  \__/\__/___/               */
/*              /_/       /_/                                                 */
/*                                                                            */
/*                                                                            */
/******************************************************************************/
/*                                                                            */
/* Titre          : Création d'un channel temporaire/permanent TeamSpeak3     */
/*                                                                            */
/* URL            : http://www.phpsources.org/scripts661-PHP.htm              */
/* Auteur         : lovenunu                                                  */
/* Date édition   : 17 Aout 2012                                              */
/*                                                                            */
/******************************************************************************/


// On démarre le système de session pour transmettre des variables à travers les
// pages simplement
session_start();

// Configuration
$login="serveradmin"; // Login d'un utilisateur query
$password= "zxW21Y2i"; // Pass de cet utilisateur
$ip="ts.mcgeps.ca"; // Ip ou nom de domaine du serveur
$portquery="10011"; // Port du serveur query
$portserver="9987"; // Port du serveur TS
//-----------------

// On utilise les fonctions gen_tokken() et anti_brute() de la classe security
class security {

    public function get_real_ip() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }
    
    function gen_tokken() {
        $gen = strval(time()*9365*rand(10000000000000,1000000000000000)); 
$tokken = "";
        for($i=0; $i<strlen($gen);$i++) $tokken.=sprintf("%02X", ord(substr($gen
, $i, 1)));
        return $tokken;
    }

    public function read_file($file) {
        $file = fopen($file, 'r');
        $buf = "";
        while($line = fgets($file)) {
            $buf.=$line;
        }
        fclose($file);
        return $buf;
    }
    
    public function write_file($file, $text) {
        file_exists($file) ? unlink($file): $ret=1;
        $file = fopen($file, 'a');
        fputs($file, $text);
        fclose($file);
        return TRUE;
    }

    public function anti_brute($rep, $lim) {
        if(!is_dir($rep)) mkdir($rep);
        $file=$rep.'/'.$this->get_real_ip();
        if(file_exists($file)) {
            $tmp = $this->read_file($file);
            $tmp = explode("-", $tmp);
            $i = $tmp[0]; $time = $tmp[1];
            
            if($time <= (time()-(600))) { // 10min
                unlink($file);
                $this->anti_brute($rep, $lim);
            }
            
            if($i < $lim) {
                $this->write_file($file, ($i+1)."-".time());
            } else if($i >= $lim) {
                $this->write_file($file, $lim."-".time());
                die("Security error | Limit: ".$lim." reached");
            }
        } else {
            $this->write_file($file, "1-".time());
        }
        
        return TRUE;
    }
}

//-----------------

//Import du framework TS3
require_once("./TeamSpeak3/TeamSpeak3.php");

// On initial ts
TeamSpeak3::init();
// On se connecte en query
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$login.":".$password.
"@".$ip.":".$portquery."/?server_port=".$portserver);

// On créé un objet security() pour pouvoir utiliser les fonctions
// d'anti-bruteforce et le générateur de tokken
$s = new security();

// TEMP ONLY
// On lit la liste des membres
$clist = $ts3_VirtualServer->clientList();
$clientsNames = array(); // Buffer
$keys = array_keys($clist); // On stock les clés de $clist
for($i=0; $i<count($keys);$i++) { 
// A chaque clé, on stock le nom du client de $clientsNames[]
    $tmp = $clist[$keys[$i]];
    $clientsNames[] = $tmp->client_nickname;
}
// -----------

// On récupère et accèpte les variables du formulaire que si elle ne contiennen
// que des lettres ou des chiffres
$name = (isset($_POST['name']) and !empty($_POST['name'])) ? $_POST['name'] : 
FALSE;
$topic = (isset($_POST['topic']) and !empty($_POST['topic'])) ? $_POST['topic'] 
: FALSE;
$tokken = (isset($_POST['tokken']) and !empty($_POST['tokken'])) ? $_POST[
'tokken'] : FALSE;
// TEMP ONLY
$loginname = (isset($_POST['login']) and !empty($_POST['login'])) ? $_POST[
'login']: FALSE;
// ----------

// On défini malgré tout la session tokken, pour éviter des problèmes.
if(!isset($_SESSION['tokken'])) $_SESSION['tokken']="a";
$tok = &$_SESSION['tokken']; 
// On crée une variable $tok qui pointe sur $_SESSION['tokken'], ca simplifie
// l'écriture.


// Si le nom, le top et le tokken sont bon, on peut créer le chan.
if($topic and $tok == $tokken and $loginname) {

    // On utilise l'anti-bruteforce pour éviter le flood de création de chans.
    $s->anti_brute("antibrute_ts", 2);
    
    // TEMP ONLY
    if(in_array($loginname, $clientsNames)) { 
// Si le nom est dans $clientsNames, le membre est connecté.
        // On récupère l'objet des infos de l'utilisateur
        $node = $ts3_VirtualServer->clientGetByName($loginname); 
        // On récupère l'id de l'utilisateur
        $clid = $node->getId();
    // ----------
    
        // On crée le channel
        $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => $name,
        "channel_topic" => $topic,
        "channel_codec" => TeamSpeak3::CODEC_SPEEX_WIDEBAND,
        "channel_flag_permanent" => FALSE));    
        
        // TEMP ONLY
        
// Et on bouge l'utilisateur dedans pour éviter que le channel ne soit détruit
        $ts3_VirtualServer->clientMove($clid, $cid);
        // ---------
        
        // My work here is done
        die("Chan créé: ". $name .
        " <br/> Topic: ". $topic .
        " <br/> <a href='/'> Retour à l'accueil </a>");
        
    // TEMP ONLY
    } else {
        $tok = $s->gen_tokken();
        $errorlogin = "Vous n'êtes pas connecté";
    }
    // ----------
}
// Sinon on génére un nouveau tokken.
else {
    $tok = $s->gen_tokken();
}
?>

<html>

<head>
    <title> Test </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
    
    <form action="./form.php" method="post" id="form_create">
    <!-- TEMP ONLY -->
    <?php if(isset($errorlogin)) { ?>
    <span style="red"> <?php print $errorlogin; ?> </span>
    <?php } ?>
    <label for="login"> Login </label>
    <input type="text" name="login" value="<?php if($login) print $login; ?>
"/><br/>
    <!--  -->
    
    <?php if(!$name and isset($_POST['name'])) { ?>
    <span style="red"> Erreur dans le nom </span>
    <?php } ?>
    <label for="name"> Nom du channel </label>
    <input type="text" name="name" value="<?php if($name) print $name; ?>" />
    <br/>

    <?php if(!$topic and isset($_POST['topic'])) { ?>
    <span style="red"> Erreur dans le topic </span>
    <?php } ?>
    <label for="topic"> Topic du channel </label>
    <input type="text" name="topic" value="<?php if($topic) print $topic; ?>" />
    <br/>
    
    <input type="hidden" name="tokken" value="<?php print $tok; ?>" />
    </form>
    
    <a href="#" onclick="javascript: document.forms['form_create'].submit();">
 Envoyer le formulaire </a>
</body>

</html>