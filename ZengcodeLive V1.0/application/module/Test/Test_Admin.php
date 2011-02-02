<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Test_Admin extends CmsDataModel
{
	public function Test_Admin()
	{
		parent::CmsDataModel();
		$this->database->SetNumRow(10); //set number to show per page for record
		$this->workflow->LoadWorkFlow($GLOBALS['WorkFlowACSC']);
		$this->debug = 1;
	}

	public function ListAll()
	{
		
		//set user level
		//$_SESSION['user']['level'] = "Editor";
		$_SESSION['user']['level'] = "Approver";

		$state = 'Approved'; //

		//set id for this content
		$this->id = 1;

		Echo "<BR><BR <B>User Level == ".$_SESSION['user']['level']."<br> Content State == ".$state."</B><BR>";

		//get Visibility for each record ใส่ใน ตารางที่ list ตา มvisibility ที่ user มองเห็น
		$this->workflow->GetVisibility($state,$this->id); //it must from database for each content dependency on user level
         
        $AccessList = $this->workflow->getContentStateUserCanAccess(); //เอาไปใส่ใน query--> where state in ()
	}


	public function TestUpdate()
	{
		$this->SetLanguage(array('th','en','jp'));
        $picName = "car.jpg"; 
		$fields = array(
			             'key' => array('id' => 'get'),
						 'combine' => array('pic' => $picName,'test' => 'get'),
			             'fields' => array('topic' => 'post' ,'content' => 'post','comment' => 'get')
						);
		$this->setFields($fields);
		$this->Update();
	}

	public function TestInsert()
	{
		$this->SetLanguage(array('th','en','jp'));
        $picName = "car.jpg";
		$fields = array(
			             'key' => array('id' => 'get'),
						 'combine' => array('pic' => $picName,'test' => 'get'),
			             'fields' => array('topic' => 'post' ,'content' => 'post','comment' => 'get')
						);
		$this->setFields($fields);
		$this->Insert();
	}




	public function TestDatabase()
	{
      $_SESSION['user']['level'] = "Editor";
	 // $_SESSION['user']['level'] = "Approver";
      $data = $this->database->Select("id,topic,state")->From('cms')->Query();
	 // print("<pre>");print_r($data);print("</pre>");
	  $table = View::TableViewWorkFlow(
							 $data['record'], //data from database

							 array('Topic' => 'topic','State' => 'state'), //table header

							 array('table' => " width='97%' align='center' border='0' ",
								   'header' => " bgcolor='#CCCCCC' ",
								   'confirm' => true
							 ) //Property of table
							); 
	print("<p>".$table."</p>");
	echo " <BR> ";
	}



	public function TestForm()
	{
		?>
<!-- ########Template Style Sheel ####### -->
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/common.css" />
 <link href="<?=TEMPLATE?>/css/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
 <!-- ########Live Validate ####### -->
<script type="text/javascript" src="/script/livevalidation_standalone.js"></script>
<script type="text/javascript" src="/script/simpleAjax.js"></script>
<!-- ######## Tab ####### -->
<link rel="stylesheet" href="/css/tab-view.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/ajax.js"></script>
<script type="text/javascript" src="/js/tab-view.js"></script>
<!-- ######## Tab2 ####### -->
<link rel="stylesheet" type="text/css" href="/css/tabcontent.css" />
<script type="text/javascript" src="/js/tabcontent.js"></script>
		<?php
		$formData=array();
		$data['form'] = $this->form->GenerateFormTab('test_form',$formData);
		echo $data['form'];
		?>
<input type="button" value="test" onclick="test()">
		<?
	}

}//============================end class==============//

?>
<script>
function test()
{
	var oEditor = FCKeditorAPI.GetInstance('number2') ;

	alert(oEditor.GetHTML());
}
</script>