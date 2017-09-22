<?php
   if(isset($_SESSION['id'])) {
?>
<html>
   <head>
      <title>G.E.P.S - Forum</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
      <link rel="stylesheet" href="css/main.css" />
      <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
      <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
      <link rel="icon" type="image/ico" href="../images/favicon.ico"/>
      <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
   </head>
   <body>
      <?php //include_once("../analyticstracking.php") ?>
      <!-- Page Wrapper -->
         <div id="page-wrapper">

            <!-- Header -->
               <header id="header">
                  <h1><a href="index">G.E.P.S.</a></h1>
                  <nav id="nav">
                     <ul>
                        <li class="special">
                           <a href="#menu" class="menuToggle"><span>Menu</span></a>
                           <div id="menu">
                              <ul>
                                 <li><a href="../index">Accueil</a></li>
                                 <li><a href="../encore_plus">Encore plus !</a></li>
                                 <li><a href="../nous_rejoindre">Nous rejoindre</a></li>
                                 <li><a href="../le_project">Le project</a></li>
                                 <li><a href="#"></a></li>
                                 <li>-= Espace Membres =-</li>
                                 <li><a href="../profil?id=<?php echo $_SESSION['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;Retour au profil</a></li>
                                 <li><a href="../editionprofil">&nbsp;&nbsp;&nbsp;&nbsp;Editer mon profil</a></li>
                                 <li><a href="../deconnexion">&nbsp;&nbsp;&nbsp;&nbsp;Déconnexion</a></li>
                                 <li><a href="#"></a></li>
                                 <li><a href="../politiques">Politiques</a></li>
                                 <li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H4HEVACEMT6MW">Nous supporter</a></li>
                                 <div style="margin-top:30px;z-index:20000;position: fixed;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <!-- Menu Big Rect -->
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:336px;height:280px"
                                         data-ad-client="ca-pub-9083504882836474"
                                         data-ad-slot="5881557940"></ins>
                                    <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                 </script></div>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </nav>
               </header>

            <!-- Main -->
               <article id="main">
                  <header>
                     <h2>Forum G.E.P.S.</h2>
                  </header>
                  <section class="wrapper style5">
                     <div class="inner">
                        <?php 
                           $path = $_SERVER["PHP_SELF"];
                           $parts = explode('/',$path);
                           if (count($parts) < 2)
                           {
                           echo("Accueil");
                           }
                           else
                           {
                           echo ("<a href=\"/\">Accueil</a> &raquo; ");
                           for ($i = 1; $i < count($parts); $i++)
                              {
                              if (!strstr($parts[$i],"."))
                                 {
                                 echo("<a href=\"");
                                 for ($j = 0; $j <= $i; $j++) {echo $parts[$j]."/";};
                                 echo("\">". str_replace('-', ' ', $parts[$i])."</a> » ");
                                 }
                              else
                                 {
                                    $str = $parts[$i];
                                 $pos = strrpos($str,".");
                                 $parts[$i] = substr($str, 0, $pos);
                                 echo str_replace('-', ' ', $parts[$i]);
                                 };
                              };
                           };  
                        ?>
                        <table class="forum">
                           <tr class="header">
                              <th class="main">Catégories</th>
                              <th class="sub-info messages">Topics</th>
                              <th class="sub-info dmessage">Dernier topic</th>
                           </tr>
                           <?php
                           while($c = $categories->fetch()) {
                              $subcat->execute(array($c['id']));
                              $souscategories = '';
                              while($sc = $subcat->fetch()) { 
                                 $souscategories .= '<a href="topics?categorie='.url_custom_encode($c['nom']).'&souscategorie='.url_custom_encode($sc['nom']).'">'.$sc['nom'].'</a> | ';
                              }
                              $souscategories = substr($souscategories, 0, -3);
                           ?>
                           <tr>
                              <td class="main">
                                 <h4><a href="topics?categorie=<?= url_custom_encode($c['nom']) ?>"><?= $c['nom'] ?></a></h4>
                                 <p>
                                 <?= $souscategories ?>
                                 </p>
                              </td>
                              <td class="sub-info hide-640"><?= nbr_topics($c['id']) ?></td>
                               <td class="sub-info"><?= derniere_reponse_categorie($c['id']) ?></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </section>
               </article>

            <!-- Footer -->
               <footer id="footer">
                  <ul class="icons">
                     <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                     <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                     <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                     <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                     <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                  </ul>
                  <ul class="copyright">
                     <li>&copy; G.E.P.S.</li><li>Design: <a href="http://xxthegamecraft.xyz">XxTheGamecraftxX</a></li>
                  </ul>
               </footer>

         </div>

      <!-- Scripts -->
         <script src="../assets/js/jquery.min.js"></script>
         <script src="../assets/js/jquery.scrollex.min.js"></script>
         <script src="../assets/js/jquery.scrolly.min.js"></script>
         <script src="../assets/js/skel.min.js"></script>
         <script src="../assets/js/util.js"></script>
         <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
         <script src="../assets/js/main.js"></script>
         <script type="text/javascript">
            // create the back to top button
            $('body').prepend('<a href="#" style="text-decoration: none;" class="back-to-top">Back to Top</a>');

            var amountScrolled = 300;

            $(window).scroll(function() {
               if ( $(window).scrollTop() > amountScrolled ) {
                  $('a.back-to-top').fadeIn('slow');
               } else {
                  $('a.back-to-top').fadeOut('slow');
               }
            });

            $('a.back-to-top, a.simple-back-to-top').click(function() {
               $('html, body').animate({
                  scrollTop: 0
               }, 700);
               return false;
            });
         </script>

   </body>
</html>
<?php
   } else {
      header("Location: ../connexion");
   }
?>