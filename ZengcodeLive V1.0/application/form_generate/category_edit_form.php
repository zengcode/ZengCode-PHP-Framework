<?php


$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/admin/Module/Category/Action/Update',
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);

$form = array(		
                array('type'	   => 'field',
					  'name'	   => 'category_id',
					  'label_th'   => 'Category ID',
					  'label_en'   => 'Category ID',
					  'label_jp'   => 'Category Id',
					  'input_type' => 'hidden',
					  'style'      => 'textBox',
					  'validate'   => '' ,
					  'length'     => ''
												),
				array('type'	   => 'field',
					  'name'	   => 'category_name',
					  'label_th'   => 'Category Name',
					  'label_en'   => 'Category Name',
					  'label_jp'   => 'Category Name',
					  'input_type' => 'textBox',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
               array('type'	   => 'field',
					'name'	   => 'category_remark',
					'label_th'   => 'Remark',
					'label_en'   => 'Remark',
					'label_jp'   => 'Remark',
					'input_type' => 'textBox',
					'style'      => 'textBox',
					'validate'   => '' ,
					'length'     => ''
					),
               
			   array('type'	     => 'field',
					'name'	     => 'weight',
					'label_th'   => 'Ordering',
					'label_en'   => 'Ordering',
					'label_jp'   => 'Ordering',
					'input_type' => 'textBox',
					'style'      => 'textBox',
					'validate'   => 'number' ,
					'length'     => ''
					)      	      			
		);
?>