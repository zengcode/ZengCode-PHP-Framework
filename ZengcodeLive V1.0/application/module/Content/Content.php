<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Content extends CmsDataModel
{
	public function Content()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(30); //set number to show per page for record
		$this->debug = 1;
		$this->layout = "template";
	}

	public function ListContentByCategory()
	{
		$category_id = 0;
		if ($_POST['category_id']) $category_id = $_POST['category_id'];
		if ($_GET['category_id'])  $category_id = $_GET['category_id'];

		$condition='';
		if ($category_id) 
		{
			$condition = " and category.category_id = ".$category_id;
		}
		$data = $this->database->Select("*")->From('content,category')->Where("content.category_id=category.category_id ".$condition )->Sort("content_id DESC")->LimitQuery();
		if (!$data) Utility::Redirect("/Module/Error/Action/InvalidContent");
	    $table = View::TableView2(
							 $data['record'], //data from database

							 array('หัวข้อ' => 'content_name','หมวดหมู่' => 'category_name' ,'วันที่'=>'post_date'), 
								   //table header
                             
							 array(
								   'เปิดอ่าน' =>   '/Module/Content/Action/ViewContent:content_id'
								   ), //link 

							 array('table' => " width='97%' align='center' border='0' ",
								   'header' => " bgcolor='#CCCCCC' ",
								   'confirm' => true
							       ) //Property of table
							); 
		$data['table'] = $table;
		$data['link']  = $link ="/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListContentByCategory";
		$data['header']  = "<BR><BR>";
		$data['category_id'] = $category_id;
		$this->LayOut($this->layout,'content','view_content_by_category',$data); 
	}
    
	public function LastContent($show=10)
	{
	  $this->database->SetNumRow($show); 
	  $data = $this->database->Select("*")->From('content')->Sort("content_id DESC")->LimitQueryCache(1,'lastContent');
	 // $data = $this->database->Select("*")->From('content')->Sort("content_id DESC")->LimitQuery('lastContent','lastContent');
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  $this->view->LoadView('content','view_content_lastContent',$data);
	}

	public function TestNoCache($show=10)
	{
	  $this->database->SetNumRow($show); 
	  $data = $this->database->Select("*")->From('test')->Where("data2='A'")->Query();
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  $this->view->LoadView('content','view_test2',$data);
	}

	public function TestUseCache($show=10)
	{
	  $this->database->SetNumRow($show); 
	  $data = $this->database->Select("*")->From('test')->Where("data2='A'")->QueryCache('TestUserCache');
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  $this->view->LoadView('content','view_test',$data);
	}

	public function TestPageCache($show=10)
	{
	  PageCache::LoadCache(5); //load cache from file parameter is minute  
	  $this->database->SetNumRow($show); 
	  $data = $this->database->Select("*")->From('test')->Where("data2='A'")->Query('TestUserCache');
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  $this->view->LoadView('content','view_test3',$data);
	  PageCache::SaveCache(); //save page to cache file 
	}

	public function TestPageNoCache($show=10)
	{
	  //PageCache::LoadCache(5); //load cache from file parameter is minute  
	  $this->database->SetNumRow($show); 
	  $data = $this->database->Select("*")->From('test')->Where("data2='A'")->Query('TestUserCache');
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  $this->view->LoadView('content','view_test4',$data);
	  //PageCache::SaveCache(); //save page to cache file 
	}

	public function ViewContent()
	{
	  $content_id = $_GET['content_id'];
	  $data = $this->database->Select("*")->From('content')->Where("content_id=$content_id")->Find('content_id_'.$content_id);
	  if(count($data)){
	     $this->LayOut($this->layout,'content','view_view_content',$data); 
	  }else{
	      Utility::Redirect("/Module/Error/Action/InvalidContent");
	      die();
	  }
	}

	
 

}//end Class
