<html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
</head>

<body>

<form method="POST" action="reports/rpt_insuranceforbox.php">
	<div align="center">

<table width="40%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" bgcolor="#F9F9F9" id="table5">
	<tr>
		<td colspan="4" class="tdtitle"><span lang="ar-sa">إعداد كشف التأمين 
		الإجتماعي</span></td>
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
		<span lang="ar-sa"><font size="2">الشهر</font></span></td>
		<td width="25%" height="25" valign="top">
		<select size="1" name="month"><?php $m_month=date("m");?>
		<option value="01" <?php if($m_month=='01')echo "selected";?>>يناير</option>
		<option value="02" <?php if($m_month=='02')echo "selected";?>>فبراير</option>
		<option value="03" <?php if($m_month=='03')echo "selected";?>>مارس</option>
		<option value="04" <?php if($m_month=='04')echo "selected";?>>ابريـــل</option>
		<option value="05" <?php if($m_month=='05')echo "selected";?>>مايو</option>
		<option value="06" <?php if($m_month=='06')echo "selected";?>>يونيو</option>
		<option value="07" <?php if($m_month=='07')echo "selected";?>>يوليو</option>
		<option value="08" <?php if($m_month=='08')echo "selected";?>>اغسطس</option>
		<option value="09" <?php if($m_month=='09')echo "selected";?>>سبتمبر</option>
		<option value="10" <?php if($m_month=='10')echo "selected";?>>اكتوبر</option>
		<option value="11" <?php if($m_month=='11')echo "selected";?>>نوفمبر</option>
		<option value="12" <?php if($m_month=='12')echo "selected";?>>ديسمبر</option>
		</select></td>
		<td width="14%" height="25" align="left" valign="top">
		<span lang="ar-sa">العام</span></td>
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
					<input type="submit" value="كشف التأمين" name="save" class="button"></td>
					<!--td>
					<input type="submit" value="إلغاء " name="cancel" class="button"></td-->
				</tr>
			</table></div></td>
	</tr>
</table>
	</div>
	<p>&nbsp;</p>
</form>

</body>

</html>