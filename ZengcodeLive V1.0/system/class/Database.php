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

Class Database implements  IDatabase
{
private static $con=NULL;
public $sql;
protected $numRow			=10;	//number of row to show per page
protected $page				=1;     //current page
protected $numPage			=1;		//number of page
protected $numRec			=1;     //nuber of record

protected $database_type;
protected $database_user;
protected $database_password;
protected $database_name;
public static $db		= NULL;	
public $rs				= NULL;
protected $cache			= NULL;

protected $select_str;
protected $from_str ;
protected $where_str ;
protected $group_str ;
protected $having_str ;
protected $sort_str ;
protected $query_str ;

private $private			= true;
private $logs				= true;

private static $DbCache;
private static $ActivityLog;
private static $logSessionOwner   = 'userName';



private $additionalLanguage = array('en','jp','cn');

public function _construt()
{
	if (self::$db == NULL){
		$this->database_host		=	$GLOBALS['DATABASE']['DATABASE_HOST'];
		$this->database_type		=	$GLOBALS['DATABASE']['DATABASE_TYPE'];
		$this->database_user		=	$GLOBALS['DATABASE']['USER'];
		$this->database_password	=	$GLOBALS['DATABASE']['PASSWORD'];
		$this->database_name		=	$GLOBALS['DATABASE']['DATABASE_NAME'];
		self::$db					=	NewADOConnection("$this->database_type");
		$this->Debug();
			if (!self::$db->PConnect("$this->database_host", "$this->database_user", "$this->database_password", "$this->database_name"))
			{
			    //die('Can not connect to database.Please check your database is start up.'); 
				$data['error_topic'] =  "Warning...... ";
				$data['error_msg']   =   "Can not connect to database.<BR>Please check your database is start up.<BR> 
				Please check Database's name ,Username and Password ";
				View::LoadView('error','error',$data) ;
				die();
			}
			self::$db->SetFetchMode(ADODB_FETCH_ASSOC); 
			if ($this->database_type == 'mysql') self::$db->Execute("SET NAMES UTF8");
	}
	self::$DbCache = new DbCache();
	self::$ActivityLog = new ActivityLog();
}

public function SetNumRow($numRow)
{
	$this->numRow=$numRow;
	return $this;
}

public function Select($str)
{
	$this->select_str=$str;
	return $this;
}

public function From($str)
{
	$this->from_str=$str;
	return $this;
}

public function Where($str)
{
	$this->where_str=$str;
	return $this;
}

public function Group($str)
{
	$this->group_str=$str;
	return $this;
}

public function Having($str)
{
	$this->having_str=$str;
	return $this;
}

public function Sort($str)
{
	$this->sort_str=$str;
	return $this;
}

public function QueryString($str)
{
	$this->query_str=$str;
	return $this;
}

public function PrepareQueryString()
{
	if (!empty($this->where_str)) {
	   $this->where_str = "WHERE $this->where_str";
	} else {
	   $this->where_str = NULL;
	} // if
	if (!empty($this->group_str)) {
	   $this->group_str = "GROUP BY $this->group_str";
	} else {
	   $this->group_str = NULL;
	} // if
	if (!empty($this->having_str)) {
	   $this->having_str = "HAVING $this->having_str";
	} else {
	   $this->having_str = NULL;
	} // if
	if (!empty($this->sort_str)) {
	   $this->sort_str = "ORDER BY $this->sort_str";
	} else {
	   $this->sort_str = NULL;
	} // if

	 if($this->query_str) return $this->query_str;
	 $this->sql =    "SELECT $this->select_str
					 FROM $this->from_str 
					 $this->where_str 
					 $this->group_str 
					 $this->having_str 
					 $this->sort_str 
					 "; 	
	return $this->sql;
}

public function LimitQuery($page=1)
{   
	if (isset($_GET['page'])) $page=$_GET['page'];
	$query=$this->PrepareQueryString();
	$query2 = "SELECT Count(*) as numRec
              FROM $this->from_str 
					 $this->where_str 
					 $this->group_str 
					 $this->having_str 
					 $this->sort_str   
				";

    $this->rs = &self::$db->Execute($query2);
    if (!$this->rs) {
		//print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
    $numRec   = $this->rs->fields['numRec'];  //number of all record 
	$this->numRec = $numRec;
	$this->page=$page;
	$this->numPage=($numRec % $this->numRow)? floor($numRec/$this->numRow)+1 : floor($numRec/$this->numRow);
	$startRecord=($page * $this->numRow)- $this->numRow;
	
	$this->rs = &self::$db->SelectLimit($query, $this->numRow, $startRecord);
	if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
	$this->rs = $this->RecordSet($this->rs);
	return $this->rs;
}
//=======================================================================================//

public function LimitQueryCache($page,$cache_Name=NULL)
{  
	$cacheName = NULL;
	if ($cache_Name != NULL)
	{
		$cacheName = $cache_Name."_".$page;
		$rs = self::$DbCache->GetSerializationObject($cacheName);
		if ($rs) 
		{
			//echo "use cache";
			return $rs;
		}//else echo "from database";
			
	}
	
	$query=$this->PrepareQueryString();
	$query2 = "SELECT Count(*) as numRec
              FROM $this->from_str 
					 $this->where_str 
					 $this->group_str 
					 $this->having_str 
					 $this->sort_str   
				";

    $this->rs = &self::$db->Execute($query2);
    if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
    $numRec   = $this->rs->fields['numRec'];  //number of all record 
	$this->numRec = $numRec;
	$this->page=$page;
	$this->numPage=($numRec % $this->numRow)? floor($numRec/$this->numRow)+1 : floor($numRec/$this->numRow);
	$startRecord=($page * $this->numRow)- $this->numRow;
	
	$this->rs = &self::$db->SelectLimit($query, $this->numRow, $startRecord);
	if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
	$this->rs = $this->RecordSet($this->rs);
	if ($cacheName != NULL)
		self::$DbCache->SetSerializationObject($this->rs,$cacheName);
	return $this->rs;
}



//=======================================================================================//

public function Query($cacheName=NULL) //alway use at backend after insert,delete and update 
{
    $query=$this->PrepareQueryString();
	$this->rs = &self::$db->Execute($query);
	if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
	$this->rs = $this->RecordSet();
    if ($cacheName != NULL)
		self::$DbCache->SetSerializationObject($this->rs,$cacheName);

	return $this->rs;

}


public function GetQuery($sql,$cacheName=NULL) //alway use at backend after insert,delete and update 
{
    $query=$sql;
	$this->rs = &self::$db->Execute($query);
	if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
		return NULL;
	}
	$this->rs = $this->RecordSet();
    if ($cacheName != NULL)
		self::$DbCache->SetSerializationObject($this->rs,$cacheName);

	return $this->rs;

}

public function Find($cacheName=NULL) //alway use at backend after insert,delete and update 
{
	 
	 if ($cacheName != NULL)
	{
		$this->rs = self::$DbCache->GetSerializationObject($cacheName);
		if ($this->rs) return $this->rs['record'][0];
	}

    $query=$this->PrepareQueryString();
	$this->rs = &self::$db->Execute($query);
	if (!$this->rs) {
		print self::$db->ErrorMsg(); // Displays the error message if no results could be returned
        Utility::Redirect("/Module/Error/Action/InvalidSql");
		die();
		return NULL;
	}
	$this->rs = $this->RecordSet();
    if ($cacheName != NULL)
		self::$DbCache->SetSerializationObject($this->rs,$cacheName);

	return $this->rs['record'][0];

}

public function QueryCache($cacheName=NULL) //alway use at frontend 
{
    if ($cacheName != NULL)
	{
		$rs = self::$DbCache->GetSerializationObject($cacheName);
		//if ($rs) echo "from cache"; else echo "user Query";
		return ($rs)? $rs : $this->Query($cacheName);
			
	}
}

public function RecordSet()
{  // echo "zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz "$this->rs['databaseType'];
	//print("<pre>");print_r($this->rs);print("</pre>");
	if ($this->rs->EOF) { 	
		//Utility::Redirect("/Module/Error/Action/InvalidContent");
		//die();
	}
	$rs=array();
	$index=0;
    while (!$this->rs->EOF) {
		//echo "<br> ===> ".$this->rs->fields;
		//$this->rs->fields =  str_replace('\"', '"', $this->rs->fields);
		//$this->rs->fields =  str_replace("\'", "'", $this->rs->fields);
		$rs[$index++]=$this->rs->fields;
		$this->rs->MoveNext();  //  Moves to the next row
	 }  // end while
	 $result['record']			=	$rs;
	 $result['currentPage']		=	$this->page;
	 if($rs)
	 {
		$result['numberOfRecord']	=	$this->numRec;
		$result['numberOfPage']	=	$this->GetNumPage();
	 }
	 else
	 {
		$result['numberOfRecord']	=	0;
		$result['numberOfPage']		=	0;
	 }
	 
	 return $result;
}

public function Execute($query,$cacheName=NULL)
{
	include_once SYSTEM_CLASS_PATH. '/securimage/securimage.php';
	$securimage = new Securimage();

	if ($_POST['captcha_code'])
	if ($securimage->check($_POST['captcha_code']) == false) 
	{
	  print("<script>alert('The security code you entered was incorrect');</script>");
	  return NULL;
	}

	
	if ($cacheName) $this->ClearCache($cacheName);
	$this->rs = &self::$db->Execute($query);
	if (!$this->rs) {
		
		$this->SetLog("ERROR : ".self::$db->ErrorMsg().$query);
		return NULL;
	}
	$this->SetLog($query);
	return true; //$this->rs;
}


public function  ExecuteTransaction($query_array)
{
	self::$db->StartTrans();
		foreach ($query_array as $query)
		{
			self::$db->Execute($query);
		    $this->SetLog($query);
		}
	self::$db->CompleteTrans();
	if (self::$db->HasFailedTrans()) {// Something went wrong	
	   $this->SetLog("Transaction Error");
		return NULL;
	}
	return true;
}

public function Logs($logs)
{
	$this->logs = $logs;
}

public function SetLog($activity)
{
   if ($this->logs) self::$ActivityLog->SaveLog($_SESSION["self::$logSessionOwner"],$activity);
}

public function ClearCache($cacheName)
{
   self::$DbCache->ClearSerializationObject($cacheName);
}

public function ClearArrayCache($cacheArray)
{
  foreach($cacheArray as $key => $cacheName) self::$DbCache->ClearSerializationObject($cacheName);
}

public function GetNumPage()
{
	return $this->numPage;   //return number of page ,for all record that limit by numRow	
}

public function GetCurrentPage()
{
	return $this->page;
}

private function Debug()
{
	if ($this->debug){
          self::$db->debug = true;
	}
}


public function GenerateInsertQuery($data)
{	
   $query = "Insert into ".$data['table'];
   $tmp = NULL;
   $tmp2= NULL;
   foreach($data['fields']  as $fieldName => $fieldType)
   {
		 if ($tmp == NULL) $tmp .= " (".$fieldName;
		 else              $tmp .= ",".$fieldName;

		 if ($tmp2 == NULL) $tmp2.=  "(";
		 else               $tmp2 .= ",";
         $fieldValue=$fieldType;
         $fieldType=strtoupper($fieldType);
		 switch ($fieldType)
		 {
		  case 'GET' : $tmp2 .= "'".$_GET[$fieldName]."'"; 
						break;
		  case 'POST' : $tmp2 .= "'".$_POST[$fieldName]."'"; 
						break;
		  case 'VAR'  : $tmp2 .= "'".$GLOBALS[$fieldName]."'"; 
						break;
          case 'NOW'  : $tmp2 .= "now()"; 
						break;
						//$this->database_type
          default     : $tmp2 .= "'".$fieldValue."'"; 
						break;
		 }//swithch
   }//foreach
   $tmp .=") Values ";
   $tmp2.=")";
   $query .= $tmp.$tmp2;
   return $query;
}

public function GenerateUpdateQuery($data,$condition)
{	
   $query = NULL;
   foreach($data['fields']  as $fieldName => $fieldType)
   {
		 if ($query == NULL) $query = "Update ".$data['table']." SET ";
		 else			   $query .= ",";
		 $fieldValue=$fieldType;
         $fieldType=strtoupper($fieldType);
		 switch ($fieldType)
		 {
		  case 'GET' :  $query .= $fieldName."='".$_GET[$fieldName]."'"; 
						break;
		  case 'POST' : $query .= $fieldName."='".$_POST[$fieldName]."'"; 
						break;
		  case 'VAR'  : $query .= $fieldName."='".$GLOBALS[$fieldName]."'"; 
						break;
          default     : $query .= $fieldName."='".$fieldValue."'"; 
						break;
		 }//swithch
   }//foreach
   $query .= " Where ".$condition;
  
   return $query;
}

public function ShowArray($arr)
{
  print("<pre>");print_r($arr);print("</pre>");
}

}//end class

//=============================================================================================//



















Class DataModel extends Database
{
public $viewFolder;
public $database;
public $form;
	
public function DataModel()
{
	parent::_construt();
	$this->database = $this;
	$this->form = new FormGenerate();
}

public function View($folder,$view,$data)  //สำหรับ load view ที่แสดงข้อความโดยไม่ต้องการใช้ template หรือ layout
{
	View::LoadView($folder,$view,$data);
}

public function LayOut($layout,$folder,$view,$data=NULL) //select layout and push view to it  
{
    View::LoadLayout($layout,$folder,$view,$data);
}
  

public function Redirect($seri,$module,$action)
{
		ob_get_clean();
		$uri = "/$seri/".$GLOBALS['MODULE_VAR']."/".$module."/".$GLOBALS['ACTION_VAR']."/".$action;
		header('Location: '.$uri);
}

public function Authen() //for back-end
{
	Authen::AuthenBackend();
}

public function ImportUserClass($className)
{
	require_once(USER_CLASS_PATH."/".$className.".php");
}

}//end class


//=============================================================================================//
?>