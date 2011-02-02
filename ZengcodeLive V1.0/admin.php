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
Controller::StartUpBackEnd();
ob_flush();
?>

