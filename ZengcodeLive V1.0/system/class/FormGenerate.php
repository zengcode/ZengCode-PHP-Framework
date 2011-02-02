<?php
/***********************************************
August 28,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');

Class FormGenerate
{
	private $lang = 'th';
	private $result ;
	private $currentField;
	private $dataSet;
	private $validateData=array();
	private $Validation;

	private $td_class = "bg-td-list-head";
    public function FormGenerateLoad()
	{
		if (!class_exists('Validation'))		require_once(SYSTEM_CLASS_PATH."/Validation.php");
		$this->Validation = new Validation();

	}
    
	public function GenerateButton()
	{
		return "<input type='submit' class='submitButton' value='Submit' onclick='return Validation();'>";
	}

    public function GenerateFormXml($xml_file,$data=NULL)
	{
	   $this->FormGenerateLoad();
	   $this->dataSet = $data;
	   //$_SESSION['lang'] = 'th';
	   $this->lang = (isset($_SESSION['lang']))? ($_SESSION['lang'])? $_SESSION['lang']: 'th'  : 'th'  ; 
	   $form = XmlFormGenerate::ExtractData($xml_file.".xml");
	   $this->result="<form method='post' action='".$form_configuration['action']."' > \n";
	   $this->result .="<table border='0'> \n";
	  //print("<pre>");print_r($form);print("</pre>");
	   foreach($form as $key => $field)
		{
		   //print("<pre>");print_r($field);print("</pre>");
		$this->currentField = $field;
		$this->result  .= "<tr  valign='top'><td>";
		$this->result  .= $this->GetLabel();
		$this->result  .= "</td><td>";
		   if ($field['type'] == 'field' )
               $this->result .= $this->GenerateField();
           else{}
			   //$this->result .= $this->GenerateGroup();
		   $this->result .= "</td></tr> \n ";
		}//end foreach
		$this->result .="<tr><td></td><td><input type='Submit' value='Submit' ></td></tr> \n";
        $this->result .= "</table> \n";  
		$this->result .="</form> \n";
		$validate = $this->Validation->generate($this->validateData);
		return $this->result.$validate;

	}//m

	public function GenerateFormTabXml($xml_file,$data=NULL)
	{
		 $_SESSION['lang'] = 'th';
	   $this->FormGenerateLoad();
	   $this->dataSet = $data;
	   $this->lang = (isset($_SESSION['lang']))? ($_SESSION['lang'])? $_SESSION['lang']: 'th'  : 'th'  ;
	   $form = XmlFormGenerate::ExtractData($xml_file.".xml");
         foreach($GLOBALS['LANGUAGE'] as $key => $language){
				$this->result = "<table border='0'> \n";
			   foreach($form as $key => $field)
				{
						$this->currentField = $field;
						$this->currentField['name'] .= "_".$language;
						$this->result  .= "<tr  valign='top'><td>";
						$this->result  .= $this->GetLabel();
						$this->result  .= "</td><td>";
						   if ($field['type'] == 'field' )
							   $this->result .= $this->GenerateField();
						   else
							   $this->result .= $this->GenerateGroup();
						   $this->result .= "</td></tr> \n ";
				}
				$this->result .= "</table> \n";  
				$result["$language"] = $this->result;
         }
        $result['combine']  = $this->Combine($combine,$data);

		$result['validate'] = $this->Validation->generate($this->validateData);
		//return $this->Tab($result);
		return $this->result="<form method='post' action='".$form_configuration['action']."' > \n <p>" 
			                 .$this->Tab($result)
							 ."</p><BR><div><table><tr><td></td><td><input type='Submit' value='Submit'></td></tr> </table></div> \n";
			;
		//return $result;

	}//m


	public function GenerateForm($config_file,$data=NULL)
	{
	   $this->FormGenerateLoad();
	   $this->dataSet = $data;
	   //$_SESSION['lang'] = 'th';
	   $this->lang = (isset($_SESSION['lang']))? ($_SESSION['lang'])? $_SESSION['lang']: 'th'  : 'th'  ;
	   $fileName = FORM_GENERATE_PATH."/".$config_file.".php";
	   require_once($fileName);  
	   $this->result="<form method='post' action='".$form_configuration['action']."' > \n";
	   $this->result .="<table border='0' width='700px'> \n";
	   //print("<pre>");print_r($form_configuration);print("</pre>");
	   foreach($form as $key => $field)
		{
		$this->currentField = $field;
		$this->result  .= "<tr  valign='top' width='50%' ><td class='$this->td_class'>";
		$this->result  .= $this->GetLabel();
		$this->result  .= "</td><td>";
		   if ($field['type'] == 'field' )
               $this->result .= $this->GenerateField();
           else
			   $this->result .= $this->GenerateGroup();
		   $this->result .= "</td></tr> \n ";
		}//end foreach
		$this->result .="<tr><td></td><td>".$this->GenerateButton()."</td></tr> \n";
        $this->result .= "</table> \n";  
		$this->result .="</form> \n";
		$validate = $this->Validation->GenerateValidation($this->validateData);
		return $this->result.$validate;

	}//m

	public function GenerateFormTab($config_file,$data=NULL)
	{
	   $_SESSION['lang'] = 'th';
	   $this->FormGenerateLoad();
	   $this->dataSet = $data;
	   $this->lang = (isset($_SESSION['lang']))? ($_SESSION['lang'])? $_SESSION['lang']: 'th'  : 'th'  ;
	   //echo FORM_GENERATE_PATH;
	   //print("<pre>GenerateFormTab");print_r($GLOBALS['SYSTEM']);print("</pre>");
	   $fileName="application/Module/".$GLOBALS['SYSTEM']['module']."/form_configuration/".$config_file.".php";
	   //echo $fileName;
	   if (!file_exists($fileName)) die ("<font color='red'><B>No Form Configuration</B></font>");
	   $fileName = FORM_GENERATE_PATH."/".$config_file.".php";
	   //echo "<br>FormGenerate.php ====><B>$fileName</B>";
	   require_once($fileName);  
         $result = array();
         foreach($GLOBALS['LANGUAGE'] as $key => $language){
				$this->result = "<table border='0'> \n";
			   foreach($form as $key => $field)
				{
				$this->currentField = $field;
				$this->currentField['name'] .= "_".$language;
				$this->result  .= "<tr  valign='top'><td>";
				$this->result  .= $this->GetLabel($language);
				$this->result  .= "</td><td>";
				   if ($field['type'] == 'field' )
					   $this->result .= $this->GenerateField();
				   else
					   $this->result .= $this->GenerateGroup();
				   $this->result .= "</td></tr> \n ";
				}
				$this->result .= "</table> \n";  
				$result["$language"] = $this->result;
         }
        $result['combine']  = $this->Combine($combine,$data);
		$result['validate'] = $this->Validation->GenerateValidation($this->validateData);
		//return $this->Tab($result);
		return $this->result="<form method='post' action='".$form_configuration['action']."' > \n <p>" 
			                 .$this->Tab($result)
							 ."</p><BR><div><table><tr><td></td><td>".$this->GenerateButton()."</td></tr> </table></form></div> \n";
			;
		//return $result;

	}//m


    public function Combine($combine,$data=NULL)
	{
		if (!$combine) return NULL;
		$result .="<table border='0'> \n";
	   //print("<pre>");print_r($form_configuration);print("</pre>");
	   foreach($combine as $key => $field)
		{
		$this->currentField = $field;
		$result  .= "<tr  valign='top'><td>";
		$result  .= $this->GetLabel();
		$result  .= "</td><td>";
		   if ($field['type'] == 'field' )
               $result .= $this->GenerateField();
           else
			   $result .= $this->GenerateGroup();
		   $this->result .= "</td></tr> \n ";
		}//end foreach
        $result .= "</table> \n";  
		return $result;
	}

	public function Tab($fields)
	{
		$label = $GLOBALS['LABEL'];
		$result="";
          
			$result .= "<FIELDSET style='background-color :#FFFFFF'>";
			$result .= "<LEGEND><B>".$label['combine']."</B></LEGEND>";
            $result .= $fields['combine'];
			$result .= "</FIELDSET>";
		foreach ($fields as $key => $value)
		{
			if ($key == 'combine' || $key == 'validate') continue;
			$result .= "<FIELDSET>";
			$result .= "<LEGEND><B>".$label[$key]."</B></LEGEND>";
            $result .= $value;
			$result .= "</FIELDSET>";
		}
		$result .= $fields['validate'];
		return $result;
	}

	public function Tabx($fields){		
		
		$label = $GLOBALS['LABEL'];
		
		$tab = "<ul id=\"flowertabs\" class=\"shadetabs\">";
		$i=1;
		foreach ($fields as $key => $value)
		{
			if ($key == 'combine' || $key == 'validate') continue;
				 $tab .=  "<li><a href=\"#\" rel=\"tcontent".$i."\">".$label[$key]."</a></li> \n";
				 $content .= "<div id=\"tcontent".$i."\" class=\"tabcontent\">\n";
				 $content .= $value."\n";
				 $content .= "</div>\n";
				 $i++;
	    }	
		$tab .=   "<li><a href=\"#\" rel=\"tcontent".$i."\" class=\"selected\">".$label['combine']."</a></li> \n";
        $content .= "<div id=\"tcontent".$i."\" class=\"tabcontent\">\n";
				 $content .= $fields['combine']."\n";
				 $content .= "</div>\n";
	    $tab .="</ul> \n";
		$content = "<div style=\"border:1px solid gray; width:800px; margin-bottom: 1em; padding: 10px\"> \n".$content;
		$content .= "</div> \n";

		$result = $tab.$content.
			" \n <script type=\"text/javascript\">
			var myflowers=new ddtabcontent(\"flowertabs\") //enter ID of Tab Container
			myflowers.setpersist(true) //toogle persistence of the tabs' state
			myflowers.setselectedClassTarget(\"link\") //\"link\" or\"linkparent\"
			myflowers.init()
			</script> \n
			";
		$result .= $fields['validate'];
		return $result;
	}

	public function GenerateField()
	{
		   array_push($this->validateData,$this->currentField);
		   switch($this->currentField['input_type'])
		   {
			 case 'hidden'				: return $this->GenerateHidden(); break;
			 case 'textBox'				: return $this->GenerateTextBox(); break;
			 case 'textArea'			: return $this->GenerateTextArea(); break;
			 case 'textEditorStandard'	: return $this->GenerateTextEditorStandard(); break;
			 case 'textEditorStandardSmall'	: return $this->GenerateTextEditorStandardSmall(); break;
			 case 'textEditorBasic'		: return $this->GenerateTextEditorBasic(); break;
			 case 'textEditorBasicSmall': return $this->GenerateTextEditorBasicSmall(); break;
			 case 'calendar'			: return $this->GenerateCalendar(); break;
			 case 'radio'				: return $this->GenerateRadio(); break;
			 case 'checkbox'			: return $this->GenerateCheckbox(); break;
			 case 'dropdown'			: return $this->GenerateDropdown(); break;
			 case 'dropdownDb'			: return $this->GenerateDropdownDb(); break;
			 case 'function'			: return $this->GenerateFunction(); break;
			 case 'image'				: return $this->GenerateTextEditorImage(); break;
			 case 'captcha'				: return $this->GenerateCaptcha(); break;
			}//end switch
		
	}//m

	public function GenerateGroup(){
		$member = $this->currentField['member'];
		//print "<pre>"; print_r($member); print "</pre>";
		$result="<table valign='top'>";
		foreach($member as $key => $field)
		{
		   $this->currentField = $field; 
		   $result  .= "<tr  valign='top'><td class='$this->td_class'>";
		   $result  .= $this->GetLabel();
		   $result  .= "</td><td>";
           $result .= $this->GenerateField();
		   $result  .= "</td></tr> \n";
		}//end foreach
		$result.="</table>";
		return $result;
	}//m

	 public function GenerateTextEditorBasic()
	{
		require_once  'files/FckAjaxFileManage/fckeditor/fckeditor.php';
		$value = ($this->dataSet)? $this->dataSet[$this->currentField['name']] : '';
		$oFCKeditor = md5(microtime());
		$$oFCKeditor = new FCKeditor($this->currentField['name']) ;
		$$oFCKeditor->ToolbarSet= 'Basic'; 
		$$oFCKeditor->BasePath		= '/files/FckAjaxFileManage/fckeditor/' ;//SYSTEM_CLASS_PATH.'/FckAjaxFileManage/fckeditor/' ;
		$$oFCKeditor->Value		= $value;
		$$oFCKeditor->Height		= 400; 
		$$oFCKeditor->Width		= 650; 
		$result = $$oFCKeditor->GetEditor() ;
		return $result;
	}

	public function GenerateTextEditorBasicSmall()
	{
		require_once  'files/FckAjaxFileManage/fckeditor/fckeditor.php';
		$value = ($this->dataSet)? $this->dataSet[$this->currentField['name']] : '';
		$oFCKeditor = md5(microtime());
		$$oFCKeditor = new FCKeditor($this->currentField['name']) ;
		$$oFCKeditor->ToolbarSet= 'Basic'; 
		$$oFCKeditor->BasePath		= '/files/FckAjaxFileManage/fckeditor/' ;//SYSTEM_CLASS_PATH.'/FckAjaxFileManage/fckeditor/' ;
		$$oFCKeditor->Value		= $value;
		$$oFCKeditor->Height		= 300; 
		$$oFCKeditor->Width		= 400; 
		$result = $$oFCKeditor->GetEditor() ;
		return $result."\n";
	}

	public function GenerateTextEditorImage()
	{
		//print_r($this->currentField);
		list($width,$height) = split(",",$this->currentField['style']);
		require_once  'files/FckAjaxFileManage/fckeditor/fckeditor.php';
		$value = ($this->dataSet)? $this->dataSet[$this->currentField['name']] : 'No Images';
		if (!$value) $value ="No Image";
		$oFCKeditor = md5(microtime());
		$$oFCKeditor = new FCKeditor($this->currentField['name']) ;
		$$oFCKeditor->ToolbarSet= 'Image'; 
		$$oFCKeditor->BasePath		= '/files/FckAjaxFileManage/fckeditor/' ;
		$$oFCKeditor->Value		= $value;
		$$oFCKeditor->Height		= $width; 
		$$oFCKeditor->Width		= $height; 
		$result = $$oFCKeditor->GetEditor() ;
		return $result;
	}


    public function GenerateTextEditorStandard()
	{
		//require_once  SYSTEM_CLASS_PATH.'/FCKeditor/fckeditor.php';
		require_once  'files/FckAjaxFileManage/fckeditor/fckeditor.php';
		$value = ($this->dataSet)? $this->dataSet[$this->currentField['name']] : '';
		$oFCKeditor = md5(microtime());
		$$oFCKeditor = new FCKeditor($this->currentField['name']) ;
		$$oFCKeditor->BasePath		= '/files/FckAjaxFileManage/fckeditor/' ;//SYSTEM_CLASS_PATH.'/FckAjaxFileManage/fckeditor/' ;
		$$oFCKeditor->Value		= $value;
		$$oFCKeditor->Height		= 400; 
		$$oFCKeditor->Width		= 650; 
		$result = $$oFCKeditor->GetEditor() ;
		return $result;
	}

	 public function GenerateTextEditorStandardSmall()
	{
		//require_once  SYSTEM_CLASS_PATH.'/FCKeditor/fckeditor.php';
		require_once  'files/FckAjaxFileManage/fckeditor/fckeditor.php';
		$value = ($this->dataSet)? $this->dataSet[$this->currentField['name']] : '';
		$oFCKeditor = md5(microtime());
		$$oFCKeditor = new FCKeditor($this->currentField['name']) ;
		$$oFCKeditor->BasePath		= '/files/FckAjaxFileManage/fckeditor/' ;//SYSTEM_CLASS_PATH.'/FckAjaxFileManage/fckeditor/' ;
		$$oFCKeditor->Value		= $value;
		$$oFCKeditor->Height		= 400; 
		$$oFCKeditor->Width		= 550; 
		$result = $$oFCKeditor->GetEditor() ;
		return $result;
	}


	public function GenerateTextBox()
	{

		$result .= "<input type='text' class='".$this->currentField['style']."' ";
		$result .= "name='".$this->currentField['name']."' ";
		$result .= "id = '".$this->currentField['name']."' ";
		$result	.= "value='".$this->GetValue()."'> ";
		return $result;
	}//m

	public function GenerateCaptcha()
	{
        $result  ='<img id="captcha" src="/'.SYSTEM_CLASS_PATH.'/securimage/securimage_show.php" alt="CAPTCHA Image" /><BR>';
		$result .= '<input type="text" id="captcha_code" name="captcha_code" size="10" maxlength="6" class="'.$this->currentField['style'].'"/>';
		return $result;
	}//m

	public function GenerateHidden()
	{

		$result .= "<input type='hidden' class='".$this->currentField['style']."' ";
		$result .= "name='".$this->currentField['name']."' ";
		$result .= "id = '".$this->currentField['name']."' ";
		$result	.= "value='".$this->GetValue()."'> ";
		$result .= $this->GetValue();
		return $result;
	}//m

	public function GenerateRadio()
	{
        $values = split(':',$this->currentField['value']);
		$result = "";
		foreach($values as $key => $value)
		{
			list($label,$keyValue) = split(',',$value);
			$result .= "<input type='radio' ";
			$result .= "name='".$this->currentField['name']."' ";
			$result .= "id = '".$this->currentField['name']."' ";
			$result .= " value = '".$keyValue."' ";
			$result .= ($keyValue == $this->dataSet[$this->currentField['name']])? ' checked' : '' ;
			$result	.= " class='radio' >&nbsp;".$label;
			$result .= ($this->currentField['style'])? "<br/>" : "&nbsp;";
		}
		return $result;
	}//m

	public function GenerateCheckbox()
	{
        $values = split(':',$this->currentField['value']);
		$result = "";
		foreach($values as $key => $value)
		{
			list($label,$keyValue) = split(',',$value);
			$result .= "<input type='checkbox' ";
			$result .= "name='".$this->currentField['name']."' ";
			$result .= "id = '".$this->currentField['name']."' ";
			$result .= " value = '".$keyValue."' ";
			$result .= ($this->dataSet[$this->currentField['name']])? ' checked' : '' ;
			$result	.= " class='radio' >&nbsp;".$label;
			$result .= ($this->currentField['style'])? "<br/>" : "&nbsp;";
		}
		return $result;
	}//m

	public function GenerateDropdown()
	{
        $values = split(':',$this->currentField['value']);
		$result = "<select ";
		$result .= "name='".$this->currentField['name']."' ";
		$result .= "id = '".$this->currentField['name']."' >";
		$result .= "<option value=''>".$this->GetLabel()."</option>";
		foreach($values as $key => $value)
		{
			list($label,$keyValue) = split(',',$value);
			$result .= "<option ' ";
			$result .= " value = '".$keyValue."' ";
			$result .= ($keyValue == $this->dataSet[$this->currentField['name']])? ' selected' : '' ;
			$result .= ">";
			$result	.= $label;
			$result .= "</option>";
		}
		$result .= "</select >";
		return $result;
	}//m


	public function GenerateDropdownDb()
	{
	  list($table,$key,$label) = split(':',$this->currentField['look_up']);
      return Utility::GenerateDbDropdown($table,$key,$label,$this->GetValue(),'');
	}


	public function  GenerateCalendar()
	{
    $result =" <input type='hidden' name='".$this->currentField['name']."_show_date' id='".$this->currentField['name']."_show_date' value='".$this->GetValue()."' />
				<input type='text' name='".$this->currentField['name']."' id='".$this->currentField['name']."' onchange=\"toThai(this.value,'".$this->currentField['name']."_show_date');\" value='".$this->GetValue()."'/>
				<button type='reset' id='".$this->currentField['name']."f_trigger_b'>Select Date</button>
				<script type='text/javascript'>
					Calendar.setup({
						inputField     :    '".$this->currentField['name']."',      
						ifFormat       :    '%Y-%m-%d',       // format of the input field
						showsTime      :    false,            // will display a time selector
						button         :    '".$this->currentField['name']."f_trigger_b',   // trigger for the calendar (button ID)
						singleClick    :    false,           // double-click mode
						step           :    1                // show all years in drop-down boxes (instead of every other year as default)
					});
					
				</script>
				";
     return $result;
	}

	public function GenerateTextArea()
	{
		$result .= "<textarea class='".$this->currentField['style']."' cols='50' rows='10' ";
		$result .= "name='".$this->currentField['name']."' ";
		$result .= "id = '".$this->currentField['name']."' >";
		$result	.= $this->GetValue();
		$result .= "</textarea>";
		return $result;
	}//m

	public function GetValue(){
		return ($this->dataSet)? $this->dataSet[$this->currentField['name']] : '';
	}

	public function GenerateFunction()
	{

		return eval("return ".$this->currentField['name']."();");

		
	}//m
    
	public function GetLabel($alang=NULL)
	{ 
       
		if ($GLOBALS['SYSTEM']['seri'] == 'admin') $lang='en'; 
		else  $lang = ($alang)? $alang : $this->lang;
		return (isset($this->currentField['label_'.$lang]))? $this->currentField['label_'.$lang] : $this->currentField['label_th'] ;
	}

}//end Class FormGenerate
//=============================================================================================//




/*$tab = NULL;
		if ($fields['combine'])
		{
			$tab = "'".$label['combine']."'";
			$result = "<p><div id=\"dhtmlgoodies_tabView2\" style> \n	    <div class=\"dhtmlgoodies_aTab\">".$fields['combine']."</div> \n";
		}

		foreach ($fields as $key => $value)
		{
			if ($key == 'combine' || $key == 'validate') continue;
			$tab .= ($tab)? ",'".$label[$key]."'" : "'".$label[$key]."'";
			$result .= "<div class=\"dhtmlgoodies_aTab\">".$value."</div> \n";
	    }		
		$result .="</div> \n<script type=\"text/javascript\">initTabs('dhtmlgoodies_tabView2',Array($tab),0,800,500);</script></p> \n";
		return $result.$fields['validate'];
		*/


		/*
		 $str ='<div id="dhtmlgoodies_tabView1">';
		 $str.='	<div class="dhtmlgoodies_aTab">';
		 $str.= $fields['combine'];
		 $str.= '</div>';
			
			foreach ($fields as $key => $value)
			{
					if ($key == 'combine' || $key == 'validate') continue;
					$tab .= ($tab)? ',"'.$label[$key].'"' : '"'.$label[$key].'"';
					
					$str.= '<div class="dhtmlgoodies_aTab">'.$value.'</div>';
			
			}	
		
		$str.='</div>';
		$str.='<script type="text/javascript">';
		$str.="initTabs('dhtmlgoodies_tabView1',Array(".$tab."),0,800,500);";
		$str.='</script>';
		return $str;


<!-- <ul id="flowertabs" class="shadetabs">
			<li><a href="#" rel="tcontent1" class="selected">Tab 1</a></li>
			<li><a href="#" rel="tcontent2">Tab 2</a></li>
			<li><a href="#" rel="tcontent3">Tab 3</a></li>
			<li><a href="#" rel="tcontent4">Tab 4</a></li>
			</ul>

			<div style="border:1px solid gray; width:700px; margin-bottom: 1em; padding: 10px">

			<div id="tcontent1" class="tabcontent">
			Tab content 1 here<br />Tab content 1 here<br />
			</div>

			<div id="tcontent2" class="tabcontent">
			<div>
			<input type="hidden" id="faq_detail_en" name="faq_detail_en" value="">
			<input type="hidden" id="faq_detail_en___Config" value="">
			<iframe id="faq_detail_en___Frame" src="system/class/FCKeditor/editor/fckeditor.html?InstanceName=faq_detail_en&Toolbar=Default" width="700" height="400" frameborder="no" scrolling="no">
			</iframe>
			</div>
			 
			</div>

			<div id="tcontent3" class="tabcontent">
			Tab content 3 here<br />Tab content 3 here<br />
			</div>

			<div id="tcontent4" class="tabcontent">
			Tab content 4 here<br />Tab content 4 here<br />
			</div>

			</div> 
			<script type="text/javascript">
			var myflowers=new ddtabcontent("flowertabs") //enter ID of Tab Container
			myflowers.setpersist(true) //toogle persistence of the tabs' state
			myflowers.setselectedClassTarget("link") //"link" or "linkparent"
			myflowers.init()
			</script>
			-->



		*/



?>
