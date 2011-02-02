<?php

function callFunction(){
	$str = "<input type='text' name='callFunction' id='callFunction' value='I am from function'>";
	return $str;
}


$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/admin/Module/User/Action/Insert',
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);






$form = array(
				array ('type'      => 'group',
					   'label_th'   => 'User Detail',
					   'label_en'   => 'User Detail',
					   'label_jp'   => 'User Detail',
				       'member'    => array(

												array('type'	   => 'field',
													  'name'	   => 'username',
													  'label_th'   => 'Username',
													  'label_en'   => 'Username',
													  'label_jp'   => 'Username',
													  'input_type' => 'textBox',
													  'style'      => 'textBox',
													  'validate'   => 'text' ,
													  'length'     => ''
												),

												array('type'	   => 'field',
													  'name'	   => 'password',
													  'label_th'   => 'Password',
													  'label_en'   => 'Password',
													  'label_jp'   => 'Password',
													  'input_type' => 'textBox',
													  'style'      => 'textBox',
													  'validate'   => 'text' ,
													  'length'     => ''
												),

												array('type'	   => 'field',
													  'name'	   => 'firstname',
													  'label_th'   => 'First Name',
													  'label_en'   => 'First Name',
													  'label_jp'   => 'First Name',
													  'input_type' => 'textBox',
													  'value'      => '',
													  'style'      => '0',
													  'validate'   => 'text' ,
													  'length'     => ''
												),

												array('type'	   => 'field',
													  'name'	   => 'lastname',
													  'label_th'   => 'Last Name',
													  'label_en'   => 'Last Name',
													  'label_jp'   => 'Last Name',
													  'input_type' => 'textBox',
													  'value'      => '',
													  'style'      => '0',
													  'validate'   => 'text' ,
													  'length'     => ''
												),
												
												

												array('type'	   => 'field',
													  'name'	   => 'email',
													  'label_th'   => 'Email',
													  'label_en'   => 'Email',
													  'label_jp'   => 'Email',
													  'input_type' => 'textBox',
													  'style'      => 'textBox',
													  'validate'   => 'email' ,
													  'length'     => ''
												),

												array('type'	   => 'field',
													  'name'	   => 'tel',
													  'label_th'   => 'Tel',
													  'label_en'   => 'Tel',
													  'label_jp'   => 'Tel',
													  'input_type' => 'textBox',
													  'style'      => '',
													  'validate'   => '' ,
													  'length'     => ''
												),

												array('type'	   => 'field',
													  'name'	   => 'image',
													  'label_th'   => 'Image',
													  'label_en'   => 'Image',
													  'label_jp'   => 'Image',
													  'input_type' => 'image',
													  'style'      => '200px,200px',
													  'validate'   => '' ,
													  'length'     => ''
												)
												
					)
				),

				array ('type'      => 'group',
					   'label_th'   => 'User Role',
					   'label_en'   => 'User Role',
					   'label_jp'   => 'User Role',
				       'member'    => array(

												array('type'	   => 'field',
													  'name'	   => 'usertype',
													  'label_th'   => 'Level',
													  'label_en'   => 'Level',
													  'label_jp'   => 'Level',
													  'input_type' => 'radio',
													  'value'      => 'Editor,editor:Approver,approver:Admin,admin',
													  'style'      => '0',
													  'validate'   => '' ,
													  'length'     => ''
												      ),
												array('type'	   => 'field',
													  'name'	   => 'whatnew',
													  'label_th'   => 'What\'s New',
													  'label_en'   => 'What\'s New',
													  'label_jp'   => 'What\'s New',
													  'input_type' => 'checkbox',
													  'value'      => '',
													  'style'      => '0',
													  'validate'   => '' ,
													  'length'     => ''
												      ),
												array('type'	   => 'field',
													  'name'	   => 'career',
													  'label_th'   => 'Career',
													  'label_en'   => 'Career',
													  'label_jp'   => 'Career',
													  'input_type' => 'checkbox',
													  'value'      => '',
													  'style'      => '0',
													  'validate'   => '' ,
													  'length'     => ''
												      ),
												array('type'	   => 'field',
													  'name'	   => 'specialOffer',
													  'label_th'   => 'Special Offers',
													  'label_en'   => 'Special Offers',
													  'label_jp'   => 'Special Offers',
													  'input_type' => 'checkbox',
													  'value'      => '',
													  'style'      => '0',
													  'validate'   => '' ,
													  'length'     => ''
												      )

										    )
						)

	
	
		);


?>