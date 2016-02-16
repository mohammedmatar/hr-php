<?php 
if(!empty($_GET["mess"]))
	$mess = $_GET["mess"];
	
if(!empty($_GET["id"])){
	$rs_select=mysql_query("select *from   tb_holiy_emp where id=$_GET[id]");
}
if(empty($_POST["holiy_type"])){
  $holiy_type = mysql_result($rs_select,0,'hol_id');
}else 
	$holiy_type = $_POST["holiy_type"];
	
///////////////////Command Save///////////////////////////////

///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////
//echo 'Info : '.$_POST["holiy_type"];
//mysql_query("SET NAMES 'utf8'");
$year_tody= date("Y");
$rptdate=date("Y-m-d");
 $rs_emp=mysql_query("select *from tb_employee where id=$_GET[emp_id]"); 
$row1=mysql_fetch_array($rs_emp);
$job_id=$row1[18];
if(!empty($holiy_type) ){
	$year_hol=date('Y');
	if(!empty($_GET["id"])){
		$notCalcThisHolday = ' and id <> '.$_GET["id"];
	}else $notCalcThisHolday = '';
	
	$days_emp_holiyday=0;
	if($holiy_type != 4){
		$rs_holiycheck=mysql_query("select * from lk_holiday where id=$holiy_type");
		//echo "select * from lk_holiday where id=$holiy_type";
		$holiydays=mysql_result($rs_holiycheck,0,'days');
		//echo $holiydays;
		$query = 'select * from tb_holiy_emp where emp_id='.$_GET["emp_id"].' and hol_id= '.$holiy_type.' and year= '.$year_hol.' '.$notCalcThisHolday;
		//echo 	$query;
		$rs_searchholiyemp=mysql_query($query);
		if($rs_searchholiyemp)
			$xsearchholiy=mysql_num_rows($rs_searchholiyemp);
		if($xsearchholiy>0){
			for($e=0;$e<$xsearchholiy;$e++){
				$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
			}
		}
		$available_holiyday=$holiydays-$days_emp_holiyday;
		$holybalance=$available_holiyday;
	}else{
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	///////////// الخبرة العملية داخل  الشركة ///////////////////
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
				$available_holiyday=$holybalance;
				/**********************/
				
				}

}
	////////////////////////////////////////////////////////////////
//------------------------------------------SAVE COMMAND---------------------------------
if(!empty($_POST["save"]) && !empty($holiy_type)  && empty($_GET["id"]) ){
	if(!empty($holiy_type)){
		$year=date('Y');
		$yearar=explode("-",$_POST["begin_date"]);
		$year_hol=$yearar[0];
		$bagee=$available_holiyday - $_POST['hol_day'];
		$rs_save=mysql_query("insert into tb_holiy_emp(emp_id,hol_id,hol_day,begin_date,end_date,work_day,year,bagee,note)values($_GET[emp_id],$holiy_type,$_POST[hol_day],'$_POST[begin_date]','$_POST[end_date]','$_POST[work_date]',$year_hol,$bagee,'$_POST[note]')");
		
		if($rs_save){
			$mess="data saved";
			$new_emp_id = mysql_query("SELECT LAST_INSERT_ID() as id");
			$lrow = mysql_fetch_row($new_emp_id);
			header("location: index.php?mnu_id=2&page=employ_holiyday.php&emp_id=".$_GET[emp_id]."&mess=".$mess."&id=".$lrow[0]);
		}else
			$mess="data not saved";
	}else
		$mess="some fields are not filled";
}
//---------------------------------command update-----------------------------
if(!empty($_POST["save"]) && !empty($_GET["id"])){
	$bagee=$available_holiyday - $_POST["hol_day"];
	$yearar=explode("-",$_POST["begin_date"]);
	$year_hol=$yearar[0];
	$query = " update  tb_holiy_emp set 
					hol_id=$holiy_type,
					hol_day=$_POST[hol_day],
					begin_date='$_POST[begin_date]',
					end_date='$_POST[end_date]',
					work_day='$_POST[work_date]',
					bagee=$bagee,
					note='$_POST[note]',
					year=$year_hol			
	where id=$_GET[id]";
	$rs_save=mysql_query($query);
	if($rs_save){
		$mess="update successful";
		header("location: index.php?mnu_id=2&page=employ_holiyday.php&emp_id=".$_GET[emp_id]."&mess=".$mess."&id=".$_GET[id]);
	}else
		$mess="update failed !";
}
////-----------------------------Command Delete//-----------------------------
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from   tb_holiy_emp  where id=$_GET[id] ");
	if($rs_save){
		$mess="successful delete";
		header("location: index.php?mnu_id=2&page=employ_holiyday.php&emp_id=".$_GET[emp_id]."&mess=".$mess);
	}else
		$mess="delete failed !";
}
//-----------------------------Select Emplyoeee-----------------------------
$rs_emp=mysql_query("select *from tb_employee where id=$_GET[emp_id]");
//echo "select *from tb_employee where id=$_GET[emp_id]";
$_SESSION["emp_id"]=mysql_result($rs_emp,0,'id');
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=employ_holiyday.php&emp_id=$_GET[emp_id]");
}
						/*
						///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////
						if(!empty($holiytype) && empty($_GET["id"]) ){
							//$holiytype=@mysql_result($rs_select,0,'hol_id');
							$days_emp_holiyday=0;
							$rs_holiycheck=mysql_query("select *from lk_holiday where id=$holiytype");
							$holiydays=mysql_result($rs_holiycheck,0,'days');
							$rs_searchholiyemp=mysql_query("select *from tb_holiy_emp where emp_id=$_GET[emp_id] and hol_id=$holiytype and year=$year_hol ");
							if($rs_searchholiyemp)
								$xsearchholiy=mysql_num_rows($rs_searchholiyemp);
							if($xsearchholiy>0){
								for($e=0;$e<$xsearchholiy;$e++){
									$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
								}
							}
							$available_holiyday=$holiydays-$days_emp_holiyday;
							
						}
						///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////
						if(!empty($holiytype) && empty($_GET["id"])){
							//$holiytype=@mysql_result($rs_select,0,'hol_id');
							$year_hol=date('Y');
							$days_emp_holiyday=0;
							if($holiytype!=4){
								$rs_holiycheck=mysql_query("select *from lk_holiday where id=$holiytype");
								$holiydays=mysql_result($rs_holiycheck,0,'days');
								$rs_searchholiyemp=mysql_query("select *from tb_holiy_emp where emp_id=$_GET[emp_id] and hol_id=$holiytype and year=$year_hol");
								//echo "select *from tb_holiy_emp where emp_id=$_SESSION[emp_id] and hol_id=$holiytype and year=$year_hol";
								if($rs_searchholiyemp)
									$xsearchholiy=mysql_num_rows($rs_searchholiyemp);
								if($xsearchholiy>0){
									for($e=0;$e<$xsearchholiy;$e++){
										$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
									}
								}
								$available_holiyday=$holiydays-$days_emp_holiyday;
							}else{
								$rs_empsection=mysql_query("select *from tb_employee where id=$_GET[emp_id]");
								$job_id=mysql_result($rs_empsection,0,'job_id');
								//$rs_searchholiyemp=mysql_query("select *from tb_holiy_emp where emp_id=$_SESSION[emp_id] and hol_id=$holiytype and year=$year_hol");
								$rs_searchholiyemp=mysql_query("select *from tb_holiy_emp where emp_id=$_GET[emp_id] and hol_id=$holiytype ");
								//$totalDaiesForYearH = 
								if($rs_searchholiyemp)
									$xsearchholiy=mysql_num_rows($rs_searchholiyemp);
								if($xsearchholiy>0){
									for($e=0;$e<$xsearchholiy;$e++){
										$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
									}
								}
								$available_holiyday=$holiydays-$days_emp_holiyday;
							
							}
						
						}
						*/

/*
//by mozmel for future update date by php
//dont clear it
if(!empty($_POST["begin_date"]) && !empty($_POST["hol_day"])){
	$date = $_POST["begin_date"];
	$dayes = $_POST["hol_day"];
	$Enddate = strtotime ( '+'.$dayes.' day' , strtotime ( $date ) ) ;
	$Enddate = date ( 'Y-m-d' , $Enddate );
	
	$Redate = strtotime ( '+1 day' , strtotime ( $Enddate ) ) ;
	$Redate = date ( 'Y-m-d' , $Redate );
}else echo "<script language=\"javascript\" type=\"text/javascript\">alert(not fill);</script>";

*/

///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language="javascript" type="text/javascript">

function myload(){
<?php
/*
while(list($key,$val)=each($_POST)){
 echo" document.holiy.".$key.".value='$val';\n";
}
*/
?>
}
	function twoDigit(number){
     return (number < 10 ? '0' : '') + number
    }
	Date.prototype.addDays = function(days) {
		this.setDate(this.getDate()+parseInt(days));
		return this;
	}
	$(document).ready(function () {
	
	$("input,textarea,select").hover(function(){
		if ($("#begin_date").val()!=""){
		d = new Date($("#begin_date").val().replace('-','/').replace('-','/'));
		d2= new Date($("#begin_date").val().replace('-','/').replace('-','/'));
		/*var road=0;
		if($("#fld_t6").val()!=""){
			road=parseInt($("#fld_t6").val());
		}*/
		d.addDays(parseInt($("#hol_day").val())-1 ).toDateString();
		d2.addDays(parseInt($("#hol_day").val() -1)+1).toDateString();
		$("#end_date").val(d.getFullYear()+'-'+twoDigit(parseInt(d.getMonth())+1)+'-'+twoDigit(d.getDate()));
		$("#work_date").val(d2.getFullYear()+'-'+twoDigit(parseInt(d2.getMonth())+1)+'-'+twoDigit(d2.getDate()));
		}
	});
	});

</script>
<script language=javascript>
function checkday(){
if(document.holiy.now_balance.value < document.holiy.hol_day.value )
document.holiy.hol_day.value=document.holiy.now_balance.value;

}
</script>
</head>

<body onload="myload()">

<form method="POST" action="" name="holiy" id="holiy" >

<div align="center">

<table border="0" width="60%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="4" class="tdtitleemp"><?php echo mysql_result($rs_emp,0,'name');?></td>
	</tr>
	<!--tr>
		<td colspan="4" class="tdtitle">Vacations</td>
	</tr-->
	<tr>
		<td width="86%"  colspan="4" class="message">
		<?php echo $mess;?></td>
	</tr>
	<tr>
		<td width="18%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>vacation type</b></font></span></td>
		<td width="32%" height="25">
		<select size="1" name="holiy_type" onchange="submit()" >
		<?php 
		if(!empty($_POST["holiy_type"])) 
			$holiytype=$_POST["holiy_type"];
		else	
		$holiytype=@mysql_result($rs_select,0,'hol_id');
		$rs_holiy_type=mysql_query("select *from lk_holiday");
		$xhol=mysql_num_rows($rs_holiy_type);
		
		for($ii=0;$ii<$xhol;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_holiy_type,$ii,'id');?>" <?php if(mysql_result($rs_holiy_type,$ii,'id')==$holiytype ) echo "selected";?> ><?php echo mysql_result($rs_holiy_type,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="17%" height="25">
		<p align="left"><font size="2"><b>current vecations balance</b></font></td>
		<td width="33%" height="25">
		<input type="text" name="now_balance" size="10" disabled value="<?php  echo @$holybalance; ?> "></td>
	</tr>
	<tr>
		<td width="18%" height="25">
		<p align="left">
		<font size="2"><b>number of days</b></font></td>
		<td width="32%" height="25">
		<input type="text" name="hol_day" id="hol_day" AUTOCOMPLETE="Off" size="10" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'hol_day'); else if(!empty($_POST["hol_day"])) echo $_POST["hol_day"]; ?>" onchange ="checkday();"></td>
		<td width="17%" height="25" align="left"><font size="2"><b>starting date </b></font></td>
		<td width="33%" height="25">
		<font size="2"><b>
		
		<input type="text" size="8" name="begin_date" id="begin_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'begin_date'); else if(!empty($_POST["begin_date"])) echo $_POST["begin_date"]; ?>" />
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
		<td width="18%" height="25">
		<p align="left">
		<font size="2"><b>end date</b></font></td>
		<td width="32%" height="25">
		<font size="2"><b>
	  <!-- onMouseOver="CalcDates()"-->
		<input type="text" size="8" name="end_date" id="end_date" readonly="1"   value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'end_date'); else if(!empty($_POST["end_date"])) echo $_POST["end_date"]; ?>" />
		<img id="f_btn2"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn2", "end_date", "%Y-%m-%d");
				//]]></script>			
		<!--a href="#" onClick='javascript:window.open("calendar.php?form=holiy&field=end_date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="16" height="16"></a-->
		</b></font></td>
		<td width="17%" height="25">
		<p align="left"><font size="2"><b>work starting date</b></font></td>
		<td width="33%" height="25">
		<font size="2"><b>
		
		<input type="text" size="8" name="work_date" id="work_date" readonly value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'work_day'); else if(!empty($_POST["work_day"])) echo $_POST["work_day"];  ?>" />
		<img id="f_btn3"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn3", "work_date", "%Y-%m-%d");
				//]]></script>
		<!--a href="#" onClick='javascript:window.open("calendar.php?form=holiy&field=work_date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="22" height="16"></a-->
		</b></font></td>
	</tr>
	<tr>
		<td width="18%" height="25">
		<p align="left"><font size="2"><b>comments</b></font></td>
		<td width="32%" height="25">
		<textarea rows="3" name="note" cols="21"><?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,note); else if(!empty($_POST["note"])) echo $_POST["note"]; ?></textarea></td>
		<td width="17%" height="25">
		&nbsp;</td>
		<td width="33%" height="25">
		&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="new" name="new" class="button"></td>
					<td>
					<input type="submit" value="save" name="save" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
					<input type="submit" value="delete" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
 
	$year_hol =date('Y');
	$query = "select count(*) as noOfrows from tb_holiy_emp where ((emp_id=$_GET[emp_id]) and (year=$year_hol or hol_id = 4))";
	$result = mysql_query($query);
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">Vacations Type </td><td  align=\"center\" class=\"tdtitle\">Number Of Days</td></td><td align=\"center\" class=\"tdtitle\">Start Date</td><td align=\"center\" class=\"tdtitle\">End Date</td><td align=\"center\" class=\"tdtitle\">Service Start Date</td><td align=\"center\" class=\"tdtitle\">Remainder</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tb_holiy_emp.id,name,hol_day,begin_date,end_date,work_day,bagee from tb_holiy_emp left join lk_holiday on (hol_id=lk_holiday.id)  where ((emp_id=$_GET[emp_id])/*and(year=$year_holor hol_id = 4)*/)  order by id desc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[1]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[3]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[4]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[5]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[6]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+emp_id+pagination_page')."&id=".$row[0]."\"><img border=\"0\"  alt=\"إختيار\" title=\"إختيار\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>

</html>