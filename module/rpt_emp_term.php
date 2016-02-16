<html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" type="text/javascript">
function updateD(){
	var emp_id = document.getElementById('emp_id');
	window.location = "./index.php?mnu_id=2&page=termination.php&emp_id="+emp_id.value+"&updFiled=1";
	/*form1.action= str;
	form1.submmit();*/
 
}
</script>
<title>End of Term Report</title>
</head>

<body>

<form id="form1" method="POST" action="reports/rpt_emp_term.php" >
	<div align="center">

<table width="40%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" bgcolor="#F9F9F9" id="table5">
	<tr>
		<td colspan="4" class="tdtitle">dues owned for end of term</td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left" valign="top">
		<font size="2">employee</font></td>
		<td width="25%" height="25" valign="top">
		<select size="1" name="emp_id" id="emp_id">
		<?php 
		if(!empty($_GET["id"])) $work_id=@mysql_result($rs_select,0,'work_id');
		$rs_work=mysql_query("select tb_employee.id as id,tb_employee.name as name from tb_employee inner join tb_term on(tb_employee.id=tb_term.emp_id) order by tb_term.date desc");
		$xwork=mysql_num_rows($rs_work);
		
		for($ii=0;$ii<$xwork;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_work,$ii,'id');?>"><?php echo mysql_result($rs_work,$ii,'name');?></option>
		<?php }?>
		</select>
		</td>
	</tr>
	<tr>
		<td width="14%" height="25" valign="top">
		extra payment months</td>
		<td width="36%" height="25" valign="top">	
		<input type="text" name="monthes" id="monthes" size="35">
	</tr>
	<tr>
		<td width="14%" height="25" align="left" valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td width="36%" height="25" valign="top">	
		use "+" sign between months</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="calcLastMonthSalary" id="calcLastMonthSalary" value="1"></td>
		<td width="14%" height="25" valign="top">include last months salary 
		anyway</td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="6" id="table7" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="view report" name="save" class="button"></td>
					<td>
					<input type="button" value="update" name="upddata" class="button" onClick="updateD()"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
	</div>
	<p>&nbsp;</p>
</form>

</body>

</html>