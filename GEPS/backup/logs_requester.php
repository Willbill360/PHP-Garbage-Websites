<?php
	session_start();

	include_once('config.php');

	if($isLocal == true) {
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
		$bdd_logs = new PDO('mysql:host=storage.crystal-serv.com;dbname=srv38369', 'srv38369', 'pWrPYH5y');
	} else {
		$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '0Otfk4rNnz');
		$bdd_logs = new PDO('mysql:host=storage.crystal-serv.com;dbname=srv38369', 'srv38369', 'pWrPYH5y');
	}

	$data = htmlspecialchars($_GET['q']);
	list($value, $id) = explode(":", $data);

	$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?'); //Req Membre
    $requser->execute(array($id));
    $userinfo = $requser->fetch();
    $reqidlogs = $bdd_logs->prepare('SELECT rowid FROM co_user WHERE user = ?'); // Req rowid (logs)
    $reqidlogs->execute(array($userinfo['pseudo']));
    $idlogs = $reqidlogs->fetch();
 	$reqcologs = $bdd_logs->prepare('SELECT * FROM co_session WHERE user = ? ORDER BY rowid DESC'); //Req Co/Deco (logs)
    $reqcologs->execute(array($idlogs['rowid']));
    $cologs = $reqcologs->fetch();
    $reqblocklogs = $bdd_logs->prepare('SELECT * FROM co_block WHERE user = ? ORDER BY rowid DESC'); //Req Blocks (logs)
    $reqblocklogs->execute(array($idlogs['rowid']));
    $blocklogs = $reqblocklogs->fetch();
    $reqchatlogs = $bdd_logs->prepare('SELECT * FROM co_chat WHERE user = ? ORDER BY rowid DESC'); //Req Chat (logs)
    $reqchatlogs->execute(array($idlogs['rowid']));
    $chatlogs = $reqchatlogs->fetch();
    $reqcommandlogs = $bdd_logs->prepare('SELECT * FROM co_command WHERE user = ? ORDER BY rowid DESC'); //Req Command (logs)
    $reqcommandlogs->execute(array($idlogs['rowid']));
    $commandlogs = $reqcommandlogs->fetch();

	function time_elapsed($secs){	// Concatenation + chnagement de la valeur numérique en lisible
		$bit = array(
		' an'        => $secs / 31556926 % 12,
		' semaine'        => $secs / 604800 % 52,
		' jour'        => $secs / 86400 % 7,
		' heure'        => $secs / 3600 % 24,
		' minute'    => $secs / 60 % 60,
		' seconde'    => $secs % 60
		);
															        
		foreach($bit as $k => $v){
			if($v > 1)$ret[] = $v . $k . 's';
			if($v == 1)$ret[] = $v . $k;
		}
		array_splice($ret, count($ret)-1, 0, 'et');
		$ret[] = '';
															    
		return join(' ', $ret);
	}
	function time_elapsed_A($secs){
    $bit = array(
        'an' => $secs / 31556926 % 12,
        'sem' => $secs / 604800 % 52,
        'j' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'min' => $secs / 60 % 60,
        'sec' => $secs % 60
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join(' ', $ret);
    }

    $reqlastcologs = $bdd_logs->prepare('SELECT action FROM co_session WHERE user = ? ORDER BY rowid DESC LIMIT 1'); //Req Last Co/Deco (logs)
    $reqlastcologs->execute(array($idlogs['rowid']));
    $lastcologs = $reqlastcologs->fetch();
    
    $lastaction = $lastcologs['action'];

    if ($value == 1) {
    	echo '
		<table class="table-wrapper">
		<tbody>';
		$nowtime = time();
		$oldtime = $cologs['time'];
		if ($lastaction == 0) {
			echo '
			<tr>
			<td><h5>Déconnexion</h5></td>
			<td><h5>';
			echo 'Il y a: '.time_elapsed($nowtime-$oldtime);
			echo '</h5></td>
			</tr>';
		} else {
			echo '
			<tr>
			<td><h5>Connexion</h5></td>
			<td><h5>';
			echo 'Il y a: '.time_elapsed($nowtime-$oldtime);
			echo '
			</h5></td>
			</tr>';
		} while($cologs = $reqcologs->fetch()) {
			$nowtime = time();
			$oldtime = $cologs['time'];
			//echo "Action il y a: ".time_elapsed($nowtime-$oldtime)."\n";
			if($cologs['action'] == 1) {
				echo '
				<tr>
				<td><h5>Connexion</h5></td>
				<td><h5>';
				echo 'Il y a: '.time_elapsed($nowtime-$oldtime);
				echo '</h5></td>
				</tr>';
			} else {
				echo '
				<tr>
				<td><h5>Déconnexion</h5></td>
				<td><h5>';
				echo 'Il y a: '.time_elapsed($nowtime-$oldtime);
				echo '</h5></td>
				</tr>';
			}
		}
		echo '
		</tbody>
		</table>';
	} else if ($value == 2) {
		echo '
		<table class="table-wrapper">
			<tbody>';
				while($blocklogs = $reqblocklogs->fetch()) {
					$nowtime = time();
					$oldtime = $blocklogs['time'];	
					//echo "Action il y a: ".time_elapsed($nowtime-$oldtime)."\n";
					if($blocklogs['action'] == 0) {
						echo '
						<tr>
						<td><h5>Posé</h5></td>
						<td><h5>';
						echo 'ID: '.$blocklogs['type'];
						echo '</h5></td>
						<td><h5>';
						echo 'Il y a: '.time_elapsed_A($nowtime-$oldtime);
						echo '</h5></td>
						<td><h5>Sur: '.$blocklogs['x']; 
						echo ' '.$blocklogs['y']; 
						echo ' '.$blocklogs['z'];
						echo '</h5></td>
						</tr>';
					} else {
						echo '
						<tr>
						<td><h5>Détruit</h5></td>
						<td><h5>';
						echo 'ID: '.$blocklogs['type'];
						echo '</h5></td>
						<td><h5>';
						echo 'Il y a: '.time_elapsed_A($nowtime-$oldtime);
						echo '</h5></td>
						<td><h5>Sur: '.$blocklogs['x'];
						echo ' '.$blocklogs['y'];
						echo ' '.$blocklogs['z'];
						echo '</h5></td>
						</tr>';
					}
				}
			echo '</tbody>
		</table>';
	} else if ($value == 3) {
		echo '<table class="table-wrapper">
			<tbody>';
				while($chatlogs = $reqchatlogs->fetch()) {
					$nowtime = time();
					$oldtime = $chatlogs['time'];
					
					//echo "Action il y a: ".time_elapsed($nowtime-$oldtime)."\n";
					echo '<tr>
						<td><h5>';
						echo $chatlogs['message'];
						echo '</h5></td>
						<td><h5>';
						echo 'Il y a: '.time_elapsed_A($nowtime-$oldtime);
						echo '</h5></td>
					</tr>';
				}
			echo '</tbody>
		</table>';
	} else if ($value == 4) {
		echo '<table class="table-wrapper">
			<tbody>';
				while($commandlogs = $reqcommandlogs->fetch()) { 
					$nowtime = time();
					$oldtime = $commandlogs['time'];
					//echo "Action il y a: ".time_elapsed($nowtime-$oldtime)."\n";
					echo '<tr>
						<td><h5>';
						echo $commandlogs['message'];
						echo '</h5></td>
						<td><h5>';
						echo "Il y a: ".time_elapsed_A($nowtime-$oldtime);
						echo '</h5></td>
					</tr>';
				}
			echo '</tbody>
		</table>';
	}

?>