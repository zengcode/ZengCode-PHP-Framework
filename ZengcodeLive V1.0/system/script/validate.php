<?php 
/***********************************************
August 28,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
//defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');

$hello = $HTTP_SERVER_VARS[HTTP_REFERER];

ob_start ("ob_gzhandler"); 
header("Content-type: text/javascript; charset: UTF-8"); 
header("Cache-Control: must-revalidate"); 
$offset = 60 * 60 ; 
$ExpStr = "Expires: " .  
gmdate("D, d M Y H:i:s", 
time() + $offset) . " GMT"; 
header($ExpStr); 

?> 
<?php
//$hello="HELLO WORLD abc";
?>

function test(){
	alert('<?=$hello?>');
}

