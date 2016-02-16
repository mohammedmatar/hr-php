<?php 
//mysql_query("SET NAMES 'utf8'");

if(!empty($_GET["mess"]))
	$mess=$_GET["mess"];
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
	if(!empty($_POST["name"])){
			$rs_save=mysql_query("insert into   tb_collaborator (name,date,sal,prog_id,sec_id,job_id,dis_salary,dateend,datefinsh,emp_number,add20,tch,tameenno,tameen_date)values('$_POST[name]','$_POST[date]',$_POST[sal],$_POST[prog],$_POST[sec_id],$_POST[job_id],$_POST[dis_salary],'$_POST[dateend]','$_POST[datefinsh]',$_POST[emp_number],$_POST[add20],$_POST[tch],$_POST[tameenno],'$_POST[tameen_date]')");
			if($rs_save){
				$mess="تم حفظ البيانات";
				$new_emp_id = mysql_query("SELECT LAST_INSERT_ID() as id");
				$lrow = mysql_fetch_row($new_emp_id);
				header("location: index.php?mnu_id=2&page=collaborator.php&mess=".$mess."&id=".$lrow[0]);
			}else
				$mess="لم يتم حفظ البيانات";
	}
	else
		$mess="الرجاء إكمال البيانات";
}

if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
	$rs_save=mysql_query(" update   tb_collaborator set 
		name='$_POST[name]',
		date='$_POST[date]',
		sal=$_POST[sal],
		prog_id=$_POST[prog] ,
		sec_id=$_POST[sec_id],
		job_id=$_POST[job_id],
		dis_salary=$_POST[dis_salary],
		dateend='$_POST[dateend]'	,
		datefinsh='$_POST[datefinsh]',
			emp_number=$_POST[emp_number],
			add20=$_POST[add20]	,
			tch=$_POST[tch],
			tameenno=$_POST[tameenno],
			tameen_date='$_POST[tameen_date]'	
			where id=$_GET[id] ");
	if($rs_save)
		$mess="تم تعديـــل البيانات بنجاح";
	else
		$mess="لم يتم تعديل البيانات !";
}

/////////////////////////Command Delete///////////////////
if($_GET["op"]=="Delete" && !empty($_GET["id"]) ){
	
	$rs_save=mysql_query("delete from   tb_collaborator where id=$_GET[id] ");
	if($rs_save){
		$mess="تم حذف البيانات بنجاح";
		header("location: index.php?mnu_id=2&page=collaborator.php&mess=".$mess);
	}else
		$mess="لم يتم حذف البيانات !";
}

if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select * from   tb_collaborator where id=$_GET[id]");
	
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=collaborator.php");
}
if(!empty($_POST["serching"])){
	header("location: index.php?mnu_id=2&page=collaborator_search.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language=javascript >
function deleteImage(x){
var conf = confirm("confirm deletion ?");
if(conf == true){
window.location = "index.php?mnu_id=2&op=Delete&page=collaborator.php&id="+x;
}
}

</script>
</head>
<body>
<form method="POST" action="" name="emp">
<div align="center">
	<table border="0" width="90%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="10" class="tdtitle">company collaborators </td>
	</tr>
	<tr>
		<td width="89%"  colspan="10" class="tdtitle">
		<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>
		</td>
	</tr>
	<tr>
		<td width="98%"  colspan="10" class="message">
		<?php echo $mess;?></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left" ><font size="2"><b> collaborator name</b></font></td>
		<td width="29%" height="25" colspan="3">
		<font size="2"><b>
		<input type="text" name="name" size="33" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>"></b></font></td>
		<td width="10%" height="25" colspan="2">
		<p align="left"><font size="2"><b>department</b></font></td>
		<td width="45%" height="25" colspan="4">
		<select size="1" name="sec_id">
		<?php 
		if(!empty($_GET["id"])) $sec_id=@mysql_result($rs_select,0,'sec_id');
		$rs_sec=mysql_query("select *from tb_section order by name asc");
		$xsec=mysql_num_rows($rs_sec);
		
		for($ii=0;$ii<$xsec;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_sec,$ii,'id');?>" <?php if(mysql_result($rs_sec,$ii,'id')==$sec_id) echo "selected";?> ><?php echo mysql_result($rs_sec,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="98%" height="25" colspan="10">
		<table border="0" width="100%" id="table4" style="border-collapse: collapse">
			<tr>
		<td width="16%" height="25" align="left"><font size="2"><b>البرنامج</b></font></td>
		<td width="20%" height="25">
		<select size="1" name="prog">
		<?php 
		if(!empty($_GET["id"])) $prog_id=@mysql_result($rs_select,0,'prog_id');
		$rs_dept=mysql_query("select *from lk_program order by name asc");
		$xdept=mysql_num_rows($rs_dept);
		
		for($ii=0;$ii<$xdept;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_dept,$ii,'id');?>" <?php if(mysql_result($rs_dept,$ii,'id')==$prog_id) echo "selected";?> ><?php echo mysql_result($rs_dept,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="10%" height="25">
		<font size="2"><b>job/function</b></font></td>
		<td width="12%" height="25">
		<select size="1" name="job_id">
		<?php 
		if(!empty($_GET["id"])) $job_id=@mysql_result($rs_select,0,'job_id');
		$rs_job=mysql_query("select *from lk_jop order by name asc");
		$xjob=mysql_num_rows($rs_job);
		
		for($ii=0;$ii<$xjob;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_job,$ii,'id');?>" <?php if(mysql_result($rs_job,$ii,'id')==$job_id) echo "selected";?> ><?php echo mysql_result($rs_job,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="13%" height="25" align="left"><b><font size="2">full 
		<span lang="en-us">payment</span></font></b></td>
		<td width="27%" height="25">
		<input type="text" name="sal" size="14" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'sal');?>"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td width="15%" height="25">
		<p align="left"><span lang="en-us"><font size="2"><b>hiring date</b></font></span></td>
		<td width="15%" height="25" colspan="2">
		<font size="2"><b>
		
		<input type="text" size="8" name="date" id="date" readonly="1" value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'date');else echo "0000-00-00"; ?>" />
		<img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "date", "%Y-%m-%d");
				//]]></script>
		</b></font></td>
		<td width="13%" height="25">
		<p align="left"><span lang="en-us"><font size="2"><b>contract 
		termination date</b></font></span></td>
		<td width="10%" height="25" colspan="2">
		<font size="2"><b>
		
		<input type="text" size="8" name="datefinsh" id="datefinsh" readonly="1" value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'datefinsh'); ?>" /></b></font></td>
		<td width="4%" height="25">
		<?php if(!empty($_GET["id"]) || $new_col==1)$dis=mysql_result($rs_select,0,'dis_salary'); ?>
		<font size="2"><b>
		
		<img id="fin_btn3"  src="images/calendar.jpg" /></b></font></td>
		<td width="19%" height="25" colspan="2">
		<p align="left"><span lang="en-us"><font size="2"><b>salary pause</b></font></span></td>
		<td width="22%" height="25">
		<font size="2"><b>
		
		&nbsp;
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("fin_btn3", "datefinsh", "%Y-%m-%d");
				//]]></script>
		</b></font>
		<select size="1" name="dis_salary" style="font-weight: 700">
		<option value="0" <?php if(!empty($_GET["id"]) && @$dis==0) echo "selected";?> >نعم</option>
		<option  value="1" <?php if(!empty($_GET["id"]) && @$dis==1) echo "selected"; elseif(empty($_GET["id"])) echo "selected";?>>لا</option>
		</select></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left">
		<b><font size="2">تاريخ الايقاف</font></b></td>
		<td width="13%" height="25" align="left">
		<font size="2"><b>
		
		<input size="8" name="dateend" id="dateend" readonly="1" value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'dateend'); else echo "0000-00-00";?>" style="float: right" />
		
		<img id="f_btn2"  src="images/calendar.jpg" align="right" />
		<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn2", "dateend", "%Y-%m-%d");
				//]]></script>
		</b></font></td>
		<td width="119" height="25" align="right" colspan="3">
		<p align="left">
		<b><font size="2">الرقم الوظيفي</font></b></td>
		<td width="24%" height="25" align="left" colspan="3">
		<font size="2"><b>
		
		<input size="8" name="emp_number" id="emp_number"   value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'emp_number');else echo "0"; ?>" style="float: right" onblur="checkUserName(this.value)"><span lang="en-us"><span id="usercheck" style="padding-left:10px; ; vertical-align: middle;"></span></b></font></td>
		<td width="8%" height="25" align="left"><b><font size="2">
		<span lang="en-us">additional</span> 20%</font></b></td>
		<td width="22%" height="25" align="left">
		<font size="2"><b>
		
		<input size="8" name="add20"   value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'add20');else echo "0"; ?>" style="float: right" /></b></font></td>
	</tr>
	<tr>
		<td width="15%" height="25" align="left">
		<span lang="en-us"><font size="2"><b>social insurance </b></font></span></td>
		<td width="13%" height="25" align="left">
		<p align="right"><b><font size="2">
		<select size="1" name="tch" style="font-weight: 700">
		<option value="1" <?php if(!empty($_GET["id"]) && @mysql_result($rs_select,0,'tch')==1) echo "selected";?> >نعم</option>
		<option  value="0" <?php if(!empty($_GET["id"]) && @mysql_result($rs_select,0,'tch')==0) echo "selected"; elseif(empty($_GET["id"])) echo "selected";?>>لا</option>
		</select></font></b></td>
		<td width="119" height="25" align="right" colspan="3">
		<p align="left" dir="ltr">
		<font size="2"><b>رقم التأمين الإجتماعي</b></font></td>
		<td width="24%" height="25" align="left" colspan="3">
		<input name="tameenno" size="10" AUTOCOMPLETE="Off"  class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'tameenno');else echo "0";?>" style="float: right"></td>
		<td width="8%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>insuring date</b></font></span></td>
		<td width="22%" height="25" align="left">
		<p align="right">
		<input type="text" size="8" name="tameen_date" id="tameen_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'tameen_date');?>" />
		<img id="f_btn3"  src="images/calendar.jpg" />	
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn3", "tameen_date", "%Y-%m-%d");
				//]]></script>		
		</td>
	</tr>
	<tr>
		<td width="98%" height="25" align="left" colspan="10">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="new" name="new" class="button"></td>
					<td>
					<input type="submit" value="save" name="save" class="button"></td>
					<td>
					<input type="submit" value="another employee" name="serching" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><!--input type="submit" value="حــــذف" name="delete" class="button"-->
					<input type="button" value="delete" class="button" name="<?php echo $_GET['id']; ?>" onClick="deleteImage(<?php echo $_GET['id']; ?>)"style="cursor:pointer;">
					</td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
   /*
	$result = mysql_query("select count(*) as noOfrows from tb_collaborator");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">الاسم</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from tb_collaborator order by name asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"إختيار\" title=\"إختيار\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table;
	echo $testPage->display_pages();
	*/
  ?>
</div>
</body>
</html>