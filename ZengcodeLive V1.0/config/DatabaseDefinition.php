<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/


$GLOBALS['TABLE']['faq']['key'] = array(
                                         array('name'		=> 'id',
											   'label'		=> 'ID : '
											   'type'		=> 'getNext',
											   'insertWant' => 'yes',
											   'updateWant' => 'no',
											   'validate'   => '',
											   'length'     => ''
										      );
								    
								        );

$GLOBALS['TABLE']['faq']['combine'] = array(
                                             array('name'		=> 'creator',
											       'label'      => 'Creator : ',
												   'type'		=> 'session',
												   'validate'   => '',
												   'length'     => ''
											 ),

								              array('name'		=> 'thumnail',
											       'label'      => 'Thumnail : ',
												   'type'		=> 'filePicture',
												   'validate'   => 'text',
												   'length'     => ''
											 )
								        );

$GLOBALS['TABLE']['faq']['fields']  = array(
                                         
								             array('name'		=> 'topic',
											       'label'      => 'Topic : ',
												   'type'		=> 'text',
												   'validate'   => '',
												   'length'     => ''
											 ),

								              array('name'		=> 'content',
											       'label'      => 'Content : ',
												   'type'		=> 'textEditorStandard',
												   'validate'   => 'text',
												   'length'     => ''
											 ),

											array('type'       => 'field',
												  'name'	   => 'start_date',
												  'label'      => 'Start Date : ',
												  'type'       => 'calendar',
												  'validate'   => '',
												  'length'     => '' 
											)
								        );

//=================================================================================================//




?>