<?php 
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
	if(!empty($_POST["bsalary"])){
	//mysql_query("SET NAMES 'utf8'");
	$rs_save=mysql_query("insert into   tb_salary (cat_id,exp,bsalary)values($_POST[cat_id],$_POST[exp],$_POST[bsalary])");
	if($rs_save)
	$mess="تم حفظ البيانات";
	
	else
	$mess="لم يتم حفظ البيانات";
	}
	else
	$mess="الرجاء إكمال البيانات";
}
///////////////////Command Edit///////////////////////////////

if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
	//mysql_query("SET NAMES 'utf8'");
	
	$rs_save=mysql_query(" update   tb_salary set 
					cat_id=$_POST[cat_id],
					exp=$_POST[exp],
					bsalary=$_POST[bsalary]
							where id=$_GET[id] ");
	if($rs_save)
	$mess="تم تعديـــل البيانات بنجاح";
	else
	$mess="لم يتم تعديل البيانات !";
}

/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
		$rs_save=mysql_query("delete from   tb_salary where id=$_GET[id] ");
		if($rs_save)
		$mess="تم حذف البيانات بنجاح";
		else
		$mess="لم يتم حذف البيانات !";
}
//mysql_query("SET NAMES 'utf8'");
if(empty($_GET["pagging"]))
	$_GET["pagging"]=0;

if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select *from   tb_salary where id=$_GET[id]");
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=salary_class.php ");
}
	$rs_data=mysql_query("select *from   tb_salary order by id asc  limit $_GET[pagging],$limit_lk");
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

<table border="1" width="41%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="rtl" class="tb_bgcolrform">
	<tr>
		<td colspan="2" class="tdtitle">سلم الرواتب</td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left">الفئة</td>
		<td width="66%" height="25">
		<select size="1" name="cat_id">
				<option value="0" <?php if ($cat_id==0)echo "selected";?> >-----</option>

		<?php 
		if(!empty($_GET["id"]) && empty($_POST["dept_id"])) $cat_id=@mysql_result($rs_select,0,'cat_id'); else  $cat_id=0;
	
		$rs_cat=mysql_query("select *from lk_cat");
		$xcat=mysql_num_rows($rs_cat);
		
		for($ii=0;$ii<$xcat;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_cat,$ii,'id');?>" <?php if(mysql_result($rs_cat,$ii,'id')==$cat_id) echo "selected"; ?> ><?php echo mysql_result($rs_cat,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><font size="2"><b>سنوات الخبرة</b></font></td>
		<td width="66%" height="25">
		<input type="text" name="exp" size="25" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'exp'); else echo "0";?>"></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><font size="2"><b>الراتب 
		الأساسي</b></font></td>
		<td width="66%" height="25">
		<input type="text" name="bsalary" size="25" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'bsalary'); else echo "0";?>"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td><input type="submit" value="إدخال جديد" name="new" class="button"></td>
					<td><input type="submit" value="حـــــفظ" name="save" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><input type="submit" value="حــــذف" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
	<p>&nbsp;</div>
</form>

<table border="1" width="50%" id="table2" style="border-collapse: collapse" dir="rtl">
	<tr>
		<td width="44" align="center" class="tdtitle">الرقم</td>
		<td align="center" class="tdtitle">الفئة</td>
		<td align="center" class="tdtitle" width="243">سنوات الخبرة</td>
		<td width="59" align="center"class="tdtitle">&nbsp;</td>
	</tr>
	<?php for($j=0;$j<$x;$j++){?>
	<tr>
		<td width="44" align="center"><font face="Tahoma" size="2"><?php echo mysql_result($rs_data,$j,'id');?></font></td>
		<td align="center"><font face="Tahoma" size="2">
		<?php 
		$rsone=mysql_result($rs_data,$j,'cat_id');
		$catid=mysql_query("select *from lk_cat where id=$rsone");
		echo mysql_result($catid,0,'name');
		?> </font></td>
		<td align="center" width="243"><?php echo mysql_result($rs_data,$j,'exp');?></td>
		<td width="59" align="center">
		<font face="Tahoma" size="2">
		<a href="index.php?mnu_id=2&page=salary_class.php&id=<?php echo mysql_result($rs_data,$j,'id');?>">
		<img border="0"  alt="إختيار" title="إختيار"  src="images/icon-32-edit.png" width="24" height="25"></a></font></td>
	</tr>
	<?php }?>
</table>
<br>
<div align="center">
	<table border="1" width="10%" id="table3" style="border-collapse: collapse" dir="rtl" height="10%">
	<?php 
	$rs=mysql_query("select *from  tb_salary");
	$x=mysql_num_rows($rs);
	$pagecount=$x/$limit_lk;
		?>
		<tr class="pagging">
		<?php for($j=0;$j<$pagecount;$j++)
	{?>
			<td <?php if(($_GET["pagging"]/$limit_lk)==$j) echo ("bgcolor=#999999") ; else echo ("bgcolor=#ffffff"); ?>><font face="Tahoma" size="2"><a href="index.php?mnu_id=2&page=salary_class.php&pagging=<?php echo $j*$limit_lk;?>"><?php echo $j+1;?></a></font></td>
			<?php }?>
		</tr>
	</table>
</div>

</body>

</html>