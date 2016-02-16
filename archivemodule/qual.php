<?php 
//mysql_query("SET NAMES 'utf8'");
//------------------Command Save---------------------	
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
	if(!empty($_POST["name"])){
		$rs_save=mysql_query("insert into   lk_qual (name)values('$_POST[name]')");
		if($rs_save){
			$mess="The Data is Saved";
		}else
			$mess="The Data is Not Saved";
	}else
		$mess="please complete the data ";
	}
//------------------Comand Update---------------------	
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
	$rs_save=mysql_query("update lk_qual set name='$_POST[name]' where id=$_GET[id]");
	if($rs_save)
		$mess="Successful Edit";
	else
		$mess="Edit Failure!";
}
//------------------Command Delete---------------------	
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from   lk_qual where id=$_GET[id] ");
	if($rs_save)
		$mess="successful Delete";
	else
		$mess="Delete Failure !";
}

if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select *from lk_qual where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=1&page=qual.php ");
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

<table border="0" width="40%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="2" class="tdtitle"><span lang="en-us">Qualification</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left">Q<span lang="en-us"><font size="2"><b>qualify</b></font></span></td>
		<td width="85%" height="25">
		<input type="text" name="name" size="40" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name'); else if(!empty($_POST["name"])) echo $_POST["name"];?>"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633" dir="ltr">
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
	$result = mysql_query("select count(*) as noOfrows from lk_qual");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from lk_qual order by id asc $testPage->limit");
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