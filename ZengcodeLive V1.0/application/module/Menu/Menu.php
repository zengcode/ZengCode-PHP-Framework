<?php
/***********************************************
August 18,2008
Chiwa Kantawong
Application Engineer Supervisor
Strategic Solution (System Integration)
Fujitsu Systems Business (Thailand) Ltd. 
Email : chiwa@th.fujitsu.com
/***********************************************/

Class Menu extends CmsDataModel
{
	public function Category_Admin()
	{
		parent::CmsDataModel();
	}
    public function LeftMenu()
	{

      $data = $this->database->Select("*")->From('category')->Sort("weight ASC")->QueryCache('category');
	  $data = $data['record'];
	?>
	<STYLE TYPE="text/css">
	<!--

	.menuh	{
			BORDER-COLOR : #FFFF99 ;
			cursor : hand ;
			Border-Left : #FFFF99 ;
			Border-Top : #FFFF99 ;
			Padding-Left : 1px ;
			Padding-Top : 1px ;
			Background-Color : #FFFF99 ;
		}
	.menu	{
			Background-Color : white ;
		}
	.home	{
			cursor : hand ;
		}

	.menulinks{
	text-decoration:none;
	}
	//-->
	</STYLE>
	<SCRIPT Language="Javascript1.2">
<!--

/*
Static menu script (By maXimus, maximus@nsimail.com, http://maximus.ravecore.com/)
Modified slightly/ permission granted to Dynamic Drive to feature script in archive
For full source, usage terms, and 100's more DHTML scripts, visit http://dynamicdrive.com
*/

//configure below variable for menu width, position on page
var menuwidth=190
var offsetleft=0
var offsettop=125

var ns4=document.layers?1:0
var ie4=document.all?1:0
var ns6=document.getElementById&&!document.all?1:0

function makeStatic() {
if (ie4) {object1.style.pixelTop=document.body.scrollTop+offsettop}
else if (ns6) {document.getElementById("object1").style.top=window.pageYOffset+offsettop}
else if (ns4) {eval(document.object1.top=eval(window.pageYOffset+offsettop));}
setTimeout("makeStatic()",0);
}

if (ie4||ns6) {document.write('<span ALIGN="CENTER" ID="object1" STYLE="Position:absolute; Top:20; Left:'+offsetleft+'; Z-Index:5;cursor:hand;background-color:#FFFFCC;"><TABLE BORDER="1" width="'+menuwidth+'" CELLPADDING="0" CELLSPACING="0" BORDERCOLOR="black" bgcolor="white">')}
else if (ns4){ document.write('<LAYER top="20" name="object1" left="'+offsetleft+'" BGCOLOR=black><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="1"><TR><TD><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="'+menuwidth+'">')}

if (ie4||ns6||ns4)
document.write('<TR><TD BGCOLOR="#FEEA63" BORDERCOLORDARK="#99CCFF" BORDERCOLORLIGHT="#003399"><P ALIGN=CENTER><FONT SIZE="4" FACE=ARIAL>บทความต่าง ๆ</FONT></TD></TR>')

var menui = new Array();
var menul = new Array();

//configure below for menu items. Extend list as desired


<?php foreach($data as $key => $value) { ?>
menui[<?=$key;?>]="<?=$value['category_name'];?>";
menul[<?=$key?>]="/Module/Content/Action/ListContentByCategory/category_id/<?=$value['category_id']?>";
<?php }?>

for (i=0;i<=menui.length-1;i++)
if (ie4||ns6) {document.write('<TR><TD BORDERCOLOR="white" ONCLICK="location=\''+menul[i]+'\'" onmouseover="className=\'menuh\'" onMouseout="className=\'menu\'"><FONT>'+menui[i]+'</FONT></TD></TR>')}
else if (ns4){document.write('<TR><TD BGCOLOR="white"><ILAYER><LAYER width="'+menuwidth+'" onmouseover="bgColor=\'yellow\'" onmouseout="bgColor=\'white\'"><A HREF="'+menul[i]+'" class=menulinks>'+menui[i]+'</A></LAYER></ILAYER></TD></TR>')}

if (ie4||ns6) {document.write('</TABLE></span>')}
else if (ns4){document.write('</TABLE></TD></TR></TABLE></LAYER>')}

function menu3(){
if (ns6||ie4||ns4)
makeStatic()
}

window.onload=menu3

//-->
</SCRIPT>

	<?
	}


public function LeftMenuStatic()
{

      $data = $this->database->Select("*")->From('category')->Sort("weight ASC")->QueryCache('category');
	  $data = $data['record'];
	  //print("<pre>");print_r($data);print("</pre>");
	  //echo count($data);
	  foreach($data as $key => $value) { 
      echo "<B><a href='/Module/Content/Action/ListContentByCategory/category_id/".
		    $value['category_id']."'>".$value['category_name']."</a></B><BR>";
    }

}



}///end class

?>