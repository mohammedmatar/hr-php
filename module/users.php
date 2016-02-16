<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
if(!empty($_POST["name"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into  tbl_user (name,pass,per)values('$_POST[name]',md5('$_POST[pass]'),$_POST[per])");
if($rs_save){
$mess="the data is saved";
print_r($_POST["save"]);
$_POST["save"]="";
echo "<br>".$_POST["save"];
}
else
$mess="the data is not saved";
}
else
$mess="please complete the data";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
//mysql_query("SET NAMES 'utf8'");

$rs_save=mysql_query(" update  tbl_user set 
				name='$_POST[name]',	
				pass=md5('$_POST[pass]'),
				per=$_POST[per]	
	where id=$_GET[id] ");
if($rs_save)
$mess="successful edit";
else
$mess="edit failed !";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from  tbl_user where id=$_GET[id] ");
if($rs_save)
$mess="successful delete";
else
$mess="delete failed !";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

$rs_data=mysql_query("select *from  tbl_user order by id desc  limit $_GET[pagging],$limit_lk");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from  tbl_user where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=4&page=users.php ");
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

<table border="0" width="41%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="2" class="tdtitle"><span lang="en-us">Users</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>user name</b></font></span></td>
		<td width="66%" height="25">
		<b><font size="2">
		<input type="text" name="name" size="25" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');  else echo "";?>"></font></b></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>password</b></font></span></td>
		<td width="66%" height="25">
		<input type="password" name="pass" size="25" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'pass');?>"></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>authorization</b></font></span></td>
		<td width="66%" height="25">
		<font size="2"><b><select size="1" name="per">
	<?php if(!empty($_GET["id"])) $tper=@mysql_result($rs_select,0,'per');?>

		<option value="1" <?php if ( $tper==1) echo "selected";?>>manager</option>
		<option value="2" <?php if ( $tper==2) echo "selected";?>>admin</option>
		<!--option value="3" <?php if ( $tper==3) echo "selected";?>>user</option-->
		</select></b></font></td>
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
			</table>
			</div>
		</td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
   
	$result = mysql_query("select count(*) as noOfrows from tbl_user");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td><td align=\"center\" class=\"tdtitle\">Authority</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("SELECT * FROM tbl_user order by name asc $testPage->limit");
	$dper = '';
	while($row = mysql_fetch_row($result)){
		$per =$row[3];
			switch ($per) {
				case 1:
					$dper= 'admin';
					break;
				case 2:
					$dper= 'manager';
					break;
				case 3:
					$dper= 'user';
					break;
			}
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$dper."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\" alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br>'.$table.'<br>';
	echo $testPage->display_pages();
  ?>
</div>

</body>

</html>