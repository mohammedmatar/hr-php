<?php 
///////////////////////////////////////////////////
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=4&page=main_menu.php");
}
//mysql_query("SET NAMES 'utf8'");

///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"])  && !empty($_POST["name"]) ){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into config_sub_menu (name,main,link,publish)values('$_POST[name]',$_POST[menu],'$_POST[link_php]',$_POST[publish])");
if($rs_save)
			$mess="The Data is Saved";
else
			$mess="The Data is Not Saved";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) ){
//mysql_query("SET NAMES 'utf8'");
if(!empty($_POST["name"]) && !empty($_POST["link_php"])){
$rs_save=mysql_query(" update config_sub_menu set 
				name='$_POST[name]',
				main=$_POST[menu],
				link='$_POST[link_php]',
				publish=$_POST[publish] 
where id=$_GET[id]

");
if($rs_save)
		$mess="Successful Edit";
else
		$mess="Edit Failure!";
}
else
$mess="pleace complete the data";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from config_sub_menu where id=$_GET[id] ");
if($rs_save)
		$mess="successful Delete";
else
		$mess="Delete Failure !";
}

$rs_data=mysql_query("select *from config_sub_menu ORDER BY id  DESC ");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from config_sub_menu where id=$_GET[id]");
}

?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>

<body>

<form method="POST" action="">

<div align="center">

<table border="0" width="37%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr">
	<tr>
		<td colspan="2" class="tdtitle"> <span lang="en-us">List Sittings</span></td>
	</tr>
	<tr>
		<td width="98%" align="left" colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="35%" align="left"><span lang="en-us"><font size="2"><b>
		Categorization</b></font></span></td>
		<td width="63%"><select size="1" name="menu" style="font-weight: 700">
		<option value="1">sittings</option>
		<option value="2">employee information</option>
		<option value="3">reports</option>
		<option value="4">list mangement</option></select></td>
	</tr>
	<tr>
		<td width="35%" height="25" align="left"><b><font size="2">List Name</font></b></td>
		<td width="63%" height="25">
		<input type="text" name="name" size="36" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>"></td>
	</tr>
	<tr>
		<td width="35%" align="left"><span lang="en-us">File Link</span></td>
		<td width="63%">
		<input type="text" name="link_php" size="36" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'link');?>"></td>
	</tr>
	<tr>
		<td width="35%" align="left"><span lang="en-us"><font size="2"><b>Status</b></font></span></td>
		<td width="63%">
		<select size="1" name="publish" style="font-weight: 700">
		<?php
if(!empty($_GET["id"]))		
 $pub=@mysql_result($rs_select,0,'publish');?>
		<option <?php if(empty($_GET["id"]))echo "selected";?>....</option>
		<option value="1" <?php if(@$pub==1)echo "selected";?>>hide</option>
		<option value="0" <?php if(@$pub==0)echo "selected";?>>view</option></select></td>
		

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
/*
    $link=mysql_connect("localhost","root","");
	$db=mysql_select_db("hr_db",$link);
	mysql_query("SET NAMES 'utf8'");
	*/
	$result = mysql_query("select count(*) as noOfrows from config_sub_menu");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 10;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from config_sub_menu order by id asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[3]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\" alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo ''.$table.'';
	echo $testPage->display_pages();
  ?>
</div>
<br>
</body>
</html>