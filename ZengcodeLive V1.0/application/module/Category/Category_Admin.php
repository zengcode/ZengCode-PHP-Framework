<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Category_Admin extends CmsDataModel
{
	public function Category_Admin()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(30); //set number to show per page for record
		$this->debug = 1;
		$this->layout = "template_admin2";      
		$this->redirecUrl = "/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
	}

	public function test()
	{
		echo "Hello TEst";
	}

	public function ListAll()
	{
		$page = (isset($_GET['page']))? $_GET['page'] : 1;
		$data = $this->database->Select("*")->From('category')->Sort("weight ASC")->LimitQueryCache($page,'category');
	    //print("<pre>");print_r($data);print("</pre>");
	    $table = View::TableView2(
							 $data['record'], //data from database

							 array('Category Name' => 'category_name','Category Remark' => 'category_remark','Ordering'=>'weight'), 
								   //table header
                             
							 array('edit' => '/admin/Module/Category/Action/EditForm:category_id',
							       'delete' => '/admin/Module/Category/Action/Delete:category_id',
								   //'view'   => '/admin/Module/User/Action/View:user_id'
								   ), //link 

							 array('table' => " width='97%' align='center' border='0' ",
								   'header' => " bgcolor='#CCCCCC' ",
								   'confirm' => true
							       ) //Property of table
							); 
		$data['table'] = $table;
		$data['link']  = $link ="/admin/Module/".$GLOBALS['SYSTEM']['module']."/Action/ListAll";
		$data['header']  = "<BR><a href='/admin/Module/Category/Action/AddForm'>New Category</a><BR><BR>";
		$this->LayOut($this->layout,'','default',$data); 
	}

   	public function EditForm()
	{   
		$category_id=$_GET['category_id'];
		$formData = $this->database->Select("*")->From("category")->Where("category_id=$category_id")->Find(); //return only one record
		$data['form'] = $this->form->GenerateForm('category_edit_form',$formData);
		$this->LayOut($this->layout,'category','view_category_edit_form',$data); 
	}


	public function AddForm()
	{
		$formData=array('weight'=>'1');
		$data['form'] = $this->form->GenerateForm('category_add_form',$formData);
		$this->LayOut($this->layout,'category','view_category_add_form',$data); 
	}
	//===========================================================================//

    public function Insert()
	{
			$data=array(
			             'table'  => 'category',
		                 'fields' => array(
							          'category_name'   => 'post',
							          'category_remark' => 'post',
							          'weight'			=> 'post',
							         )
			       );
			$sql = $this->GenerateInsertQuery($data);
			$this->Execute($sql);
			$this->database->ClearCache('category');
			Utility::Redirect($this->redirecUrl);
	}
	//===========================================================================//
	public function Update()
	{
		    print("<pre>");print_r($_POST);print("</pre>");
			$category_id  = $_POST['category_id'];
			$data=array(
			             'table'  => 'category',
		                 'fields' => array(
							          'category_name'   => 'post',
							          'category_remark' => 'post',
							          'weight'			=> 'post',
							         )
			       );
			$sql = $this->GenerateUpdateQuery($data,"category_id = $category_id");
			$this->Execute($sql);
			$this->database->ClearCache('category');
			Utility::Redirect($this->redirecUrl);
	}
	//===========================================================================//
	public function Delete()   //must have
	{   
		$this->id=$_GET['category_id'];
		$sql[0]="Delete From category Where category_id = ".$this->id;
		$this->database->ExecuteTransaction($sql);
		$this->database->ClearCache('category');
		Utility::Redirect($this->redirecUrl);
	}
   //========================================================//

}//end Class
