<?php 
//mysql_query("SET NAMES 'utf8'");

$rs_emp=mysql_query("select *from tb_employee where id=$_GET[id]");
$emp_id=mysql_result($rs_emp,0,'id');
$rs_allow=mysql_query("select *from tb_tax where id=$_GET[id] ");
if($rs_allow)
$xallow=mysql_num_rows($rs_allow);

///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && !empty($_GET["id"]) && $xallow <= 0 ){
if(!empty($_GET["id"])){

$rs_save=mysql_query("insert into tb_tax (id,tax,charity)
values($_GET[id],$_POST[tax],$_POST[charity])");
if($rs_save)
$mess="Saved";

else
$mess="Not Saved";
}
else
$mess="Please Compelete the Data";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && $xallow >0   ){
 
$rs_save=mysql_query(" update  tb_tax set 
				tax=$_POST[tax],
				charity=$_POST[charity]				

		where id=$_GET[id] ");
if($rs_save)
$mess="Successful Update";
else
$mess="Update Failed !";
}
/////////////////////////////////////////////////////////////
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

if(!empty($_GET["id"])){
$rs_select=mysql_query("select *from  tb_tax where id=$_GET[id]");
if($rs_select)
$xsel=mysql_num_rows($rs_select);
if($xsel <= 0)
$rs_select=mysql_query("select *from  tb_employee where id=$_GET[id]");
}
//////////////////Command search////////////////////////////////
if(!empty($_POST["search"])){
header("location: index.php?mnu_id=2&page=emp_search.php ");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title></title>
<script language=javascript >
function myload(){
<?php
while(list($key,$val)=each($_POST)){
	echo" document.emp.".$key.".value='$val';\n";
}
?>
}

</script>
</head>

<body onload="myload()">

<form method="POST" action="">
<div>
<?php if( !empty($_GET["id"]) || isset($_SESSION['emp_id']))
	@include("menu.php");
?></div>
<div align="center">

<table width="80%" style="border-style:solid; border-width:1px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" class="tb_bgcolrform">
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">الضريبة - الجمعية الخيرية</td>
	</tr>
	<tr>
		<td colspan="4" class="tdtitleemp"><?php if(!empty($_GET["id"])) echo $_SESSION['emp_name'];?></td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="20%" height="25" align="left" valign="top"><font size="2"><b>الضريبة</b></font></td>
		<td width="30%" height="25" valign="top">
		<input type="text" name="tax" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"]) &&  @mysql_result($rs_select,0,'tax')!="") echo @mysql_result($rs_select,0,'tax'); else echo "0";?>"></td>
		<td width="20%" height="24" align="left" valign="top"><b>الجمعية</b></td>
		<td width="30%" height="24" valign="top">
		<select size="1" name="charity">
		<?php if(!empty($_GET["id"])) $tcharity= @mysql_result($rs_select,0,'charity'); ?>

		<option value="0" <?php if($tcharity==0) echo "selected";?>>0</option>
		<option value="30" <?php if($tcharity==30) echo "selected";?>>30</option>
		<option value="20" <?php if($tcharity==20) echo "selected";?>>20</option>
		</select></td>
	</tr>
	<tr>
		<td colspan="4">
		&nbsp;</td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
    /*$link=mysql_connect("localhost","root","");
	$db=mysql_select_db("hr_db",$link);
	mysql_query("SET NAMES 'utf8'");*/
	$result = mysql_query("select count(*) as noOfrows from tb_employee");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">الاسم</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from tb_employee order by name asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\" alt=\"إختيار\" title=\"إختيار\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	//echo '<br />'.$table;
	//echo $testPage->display_pages();
  ?>
</div>
</body>
</html>