function selectFile(msgNoFileSelected)
{
   var selectedFileRowNum = $('#selectedFileRowNum').val();
  if(selectedFileRowNum != '' && $('#row' + selectedFileRowNum))
  {

     // insert information now
     var url = $('#fileUrl'+selectedFileRowNum).val();     
      // set url to the url placeholder element
      window.opener.document.getElementById(elementId).value = url;
      window.close() ;
      
  }else
  {
     alert(msgNoFileSelected);
  }
 

}



function cancelSelectFile()
{
  // close popup window
  window.close() ;
}