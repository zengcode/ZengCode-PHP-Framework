<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');
Class ActivityLog
{
	public function SaveLog($userName,$activity)
	{
		 $dateTime = date('H:m:s',time());
		 $fileName = date("Y-m-d");
		 $logStr  = "$dateTime : $userName => $activity \n";
		 $fp = fopen(LOG_PATH."/".$fileName, "a");
		 fwrite($fp, $logStr);
		 fclose($fp);
	}
}
?>