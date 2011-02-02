<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Comment extends CmsDataModel
{
	public function Comment()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(30); //set number to show per page for record
		$this->debug = 1;
		$this->layout = "template";
	}

	public function ListAll()
	{
		$content_id = $_GET['content_id'];

		if (isset($_GET['comment_id'])){
			$this->DeleteComment($content_id,$_GET['comment_id']);
		}
		
		if($_POST) $this->AddComment($content_id);

		$data = $this->database->Select("*")->From('comment')->Where("content_id=$content_id")->Sort("comment_id DESC")->QueryCache('comment_id_'.$content_id);
		//echo "SQL ==> ".$this->database->sql;
	    $data['record'] = $data['record'];
		$data['form'] = $this->form->GenerateForm('comment_add_form',$formData);
		$this->view->LoadView('comment','view_list_comment',$data);
	}

	public function AddComment($content_id)
	{      
		    if ($_POST['comment_detail'] == '' ) return;
			if ($_POST['poster_name']    == '' ) return;
			
			$data=array(
			             'table'  => 'comment',
		                 'fields' => array(
							          'content_id'   => $content_id,
							          'comment_detail' => 'post',
							          'poster_name'			=> 'post',
				                      'posted_date'    => 'now',
									  'ip'             => Utility::GetIp()
							         )
			       );
			$sql = $this->database->GenerateInsertQuery($data);
			$this->Execute($sql);
			$this->database->ClearCache('comment_id_'.$content_id);
	}

	public function DeleteComment($content_id,$comment_id)
	{
		if (isset($_GET['admin'])){
			if ($_GET['admin'] == 'DeleteComment')
			{
				$sql[0]="Delete From comment Where comment_id = ".$comment_id;
				$this->database->ExecuteTransaction($sql);
				$this->database->ClearCache('comment_id_'.$content_id);
			}
		}
	}
  
}//end Class
