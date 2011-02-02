<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
ob_start(); 
session_start();
header('Content-type: text/html; charset=utf-8');
require_once ("config/config.php");
/* Start Load Time */
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$start = $time;


//PageCache::LoadCache(5); //load cache from file parameter is minute 
Controller::StartUpFontEnd(); 
//PageCache::SaveCache(); //save page to cache file 


/* End Load Time */
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$totaltime = ($finish - $start);
printf ("<B>This page took %f seconds to load.</B>", $totaltime);
ob_end_flush();
?>