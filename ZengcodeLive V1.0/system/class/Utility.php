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
Class Utility
{

	public static function ErrorMessage($msg)
	{
		print("
		       <div style=\"border:#999 1px solid;\background-color:#fff;padding:20px 20px 12px 20px;\">
				<h1>Error</h1>
				<BR><B><font color='red'>$msg</font></B>
				</div>
			");
	}

	public static function SuccessMessage($msg)
	{
		print("<center><p class='successMessage'>$msg</p></center>");
	}

	public static function Redirect($uri)
	{
		ob_get_clean();
		$_SESSION['DEBUG_VALUE']['POST']	=	$_POST;
		header('Location: '.$uri);
		exit();
	}
   
    public static function GenerateDbDropdown($table,$key,$label,$value,$conditon='')
	{
		$sql = "select $key,$label from $table ".$condition;
		$db = new Database();
		$data = $db->Select("$key,$label")->From($table)->Where($condition)->Query();
		$data = $data['record'];
		$result = "<select ";
		$result .= "name='".$key."' ";
		$result .= "id = '".$key."' >";
		$result .= "<option value=''> ............ </option> \n";
		foreach($data as $akey => $avalue)
		{  
			$result .= "<option  ' ";
			$result .= " value = '".$avalue[$key]."' ";
			$result .= ($avalue[$key] == $value)? ' selected' : '' ;
			$result .= ">";
			$result	.= $avalue[$label];
			$result .= "</option> \n";
			
		}
		$result .= "</select >";
		return $result;
	}

	public static function ToBr($str)
	{
		return nl2br($str); //str_replace(chr(13),"<br />",$str);
	}

	public static function NoHtml($str)
	{
		return htmlspecialchars($str);
	}

	public static function DateToString($date)
	{
		list($year,$month,$day) = split('[/.-]', $date);
		$monthName=array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$year=$year+543;
		$date = $day . " ".$monthName[(int) $month]." ".$year;
		return $date;
	}

	public static function GetIp()
	{
		if (getenv('HTTP_X_FORWARDED_FOR'))
         $ip=getenv('HTTP_X_FORWARDED_FOR');
       else
         $ip=getenv('REMOTE_ADDR'); 
	   return $ip;
	}
    
}//end Class Utility















class Authentication
{
	public static function AuthenBackend()
	{
		if (!isset($_SESSION['login']))
		if ($_SESSION['login'] != 'successful' ) self::BackPage();
	}

	public static function BackPage()
	{
		ob_get_clean();
		
		header('Location: '.$uri);
	}

	public static function IsLogin($session=NULL)
	{
		$session = ($session)? $session : 'login';
		if (!isset($_SESSION[$session]))
		if ($_SESSION[$session] != 'successful' ) return false;
		return true;
	}
	
}//end class Authentication



?>