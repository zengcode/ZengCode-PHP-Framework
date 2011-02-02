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
class Authen
{

	public static function IsLogin($session=NULL)
	{
		$session = ($session)? $session : 'login';
		if (!isset($_SESSION[$session]))
		if ($_SESSION[$session] != 'successful' ) return false;
		return true;
	}

	public static function AuthenBackend()
	{
		if (!isset($_SESSION['backend']))
		if ($_SESSION['backend']['status'] != 'successful' ) Controller::AdminPage();
	}


}//end class Authen




?>