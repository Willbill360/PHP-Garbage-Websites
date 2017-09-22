<?php
session_start();
include_once('config.php');

$reqallgames = $bdd->query('SELECT * FROM games ORDER BY gtime');
$games = $reqallgames->fetchAll();

$reqallmsg = $bdd->query('SELECT * FROM chatmsg ORDER BY id ASC LIMIT 20');
$messages = $reqallmsg->fetchAll();

if (isset($_GET['game']) && !empty($_GET['game']) || isset($_GET['tvchannel']) && !empty($_GET['tvchannel'])) {
  if (isset($_GET['tvchannel'])) {
    $gameid = htmlspecialchars($_GET['tvchannel']);
  } elseif (isset($_GET['game'])) {
    $gameid = htmlspecialchars($_GET['game']);
  }
  if (is_numeric($gameid)) {
    foreach ($games as $key => $game) {
      if (isset($_GET['playerid']) && !empty($_GET['playerid']) && is_numeric(htmlspecialchars($_GET['playerid'])) && htmlspecialchars($_GET['playerid']) < 3 && htmlspecialchars($_GET['playerid']) > 0) {
        if (htmlspecialchars($_GET['playerid']) == 1) {
          $playername = $game['mainplayername'];
        } elseif (htmlspecialchars($_GET['playerid']) == 2) {
          if (!empty($game['secplayerurl'])) {
            $playername = $game['secplayername'];
          } else {
            $playername = $game['mainplayername'];
          }
        }
      } else {
        $playername = $game['mainplayername'];
      }
      if ($game['id'] == $gameid) {
        if (!empty($playername)) {
          $gametitle = '['.$playername.'] '.$game['title'];
        } else {
          $gametitle = $game['title'];
        }
        $gamedate = $game['gdate'];
        $gametime = $game['gtime'];
      }
    }
  }
} else {
  $gametitle = "No Game Selected";
}


?>

<!DOCTYPE html>
<html>
<head>
<title><?=$gametitle;?> | GoldenVision Online Sport Streaming</title>
<script type="text/javascript"> 
//default pop-under house ad url 
clicksor_enable_pop = true; 
clicksor_adhere_opt='left'; 
clicksor_frequencyCap =0.1;
durl = '';
clicksor_layer_border_color = '';
clicksor_layer_ad_bg = '';
clicksor_layer_ad_link_color = '';
clicksor_layer_ad_text_color = '';
clicksor_text_link_bg = '';
clicksor_text_link_color = '';
clicksor_enable_inter=true;
</script>
 <script type="text/javascript" src="http://b.clicksor.net/show.php?nid=1&amp;pid=386587&amp;sid=647671"></script>
<!-- <script type="text/javascript"> 
    var adfly_id = 4862674; 
    var adfly_advert = 'int'; 
    var frequency_cap = 5; 
    var frequency_delay = 5; 
    var init_delay = 3; 
    var popunder = true; 
</script> 
<script src="https://cdn.adf.ly/js/entry.js"></script>  -->
<!-- <script src="https://cdn.adf.ly/js/display.js"></script>
<script type="text/javascript"> 
    var adfly_id = 4862674; 
    var popunder_frequency_delay = 0;
</script>
 -->

<!-- <script async defer src="show-promote.min.js"></script>
<script>
var popURL = "promopage.html";
function onPopUnderLoaded() {
    this.pop(popURL);
}
</script> -->

<script src="https://cdn.adf.ly/js/link-converter.js"></script> 
<meta name="description" content="Goldenvision propose matches streaming of the NHL, NFL, MLB and NBA.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Anton" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/css/main.css?version=<?php $v=rand(100,9999999999); echo $v;?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/btsport1.css?version=<?php $v=rand(100,9999999999); echo $v;?>">
<link rel="stylesheet" href="/assets/css/dark.css?version=<?php $v=rand(100,9999999999); echo $v;?>">
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
    <div class="image">
      <img src="/images/Logo-Golden-Vision-BETA.png">
    </div>
    <div class="dmca">
      <li>
        <a href="dmca">DMCA</a>
      </li>
    </div> 
  </div>
 </div>  
</div>
<div class="col-12 menu">
 <div class="col-12 content">
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
              <li style="text-transform: none;"><a href="index?game=<?=$game['id'];?>"><?=$game['title'];?> | <?= date("m-d", strtotime($game['gdate'])); ?> at <?= date("h:i a T (\G\M\TP)", strtotime($game['gtime'])); ?></a></li>
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
  <div class="undermenu">
  <div class="title">
    <h1><?=$gametitle;?></h1>
  </div>  
    <div class="player col-12">
      <div class="videoad">
      </div>
      <div class="leftpatente col-3">
        <!-- JuicyAds v3.0 -->
        <div class="pub1">
<script type="text/javascript"> 
clicksor_enable_adhere = false; 

clicksor_default_url = '';
clicksor_banner_border = '#99CC33'; 
clicksor_banner_ad_bg = '#FFFFFF';
clicksor_banner_link_color = '#000000'; 
clicksor_banner_text_color = '#666666';
clicksor_layer_border_color = '';
clicksor_layer_ad_bg = ''; 
clicksor_layer_ad_link_color = '';
clicksor_layer_ad_text_color = ''; 
clicksor_text_link_bg = '';
clicksor_text_link_color = ''; 
clicksor_enable_text_link = false;
     
clicksor_banner_text_banner = true;
clicksor_banner_image_banner = true; 
clicksor_enable_layer_pop = false;
clicksor_enable_pop = true;
</script>
 <script type="text/javascript" src="http://b.clicksor.net/show.php?nid=1&amp;pid=386587&amp;adtype=5&amp;sid=647671"></script>
        </div>
        <div class="pub2">
          
        </div>
      </div>
      <div class="video col-6">
        <div class="center col-9">
          <div class="content col-10">
            <div class="wrap col-12">
            <?php
              if(isset($gametitle) && $gametitle != "No Game Selected") {
            ?>
              <h3 id="countdown"><p id="countdown"></p></h3>
            <?php
              } else {
            ?>
              <h3>Please choose a game in the menu</h3>
            <?php
              }
            ?>
            </div>
          </div>
        </div>
      <?php
        if (isset($_GET['game']) && !empty($_GET['game']) || isset($_GET['tvchannel']) && !empty($_GET['tvchannel'])) {
          if (isset($_GET['tvchannel'])) {
            $gameid = htmlspecialchars($_GET['tvchannel']);
          } elseif (isset($_GET['game'])) {
            $gameid = htmlspecialchars($_GET['game']);
          }
          if (is_numeric($gameid)) {
            foreach ($games as $key => $game) {
              if ($game['id'] == $gameid) {
                if (isset($_GET['playerid']) && !empty($_GET['playerid']) && is_numeric(htmlspecialchars($_GET['playerid'])) && htmlspecialchars($_GET['playerid']) < 3 && htmlspecialchars($_GET['playerid']) > 0) {
                  if (htmlspecialchars($_GET['playerid']) == 1) {
                    $playerurl = $game['mainplayerurl'];
                  } elseif (htmlspecialchars($_GET['playerid']) == 2) {
                    if (!empty($game['secplayerurl'])) {
                      $playerurl = $game['secplayerurl'];
                    } else {
                      $playerurl = $game['mainplayerurl'];
                    }
                  }
                } else {
                  $playerurl = $game['mainplayerurl'];
                }
      ?>
        <?php
          if (!empty($game['secplayerurl'])) {
        ?>
            <div class="links2" style="width: 34%;display: block;margin: 0 auto;"><a style="margin-right: 30px;" href="index?game=<?=$game['id']?>&playerid=1">Player 1 <?=$game['mainplayername']?></a><a href="index?game=<?=$game['id']?>&playerid=2">Player 2 <?=$game['secplayername']?></a></div>
        <?php
          }
        ?>
        <iframe src="<?=$playerurl;?>" class="theiframe" width="620" height="350" frameborder="0" scrolling="no" allowfullscreen></iframe>
      <?php
              }
            }
          }
        }
      ?>
        <div class="viewers">
          <div class="content">
            <div class="wrap">
              <h4><span class="counter"></span><i class="fa fa-user" aria-hidden="true"></i></h4>
            </div>
          </div>
        </div>
      </div>

      <div class="rightchat col-12">
       <div class="content col-11">
        <div class="wrap col-12">
        <div class="commentspace" style="min-height: 500px;outline: black 2px solid;">
          <?php
            foreach ($messages as $key => $value) {
          ?>
            <li style="color:#4286f4;font-size:16px;"><div><b><?=$value['username'];?></b></div> <span style="color:#fff;"><?=$value['message'];?></span></li>
          <?php
            }
          ?>
        </div>
        <form name="commentform" class="commentform" method="Post">
          <input type="text" name="comment" id="m" class="com" placeholder="Type here" autocomplete="off" /><input type="submit" id="n" name="comsend" class="commentbtn com" value="Set Username" />
        </form>
        </div>
       </div>
      </div>

      
    </div>
    <div class="undervideoads">
      <div class="content">
        <div class="wrap">
          <script type="text/javascript"> 
clicksor_enable_adhere = false; 

clicksor_default_url = '';
clicksor_banner_border = '#99CC33'; 
clicksor_banner_ad_bg = '#FFFFFF';
clicksor_banner_link_color = '#000000'; 
clicksor_banner_text_color = '#666666';
clicksor_layer_border_color = '';
clicksor_layer_ad_bg = ''; 
clicksor_layer_ad_link_color = '';
clicksor_layer_ad_text_color = ''; 
clicksor_text_link_bg = '';
clicksor_text_link_color = ''; 
clicksor_enable_text_link = false;
     
clicksor_banner_text_banner = true;
clicksor_banner_image_banner = true; 
clicksor_enable_layer_pop = false;
clicksor_enable_pop = true;
</script>
 <script type="text/javascript" src="http://b.clicksor.net/show.php?nid=1&amp;pid=386587&amp;adtype=1&amp;sid=647671"></script>
       </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $( document ).ready(function() {
        $('.center').css("display", "flex");
        $('.theiframe').css("display", "none");
        $('.viewers').css("display", "none");
        $('.links2').appendTo(".title");
      });
  </script>
  <?php
    if(isset($gametitle) && $gametitle != "No Game Selected") {
  ?>
    <script type="text/javascript">

      // Set the date we're counting down to
      var countDownDate = new Date("<?=$gamedate?> <?=$gametime?>").getTime();

      // Update the count down every 1 second
      var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s <br/> until the game starts<br/>";

        // If the count down is finished, write some text 
        if (minutes < 10) {
          clearInterval(x);
          $('.center').css("display", "none");
          $('.viewers').css("display", "initial");
          $('.theiframe').css("display", "initial");
        }
      }, 1000);
    </script>
  <?php
    } 
  ?>
  <script type="text/javascript">
    $(function() {
      var url = window.location.protocol + "//" + window.location.hostname + ":8001";
      var socket = io(url, {transports: ['websocket'], upgrade: false});
      var user = "";

      socket.on('userupd', function (data) {
        $('.counter').html(data.Count * 2);
      });

      socket.on('new message', function(msg){
        $('.commentspace').append('<li style="color:#4286f4;font-size:16px;"><div><b>'+msg.username+'</b></div> <span style="color:#fff;">'+msg.mess+'</span>');
      });

      $('.commentform').submit(function () {
        if ($('#m').val() != "") {
          if (user != "") {
              socket.emit('chat message', { mess:$('#m').val(), username:user });
              $('#m').val('');
          } else {
            var reg1=new RegExp("(Admin)|(admin)","g");
            if ($('#m').val().match(reg1)) {

              $('#m').val('Failed');
            } else {
              user = $('#m').val();
              $('#m').val('');
              $('#n').val('Send');
            }
          }
        }
        return false;
      });

    });
  </script>
</body>
</html>
