<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<style type="text/css">
	body{
		margin:10px;
		font-size:0.9em;
	}
	a{
		color:#F00;
	}
	</style>
<!-- ########Template Style Sheel ####### -->
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/consolidated_common.css" />
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/common.css" />
 <link href="<?=TEMPLATE?>/css/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
 <!-- ########Live Validate ####### -->
<script type="text/javascript" src="/script/livevalidation_standalone.js"></script>
<script type="text/javascript" src="/script/simpleAjax.js"></script>
<!-- ######## Calendar ####### -->
<link rel="stylesheet" type="text/css" media="all" href="/script/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="/script/calendar/calendar.js"></script>
<script type="text/javascript" src="/script/calendar/lang/calendar-th.js"></script>
<script type="text/javascript" src="/script/calendar/calendar-setup.js"></script>
<!-- ######## Tab ####### -->
<link rel="stylesheet" href="/css/tab-view.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/ajax.js"></script>
<script type="text/javascript" src="/js/tab-view.js"></script>
<!-- ######## Tab2 ####### -->
<link rel="stylesheet" type="text/css" href="/css/tabcontent.css" />
<script type="text/javascript" src="/js/tabcontent.js"></script>
</head>
<body>


<TABLE bgcolor="white" width="100%" align="center">
<TR valign="center">
	<TD>
	     <a href="#" title="Zeng Code Code"><img src="<?=TEMPLATE?>/img/logo.gif" height="90px" width="250px"></a><BR>

	</TD>
	<TD align="left"><B>ZengCode.Com (The Thai Php Framework)</B>&nbsp;&nbsp;<BR><BR><BR>
	      <a href="/Module/Home/Action/Index">Home</a>&nbsp;&nbsp;
          <a href="/Module/Home/Action/Download">Download</a>&nbsp;&nbsp;
		  <a href="/Module/Home/Action/Manual">Manual</a>&nbsp;&nbsp;
          <a href="/Module/Home/Action/About">About us</a>&nbsp;&nbsp;
	</TD>
</TR>


<TR valign="center">
	<TD width="20%" bgcolor="#FFFFFF" valign="top">
	<BR><U><B><font color="#6600FF">MAIN MENU</font></B></U><hr>
	    <? View::LoadContent('Menu','LeftMenuStatic');?>    
		<? //View::LoadContent('Home','Calendar');?>  
	</TD>
	<TD align="left" valign="top">
	       <table align='left' width="100%" bgcolor="#FFFFCC">
			<tr align="left"><td>
            
			<? View::LoadActionContent(&$DATA); ?>
            
            </td></tr>
			</table>
	</TD>
</TR>

</TABLE>
      


      <!-- Navigation -->
     
      <!-- end/ Navigation -->





    



<!-- <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3259732-2");
pageTracker._trackPageview();
</script> -->
<BR>
<div align="center"><a href="http://www.amazingcounter.com" target="_blank"><img border="0" src="http://cb.amazingcounters.com/counter.php?i=2437945&c=7314148" alt="easy tracking"></a> <br><a href="http://www.4travelcoupons.com/avis-coupons.html" target="_blank">avis car rental discount code</a> </div>
<BR>

