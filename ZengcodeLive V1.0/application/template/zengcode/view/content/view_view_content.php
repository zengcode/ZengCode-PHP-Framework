<?//print("<pre>");print_r($DATA);print("</pre>");?>
<div class="box">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B><font color="#8A8146" size="3"><?=$DATA['content_name']?>&nbsp;&nbsp;(<?=$DATA['post_date']?>)</font></B><BR>

	 <p>
	 <?=$DATA['content_detail']?>
	 </p>

</div>
<div class="clear"></div>  
<hr>
<?
View::LoadContent('Comment','ListAll'); 
?>