<html dir="rtl">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
</head>

<body>

<form method="POST" action="reports/rpt_collaboratorovertime_show.php" >
	<div align="center">

<table width="40%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" bgcolor="#F9F9F9" id="table5">
	<tr>
		<td colspan="4" class="tdtitle"><span lang="ar-sa">إعداد كشف الأجر 
		الإضافي</span> <span lang="ar-sa">للمتعاونين</span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="89%" align="left" colspan="4" class="tdtitleemp">
		<?php //if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="37%" height="25" align="left" valign="top">
		department<span lang="ar-sa"> </span></td>
		<td width="61%" height="25" valign="top" colspan="3">
		<select size="1" name="section">
		<?php 
		mysql_query("SET NAMES 'utf8'");

		$rs_bank=mysql_query("select *from tb_section  /*where id <>10 and id <> 8*/");
		$xbank=mysql_num_rows($rs_bank);
		for($i=0;$i<$xbank;$i++){
		?>
		<option value=<?php echo mysql_result($rs_bank,$i,'id');?>><?php echo mysql_result($rs_bank,$i,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="37%" height="25" align="left" valign="top">
		<font size="2">months</font></td>
		<td width="17%" height="25" valign="top">
		<select size="1" name="month"><?php $m_month=date("m");?>
	<option value="01" <?php if($m_month=='01')echo "selected";?>>Jan</option>
		<option value="02" <?php if($m_month=='02')echo "selected";?>>Feb</option>
		<option value="03" <?php if($m_month=='03')echo "selected";?>>Mar</option>
		<option value="04" <?php if($m_month=='04')echo "selected";?>>Apr</option>
		<option value="05" <?php if($m_month=='05')echo "selected";?>>May</option>
		<option value="06" <?php if($m_month=='06')echo "selected";?>>Jun</option>
		<option value="07" <?php if($m_month=='07')echo "selected";?>>July</option>
		<option value="08" <?php if($m_month=='08')echo "selected";?>>Aug</option>
		<option value="09" <?php if($m_month=='09')echo "selected";?>>Sep</option>
		<option value="10" <?php if($m_month=='10')echo "selected";?>>Oct</option>
		<option value="11" <?php if($m_month=='11')echo "selected";?>>Nov</option>
		<option value="12" <?php if($m_month=='12')echo "selected";?>>Dec</option>
		</select></td>
		<td width="10%" height="25" align="left" valign="top">
		year</td>
		<td width="34%" height="25" valign="top">
		<select size="1" name="year">
		<?php for($ii=2010;$ii<2020 ;$ii++){?>
		<option value="<?php echo $ii;?>" <?php if($ii==date("Y")) echo "selected";?>><?php echo $ii;?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="6" id="table7" style="border-collapse: collapse; border: 1px solid #666633" dir="ltr">
				<tr>
					<td>
					<input type="submit" value="view extra payment " name="save" class="button"></td>
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