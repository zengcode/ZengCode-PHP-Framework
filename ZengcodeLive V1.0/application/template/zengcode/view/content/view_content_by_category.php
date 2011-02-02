<?=$DATA['header']?>
<form method="post" action="/Module/Content/Action/ListContentByCategory">
<B>Quick Menu :</B> <? echo Utility::GenerateDbDropdown('category','category_id','category_name',$DATA['category_id'],'');?>
&nbsp;<input type="submit" value=" ค้นหา " class="button" style="width:50px">
</form>
<BR><BR>
<div class="body-div-line">
<?echo $DATA['table']?>
</div><BR>
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