<?php
$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/admin/Module/Category/Action/Insert',
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);
$form = array(		
				array('type'	   => 'field',
					  'name'	   => 'category_name',
					  'label_th'   => 'Category Name',
					  'label_en'   => 'Category Name',
					  'label_jp'   => 'Category Name',
					  'input_type' => 'textBox',
					  'style'      => 'textBox',
					  'null'       => 'no',
					  'validate'   => 'text' ,
					  'length'     => '100',
					  'error_msg'  => 'please input Category Name',
					  'length'     => ''
												),
               array('type'	   => 'field',
					'name'	   => 'category_remark',
					'label_th'   => 'Remark',
					'label_en'   => 'Remark',
					'label_jp'   => 'Remark',
					'input_type' => 'textBox',
					'style'      => 'textBox',
					'null'       => 'yes',
					'validate'   => 'text' ,
					'length'     => ''
					),
               
			   array('type'	     => 'field',
					'name'	     => 'weight',
					'label_th'   => 'Ordering',
					'label_en'   => 'Ordering',
					'label_jp'   => 'Ordering',
					'input_type' => 'textBox',
					'style'      => 'textBox',
					'null'       => 'no',
					'validate'   => 'number' ,
					'length'     => ''
					)      			      			
		);
?>