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
$rs_emp=mysql_query("select *from tb_collaborator where dis_salary=1 order by name");
$xemp=mysql_num_rows($rs_emp);

?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>نظام شئوون الأفراد - قناة الشروق</title>
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
				<p align="center"><b>LATD TECHNOLOGY<br>
				REPORT ON DUES: 
				<?php echo $rptdate;?>
				&nbsp;</b></b><br>
&nbsp;</td>
			</tr>
		<tr>
			<td width="7%">&nbsp;</td>
			<td width="40%">&nbsp;</td>
			<td width="15%"><b>REPORT DATE</b></td>
			<td width="37%"> 
	<?php Date_conf_Now();?>
</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" dir="ltr">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B" height="24"><b>
					<font size="2">#</font></b></td>
					<td align="center" bgcolor="#E6B86B" height="24"><b>
					<font size="1">Name</font></b></td>
					<td align="center" bgcolor="#E6B86B" height="24" width="14%">
					<b><font size="1">البرنامج</font></b></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24"><b>
					<font size="1">
				Basic</font></b></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>High Cost of Living</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Deportation Allowance</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Housing Allowance</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Treatment Allowance</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Work Nature Allowance</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="35" height="24">
					<font size="1"><b>Extra Payment</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="35" height="24">
					<font size="1"><b>Addition</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Total Salary</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="35" height="24">
					<font size="1"><b>Advances</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="35" height="24">
					<font size="1"><b>8% Insurance</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					<font size="1"><b>Net Salary</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24"><b>Signature</b></td>
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
					<td align="center" width="70"><font size="2"><?php echo $work;?></font></td>
					<td align="center" width="35"><font size="2"><?php echo $overtime;?></font></td>
					<td align="center" width="35"><?php echo $add20;?></td>
					<td align="center" width="70"><?php echo $salary;?></td>
					<td align="center" width="35"><?php echo round($total_lone,2);?></td>
					<td align="center" width="35"><?php echo $tameen;?></td>
					<td align="center" width="70"><?php echo round($safy,2);?></td>
					<td align="center" width="70">&nbsp;</td>
				</tr>
				<?php 
				}?>
	<!--//////////////////////////////////////////////////نهاية عرض الموظفين حسب القسم///////////////////////////////////////////////-->

			</table>
			</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table3" style="border-collapse: collapse" bgcolor="#244893" dir="ltr">
				<tr>
					<td width="38%" bgcolor="#FFFFFF">&nbsp;</td>
					<td width="70" align="center">
					<font color="#FFFFFF" size="1"><b>
					Basic</b></font></td>
					<td width="70" align="center">
					<font color="#FFFFFF" size="1"><b>High Cost of Living 
					</b></font></td>
					<td width="70" align="center">
					<font color="#FFFFFF" size="1"><b>
					Deportation Allowance</b></font></td>
					<td width="70" align="center">
					<font color="#FFFFFF" size="1"><b> 
					Housing Allowance</b></font></td>
					<td width="70" align="center">
					<font color="#FFFFFF" size="1"><b> Work Nature Allowance 
					</b></font></td>
					<td width="70" align="center">
					<b><font size="1" color="#FFFFFF">Treatment Allowance</font></b></td>
					<td width="18" align="center">
					<font color="#FFFFFF" size="1"><b>Extra Payment Allowance</b></font></td>
					<td width="17" align="center">
					<font color="#FFFFFF" size="1"><b>Addition</b></font></td>
					<td width="18" align="center">
					<font color="#FFFFFF" size="1"><b>Advances</b></font></td>
					<td width="17" align="center">
					<font color="#FFFFFF" size="1"><b>Insurance</b></font></td>
					<td align="center"><font color="#FFFFFF" size="1"><b>Net Salary</b></font></td>
				</tr>
				<tr>
					<td width="38%"><b><font color="#FFFFFF">Total</font></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_bsal;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_glaa;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_travel;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_home;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_work;?></b></td>
					<td width="70" align="center" bgcolor="#FFFFFF"><?php echo $sum_health;?></td>
					<td width="18" align="center" bgcolor="#FFFFFF"><b><?php echo $sum_overtime;?></b></td>
					<td width="17" align="center" bgcolor="#FFFFFF"><?php echo $sum_add20;?></td>
					<td width="18" align="center" bgcolor="#FFFFFF"><?php echo round($sum_lone,2);?></td>
					<td width="17" align="center" bgcolor="#FFFFFF"><?php echo $sum_tameen;?></td>
					<td align="center" bgcolor="#FFFFFF"><b><?php echo round($tot_safy,2);?></b></td>
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