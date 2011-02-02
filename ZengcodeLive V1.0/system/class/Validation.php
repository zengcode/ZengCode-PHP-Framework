<script language="javascript" src="/script/prototype.js"></script>
<!-- Validation.php -->
<script type="text/JavaScript">

function confirmlink() 
{
	if (confirm("<?=$GLOBALS['alert']['confirmlink']?>")) 
		return true;
    else 
		return false;
}

function isEmpty(itemId)
{
	if ( $(itemId).value == "" )
	{
		$(itemId).activate();
		return true;
	}
	else
		return false;
}

function isNotEmail(itemId)
{
    var mail = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,3})$");
	if ( $(itemId).value.match(mail) )
	{
		$(itemId).activate();
		return false;
	}
	else
	{
		$(itemId).activate();
		return true;
	}
}

function isSame(itemId1,itemId2)
{
	if ( $(itemId1).value == $(itemId2).value )
		return true;
	else
	{
		$(itemId1).activate();
		return false;
	}
}


function IsNotNumber(itemId)
{
   var sText=$(itemId).value;
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
  $(itemId).activate();
   return IsNumber;
 }

function IsInlength(itemId,min,max)
{
     var sText=$(itemId).value;
	 if (sText.length < min || sText.length > max)
	 {
		  $(itemId).activate();
		 return false;
	 }
	 return true;
}

function IsNumberLength(itemId,min,max)
{
    var sText = parseInt($(itemId).value);
	if (sText < min || sText > max )
	{
		 $(itemId).activate();
		return false;
	}
	return true;
}

//IsNumberLength('name',5,10);

function checkpasscom(theForm)
{
	theForm.password.disabled=!theForm.changepass.checked;
	theForm.confirm_password.disabled=!theForm.changepass.checked;
	
	if (theForm.changepass.checked) {
		theForm.password.value = "";
		theForm.confirm_password.value = "";
	} else {
		theForm.password.value = "notchange";
		theForm.confirm_password.value = "notchange";
	}
}

</script>

<script>  <!-- Validation.php -->
				function gotoWorkFlow(id,nextState)
				{
				   if (confirm('Confirm')){
						if (nextState == 'Edit'){
							window.location = '/admin/Module/<?=$this->className?>/Action/EditForm/id/'+id+'/nextState/'+nextState;
						}else if(nextState == 'Delete'){
							window.location = '/admin/Module/<?=$this->className?>/Action/Delete/id/'+id+'/nextState/'+nextState;
						}
						else{
							window.location = '/admin/Module/WorkFlow/Action/SetStatus/id/'+id+'/nextState/'+nextState+'/Module2/<?=$this->className?>/Action2/<?=$this->action?>';
						}
				   }
				}
</script>
<?php
/***********************************************
August 28,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
Class Validation{
    public  static $configuration;
	public static function GenerateValidation($configuration){
		self::$configuration = $configuration;
		$fields = $configuration;
	  // print("<pre>");print_r($fields);print("</pre>");
      $DbCache = new DbCache();
	  $objName = "validation/".md5($uri = PREFIX.$_SERVER['REQUEST_URI']);
	  $str = $DbCache->GetSerializationObject($objName);
	  if ($str)
	  {
           //return $str;
	  }
      $str ="<script>\n
			function Validation()\n
			{\n
			
		";	
		   for ($i=0;$i<count($fields);$i++)
		   {
			  $null	=  $fields[$i]['null'];
			  if ($null == 'no')
			  $str .= self::CheckNull($fields[$i]);
			  $str .= self::GenerateScript($fields[$i]);
		    }
      $str .= "return true; \n";
	  $str .= "}\n";
	  $str .= "</script>\n";
	  
	  $DbCache->SetSerializationObject($str,$objName);
     return $str;
	}

	public static function GenerateScript($field)
	{
		$str = "";
		switch($field['validate'])
		{
			case 'email' : $str = self::CheckEmail($field);
				           break;
            case 'number': $str = self::CheckNumber($field);
				           break;
            case 'editor': $str = self::CheckEditor($field);
				           break;
		}
		if ($field['str_length'] != "" )
		{
			$str.= self::CheckLength($field);
		}
		if ($field['number_length'] != "" )
		{
			$str.= self::CheckNumberLength($field);
		}
		if ($field['same'] != "" )
		{
			$str.= self::CheckSame($field);
		}
        return $str;
	}

	 public static function CheckEditor($field)
	{
		 $str  = " oEditor = FCKeditorAPI.GetInstance('".$field['name']."'); \n";
		 $str .= "var text = oEditor.GetHTML(); \n";
		 $str .= "if ( text == \"\" ) { \n ";
		 $str .= "alert('".$field['error_msg']."');\n";
		 $str .= "oEditor.Focus();";
		 $str .= "return false; \n";
		 $str .= "} \n";
	    return $str;	
	} 

    public static function CheckNull($field)
	{
		$str = "if ( isEmpty('".$field['name']."') ) { \n";
		$str.= "alert('".$field['error_msg']."');\n";
		$str.= "return false; \n";
		$str.= "} \n";
	    return $str;	
	} 
	
	public static function CheckEmail($field)
	{
		$str = "if ( !isEmpty('".$field['name']."') ) { \n";
		 $str .= "if ( isNotEmail('".$field['name']."') ) { \n ";
		 $str.= "		alert('".$field['error_msg']." (Invalid Email)');\n";
		 $str.= "		return false; \n";
		 $str.="} \n";
		$str.= "} \n";
		return $str;
	}

	public static function CheckNumber($field)
	{
		$str = "if ( !isEmpty('".$field['name']."') ) { \n";
		 $str .= "if ( !IsNotNumber('".$field['name']."') ) { \n ";
		 $str.= "		alert('".$field['error_msg']." (Invalid Number)');\n";
		 $str.= "		return false; \n";
		 $str.="} \n";
		$str.= "} \n";
		return $str;
	}
    
	public static function CheckLength($field)
	{
		 list($min,$max) = split('-',$field['str_length']);
		 $str = "if ( !isEmpty('".$field['name']."') ) { \n";
		 $str .= "if ( !IsInlength('".$field['name']."',$min,$max) ) { \n ";
		 $str.= "		alert('".$field['error_msg']." (Invalid Length ".$field['str_length']." Characters)');\n";
		 $str.= "		return false; \n";
		 $str.="} \n";
		 $str.= "} \n";
		 return $str;
	}

	public static function CheckNumberLength($field)
	{
		 list($min,$max) = split('-',$field['number_length']);
		 $str = "if ( !isEmpty('".$field['name']."') ) { \n";
		 $str .= "if ( !IsNumberLength('".$field['name']."',$min,$max) ) { \n ";
		 $str.= "		alert('".$field['error_msg']." (Invalid Length, must be ".$field['number_length'].")');\n";
		 $str.= "		return false; \n";
		 $str.="} \n";
		 $str.= "} \n";
		 return $str;
	}

	public static function CheckSame($field)
	{
		 $same=$field['same'];
		 $str = "if ( !isEmpty('".$field['name']."') ) { \n";
		 $str .= "if ( !isSame('".$field['name']."','$same') ) { \n ";
		 $str.= "		alert('".$field['error_msg']." (same to $same)');\n";
		 $str.= "		return false; \n";
		 $str.="} \n";
		 $str.= "} \n";
		 return $str;
	}




















	public static function generatex($fields){
		$str="<script> \n";
		for ($i=0;$i<count($fields);$i++){
			$validation  =  $fields[$i]['validate'];
			$type        =  $fields[$i]['validate'];
			$name        =  $fields[$i]['name'];
			$length      =  $fields[$i]['length'];
			if ($validation) {
				$str.= " var $name = new LiveValidation( '$name' ); \n";
    			$str.= " $name.add( Validate.Presence ); \n";
				if ($type == 'integer')
				   $str.= " $name.add( Validate.Numericality, { onlyInteger: true } ); \n";
				if ($type == 'number')
				   $str.= " $name.add( Validate.Numericality ); \n";
				if ($length) {
                     list($min, $max) = split('-', $length);
				      $str.= " $name.add( Validate.Numericality, { minimum: $min, maximum: $max } ); \n";
				}
				if ($type == 'email')
				   $str.= " $name.add( Validate.Email  ); \n";
			}//if
		}//for
		$str.="</script> \n";
		return $str;
	}

}//================================================//
?>
<!-- <pre>
	[type] => field
    [name] => weight
    [label_th] => email
    [label_en] => email
    [label_jp] => email
    [input_type] => textBox
    [style] => textBox
    [null] => no
    [validate] => email
    [length] => 
</pre> -->