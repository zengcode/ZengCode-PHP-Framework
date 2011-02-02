<?php
/***********************************************
September 26,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/
defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');

Class DbCache
{

private $serializationName;

public function SetSerializationObject($obj,$serializationName)
{
	$this->serializationName = $serializationName;
    $obj=serialize($obj);
	$fp = fopen(CACHE_PATH."/".$this->serializationName, "w");
	fwrite($fp, $obj);
	fclose($fp);
}

public function GetSerializationObject($serializationName)
{
	$this->serializationName = $serializationName;
	if (file_exists(CACHE_PATH."/".$this->serializationName)) {
		return unserialize(implode("", @file(CACHE_PATH."/".$this->serializationName)));
	} else {
		return false;
	}
	
}

public function ClearSerializationObject($serializationName)
{
		$this->serializationName=$serializationName;
		if (file_exists(CACHE_PATH."/".$this->serializationName)) {
			@unlink(CACHE_PATH."/".$this->serializationName);	
		} 
		$i=1;
		while (true){
			$fileName = CACHE_PATH."/".$this->serializationName."_".$i;
			if (file_exists($fileName)) {
				@unlink($fileName);
				$i++;
			}else break;
		}
	return true;
	
}

}//end class

?>