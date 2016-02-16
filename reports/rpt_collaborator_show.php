<?php 
session_start();
ini_set("display_errors", 1); 
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
$rs_emp=mysql_query("select *from tb_collaborator where dis_salary=1 and sec_id=$_POST[sec_id] /*and id=143*/ order by name");
$xemp=mysql_num_rows($rs_emp);
$rs_section=mysql_query("select *from tb_section  where id= $_POST[sec_id] order by name");


?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HR SYSTEM</title>
</head>

<body>

<div align="center">
	<table border="0" width="100%" id="table1">
		<tr>
				<td colspan="4">
				<p align="center">&nbsp;</td>
			</tr>
		<tr>
				<td colspan="4">
				<p align="center">
				&nbsp;</td>
			</tr>
		<tr>
				<td colspan="4" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>LATD TECHNOLOGY<br>
				REPORT ON DUES:</b>
				<?php echo $rptdate;?></td>
			</tr>
		<tr>
			<td width="7%"><b>Department</b></td>
			<td width="40%"><?php echo @mysql_result($rs_section,0,'name');?></td>
			<td width="15%">Report Date</td>
			<td width="37%"> 
	<?php Date_conf_Now();?>
</td>
		</tr>
		<tr>
			<td colspan="4">
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" dir="ltr">
				<tr>
					<td width="35" align="center" bgcolor="#E6B86B" height="24">
					<font size="0"><b>#</b></font></td>
					<td align="center" bgcolor="#E6B86B" height="24">
					<font size="0"><b>Name</b></font></td>
					<td align="center" bgcolor="#E6B86B" height="24" width="13%">
					<b><font size="0">البرنامج</font></b></td>
					<td align="center" bgcolor="#E6B86B" width="67" height="24">
					<font size="0"><b>Basic</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="72" height="24">
					High Cost Of Living </td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					Deportation Allowance</td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					Housing Allowance</td>
					<td align="center" bgcolor="#E6B86B" width="70" height="24">
					Treatment Allowance</td>
					<td align="center" bgcolor="#E6B86B" width="54" height="24">
					Work Nature Allowance</td>
					<td align="center" bgcolor="#E6B86B" width="31" height="24">
					Extra Payment </td>
					<td align="center" bgcolor="#E6B86B" width="5%" height="24">
					<font size="0"><b>Addition</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="55" height="24">
					Total Salary</td>
					<td align="center" bgcolor="#E6B86B" width="28" height="24">
					<font size="0"><b>Advances</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="5%" height="24">
					Insurance<p><font size="1"><b>%8</b></font></td>
					<td align="center" bgcolor="#E6B86B" width="5%" height="24">
					Net Salary</td>
					<td align="center" bgcolor="#E6B86B" width="25" height="24">
					Signature</td>
				</tr>
<!--//////////////////////////////////////////////////بداية عرض الموظفين حسب القسم///////////////////////////////////////////////-->
<?php for($i=0;$i<$xemp;$i++){
$sum_salary1=0;

$emp_id=mysql_result($rs_emp,$i,'id');

$counter=$counter+1;
$add20=mysql_result($rs_emp,$i,'add20');

$salary=mysql_result($rs_emp,$i,'sal');

$tch=mysql_result($rs_emp,$i,'tch');

$bsal=108.32;
$glaa=26.88;
$travel=28.8;
$home=36;
$sum1=$home+$travel+$glaa+$bsal;
$sal1=$salary-$sum1;
$health=($sal1*25)/100;
$work=($sal1*25)/100;
$overtime=$sal1*50/100;
$salary=$salary+$add20;
//$salary= $salary + $add20;
//$sal2=$salary + $add20;
//echo $sal2;
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
$safy=$salary-$total_lone-$tameen;
$tot_safy=@$tot_safy+$safy;
/*----------------------صافي المرتب  نهاية--------------------*/

?>
				<tr>
					<td width="1%" align="center"><font size="2"><?php echo $counter;?>&nbsp;</font></td>
					<td align="center" width="17%"><font size="2"><?php echo mysql_result($rs_emp,$i,'name');?></font></td>
					<td align="center" width="13%" ><?php
					 $prog_id=@mysql_result($rs_emp,$i,'prog_id'); 
									$rs_prog=mysql_query("select *from lk_program where id=$prog_id "); 
									echo @mysql_result($rs_prog,0,'name');?>
									</td>
					<td align="center" width="67"><font size="2"><?php echo $bsal;?></font></td>
					<td align="center" width="72"><font size="2"><?php echo $glaa;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $travel;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $home;?></font></td>
					<td align="center" width="70"><font size="2"><?php echo $health;?></font></td>
					<td align="center" width="54"><font size="2"><?php echo $work;?></font></td>
					<td align="center" width="31"><font size="2"><?php echo $overtime;?></font></td>
					<td align="center" width="5%"><?php echo $add20;?></td>
					<td align="center" width="55"><?php echo $salary;?></td>
					<td align="center" width="5%"><font size="2"><?php echo round($total_lone,2);?></font></td>
					<td align="center" width="5%"><?php echo $tameen;?></td>
					<td align="center" width="5%"><?php echo round($safy,2);?></td>
					<td align="center" width="25">&nbsp;</td>
				</tr>
				<?php 
				}?>
				<tr>
					<td width="32%" align="center" colspan="3" bgcolor="#FBF2E3">
					Total</td>
					<td align="center" width="67" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_bsal,2),2,'.',', ');?></font></b></td>
					<td align="center" width="72" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_glaa,2),2,'.',', ');?></font></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_travel,2),2,'.',', ');?></font></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_home,2),2,'.',', ');?></font></b></td>
					<td align="center" width="70" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_health,2),2,'.',', ');?></font></b></td>
					<td align="center" width="54" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_work,2),2,'.',', ');?></font></b></td>
					<td align="center" width="31" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_overtime,2),2,'.',', ');?></font></b></td>
					<td align="center" width="5%" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_add20,2),2,'.',', ');?></font></b></td>
					<td align="center" width="55" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_salary,2),2,'.',', ');?></font></b></td>
					<td align="center" width="5%" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_lone,2),2,'.',', ');?></font></b></td>
					<td align="center" width="5%" bgcolor="#FBF2E3"><b>
					<font size="2"><?php echo  number_format(round(@$sum_tameen,2),2,'.',', ');?></font></b></td>
					<td align="center" width="72" bgcolor="#FBF2E3" colspan="2"><b>
					<font size="2"><?php echo  number_format(round(@$tot_safy,2),2,'.',', ');?></font></b></td>
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