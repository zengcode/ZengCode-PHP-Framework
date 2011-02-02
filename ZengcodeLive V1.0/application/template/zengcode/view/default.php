<?=$DATA['header']?>
<div class="body-div-line">
<?echo $DATA['table']?>
</div>
<? 
View::PageList1($DATA['link'],$DATA['numberOfPage'],$DATA['currentPage'])
?>
<?=$DATA['footer']?>

<? 
//View::LoadContentAdmin('Category','test'); 
//View::LoadContentAdmin('Category','test');
//View::LoadContent('Category','test');
?>