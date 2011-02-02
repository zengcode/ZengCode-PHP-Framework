<?php


$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/admin/Module/Content/Action/Update',
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);

$form = array(		
				array('type'	   => 'field',
					  'name'	   => 'content_id',
					  'label_th'   => 'Content ID',
					  'label_en'   => 'Content ID',
					  'label_jp'   => 'Content ID',
					  'input_type' => 'hidden',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
                array('type'	   => 'field',
					  'name'	   => 'category_id',
					  'label_th'   => 'Category',
					  'label_en'   => 'Category',
					  'label_jp'   => 'Category',
					  'input_type' => 'dropdownDb',
					  'look_up'    => 'category:category_id:category_name',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
				array('type'	   => 'field',
					  'name'	   => 'content_name',
					  'label_th'   => 'Content Name',
					  'label_en'   => 'Content Name',
					  'label_jp'   => 'Content Name',
					  'input_type' => 'textBox',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
               array('type'	   => 'field',
					  'name'	   => 'content_summary',
					  'label_th'   => 'Content Summary',
					  'label_en'   => 'Content Summary',
					  'label_jp'   => 'Content Summary',
					  'input_type' => 'textEditorStandard',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
               array('type'	   => 'field',
					'name'	   => 'content_detail',
					'label_th'   => 'Detail',
					'label_en'   => 'Detail',
					'label_jp'   => 'Detail',
					'input_type' => 'textEditorStandard',
					'style'      => 'textBox',
					'validate'   => 'text' ,
					'length'     => ''
					)  			      			
		);
?>