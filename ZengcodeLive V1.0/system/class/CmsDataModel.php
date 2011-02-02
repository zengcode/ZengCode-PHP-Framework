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
class CmsDataModel extends DataModel {	
	private $owner;  //เจ้าของ content
	private $state;  //สถานะใน work flow ขณะปัจจุบัน
	private $workFlow	= NULL; //Work Flow ที่ใช้ และ step ต่างๆ
	private $language	= array('th'); //ภาษาที่มี เช่น th, en ,jp
	private $fields		= array();//ชื่อ fileld ใน ภาษาต่าง ๆ
	private $ACL		= array();

	//work flow
	public $workflow;
	public $visibility = array();
	public $id;
	public $nextStatus;
	public $className;

	//view
	public $layout="admin_layout";
	public $view=Null;

    //table
	public $combineTable = 'cms';
	public $contentTable = 'contents';
	public $nextId;
	public $moduleName   = "generic";

	public $debug = 0;


   	public function CmsDataModel()
	{
		parent::DataModel();
		$this->workflow = $this;
		$this->className = $GLOBALS['SYSTEM']['module'];
		$this->action    = $GLOBALS['SYSTEM']['action'];
       

        //Authentication for admin seri
		if ($GLOBALS['SYSTEM']['seri'] == 'admin' )
		{
			if($GLOBALS['SYSTEM']['module'] != 'Login')
			{
				if (!isset($_SESSION['user_name'])){
					$this->redirecUrl = "/admin/Module/Login/Action/LoginForm";
					Utility::Redirect($this->redirecUrl);
				}
			}
		}
		$this->view = new View();
        
	}
 
    //========================================================//

	public function setId($id)
	{
		$this->id = $id;
	}   
    //========================================================//

	public function getId()
	{
		return $this->id;
	}
    //========================================================//

    public function setNextState($nextStatus){
		$this->nextStatus = $nextStatus;
		$sql = "Update ".$this->combineTable." SET state = '".$this->nextStatus."' Where id= ".$this->id;
		echo "<br><br> SQL = ".$sql;
		$this->Execute($sql);
	}
	//========================================================//

	public function LoadACL($acl)
	{
       $this->ACL = $acl;
	}
	//=======================================//
	public function LoadWorkFlow($workFlow=NULL)
	{
		$this->workFlow = $workFlow;
	}
    //=======================================//
    public function GetVisibility($state,$id) //for 1 record
	{
        $this->state = $state;
		$this->visibility = $this->workFlow[$this->state][$_SESSION['user']['level']];
		if ($this->workFlow)
		{
			if (!$this->visibility) return;
			foreach($this->visibility as $key => $value){
			$str .= "<input type='button' class='workFlowButton' value='".$GLOBALS['WorkFlowCaption'][$value]."' onclick=\"javascript:gotoWorkFlow('$id','$value')\"; >&nbsp;&nbsp;";
			}
        }else{
			$str .= "<input type='button' class='workFlowButton' value='Edit' onclick=\"javascript:gotoWorkFlow('$id','Edit')\"; >&nbsp;&nbsp;";
			$str .= "<input type='button' class='workFlowButton' value='Delete' onclick=\"javascript:gotoWorkFlow('$id','Delete')\"; >&nbsp;&nbsp;";
		}
		return $str;
		    
	}

	public function GetVisibilityOutside($state,$id)
	{
		$this->workFlow = $GLOBALS['WorkFlowACSC'];
		return $this->GetVisibility($state,$id);
	}
    //=======================================//
   public function getContentStateUserCanAccess()
	{
	   $state = array();
	   $user_level = $_SESSION['user']['level'];
	   if ($this->workFlow){
		 foreach($this->workFlow as $key => $array)
		{
			 if(is_array($array))
			{
				 foreach($array as $key2 => $value)
				 {
					 if ($key2 == $user_level) array_push($state,$key);
				 }
			}
		 }
	     return $state;
	   }
	   return NULL;

	}

   //=======================================//
	public function SetLanguage($language)
	{
		$this->language = $language;
	}
   //=======================================//
	public  function SetFields($fields='')
    {
		//$this->fields = $fields;
		$this->fields = $fields;
	}
	//========================================//
	
    private function GetCondition()
	{
       $condition = "";
        foreach($this->fields['key'] as $field => $type)
		{ 
           $condition .= ($conditon)? " and $field = ".$this->GetValue($field,$type) : " Where $field = ".$this->GetValue($field,$type);
		}
		return $condition;
	}
    //=======================================//
    private function GetCombineUpdate()
	{
		$sql="";
		foreach($this->fields['combine'] as $field => $type)
		{ 
			$sql .= ($sql)?  "," : "" ;
			$sql .= $field." = ".$this->GetValue($field,$type);
		}
		$query = "Update ".$this->combineTable." Set ".$sql.$this->GetCondition();
		return $query;
	}
	//=======================================//
    public function GetNextId()
	{
        $data = $this->database->Select("Max(id)+1 as nextId")->From($this->combineTable)->Query();
		return $data['record'][0]['nextId'];
	}
	//=======================================//
	  private function GetStartStatus()
	{
		return "Draft"; //แล้วแต่ logic ของ business
	}
	//=======================================//
	 private function GetCombineInsert()
	{
		$this->nextId = $this->GetNextId();
		$sql="Insert Into ".$this->combineTable." (";
		$afield="id";
		$value=$this->nextId;
		foreach($this->fields['combine'] as $field => $type)
		{ 
			$afield .= ($afield)?  "," : "" ;
			$value .= ($value)?  "," : "" ;
			$afield .= $field ;
			$value	.= $this->GetValue($field,$type);
		}
		//set status when insert
            $afield .= ",status";
			$value .= ",'".$this->GetStartStatus()."'";
		//=====================//
		$sql .= $afield.") values (";
		$sql .= $value;
		$sql .= ")";
		return $sql;
	}
	//=======================================//
	public function Insert()
	{
		$query = array();     
		array_push($query, $this->GetCombineInsert());
		foreach($this->language as $key => $lang)
		{
			$sql = "";
			foreach($this->fields['fields'] as $field => $type)
			{ 
				$sql = "Insert into  $this->contentTable ";
				$sql .= " (id,lang,field,content) values  (";
				$sql .= $this->nextId.",";
				$sql .= "'$lang',";
				$sql .= "'".$field."_".$lang."',";
				$sql .= $this->GetValue($field."_".$lang,$type);
				$sql .= ")";
				array_push($query, $sql);
			}		
		}
		if ($this->debug){ print("<pre>");print_r($query);print("</pre>");}
		$this->ExecuteTransaction($query);
	}
    //=======================================//
	public function Update()
	{
		$query = array();     
		array_push($query, $this->GetCombineUpdate());
		foreach($this->language as $key => $lang)
		{
			$sql = "";
			foreach($this->fields['fields'] as $field => $type)
			{ 
				$sql = "Update $this->contentTable ";
				$sql .= " SET ";
				$sql .= "content = ".$this->GetValue($field."_".$lang,$type);
				$sql .=$this->GetCondition();
				$sql .= " and field = '".$field."_".$lang."'";
				array_push($query, $sql);
			}		
		}
		if ($this->debug){ print("<pre>");print_r($query);print("</pre>");}
		$this->ExecuteTransaction($query);
	}
    //=======================================//
   
	public function GetValue($fields,$type)
	{
      switch(strtoupper($type)){
		  case 'POST' : return "'".$_POST["$fields"]."'";
			            break;
		  case 'GET'  : return "'".$_GET["$fields"]."'";
					    break;
		  default     :return "'".$type."'";
			           break;
	  }
	}

	public function Delete()   //must have
	{   
		if ($_GET['id']) $this->id=$_GET['id'];
		$sql[0]="Delete From ".$this->combineTable." Where id = ".$this->id;
        $sql[1]="Delete From ".$this->contentTable." Where id = ".$this->id;
		$this->ExecuteTransaction($sql);
		//print("<pre>");print_r($sql);print("</pre>");
		$url = "/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
		Utility::Redirect($url);
		//
	}
    //=======================================//
	public function UpdateForm() //must have
	{
		//
	}
    //=======================================//
	public function InsertForm() //must have
	{
		//
	}
    //=======================================//
    public function Edit() //must have
	{
		//
	}
    //=======================================//
	public function Add() //must have
	{
		//
	}
    //=======================================//

}

?>