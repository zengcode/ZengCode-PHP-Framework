<div class="box">
<CENTER><B><font color="#8A8146" size="3">Comment</font></B></CENTER>
<?
$record = $DATA['record'];
if ($DATA)
foreach ($record as $key => $content) {
?>
	 <br><U><B><?=$content['poster_name']?></B></U>&nbsp;&nbsp;(<?=Utility::DateToString($content['posted_date'])?>)
	 &nbsp;&nbsp;<a href="/Module/Content/Action/ViewContent/content_id/<?=$_GET['content_id']?>/comment_id/<?=$content['comment_id']?>"><img src="/images/delete.png" border="0"></a>
     <br><B>IP : <?=$content['ip']?></B><BR>
	 <table width="600px" >
	 <tr><td>
	 <?=Utility::ToBr($content['comment_detail'])?>
	 </td></tr>
	 </table>
<hr>
 <?}?>
</div>
<div class="clear"></div>  
<div style="background-color:#F8F8F8">
<?=$DATA['form']?>
</div>