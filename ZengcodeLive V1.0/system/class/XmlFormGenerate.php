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
Class XmlFormGenerate
{
    function ExtractData($xmlFileName='test.xml'){
		$data= file_get_contents(FORM_XML_PATH."/".$xmlFileName);
		$xml = new SimpleXMLElement($data);
		//echo $xml->property->tablename; //get tablename
		$fields=$xml->fields; 
		$result=array();
		foreach ($fields as $key => $field){
				//print("<pre>");print_r($field);print("</pre>");
				$value=array();
				foreach($field as $key2 => $field2){
					$value[$key2] = "".$field2."";
				}
				array_push($result,$value);
		}
		return $result;
	}//m
}//end Class



?>