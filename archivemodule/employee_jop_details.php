<?php 

//mysql_query("SET NAMES 'utf8'");
$note = trim($_POST["note"]);
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && !empty($_GET["id"])){
	$rs_save=mysql_query(" update   tb_employee set 
			come_date  ='$_POST[come_date]'  ,
			begin_date ='$_POST[begin_date]',
			end_date ='$_POST[end_date]',
			test_end_date ='$_POST[test_end_date]',
			dept_id=    $_POST[dept_id],
			section_id=    $_POST[section_id] ,
			job_id=    $_POST[job_id],
			cat_id =    $_POST[cat_id],
			exp_out= $_POST[exp_out],
			exp_in=$_POST[exp_in],
			con_test_months=$_POST[con_test_months],
			dayofmonth=$_POST[dayofmonth],
			note='$note'
				
		where id=$_GET[id] ");
		if($rs_save){
			$mess="The Data is Saved";
		}else
			$mess="The Data is Not Saved";
	}
/////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from   tb_employee where id=$_GET[id] ");
	if($rs_save){
		$mess="Successful Edit";
		unset($_SESSION['emp_id']);
	}else
		$mess="Edit Failure!";
	}


	if(empty($_POST["save"]) && empty($_GET["id"]) && !empty($_POST["search"])){
		//unset($_SESSION['emp_id']);
		echo 'fdfdsfdsf';
	}

	$rs_data=mysql_query("select *from   tb_employee where des_salary <>0 order by name limit $_GET[pagging],$limit_lk");
	$x=mysql_num_rows($rs_data);
	$pub="3";
	if(!empty($_GET["id"]) && empty($_POST["delete"]) && $_POST['hrelaod']==0){
		$rs_select=mysql_query("select * from   tb_employee where id=$_GET[id]");
	}else if(isset($_SESSION['emp_id']) && $POST['hrelaod']==0){
		$rs_select=mysql_query("select * from   tb_employee where id=".$_SESSION['emp_id']);
	}
	///////////////////////////////////
	$b_date=@mysql_result($rs_select,0,'begin_date');
	if($b_date!="0000-00-00"){
		$rptdate=date("Y-m-d");
		$ex=strtotime($b_date);
		$now_date=strtotime($rptdate);
		$exp_unix=$now_date-$ex;
		$expir_yearin=date("Y",$exp_unix);
		$expir_yearin1=$expir_yearin-1970;
	}else
		$expir_yearin1=0;

//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=employee.php ");
}
if(!empty($_POST["search"])){
	header("location: index.php?mnu_id=2&page=emp_search.php ");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language="javascript" type="text/javascript">
function myload(){
<?php
if($_POST['hrelaod']==1)
while(list($key,$val)=each($_POST)){
	echo" document.emp.".$key.".value='$val';\n";
}

?>
}
function reload_page(){
   
    document.emp.hrelaod.value = 1;
	document.emp.submit();
}

	function twoDigit(number){
     return (number < 10 ? '0' : '') + number
    }
	Date.prototype.addDays = function(days) {
		this.setDate(this.getDate()+parseInt(days));
		return this;
	}
	Date.prototype.addMonths = function(months)
	{
		this.setMonth(this.getMonth()+months);
		return this;
	}
	Date.prototype.addYears = function(years) {
		this.setFullYear(this.getFullYear()+years);
		return this;
	}
	$(document).ready(function () {
		$("input,textarea,select").hover(function(){
		   
			if ($("#begin_date").val()!= ""){
				d = new Date($("#begin_date").val().replace('-','/').replace('-','/'));
				d2 = new Date($("#begin_date").val().replace('-','/').replace('-','/'));
				
				var exin = 0;
				if((parseInt($("#exp_in").val()) % 2)==1)
					exin = parseInt($("#exp_in").val()) -1;
				else	
					exin = parseInt($("#exp_in").val());
				
				//var years = $("#con_years").val();
				var ye = 2 ;//+ exin;
				
				d.addYears(ye).toDateString();
				
				var months = $("#con_test_months").val();
				d2.addMonths(parseInt(months)).toDateString();
				
				
				$("#end_date").val(d.getFullYear()+'-'+twoDigit(parseInt(d.getMonth())+1)+'-'+twoDigit(d.getDate()));
				$("#test_end_date").val(d2.getFullYear()+'-'+twoDigit(parseInt(d2.getMonth())+1)+'-'+twoDigit(d2.getDate()));
			}
		}
		);
	});
	</script>

</head>

<body onload="myload()">

<form method="POST" action="" name="emp" id="emp">
<div>
<?php  if( !empty($_GET["id"]) || isset($_SESSION['emp_id']))
	@include("menu.php");
	
?>
</div>
<div align="center">

<table width="80%" style="border-style:solid; border-width:1px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">
		<span lang="en-us">Employee Job Information</span></td>
	</tr>
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">
		<?php echo $_SESSION['emp_name']; ?>
		</td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message"><?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="24%" height="25" align="left"><span lang="en-us">Hiring Date</span></td>
		<td width="25%" height="25">
		<input type="text" name="come_date" id="come_date" size="10" value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'come_date'); else echo "0000-00-00";?> " readonly />
		<img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "come_date", "%Y-%m-%d");
				//]]></script>	
		</td>
		<td width="24%" height="25" align="left"><span lang="en-us">Work 
		Starting Date</span></td>
		<td width="36%" height="25">
		<input type="text" name="begin_date" id="begin_date" size="10" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'begin_date'); else echo "0000-00-00";?>" readonly  />
		<img id="f_btn2"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn2", "begin_date", "%Y-%m-%d");
				//]]></script>	
		</td>
	</tr>
	<tr>
		<!--td width="24%" height="25" align="left"><font size="2"><b>Contract Duration in Years</b></font></td>
		<td width="25%" height="25">
		<input type="text" name="con_years" id="con_years" size="10" value="<?php //if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'con_years'); else echo "2";?> " /-->
		
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Testing Period in Months</b></font></span></td>
		<td width="25%" height="25">
		<input type="text" name="con_test_months" id="con_test_months" AUTOCOMPLETE="Off" size="10" value="<?php if(!empty($_GET["id"]) ) echo @mysql_result($rs_select,0,'con_test_months'); else echo "3";?> " />
		
		
	</tr>
	<tr>
		<td width="24%" height="25" align="left"><span lang="en-us">End of 
		Testing Period</span></td>
		<td width="36%" height="25">
		<input type="text" name="test_end_date" id="test_end_date" size="10" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'test_end_date');?>" readonly  />
		<img id="test_end_date_b"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("test_end_date_b", "test_end_date", "%Y-%m-%d");
				//]]></script>	
		</td>
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Contract End</b></font></span></td>
		<td width="36%" height="25">
		<input type="text" name="end_date" id="end_date" size="10" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'end_date');?>" readonly  />
		<img id="end_date_b"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("end_date_b", "end_date", "%Y-%m-%d");
				//]]></script>	
		</td>
	</tr>
	<tr>
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Department/M</b></font></span></td>
		<td width="25%" height="25">
		<input type="hidden" id="hrelaod" name="hrelaod" value="0" />
		<select size="1" name="dept_id"  onchange ="reload_page()">
		<option value="0">-----</option>
		<?php 
		if(!empty($_GET["id"])) $dept_id=@mysql_result($rs_select,0,'dept_id');
		$rs_dept=mysql_query("select *from lk_depart");
		$xdept=mysql_num_rows($rs_dept);
		
		for($ii=0;$ii<$xdept;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_dept,$ii,'id');?>" <?php if(mysql_result($rs_dept,$ii,'id')==$dept_id || mysql_result($rs_dept,$ii,'id')==$_GET['dept_id']) echo "selected";?> ><?php echo mysql_result($rs_dept,$ii,'name');?></option>
		<?php }?>
		</select>
		</td>
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Department</b></font></span></td>
		<td width="25%" height="25">
		<select size="1" name="section_id">
		<option >-----</option>
		<?php 
		if(!empty($_GET["id"])) 
			$sec_id=@mysql_result($rs_select,0,'section_id');
		else	
			$sec_id=-1;
		if(isset($_POST['dept_id']))
			$dept_id = $_POST['dept_id'];
		else{	
			$dept_id = @mysql_result($rs_select,0,'dept_id') ;
		}	
			$rs_sec=mysql_query("select *from tb_section where dept_id=".$dept_id."  order by name asc");
		$xsec=mysql_num_rows($rs_sec);
		
		for($ii=0;$ii<$xsec;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_sec,$ii,'id');?>" <?php if(mysql_result($rs_sec,$ii,'id')==$sec_id) echo "selected";?> ><?php echo mysql_result($rs_sec,$ii,'name');?></option>
		<?php }?>
		</select>
		</td>
		</tr>
		<tr>
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Job</b></font></span></td>
		<td width="20%" height="25">
		<select size="1" name="job_id">
		<option >-----</option>
		<?php 
		if(!empty($_GET["id"])) $job_id=@mysql_result($rs_select,0,'job_id');
		$rs_job=mysql_query("select *from lk_jop  order by name asc");
		$xjob=mysql_num_rows($rs_job);
		
		for($ii=0;$ii<$xjob;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_job,$ii,'id');?>" <?php if(mysql_result($rs_job,$ii,'id')==$job_id) echo "selected";?> ><?php echo mysql_result($rs_job,$ii,'name');?></option>
		<?php }?>
		</select>
		</td>
		<td width="24%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Category</b></font></span></td>
		<td width="25%" height="25">
		<select size="1" name="cat_id">
				<option value="0" <?php if ($cat_id==0)echo "selected";?> >-----</option>

		<?php 
		if(!empty($_GET["id"])) $cat_id=@mysql_result($rs_select,0,'cat_id'); else  $cat_id=0;
	
		$rs_cat=mysql_query("select *from lk_cat  order by name asc");
		$xcat=mysql_num_rows($rs_cat);
		
		for($ii=0;$ii<$xcat;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_cat,$ii,'id');?>" <?php if(mysql_result($rs_cat,$ii,'id')==$cat_id) echo "selected"; ?> ><?php echo mysql_result($rs_cat,$ii,'name');?></option>
		<?php }?>
		</select>
		</td>
		</tr>
		<tr>
		<td width="24%" height="25" align="left"><span lang="en-us">Practical 
		Experience</span></td>
		<td width="36%" height="25">
		<input type="text" name="exp_out" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'exp_out');else echo "0";?>">
		</td>
		<td width="24%" height="25" align="left" valign="top">
		<span lang="en-us"><font size="2"><b>Experience within Company</b></font></span></td>
		<td width="25%" height="25" valign="top">
		<input type="text" name="exp_in" id="exp_in" size="10" readonly AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo $expir_yearin1;else echo "0";?>">
		</td>
	</tr>
    <tr>	
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Required Hours</b></font></span></td>
		<td width="12%" height="25">
		<input type="text" name="dayofmonth" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'dayofmonth');else echo "0";?>"></td>
		<td width="12%" height="25">
		&nbsp;</td>
		<td width="12%" height="25">
		&nbsp;</td>
	</tr>
    <tr>	
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Comments</b></font></span></td>
		<td width="36%" height="25" colspan="3">
		<textarea rows="2" name="note" cols="70"><?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'note');?>
		</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		&nbsp;</td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
/*
    $result = mysql_query("select count(*) as noOfrows from tb_employee");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from tb_employee order by name asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\" src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table;
	echo $testPage->display_pages();
	*/
  ?>
</div>
</body>

</html>