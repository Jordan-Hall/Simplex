<?php
function sxp($password) {
$data = array(
		'password' => $password,
		'format' => 'Plain',

        );

$ch = curl_init("http://lunosolutions.com/encryption/api.php");
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6'); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POST, TRUE);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$password = curl_exec($ch);  
curl_close($ch);  
return $password;
}
?>