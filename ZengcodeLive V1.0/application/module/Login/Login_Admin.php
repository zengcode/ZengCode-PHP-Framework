<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Login_Admin extends CmsDataModel
{
	public function Login_Admin()
	{
		parent::CmsDataModel();
		$this->redirecUrl = "/admin/Module/SContent/Action/ListAll";
	}

	public function LoginForm()
	{
		if ($_POST['username_login'] == 'admin' and $_POST['password_login'] == 'yourpassword' )
		{
		   $_SESSION['user_name'] = 'admin';
		   $_SESSION['allow_injection']='allow';
		}
		if (!isset($_SESSION['user_name']))
		    $this->View('login','view_login_form','');
		else if($_SESSION['user_name'] != 'admin')
			$this->View('login','view_login_form','');
		else 
			Utility::Redirect($this->redirecUrl);
	}

	public function LogOut()
	{
		unset($_SESSION['user_name']);
		unset($_SESSION['allow_injection']);
		$this->redirecUrl = "/admin/Module/Login/Action/LoginForm";
		Utility::Redirect($this->redirecUrl);
	}

}