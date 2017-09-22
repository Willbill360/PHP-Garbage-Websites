<?php
 
function preint_r($array)
{
echo '<pre>';
print_r($array);
echo '</pre>';
}
 
/*$lines = file('http://www.liste-serveurs-minecraft.org/server.php?id=922'); //on renseigne l'url souhaitée
foreach ($lines as $line_num => $line) {
        $count = preg_match_all('/([0-9]+)\s(votes|votants)/i', $line, $matches);
        for ($i = 0; $i < $count; ++$i) {
        $ps[] = strip_tags(($matches[0][$i]));
 
        }
    }*/
$lines = file('http://minecraftservers.org/server/366522'); //on renseigne l'url souhaitée
 
 foreach ($lines as $line_num => $line) {
        $line = strip_tags($line);
        $count = preg_match_all(' /(votes|votants)\s?([:]?)\s?([0-9]+([\.]?[0-9]+))|([0-9]+([\.]?[0-9]+))\s?(votes|votants)/i', $line, $matches);
        for ($i = 0; $i < $count; ++$i) {
        $ps[] = $matches[0][$i];
 
        }
    }    
 
echo filter_var($ps[0], FILTER_SANITIZE_NUMBER_INT); //on nettoie le résultat des caractères alphabétiques pour ne retenir que le chiffre
 
/*
echo '--------------------------------------------------------------------------------------';
 
libxml_use_internal_errors(true);
$dom = new DomDocument;
$dom->loadHTMLFile("http://www.liste-serveurs-minecraft.org/server.php?id=922");
$xpath = new DomXPath($dom);
$nodes = $xpath->query("//table[@class='serverdata w300']/tbody/tr/td");
header("Content-type: text/plain");
foreach ($nodes as $i => $node) {
    $array[] = $node->nodeValue;
}
preint_r($array);
echo filter_var($array[14], FILTER_SANITIZE_NUMBER_INT);
 
/*Vieux filtre
 
function get_vote($url,$findLineVote){
 
    $lines = file($url);
foreach ($lines as $line_num => $line) {
        $count = preg_match_all('/<.*?>(.*?)<\/.*?>/is', $line, $matches);
        for ($i = 0; $i < $count; ++$i) {
        $ps[] = strip_tags(($matches[0][$i]));
        }
    }
return filter_var($ps[$findLineVote], FILTER_SANITIZE_NUMBER_INT);
}*/
?>