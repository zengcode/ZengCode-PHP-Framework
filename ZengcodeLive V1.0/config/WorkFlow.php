<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

//Work Flow Configuration
//Work Flow(State diagram ,Visibility and General Operation with Content)
//When start up ,if not use work Flow the state is set ot Approved automatic ,if use may be set to Draft or ApprovingPublish
//Edit do not need to change state
                                         //content state       //visibility for each user level
$GLOBALS['WorkFlowACSC']        = array(	 
										 'Draft'			=> array('Editor'   => array('Edit','Delete','ApprovingPublish')),


										 'ApprovingPublish' => array('Editor'   => NULL,
																	 'Approver' => array('Approved','RejectApprove')),

										 'RejectApprove'    => array('Editor'   => array('Edit','Delete','ApprovingPublish')),

										 'Approved'			=> array('Editor'   => array('Edit','ApprovingDelete'),
															         'Approver' => NULL), 

										 'ApprovingDelete'	=> array('Editor'   => array('Edit','ApprovingDelete'),
																	 'Approver'	=> array('Delete','RejectDelete')),
		

										);

$GLOBALS['WorkFlowAuto']['RejectDelete'] = 'Approved';

										//จะไปหา state นี้ caption for next step

$GLOBALS['WorkFlowCaption']       = array(	 
										 'Edit'						=>'Edit',

										 'Delete'					=> 'Delete',

										 'Approved'                 => 'Approve',

										 'ApprovingPublish'			=> 'Request Publish',

										 'RejectApprove'			=> 'Reject Approve',

										 'RejectDelete'             => 'Reject Delete',

										 'ApprovingDelete'	        => 'Request Delete'

										);


//================================== User & Roll =============================// 
$GLOBALS['UserType']             = array (
										   'admin'		=>  'Admin',
										   'editor'		=>  'Editor',
										   'approver'	=>  'Approver'
										  );

$GLOBALS['Module']				 =  array ( 
											'whatnew'		=>	"What's new",
											'career'		=>	"Career",
											'specialOffer'	=>	"Special Offer"
										   );


?>