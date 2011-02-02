<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Content_Admin extends CmsDataModel
{
	public function Content_Admin()
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
		$data = $this->database->Select("*")->From('content,category')->Where("content.category_id=category.category_id ".$condition )->Sort("content_id DESC")->LimitQuery();
	    $table = View::TableView2(
							 $data['record'], //data from database

							 array('Content Name' => 'content_name','Category' => 'category_name' ,'Posted Date'=>'post_date'), 
								   //table header
                             
							 array('edit' => '/admin/Module/Content/Action/EditForm:content_id',
							       'delete' => '/admin/Module/Content/Action/Delete:content_id',
								   ), //link 

							 array('table' => " width='97%' align='center' border='0' ",
								   'header' => " bgcolor='#CCCCCC' ",
								   'confirm' => true
							       ) //Property of table
							); 
		$data['table'] = $table;
		$data['link']  = $link ="/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
		$data['header']  = "<BR><a href='/admin/Module/Content/Action/AddForm'>New Content</a><BR>";
		$data['category_id'] = $category_id;
		$this->LayOut($this->layout,'content','view_content_listall',$data); 
	}

   	public function EditForm()
	{   
		$content_id=$_GET['content_id'];
		$formData = $this->database->Select("*")->From("content")->Where("content_id=$content_id")->Find(); //return only one record
		$data['form'] = $this->form->GenerateForm('content_edit_form',$formData);
		$this->LayOut($this->layout,'content','view_content_edit_form',$data); 
	}


	public function AddForm()
	{
		$data['form'] = $this->form->GenerateForm('content_add_form',$formData);
		$this->LayOut($this->layout,'content','view_content_add_form',$data); 
	}
	//===========================================================================//

    public function Insert()
	{
			$data=array(
			             'table'  => 'content',
		                 'fields' => array(
									  'category_id'   => 'post',
							          'content_name'   => 'post',
									  'content_summary' => 'post',
							          'content_detail' => 'post',
							          'post_date'	   => 'now',
							         )
			       );
			$sql = $this->GenerateInsertQuery($data);
			//echo $sql;
			$this->Execute($sql);
			$this->database->ClearCache('lastContent');
			Utility::Redirect($this->redirecUrl);
	}
	//===========================================================================//
	public function Update()
	{			
		    $content_id  = $_POST['content_id'];
			$data=array(
			             'table'  => 'content',
		                 'fields' => array(
									  'category_id'   => 'post',
							          'content_name'   => 'post',
									  'content_summary' => 'post',
							          'content_detail' => 'post'
							         )
			       );
			$sql = $this->GenerateUpdateQuery($data,"content_id = $content_id");
			$this->Execute($sql);
			$this->database->ClearCache('lastContent');
			$this->database->ClearCache('content_id_'.$content_id);
			Utility::Redirect($this->redirecUrl);
	}
	//===========================================================================//
	public function Delete()   //must have
	{   
		$this->id=$_GET['content_id'];
		$sql[0]="Delete From content Where content_id = ".$this->id;
		$this->database->ExecuteTransaction($sql);
		$this->database->ClearCache('lastContent');
		$this->database->ClearCache('content_id_'.$this->id);
		Utility::Redirect($this->redirecUrl);
	}
   //========================================================//

}//end Class
