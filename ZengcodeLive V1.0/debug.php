<?php
session_start();
header('Content-type: text/html; charset=utf-8');
/**
* Not allow direct access to this file.
*/
//if (!$_SERVER['HTTP_REFERER'] )
 //die("you can not access to this file");


require_once ("config/config.php");

/**
* Not allow direct access to this file from other site.
*/
$pos = strpos($_SERVER['HTTP_REFERER'], HOST_NAME);
if ($pos === false) {
    //die("you can not access to this file you came from other site");
}

$VAR_GET = unserialize($_SESSION['DEBUG_SESSION_VALUE']['SESSION']['VAR_GET']);


print("<pre>");
//print_r($_SESSION['DEBUG_SESSION_VALUE']['SESSION']['VAR_GET']);
print("</pre>");

?>
<CENTER><B>DEBUG</B></CENTER><BR>


<TABLE width="100%">

<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>SERVER INFORMATION</B></font>
		</TD>
    </TR>
	<TR width="100%" >
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		
           <TR>
			<TD width="30%" valign="top">DOCUMENT_ROOT</TD>
			<TD valign="top"><?=$_SERVER['DOCUMENT_ROOT']?></TD>
           </TR>

		    <TR>
			<TD width="30%" valign="top">HTTP_ACCEPT_CHARSET</TD>
			<TD valign="top"><?=$_SERVER['HTTP_ACCEPT_CHARSET']?></TD>
           </TR>
           
           <TR>
			<TD width="30%" valign="top">SERVER_SIGNATURE</TD>
			<TD valign="top"><?=$_SERVER['SERVER_SIGNATURE']?></TD>
           </TR>
		   
		
		 </TABLE>
		</TD>
    </TR>
    </TABLE>



	</TD>
</TR>




<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>LASTED POST DATA</B></font>
		</TD>
    </TR>
	<TR width="100%" >
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		<? 
		foreach($_SESSION['VAR_POST'] as $key => $value){   
		?>		
           
           <TR>
			<TD width="30%" valign="top"><?=$key?></TD>
			<TD valign="top"><?=$value?></TD>
           </TR>
           
		 <?}?>
		 </TABLE>
		</TD>
    </TR>
    </TABLE>



	</TD>
</TR>




<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>GET DATA</B></font> 
		</TD>
    </TR>
	<TR width="100%">
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		<? 
		foreach($VAR_GET as $key => $value){   			
		?>		
           
           <TR>
			<TD width="30%" valign="top"><?=$key?></TD>
			<TD valign="top"><?=$value?></TD>
           </TR>
           
		 <?}?>
		 </TABLE>
		</TD>
    </TR>
    </TABLE>



	</TD>
</TR>
<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>SESSION DATA</B></font>
		</TD>
    </TR>
	<TR width="100%">
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		<? 
		foreach($_SESSION['DEBUG_SESSION_VALUE']['SESSION'] as $key => $value){   
			if ($key == 'DEBUG_VALUE') continue;
            if ($key == 'VAR_GET') continue;
			
		?>		
           
           <TR>
			<TD width="30%" valign="top"><?=$key?></TD>
			<TD valign="top"><?=$value?></TD>
           </TR>
           
		 <?}?>
		 </TABLE>
		</TD>
    </TR>
    </TABLE>


	</TD>
</TR>


<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>LAYOUT & VIEW</B></font>
		</TD>
    </TR>
	<TR width="100%">
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		
           <TR>
			<TD width="30%" valign="top">Layout Name</TD>
			<TD valign="top"><?=$_SESSION['DEBUG_VALUE']['LAYOUT']; ?></TD>
           </TR>

		   <TR>
			<TD width="30%" valign="top">View Name</TD>
			<TD valign="top"><?=$_SESSION['DEBUG_VALUE']['VIEW'] ?></TD>
           </TR>

		   <TR>
			<TD width="30%" valign="top">Layout & View Location</TD>
			<TD valign="top"><? echo "application".TEMPLATE."/".'view/'.$_SESSION['DEBUG_VALUE']['FOLDER']."/".$_SESSION['DEBUG_VALUE']['VIEW'].".php"; ?></TD>
           </TR>
           
	
		 </TABLE>
		</TD>
    </TR>
    </TABLE>


	</TD>
</TR>


<TR>
	<TD>


      <TABLE width="100%" align="left" bgcolor="#CCCC99">
    <TR width="100%">
		<TD align="left">
		   <font color="red"><B>DATABASE CONFIGURATION</B></font>
		</TD>
    </TR>
	<TR width="100%">
		<TD align="left" valign="top">		
		<TABLE width="100%">
		   <TR>
			<TD width="30%" valign="top"><U><B><I>Valiable</I></B></U></TD>
			<TD valign="top"><U><B><I>Value</I></B></U></TD>
           </TR>
		
           <TR>
			<TD width="30%" valign="top">DATABASE HOST</TD>
			<TD valign="top"><?=$GLOBALS['DATABASE']['DATABASE_HOST']?></TD>
           </TR>

		   <TR>
			<TD width="30%" valign="top">DATABASE TYPE</TD>
			<TD valign="top"><?=$GLOBALS['DATABASE']['DATABASE_TYPE']?></TD>
           </TR>

		   <TR>
			<TD width="30%" valign="top">DATABASE NAME</TD>
			<TD valign="top"><?=$GLOBALS['DATABASE']['DATABASE_NAME']?></TD>
           </TR>

		   <TR>
			<TD width="30%" valign="top">DATABASE USER</TD>
			<TD valign="top"><?=$GLOBALS['DATABASE']['USER']?></TD>
           </TR>
           
		   <TR>
			<TD width="30%" valign="top">DATABASE PASSWORD</TD>
			<TD valign="top"><?=$GLOBALS['DATABASE']['PASSWORD'] ?></TD>
           </TR>
	
		 </TABLE>
		</TD>
    </TR>
    </TABLE>


	</TD>
</TR>


</TABLE>




<?php
         unset($_SESSION['DEBUG_SESSION_VALUE']['SESSION']);
         unset($_SESSION['DEBUG_SESSION_VALUE']);
	     unset($_SESSION['VAR_GET']);
		 unset($_SESSION['VAR_POST']);
?>