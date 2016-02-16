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
$rs_emp=mysql_query("select *from tb_collaborator where dis_salary=1 and sec_id=$_POST[sec_id] order by name");
$xemp=mysql_num_rows($rs_emp);
$rs_section=mysql_query("select *from tb_section  where id= $_POST[sec_id] order by name");


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
				<img border="0" src="../images/logo.gif" width="92" height="88"></td>
			</tr>
		<tr>
				<td colspan="4" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>قناة الشروق الفضائية<br>
				تقرير مستحقات<?php if($_POST["sec_id"]==1) echo "   &nbsp;العمال &nbsp;"; else echo   " &nbsp; المتعاونين&nbsp;"; ?> بتاريخ : 
				<?php echo $rptdate;?>
				</b></b><br>
&nbsp;</td>
			</tr>
		<tr>
			<td width="7%"><b>القسم</b></td>
			<td width="40%"><?php echo @mysql_result($rs_section,0,'name');?></td>
			<td width="15%"><b>تاريخ إستخراج التقرير</b></td>
			<td width="37%"> 
	<?php Date_conf_Now();?>
</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table2" style="border-collapse: collapse">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B" height="24"><b>
					<font size="2">الرقم</font></b></td>
					<td align="center" bgcolor="#E6B86B" height="24"><b>
					<font size="1">الاسم</font></b></td>
					<td align="center" bgcolor="#E6B86B" height="24" width="14%">
					<b><font size="1">البرنامج</font></b></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24"><b>
					<font size="1">
					الأساسي</font></b></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>غلاء المعيشة</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>بدل الترحيل</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>بدل السكن</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>بدل العلاج</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="54" height="24">
					<font size="1"><b>بدل طبيعة عمل</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="61" height="24">
					<font size="1"><b>الأجر الإضافي</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="55" height="24">
					<font size="1"><b>جملة الراتب</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="55" height="24">
					<font size="1"><b>السلفيات</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="45" height="24">
					<font size="1"><b>صافي المرتب</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="25" height="24"><b>
					<font size="1">التوقيع</font></b></td>
				</tr>
<!--//////////////////////////////////////////////////بداية عرض الموظفين حسب القسم///////////////////////////////////////////////-->
<?php for($i=0;$i<$xemp;$i++){
$sum_salary1=0;
$emp_id=mysql_result($rs_emp,$i,'id');
$counter=$counter+1;
$salary=mysql_result($rs_emp,$i,'sal');
$bsal=108.32;
$glaa=26.88;
$travel=28.8;
$home=36;
$sum1=$home+$travel+$glaa+$bsal;
$sal1=$salary-$sum1;
$health=($sal1*25)/100;
$work=($sal1*25)/100;
$overtime=$sal1*50/100;

$sum_bsal=@$sum_bsal+$bsal;
$sum_glaa=@$sum_glaa+$glaa;
$sum_travel=@$sum_travel+$travel;
$sum_home=@$sum_home+$home;
$sum_health=@$sum_health+$health;
$sum_work=@$sum_work+$work;
$sum_overtime=@$sum_overtime+$overtime;
$sum_salary=@$sum_salary+$salary;
/*--------------------السلفيات-----------------------*/
$rs_lone=mysql_query("select *from tb_coll_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' ");
$xlone=@mysql_num_rows($rs_lone);
$total_lone=0;
for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;
}
$sum_lone=round($total_lone,2)+@$sum_lone;
/*--------------------End---------------------------*/

/*----------------------صافي المرتب --------------------*/
$safy=$salary-$total_lone;
$tot_safy=@$tot_safy+$safy;
/*----------------------صافي المرتب  نهاية--------------------*/

?>
				<tr>
					<td width="1%" align="center"><font size="2"><?php echo $counter;?>&nbsp;</font></td>
					<td align="center" width="21%"><font size="2"><?php echo mysql_result($rs_emp,$i,'name');?></font></td>
					<td align="center" width="14%" ><?php
					 $prog_id=@mysql_result($rs_emp,$i,'prog_id'); 
									$rs_prog=mysql_query("select *from lk_program where id=$prog_id "); 
									echo @mysql_result($rs_prog,0,'name');?>
									</td>
					<td align="center" width="70"><font size="2"><?php echo $bsal;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $glaa;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $travel;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $home;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $health;?></font></td>
					<td align="center" width="54"><font size="2"><?php echo $work;?></font></td>
					<td align="center" width="61"><font size="2"><?php echo $overtime;?></font></td>
					<td align="center" width="55"><?php echo $salary;?></td>
					<td align="center" width="55"><font size="2"><?php echo round($total_lone,2);?></font></td>
					<td align="center" width="45"><?php echo round($safy,2);?></td>
					<td align="center" width="25">&nbsp;</td>
				</tr>
				<?php 
				}?>
				<tr>
					<td width="36%" align="center" colspan="3" bgcolor="#FBF2E3"><b>
					<font size="4">الجمـــلة</font></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b><?php echo $sum_bsal;?></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b><?php echo $sum_glaa;?></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b><?php echo $sum_travel;?></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b><?php echo $sum_home;?></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b><?php echo $sum_health;?></b></td>
					<td align="center" width="54" bgcolor="#FBF2E3"><b><?php echo $sum_work;?></b></td>
					<td align="center" width="61" bgcolor="#FBF2E3"><b><?php echo $sum_overtime;?></b></td>
					<td align="center" width="55" bgcolor="#FBF2E3"><b><?php echo $sum_salary;?></b></td>
					<td align="center" width="55" bgcolor="#FBF2E3"><b><?php echo round($sum_lone,2);?></b></td>
					<td align="center" width="72" bgcolor="#FBF2E3" colspan="2"><b><?php echo round($tot_safy,2);?></b></td>
				</tr>
				
	<!--//////////////////////////////////////////////////نهاية عرض الموظفين حسب القسم///////////////////////////////////////////////-->

			</table>
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