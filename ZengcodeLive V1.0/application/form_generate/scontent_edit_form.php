<?php


$form_configuration = array(
                             'post_type' => 'post',
							 'action'    => '/admin/Module/SContent/Action/Update',
							 'upload'	 => 'no',
							 'onsubmit'  => '',
							 'style'     => '',
							 'submit_th' => 'เพิ่มข้อมูล',
							 'submit_en' => 'Add Data',
							);

$form = array(		
				array('type'	   => 'field',
					  'name'	   => 'content_key',
					  'label_th'   => 'Content Key',
					  'label_en'   => 'Content Key',
					  'label_jp'   => 'Content Key',
					  'input_type' => 'hidden',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												),
               array('type'	   => 'field',
					  'name'	   => 'content_detail',
					  'label_th'   => 'Content',
					  'label_en'   => 'Content',
					  'label_jp'   => 'Content',
					  'input_type' => 'textEditorStandard',
					  'style'      => 'textBox',
					  'validate'   => 'text' ,
					  'length'     => ''
												)	      			
		);
?>