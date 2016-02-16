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
case "06":$mm="Jun";
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


/*-----------------------------------------------*/
mysql_query("SET NAMES 'utf8'");
$rs_sec=mysql_query("select *from lk_depart where id=$_POST[section]");

$rs_emp=mysql_query("select *from tb_collaborator  where dis_salary=1 and sec_id =$_POST[section] order by name ");
$xemp=mysql_num_rows($rs_emp);
?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>hr system- </title>
</head>

<body>

<div align="center">
	<table border="0" width="100%" id="table1" dir="ltr">
		<tr>
				<td colspan="4">
				&nbsp;</td>
			</tr>
		<tr>
				<td colspan="4">
				<p align="center">
				&nbsp;</td>
			</tr>
		<tr>
				<td colspan="4" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>LATD TECHNOLOGY <br>
				EXTRA PAYMENT REPORT: 
				<?php echo $rptdate;?>
				&nbsp;</b></b><br>
&nbsp;</td>
			</tr>
		<tr>
			<td width="7%"><b>DEPARTMENT</b></td>
			<td width="42%"><b><?php echo mysql_result($rs_sec,0,'name');?></b></td>
			<td width="11%"><b>REPORT DATE</b></td>
			<td width="39%"> 
	<?php Date_conf_Now();?>
</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" dir="ltr">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B">
					<font size="2"><b>#</b></font></td>
					<td align="center" bgcolor="#E6B86B"><font size="2"><b>Name</b></font></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					Basic</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					50% from Basic</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2"> 
					Official Hours</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					vacations hours</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2"> 
					Off Days Hours</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					Extra Payment</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					Due Owned</font></b></td>
					<td align="center" bgcolor="#E6B86B"><b><font size="2">
					Signature</font></b>&nbsp;</td>
				</tr>
<!--//////////////////////////////////////////////////بداية عرض الموظفين حسب القسم///////////////////////////////////////////////-->
<?php for($i=0;$i<$xemp;$i++){
//$counter=$counter+1;
$emp_id=@mysql_result($rs_emp,$i,'id');
/////////////حساب الراتب الأساسي//////////////////////

$sal1=@mysql_result($rs_emp,$i,'sal');
/////////////////نهاية الراتب الاساسي///////////////
	$per50=$sal1/2;//----------------50% من المرتب الأساسي



$rs_overtime=mysql_query("select *from tb_coll_overtime  where year=$_POST[year] and month=$_POST[month] and emp_id=$emp_id");
//echo "select *from tb_coll_overtime  where year=$_POST[year] and month=$_POST[month] and emp_id=$emp_id"."<br>";
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
						<td bgcolor="#FFFFFF" width="32%"><b>Totals</b></td>
						<td bgcolor="#E6B86B" width="102" align="center"><b>
						<font size="2">Basic total</font></b></td>
						<td bgcolor="#E6B86B" width="95" align="center"><b>
						<font size="2">Basic 50% Total </font></b></td>
						<td bgcolor="#E6B86B" width="63" align="center"><b>
						<font size="2">Official Hours</font></b>&nbsp;</td>
						<td bgcolor="#E6B86B" width="66" align="center"><b>
						<font size="2">Vacations</font></b></td>
						<td bgcolor="#E6B86B" width="64" align="center"><b>
						<font size="2">Off Days</font></b>&nbsp;</td>
						<td bgcolor="#E6B86B" width="67" align="center"><b>
						<font size="2">Extra Payment</font></b></td>
						<td bgcolor="#E6B86B" align="center"><b><font size="2">
						Dued</font></b></td>
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