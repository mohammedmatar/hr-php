<?php 
mysql_query("SET NAMES 'utf8'");
if(empty($_POST["delete"]) && !empty($_GET["emp_id"])){
		$rs_select=mysql_query("select * from  tp_promotion where emp_id=".$_GET['emp_id']);
		
		
	}
	if(!empty($_POST["newselect"])){
		header("location: index.php?mnu_id=2&page=emp_promotionsearch.php");

	}
if(empty($_GET["id"])) 
	 $emp=$_GET["emp_id"];
	 else 
	 $emp=@mysql_result($rs_select,0,'emp_id');
	 $rs_emp=mysql_query("select *from tb_employee where id=$emp"); 
$row1=mysql_fetch_array($rs_emp);
$job_id=$row1[18];
$rs_jobold=mysql_query("select *from  lk_jop where id=$job_id");
$job_name=mysql_result($rs_jobold,0,'name');
	
	$b_date=$row1[15];
	$p_date=$row1[35];
	if($p_date!="0000-00-00")
	$b_date=$p_date;
	
		if($b_date!="0000-00-00"){
			$rptdate=date("Y-m-d");
			$ex=strtotime($b_date);
			$now_date=strtotime($rptdate);
			$exp_unix=$now_date-$ex;
			$expir_yearin=date("Y",$exp_unix);
			$expir_yearin1=$expir_yearin-1970;
		}else
			$expir_yearin1=0;
	 $expir_yearin1++;
		///////////////////////////////////////////////////////////////
	
	///////////////////////////////حساب الإجازة السنوية /////////////
				///ايام الإجازة حتى الآن///
				if($p_date!="0000-00-00")
				{
				$rsbalance=mysql_query("select *from tp_promotion where emp_id=$_GET[emp_id] order by id desc limit 1");
				$balance=mysql_result($rsbalance,0,'holybalance');
				$rsholyjob=mysql_query("select *from lk_jop where id=$job_id");
				$holyday=mysql_result($rsholyjob,0,'holiday');
				$blanceholyday=($expir_yearin1 * $holyday)  + $balance;	
		
					}
				else
				{
				$rsholyjob=mysql_query("select *from lk_jop where id=$job_id");
				$holyday=mysql_result($rsholyjob,0,'holiday');
				$blanceholyday=$expir_yearin1 * $holyday;
				
				}
			
				/*******************/
				// حساب الإجازات المستحقة//
				if($p_date=="0000-00-00"){
				$rs_holy=mysql_query("select sum(hol_day) as Sumdays from tb_holiy_emp where emp_id=$_GET[emp_id] and hol_id=4");
				$holysum=mysql_result($rs_holy,0,'Sumdays');
			    $holybalance=$blanceholyday - $holysum;
			    }
			    else
			    {
			    $year=explode("-",$p_date);
			    $year=$year[0];
			    $rs_holy=mysql_query("select sum(hol_day) as Sumdays from tb_holiy_emp where emp_id=$_GET[emp_id] and hol_id=4 and year >=$year");
				$holysum=mysql_result($rs_holy,0,'Sumdays');
			    $holybalance=$blanceholyday - $holysum;

			    }
				//echo $holybalance;
				/**********************/
	////////////////////////////////////////////////////////////////
if(!empty($_GET["mess"]))
	$mess = $_GET["mess"];

if(isset($_POST['date']))
   $termDate =  $_POST['date'];
else $termDate = date('Y-m-d');



/*
$testQR = mysql_query("select count(*) as c from tp_promotion where emp_id=".$_GET["emp_id"]);
$founInTerm  = mysql_result($testQR,0,'c');
*/
if(!empty($_POST["save"])&&(isset($_GET["updFiled"]))||($founInTerm > 0)){
	$updateF = 1;
}else $updateF = 0;

///////////////////Command update///////////////////////////////
if(!empty($_POST["save"]) ){
	if(!empty($_POST['date'])){
		
		$updQuery="update tp_promotion set last_job=$job_id,new_job='$_POST[job_id]',date='$_POST[date]',holybalance=$_POST[holybalance] where emp_id= $_GET[emp_id] and emp_id=$_GET[emp_id]";
		$rs_save=mysql_query($updQuery);
		if($rs_save){
		$rs_empupdate=mysql_query("update tb_employee set prom_date='$_POST[date]',job_id=$_POST[job_id] where id=$_GET[emp_id]");
$mess="data saved";
			header("location: index.php?mnu_id=2&page=emp_promotion.php&emp_id=$_GET[emp_id] ");

		}else
$mess="data not saved";
			 
	}else
		$mess="some fields are not filled ".$_POST['date'];

}

	if(empty($_POST["delete"]) && !empty($_GET["emp_id"])){
		$rs_select=mysql_query("select * from  tp_promotion where emp_id=".$_GET['emp_id']);
		$termDate=mysql_result($rs_select,0,'date');
		$old_balance=mysql_result($rs_select,0,'holybalance');
		
	}

	//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=emp_promotion.php&emp_id=$_GET[emp_id] ");
}
ss
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body>

<form method="POST" action="" name="term">

<div align="center">

<table border="0" width="80%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="4" class="tdtitle">employee promotions</td>
	</tr>
	<tr>
		<td width="97%" colspan="4" class="tdtitle">
		<span lang="en-us"><?php echo @mysql_result($rs_emp,0,'name');?></span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo $mess;?></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">current job</span></td>
		<td width="22%" height="25" align="right" style="padding-right: 10px">
		<span style="background-color: #FFFF00"><?php echo @$job_name;?></span></td>
		<td width="11%" height="25">
		&nbsp;</td>
		<td width="43%" height="25">
		&nbsp;</td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">new job</span></td>
		<td width="22%" height="25" align="right">
		<select size="1" name="job_id">
		<option >-----</option>
		<?php 
		if(!empty($_GET["id"])) $job_id=@mysql_result($rs_select,0,'new_job');
		$rs_job=mysql_query("select *from lk_jop  order by name asc");
		$xjob=mysql_num_rows($rs_job);
		
		for($ii=0;$ii<$xjob;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_job,$ii,'id');?>" <?php if(mysql_result($rs_job,$ii,'id')==$job_id) echo "selected";?> ><?php echo mysql_result($rs_job,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="11%" height="25">
		<span lang="en-us"><font size="2"><b>promotion date</b></font></span></td>
		<td width="43%" height="25">
		<font size="2"><b>
		
		<input type="text" size="12" name="date" id="date" readonly="1" value="<?php echo $termDate;//@mysql_result($rs_select,0,'date'); ?>" />
		 <img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "date", "%Y-%m-%d");
				//]]></script>
		<!--span lang="en-us">
		</span><a href="#" onClick='javascript:window.open("calendar.php?form=term&field=date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="16" height="16"></a-->
		</b></font></td>
	</tr>
	<tr>
		<td align="left"><span lang="en-us"><font size="2"><b>current vacations 
		balance</b></font></span></td><td collspan="2"><input type="text" name="holybalance" AUTOCOMPLETE="Off"  value="<?php echo $holybalance;?>">ا</td>
	</tr>
	<tr><td align="left"><font size="2"><b>Balance</b></font></td>
		<td collspan="2" style="padding-right: 20px" bgcolor="#FFFF00"><?php echo @$old_balance;?></td></tr>
	
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-style:solid; border-width:1px; border-collapse: collapse; ">
				<tr>
					<td><input type="hidden" value="<?php if(isset($_GET["updFiled"])) echo "1"; else echo "0";?>" id="updateF" name="updateF">
					<input type="submit" value="save" name="save" class="button" style="float: right"></td>
					<td>
					<input type="submit" value="new employee" name="newselect" class="button" style="color: #FFFFFF; background-color: #008000"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<br />
<!--div align="center">
<?php 
    
	$result = mysql_query("select count(*) as noOfrows from tp_promotion");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">New Job</td></td><td  align=\"center\" class=\"tdtitle\">promotion Date</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tp_promotion.id,lk_jop.name,tp_promotion.date,tp_promotion.emp_id from tp_promotion left join tb_employee on(tp_promotion.emp_id=tb_employee.id) left join lk_jop on(tp_promotion.new_job=lk_jop.id) order by tp_promotion.id desc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+pagination_page')."&id=".$row[0]."&emp_id=".$row[3]."\"><img border=\"0\" alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div-->
</body>

</html>