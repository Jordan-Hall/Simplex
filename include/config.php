<?php
$start = microtime();
if (!file_exists("database.php")) 
    {
    	header("Location: install/install.php");
    } 
Require_Once("database.php");
Require_Once("simplehtmldom.php");
Require_Once("simplex.class.inc.php");
Require_Once("simplex.functions.inc.php");


// Start of theming
function themepath() {
global $dbh;
    $st = $dbh->prepare("SELECT value FROM config WHERE settings = 'theme'");
	$st->execute();
	
	$result = $st->fetch(PDO::FETCH_OBJ);
  			if ($result > 0) {  
  			  $id = $result->id;
			  $template = "theme_template/".$result->value."/";
  			  return $template;
		       } else {  
			        return "theme_template/default/"; 
			    }
}

function customcontent($pageinfo) {
    $content =  $pageinfo.".tpl";
    $file = themepath().$content;
    return $file;
}

function site($inports) {
    $script =  $inports.".tpl";
    $inport = themepath().$script;
    return $inport;
}


function siteheader() {
        include_once(site('header'));
}

function sitefooter() {
    	include_once(site('footer'));
}
// end of theming


// start of hasher function
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
//end of hasher



$end = microtime();
$time = ($end - $start)." seconds to generate";
?>