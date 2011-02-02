<?php
	session_start();
	/**
	 * file manager platform
	 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
	 * @link www.phpletter.com
	 * @since 22/May/2007
	 *
	 */
	require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");
	$session->gc();
	require_once(CLASS_MANAGER);
	define('URL_AJAX_FILE_MANAGER', CONFIG_URL_HOME);
	require_once(CLASS_SESSION_ACTION);
	$sessionAction = new SessionAction();
	//displayArray($sessionAction->get());
	require_once(DIR_AJAX_INC . "class.manager.php");

	$manager = new manager();
	$manager->setSessionAction($sessionAction);
	
	$fileList = $manager->getFileList();
	$folderInfo = $manager->getFolderInfo();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Logan Cai" />
<meta name="website" content="http://www.phpletter.com" /> 

<script type="text/javascript" src="jscripts/ajaxfilemanager_compressed.js"></script>
<script type="text/javascript" src="jscripts/file_manager_general.js"></script>
<!--

<script type="text/javascript" src="jscripts/jquery.js"></script>
<script type="text/javascript" src="jscripts/form.js"></script>
<script type="text/javascript" src="jscripts/select.js"></script>
<script type="text/javascript" src="jscripts/thickbox.js"></script>
<script type="text/javascript" src="jscripts/jeditable.js"></script>
<script type="text/javascript" src="jscripts/media.js"></script>
<script type="text/javascript" src="jscripts/file_manager_general.js"></script>
-->

    <script type="text/javascript" src="jscripts/<?php echo 'for_' . CONFIG_EDITOR_NAME . '.js'; ?>"></script>
<script type="text/javascript">
function enableEditable()
{
			 $("#fileList tr[@id^=row] td.left").editable("<?php echo appendQueryString(CONFIG_URL_SAVE_NAME, makeQueryString(array('path'))); ?>",
		 {
					 submit    : 'Save',
					 width	   : '150',
					 height    : '14',
					 loadtype  : 'POST',
					 event	   :  'dblclick',
					 indicator : "<img src='theme/<?php echo CONFIG_THEME_NAME; ?>/images/loading.gif'>",
					 tooltip   : '<?php echo TIP_DOC_RENAME; ?>'
		 }
		 
		 );	 	
}
	var tb_pathToImage = "theme/<?php echo CONFIG_THEME_NAME; ?>/images/loadingAnimation.gif";
	var urlPreview = '<?php echo appendQueryString(CONFIG_URL_PREVIEW, makeQueryString(array('path'))); ?>';
	var msgNotPreview = '<?php echo PREVIEW_NOT_PREVIEW; ?>';
	var urlCut = '<?php echo appendQueryString(CONFIG_URL_CUT, makeQueryString(array('path'))); ?>';
	var urlCopy = '<?php echo appendQueryString(CONFIG_URL_COPY, makeQueryString(array('path'))); ?>';
	var urlPaste = '<?php echo appendQueryString(CONFIG_URL_PASTE, makeQueryString(array('path'))); ?>';
	var warningCutPaste = '<?php echo WARNING_CUT_PASTE; ?>';
	var warningCopyPaste = '<?php echo WARNING_COPY_PASTE; ?>';
	var urlDelete = '<?php echo appendQueryString(CONFIG_URL_DELETE, makeQueryString(array('path'))); ?>';
	var action = '<?php echo $sessionAction->getAction(); ?>';
	var numFiles = <?php echo $sessionAction->count(); ?>;
	var urlRename = '<?php echo appendQueryString(CONFIG_URL_SAVE_NAME, makeQueryString(array('path'))); ?>';
	var warningCloseWindow = '<?php echo WARING_WINDOW_CLOSE; ?>';
	var numRows = <?php echo (($folderInfo['subdir']  + $folderInfo['file']) + 1); ?>; 
	var urlImgPreview = '<?php echo appendQueryString(CONFIG_URL_IMAGE_PREVIEW, makeQueryString(array('path'))); ?>';
	var urlDownload = '<?php echo appendQueryString(CONFIG_URL_DOWNLOAD, makeQueryString(array('path'))); ?>';
	var urlTextEditor = '<?php echo appendQueryString(CONFIG_URL_TEXT_EDITOR, makeQueryString(array('path'))); ?>';
	var wordCloseWindow = '<?php echo LBL_ACTION_CLOSE; ?>';
	var urlImageEditor = '<?php echo appendQueryString(CONFIG_URL_IMAGE_EDITOR, makeQueryString(array('path'))); ?>';
	var wordPreviewClick = '<?php echo LBL_CLICK_PREVIEW; ?>';
	var supporedPreviewExts = 'gif,bmp,txt,jpg,png,tif,html,htm,js,css,xml,xsl,dtd';
	var elementId = <?php  echo (!empty($_GET['elementId'])?"'" . $_GET['elementId'] . "'":'null'); ?>;
$(document).ready(
	function()
	{
		
		//tableRuler('#tableList tbody tr');
		$('#edit').hide();	
		enableEditable();
		initAction();
		enableDownload();
		enablePopup();
		
	} );

	
</script>
<link rel="stylesheet" type="text/css" href="theme/<?php echo CONFIG_THEME_NAME; ?>/css/<?php echo CONFIG_EDITOR_NAME; ?>.css" />
<link rel="stylesheet" href="theme/<?php echo CONFIG_THEME_NAME; ?>/css/thickbox.css" type="text/css" media="screen" />
<title>Ajax File Manager</title>
</head>
<body>
	<div id="container">
		<div id="leftCol">
			<div id="header">
				<ul id="actionHeader">
					<li><a href="#" id="actionRefresh" onclick="windowRefresh();"><span><?php echo LBL_ACTION_REFRESH; ?></span></a></li>
					<li><a href="#" id="actionDelete" onclick="deleteDocuments('<?php echo ERR_NOT_DOC_SELECTED; ?>', '<?php echo ERR_DELTED_FAILED; ?>', '<?php echo WARNING_DELETE; ?>');"><span><?php echo LBL_ACTION_DELETE; ?></span></a></li>
					<li><a href="#" id="actionCut" onclick="cutDocuments('<?php echo ERR_NOT_DOC_SELECTED_FOR_CUT; ?>');"><span><?php echo LBL_ACTION_CUT; ?></span></a><li>					
					<li><a href="#" id="actionCopy" onclick="copyDocuments('<?php echo ERR_NOT_DOC_SELECTED_FOR_COPY; ?>');"><span><?php echo LBL_ACTION_COPY; ?></span></a><li>
					<li><a href="#" id="actionPaste" onclick="pasteDocuments('<?php echo ERR_NOT_DOC_SELECTED_FOR_PASTE; ?>');"><span><?php echo LBL_ACTION_PASTE; ?></span></a><li>
					<li ><a href="#" id="actionInfo" target="_blank" title="Visit www.phpletter.com for more information"><span>Info</span></a><li>
					<!-- thest functions will be added in the near future
 					<li ><a href="#" id="actionZip"><span>Zip</span></a><li>
					<li ><a href="#" id="actionUnzip"><span>Unzip</span></a><li>-->
				</ul>
				<img src="theme/<?php echo CONFIG_THEME_NAME; ?>/images/loading.gif" id="loading" width="32" height="32" style="display:none;" />
				
			</div>
			<form action="<?php echo appendQueryString(CONFIG_URL_DELETE, makeQueryString(array('path'))) ?>" method="POST" name="formAction" id="formAction"><select name="selectedDoc[]" id="selectedDoc" style="display:none;" multiple="multiple"></select><input type="hidden" name="action_value" value="" id="action_value" /><input type="hidden" name="currentFolderPath"  value="<?php echo $folderInfo['path']; ?>" /></form>
			<div id="body"><?php
						include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ajax_get_file_list.php');
					?></div>
			<div id="footer">
					<form name="hiddenForm" id="hiddenForm" action="" method="POST">
					   <input type="hidden" name="selectedFileRowNum" id="selectedFileRowNum" value="" />
					</form>
					<div id="divNewFolder">
    					<form id="formNewFolder" name="formNewFolder" action="<?php echo appendQueryString(CONFIG_URL_CREATE_FOLDER, makeQueryString(array('path'))); ?>" method="POST">
    						<p><input type="hidden" name="currentFolderPath" value="<?php echo $folderInfo['path']; ?>" />
    						<input class="input" type="text" name="new_folder" id="new_folder"  value="<?php echo LBL_BTN_NEW_FOLDER; ?>" size="44"/>
    						<button class="button" id="create" onclick="return createFolder( '<?php echo ERR_FOLDER_FORMAT; ?>');"><?php echo LBL_BTN_CREATE; ?></button></p>
    					</form>
					</div>
					<div id="divFormFile">
						<form name="formFile" action="<?php echo appendQueryString(CONFIG_URL_UPLOAD, makeQueryString(array('path'))); ?>" method="post" id="formFile" enctype="multipart/form-data">
    						<p><input type="hidden" name="currentFolderPath"  value="<?php echo $folderInfo['path']; ?>" />
    						<input class="inputFile" type="file" name="new_file" id="new_file" size="34"/>
    						<button class="button" id="upload" onclick="return uploadFile('<?php echo ERR_FILE_NAME_FORMAT; ?>', '<?php echo ERR_FILE_NOT_UPLOADED; ?>');"><?php echo LBL_BTN_UPLOAD; ?></button></p>
						</form>
					</div>
					<div class="clear"></div>
			</div>
		</div>
		<div id="rightCol">
			<fieldset id="fileFieldSet" style="display:none" >
				<legend><?php echo LBL_FILE_INFO; ?></legend>
				<table cellpadding="0" cellspacing="0" class="tableSummary" id="fileInfo">
					<tbody>
						<tr>
							<th><?php echo LBL_FILE_NAME; ?></th>
							<td colspan="3" id="fileName"></td>
						</tr>
						<tr>
							<th><?php echo LBL_FILE_CREATED; ?></th>
							<td colspan="3" id="fileCtime"></td>

						</tr>
						<tr>
							<th><?php echo LBL_FILE_MODIFIED; ?></th>
							<td colspan="3" id="fileMtime"></td>
						</tr>
						<tr>
							<th><?php echo LBL_FILE_SIZE; ?></th>
							<td id="fileSize"></td>
							<th><?php echo LBL_FILE_TYPE; ?></th>
							<td id="fileType"></td>
						</tr>
						<tr>
							<th><?php echo LBL_FILE_WRITABLE; ?></th>
							<td id="fileWritable"><span class="flagYes">&nbsp;</span></td>
							<th><?php echo LBL_FILE_READABLE; ?></th>
							<td id="fileReadable"><span class="flagNo">&nbsp;</span></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
			<fieldset id="folderFieldSet" >
				<legend><?php echo LBL_FOLDER_INFO; ?></legend>
				<table cellpadding="0" cellspacing="0" class="tableSummary" id="folderInfo">
					<tbody>
						<tr>
							<th><?php echo LBL_FOLDER_PATH; ?></th>
							<td colspan="3" id="folderPath"><?php echo transformFilePath($folderInfo['path']); ?></td>
						</tr>
						<tr>
							<th><?php echo LBL_FOLDER_CREATED; ?></th>
							<td colspan="3" id="folderCtime"><?php echo date(DATE_TIME_FORMAT,$folderInfo['ctime']); ?></td>

						</tr>
						<tr>
							<th><?php echo LBL_FOLDER_MODIFIED; ?></th>
							<td colspan="3" id="folderMtime"><?php echo date(DATE_TIME_FORMAT,$folderInfo['mtime']); ?></td>
						</tr>
						<tr>
							<th><?php echo LBL_FOLDER_SUDDIR; ?></th>
							<td id="folderSubdir"><?php echo $folderInfo['subdir']; ?></td>
							<th><?php echo LBL_FOLDER_FIELS; ?></th>
							<td id="folderFile"><?php echo $folderInfo['file']; ?></td>
						</tr>
						<tr>
							<th><?php echo LBL_FOLDER_WRITABLE; ?></th>
							<td id="folderWritable"><span class="<?php echo ($folderInfo['is_readable']?'flagYes':'flagNo'); ?>">&nbsp;</span></td>
							<th><?php echo LBL_FOLDER_READABLE; ?></th>
							<td id="folderReadable"><span class="<?php echo ($folderInfo['is_writable']?'flagYes':'flagNo'); ?>">&nbsp;</span></td>
						</tr>


					</tbody>
				</table>
			</fieldset>
			<fieldset>
				<legend><?php echo LBL_PREVIEW; ?></legend>
				<div id="preview">
				<?php echo PREVIEW_NOT_PREVIEW; ?>				
				</div>
				<img id="previewLoading" src="theme/<?php echo CONFIG_THEME_NAME; ?>/images/loading.gif" style="display:none" width="32" height="32" />
			</fieldset>
			<div id="previewFooter">
				<p>
				<?php
					if(CONFIG_EDITOR_NAME != 'stand_alone')
					{//select button is not needed for stand alone mode
						?>
						<button class="button" id="select" onclick="selectFile('<?php echo ERR_NOT_FILE_SELECTED; ?>');"><?php echo LBL_BTN_SELECT; ?></button> 
						<?php
					}
				?>				
				<button class="button" id="edit" onclick="selectForEdit('<?php echo WARNING_NOT_FILE_EDIT; ?>');"><?php echo LBL_BTN_EDIT_IMAGE; ?></button>
				<?php
					if(CONFIG_EDITOR_NAME != 'stand_alone')
					{//cacel button is not needed for stand alone mode			
						?>
						<button class="button" id="cancel" onclick="cancelSelectFile();"><?php echo LBL_BTN_CANCEL; ?></button></p>
						<?php
					}else 
					{
						?>
						<button class="button" id="close" onclick="return closeWindow();"><?php echo LBL_BTN_CLOSE; ?></button></p>
						<?php
					}
				?>
				
			</div>
		</div>
	</div>
	<div class="clear"></div>
</body>
</html>
