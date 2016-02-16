<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
if(!empty($_POST["name"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into   tb_section (dept_id,name)values($_POST[dept],'$_POST[name]')");
if($rs_save)
$mess="the data is saved";
else
$mess="the data is not saved";
}
else
$mess="please complete the data";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
//mysql_query("SET NAMES 'utf8'");

$rs_save=mysql_query(" update   tb_section set 
				dept_id=$_POST[dept],
				name='$_POST[name]'		where id=$_GET[id] ");
if($rs_save)
$mess="successful edit";
else
$mess="edit failed !";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from   tb_section where id=$_GET[id] ");
if($rs_save)
$mess="successful delete";
else
$mess="delete failed !";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

$rs_data=mysql_query("select *from   tb_section order by id desc  limit $_GET[pagging],$limit_lk");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from   tb_section where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=1&page=section.php ");
}

?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language=javascript >
function myload(){
<?php
while(list($key,$val)=each($_POST)){
	echo" document.section.".$key.".value='$val';\n";
}
?>
}

</script>

<title></title>
</head>

<body onload=myload()>

<form method="POST" action="" name=section>

<div align="center">

<table border="0" width="40%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="2" class="tdtitle"><span lang="en-us">Departments</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>department</b></font></span></td>
		<td width="85%" height="25">
		<select size="1" name="dept" >
		<option value=0 >--</option>
		<?php 
		if(!empty($_GET["id"])) $dept_id=@mysql_result($rs_select,0,'dept_id');
		$rs_dept=mysql_query("select *from lk_depart");
		$xdept=mysql_num_rows($rs_dept);
		
		for($ii=0;$ii<$xdept;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_dept,$ii,'id');?>" <?php if(mysql_result($rs_dept,$ii,'id')==$dept_id) echo "selected";?> ><?php echo mysql_result($rs_dept,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<!--tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>main department</b></font></span></td>
		<td width="66%" height="25">
		<font size="2"><b>
		
		<!--select size="1" name="sec">
		<?php 
		if(!empty($_GET["id"])) $sec_id=@mysql_result($rs_select,0,'sec_id');
		
		$rs_sec=mysql_query("select *from tb_section_main where dept_id=$_POST[dept]");
		$xsec=mysql_num_rows($rs_sec);
		
		for($ii1=0;$ii1<$xsec;$ii1++){
		?>
		<option value="<?php echo mysql_result($rs_sec,$ii1,'id');?>" <?php if(mysql_result($rs_sec,$ii1,'id')==$sec_id) echo "selected";?> ><?php echo mysql_result($rs_sec,$ii1,'name');?></option>
		<?php }?>
		</select></b></font></td>
	</tr-->
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>branch department name</b></font></span></td>
		<td width="66%" height="25">
		<input type="text" name="name" size="40" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="new" name="new" class="button"></td>
					<td>
					<input type="submit" value="save" name="save" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
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
	$result = mysql_query("select count(*) as noOfrows from tb_section order by dept_id");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"ltr\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Department</td></td><td align=\"center\" class=\"tdtitle\">Section</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("SELECT tb_section.id, tb_section.name, lk_depart.name FROM tb_section,lk_depart where tb_section.dept_id = lk_depart.id  ORDER BY tb_section.id ASC $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\" width=\"40\">".$row[0]."</td><td align=\"center\" width=\"40\">".$row[2]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+pagination_page')."&id=".$row[0]."\"><img border=\"0\"  alt=\"إختيار\" title=\"إختيار\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>
</html>