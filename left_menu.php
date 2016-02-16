<?php 
mysql_query("SET NAMES 'utf8'");

$rs_menu=mysql_query("select *from config_sub_menu where main=$_GET[mnu_id] and publish=1 order by id asc");
@$menu_count=mysql_num_rows($rs_menu);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-sa">
</head>

<table width="100%" style="border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; border-left-style:solid; border-left-width:1px; border-bottom-style:solid">
	<tr>
		<td align="center" class="tdtitle">
		<font size="4">
		<?php 
			if($_GET["mnu_id"]==1)
				echo "Settings Menu";
			elseif($_GET["mnu_id"]==2)
				echo "Main menu";
			elseif($_GET["mnu_id"]==3)
				echo "Reports Menu";
			elseif($_GET["mnu_id"]==4)
				echo "Lists Mangment";
				elseif($_GET["mnu_id"]==5)
				echo "Employees Archive";
				elseif($_GET["mnu_id"]==6)
				echo "Statistical Reports";
		?>
</font>
</td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	
	<?php if($_GET["mnu_id"]==4)
	{
		echo ("<a href=index.php?mnu_id=4&page=main_menu.php>Elements Input<a/>");
		//$menu_count=0;
	}
	?>
	</td></tr>
<?php 
if ($_GET["mnu_id"]==3)
include("rpt_menu.php");
else
{
for($i=0;$i<$menu_count;$i++){?>
<tr class="menu_link"><td style="padding-right:2px" align="center" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=<?php echo  mysql_result($rs_menu,$i,'link')?>">
<?php echo mysql_result($rs_menu,$i,'name');?>

<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<?php }
}
?>
</table>
