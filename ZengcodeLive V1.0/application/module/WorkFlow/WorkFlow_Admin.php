<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class WorkFlow_Admin extends CmsDataModel
{
	public function Test_Admin()
	{
		parent::CmsDataModel();
	}

	public function SetStatus()
	{
		//print("<pre>");print_r($_GET);print("</pre>");
		$this->id= $_GET['id'];
		$nextState = (isset($GLOBALS['WorkFlowAuto'][$_GET['nextState']]))? $GLOBALS['WorkFlowAuto']['RejectDelete'] : $_GET['nextState'];
		$this->setNextState($nextState);
		$Module = $_GET['Module2'];
		$Action = $_GET['Action2'];
		Utility::Redirect('/admin/Module/'.$Module.'/Action/'.$Action);

	}


}
