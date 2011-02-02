<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
Class View  
{
public static function LoadContent($module_name,$module_function) //list for content
{
	require_once MODULE_PATH."/".$module_name."/config.php";
	require_once MODULE_PATH."/".$module_name."/".$module_name.".php";
	    $ControllerObject=md5(microtime());
		$$ControllerObject = new $module_name();
		$$ControllerObject->$module_function();
}

public static function LoadContentAdmin($module_name,$module_function) //list for admin content
{
	require_once MODULE_PATH."/".$module_name."/config.php";
	require_once MODULE_PATH."/".$module_name."/".$module_name."_Admin.php";
	$module_name .= "_Admin";
	$ControllerObject=md5(microtime());
    $$ControllerObject = new $module_name();
	$$ControllerObject->$module_function();
}


public static function LoadActionContent(&$DATA)  //This is a selected module and  action
{
  require_once TEMPLATE_PATH."/".$GLOBALS['TEMPLATE']."/view/".$GLOBALS['folder']."/".$GLOBALS['view'].".php";
}


public static function LoadView($folder,$view,$data) 
{ 
	 $DATA = $data;
	 $_SESSION['DEBUG_VALUE']['FOLDER'] = $folder;
     $_SESSION['DEBUG_VALUE']['VIEW'] = $view;
	 $view_file = TEMPLATE_PATH."/".$GLOBALS['TEMPLATE']."/view/".$folder."/".$view.".php";
		if (file_exists($view_file)) 
		{
			include $view_file;
		}else
		{
			Utility::Redirect("/Module/Error/Action/InvalidView");
		}

}


public static function LoadLayout($layout,$folder,$view,$data=NULL)
{  
   $DATA = $data; 
   $GLOBALS['folder'] = $folder;
   $GLOBALS['view']   = $view;
   $_SESSION['DEBUG_VALUE']['LAYOUT'] = $layout;
   $_SESSION['DEBUG_VALUE']['FOLDER'] = $folder;
   $_SESSION['DEBUG_VALUE']['VIEW'] = $view;
   if(file_exists(TEMPLATE_PATH."/".$GLOBALS['TEMPLATE']."/".$layout.".php"))
      require_once TEMPLATE_PATH."/".$GLOBALS['TEMPLATE']."/".$layout.".php";
   else die(Utility::ErrorMessage("There is no layout name = '$layout' in  ".TEMPLATE_PATH."/".$GLOBALS['TEMPLATE']));

}

public static function PageList1($link,$numberOfPage,$currentPage,$getVar='')
{
		$str = NULL;
		for($i=1;$i<=$numberOfPage;$i++)
		{
          $str .= (($i == $currentPage)? "[$i] " : "[<a href='$link/page/$i".$getVar."' >$i</a>] ");
		}
		echo $str;
}

public static function TableView1($data,$field,$link,$property)
{
		if (!$data) return null;
		//print("<pre>");print_r($field);print("</pre>");print("<pre>");print_r($link);print("</pre>");
        $str  = "<table ".$property['table']." >\n <tr ".$property['header'].">\n";
		foreach($field as $key => $value)
		{
			$str.= "<td>$key</td>";
		}
		$str .= "<td>&nbsp;</td>";
		$str .= "</tr>\n";

		foreach($data as $key => $data)
		{
			$str .= "<tr>";
			foreach($field as $key2 => $data2)
			{
			       $str.="<td>".$data[$data2]."</td>";  
			}
			$str .= "<td>";
			foreach($link as $key3 => $data3)
				   {
				       $parameter = "";
				       list($label,$param) = split(":",$data3);
					   if ($param)
					   {
						   $params = split(",",$param);
						   foreach($params as $key4 => $data4)
							   $parameter .="/".$data[$data4];
					   }
					   $str.= "<a href='$label".$parameter."'>$key3</a> ";
				   }
			$str .= "<td>";
			$str .= "</tr> \n";
		}
		
		$str .= "</table>";
		return $str;
}


public static function ConfirmMsg($mapKey)
{
		$map=array( 'delete' => 'Delete ? '
				   );
		return (isset($map[$mapKey]))? "onclick='return confirm(\"$map[$mapKey]\");'; " : '';
}






public static function TableView2($data,$field,$link,$property)
{
		if (!$data) return null;
		//print("<pre>");print_r($field);print("</pre>");print("<pre>");print_r($link);print("</pre>");
        $str  = "<table ".$property['table']." >\n <tr ".$property['header'].">\n";
		foreach($field as $key => $value)
		{
			$str.= "<td><B>$key</B></td>";
		}
		$str .= "<td><img src='/images/tool.png' border='0'><B>Operation</B></tr>\n";

		foreach($data as $key => $data)
		{
			$str .= "<tr>";
			foreach($field as $key2 => $data2)
			{
			       $str.="<td>".$data[$data2]."</td>";  
			}
			$str .= "<td>";
			foreach($link as $key3 => $data3)
				   {
				       $parameter = "";
				       list($label,$param) = split(":",$data3);
					   if ($param)
					   {
						   $params = split(",",$param);
						   foreach($params as $key4 => $data4)
							   $parameter .="/".$data4."/".$data[$data4];
					   }
					   $str.= "<a href='$label".$parameter."' ";
					   if ($property['confirm'] == true) $str.= self::ConfirmMsg($key3);
					   $str .= "><img border='0' src='/images/".$key3.".png' alt='$key3'></a> ";
				   }
			$str .= "<td>";
			$str .= "</tr> \n";
		}
		
		$str .= "</table>";
		return $str;
}

public static function TableViewWorkFlow($data,$field,$property)
{
		if (!$data) return null;
		//print("<pre>");print_r($field);print("</pre>");print("<pre>");print_r($link);print("</pre>");
        $str  = "<table ".$property['table']." >\n <tr ".$property['header'].">\n";
		foreach($field as $key => $value)
		{
			$str.= "<td>$key</td>";
		}
		$str .= "<td><img src='/images/tool.png' border='0'>Operation</tr>\n";
        $view = new CmsDataModel();
		foreach($data as $key => $data)
		{
			$str .= "<tr>";
			foreach($field as $key2 => $data2)
			{
			       $str.="<td>".$data[$data2]."</td>";  
			}
			$str .= "<td width='50%'>";
			$str .= $view->GetVisibilityOutside($data['state'],$data['id']);
			$str .= "<td>";
			$str .= "</tr> \n";
		}
		
		$str .= "</table>";
		return $str;
}

}//end Class

?>