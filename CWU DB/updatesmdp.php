<?php 

$code = mt_rand(1000000, 9999999);
echo $code;

$fichiermdp = fopen('specialmdp.txt', 'w+');
fwrite($fichiermdp, $code);
fclose($fichiermdp);

?>
