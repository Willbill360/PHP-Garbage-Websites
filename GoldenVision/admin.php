<?php
session_start();
include_once('config.php');

if (isset($_POST['adm_co'])) {
  if (htmlspecialchars($_POST['adm_password']) == "scoobydoo") {
    $_SESSION['adm'] = "fulladm";
  }
}

if(isset($_SESSION['adm']) AND $_SESSION['adm'] == "fulladm") {

  if (isset($_POST['gameadd'])) {
    if (isset($_POST['gametitle']) && isset($_POST['gamecategorie']) && !empty($_POST['gametitle']) && !empty($_POST['gamecategorie'])) {
      $gametitle = htmlspecialchars($_POST['gametitle']);
      $gamecategorie = htmlspecialchars($_POST['gamecategorie']);
      if ($gamecategorie == "CFL") {
        $gametitle = "CFL | ".$gametitle;
      } elseif ($gamecategorie == "NFL") {
        $gametitle = "NFL | ".$gametitle;
      }
      $gamedate = htmlspecialchars($_POST['gamedate']);
      $gametime = htmlspecialchars($_POST['gametime']);
      $gamemainplayername = htmlspecialchars($_POST['gamemainplayername']);
      $gamesecplayername = htmlspecialchars($_POST['gamesecplayername']);
      $gamemainplayerurl = htmlspecialchars($_POST['gamemainplayerurl']);
      $gamesecplayerurl = htmlspecialchars($_POST['gamesecplayerurl']);

      $insertgame = $bdd->prepare("INSERT INTO games(title, cat, gdate, gtime, mainplayername, mainplayerurl, secplayername, secplayerurl) VALUES(?, ?, ?, ?, ?, ?, ?, ?) ");
      $insertgame->execute(array($gametitle, $gamecategorie, $gamedate, $gametime, $gamemainplayername, $gamemainplayerurl, $gamesecplayername, $gamesecplayerurl));
      header('Location: admin');
    }
  }

  if (isset($_POST['return'])) {
    header('Location: admin');
  }

  if (isset($_GET['act']) && isset($_GET['g'])) {
    if (!empty($_GET['act']) && !empty($_GET['g'])) {
      $action = htmlspecialchars($_GET['act']);
      $gameid = htmlspecialchars($_GET['g']);

      if ($action == "del") {
        $sql = $bdd->prepare("DELETE FROM games WHERE id = ?");
        $sql->execute(array($gameid));
        header('Location: admin');
      } elseif ($action == "mod") {
        if (isset($_POST['gamemod'])) {
          $newgametitle = htmlspecialchars($_POST['gametitle2']);
          $newgamecategorie = htmlspecialchars($_POST['gamecategorie2']);
          $newgamedate = htmlspecialchars($_POST['gamedate2']);
          $newgametime = htmlspecialchars($_POST['gametime2']);
          $newgamemainplayername = htmlspecialchars($_POST['gamemainplayername2']);
          $newgamesecplayername = htmlspecialchars($_POST['gamesecplayername2']);
          $newgamemainplayerurl = htmlspecialchars($_POST['gamemainplayerurl2']);
          $newgamesecplayerurl = htmlspecialchars($_POST['gamesecplayerurl2']);

          $updategame = $bdd->prepare('UPDATE games SET title = ?, cat = ?, gdate = ?, gtime = ?, mainplayername = ?, mainplayerurl = ?, secplayername = ?, secplayerurl = ? WHERE id = ?');
          $updategame->execute(array($newgametitle, $newgamecategorie, $newgamedate, $newgametime, $newgamemainplayername, $newgamemainplayerurl, $newgamesecplayername, $newgamesecplayerurl, $gameid));
          header('Location: admin');
        }
      }
    }
  }
 
  $reqallgames = $bdd->query('SELECT * FROM games ORDER BY cat DESC, gdate ASC, gtime');
  $games = $reqallgames->fetchAll();

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Golden Vision</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Anton" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/dark.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
</head>
  <body>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85437588-4', 'auto');
  ga('send', 'pageview');

</script>
  <div class="col-12 logo">
   <div class="content">
    <div class="wrap">
     <img src="/images/Logo-Golden-Vision.png">
    </div>
   </div>  
  </div>
  <div class="col-12 menu">
    <div class="col-12 content">
      <div class="lightbutton">
        <div class="col-12 content">
          <div class="wrap">

          </div>
        </div>
      </div>
      <div class="wrap">
        <ul class="main">
      <li><a href="/">Home</a></li>
      <li>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">NHL
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <?php
              $nhlcount = 0;
              foreach ($games as $key => $game) {
                if ($game['cat'] == "NHL") {
                  $nhlcount = $nhlcount + 1;
            ?>
              <li style="text-transform: none;"><a href="index?game=<?=$game['id'];?>"><?=$game['title'];?> | <?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a T (\G\M\TP)", strtotime($game['gtime'])); ?>></a></li>
            <?php
                }
              }
              if ($nhlcount == 0) {
                echo '<li style="text-transform: none;"><a href="">There is no NHL game available</a></li>';
              }
            ?>
          </ul>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">MLB
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php
                $mlbcount = 0;
                foreach ($games as $key => $game) {
                  if ($game['cat'] == "MLB") {
                    $mlbcount = $mlbcount + 1;
              ?>
                <li style="text-transform: none;"><a href="index?game=<?=$game['id'];?>"><?=$game['title'];?> | <?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a T (\G\M\TP)", strtotime($game['gtime'])); ?></a></li>
              <?php
                  }
                }
                if ($mlbcount == 0) {
                  echo '<li style="text-transform: none;"><a href="">There is no MLB game available</a></li>';
                }
              ?>
            </ul>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">NFL/CFL
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php
                $nflcount = 0;
                foreach ($games as $key => $game) {
                  if ($game['cat'] == "NFL" || $game['cat'] == "CFL") {
                    $gcat = $game['cat'];
                    $nflcount = $nflcount + 1;
              ?>
                <li style="text-transform: none;"><a href="index?game=<?=$game['id'];?>"><?=$gcat?> | <?=$game['title'];?> | <?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a T (\G\M\TP)", strtotime($game['gtime'])); ?></a></li>
              <?php
                  }
                }
                if ($nflcount == 0) {
                  echo '<li style="text-transform: none;"><a href="">There is no NFL/CFL game available</a></li>';
                }
              ?>
            </ul>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">NBA
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php
                $nbacount = 0;
                foreach ($games as $key => $game) {
                  if ($game['cat'] == "NBA") {
                    $nbacount = $nbacount + 1;
              ?>
                <li style="text-transform: none;"><a href="index?game=<?=$game['id'];?>"><?=$game['title'];?> | <?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a T (\G\M\TP)", strtotime($game['gtime'])); ?></a></li>
              <?php
                  }
                }
                if ($nbacount == 0) {
                  echo '<li style="text-transform: none;"><a href="">There is no NBA game available</a></li>';
                }
              ?>
            </ul>
          </div>
        </li>
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">TV CHANNELS
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php
                $tvcount = 0;
                foreach ($games as $key => $game) {
                  if ($game['cat'] == "TV-CHANNELS") {
                    $tvcount = $tvcount + 1;
              ?>
                <li style="text-transform: none;"><a href="index?tvchannel=<?=$game['id'];?>"><?=$game['title'];?></a></li>
              <?php
                  }
                }
                if ($tvcount == 0) {
                  echo '<li style="text-transform: none;"><a href="">There is no TV-CHANNELS available</a></li>';
                }
              ?>
            </ul>
          </div>
        </li>
      </ul>
      </div>
    </div>
    </div>
    <div class="viewers">
      <div class="content">
        <div class="wrap">
          <h4 style="text-align: center;">Il y a <span class="counter"></span><i class="fa fa-user" aria-hidden="true"></i> connecté</h4>
        </div>
      </div>
    </div>
    <?php
      if (isset($_SESSION['adm']) && $_SESSION['adm'] == "fulladm") {
    ?>
      <?php
        if (isset($_GET['add'])) {
      ?>
        <div class="adminform col-12" style="padding-bottom: 60px;">
          <div class="content">
            <div class="wrap col-10">
              <form id="admin" class="col-12" method="POST">
                <p>Title (Match Name)</p>
                <input type="text" name="gametitle" style="width: 40%;" autocomplete="off" placeholder="Mtl Canadiens VS Toronto Mapple Leaf">
                <p>Categorie</p>
                <select name="gamecategorie">
                  <option value="NHL">NHL</option>
                  <option value="MLB">MLB</option>
                  <option value="NFL">NFL</option>
                  <option value="CFL">CFL</option>
                  <option value="NBA">NBA</option>
                  <option value="TV-CHANNELS">TV-CHANNELS</option>
                </select>
                <p>Date</p>
                <input type="date" name="gamedate"/><input type="time" name="gametime"/>
                <p>Main Player TV-Channel Name</p>
                <input name="gamemainplayername" style="width: 40%;" placeholder="SNY" />
                <p>Main Player Url</p>
                <input name="gamemainplayerurl" style="width: 40%;" placeholder="http://mlbstream.me/40510/1" />
                <p>Second Player TV-Channel Name</p>
                <input name="gamesecplayername" style="width: 40%;" placeholder="CBC" />
                <p>Second Player Url</p>
                <input name="gamesecplayerurl" style="width: 40%;" placeholder="http://mlbstream.me/40510/2" />
                <br/><br/>
                <input name="return" type="submit" id="submit" style="background-color: red;margin-right:30px;" value="Retour"><input name="gameadd" type="submit" id="submit" value="Ajouter la game">
              </form>
            </div>
          </div>
        </div>
      <?php
        } elseif (isset($_GET['act']) && isset($_GET['g']) && !empty($_GET['act']) && !empty($_GET['g'])) {
        if (htmlspecialchars($_GET['act']) == "mod") {
          foreach ($games as $key => $game) {
              if ($game['id'] == $gameid) {
      ?>
        <div class="adminform col-12" style="padding-bottom: 60px;">
            <div class="content">
              <div class="wrap col-10">
                <form id="admin" class="col-12" method="POST">
                  <p>Title (Match Name)</p>
                  <input type="text" name="gametitle2" style="width: 30%;" placeholder="Mtl Canadiens VS Toronto Mapple Leaf" value="<?=$game['title'];?>" />
                  <p>Categorie</p>
                  <select name="gamecategorie2">
                    <option value="NHL" <?php if ($game['cat'] == "NHL") {echo "selected"; } ?> >NHL</option>
                    <option value="MLB" <?php if ($game['cat'] == "MLB") {echo "selected"; } ?> >MLB</option>
                    <option value="NFL" <?php if ($game['cat'] == "NFL") {echo "selected"; } ?> >NFL</option>
                    <option value="CFL" <?php if ($game['cat'] == "CFL") {echo "selected"; } ?> >CFL</option>
                    <option value="NBA" <?php if ($game['cat'] == "NBA") {echo "selected"; } ?> >NBA</option>
                    <option value="TV-CHANNELS" <?php if ($game['cat'] == "TV-CHANNELS") {echo "selected"; } ?> >TV-CHANNELS</option>
                  </select>
                  <p>Date</p>
                  <input type="date" name="gamedate2" value="<?=$game['gdate'];?>" /><input type="time" name="gametime2" value="<?=$game['gtime'];?>" />  
                  <p>Main Player TV-Channel Name</p>
                  <input name="gamemainplayername2" style="width: 40%;" placeholder="SNY" value="<?=$game['mainplayername'];?>"/>
                  <p>Main Player Url</p>
                  <input name="gamemainplayerurl2" style="width: 40%;" placeholder="mlbstream.me/40510/1" value="<?=$game['mainplayerurl'];?>" />
                  <p>Second Player TV-Channel Name</p>
                  <input name="gamesecplayername2" style="width: 40%;" placeholder="CBC" value="<?=$game['secplayername'];?>" />
                  <p>Second Player Url</p>
                  <input name="gamesecplayerurl2" style="width: 40%;" placeholder="mlbstream.me/40510/2" value="<?=$game['secplayerurl'];?>" />
                  <br/><br/>
                  <input name="return" type="submit" id="submit" style="background-color: red;margin-right:30px;" value="Retour"><input name="gamemod" type="submit" id="submit" value="Updater la game">
                </form>
              </div>
            </div>
          </div>
      <?php
              }
            }
          }
        } elseif (isset($_GET['players'])) {
      ?>
      <h1 class="gname">Select a match</h1>
      <div class="viewplayers col-12">
        <div class="allgamesurls col-6">
          <div class="content">
            <div class="wrap">
      <?php
          foreach ($games as $key => $game) {
            if (isset($game['mainplayername']) && !empty($game['mainplayername'])) {
              $gametitle = "[".$game['mainplayername']."] ".$game['title'];
            } else {
              $gametitle = $game['title'];
            }
      ?>
        <a data-gurl="<?=$game['mainplayerurl'];?>" class="agameurl" style="cursor: pointer;"><?=$gametitle?></a><br/>
        <?php
          if (isset($game['secplayerurl'])) {
             if (isset($game['secplayername']) && !empty($game['secplayername'])) {
              $gametitle2 = "[".$game['secplayername']."] ".$game['title'];
            } else {
              $gametitle2 = $game['title'];
            }
        ?>
          <a data-gurl="<?=$game['secplayerurl'];?>" class="agameurl" style="cursor: pointer;"><?=$gametitle2?></a><br/>
        <?php
            }
          }
        ?>
            </div>
          </div>
        </div>
        <div class="theplayer col-6">
          <div class="content">
            <div class="wrap">
              <iframe src="http://google.com" class="theiframe" width="620" height="350" frameborder="0" scrolling="no" style="float: right;" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>

      <?php
        } else {
      ?>
        <div class="matchtab col-12">
        <div class="content">
          <div class="wrap col-10">
           <table id="match" class="col-12">
              <tr>
                <th>Match</th>
                <th>Categorie</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
              <?php
                foreach ($games as $key => $game) {
              ?>
                <tr <?php if ($game['cat'] == "TV-CHANNELS") {
                  echo "style=\"background-color: #8e8e8e;\"";
                } ?> >
                  <td><?=$game['title'];?></td>
                  <td><?=$game['cat'];?></td>
                  <td><?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a", strtotime($game['gtime'])); ?></td>
                  <td><a href="admin?act=del&g=<?=$game['id'];?>">Supprimer</a> | <a href="admin?act=mod&g=<?=$game['id'];?>">Modifier</a> | <a class="copierauclip" data-gid="<?=$game['id'];?>" onclick="copyToClipboard('#gameurl<?=$game['id'];?>')" style="cursor: pointer;">Copier le texte</a> <i class="checkmark<?=$game['id'];?> fa fa-check" style="visibility:hidden;" aria-hidden="true"></i></td>
                  <p id="gameurl<?=$game['id'];?>" contenteditable="true" style="display: none;">[**SD STREAM <?php if (!empty($game['mainplayername'])) { echo '| '.$game['mainplayername'];} ?>** <?=$game['title'];?>](http://goldenvision.ml/index?game=<?=$game['id'];?>&playerid=1)

[**SD STREAM <?php if (!empty($game['secplayername'])) { echo '| '.$game['secplayername'];} ?>** <?=$game['title'];?>](http://goldenvision.ml/index?game=<?=$game['id'];?>&playerid=2)

*MOBILE:YES*

*We don't own any streams but it's good quality!*

*Please Upvote if you like the stream!*

GOOD GAME!</p>
                </tr>
              <?php
                }
              ?>
            </table>
          </div>
        </div>
      </div>
      <div class="add col-12" style="padding-bottom: 60px;">
        <div class="content">
          <div class="wrap col-6">
            <a href="?add" style="margin-right: 30px;">Add</a> <a href="?players">View all player</a>
          </div>
        </div>
      </div>
    <?php
        }
      } else {
    ?>
      <div class="login col-12">
        <div class="content">
          <div class="wrap col-10">
            <p>Password</p>
            <form method="post">
              <input type="password" name="adm_password" id="text" />
              <input type="submit" name="adm_co" id="submit" value="Login" />
            </form>
          </div>
        </div>
      </div>
    <?php
      }
    ?>
    <script type="text/javascript">
      function copyToClipboard(element) {
        var text = $(element).clone().find('br').prepend('\r\n').end().text()
        element = $('<textarea>').appendTo('body').val(text).select()
        document.execCommand('copy')
        element.remove()
      }
    </script>
    <script type="text/javascript">
      $(function() {
        var url = window.location.protocol + "//" + window.location.hostname + ":8001";
        var socket = io(url, {transports: ['websocket'], upgrade: false});

        socket.on('userupd', function (data) {
          $('.counter').html(data.Count * 2);
        });

        socket.on('newcheck', function (data) {
          $('.checkmark'+data).css('visibility', 'visible');
        });

        socket.on('checked', function (data) {
          for (var i = 0; i < data.length; i++) {
            $('.checkmark'+data[i]).css('visibility', 'visible');
          }
        });

        $('.copierauclip').click(function(){
          var gid = $(this).data('gid');
          socket.emit('copied', gid);
        });

        $('.agameurl').click(function(){
          var gurl = $(this).data('gurl');
          var gn = $(this).html();
          $('.theiframe').attr('src',gurl);
          $('.gname').html(gn);
        });
      });
    </script>
  </body>
</html>
