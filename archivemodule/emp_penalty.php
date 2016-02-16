<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
if(!empty($_POST["san_date"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into   tb_emp_sanctions(emp_id,san_id,sanitem_id,san_date)
values($_GET[emp_id],$_POST[san_id],$_POST[sanitem_id],'$_POST[san_date]')");
if($rs_save)
			$mess="The Data is Saved";
else
			$mess="The Data is Not Saved";
}
else
		$mess="Please Complete The Data";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["san_date"]) ){
//mysql_query("SET NAMES 'utf8'");

$rs_save=mysql_query(" update   tb_emp_sanctions set 
				
				emp_id=$_GET[emp_id],
				san_id=$_POST[san_id],
				sanitem_id=$_POST[sanitem_id],
				san_date='$_POST[san_date]'				
	where id=$_GET[id] ");
	
if($rs_save)
		$mess="Successful Edit";
else
		$mess="Edit Failure!";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from   tb_emp_sanctions  where id=$_GET[id] ");
if($rs_save)
		$mess="successful Delete";
else
		$mess="Delete Failure !";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

$rs_data=mysql_query("select *from   tb_emp_sanctions  where emp_id=$_GET[emp_id] order by id desc  limit $_GET[pagging],$limit_lk");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from   tb_emp_sanctions where id=$_GET[id]");
}
/////////////////////Select Emplyoeee/////////////////////

$rs_emp=mysql_query("select *from tb_employee where id=$_GET[emp_id]");
$_SESSION["emp_id"]=mysql_result($rs_emp,0,'id');
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=2&page=emp_penalty.php&emp_id=$_SESSION[emp_id]");
}
if(!empty($_POST["serching"])){
header("location: index.php?mnu_id=2&page=emp_search_penalty.php");
}
if(!empty($_POST["san_id"]) && empty($_GET["id"]))
{
$sanid=$_POST["san_id"];
}
if(empty($_POST["san_id"]) && !empty($_GET["id"]))
{
$sanid=mysql_result($rs_select,0,'san_id');
}
if(!empty($_POST["san_id"]) && !empty($_GET["id"]))
{
$sanid=$_POST["san_id"];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language=javascript >
function myload(){
<?php
while(list($key,$val)=each($_POST)){
	echo" document.penalty.".$key.".value='$val';\n";
}
?>
}

</script>

</head>

<body onload="myload()">

<form method="POST" action="" name="penalty">
<div align="center">
<table width="80%" style="border-style:solid; border-width:1px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" class="tb_bgcolrform">
	<!--tr>
		<td colspan="4" class="tdtitle">الجزاءات</td>
	</tr-->
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">
		<?php if(!empty($_GET["emp_id"])) echo @mysql_result($rs_emp,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message"><?php echo @$mess;?></td>
	</tr>

<form method="POST" action="" name="">
<tr>
		<td width="12%" height="25" align="left"><font size="2"><b>subject</b></font></td>
		<td width="29%" height="25">
			
		<select size="1" name="san_id" onchange="this.form.submit()">
		<option value="0">-------</option>
		<?php 
		if(!empty($_GET["id"]) && empty($POST["san_id"])) $san_id=@mysql_result($rs_select,0,'san_id');
		$rs_san=mysql_query("select *from lk_sanctions  order by name asc");
		$xsan=mysql_num_rows($rs_san);
		
		for($ii=0;$ii<$xsan;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_san,$ii,'id');?>" <?php if(mysql_result($rs_san,$ii,'id')==$san_id) echo "selected";?> ><?php echo mysql_result($rs_san,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>	
	<tr>
		<td width="9%" height="25" align="left">
		<b><font size="2" >item</font></b></td>
		<td width="46%" height="25">
		<?php// echo "select *from tb_sanctionsitem where sanctions_id=$sanid";?>
		<select size="1" name="sanitem_id">
		<?php 
		if(!empty($_GET["id"]) && empty($_POST["san_id"])) $sanitemid=@mysql_result($rs_select,0,'sanitem_id');
		$rs_sanitem=mysql_query("select *from tb_sanctionsitem where sanctions_id=".$sanid."  ");
		$xsanitem=mysql_num_rows($rs_sanitem);
		
		for($ii1=0;$ii1<$xsanitem;$ii1++){
		?>
		<option value="<?php echo mysql_result($rs_sanitem,$ii1,'id');?>" <?php if(mysql_result($rs_sanitem,$ii1,'id')==$sanitemid) echo "selected";?> ><?php echo mysql_result($rs_sanitem,$ii1,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="12%" height="25" align="left"><font size="2"><b>date</b></font></td>
		<td width="84%" height="25" colspan="3">
		<font size="2"><b>
		
		<input type="text" size="8" name="san_date" id="san_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'san_date'); ?>" />
		<img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "san_date", "%Y-%m-%d");
				//]]></script>	
		</b></font></td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633" dir="ltr">
				<tr>
					<td height="31">
					<input type="submit" value="new" name="new" class="button"></td>
					<td height="31">
					<input type="submit" value="save" name="save" class="button"></td>
					<td height="31">
					<input type="submit" value="serching" name="serching" class="button"></td>
					<td height="31">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td height="31">
					<input type="submit" value="delete" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
    /*$link=mysql_connect("localhost","root","");
	$db=mysql_select_db("hr_db",$link);
	mysql_query("SET NAMES 'utf8'");*/
	$result = mysql_query("select count(*) as noOfrows from  tb_emp_sanctions where emp_id=$_GET[emp_id]");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"70%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">المادة</td><td  align=\"center\" class=\"tdtitle\">البند</td><td  align=\"center\" class=\"tdtitle\">date</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tb_emp_sanctions.id,lk_sanctions.name,tb_sanctionsitem.name,san_date from  tb_emp_sanctions left join lk_sanctions on(tb_emp_sanctions.san_id=lk_sanctions.id) left join tb_sanctionsitem on(tb_emp_sanctions.sanitem_id=tb_sanctionsitem.id) where (tb_emp_sanctions.emp_id=$_GET[emp_id]) order by tb_emp_sanctions.id desc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[3]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+emp_id+pagination_page')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>
</html>