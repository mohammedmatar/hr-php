<html dir="rtl">

<head>

	<script language="javascript" >
	
	function des_section(){
	if(document.form1.D1.value=='1')
	{
document.getElementById("sec_id").disabled = true	;
document.getElementById("job").disabled = true	;

	}
else
if (document.form1.D1.value=='2')
{
document.getElementById("sec_id").disabled =  false	;
document.getElementById("job").disabled = true	;

}
else
if (document.form1.D1.value=='3')
{
document.getElementById("sec_id").disabled = true	;
document.getElementById("job").disabled = false 	;

}

	}
	</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
</head>

<body onload="des_section()">

<form method="POST"  name="form1" action="reports/rpt_Ganaral.php" >
	<div align="center">

<table width="90%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" bgcolor="#F9F9F9" id="table5">
	<tr>
		<td colspan="6" class="tdtitle"><span lang="ar-sa">General Report</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="6" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="89%" align="left" colspan="6" class="tdtitleemp">
		<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="31%" height="25" align="center" valign="top">
		<font size="2">Report Options</font></td>
		<td width="13%" height="25" valign="top" align="center">
		<p align="right">
		<select size="1" name="D1" onchange="des_section();">
		<option value="1">All</option>
		<option value="2">Department Only</option>
		<option value="3">Job Only</option>
		</select></td>
		<td width="3%" height="25" align="center" valign="top">
		<font size="2">Department</font></td>
		<td width="11%" height="25" valign="top" align="center">
		<p align="right">
		<select size="1" name="sec_id"  id="sec_id">
		<?php
		mysql_query("SET NAMES 'utf8'"); 
		$rs_sec=mysql_query("select *from tb_section");
		$xsec=mysql_num_rows($rs_sec);
		
		for($ii=0;$ii<$xsec;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_sec,$ii,'id');?>" <?php if(mysql_result($rs_sec,$ii,'id')==$sec_id) echo "selected";?> ><?php echo mysql_result($rs_sec,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="9%" height="25" valign="top" align="center">
		Job</td>
		<td width="30%" height="25" valign="top" align="center">
		<p align="right">
		<select size="1" name="job"  id="job">
		<?php
		mysql_query("SET NAMES 'utf8'"); 
		$rs_job=mysql_query("select *from lk_jop");
		$xjob=mysql_num_rows($rs_job);
		
		for($i=0;$i<$xjob;$i++){
		?>
		<option value="<?php echo mysql_result($rs_job,$i,'id');?>"   ><?php echo mysql_result($rs_job,$i,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="89%" height="25" align="left" valign="top" colspan="6">
		<div align="center">
			<table border="1" width="100%" id="table8" bgcolor="#FFFFFF" style="border-collapse: collapse" dir="ltr">
				<tr>
					<td align="center" colspan="10" bgcolor="#FFFFCC">
					<p align="left"><b>Basic Information</b></td>
				</tr>
				<tr>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Number</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Gender</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Birthdate</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Address</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Phone (1)</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Phone (2)</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Insurance Number</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Insurance Date</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Social Status</font></b></td>
					<td align="center" width="50"><b>
					<font face="Simplified Arabic" size="2">Children</font></b></td>
				</tr>
				<tr>
					<td width="50" align="center">
					<input type="checkbox" name="emp_id" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="sex" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="bdate" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="address" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="phone1" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="phone2" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="tameen_no" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="tameen_date" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="status" value="ON"></td>
					<td align="center" width="50">
					<input type="checkbox" name="chield" value="ON"></td>
				</tr>
				<tr>
					<td align="center" colspan="10" bgcolor="#FFFFCC">
					<p align="left"><b>Job Information</b></td>
				</tr>
				<tr>
					<td colspan="10">
					<table border="1" width="100%" id="table9" style="border-collapse: collapse" dir="ltr">
						<tr>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Work Center</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Exchange Center</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Account Number</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Hiring Date 
						 </font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Work Starting Date 
							</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Department</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Job</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Category </font>
							</b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2"> Practical Experience
							</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Experience within the Company 
							</font></b></td>
							<td align="center"><b>
							<font face="Simplified Arabic" size="2">Annual Vacation Balance 
						</font></b></td>
						</tr>
						<tr>
							<td align="center">
							<input type="checkbox" name="work" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="bank" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="acc" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="begindate" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="comedate" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="section" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="job1" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="class" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="expout" value="ON"></td>
							<td align="center">
							<input type="checkbox" name="expin" value="ON"></td>
							<td align="center">
							<b><font face="Simplified Arabic" size="2">
							<input type="checkbox" name="holy" value="ON"></font></b></td>
						</tr>
						<tr>
							<td colspan="11">&nbsp;</td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="10">
					<div align="center">
						<table border="0" width="60%" id="table10" bgcolor="#FFFFCC">
							<tr>
								<td align="center" width="6%" bgcolor="#FFFFFF"><b>
								<font face="Simplified Arabic">
								End of Contract</font></b></td>
							</tr>
							<tr>
								<td align="center" width="6%">
								<font color="#FFFFFF">
								<input type="checkbox" name="end" value="ON"></font></td>
							</tr>
						</table>
					</div>
					</td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="6">
		<div align="center">
			<table border="1" width="6" id="table7" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="View" name="save" class="button" ></td>
					<!--td>
					<input type="submit" value="Cancel " name="cancel" class="button"></td-->
				</tr>
			</table></div></td>
	</tr>
</table>
	</div>
	<p>&nbsp;</p>
</form>

</body>

</html>