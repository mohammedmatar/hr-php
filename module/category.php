<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
if(!empty($_POST["name"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into   lk_cat (name)values('$_POST[name]')");
if($rs_save){
$mess="data saved";
}
else
$mess="data not saved";
}
else
$mess="some fields are not filled ";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
//mysql_query("SET NAMES 'utf8'");

$rs_save=mysql_query(" update   lk_cat set 
				name='$_POST[name]'		where id=$_GET[id] ");
if($rs_save)
$mess="successful update";
else
$mess="update failed !";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from   lk_cat where id=$_GET[id] ");
if($rs_save)
$mess="deletion complete";
else
		$mess="deletion failed!";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from   lk_cat where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=1&page=category.php ");
}
$rs_data=mysql_query("select *from   lk_cat order by id asc  limit $_GET[pagging],$limit_lk");
$x=mysql_num_rows($rs_data);
$pub="3";

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

<table border="0" width="40%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="2" class="tdtitle"><span lang="en-us">Categories</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left"><span lang="en-us">Category 
		name</span></td>
		<td width="85%" height="25">
		<input type="text" name="name" size="40" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td height="31">
					<input type="submit" value="new" name="new" class="button"></td>
					<td height="31">
					<input type="submit" value="save" name="save" class="button"></td>
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
	$result = mysql_query("select count(*) as noOfrows from lk_cat");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"ltr\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from lk_cat order by id asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\" width=\"40\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+pagination_page')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>
</html>