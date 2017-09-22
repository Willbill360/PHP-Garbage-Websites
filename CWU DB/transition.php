<?php
session_start();

include_once('config.php');
include_once('cookieconnect.php');

if(isset($_GET['go']) AND !empty($_GET['go'])) {
   $go = htmlspecialchars($_GET['go']);

?>
<?php
  if(isset($_SESSION['id']) AND $_SESSION['id'] == 53) {

?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hacking - Data Base CWU</title>
<meta property="og:url" content="http://mcgesp.ca" />
<meta property="og:type" content="website" />
<meta property="og:title" content="GEPS - Réseau multigaming" />
<meta property="og:description" content="Réseau multigaming | Hébergement | Conception" />
<meta property="og:image" content="http://mcgeps.ca/modpack/logo.png" />
<meta name="description" content="Base de données premium pour serveur HL2RP" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="robots" content="index,follow,all" />
<meta name="keywords" content="HL2RP, CWU, Civil Worker Union, Base de données" />
<meta name="author" content="GEPS" />
<link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="css/grid.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/overlay.css" />
<link rel="stylesheet" href="css/social.css">
<link rel="stylesheet" href="css/imgover.css">
<link rel="stylesheet" href="css/triangle.css">
<link href="css/lightgallery.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<style type="text/css">
            #text:after
            {
                content: "";
                display: inline-block;
                height: 1em;
                width: 3px;
                background-color: #333333;
                margin-left: 2px;
                font-weight: normal;
                position: relative;
                top: 4px;
                -webkit-animation: blinker steps(1) 1s infinite;
                -o-animation: blinker steps(1) 1s infinite;
                -moz-animation: blinker steps(1) 1s infinite;
                animation: blinker steps(1) 1s infinite;
            }

            @-webkit-keyframes blinker {  
                0% { visibility: visible; }
                50% { visibility: hidden; }
                100% { visibility: visible; }
            }

            @-moz-keyframes blinker {  
                0% { visibility: visible; }
                50% { visibility: hidden; }
                100% { visibility: visible; }
            }

            @-o-keyframes blinker {  
                0% { visibility: visible; }
                50% { visibility: hidden; }
                100% { visibility: visible; }
            }

            @keyframes blinker {  
                0% { visibility: visible; }
                50% { visibility: hidden; }
                100% { visibility: visible; }
            }
        </style>
</head>
<body>
<div class="animsition-overlay">
  
  <!-- END #section-2 -->
  <div id="languages">
      <a href="?lang=en"><img src="img/en.png"></a>
      <a href="?lang=fr"><img src="img/fr.png"></a>
    </div>
  <div class="backimg" id="section-door" style="background: #000;">
    <div class="grid flex">
      <div class="row">
      <div class="padd5555" style="width: 50%">
      <div id="container-typewriter">
      <div id="typewriter"></div>
      </div>
      
        <p class="dolje" id="cpright">2016 - <script>document.write(new Date().getFullYear())</script> <?= $lang['COPYRIGHT'] ?> <a href="http://mcgeps.ca" class="linkline">GEPS</a></p>
        </div>
      </div>
      <!-- END row --> 
      
    </div>
    <!-- END .GRID FLEX --> 
    
  </div>
  <!-- END #section-door --> 
</div>
<!-- END .animsition-overla --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/lightgallery-all.min.js"></script>
<script type="text/javascript">
  var str = "<p class='hackedtxt'> struct group_info init_groups = { .usage = ATOMIC_INIT(2) };<br/><br/>struct group_info *groups_alloc(int gidsetsize){<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;struct group_info *group_info;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;int nblocks;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;int i;<br/><br/><br/>nblocks = (gidsetsize + NGROUPS_PER_BLOCK - 1) / NGROUPS_PER_BLOCK;<br/><br/>nblocks = nblocks ? : 1;<br/><br/>group_info = kmalloc(sizeof(*group_info) + nblocks*sizeof(gid_t *), GFP_USER);<br/><br/>if (!group_info)<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;return NULL;<br/><br/>group_info->ngroups = gidsetsize;<br/><br/>group_info->nblocks = nblocks;<br/><br/>atomic_set(&group_info->usage, 1);<br/><br/><br/>if (gidsetsize <= NGROUPS_SMALL)<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;group_info->blocks[0] = group_info->small_block;<br/><br/>else {<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;for (i = 0; i < nblocks; i++) {<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;gid_t *b;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b = (void *)__get_free_page(GFP_USER);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (!b)<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;goto out_undo_partial_alloc;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;group_info->blocks[i] = b;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;}<br/><br/>}<br/><br/>return group_info;<br/><br/><br/>out_undo_partial_alloc:<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;while (--i >= 0) {<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;free_page((unsigned long)group_info->blocks[i]);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;}<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;kfree(group_info);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;return NULL;<br/><br/>}<br/><br/><br/>EXPORT_SYMBOL(groups_alloc);<br/><br/><br/>void groups_free(struct group_info *group_info)<br/>{<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;if (group_info->blocks[0] != group_info->small_block) {<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int i;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for (i = 0; i < group_info->nblocks; i++)<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;free_page((unsigned long)group_info->blocks[i]);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;}<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;kfree(group_info);<br/><br/>}<br/><br/><br/>EXPORT_SYMBOL(groups_free);<br/><br/>/* export the group_info to a user-space array */<br/><br/>static int groups_to_user(gid_t __user *grouplist,<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;const struct group_info *group_info)<br/><br/>{<br/>&nbsp;&nbsp;&nbsp;&nbsp;int i;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;unsigned int count = group_info->ngroups;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;for (i = 0; i < group_info->nblocks; i++) {<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;unsigned int cp_count = min(NGROUPS_PER_BLOCK, count);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;unsigned int len = cp_count * sizeof(*grouplist);<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (copy_to_user(grouplist, group_info->blocks[i], len))<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return -EFAULT;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;grouplist += NGROUPS_PER_BLOCK;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;count -= cp_count;<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;}<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;return 1;<br/><br/>}<br/><br/>CODE CRACKED<br/>ACCESS GRANTED !!!!<br/></p>",
    i = 0,
    isTag,
    text;

    (function type() {
        text = str.slice(0, ++i);
        if (text === str) return;
        
        document.getElementById('typewriter').innerHTML = text;

        var char = text.slice(-1);
        if( char === '<' ) isTag = true;
        if( char === '>' ) isTag = false;

        if (isTag) return type();
        setTimeout(type, 10);
    }());
    window.setInterval(function() {
      var elem = document.getElementById('typewriter');
      document.body.scrollTop = elem.scrollHeight;
    }, 100);
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "hackedsearch";

    }, 34000);
</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
    $('#lightgallery2').lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,		
		speed: 1200
    });
	    $('#gallery-99').lightGallery({
        thumbnail:true,
        animateThumb: false,
        showThumbByDefault: false,		
		speed: 1200
    });
        </script> 
<script src="js/functions.js"></script> 
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15815880-3']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>
<?php
  } else {
    header("Location: index");
  }
} else {
    header("Location: index");
}
?>
