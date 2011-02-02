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
class Iwa {
	public static $moduleName             =  Null;  //controller name
	public static $methodName			  =  Null; //method name
	public static $Parameters             = array(); //get value send by url
	private static $requested_data;
	public static $cmd;
	public static $homeContent;
	protected static $object;

public static function ExtractRequest($backend=0){  //extract the url request and set get parameter
        $uri = PREFIX.$_SERVER['REQUEST_URI'];
		$requested = empty($uri) ? false : $uri;
		  if (!isset($_SESSION['allow_injection']))
		     self::BlockSqlInjection();
			
		if ($backend)
             $requested_data = split('admin', $requested,2);
		else $requested_data = split('index', $requested,2);
	   
		if ($requested_data[0] != '/')  $requested_data = split('/', $requested_data[0]);	
		else							$requested_data = split('/', $requested_data[1]);
        unset($requested_data[0]);
		for ($i=1;$i<=count($requested_data);$i++) $_GET[$requested_data[$i]] = $requested_data[++$i];
			 self::$moduleName = ($backend)? $_GET[$GLOBALS['MODULE_VAR']]."_Admin" : $_GET[$GLOBALS['MODULE_VAR']];
			 self::$methodName = $_GET[$GLOBALS['ACTION_VAR']];
		$GLOBALS['SYSTEM']['seri']		 = ($backend)? 'admin' : 'index';
		$GLOBALS['SYSTEM']['module']	 = $_GET[$GLOBALS['MODULE_VAR']];
		$GLOBALS['SYSTEM']['method']	 = self::$methodName;
		$GLOBALS['SYSTEM']['action']	 = self::$methodName;
		$GLOBALS['SYSTEM']['get']	     = $_GET;
		unset($requested_data);	
}
//===========================================================//
public static function BlockSqlInjection()
{	
	    foreach ($_GET as $key => $value)
		{
			if (!get_magic_quotes_gpc()) $_GET[$key]=addslashes($value);
			$_GET[$key]=self::RemoveXSS($value);
		}	
		foreach ($_POST as $key => $value){		
			if (!get_magic_quotes_gpc()) $_POST[$key]=addslashes($value);
			$_POST[$key]=self::RemoveXSS($value);
		}
}

public static function RemoveXSS($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
   
   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A &#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
   
      // &#x0040 @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // &#00064 @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
   
   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);
   
   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(&#0{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
} 


public static function StartUpFontEnd(){    //Main of Front End
		self::ExtractRequest();	
        self::CreateConcreteClass(0);
}
//============StartUp=================//
public static function StartUpBackEnd(){    //Main of Back End
		self::ExtractRequest(1);	
        self::CreateConcreteClass(1);
}
//====================================//


public static function CreateConcreteClass($backEnd=0){
     
	 if (file_exists(MODULE_PATH."/".self::$moduleName."/config.php"))
		require_once MODULE_PATH."/".self::$moduleName."/config.php";
     if ($backEnd){
		 if (file_exists(MODULE_PATH."/".str_replace("_Admin", "",self::$moduleName)."/".self::$moduleName.".php"))
		   require_once MODULE_PATH."/".str_replace("_Admin", "",self::$moduleName)."/".self::$moduleName.".php";

	 }else{
		 if (file_exists(MODULE_PATH."/".self::$moduleName."/".self::$moduleName.".php"))
		   require_once MODULE_PATH."/".self::$moduleName."/".self::$moduleName.".php";
	 }

     
    if (class_exists(self::$moduleName))
	{	self::$object = new self::$moduleName();
	}else{
		self::GoToHomePage();
		exit();
	}

	if ( !method_exists(self::$object, $GLOBALS['SYSTEM']['method']))
	{	
		self::GoToHomePage();
		exit();
	}
	 self::$object->$GLOBALS['SYSTEM']['method']();
	 
     if ($GLOBALS['DEBUG']) self::Debug();
}
//===========================================================//

public static function GoToHomePage()
{

  if ($GLOBALS['SYSTEM']['seri'] == 'index') 
  {
	   self::HomePage(); 
  } 
  else 
  {
	  self::AdminPage();
  }
}


public static function HomePage()
{
	$uri = "/".$GLOBALS['MODULE_VAR']."/".$GLOBALS['MODULE']."/".$GLOBALS['ACTION_VAR']."/".$GLOBALS['ACTION'];
	Utility::Redirect($uri);
}

public static function AdminPage()
{
	$uri = "/admin/".$GLOBALS['MODULE_VAR']."/".$GLOBALS['ADMIN_MODULE']."/".$GLOBALS['ACTION_VAR']."/".$GLOBALS['ADMIN_ACTION'];
	Utility::Redirect($uri);
}

//===========================BlackEnd=============================//

public static function Debug()
{
	$_SESSION['DEBUG_SESSION_VALUE']['SESSION']  = $_SESSION;
	if ($_POST) $_SESSION['VAR_POST']	=	$_POST;    
	$_SESSION['VAR_GET'] = serialize($_GET); 
	echo "<script>window.open('".HOST_NAME."debug.php',null,\"height=600,width=900,status=yes,scrollbars=yes,resizable=yes,toolbar=no,menubar=no,location=no\");</script>";

}

//========================================================//
}//class

Class Controller extends Iwa
{

}





?>