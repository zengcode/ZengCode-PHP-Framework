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
	<TD align="center">
	      <font size='4' color='#FF9933'><B>ZengCode Framework (Thai Php Framwork) <BR>WWW.ZengCode.COM</B></font>
	</TD>
</TR>


<TR valign="center">
	<TD width="20%" bgcolor="#FFFFFF" valign="top">
	  <BR><U><B><font color="#6600FF">Administrator Mennu</font></B></U><hr>
	  <BR><a href="/admin/Module/Category/Action/ListAll">Categorys</a><BR>
	  <BR><a href="/admin/Module/SContent/Action/ListAll">Static Contents</a><BR>
	  <BR><a href="/admin/Module/Content/Action/ListAll">Contents</a><BR>
	  <BR><a href="/admin/Module/Login/Action/LogOut">Logout</a>
	</TD>
	<TD align="left" valign="top">
	       <table align='left' width="100%" bgcolor="#FFFFCC">
			<tr><td>
            <div class="content" >
			<? View::LoadActionContent(&$DATA); ?>
            </div>
            </td></tr>
			</table>
	</TD>
</TR>

</TABLE>
      


      <!-- Navigation -->
     
      <!-- end/ Navigation -->





    




