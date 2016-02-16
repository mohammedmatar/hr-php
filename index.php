<?php 
ob_start();
session_start();
///////////////////////////////////////////
include("config.php");
include("my_fun.php");
include('module/paginator.php');
if(isset($_SESSION["login"])){
include("module/g_var.php");
if(empty($_GET["page"]) )			
header("location: index.php?mnu_id=$_GET[mnu_id]&page=hr.php");
mysql_query("SET NAMES 'utf8'");
$rs_title=mysql_query("select *from config_sub_menu where link='".$_GET["page"]."'");
$title=@mysql_result($rs_title,0,'name');
if($_GET["mnu_id"] !=5)
		$quer ="select name from tb_employee WHERE des_salary <>0 order by name asc";
else
		$quer ="select name from tb_employee WHERE des_salary =0 order by name asc";
		$names = mysql_query($quer);
		$namesArray = '';
		$flage = 0;
		while ($row = mysql_fetch_row($names)) {
		     $flage = 1;
			$namesArray .= '"'.$row[0].'",';
		}
		if($flage==1){
			$namesArray = substr($namesArray,0,strlen($namesArray)-1);
		}

		


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-sa"-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-sa">
<link href="favicon.ico" rel="shortcut icon"/>

<script type="text/javascript" src="js/Calinder/js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/Calinder/js/jscal2.js"></script>
<script type="text/javascript" src="js/Calinder/js/lang/en.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/Calinder/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="css/Calinder/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="css/Calinder/css/steel/steel.css" />
<link rel="stylesheet" type="text/css" href="css/AutoStyle.css" />
<link rel="stylesheet" type="text/css" href="css/temp.css" />
<link rel="stylesheet" type="text/css" href="css/style_pagination.css" />
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script-->

<script type="text/javascript">
<!-- http://www.itechroom.com-->
function checkUserName(usercheck)
{
	$('#usercheck').html('<img src="images/ajax-loader.gif" />');
	$.post("checkuser.php", {emp_number: usercheck} , function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {				   
				  $('#usercheck').html(data);	
			   }
          });
}
</script>


<title>HR system-LEAD TECNOLOGY</title>
</head>
<body>
	<div align="center">
	<table border="0" width="100%" id="table1" dir="ltr">
		<tr>
			<td colspan="2"s><?php include("header.php"); ?></td>
		</tr>
		<tr>
			<td bgcolor="#244893" width="31%" align="center">
			<span lang="en-us">
			<font size="4" color="#FFFFFF" face="Times New Roman"><b>HR System 
			Leadtech</b></font></span></td>
			<td bgcolor="#244893" width="68%"><?php include("tab.php");?></td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#FFFFCC"><b><font size="5"></font></b></td>
			<td valign="top" bgcolor="#FFFFCC"><b><font size="5"><?php echo @$title;?></font></b></td>
		</tr>
		</div>
		<table border="0" width="100%" dir="rtl">
			<tr>
			<?php if($_GET["page"]!="hr.php" ){ ?>
			<!--td width="105" align="left" valign="top"><img border="0" src="images/shiaar.png" width="192" height="309"></td-->
			<?php }?>
			<td valign="top" align="center" height="500" ><span lang="en-us"  >
			<?php	if(!empty($_GET["page"]) && $_GET["mnu_id"]!=5 )	@include("module/$_GET[page]");	?>
			<?php //if(!empty($_GET["page"]) && $_GET["mnu_id"]==5 )	@include("archivemodule/$_GET[page]");	?>
			</span></td>
			<td valign="top" width="222" class="mazin" dir="ltr">	<?php 
			if($_SESSION["per"]==2){
			include("custom_code/alert.php");	
						$alert = new alert();  
						if($_REQUEST["mnu_id"]==2)
							echo $alert->display();
						}
						include("left_menu.php");
						?>	</td>
			</tr>
		</table>
		<!--tr>
			<td colspan="2" valign="top"></td>
		</tr-->
		<tr>
			<td colspan="2" ><hr size="1" color="#999999"><?php include("footer.php");?></td>
		</tr>
	</table>


</body>

</html>
<?php
} 
else
header("location: Splashtastic/index.html");
?><?php ob_flush();?>