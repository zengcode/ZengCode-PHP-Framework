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

    <!-- Layout -->
    <div id="layout">
      
      <!-- Header -->
      <div id="header">
        
        <h1 id="logo"><a href="#" title="Zeng Code Code"><img src="<?=TEMPLATE?>/img/logo.gif" height="90px" width="250px"></a><!-- width="170px" height="70px" --></h1>
        <!-- <span id="slogan">ZengCode Framework is the Thai PHP Framework.</span> -->
        <hr class="noscreen" />  
        
        <!-- Quick hidden nav -->
        <p class="noscreen noprint">
          <em>Rychlá navigace: <a href="#obsah">obsah</a>, <a href="#nav">navigace</a>.</em>
        </p>
        
        <!-- Quick nav -->
        <div id="quicknav">
          <a href="/Module/Home/Action/Index">Home</a>
          <a href="/Module/Home/Action/Contact">Contact</a>
          <a href="index.php">Sitemap</a>
        </div>
        
        <!-- Search -->
        <div id="search">
          <form action="" method="post">
            <input type="text" id="phrase" name="phrase" value="ZengCode" onfocus="if(this.value=='search phrase')this.value='';" />
            <input type="submit" id="submit" value="SEARCH" />
          </form>
        </div>
        
      </div>
      <!-- end/ Header -->
      
      <hr class="noscreen" />
   
	  


      <!-- Navigation -->
      <div id="nav" class="box">
        <ul>
          <li ><a href="/Module/Home/Action/Index">Home</a></li> <!-- Active link -->
          <li><a href="/Module/Home/Action/Download">Download</a></li>
		  <li><a href="/Module/Home/Action/Manual">Manual</a></li>
          <li><a href="/Module/Home/Action/About">About us</a></li>
		  <li><a href="/Module/Home/Action/Contact">Contacts</a></li>
		</ul>
       <hr class="noscreen" />
      </div> 
      <!-- end/ Navigation -->






        
      <div id="container" class="box">
      
            <table align='left' width="100%" bgcolor="#FFFFCC">
			<tr><td>
            <div class="content" >
			<? View::LoadActionContent(&$DATA); xxxx?>
            </div>
            </td></tr>
			</table>
        
        <!-- Right sidebox -->
        <!--  <div id="panel-right" class="box panel">
          <div id="bottom">
          <div class="in">
          <div class="clear"></div>
          <br />
          
          <strong class="">ZengCode Tutorial</strong>
          <ul>
            <li><a href="#">Framework Overview</a></li>
            <li><a href="#">Downlad</a></li>
            <li><a href="#">Hello World Example</a></li>
            <li><a href="#">Documentation</a></li>
          </ul>
          
          <strong class="">Last 10 Blogs</strong>
          <ul>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
          </ul>
          
          </div>
          </div>
        </div>  -->
        <!-- end/ Right sidebox -->
      
      </div>
       
    </div>
    <!-- end/ Layout -->
    <div id="footer">
      <div id="foot">
        <div id="page-bottom">
         <a href="#header">Go up</a>
        </div>
        <p class="f-left">&copy; 2008 &ndash; <a href="http://www.zengcode.com">ZengCode</a></p>
        <p class="f-right"><a href="http://www.tvorimestranky.cz" id="webdesign">Webdesign</a>: <a href="http://www.tvorimestranky.cz">TvorimeStranky.cz</a> | Sponsored by: <a href="http://www.topas-tachlovice.cz/topas-tachlovice.aspx" title="Občanské sdružení Topas Tachlovice">Tachlovice</a></p>
      </div>
    </div>
    
  </body>
</html>


<? View::LoadContent('Menu','LeftMenu');?>


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

<!-- #!/bin/sh
DATE=`date +%Y%m%d_%H_%M_%S`
RSYNC=/usr/bin/rsync
SSH=/usr/bin/ssh
KEY=/home/webmaster/.ssh/id_rsa
RUSER=tiger
RHOST=192.168.98.104
PATH=/www/www.aeon.co.th/
LPATH=/var/www/www.aeon.co.th_test_error/


$RSYNC -azqv  --exclude=**/admincenter -e "$SSH -i $KEY" $RUSER@$RHOST:$RPATH $LPATH >> /var/log/rsync/rsync.log_$DATE

#$RSYNC -azq --log file=/var/log/rsync/rsync-log.log  --exclude=**/admincenter -e "$SSH -i $KEY" $RUSER@$RHOST:$RPATH $LPATH -->



