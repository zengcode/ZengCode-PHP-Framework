<?php
	/**
	 * delete selected files
	 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
	 * @link www.phpletter.com
	 * @since 22/April/2007
	 *
	 */
	require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");
	$error = "";
	if(!isset($_POST['selectedDoc']) || !is_array($_POST['selectedDoc']) || sizeof($_POST['selectedDoc']) < 1)
	{
		$error = ERR_NOT_FILE_SELECTED;
	}
	elseif(empty($_POST['currentFolderPath']) || !isUnderRoot($_POST['currentFolderPath']))
	{
		$error = ERR_FOLDER_PATH_NOT_ALLOWED;
	}
	else 
	{
		include_once(CLASS_FILE);
		$file = new file();
		
		foreach($_POST['selectedDoc'] as $doc)
		{
			if(is_dir($_POST['currentFolderPath'] . $doc) 
				&& (!CONFIG_SYS_EXC_DIR_PATTERN || !preg_match(CONFIG_SYS_EXC_DIR_PATTERN, $doc) 
				&& (!CONFIG_SYS_INC_DIR_PATTERN || preg_match(CONFIG_SYS_INC_DIR_PATTERN, $doc))))
				{
					$file->delete(addTrailingSlash($_POST['currentFolderPath']) . $doc);
				}elseif(is_file($_POST['currentFolderPath'] . $doc) 
				&& (!CONFIG_SYS_EXC_FILE_PATTERN || !preg_match(CONFIG_SYS_EXC_FILE_PATTERN, $doc) 
				&& (!CONFIG_SYS_INC_FILE_PATTERN || preg_match(CONFIG_SYS_INC_FILE_PATTERN, $doc))))
				{
					$file->delete(addTrailingSlash($_POST['currentFolderPath']) . $doc);
				}
			
		}
	}
	echo "{error:'" . $error . "'}";
?>