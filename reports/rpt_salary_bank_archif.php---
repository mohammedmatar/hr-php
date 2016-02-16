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
		<table border="0" width="100%" id="table6">
			<tr>
				<td colspan="3">
				<p align="center"><font face="Arabic Transparent">بسم الله 
				الرحمن الرحيم</font></td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				<img border="0" src="../images/logo.gif" width="101" height="96"></td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b>قناة الشروق الفضائية<br>
				تقرير <span lang="ar-sa">إرشيف </span>المرتبات بتاريخ : 
				<?php echo $rptdate;?>
&nbsp;</b></td>
			</tr>
			<tr>
				<td nowrap width="36%"><b><font size="4">المركز :<?php 
				$rs_bank=mysql_query("select *from lk_bank where id=$_POST[bank]");
				echo @mysql_result($rs_bank,0,'name');

				?></font></b></td>
				<td width="40%">
				<p align="left"><b><font size="2">التاريخ اليوم:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="left"><?
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
<?php 
for($g=0;$g<$num_page;$g++){ ?>
	<tr>
		<td>
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" >
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%">
		<b><span lang="ar-sa"><font size="2">رقم</font></span></b><td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="6%">
		<p align="center"><b><font size="1">الموظف</font></b><td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">أساسي</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">سكن</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">ابناء</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">عمل</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">موبايل</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">إدارة</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>نت</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>مظهر</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">عاصمة </font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">توتر</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">مكاف<span lang="ar-sa">أ</span>ة</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">فرق راتب</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">جملة راتب</font></b></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">ضرائب</font></b></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b><font size="2">دمغة</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">تأمين</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">سلفيات</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">ج خيرية</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">جزاءات</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">جملة الاستقطاع</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">صافي المرتب</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">التوقيع</font></b></td>
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
		<b>الإجمـــالي</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
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
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo $sumdifrent;?></font></b></td>
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