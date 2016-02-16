<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
if(!empty($_POST["name"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into   tb_sanctionsitem (sanctions_id,name,discount,discount_day)values($_POST[sanctions],'$_POST[name]',$_POST[discount],$_POST[discount_day])");
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

$rs_save=mysql_query(" update  tb_sanctionsitem set
				    sanctions_id=$_POST[sanctions],
					name='$_POST[name]',
					discount=$_POST[discount],
					discount_day=$_POST[discount_day]		
													where id=$_GET[id] ");
if($rs_save)
$mess="successful edit";
else
$mess="edit failed !";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
$rs_save=mysql_query("delete from   tb_sanctionsitem where id=$_GET[id] ");
if($rs_save)
$mess="successful delete";
else
$mess="delete failed !";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

$rs_data=mysql_query("select *from   tb_sanctionsitem order by id limit $_GET[pagging],$limit_tb");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
$rs_select=mysql_query("select *from   tb_sanctionsitem where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
header("location: index.php?mnu_id=1&page=sanctions_item.php ");
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

<table border="0" width="80%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr"  class="tb_bgcolrform">
	<tr>
		<td colspan="4" class="tdtitle"><span lang="en-us">Sanctions List - Items</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="19%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>chapter</b></font></span></td>
		<td width="34%" height="25">
		<select size="1" name="sanctions">
		<?php 
		if(!empty($_GET["id"])) $sanction_id=@mysql_result($rs_select,0,'sanctions_id');
		$rs_sanction=mysql_query("select *from lk_sanctions");
		$xsanction=mysql_num_rows($rs_sanction);
		
		for($ii=0;$ii<$xsanction;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_sanction,$ii,'id');?>" <?php if(mysql_result($rs_sanction,$ii,'id')==$sanction_id) echo "selected";?> ><?php echo mysql_result($rs_sanction,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>	
		<td width="20%" height="25" align="left">
		<span lang="en-us"><font size="2"><b>item</b></font></span></td>
		<td width="29%" height="25">
		<input type="text" name="name" size="68" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>"></td>
	</tr>
	<tr>
		<td width="19%" height="23" align="left"><span lang="en-us">
		<font size="2"><b>procedure</b></font></span></td>
		<td width="34%" height="23">
		<select size="1" name="discount">
		<option value="1" <?php if(mysql_result($rs_select,0,'discount')==1) echo "selected";?>>discount from salary</option>
		<option value="0"  <?php if(mysql_result($rs_select,0,'discount')==0) echo "selected";?>>no discount</option>
		</select></td>
	</tr>
	<tr>	
		<td width="20%" height="27" align="left">
		<span lang="en-us"><font size="2"><b>number of discounted days</b></font></span></td>
		<td width="29%" height="27">
		<input type="text" name="discount_day" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET[id])) echo @mysql_result($rs_select,0,'discount_day');?>"></td>
	</tr>
	<tr>
	 <td></td>
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

	$result = mysql_query("select count(*) as noOfrows from tb_sanctionsitem");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"95%\" style=\"border-collapse: collapse\" dir=\"ltr\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td align=\"center\" class=\"tdtitle\">chapter</td><td  align=\"center\" class=\"tdtitle\">item</td></td><td align=\"center\" class=\"tdtitle\">procedure</td><td align=\"center\" class=\"tdtitle\">discount days</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tb_sanctionsitem.id,lk_sanctions.name as sanctions,tb_sanctionsitem.name as sanctionsitem,discount,discount_day from tb_sanctionsitem,lk_sanctions where tb_sanctionsitem.sanctions_id = lk_sanctions.id order by tb_sanctionsitem.id asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		if($row[3]==0)
			$egraa = 'no discount';
		else 
			$egraa = 'discount from salary';
		
		$table .="<tr><td align=\"center\" width=\"40\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$egraa."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[4]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+pagination_page')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\" src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_jump_menu().'    ';
	echo $testPage->display_pages().'<br /><br />';
  ?>
</div>
</body>
</html>