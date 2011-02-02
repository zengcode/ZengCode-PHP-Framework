<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Error extends CmsDataModel
{
	public function Error()
	{
		parent::CmsDataModel();
	}
   
   public function CrossSiteScript()
	{
	   $data['error_topic'] =  "Warning...... ";
	   $data['error_msg']   =   "คุณกำลังพยายามทำอันตรายกับเว็บไซต์โดยพยายามส่ง Cross-Site Scripting ";
	   $this->view->LoadView('error','error',$data) ;
	   exit;
	}

	public function InvalidView()
	{
	   $data['error_topic'] =  "Error...... ";
	   $data['error_msg']   =   "ไม่มี View ที่คุณเรียกใช้";
	   $this->view->LoadView('error','error',$data) ;
	   exit;
	}

	public function InvalidContent()
	{
	   $data['error_topic'] =  "Error...... ";
	   $data['error_msg']   =   "There is no content";
	   $this->view->LoadView('error','error',$data) ;
	   exit;
	}

	public function InvalidSql()
	{
	   $data['error_topic'] =  "Error...... ";
	   $data['error_msg']   =   "Invalid SQL Command";
	   $this->view->LoadView('error','error',$data) ;
	   exit;
	}

	

}///end class

?>