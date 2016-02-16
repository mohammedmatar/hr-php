<?php 
    /*$link=mysql_connect("localhost","root","");
	$db=mysql_select_db("hr_db",$link);
	mysql_query("SET NAMES 'utf8'");*/
	$result = mysql_query("select count(*) as noOfrows from tb_employee where des_salary <>1");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 10;
	$testPage->paginate(); 
	if(isset($_REQUEST['name']))
		$rs_data=mysql_query("select * from   tb_employee  where des_salary =0 and name  like '%$_REQUEST[name]%' order by name asc  $testPage->limit");
	else
		$rs_data=mysql_query("select * from   tb_employee  where des_salary <>1 order by name asc   $testPage->limit");
	$x=mysql_num_rows($rs_data);
	
	if(!empty($_POST["new_emp"])){
			$_SESSION['emp_name'] = 'basic information archive';
		header("location: index.php?mnu_id=5&page=employee.php ");
	}
?>
<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="autoComplete/themes/base/jquery.ui.all.css">
	<script src="autoComplete/jquery-1.4.4.js"></script>
	<script src="autoComplete/ui/jquery.ui.core.js"></script>
	<script src="autoComplete/ui/jquery.ui.widget.js"></script>
	<script src="autoComplete/ui/jquery.ui.position.js"></script>
	<script src="autoComplete/ui/jquery.ui.autocomplete.js"></script>
<script>
	$(function() {
		var availableTags = [
			<?php echo $namesArray;?>
		];
		$( "#name" ).autocomplete({
			source: availableTags
		});
	});
	</script>
</head>
<body>

<form method="POST" action="">

<div align="center">

<table border="0" width="45%"  dir="ltr" class="tb_bgcolrform">
	<tr>
		<td class="tdtitle"><span lang="en-us">search by name</span></td>
		<td class="tdtitle"><input name="name" id="name" dir="rtl" size="30" AUTOCOMPLETE="OFF"   class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>" style="float: left" />
		<?php //echo textAuto('name','tb_employee','name','',''); ?>
		</td>
		<td class="tdtitle">
		<input type="submit" value="search" name="search" class="button" /></td>
		<td class="tdtitle">	<font color="#FFFFFF">
		<b>
		&nbsp;</b></font></td>
	</tr>
</table>
</div>
</form>

<div align="center">
<table border="1" width="90%" id="table2" style="border-collapse: collapse" dir="ltr">
	<tr>
		<td width="44" align="center" class="tdtitle">#</td>
		<td align="center" class="tdtitle"><span lang="en-us">name</span></td>
		<!--td width="97" align="center"class="tdtitle">النوع </td-->
		<td width="80" align="center"class="tdtitle"><span lang="en-us">job id</span></td>
		<td width="107" align="center"class="tdtitle"><span lang="en-us">work 
		center</span></td>
		<td width="100" align="center"class="tdtitle"><span lang="en-us">phone</span></td>
		<td width="250" align="center"class="tdtitle"><span lang="en-us">address</span></td>
		<td width="42" align="center"class="tdtitle">&nbsp;</td>
	</tr>
	<?php 
	$counter=$pagging;
	for($j=0;$j<$x;$j++){
		$counter=$counter+1;
		if($counter%2 == 0)
			$rowclass = 'even';
		else
			$rowclass = 'odd';
	?>

	<tr class="<?php echo $rowclass; ?>">
		<td width="44" align="center"><font face="Tahoma" size="2"><?php echo $counter;?></font></td>
		<td align="center"><font face="Tahoma" size="2"><?php echo mysql_result($rs_data,$j,'name');?></font></td>
		<!--td width="97" align="center">
		<span lang="en-us"><?php //if(mysql_result($rs_data,$j,'sex')==1)echo "ذكر"; if(mysql_result($rs_data,$j,'sex')==2)echo "انثى";?></span></td-->
		<td width="80" align="center">
		<?php echo mysql_result($rs_data,$j,'emp_number');?></td>
		<td width="107" align="center">
		<?php 
		$work_id=mysql_result($rs_data,$j,'work_id');
		$rs_work=mysql_query("select *from lk_work where id=$work_id");
		echo @mysql_result($rs_work,0,'name');
		?></td>
		<td width="100" align="center">
		<?php echo mysql_result($rs_data,$j,'phone1');?></td>
		<td width="250" align="center">
		<?php echo mysql_result($rs_data,$j,'fulladdress');?></td>
		<td width="42" align="center">
		<font face="Tahoma" size="2">
		<a href="index.php?mnu_id=5&page=employee.php&id=<?php echo mysql_result($rs_data,$j,'id');?>">
		<img border="0"  alt="select" title="select"  src="images/icon-32-edit.jpg" width="24" height="25" alt="select" title="select"></a></font></td>
	</tr>
	<?php 
	}
	
	?>
</table>
</div>

<div align="center">
<?php
echo $testPage->display_jump_menu().'      ';
echo $testPage->display_pages();
?>
</div>
<br>
</body>

</html>