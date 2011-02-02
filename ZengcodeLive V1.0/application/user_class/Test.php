<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Test extends CmsDataModel
{
	public function Test()
	{
		parent::_construt();
	}

	public function TestMe()
	{
	  echo "<BR><B>Hello I a Class='Test' Method='TestMe' </B> <BR>";
	  echo "<B>Call me from Class='".$GLOBALS['SYSTEM']['module']."' Method='".$GLOBALS['SYSTEM']['action']."' </B> <BR><BR><BR>";
	}
}

?>