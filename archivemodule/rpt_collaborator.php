<html dir="rtl">

<head>

	<script language="javascript" >
	function url_all(){
	if(document.form1.D1.value=='1')
	{
	document.form1.action='reports/rpt_collaborator_show_all.php';
	}
	else
	if(document.form1.D1.value=='2'){
	document.form1.action='reports/rpt_collaborator_show.php';
	
	}
	document.form1.submit() ;
	
	}
	function des_section(){
	if(document.form1.D1.value=='1')
	{
document.getElementById("sec_id").disabled = true	;
	}
else
{
document.getElementById("sec_id").disabled = false	;
}
	}
	</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
</head>

<body onload="des_section()">

<form method="POST"  name="form1" >
	<div align="center">

<table width="40%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" bgcolor="#F9F9F9" id="table5">
	<tr>
		<td colspan="4" class="tdtitle">Collaborators Salaries Report</td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="89%" align="left" colspan="4" class="tdtitleemp">
		<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left" valign="top">
		Report Type</td>
		<td width="25%" height="25" valign="top">
		<p align="right">
		<select size="1" name="D1" onchange="des_section();">
		<option value="2" selected>per department</option>
		<option value="1">All department</option>
		</select></td>
		<td width="14%" height="25" align="left" valign="top">
		<font size="2">department</font></td>
		<td width="36%" height="25" valign="top">
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
	</tr>
	<tr>
		<td width="14%" height="25" align="left" valign="top">
		<font size="2">Month</font></td>
		<td width="25%" height="25" valign="top">
		<select size="1" name="month"><?php $m_month=date("m");?>
		<option value="01" <?php if($m_month=='01')echo "selected";?>>Jan</option>
		<option value="02" <?php if($m_month=='02')echo "selected";?>>Feb</option>
		<option value="03" <?php if($m_month=='03')echo "selected";?>>Mar</option>
		<option value="04" <?php if($m_month=='04')echo "selected";?>>Apr</option>
		<option value="05" <?php if($m_month=='05')echo "selected";?>>May</option>
		<option value="06" <?php if($m_month=='06')echo "selected";?>>Jun</option>
		<option value="07" <?php if($m_month=='07')echo "selected";?>>July</option>
		<option value="08" <?php if($m_month=='08')echo "selected";?>>Aug</option>
		<option value="09" <?php if($m_month=='09')echo "selected";?>>Sept</option>
		<option value="10" <?php if($m_month=='10')echo "selected";?>>Oct</option>
		<option value="11" <?php if($m_month=='11')echo "selected";?>>Nov</option>
		<option value="12" <?php if($m_month=='12')echo "selected";?>>Dec</option>
		</select></td>
		<td width="14%" height="25" align="left" valign="top">
		year</td>
		<td width="36%" height="25" valign="top">
		<select size="1" name="year">
		<?php for($ii=2010;$ii<2020 ;$ii++){?>
		<option value="<?php echo $ii;?>" <?php if($ii==date("Y")) echo "selected";?>><?php echo $ii;?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="6" id="table7" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="button" value="View" name="save" class="button" onclick ="url_all()"></td>
					<!--td>
					<input type="submit" value="cancel " name="cancel" class="button"></td-->
				</tr>
			</table></div></td>
	</tr>
</table>
	</div>
	<p>&nbsp;</p>
</form>

</body>

</html>