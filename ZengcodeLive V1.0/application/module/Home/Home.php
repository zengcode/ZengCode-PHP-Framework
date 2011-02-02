<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Home extends CmsDataModel
{
	public function Home()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(20); //set number to show per page for record
		$this->debug = 1;
		$this->layout = "template3";      
		//$this->redirecUrl = "/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
	}

    //========================start first page ====================//
	public function Index()
	{
		$data = Null;
		$this->LayOut($this->layout,'home','view_home_index',$data); 
	}

	public function Test()  ///for test ImportUserClass Method to import user or extension class
	{
		$this->ImportUserClass('Test');
		$Test = new Test();
		$Test->TestMe();
	}

    public function Calendar()  ///for test ImportUserClass Method to import user or extension class
	{
        $year  = date('Y');
		$month = date('m');
		$this->ImportUserClass('maxCalendar.class');
		$myCelandar = new maxCalendar();
		echo $myCelandar->showCalendar($year,$month);
	}
	

	public function SayHello()
	{
	 $data = $this->database->Select("*")->From('static_content')->Where("content_key = 'hello' " )->Find();
     $data['header'] = '';
	 $this->view->LoadView('home','view_home_scontent',$data);
	}

	public function Download()
	{
	 $data = $this->database->Select("*")->From('static_content')->Where("content_key = 'download' " )->Find();
     $data['header'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<U><B>Download</B></U>';
	 $this->LayOut($this->layout,'home','view_home_scontent',$data);
	}

	public function ListFirstPage()
	{

     //$this->view->LoadView('home','view_home_sayHello',$data);
	 //$this->view->LoadView('home','view_home_sayHello',$data);
	 //$this->view->LoadView('home','view_home_sayHello',$data);
	 //$this->view->LoadView('home','view_home_sayHello',$data);
	}
    //=====================end first page ================================//

    //================start static content=====================//
	public function Contact()
	{
	 $data = $this->database->Select("*")->From('static_content')->Where("content_key = 'contact' " )->Find();
     $data['header'] = '';
	 $this->LayOut($this->layout,'home','view_home_scontent',$data);
	}

	public function About()
	{
	 $data = $this->database->Select("*")->From('static_content')->Where("content_key = 'about' " )->Find();
     $data['header'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>เกี่ยวกับเจ้าของเว็บไซต์</B><BR><BR>';
	 $this->LayOut($this->layout,'home','view_home_scontent',$data);
	}

    //================end static content=====================//

   
	

	
}//end Class
