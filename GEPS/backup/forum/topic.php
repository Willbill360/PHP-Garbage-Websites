<?php
require('php/config.php');
require('php/functions.php');
require_once('../API/jBBcode/Parser.php');
if(isset($_GET['titre'],$_GET['id']) AND !empty($_GET['titre']) AND !empty($_GET['id'])) {
   $get_titre = htmlspecialchars($_GET['titre']);
   $get_id = htmlspecialchars($_GET['id']);
   $titre_original = $bdd->prepare('SELECT titre FROM f_topics WHERE id = ?');
   $titre_original->execute(array($get_id));
   $titre_original = $titre_original->fetch()['titre'];
   if($get_titre == url_custom_encode($titre_original)) {
      $topic = $bdd->prepare('SELECT * FROM f_topics WHERE id = ?');
      $topic->execute(array($get_id));
      $topic = $topic->fetch();
      
      $parser = new JBBCode\Parser();
      $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
      $parser->addBBCode("quote", '<blockquote>{param}</blockquote>');
      $parser->addBBCode("code", '<pre class="code">{param}</pre>', false, false, 1);
      $parser->addBBCode("s", '<strike>{param}</strike>');
      $parser->addBBCode("sup", '<sup>{param}</sup>');
      $parser->addBBCode("sub", '<sub>{param}</sub>');
      $parser->addBBCode("list", '<ul>{param}</ul>');
      $parser->addBBCode("list2", '<ol>{param}</ol>');
      $parser->addBBCode("*", '<li>{param}</li>');
      $parser->addBBCode("xsmall", '<font size="2">{param}</font>');
      $parser->addBBCode("small", '<font size="3">{param}</font>');
      $parser->addBBCode("normal", '<font size="4">{param}</font>');
      $parser->addBBCode("large", '<font size="5">{param}</font>');
      $parser->addBBCode("xlarge", '<font size="6">{param}</font>');
      $parser->addBBCode("left", '<p style="text-align:left">{param}</p>');
      $parser->addBBCode("center", '<p style="text-align:center">{param}</p>');
      $parser->addBBCode("right", '<p style="text-align:right">{param}</p>');
      $parser->addBBCode("table", '<table>{param}</table>');
      $parser->addBBCode("tr", '<tr>{param}</tr>');
      $parser->addBBCode("td", '<td>{param}</td>');

      if(isset($_POST['topic_reponse_submit'],$_POST['topic_reponse'])) {
         $reponse = htmlspecialchars($_POST['topic_reponse']);
         if(isset($_SESSION['id'])) {
            if(!empty($reponse)) {
               $ins = $bdd->prepare('INSERT INTO f_messages(id_topic,id_posteur,contenu,date_heure_post) VALUES (?,?,?,NOW())');
               $ins->execute(array($get_id,$_SESSION['id'],$reponse));
               $reponse_msg = "Votre réponse a bien été postée";
               unset($reponse);
            } else {
               $reponse_msg = "Votre réponse ne peut pas être vide !";
            }
         } else {
            $reponse_msg = "Veuillez vous connecter ou créer un compte pour poster une réponse";
         }
      }
      if(isset($_POST['sup'])){
         $deltopiccat = ("DELETE FROM f_topics_categories WHERE id_topic =".$get_id);
         $bdd->exec($deltopiccat);
         $deltopic = ("DELETE FROM f_topics WHERE id =".$get_id);
         $bdd->exec($deltopic);
         header("Location: admin-forum");
      }
      if(isset($_GET['page']) AND $_GET['page'] > 1) {
         $reponsesParPage = 6;
      } else {
         $reponsesParPage = 5;
      }
      $reponsesTotalesReq = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ?');
      $reponsesTotalesReq->execute(array($get_id));
      $reponsesTotales = $reponsesTotalesReq->rowCount();
      $pagesTotales = ceil($reponsesTotales/$reponsesParPage);
      if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
         $_GET['page'] = intval($_GET['page']);
         $pageCourante = $_GET['page'];
      } else {
         $pageCourante = 1;
      }
      $depart = ($pageCourante-1)*$reponsesParPage;
      $reponses = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ? LIMIT '.$depart.','.$reponsesParPage);
      $reponses->execute(array($get_id));
   } else {
      die('Erreur: Le titre ne correspond pas à l\'id');
   }
   require('views/topic.view.php');
} else {
   die('Erreur...');
}
?>