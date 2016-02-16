<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");
$counter=0;

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
/*--------------------------تاريخ اليوم----------------*/
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


/*-----------------------------------------------*/
mysql_query("SET NAMES 'utf8'");
$rs_sec=mysql_query("select *from tb_section   where id=$_POST[section]");

$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 and section_id =$_POST[section] order by name ");
$xemp=mysql_num_rows($rs_emp);
?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>نظام شئوون الأفراد - قناة الشروق</title>
</head>

<body>

<div align="center">
	<table border="0" width="100%" id="table1">
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
				تقرير الأجر الإضافي بتاريخ : 
				<?php echo $rptdate;?>
				&nbsp;</b></b><br>
&nbsp;</td>
			</tr>
		<tr>
			<td width="7%"><b>القسم</b></td>
			<td width="42%"><b><?php echo mysql_result($rs_sec,0,'name');?></b></td>
			<td width="11%"><b>تاريخ إستخراج التقرير</b></td>
			<td width="39%"> 
	<?php Date_conf_Now();?>
</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table2" style="border-collapse: collapse">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B"><b>
					<font size="2">الرقم</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">الاسم</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					الأساسي</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">50% 
					من الاساسي</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">ساعات 
					عادية</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">ساعات 
					عطلات</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">ساعات 
					إجازات</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">الأجر 
					الإضافي</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">الأجر 
					المستحق</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					التوقيع</font></b></td>
				</tr>
<!--//////////////////////////////////////////////////بداية عرض الموظفين حسب القسم///////////////////////////////////////////////-->
<?php for($i=0;$i<$xemp;$i++){
//$counter=$counter+1;
$emp_id=@mysql_result($rs_emp,$i,'id');
/////////////حساب الراتب الأساسي//////////////////////
    $cat= @mysql_result($rs_emp,$i,'cat_id');
	$emp_id= @mysql_result($rs_emp,$i,'id');
	$status= @mysql_result($rs_emp,$i,'status_id');
	$chaild_count=@mysql_result($rs_emp,$i,'chaild_count');
	$exp_in=@mysql_result($rs_emp,$i,'exp_in');
	
	$b_date=@mysql_result($rs_emp,$i,'begin_date');
if($b_date!="0000-00-00"){
	$ex=strtotime($b_date);
	$now_date=strtotime($rptdate);
	$exp_unix=$now_date-$ex;
	$expir_yearin=date("Y",$exp_unix);
	$expir_yearin1=$expir_yearin-1970;
	//echo $expir_yearin1."<br>";
	}
	else
	$expir_yearin1=0;
		/*---------------------------------------------*/
	$exp_out=@mysql_result($rs_emp,$i,'exp_out');
	////////////////////المرتب الاساسي////////////////////////


	$rs_bsal=mysql_query("select * from tb_salary where cat_id=$cat and exp=$exp_out");

	$sal1=@mysql_result($rs_bsal,0,'bsalary');
	/*******************************/
	$day_sal=($sal1/30);
	$sal_comdate=strtotime($b_date);
	$sal_date=date("Y")."-".date("m")."-"."30";
	$salnow_date=strtotime($sal_date);
	$sal_exp_unix=$now_date-$ex;
	$expir_day=date("d",$sal_exp_unix);
	$date_beginwork=explode("-",$b_date);

/*if(@$date_beginwork[1]==$month && $date_beginwork[0]==$year)
{
$expir_day=$expir_day-1;
$sal1=$day_sal*$expir_day;
}
*/
	/*******************************/
	
		///////////////////////////////////////////////////////////////////////
	
	if($expir_yearin1 >0 )
	{
	$xexp=$expir_yearin1;
	for($j=0;$j < $xexp;$j++)
		{
		$expir_yearin1=(5 *$sal1)/100;
		$sal1=$sal1 + @$expir_yearin1;
		}
	}

/////////////نهاية حساب الراتب الأساسي//////////////////////
	$per50=$sal1/2;//50% من المرتب الأساسي



$rs_overtime=mysql_query("select *from tb_overtime  where year=$_POST[year] and month=$_POST[month] and emp_id=$emp_id");
//echo "select *from tb_overtime  where year=$_POST[year] and month=$_POST[month] and emp_id=$emp_id"."<br>";
//echo @$xovertime."<br>";
$xovertime=mysql_num_rows($rs_overtime);

if($xovertime >0){
$normal=0;
$holiy=0;
$holiyemp=0;

$counter=@$counter+1;
for($j=0;$j<$xovertime ;$j++){

$normal=@$normal+(($sal1/160)* @mysql_result($rs_overtime,$j,'h1'));///////////////حساب الساعات العادية/////////////////////
$holiy=@$holiy+(($sal1/120)* @mysql_result($rs_overtime,$j,'h2'));///////////////حساب الساعات عطلات/////////////////////
 
$holiyemp=@$holiyemp+(($sal1/120)* @mysql_result($rs_overtime,$j,'h3'));///////////////حساب الساعات عطلات/////////////////////
}
$total=@$normal+@$holiy+@$holiyemp;
if($total<=$per50)
$pushover=$total;
else
$pushover=$per50;
/*----------------------الإجماليات--------------------*/
	$sum_salary=@$sum_salary+round($sal1,2);
	$sum_havsal=@$sum_havsal+round($per50,2);
	$sum_normal1=@$sum_normal1+round($normal,2);
	$sum_holidy=@$sum_holidy+round($holiy,2);
	$sum_holidy_emp=@$sum_holidy_emp+round($holiyemp,2);
	$sum_total=@$sum_total+round($total,2);
	$sum_push=@$sum_push+round($pushover,2);
/*----------------------الإجماليات--------------------*/
?>
				<tr>
					<td width="1%" align="center"><font size="2"><?php echo $counter;?>&nbsp;</font></td>
					<td align="center" width="20%"><font size="2"><?php echo mysql_result($rs_emp,$i,'name');?></font></td>
					<td align="center" width="7%"><font size="2"><?php echo round($sal1,2);?></font></td>
					<td align="center" width="7%"><font size="2"><?php echo round($per50,2);?></font></td>
					<td align="center" width="5%"><?php echo round($normal,2);?></td>
					<td align="center" width="5%"><?php echo round($holiy,2);?></td>
					<td align="center" width="5%"><?php echo round($holiyemp,2);?></td>
					<td align="center" width="5%"><?php echo round($total,2);?></td>
					<td align="center" width="5%"><?php echo round($pushover,2);?></td>
					<td align="center" width="5%">&nbsp;</td>
				</tr>
				<?php } 
				}?>
	<!--//////////////////////////////////////////////////نهاية عرض الموظفين حسب القسم///////////////////////////////////////////////-->

			</table>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			<div align="center">
				<table border="1" width="100%" id="table3" style="border-collapse: collapse">
					<tr>
						<td bgcolor="#FFFFFF" width="32%"><b>الاجماليات</b></td>
						<td bgcolor="#E6B86B" width="102" align="center"><b>
						<font size="2">إجمالي الاساسي</font></b></td>
						<td bgcolor="#E6B86B" width="95" align="center"><b>
						<font size="2">إجمالي 50% أساسي</font></b></td>
						<td bgcolor="#E6B86B" width="63" align="center"><b>
						<font size="2">عادية</font></b></td>
						<td bgcolor="#E6B86B" width="66" align="center"><b>
						<font size="2">عطلات</font></b></td>
						<td bgcolor="#E6B86B" width="64" align="center"><b>
						<font size="2">إجازات</font></b></td>
						<td bgcolor="#E6B86B" width="67" align="center"><b>
						<font size="2">الاجر الإضافي</font></b></td>
						<td bgcolor="#E6B86B" align="center"><b><font size="2">
						المستحق</font></b></td>
					</tr>
					<tr>
						<td width="32%">&nbsp;</td>
						<td width="102">
						<p align="center"><b><?php echo number_format(round(@$sum_salary,2),2,'.',', ');?></b></td>
						<td width="95" align="center"><b><?php echo number_format(round(@$sum_havsal,2),2,'.',', ');?></b></td>
						<td width="63" align="center"><b><?php echo number_format(round(@$sum_normal1,2),2,'.',', ');?></b></td>
						<td width="66" align="center"><b><?php echo number_format(round(@$sum_holidy,2),2,'.',', ');?></b></td>
						<td width="64" align="center"><b><?php echo number_format(round(@$sum_holidy_emp,2),2,'.',', ');?></b></td>
						<td width="67" align="center"><b><?php echo number_format(round(@$sum_total,2),2,'.',', ');?></b></td>
						<td align="center"><b><?php echo number_format(round(@$sum_push,2),2,'.',', ');?></b></td>
					</tr>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>

</body>

</html>
<?php 
}
else
header ("location: login.php");
?>