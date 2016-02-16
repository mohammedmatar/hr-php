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
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1  order BY name  ");
$xemp=mysql_num_rows($rs_emp);
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
		<td width="98%" align="left" colspan="21" class="tdtitleemp" bgcolor="#FFFFFF">
		<table border="0" width="100%" id="table6">
			<tr>
				<td colspan="4">
				<p align="center"><font face="Arabic Transparent">بسم الله 
				الرحمن الرحيم</font></td>
			</tr>
			<tr>
				<td colspan="4">
				<p align="center">
				<img border="0" src="../images/logo.gif" width="101" height="96"></td>
			</tr>
			<tr>
				<td colspan="4" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>قناة الشروق الفضائية<br>
تقرير المرتبات بتاريخ : 
				<?php echo $rptdate;?>
&nbsp;</b></b></td>
			</tr>
			<tr>
				<td nowrap width="9%"><b>نوع السلفية</b></td>
				<td nowrap width="39%"><b><font color="#244893" size="4"><?php echo $type_name;?></font></b></td>
				<td width="28%">
				<p align="left"><b><font size="2">التاريخ:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="left">
<?php
 function Date_conf_Now(){
$m=date("m");
$d_name= date("w");
$y=date("Y");
$d=date("d");

switch ($m){

case "01":$mm="يناير";
  break;
case "02":$mm="فبراير";
  break;
case "03":$mm="مارس";
  break;
case "04":$mm="ابريل";
  break;
case "05":$mm="مايو";
  break;
case "06":$mm="يونيو";
  break;
case "07":$mm="يوليو";
  break;
case "08":$mm="أغسطس";
  break;
case "09":$mm="سبتمبر";
  break;
case "10":$mm="اكتوبر";
  break;
case "11":$mm="نوفمبر";
  break;
case "12":$mm="ديسمبر";
  break;
}

switch ($d_name){

case "1":$dd="الاثنين";
  break;
case "2":$dd="الثلاثاء";
  break;
case "3":$dd="الاربعاء";
  break;
case "4":$dd="الخميس";
  break;
case "5":$dd="الجمعة";
  break;
case "6":$dd="السبت";
  break;
case "0":$dd="الأحد";
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
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" >
		<td width="1%" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b><span lang="ar-sa"><font size="2">رقم</font></span></b></td>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="6%">
		<p align="center"><b><font size="1">الموظف</font></b><td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>قيمة السلفية</b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>عدد الاقساط</b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>القسط الشهري</b></font></td>
		<td width="2%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>المتبقي من السلفية</b></font></td>
	</tr>
	<?php 
	for($i=0;$i<$xemp;$i++){
$emp_id=mysql_result($rs_emp,$i,'id');
	$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$_POST[salaf] ");
$xlone=@mysql_num_rows($rs_lone);
$total_lone=0;
for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;//قيمة القسط الشهري
	$all_loan=@mysql_result($rs_lone,$l,'loan');//قيمة السلفية
	$loan_count=@mysql_result($rs_lone,$l,'loan_number');//عدد الاقساط
	
	/*--------حساب عدد الاقساط المدفوعة----------------*/
$begin_date=@mysql_result($rs_lone,$l,'begin_date');//تاريخ بداية السلفية

$ex1=strtotime($begin_date);//تاريخ بداية السلفية
$now=$rptdate;//تاريخ استخراج التقرير
	$now_date1=strtotime($now);
	$exp_unix12=$now_date1-$ex1;
	$month_number=date("m",$exp_unix12)-1;//حساب عدد الشهور
	
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
 			} 
			}			
			?>
		<tr>
	<td width="11%" colspan="2" bgcolor="#E6ECF9"><b><font size="4">الإجمالي</font></b></td>

		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php 
		

		echo @$sumall_loan;?></b></td>
		<td  <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		&nbsp;</td>
		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php echo @$sum_lone;?></b></td>
		<td <?php if(@$counter%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b>
		<?php echo round(@$sumrest,2);?>
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