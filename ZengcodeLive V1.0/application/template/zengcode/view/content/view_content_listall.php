<?=$DATA['header']?><BR>
<form method="post" action="/admin/Module/Content/Action/ListAll">
Please Select : <? echo Utility::GenerateDbDropdown('category','category_id','category_name',$DATA['category_id'],'');?>
<input type="submit" value=" Submit " class="button">
</form>
<BR><BR>
<div class="body-div-line">
<?echo $DATA['table']?>
</div>
<? 
$getVar = ($DATA['category_id'])? '/category_id/'.$DATA['category_id']  : '';
View::PageList1($DATA['link'],$DATA['numberOfPage'],$DATA['currentPage'],$getVar)
?>
<?=$DATA['footer']?>
























<? 
//View::LoadContentAdmin('Category','test'); 
//View::LoadContentAdmin('Category','test');
//View::LoadContent('Category','test');
?>