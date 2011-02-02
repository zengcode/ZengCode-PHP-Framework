/*
	* author: Logan Cai
	* Email: cailongqun [at] yahoo [dot] com [dot] cn
	* Website: www.phpletter.com
	* Created At: 21/April/2007
	* Modified At: 1/June/2007
*/

 var dcTime=300;    // doubleclick time
 var dcDelay=100;   // no clicks after doubleclick
 var dcAt=0;        // time of doubleclick
 var savEvent=null; // save Event for handling doClick().
 var savEvtTime=0;  // save time of click event.
 var savTO=null;    // handle of click setTimeOut
 var linkElem = null;
 
 
 function hadDoubleClick() {
   var d = new Date();
   var now = d.getTime();
   if ((now - dcAt) < dcDelay) {
     return true;
   }
   return false;
 };
 

/**
* add over class to the specific table
*/
function tableRuler(element)
{
	
    var rows = $(element);
	
    $(rows).each(function(){
        $(this).mouseover(function(){
            $(this).addClass('over');
        });
        $(this).mouseout(function(){
            $(this).removeClass('over');
        });
    });
};


		 function getIEVersion( ) 
		 {
    	var ua = navigator.userAgent;
   	 	var IEOffset = ua.indexOf("MSIE ");
   		 return parseFloat(ua.substring(IEOffset + 5, ua.indexOf(";", IEOffset)));
		};			
/**
*check all checkboxs and uncheck all checkbox
*/
function checkAll(selectAllText, unselectAllText)
{
	var checkbox = $('#tickAll');
	if($(checkbox).attr('class') == "check_all")
	{
		$(checkbox).attr('class', 'uncheck_all');
		$(checkbox).attr('title', unselectAllText);
		$("#fileList tr[@id^=row] input[@type=checkbox]").each(function(i){
														   			$(this).attr("checked", 'checked');												 
																	 })	;		

	}else
	{
		$(checkbox).attr('class', 'check_all');
		$(checkbox).attr('title', selectAllText);	
		$("#fileList input[@type=checkbox][@checked]").each(function(i){
																		 $(this).removeAttr("checked");
																	 
																	 })	;
	}
		
};
/**
*	show up the selected document information
*/
function setDocInfo(type, rowNum)
{
	$('#edit').hide();		
	if(document.getElementById('check'+rowNum).checked)
	{
		if(type=="folder")
		{
			$('#folderPath').text($('#folderPath'+rowNum).val());
			$('#folderFile').text($('#folderFile'+rowNum).val());
			$('#folderSubdir').text($('#folderSubdir'+rowNum).val());
			$('#folderCtime').text($('#folderCtime'+rowNum).val());
			$('#folderMtime').text($('#folderMtime'+rowNum).val());
			if($('#folderReadable' + rowNum).val() == '1')
			{
				$('#folderReadable').html("<span class=\"flagYes\">&nbsp;</span>");	
			}else
			{
				$('#folderReadable').html("<span class=\"flagNo\">&nbsp;</span>");
			}
			if($('#folderWritable' + rowNum).val() == '1')
			{
				$('#folderWritable').html("<span class=\"flagYes\">&nbsp;</span>");	
			}else
			{
				$('#folderWritable').html("<span class=\"flagNo\">&nbsp;</span>");
			}	
			$('#folderFieldSet').css('display', '');
			$('#fileFieldSet').css('display', 'none');	
			$('#preview').html(msgNotPreview);
		}else
		{
			$('#preview').html(msgNotPreview);
			$('#selectedFileRowNum').val(rowNum);
			$('#fileName').text($('#fileName'+rowNum).val());
			$('#fileSize').text($('#fileSize'+rowNum).val());
			$('#fileType').text($('#fileType'+rowNum).val());
			$('#fileCtime').text($('#fileCtime'+rowNum).val());
			$('#fileMtime').text($('#fileMtime'+rowNum).val());
			if($('#fileReadable' + rowNum).val() == '1')
			{
				$('#fileReadable').html("<span class=\"flagYes\">&nbsp;</span>");	
			}else
			{
				$('#fileReadable').html("<span class=\"flagNo\">&nbsp;</span>");
			}
			if($('#fileWritable' + rowNum).val() == '1')
			{
				$('#fileWritable').html("<span class=\"flagYes\">&nbsp;</span>");	
			}else
			{
				$('#fileWritable').html("<span class=\"flagNo\">&nbsp;</span>");
			}	
			$('#folderFieldSet').css('display', 'none');
			$('#fileFieldSet').css('display', '');
		
			if($('#filePreview' + rowNum).val() == '1')
			{
				$("#loading")
				   .ajaxStart(function(){
					   $(this).show();
				   })
				   .ajaxComplete(function(){
					   $(this).hide();
				   });	
				switch($('#fileType'+rowNum).val())
				{
					case "image":
						$('#edit').show();
						$('#loading').show();
						var preImage = new Image();													
							preImage.onload = function()
							{				
																			
								$('#preview').empty();
								$(preImage).appendTo('#preview');
								$('#loading').hide(); 
									 
							};
							preImage.src = appendQueryString(urlImgPreview,  "path=" + $('#filePath' + rowNum).val())  ;	
							
						break;
					case "txt":
						$("#preview").load(appendQueryString(urlPreview, "path=" + $('#filePath' + rowNum).val()) ,
					  function() {
						  }
					);	
					case "xml":
					case "html":
						$('#edit').show();						
						break;
					case "video":
					case "movie":
					case "music":
					case "Flash":
						$('#preview').html('<a id="' + 'preview' +rowNum + '" href="' + $('#fileUrl'+rowNum).val() + '" onclick="return previewMedia(' +  rowNum +   ');"><div id="player">&nbsp;</div></a>');
						break;
					default:
	
					//do nothing
				}	
				
			}else
			{
				$('#preview').html(msgNotPreview);
			}
			
		}
		
	}
	
};

function previewMedia(rowNum)
{
	$('#preview' +rowNum).html('');
	$('#preview' +rowNum).media({ width: 255, height: 210,  autoplay: true  });
	return false;
};

function generateDownloadIframe(url)
{
				var frameId = 'ajaxDownloadIframe';		
				$('#' + frameId).remove();
				if(window.ActiveXObject) {
						var io = document.createElement('<iframe id="' + frameId + '" name="' + frameId + '" />');
						
						
				}
				else {
						var io = document.createElement('iframe');
						io.id = frameId;
						io.name = frameId;
				}
				io.style.position = 'absolute';
				io.style.top = '-1000px';
				io.style.left = '-1000px';
				io.src = url; 
				document.body.appendChild(io);		
};



function enableDownload()
{
	$('#fileList tr td a[@target=_blank]').each(
																								 function(i)
																								 {
																									 //enable td
																										doEnableDownload(this);
																								 }		
																					 );
};
function doEnableDownload(elem)
{
																									 $(elem).dblclick(function()
																																						 {
																																							 //alert('duble click orignal');
																																							 var d = new Date();
																																							 dcAt = d.getTime();
																																							 if (savTO != null) {
																																								 clearTimeout( savTO );          // Clear pending Click  
																																								 savTO = null;
																																							 }
																																							 url = appendQueryString(urlDownload, 'path=' + $(this).attr('href'));
																																							 generateDownloadIframe(url);
																																							 return false;
																																						 }
																																						 );	
};



function getFileExtension(filename) 
{ 
 if( filename.length == 0 ) return ""; 
 var dot = filename.lastIndexOf("."); 
 if( dot == -1 ) return ""; 
 var extension = filename.substr(dot + 1,filename.length); 
 return extension; 
}; 
function doEnablePopup(elem)
{
		$(elem).each(
																						 function()
																						 {
																							 
																							 $(this).click(function ()
																																			 {

if (hadDoubleClick())
{
	return false;
}else
{
	//alert('single click');
	linkElem = this;
}

// Otherwise set timer to act.  It may be preempted by a doubleclick.
d = new Date();
savEvtTime = d.getTime();
savTO = setTimeout(function(){
if (savEvtTime - dcAt > 0) 
{
	//check if this file is previewable
	
	var oldHref = $(linkElem).attr('href');	
	var ext = getFileExtension(oldHref);
	var supportedExts = supporedPreviewExts.split(",");
	var isSupportedExt = false;
	for (i in supportedExts)
	{
		if(supportedExts[i].toLowerCase() == ext.toLowerCase())
		{
			isSupportedExt = true;
			break;
		}

	}
	if(isSupportedExt)
	{
		$(linkElem).attr('href', appendQueryString($(linkElem).attr('href'), 'KeepThis=true&TB_iframe=true&height=400&width=600'));
																					 
																																																							 
		var t = linkElem.title || linkElem.name || null;
		var a = linkElem.href || linkElem.alt;
		var g = linkElem.rel || false;
		tb_show(t,a,g);
		linkElem.blur();
		$(linkElem).attr('href', oldHref);		
		
	}else
	{
		url = appendQueryString(urlDownload, 'path=' + $(linkElem).attr('href'));
		generateDownloadIframe(url);
	}
}

	
	return false;															
														
														}, dcTime);			

																																			 
																																			 return false;
																																			 
																																			 });
	
																						 }
																						 );
};




function enablePopup()
{
	doEnablePopup('#fileList tr td a[@target=_blank]');
};

function appendQueryString(baseUrl, queryStr)
{
	return (baseUrl.indexOf('?')> -1?baseUrl + '&' + queryStr:baseUrl + '?' + queryStr);
};

function windowRefresh()
{
	document.location.reload();
};

/**
* selecte documents and fire an ajax call to delete them
*/
function deleteDocuments(msgNoDocSelected, msgUnableToDelete, msgWarning)
{
	var selectedDoc = $('#fileList input[@type=checkbox][@checked]');
	var hiddenSelectedDoc = $('#selectedDoc');
	var selectedOptions;
	var isSelected = false;
	var currentPath = $('#formDelete input[@name=currentFolderPath]').val();
	//remove all options
	$(hiddenSelectedDoc).removeOption(/./);
	$(selectedDoc).each(function(i){
										$(hiddenSelectedDoc).addOption($(this).val(), $(this).val(), true);
										isSelected = true;
										 });		
	if(!isSelected)
	{
		alert(msgNoDocSelected);
	}
	else
	{//remove them via ajax call
		if(window.confirm(msgWarning))
		{
			$("#loading")
			   .ajaxStart(function(){
				   $(this).show();
			   })
			   .ajaxComplete(function(){
				   $(this).hide();
			   });	
			var options = 
			{ 
				dataType: 'json',
				error: function (data, status, e) 
				{
					alert(e);
				},				
				success:   function(data) 
				{ 
					//remove those selected items
										if(data.error != '')
										{
											alert(data.error);
										}else
										{
											$(selectedDoc).each(function(i)
											{
												$(this).parent().parent().remove();
											 })	;											
										}
										
					


				} 
			}; 
			$('#formAction').attr('action', urlDelete);
			$('#formAction').ajaxSubmit(options); 	
						 				
		}
	}
	
	return false;	
};



function createFolder( msgNameFormat)
{
	
	var pattern=/^[A-Za-z0-9_ \-]+$/i;
	
	var folder = $('#new_folder');
	
	if(!pattern.test($(folder).val()))
	{
		alert(msgNameFormat);	
	}else
	{	

			$("#loading")
			   .ajaxStart(function(){
				   $(this).show();
			   })
			   .ajaxComplete(function(){
				   $(this).hide();
			   });	
			var options = 
			{ 
				dataType: 'json',
				error: function (data, status, e) 
				{

					alert(e);
				},				
				success:   function(data) 
				{ 
					//remove those selected items
										if(data.error != '')
										{
											alert(data.error);
										}else
										{
											//show up the new folder	
									var tbody = $('#fileList');
									var rows = $('#fileList tr');
									//var newRowNum = $(rows).length;
									numRows++;
									var newRowNum = numRows;
									var cssRow = (newRowNum % 2?"even":"odd");
									var strCss = "left";
									var strDisabled = "";
									if(!data.is_writable)
									{
										strDisabled = " disabled";
										strCss = " leftDisabled";
									}									
									var folderRow = "";
									folderRow += '<tr class="' + cssRow + '" id="row'+ (newRowNum) +'" >';
									
									folderRow += '	<td onclick="setDocInfo(\'folder\', \''+ (newRowNum) +'\');"><input type="checkbox" name="check[]" id="check'+ (newRowNum) +'" value="' + data.name + '" ' + strDisabled +' />';
									folderRow += '		<input type="hidden" name="folderName'+ (newRowNum) +'" id="folderName'+ (newRowNum) +'" value="' + data.name + '" />';
									folderRow += '		<input type="hidden" name="folderPath'+ (newRowNum) +'" value="' + data.path + '" id="folderPath'+ (newRowNum) +'" />';
									folderRow += '		<input type="hidden" name="folderFile'+ (newRowNum) +'" value="' + data.file + '" id="folderFile'+ (newRowNum) +'" />';
									folderRow += '		<input type="hidden" name="folderSubdir'+ (newRowNum) +'" id="folderSubdir'+ (newRowNum) +'" value="' + data.subdir + '" />';
									folderRow += '		<input type="hidden" name="folderCtime'+ (newRowNum) +'" id="folderCtime'+ (newRowNum) +'" value="' + data.ctime + '" />';
									folderRow += '		<input type="hidden" name="folderMtime'+ (newRowNum) +'" id="folderMtime'+ (newRowNum) +'" value="' + data.mtime + '" />';
									folderRow += '		<input type="hidden" name="fileReadable'+ (newRowNum) +'" id="folderReadable'+ (newRowNum) +'" value="' + data.is_readable + '" />';
									folderRow += '		<input type="hidden" name="folderWritable'+ (newRowNum) +'" id="folderWritable'+ (newRowNum) +'" value="' + data.is_writable + '" />';
									folderRow += '		<input type="hidden" name="itemType'+ (newRowNum) +'" id="itemType'+ (newRowNum) +'" value="folder" />';
									folderRow += '	</td>';
									folderRow += '	<td><a href="' + data.url + '" title="' + data.tip + '"><span class="folderEmpty"><span class="noFlag" id="flag'+ (newRowNum) +'">&nbsp;</span></span></a></td>';
									folderRow += '	<td class="' + strCss +'" id="' + data.realpath + '">' + data.name + '</td>';
									folderRow += '	<td >&nbsp;</td>';
									folderRow += '	<td>' + data.mtime + '</td>';
									folderRow += '</tr>';	

									$(folderRow).appendTo('#fileList');
									tableRuler('#row'+ newRowNum);
									
									 $('#row'+ newRowNum +  ' td.left').editable(urlRename, 
									 { 
												 submit    : 'Save',
												 width	   : '150',
												 height    : '14',
												 loadtype  : 'POST',
												 event	   :  'dblclick',
												 indicator : "<img src='images/loading.gif'>",
												 tooltip   : data.tipedit
									 });	

										}
										
					


				} 
			}; 
			$('#formNewFolder').ajaxSubmit(options); 	
						 				
				
	}
	return false;
	
};

function uploadFile(msgNameFormat, msgFileEmpty)
{

	var pattern=/[A-Za-z0-9_\-. ]+\.[A-Za-z0-9]+$/i;
	var file = $('#new_file');
	if ($(file).val() == "")
	{
		
		alert(msgFileEmpty);
	}
	else if(!pattern.test($(file).val()))
	{
		alert(msgNameFormat);	
	}else
	{
		

			$("#loading")
			   .ajaxStart(function(){
				   $(this).show();
			   })
			   .ajaxComplete(function(){
				   $(this).hide();
			   });	
				 
			var options = 
			{ 
				dataType: 'json',
				error: function (data, status, e) 
				{
					alert(e);
				},				
				success: function(data) 
				{ 
					//remove those selected items
										if(typeof(data.error) == 'undefined')
										{
											alert('Unexpected information ');
										}
										else if(data.error != '')
										{
											
											alert(data.error);
										}else
										{
											
											//show up the new folder	
												var tbody = $('#fileList');
												var rows = $('#fileList tr');
												var cssRow = ($(rows).length) % 2?"even":"odd";
												//var newRowNum = $(rows).length;
												numRows++;
												var newRowNum = numRows;												
												var fileRow = "";
												var strCss = "left";
												var strDisabled = "";
												if(!data.is_writable)
												{
													strDisabled = " disabled";
													strCss = " leftDisabled";
												}
												
								fileRow +='<tr class="' + cssRow +'" id="row' + newRowNum + '"  >';
								fileRow +='<td onclick="setDocInfo(\''+ data.type + '\', \'' + newRowNum + '\');"><input type="checkbox" name="check[]" id="check' + newRowNum + '" value="'+ data.name + '"' + strDisabled + ' />';
								fileRow +='		<input type="hidden" name="fileName' + newRowNum + '" value="'+ data.name + '" id="fileName' + newRowNum + '" />';
								fileRow +='		<input type="hidden" name="fileSize' + newRowNum + '" value="'+ data.size + '" id="fileSize' + newRowNum + '" />';
								fileRow +='		<input type="hidden" name="fileType' + newRowNum + '" value="'+ data.fileType + '" id="fileType' + newRowNum + '" />';
								fileRow +='		<input type="hidden" name="fileCtime' + newRowNum + '" id="fileCtime' + newRowNum + '" value="'+ data.ctime + '" />';
								fileRow +='		<input type="hidden" name="fileMtime' + newRowNum + '" id="fileMtime' + newRowNum + '" value="'+ data.mtime + '" />';
								fileRow +='		<input type="hidden" name="fileReadable' + newRowNum + '" id="fileReadable' + newRowNum + '" value="'+ data.is_writable + '" />';
								fileRow +='		<input type="hidden" name="fileWritable' + newRowNum + '" id="fileWritable' + newRowNum + '" value="'+ data.is_readable + '" />';
								fileRow +='			<input type="hidden" name="filePreview' + newRowNum + '" id="filePreview' + newRowNum + '" value="'+ data.preview + '" />';
								fileRow +='			<input type="hidden" name="filePath' + newRowNum + '" id="filePath' + newRowNum + '" value="'+ data.path + '" />	';							
								fileRow +='<input type="hidden" name="fileUrl' + newRowNum + '" id="fileUrl' + newRowNum + '" value="' + data.url + '" />';			
								fileRow += '<input type="hidden" name="itemType' + newRowNum + '" id="itemType' + newRowNum + '" value="file" />';
								fileRow +='	</td>';
								fileRow +='	<td><a href="'+ data.path + '" target="_blank"><span class="'+ data.cssClass + '"><span class="noFlag"  id="flag'+ (newRowNum) +'">&nbsp;</span></span></a></td>';
								fileRow +='	<td class="' + strCss +'" id="'+ data.path + '">'+ data.name + '</td>';
								fileRow +='	<td >'+ data.size + '</td>';
								fileRow +='	<td>'+ data.mtime + '</td>';
								fileRow +='</tr>	';		
												$(fileRow).appendTo('#fileList');
												tableRuler('#row'+ newRowNum);
												//$('#row'+ newRowNum + ":first-child").click();
												 $('#row'+ newRowNum +  ' td.left').editable(urlRename, 
												 { 
															 submit    : 'Save',
															 width	   : '150',
															 height    : '14',
															 loadtype  : 'POST',
															 event	   :  'dblclick',
															 indicator : "<img src='images/loading.gif'>",
															 tooltip   : data.tipedit
												 });	
												 doEnablePopup('#row'+ newRowNum +  ' td a[@target=_blank]');
												 doEnableDownload('#row'+ newRowNum +  ' td a[@target=_blank]');
										}
										
					


				} 
			}; 
			
			$('#formFile').ajaxSubmit(options); 	
						 				
				
	}
	return false;	
	
};

function selectForEdit(warning)
{
	var selectedFileRowNum = $('#selectedFileRowNum').val();
	var url = '';
	if(selectedFileRowNum != '' && $('#row' + selectedFileRowNum))
	{
		switch($('#fileType'+selectedFileRowNum).val())
		{
			case 'image':
				url = urlImageEditor;
				break;
			default:
				url = urlTextEditor;
		}		
		 var param = "status=yes,menubar=no,resizable=yes,scrollbars=yes,location=no,toolbar=no";
		 param += ",height=" + screen.height + ",width=" + screen.width;
		if(typeof(window.screenX) != 'undefined')
		{
			param += ",screenX = 0,screenY=0";
		}else if(typeof(window.screenTop) != 'undefined' )
		{
			param += ",left = 0,top=0" ;
		}		 
		var newWindow = window.open(url + ((url.lastIndexOf("?") > - 1)?"&":"?") + "path="  + $('#filePath' + selectedFileRowNum).val(),'', param);
		newWindow.focus( );		
	}else
	{
		alert(warning);
	}
	

};





function cutDocuments(msgNoDocSelected)
{
	repositionDocuments(msgNoDocSelected, urlCut, 'cut');
	return false;
};

function copyDocuments(msgNoDocSelected)
{
	repositionDocuments(msgNoDocSelected, urlCopy, 'copy');
	return false;
};

function pasteDocuments(msgNoDocSelected)
{
	if(numFiles)
	{

		var warningMsg = (action == 'copy'?warningCopyPaste:warningCutPaste);
		if(window.confirm(warningMsg))
		{
		
			$("#loading")
			   .ajaxStart(function(){
				   $(this).show();
			   })
			   .ajaxComplete(function(){
				   $(this).hide();
			   });	
			var currentFolderPath = $('#formAction input[@name=currentFolderPath]').val();
			//alert(urlPaste);
			$('#body').load(urlPaste, {path: currentFolderPath}, function(){enableEditable();});			
		}
	}else
	{
		alert(msgNoDocSelected);
	}
	return false;
	
};

/**
* selecte documents and fire an ajax call to delete them
*/
function repositionDocuments(msgNoDocSelected, formActionUrl, actionVal)
{
	var selectedDoc = $('#fileList input[@type=checkbox][@checked]');
	var hiddenSelectedDoc = document.getElementById('selectedDoc');
	var selectedOptions;
	var isSelected = false;
	var currentPath = $('#formDelete input[@name=currentFolderPath]').val();
	//remove all options
	$(hiddenSelectedDoc).removeOption(/./);
	$(selectedDoc).each(function(i){
										$(hiddenSelectedDoc).addOption($(this).val(), $(this).val(), true);
										isSelected = true;
										 });	
	if(!isSelected)
	{
		alert(msgNoDocSelected);
	}
	else
	{
		
			var formAction =  document.formAction;
			var actionElem = $('#action_value');
			formAction.action = formActionUrl;
			$(actionElem).val(actionVal);
			$("#loading")
			   .ajaxStart(function(){
				   $(this).show();
			   })
			   .ajaxComplete(function(){
				   $(this).hide();
			   });	
			var options = 
			{ 
				dataType: 'json',
				error: function (data, status, e) 
				{
					alert(e);
				},				
				success:   function(data) 
				{ 
										if(data.error != '')
										{
											alert(data.error);
										}else
										{			
											numFiles = data.num;
											//set change flags
											var flag = (actionVal == 'copy'?'copyFlag':'cutFlag');		
											action = actionVal;

												

												var count = -1;
												var allStringNum = "";
												var isSelected = false;
												$('#fileList input[@type=checkbox]').each(function(i)
															 {
																 isSelected = false;
																		var rowNum = $(this).attr('id').substr(5, ($(this).attr('id').length - 5));
																		var flagElem = $('#flag'+ rowNum);																	 
																 if(parseInt(rowNum) > count)
																 {//avoid looping back
																 		
																	 	for(var j = 0; j < hiddenSelectedDoc.length; j++)
																		{
																			if($(this).val() == hiddenSelectedDoc.options[j].value)
																			{
																				isSelected = true;
																				//remove this matched option
																				hiddenSelectedDoc.options[j] = null;
																				break;
																			}
																		}
																	 if(isSelected)
																	 {	
																			$(flagElem).removeClass();
																			$(flagElem).addClass(flag);
																	 }else
																	 {
																			$(flagElem).removeClass();
																			$(flagElem).addClass('noFlag');																	 
																	 }	
																	 count = parseInt(rowNum);
																	 
																 }

															 }
															 
																																					 
															);

										}
										
					} 
			}; 
			$(formAction).ajaxSubmit(options); 	
						 				

	}
	
	return false;	
};

function initAction()
{
	$('#actionInfo').attr('href', 'http://www.phpletter.com/forum/index.php');
};

function closeWindow()
{
	if(window.confirm(warningCloseWindow))
	{
		window.close();
	}
	return false;
};
