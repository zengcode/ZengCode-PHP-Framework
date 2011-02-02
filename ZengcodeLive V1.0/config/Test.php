<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Test_Admin extends CmsDataModel
{
	public function Test_Admin()
	{
		parent::DataModel();
		$this->database->SetNumRow(10); //set number to show per page for record
	}

	public function Test()
	{
		echo "Hello Test";
	}
}

?>