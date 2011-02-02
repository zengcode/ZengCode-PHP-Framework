<?php

$content_id = $_GET['content_id'];
$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/Module/Content/Action/ViewContent/content_id/'.$content_id,
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);

$form = array(		
				array('type'	   => 'field',
					  'name'	   => 'poster_name',
					  'label_th'   => 'Name',
					  'label_en'   => 'Name',
					  'label_jp'   => 'Name',
					  'input_type' => 'textBox',
					  'style'      => 'textBox',
					  'null'       => 'no',
					  'error_msg'  => 'please input Your Name',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
               array('type'	     => 'field',
					'name'		 => 'comment_detail',
					'label_th'   => 'Comment',
					'label_en'   => 'Comment',
					'label_jp'   => 'Comment',
					'input_type' => 'textEditorBasicSmall',
					'style'      => 'textBox',
					'null'       => 'yes',
					'error_msg'  => 'please input Your Comment',
					'validate'   => 'editor' ,
					'length'     => ''
					),
					
			  array('type'	   => 'field',
					  'name'	   => 'captcha_code',
					  'label_th'   => 'Security Code',
					  'label_en'   => 'Name',
					  'label_jp'   => 'Name',
					  'input_type' => 'captcha',
					  'style'      => 'textBox',
					  'null'       => 'no',
					  'error_msg'  => 'please input security code',
					  'validate'   => 'text' ,
					  'length'     => ''
												),	
		);
?>