<?php
require_once "config/config.php";


Class ActiveRecord extends Database
{
	 public $tableName;
	 public $primaryKey = array();
	 //private $column		= array();
     public $data;
	 public $isNewRecord = True;

	 public $hasChild     = null;
	 public $child		  = null;

	 public function ActiveRecord()
	 {
		parent::_construt();
		//$this->GetColums();
	 }

	 public function GetColums()
	{
		 //if ($this->database_type == 'mysql')
		 $this->sql = "SHOW COLUMNS FROM ".$this->tableName;
		 $this->rs = &self::$db->Execute($this->sql);
         $this->rs = $this->RecordSet();
		 $this->rs = $this->rs['record'];
		 //$this->column = $this->rs;	 
		 return $this->rs;
	}

	public function Find($condition=null)
	{
		$this->isNewRecord = False;
		$this->sql = "Select * from ".$this->tableName;
		if ($condition)
		{
			$this->sql .= ' Where (1=1) ';
			foreach($condition as $key => $value)
			{
				$this->sql .= "and ($key = '$value' ) ";
			}
		}
		$this->rs = &self::$db->Execute($this->sql);
		if (!$this->rs) return false;
		$this->rs = $this->RecordSet();
		$result = array();
		foreach($this->rs['record'] as $key => $value)
		{
			$objectName = get_class($this);
			$record = new $objectName();
			$record->isNewRecord =  False;
			foreach($this->GetColums() as $key2 => $value2)
			{  
				$record->data->$value2['Field'] = $value[$value2['Field']];
			}
           
			if ($this->hasChild)
			{
				$allChild=array();
				foreach ($this->hasChild as $hasChildKey => $hasChildValue)
				{
					$childRecord = new $hasChildKey();
					$child = $childRecord->Find(array(
											 "$hasChildValue" => $record->data->$hasChildValue
											)
								  );
					//array_push($allChild,$child);
					$record->child->$hasChildKey->data = $child;
				}
				//$record->child->$hasChildKey->data = $allChild;
			}
			
			array_push($result,$record);
		}
		if (!count($result)) return null;
		return $result;
	}

	public function Delete($condition=Null)
	{
	  $this->sql = "Delete From ".$this->tableName." Where 1 ";
	  foreach($this->primaryKey as $key => $value)
	  {
		  $this->sql .= " and $value = '".$this->data->$value."'";
	  }
	  if ($condition)
		{
			$this->sql .= ' Where (1=1) ';
			foreach($condition as $key => $value)
			{
				$this->sql .= "and ($key = '$value' ) ";
			}
		}
	  echo "<BR><font color='red'>".$this->sql."</font><BR>";
	}

	public function DeleteChild()
	{
	}

	public function Save($condition=Null)
	{
		if ($this->isNewRecord)
		    $this->Insert();	
		else	
			$this->Update($condition);
	}

	public function Insert()
	{
		$this->sql="Insert Into ".$this->tableName;
		$tmp1=$tmp2=null;
		foreach($this->data as $key => $value)
		{
			if ($tmp1)
			{
                $tmp1 .= ",".$key;
				$tmp2 .= ",'".$value."'";
			}
			else
			{
				$tmp1 = " (".$key;
				$tmp2 = " ('".$value."'";
			}
			
		}
		$tmp1.=")";
		$tmp2.=")";
		$this->sql .= $tmp1." Value ".$tmp2;
		return self::$db->Execute($this->sql);
	  if(self::$db->Execute($this->sql))
			print("<script>alert('!! Insert New Record Complete !!');</script>");
      else
			print("<script>alert('!! Insert New Record Error !!');</script>");
	}

	public function Update($condition)
	{
		
		$this->sql="Update ".$this->tableName." Set ";
		$tmp1=null;
		foreach($this->data as $key => $value)
		{
			if ($tmp1)
			{
                $tmp1 .= ",".$key."='".$value."'";
				
			}
			else
			{
				$tmp1 = $key."='".$value."'";
			}
			
		}
		$this->sql .= $tmp1;
		if ($condition)
		{
			$this->sql .= ' Where (1=1) ';
			foreach($condition as $key => $value)
			{
				$this->sql .= "and ($key = '$value' ) ";
			}
		}
		

		echo "<BR><font color='red'>".$this->sql."</font><BR>";
		return self::$db->Execute($this->sql);
		if(self::$db->Execute($this->sql))
			print("<script>alert('!! Update New Record Complete !!');</script>");
        else
			print("<script>alert('!! Update New Record Error !!');</script>");
	}

}//end Class ActiveRecord




Class CategoryRecord extends ActiveRecord
{
	public $tableName   = 'category';
	public $primaryKey  =  array('category_id');
	public $hasChild    =  array('ContentRecord' => 'category_id');
}

Class ContentRecord extends ActiveRecord
{
	public $tableName   = 'content';
	public $primaryKey  =  array('content_id');
	public $hasChild    =  array('Content2Record' => 'content_id');
}

Class Content2Record extends ActiveRecord
{
	public $tableName   = 'content2';
	public $primaryKey  =  array('content_id');
}

/*
$test = new Content2Record();
$record = $test->Find( 
							array(
							       'content_id' => '1',
								   'content'	=> '222'
							  )
						);
print("<pre>");print_r($record);print("</pre>");
$record[0]->data->content_id = 5;
$record[0]->data->content    = 'Hello Worldx';
$record[0]->Save(array(
						'content_id' => '1',
						'content'	=> '222')
					  );
					 
exit();

 */

$Customer = new CategoryRecord();
$record = $Customer->Find( 
							array(
							   'category_id' => '8'
							  )
						  );
echo "<hr>"; 
//$Customer->Save();
$record=$record[0]; //get first object
echo "Property <br>";
echo "<BR>tablename = $Customer->tableName<hr>";
echo "<BR>primaryKey ";print("<pre>");print_r($record->primaryKey);print("</pre><hr>");
echo "<BR>data ";print("<pre>");print_r($record->data);print("</pre><hr>");
echo "<BR>data ";print("<pre>");print_r($record->data->category_name);print("</pre><hr>");
$Child = $record->child;
//print("<pre>");print_r($Child);print("</pre><hr>");
echo "<hr>";
$C1 = $Child->ContentRecord->data[0];
echo  "Heyyyyyyyyyyyy ===> ".$C1->data->content_name;
$C1->Delete();

$C1->data->content_name="Hello Pee I Love You xxxx";
$C1->Save();

echo "<hr>";
$C11 = $C1->child;
$C2 = $C11->Content2Record->data[0];
$C2->Delete();
//print("<pre>");print_r($C2->content);print("</pre><hr>");
echo  "Heyyyyyyyyyyyy ===> ".$C2->data->content;
//echo "<BR>child 1 is a array of ActiverRecord Object ";print("<pre>");print_r($record->child[0][0]->data);print("</pre><hr>");
//echo "<BR>child 2 is a array of ActiverRecord Object ";print("<pre>");print_r($record->child[0][1]->data);print("</pre><hr>");
//echo "<BR>child 1.1 is a array of ActiverRecord Object ";print("<pre>");print_r($record->child[0][0]->child[0][0]->data);print("</pre><hr>");
//echo "<BR>child 1.2 is a array of ActiverRecord Object ";print("<pre>");print_r($record->child[0][0]->child[0][1]->data);print("</pre><hr>");
//print("<pre>");print_r($record);print("</pre><hr>");
exit();






























$Customer = new CategoryRecord();
$record = $Customer->Find( 
							array(
							   'category_id' => '8'
							  )
						  );
echo "<hr>"; 
print("<pre>");print_r($record);print("</pre><hr>");

//$data = $record[0];
///$data->data->category_name = "Hello World";
//print("<pre>");print_r($data);print("</pre>");
//$data->Delete();
//$data->Save();
//$ActiveRecord->SetTableName('category');
//$ActiveRecord->OneToOne();

exit();


if ($this->hasChild)
			{
				//echo "<font color=red size=5>Has Child</font>";
				$allChild=array();
				foreach ($this->hasChild as $hasChildKey => $hasChildValue)
				{
					$childRecord = new $hasChildKey();
					$this->GetColums();
					$childRecord->Find(array(
											 "$hasChildValue" => $record->data->$hasChildValue
											)
								  );
					echo ">>>> $hasChildKey ====> $hasChildValue ";
					array_push($allChild,$childRecord);
				}
				$record->child = $allChild;
}









?>