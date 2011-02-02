<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class SContent_Admin extends CmsDataModel
{
	public function SContent_Admin()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(20); //set number to show per page for record
		$this->debug = 1;
		$this->layout = "template_admin2";      
		$this->redirecUrl = "/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
	}

	public function ListAll()
	{
		$category_id = 0;
		if ($_POST['category_id']) $category_id = $_POST['category_id'];
		if ($_GET['category_id'])  $category_id = $_GET['category_id'];

		$condition='';
		if ($category_id) 
		{
			$condition = " and category.category_id = ".$category_id;
		}
		$data = $this->database->Select("*")->From('static_content')->Query();
	    $table = View::TableView2(
							 $data['record'], //data from database

							 array('Content Name' => 'content_key'), 
								   //table header
                             
							 array(
								   'edit' => '/admin/Module/SContent/Action/EditForm:content_key'
								   ), //link 

							 array('table' => " width='97%' align='center' border='0' ",
								   'header' => " bgcolor='#CCCCCC' ",
								   'confirm' => true
							       ) //Property of table
							); 
		$data['table'] = $table;
		$data['link']  = $link ="/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
		$data['category_id'] = $category_id;
		$this->LayOut($this->layout,'scontent','view_scontent_listall',$data); 
	}

   	public function EditForm()
	{   
		$content_key=$_GET['content_key'];
		$formData = $this->database->Select("*")->From("static_content")->Where("content_key='$content_key'")->Find(); //return only one record
		$data['form'] = $this->form->GenerateForm('scontent_edit_form',$formData);
		$this->LayOut($this->layout,'scontent','view_scontent_edit_form',$data); 
	}

	public function Update()
	{			
		    $content_key  = $_POST['content_key'];
			$data=array(
			             'table'  => 'static_content',
		                 'fields' => array(
									  'content_detail'   => 'post'
							         )
			       );
			$sql = $this->GenerateUpdateQuery($data,"content_key = '$content_key'");
			$this->Execute($sql);
			Utility::Redirect($this->redirecUrl);
	}
	//===========================================================================//


}//end Class
