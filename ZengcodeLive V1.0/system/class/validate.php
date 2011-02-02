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
	var $configuration;
	public static function GenerateValidation($configuration){
		$this->configuration = $configuration;
		echo "<pre>";
		//print_r($fields);
		echo "</pre>";
		$str="<script> \n";
		for ($i=0;$i<count($fields);$i++){
			$validation  =  $this->configuration[$i]['validation'];
			$type        =  $this->configuration[$i]['type'];
			$name        =  $this->configuration[$i]['name'];
			$length      =  $this->configuration[$i]['length'];
			if ($validation == 1) {
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