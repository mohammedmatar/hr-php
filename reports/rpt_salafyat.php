<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");


/* ----------------------Day Report-----------------------------*/
	$month=$_POST["month"];
	$year=$_POST["year"];
	
if($month==02)
$day=28;
else
$day=30;
	
	$rptdate=$year."-".$month."-".$day;
	$date=$year."-".$month."-"."1";
/* ---------------------------------------------------*/

/*--------------عرض نوع السلفية ----------------------*/

$rs_type=mysql_query("select *from lk_loan_type where id=$_POST[salaf]");
$type_name=mysql_result($rs_type,0,'name');
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 order BY name  ");
$xemp=mysql_num_rows($rs_emp);

$rs_emp1=mysql_query("select *from tb_collaborator  where dis_salary=1 order BY name   ");
$xemp1=mysql_num_rows($rs_emp1);
?>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo date("Y/m/d H:i:s");?></title>

</head>

<body>

<form method="POST" action="">
	<div align="center">

<table width="99%" style="border-style:solid; border-width:0; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" id="table5">
	<tr>
		<td width="98%" align="left" class="tdtitleemp" bgcolor="#FFFFFF">
		<table border="0" width="100%" id="table6" dir="rtl">
			<tr>
				<td colspan="4">
				<p align="center"><font face="Arabic Transparent"> 
				</font></td>
			</tr>
			<tr>
				<td colspan="4">
				<p align="center">
				<img border="0" src="../images/logo.gif" width="101" height="96"></td>
			</tr>
			<tr>
				<td colspan="4" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>LEAD TECH<br>
Salaries report date  :&nbsp;
				<?php echo $rptdate;?>
&nbsp;</b></b></td>
			</tr>
			<tr>
				<td nowrap width="9%"><b>Advance type</b></td>
				<td nowrap width="39%"><b><font color="#244893" size="4"><?php echo $type_name;?></font></b></td>
				<td width="28%">
				<p align="left"><b><font size="2">Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="left">
<?php
 function Date_conf_Now(){
$m=date("m");
$d_name= date("w");
$y=date("Y");
$d=date("d");

switch ($m){

case "01":$mm="Jan";
  break;
case "02":$mm="Feb";
  break;
case "03":$mm="Mar";
  break;
case "04":$mm="Apr";
  break;
case "05":$mm="May";
  break;
case "06":$mm="June";
  break;
case "07":$mm="July";
  break;
case "08":$mm="Aug";
  break;
case "09":$mm="Sep";
  break;
case "10":$mm="Oct";
  break;
case "11":$mm="Nov";
  break;
case "12":$mm="Dec";
  break;
}

switch ($d_name){

case "1":$dd="Mon";
  break;
case "2":$dd="Tue";
  break;
case "3":$dd="Wed";
  break;
case "4":$dd="Thu";
  break;
case "5":$dd="Fri";
  break;
case "6":$dd="Sat";
  break;
case "0":$dd="Sun";
  break;
}
echo @$dd." ".@$d.", ".@$mm."  ".@$y;
echo "&nbsp;&nbsp;&nbsp;";
echo date("H:i:s");

}
Date_conf_Now();


?></td>
			</tr>
		</table>
		</td>
	</tr>
 
	<tr>
		<td>
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" dir="ltr" >
		<td width="1%" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b><span lang="ar-sa"><font size="2">Number</font></span></b></td>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="6%">
		<p align="center"><b><font size="1">Employee</font></b><td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Amount</b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Number of premiums </b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Monthly premium</b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Remainder</b></font></td>
	</tr>
	<?php 
	for($i=0;$i<$xemp;$i++){
$emp_id=mysql_result($rs_emp,$i,'id');
	$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$_POST[salaf] ");
//echo "select *from tb_employee_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$_POST[salaf] ";
	//echo "<br>";
$xlone=@mysql_num_rows($rs_lone);

$total_lone=0;
for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;//قيمة القسط الشهري
	$all_loan=@mysql_result($rs_lone,$l,'loan');//قيمة السلفية
	$loan_count=@mysql_result($rs_lone,$l,'loan_number');//عدد الاقساط
	
	/*--------حساب عدد الاقساط المدفوعة----------------*/
$begin_date=@mysql_result($rs_lone,$l,'begin_date');//تاريخ بداية السلفية


$date1 = $begin_date;
$date2 = $rptdate;

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$month_number = (($year2 - $year1) * 12) + ($month2 - $month1);

//$ex1=strtotime($begin_date);//تاريخ بداية السلفية
//$now=$rptdate;//تاريخ استخراج التقرير
	//$now_date1=strtotime($now);
	
	//$exp_unix12=$now_date1-$ex1;
	//$month_number=date("m",$exp_unix12)-1;//حساب عدد الشهور
	
}
$push_cash=@$month_number * $total_lone;
$rest=@$all_loan-$push_cash;//متبقي المبلغ
$sum_lone=round($total_lone,2)+@$sum_lone;//جملة الاقساط المدفوعة

if($xlone!=0){
$counter=@$counter+1;

	?>
	<tr>
	<td width="1%"><font size="2"><?php echo $counter;?> </font></td>

		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="10%">
		<font size="2">
		<?php if(@$total_lone!=0) echo @mysql_result($rs_emp,$i,'name');?></font><td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php   echo @$all_loan; ?>
		</font>
		</td>
		<td  <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php   echo $loan_count; 		?></font></td>
		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2"><?php echo round($total_lone,2);?></font></td>
		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo round($rest,2);?></font></td>
		</tr>
			<?php
			$sumall_loan=@$sumall_loan+@$all_loan;
			$sumrest=@$sumrest+$rest;
			$all_loan=0;
 			} 
			}			
			?>
		<tr>
	
		</tr>
			
		
		<?php 
	for($i1=0;$i1<$xemp1;$i1++){

$emp_id1=mysql_result($rs_emp1,$i1,'id');
	$rs_lone1=mysql_query("select *from tb_coll_loan where emp_id=$emp_id1 and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$_POST[salaf] ");
$xlone1=@mysql_num_rows($rs_lone1);
//echo "select *from tb_coll_loan where emp_id=$emp_id1 and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$_POST[salaf] <br>";

$total_lone1=0;
for($l1=0;$l1<$xlone1;$l1++){
	$lone1=mysql_result($rs_lone1,$l1,'loan')/ mysql_result($rs_lone1,$l1,'loan_number');
	//echo $lone1;
	$total_lone1=$total_lone1+$lone1;//قيمة القسط الشهري
	$all_loan1=@mysql_result($rs_lone1,$l1,'loan');//قيمة السلفية
	$loan_count1=@mysql_result($rs_lone1,$l1,'loan_number');//عدد الاقساط
	
	/*--------حساب عدد الاقساط المدفوعة----------------*/
$begin_date1=@mysql_result($rs_lone1,$l1,'begin_date');//تاريخ بداية السلفية

$date11 = $begin_date1;
$date21 = $rptdate;

$ts11 = strtotime($date11);
$ts21 = strtotime($date21);

$year11 = date('Y', $ts11);
$year21 = date('Y', $ts21);

$month11 = date('m', $ts11);
$month21 = date('m', $ts21);

$month_number1 = (($year21 - $year11) * 12) + ($month21 - $month11);


/*$ex11=strtotime($begin_date1);//تاريخ بداية السلفية
$now1=$rptdate;//تاريخ استخراج التقرير
	$now_date11=strtotime($now1);
	$exp_unix121=$now_date11-$ex11;
	$month_number1=date("m",$exp_unix121)-1;//حساب عدد الشهور
	echo $month_number1;
	//echo $lone1."<br>";
*/	
}

$push_cash1=@$month_number1 * $total_lone1;
$rest1=@$all_loan1-$push_cash1;//متبقي المبلغ
$sum_lone1=round($total_lone1,2)+@$sum_lone1;//جملة الاقساط المدفوعة

if($xlone1!=0){
$counter=@$counter+1;

	?>
	<tr>
	<td width="1%"><font size="2"><?php echo $counter;?> </font></td>

		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="10%">
		<font size="2">
		<?php if(@$total_lone1!=0) echo @mysql_result($rs_emp1,$i1,'name');?></font><td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php   echo @$all_loan1; ?>
		</font>
		</td>
		<td  <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php   echo $loan_count1; 		?></font></td>
		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2"><?php echo round($total_lone1,2);?></font></td>
		<td <?php if($counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo round($rest1,2);?></font></td>
		</tr>
			<?php
			$sumall_loan1=@$sumall_loan1+@$all_loan1;
			$sumrest1=@$sumrest1+$rest1;
 			} 
			}		
		
			?>
		<tr>
	<td width="11%" colspan="2" bgcolor="#E6ECF9"><b><font size="4">Total</font></b></td>

		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php 
		

		echo @$sumall_loan1+@$sumall_loan;?></b></td>
		<td  <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		&nbsp;</td>
		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php echo @$sum_lone1+@$sum_lone;?></b></td>
		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php echo round(@$sumrest1+@$sumrest,2);?>
		</b>
		</td>
		</tr>
			</table>
		</tb></td>
	</tr>

</table>
	</div>
</form>

</body>
<?php }
else
header ("location: login.php");
?>