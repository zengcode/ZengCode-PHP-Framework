<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  <head>
	<style type="text/css">
	body{
		margin:10px;
		font-size:0.9em;
	}
	a{
		color:#F00;
	}
	</style>
<title>ZengCode Zeng Code Code</title>
<link href="<?=TEMPLATE?>/css/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/consolidated_common.css" />
<!-- ########Live Validate ####### -->
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/consolidated_common.css" />
<link rel="stylesheet" type="text/css" href="/template/<?=$GLOBALS['TEMPLATE']?>/css/common.css" />
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

    <!-- Layout -->
    <div id="layout">
      
      <!-- Header -->
      <div id="header">
        
        <h1 id="logo"><!-- <a href="#" title="Zeng Code Code"><img src="<?=TEMPLATE?>/img/logo.bmp" width="170px" height="70px"></a> --></h1>
        <span id="slogan">Administrator Control Panel</span>
        <hr class="noscreen" />  
        
        <!-- Quick hidden nav -->
        <p class="noscreen noprint">
          <em>Rychlá navigace: <a href="#obsah">obsah</a>, <a href="#nav">navigace</a>.</em>
        </p>
        
        <!-- Quick nav -->
        <div id="quicknav">
          <a href="#">Home</a>
          <a href="#">Contact</a>
          <a href="#">Sitemap</a>
        </div>
        
        <!-- Search -->
        <div id="search">
         <!--  <form action="" method="post">
            <input type="text" id="phrase" name="phrase" value="ZengCode" onfocus="if(this.value=='search phrase')this.value='';" />
            <input type="submit" id="submit" value="SEARCH" />
          </form> -->
        </div>
        
      </div>
      <!-- end/ Header -->
     <div id="admin_menu">
	 <B>Menu : </B>&nbsp;&nbsp;
	 <a href="/admin/Module/Category/Action/ListAll">Categorys</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	 <a href="/admin/Module/SContent/Action/ListAll">Static Contents</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	 <a href="/admin/Module/Content/Action/ListAll">Contents</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	  <a href="/admin/Module/Login/Action/LogOut">Logout</a>&nbsp;&nbsp;
	 </div>
      <hr class="noscreen" />
   
	  


      <!-- Navigation -->
      <div id="nav" class="box">
       
       <hr class="noscreen" />
      </div> 
      <!-- end/ Navigation -->






        
      <div id="container" class="box">
      

            <div class="content2" >
                 <? View::LoadActionContent(&$DATA); ?>
                <div class="clear"></div>  
            </div>

       
      
      </div>
       
    </div>
    <!-- end/ Layout -->
    <div id="footer">
      <div id="foot">
        <p class="f-left">&copy; 2008 &ndash; <a href="http://www.zengcode.com">ZengCode</a></p>
        <p class="f-right"><a href="http://www.tvorimestranky.cz" id="webdesign">Webdesign</a>: <a href="http://www.tvorimestranky.cz">TvorimeStranky.cz</a> | Sponsored by: <a href="http://www.topas-tachlovice.cz/topas-tachlovice.aspx" title="Občanské sdružení Topas Tachlovice">Tachlovice</a></p>
      </div>
    </div>
    
  </body>
</html>
