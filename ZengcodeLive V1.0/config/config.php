<?php
define('PREFIX',''); //your application location
define('HOST_NAME',"http://localhost/");

//=Database Configuration=/
$GLOBALS['DATABASE']['DATABASE_HOST']   =   "localhost";
$GLOBALS['DATABASE']['DATABASE_TYPE']	=	'mysql'; 
$GLOBALS['DATABASE']['USER']			=	'root';
$GLOBALS['DATABASE']['PASSWORD']		=	'root';
$GLOBALS['DATABASE']['DATABASE_NAME']	=	'zengcode';
$GLOBALS['LANGUAGE']					=	array('th','en','jp');
$GLOBALS['LABEL']						=	array('th' => 'Thai','en'=>'English','jp'=>'Japanese','combine'=>'Combine Field');



//=System Configuration=//

define('SYSTEM_CLASS_PATH'	,PREFIX.'system/class');
define('SCRIPT_PATH'		,PREFIX.'system/script');
define('CACHE_PATH'			,PREFIX.'system/cache');
define('LOG_PATH'			,PREFIX.'application/log');
define('FORM_GENERATE_PATH'	,PREFIX.'application/form_generate');
define('FORM_XML_PATH'		,PREFIX.'application/form_xml');
define('MODULE_PATH'		,PREFIX.'application/module');
define('USER_CLASS_PATH'	,PREFIX.'application/user_class');
define('VIEW_PATH'			,PREFIX.'application/view');
define('TEMPLATE_PATH'		,PREFIX.'application/template');
define('CONFIG_PATH'		,PREFIX.'config');

//=Debug =================/
$GLOBALS['DEBUG']	=	true;

//=Template Configuration=/
$GLOBALS['TEMPLATE']	=	'zengcode';
define('TEMPLATE'			,PREFIX.'/template/'.$GLOBALS['TEMPLATE']); //do not change it
//==Home Home Page====/
$GLOBALS['MODULE']		=   'Home';
$GLOBALS['ACTION']      =   'Index';

//==Admin Home Page====/
$GLOBALS['ADMIN_MODULE']	=   'Login';
$GLOBALS['ADMIN_ACTION']    =   'LoginForm';


//==================================================================//
$GLOBALS['MODULE_VAR'] = 'Module';
$GLOBALS['ACTION_VAR'] = 'Action';



//Loading System Class.Do not edit it
require_once(CONFIG_PATH."/WorkFlow.php");
if (!class_exists('Iwa'))				require_once(SYSTEM_CLASS_PATH."/Iwa.php");
if (!class_exists('PageCache'))			require_once(SYSTEM_CLASS_PATH."/PageCache.php");
if (!class_exists('Utility'))			require_once(SYSTEM_CLASS_PATH."/Utility.php");
if (!class_exists('NewADOConnection'))	require_once(SYSTEM_CLASS_PATH."/adodb5/adodb.inc.php");
if (!class_exists('ActivityLog'))		require_once(SYSTEM_CLASS_PATH."/ActivityLog.php");
if (!interface_exists('MyInterface'))	require_once(SYSTEM_CLASS_PATH."/IDatabase.php");
if (!class_exists('DbCache'))			require_once(SYSTEM_CLASS_PATH."/DbCache.php");
if (!interface_exists('Database'))		require_once(SYSTEM_CLASS_PATH."/Database.php");
if (!class_exists('CmsDataModel'))		require_once(SYSTEM_CLASS_PATH."/CmsDataModel.php");
if (!class_exists('FormGenerate'))		require_once(SYSTEM_CLASS_PATH."/FormGenerate.php");
if (!class_exists('XmlFormGenerate'))	require_once(SYSTEM_CLASS_PATH."/XmlFormGenerate.php");
if (!class_exists('View'))				require_once(SYSTEM_CLASS_PATH."/View.php");
if (!class_exists('Authen'))			require_once(SYSTEM_CLASS_PATH."/Authentication.php");

if (!isset($_SESSION['DEBUG_VALUE'])) $_SESSION['DEBUG_VALUE'] = array();

?>