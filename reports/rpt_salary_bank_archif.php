<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");
$sum_totsal=0;
/*$rs_bank_cap=mysql_query("select *from tb_employee  where des_salary=1 and bank_id=$_POST[bank] group BY bank_id");
$bank_name=array();
$xcap_bank=mysql_num_rows($rs_bank_cap);
for($cap=0;$cap<$xcap_bank;$cap++)
$bank_name[$cap]=mysql_result($rs_bank_cap,$cap,'bank_id');
//print_r($bank_name);
*/

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
if($_POST["all"]==1)
$rs_emp=mysql_query("select *from tb_arcitive_salary where year=$_POST[year] and month=$_POST[month]  order BY name ");
else
$rs_emp=mysql_query("select *from tb_arcitive_salary where year=$_POST[year] and month=$_POST[month] and bank_id=$_POST[bank] order BY name ");
$xemp=mysql_num_rows($rs_emp);

$xemp1=$xemp;
$rcount=$xemp/22;
if($rcount >1 && $rcount <=2 )
$num_page=2;
else
$num_page=round(($rcount+1),0);
$rpt=0;

$xi=0;
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
		<table border="0" width="100%" id="table6" dir="ltr">
			<tr>
				<td colspan="3">
				<p align="center">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>LATD TECHNOLOGY<br>
				SALARY ARCHIVE REPORT </b></td>
			</tr>
			<tr>
				<td nowrap width="36%"><font size="4"><b>Center</b></font><b><font size="4"> :<?php 
				$rs_bank=mysql_query("select *from lk_bank where id=$_POST[bank]");
				if($_POST["all"]==1)
				echo "كل المراكز";
				echo @mysql_result($rs_bank,0,'name');

				?></font></b></td>
				<td width="40%">
				<p align="left"><font size="2"><b>Date</b></font><b><font size="2">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="left"><?
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
Date_conf_Now();
?></td>
			</tr>
		</table>
		</td>
	</tr>
<?php 
for($g=0;$g<$num_page;$g++){ ?>
	<tr>
		<td>
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" dir="ltr" >
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%">
		<font size="2"><b>#</b></font><td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="6%">
		<p align="center"><font size="2"><b>Employee</b></font><td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Basic</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Housing</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Children</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Work</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Mobile</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Department</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Appearance</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Capital</b></font><b><font size="2"> </font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Tension</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Rewards</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Salary Allowance</b></font>&nbsp;</td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Addition</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Total Salary</b></font>&nbsp;</td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Taxes</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Stamp</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Insurance</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Advances</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Charity</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Sanctions</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Total Discount</font></b>&nbsp;</td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Net Salary</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Signature</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		&nbsp;</td>
	</tr>
	<?php 	
	if($g==0)
	{
	if($xemp < 22)
$rptcemp=$xemp;
else
	$rptcemp=22;
}
	else
	{
	if($xemp==22)
	$rptcemp=$xemp-22;
	else
	if($xemp >22)
	$rptcemp=$xemp%22;
	$rptcemp=$rptcemp+22;
	}
	
//	echo "<br>"."<font color=$000000>".$rptcemp."</font>"."<br>";


	for($i=$rpt;$i<$rptcemp;$i++){
	///////////////////////////////////////////
$name=@mysql_result($rs_emp,$i,'name');

$bsal=@mysql_result($rs_emp,$i,'bsal');
$sumbsal=@$sumbsal+round($bsal,2);

$home=@mysql_result($rs_emp,$i,'home');
$sumhome=@$sumhome+round($home,2);

$child=@mysql_result($rs_emp,$i,'child');
$sumchild=@$sumchild+$child;

$work=@mysql_result($rs_emp,$i,'work');
$sumwork=@$sumwork+round($work,2);


$phone=@mysql_result($rs_emp,$i,'phone');
$sumphone=@$sumphone+round($phone,2);

$manager=@mysql_result($rs_emp,$i,'manager');
$summanager=@$summanager+round($manager,2);

$net=@mysql_result($rs_emp,$i,'net');
$sumnet=@$sumnetnet+round($net,2);

$cloth=@mysql_result($rs_emp,$i,'cloth');
$sumcloth=@$sumcloth+round($cloth,2);

$capit=@mysql_result($rs_emp,$i,'capit');
$sumcapit=@$sumcapit+round($capit,2);

$tens=@mysql_result($rs_emp,$i,'tens');
$sumtens=@$sumtens+round($tens,2);

$bonse=@mysql_result($rs_emp,$i,'bonse');
$sumbonse=@$sumbonse+round($bonse,2);

$difrent=@mysql_result($rs_emp,$i,'difrent');
$sumdifrent=@$sumdifrent+round($difrent,2);

$add20=@mysql_result($rs_emp,$i,'add20');
$sumadd20=@$sumadd20+round($add20,2);

$totalsal=@mysql_result($rs_emp,$i,'totalsal');
$sumtotalsal=@$sumtotalsal+round($totalsal,2);

$tax=@mysql_result($rs_emp,$i,'tax');
$sumtax=@$sumtax+round($tax,2);

$dams=@mysql_result($rs_emp,$i,'dams');
$sumdams=@$sumdams+round($dams,2);

$tameen=@mysql_result($rs_emp,$i,'tameen');
$sumtameen=@$sumtameen+round($tameen,2);

$loan=@mysql_result($rs_emp,$i,'loan');
$sumloan=@$sumloan+round($loan,2);

$khairya=@mysql_result($rs_emp,$i,'khairya');
$sumkhairya=@$sumkhairya+round($khairya,2);

$cuts=@mysql_result($rs_emp,$i,'cuts');
$sumcuts=@$sumcuts+round($cuts,2);

$totalcuts=@mysql_result($rs_emp,$i,'totalcuts');
$sumtotalcuts=@$sumtotalcuts+round($totalcuts,2);

$emp_salary=@mysql_result($rs_emp,$i,'emp_salary');
$sumemp_salary=@$sumemp_salary+round($emp_salary,2);

/**********************نهاية*************************/

if(@mysql_result($rs_emp,$i,'name')!=""){
$counter=$i+1;
		?>
	<tr  bgcolor="<?php if ($counter % 2==0) echo "#666666"; else echo "#FFFFFF"; ?>">
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%" height="0">
		<p align="center"><span lang="ar-sa"><font size="2"><?php echo $counter;?></font></span><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="7%" height="0">
		<font size="1">
		<?php echo $name;?></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $bsal; ?>
		</font>
		</td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $home; ?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $child; 		?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$work,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $phone;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo round(@$manager,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo $net;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $cloth;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $capit;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $tens;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
	<font size="2">
	<?php echo $bonse;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $difrent;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="0%">
		<?php echo $add20;?></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $totalsal;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$tax,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="0%">
	<font size="2">	<?php echo $dams;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$tameen,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2"><?php echo $loan;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $khairya;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2"><?php echo $cuts;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo $totalcuts;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo $emp_salary;?></font></b></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		</td>
		</tr>
			<?php
			$xi=$xi+1;
			}
			 }
			
			?>
		
<?php 

if($xemp1==$xi){
?>	
		<tr>
		
		<td bgcolor="#FFFFFF" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="10%" colspan="2">
		<b>Total</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumbsal;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumhome;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumchild;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumwork;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumphone;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $summanager;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumnet;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b>
		<font size="2"><?php echo $sumcloth;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumcapit;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumtens;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
	<b><font size="2">
	<?php echo $sumbonse;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo $sumdifrent;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<?php echo $sumadd20;?></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php 
		echo $sumtotalsal;
		?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo $sumtax;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo $sumdams;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumtameen;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumloan;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumkhairya;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumcuts;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumtotalcuts;?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="3%" colspan="2">
		<b><font size="2">
		<?php 
		

		echo $sumemp_salary;?></font></b></td>
		</tr>
<?php }?>
						
		</table>
		</tb></td>
	</tr>
<?php 
$rpt=$rpt+22;
$xemp=$xemp%22;
}
?>
</table>
<div align="right">
<table width="100" dir=rtl style="border-collapse: collapse" id="table7">
		</table>
	</div>
	</div>
</form>

</body>
<?php }
else
header ("location: login.php");
?>