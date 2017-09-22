<?php
include_once('config.php');
// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// STEP 2: Post IPN data back to paypal to validate

$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr'); // change to [...]sandbox.paypal[...] when using sandbox to test
//$ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
//curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . 'cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);


// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    $item_name = htmlspecialchars($_POST['item_name']);
    $item_number = htmlspecialchars($_POST['item_number']);
    $payment_status = htmlspecialchars($_POST['payment_status']);
    if ($_POST['mc_gross'] != NULL)
    	$payment_amount = htmlspecialchars($_POST['mc_gross']);
    else
   		$payment_amount = htmlspecialchars($_POST['mc_gross1']);
    $payment_currency = htmlspecialchars($_POST['mc_currency']);
    $txn_id = htmlspecialchars($_POST['txn_id']);
    $receiver_email = htmlspecialchars($_POST['receiver_email']);
    $payer_email = htmlspecialchars($_POST['payer_email']);
    $custom = htmlspecialchars($_POST['custom']);
    
	// Insert your actions here
    if (!empty($item_name) AND !empty($payment_amount) AND !empty($txn_id) AND !empty($receiver_email) AND !empty($payer_email) AND !empty($custom) AND !empty($payment_currency)) {
      
      $reqtok = $bdd->prepare("SELECT * FROM achat WHERE token = ?");
      $reqtok->execute(array($txn_id));
      $tokexist = $reqtok->rowCount();
      if($tokexist == 0) {
        if($receiver_email == 'contact-facilitator@cwu.esy.es') {
          $explodedcustom = explode('&', $custom);
          foreach ($explodedcustom as $element => $info) {
            $custominfo[$element] = explode('=', $info);
          }
          $reduc = 0;
          if ($custominfo[4][1] <= 2) {
            $reduc = 0;
          } else if ($custominfo[4][1] >= 3 && $custominfo[4][1] <= 5) {
            $reduc = $custominfo[4][1]*10*(20/100);
          } else if ($custominfo[4][1] >= 6 && $custominfo[4][1] <= 12) {
            $reduc = $custominfo[4][1]*10*(30/100);
          } else {
            $reduc = $custominfo[4][1]*10*(35/100);
          }
          $priceCount = $custominfo[4][1]*10-$reduc;
          if ($priceCount == $custominfo[5][1]) {
            $insertabo = $bdd->prepare("INSERT INTO abonnement(pseudo, mail, serveur, token, date_achat, date_exp) VALUES(?, ?, ?, ?, ?, ?)");
            $insertabo->execute(array($custominfo[0][1], $custominfo[1][1], $custominfo[3][1], $txn_id, $custominfo[6][1], $custominfo[7][1]));
            $insertachat = $bdd->prepare("INSERT INTO achat(pseudo, mail, serveur, token, date_achat, date_exp) VALUES(?, ?, ?, ?, ?, ?)");
            $insertachat->execute(array($custominfo[0][1], $custominfo[1][1], $custominfo[3][1], $txn_id, $custominfo[6][1], $custominfo[7][1]));
            $insertadmin = $bdd->prepare("INSERT INTO admins(motdepasse, mail, pseudo, grade, serveur) VALUES(?, ?, ?, ?, ?)");
            $insertadmin->execute(array(sha1($custominfo[2][1]), $custominfo[1][1], $custominfo[0][1], '0', $custominfo[3][1]));
          }
        }
      }
    }
} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation

}
?>
