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
$rs_emp=mysql_query("select *from tb_collaborator where dis_salary=1 and tch=1 order by name");
$xemp=mysql_num_rows($rs_emp);

?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HR system</title>
</head>

<body>

<div align="center">
	<table border="0" width="70%" id="table1">
		<tr>
				<td>
				&nbsp;</td>
			</tr>
		<tr>
				<td>
				<p align="center">
				&nbsp;</td>
			</tr>
		<tr>
				<td style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<table id="table9" border="0" width="100%" dir="ltr">
					<tr>
						<td colspan="3">
						<p align="center"><font size="5"><b>NATIONAL FUND FOR 
						SOCIAL INSURANCE</b></font></td>
					</tr>
					<tr>
						<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
						<p align="center"><span lang="ar-sa"><b><font size="4">
						مكتب ولاية الخرطوم</font></b></span></p>
						<div align="center">
							<table id="table10" border="0" width="100%" dir="ltr">
								<tr>
									<td width="34%"><b><span lang="ar-sa">كشف 
									اساس</span>/<span lang="ar-sa">اضافة</span>/<span lang="ar-sa">في</span> 
									<?php echo $rptdate;?></b></td>
									<td width="64%"><b>Detection of new workers 
									during the insurance year (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</b></td>
								</tr>
								<tr>
									<td colspan="2">
									<p align="center"><b>(18469)regestration 
									number</b></td>
								</tr>
								<tr>
									<td colspan="2">
									<table id="table11" border="0" width="100%" dir="ltr">
										<tr>
											<td align="left" width="139">
											Business owner name<b>:</b></td>
											<td align="left" width="147">LATD 
											Technology</td>
											<td align="left" width="95"><b>Phone:</b></td>
											<td align="left">&nbsp;</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</div>
						</td>
					</tr>
				</table>
				<p align="center">&nbsp;</td>
			</tr>
		<tr>
			<td>
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" dir="ltr">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B" height="24">
					<font size="2"><b>#</b></font></td>
					<td align="center" bgcolor="#E6B86B" height="24">
					<font size="2"><b>Name</b></font></td>
					<td align="center" bgcolor="#E6B86B" height="24" width="14%">
					Insurance Number</td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					Service Start Date </td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					Monthly Salary</td>
					<td align="center" bgcolor="#E6B86B" width="35" height="24">
					Insurance<font size="2"><b>8%</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="23" height="24">
					<font size="2"><b>Insurance 17%</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="23" height="24">
					<font size="2"><b>Insurance 25%</b></font></td>
				</tr>
<!--//////////////////////////////////////////////////بداية عرض الموظفين حسب القسم///////////////////////////////////////////////-->
<?php for($i=0;$i<$xemp;$i++){
$counter=$counter+1;
$add20=mysql_result($rs_emp,$i,'add20');

$salary=mysql_result($rs_emp,$i,'sal');
$emp_id=mysql_result($rs_emp,$i,'id');
$tch=mysql_result($rs_emp,$i,'tch');

$bsal=108.32;
$glaa=26.88;
$travel=28.8;
$home=36;
$sum1=$home+$travel+$glaa+$bsal;
$sal1=$salary-$sum1;
$emp_id=mysql_result($rs_emp,$i,'id');
$health=($sal1*25)/100;
$work=($sal1*25)/100;
$overtime=$sal1*50/100;
$salary=$salary+$add20;
if($tch==1)
$tameen=($salary*8)/100;
else
$tameen=0;

if($tch==1)
$tameen17=($salary*17)/100;
else
$tameen17=0;

if($tch==1)
$tameen25=($salary*25)/100;
else
$tameen25=0;

$sum_bsal=@$sum_bsal+$bsal;
$sum_glaa=@$sum_glaa+$glaa;
$sum_travel=@$sum_travel+$travel;
$sum_home=@$sum_home+$home;
$sum_health=@$sum_health+$health;
$sum_work=@$sum_work+$work;
$sum_overtime=@$sum_overtime+$overtime;
$sum_salary=@$sum_salary+$salary;
$sum_add20=@$sum_add20+$add20;
if($tch==1)
$sum_tameen=$sum_tameen+$tameen;

if($tch==1)
$sum_tameen17=$sum_tameen17+$tameen17;

if($tch==1)
$sum_tameen25=$sum_tameen25+$tameen25;

////حساب الزيادة //////////
	//$add12=	($salary*20)/100;
	/************************/
	//$rs_av=mysql_query("select *from  tb_collaborator where id=$emp_id");
	//$rs_updateadd= mysql_query("update tb_collaborator set add20=$add12 where id=$emp_id  ");

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
$safy=$salary-$total_lone- $tameen;
$tot_safy=@$tot_safy+$safy;
/*----------------------صافي المرتب  نهاية--------------------*/

?>
				<tr>
					<td width="1%" align="center"><font size="2"><b><?php echo $counter;?>&nbsp;</b></font></td>
					<td align="center" width="21%"><font size="2"><b><?php echo mysql_result($rs_emp,$i,'name');?></b></font></td>
					<td align="center" width="14%" ><b><font size="2"><?php echo mysql_result($rs_emp,$i,'tameenno');?>
									</font></b>
									</td>
					<td align="center" width="70"><font size="2"><b><?php echo mysql_result($rs_emp,$i,'tameen_date');?></b></font></td>
					<td align="center" width="70"><b><font size="2"><?php echo $salary;?></font></b></td>
					<td align="center" width="35"><b><font size="2"><?php echo $tameen;?></font></b></td>
					<td align="center" width="23"><b><font size="2"><?php echo $tameen17;?></font></b></td>
					<td align="center" width="23"><b><font size="2"><?php echo $tameen25;?></font></b></td>
				</tr>
				<?php 
				}?>
	<!--//////////////////////////////////////////////////نهاية عرض الموظفين حسب القسم///////////////////////////////////////////////-->

			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" id="table3" style="border-collapse: collapse" bgcolor="#244893" dir="ltr">
				<tr>
					<td width="38%" bgcolor="#FFFFFF">&nbsp;</td>
					<td width="70" align="center">
					<span lang="ar-sa"><font size="1" color="#FFFFFF"><b>Total 
					Monthly Payment</b></font></span></td>
					<td width="70" align="center">
					<font size="1" color="#FFFFFF"><span lang="ar-sa"><b>Total
					Insurance </b></span><b>8%</b></font></td>
					<td width="70" align="center">
					<span lang="ar-sa"><font size="1" color="#FFFFFF"><b>Total
					Insurance17%</b></font></span></td>
					<td width="70" align="center">
					<span lang="ar-sa"><font size="1" color="#FFFFFF"><b>Total 
					Isurance 25%</b></font></span></td>
				</tr>
				<tr>
					<td width="38%"><font color="#FFFFFF"><b>Total</b></font></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_salary;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_tameen;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_tameen17;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_tameen25;?></b></td>
				</tr>
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