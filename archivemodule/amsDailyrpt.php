<html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
</head>

<body>

<form method="POST" action="reports/amsDailyrpt.php">
	<div align="center">

<table width="40%" style="border-style:solid; border-width:1px; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" bgcolor="#F9F9F9" id="table8">
	<tr>
		<td colspan="2" class="tdtitle">Employees Report-Today&#39;s Attendees </td>
	</tr>
	<tr>
		<td width="98%"  colspan="2" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="89%" align="left" colspan="2" class="tdtitleemp">
		<?php //if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="37%" height="25" align="left" valign="top">
		Deapartment</td>
		<td width="61%" height="25" valign="top">
		<select size="1" name="section">
		<?php 
		mysql_query("SET NAMES 'utf8'");

		$rs_bank=mysql_query("select *from tb_section where id <>10 and id <> 8");
		$xbank=mysql_num_rows($rs_bank);
		for($i=0;$i<$xbank;$i++){
		?>
		<option value=<?php echo mysql_result($rs_bank,$i,'id');?>><?php echo mysql_result($rs_bank,$i,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="37%" height="25" align="left" valign="top">
		Date</td>
		<td width="61%" height="25" valign="top">
		<input type="text" size="21" name="begin_date" id="begin_date" readonly="1" value="<?php echo date("Y-m-d");?>" />
		<img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "begin_date", "%Y-%m-%d");
				//]]></script>	
		<!--a href="#" onClick='javascript:window.open("calendar.php?form=holiy&field=begin_date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="16" height="16"></a-->
		</b></font></td>
	</tr>
	<tr>
		<td colspan="2">
		<div align="center">
			<table border="1" width="6" id="table9" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="View" name="save" class="button"></td>
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