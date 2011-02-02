
<div class="box">
<B><font color="#8A8146" size="5">บทความล่าสุด</font></B><BR>
<?foreach ($DATA as $key => $content) {?>
	 <br><img src="/images/new.gif">&nbsp;<U><B><?=$content['content_name']?></B></U>&nbsp;&nbsp;(<?=$content['post_date']?>)
	 <p>
	 <?=$content['content_summary']?>
	 <a href="/Module/Content/Action/ViewContent/content_id/<?=$content['content_id']?>" class="more">MORE</a>
	 </p>
	 <BR><hr>
 <?}?>
</div>
<div class="clear"></div>  