<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");

if(!empty($_POST["sec_id"]))
{
$rs_ss=mysql_query("select *from tb_section where id=$_POST[sec_id]");
$rp_name=mysql_result($rs_ss,0,'name');
}


if(!empty($_POST["job"]))
{
$rs_ss=mysql_query("select *from lk_jop where id=$_POST[job]");
$rp_name=mysql_result($rs_ss,0,'name');

}

?>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo date("Y/m/d H:i:s");?></title>

</head>

<body>

<form method="POST" action="">
	<div align="center">

<table style="border-style:solid; border-width:0; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" id="table5">
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
				<span lang="ar-sa">التقرير العام</span></b></td>
			</tr>
			<tr>
				<td nowrap width="36%"><b><?php  if(!empty($_POST["end"])) echo " &nbsp;&nbsp;&nbsp; تقرير العقودات المنتهية &nbsp;&nbsp; ";  if($_POST["D1"]==2) echo "     حسب القسم&nbsp;&nbsp;"; if($_POST["D1"]==3) echo "      حسب الوظيفة"; ?><font color= #CC3300><?php echo "&nbsp;&nbsp;".@$rp_name."&nbsp;&nbsp;";?></font></b></td>
				<td width="40%">
				<p align="left"><b><font size="2">التاريخ:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
	<tr>
		<td>
		<table   style="border-style:solid; border-width:1px; page-break-after:always; border-collapse:collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" cellpadding="0" >
		<td bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b><span lang="ar-sa"><font size="2">رقم</font></span></b></td>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<p align="center"><b><font size="1">الموظف</font></b>
		<?php if(!empty($_POST["emp_id"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الرقم الوظيفي</b></font></td><?php }?>
		<?php if(!empty($_POST["sex"])){?>

		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>النوع</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["bdate"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الميلاد</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["address"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>العنوان</b></font></td><?php }?>
			<?php if(!empty($_POST["phone1"])){?>

		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>التلفون(1)</b></font></td><?php }?>
			<?php if(!empty($_POST["phone2"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>التلفون (2)</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["tameen_no"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>رقم التأمين</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["tameen_date"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>تاريخ التأمين</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["status"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الحالة الإجتماعية</b></font><b><font size="1"> </font></b></td><?php }?>
			<?php if(!empty($_POST["chield"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>عدد الابناء</b></font></td>
		<?php }?>
			<?php if(!empty($_POST["work"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>مركز العمل</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["bank"])){ ?>

		<td height="0" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>مركز الصرف</b></font></td><?php }?>
		<?php if(!empty($_POST["acc"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>رقم الحساب</b></font></td><?php }?>
		<?php if(!empty($_POST["begindate"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>تاريخ التعيين</b></font></td><?php }?>
		
			<?php if(!empty($_POST["comedate"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>ت.مباشرة العمل</b></font></td><?php }?>
			<?php if(!empty($_POST["section"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>القسم</b></font></td><?php }?>
		
			<?php 	if(!empty($_POST["job1"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الوظيفة</b></font></td><?php }?>
		
			<?php if(!empty($_POST["class"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الفئة</b></font></td>
		<?php }?>
		
	<?php if(!empty($_POST["expout"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الخبرة العملية</b></font></td>
		<?php }?>
		
			<?php if(!empty($_POST["expin"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>الخبرة داخل القناة</b></font></td>
		
		
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>بالشهور</b></font></td><?php }?>
		<?php if(!empty($_POST["end"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>تاريخ نهاية الخدمة</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["holy"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>رصيد الإجازة السنوية</b></font></td>
		<?php }?>
	</tr>
	<?php 	
		mysql_query("SET NAMES 'utf8'");
		$y1=date("Y");		
		$m1=date("m");
		$d1=date("d");	
		$y1=$y1-2;
		$ydm=$y1."-".$m1."-".$d1;
				

		
if(!empty($_POST["sec_id"]))
{
$rs=mysql_query("select *from tb_employee where section_id =$_POST[sec_id] and des_salary=1 order by name ");
$rs_ss=mysql_query("select *from tb_section where id=$_POST[sec_id]");
$rp_name=mysql_result($rs_ss,0,'name');
}


if(!empty($_POST["job"]))
{
$rs=mysql_query("select *from tb_employee where job_id=$_POST[job] and des_salary=1 order by name");
$rs_ss=mysql_query("select *from lk_jop where id=$_POST[job]");
$rp_name=mysql_result($rs_ss,0,'name');


}
if($_POST["D1"]==1)
	{
	$rs=mysql_query("select *from tb_employee where  des_salary=1 order by name");
	$rp_name="كل الموظفين والعاملين";

	}

$x=@mysql_num_rows($rs);
for($i=0;$i<@$x;$i++){
$beg_date=mysql_result($rs,$i,'begin_date');
$alldate=explode("-",$beg_date);
$yy= $alldate[0];
$mm= $alldate[1];
$dd= $alldate[2];
$enddate=mktime(0,0,0,$mm,$dd,$yy + 2);
$endof_date=date('Y-m-d',$enddate);

$counter=$i+1;
		?>
	<tr>
	<td><font size="2"><?php echo @$counter;?></font></td>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
	<font size="2">
	<?php echo @mysql_result($rs,$i,'name');?>
	<?php if(!empty($_POST["emp_id"])){?>
	</font>
	<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php  echo mysql_result($rs,$i,'emp_number');?></font></td><?php }?>
	<?php if(!empty($_POST["sex"])){?>
	<td  <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<font size="2">
	<?php $sex_id=mysql_result($rs,$i,'sex');
	if($sex_id==1) echo "ذكر"; else echo "أنثى";
	?></font></td>
		<?php }?>
				<?php if(!empty($_POST["bdate"])){?>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'bdate');?></font></td><?php }?>
		<?php if(!empty($_POST["address"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'fulladdress');?></font></td><?php }?>
	
	<?php if(!empty($_POST["phone1"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'phone1');?></font></td><?php }?>
			<?php if(!empty($_POST["phone2"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'phone2');?></font></td><?php } ?>
			<?php if(!empty($_POST["tameen_no"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'phone3');?></font></td><?php }?>
		
		<?php if(!empty($_POST["tameen_date"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'tameen_date');?></font></td><?php }?>
		<?php if(!empty($_POST["status"])){?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php $st_id=mysql_result($rs,$i,'status_id'); if($st_id==2) echo "عازب"; else echo "متزوج"; ?></font></td><?php }?>
		<?php if(!empty($_POST["chield"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'chaild_count');?></font></td><?php }?>
		
		<?php if(!empty($_POST["work"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
<font size="2">
<?php $work_id= mysql_result($rs,$i,'work_id'); 
$rs_work=mysql_query("select *from lk_work where id=$work_id"); echo mysql_result($rs_work,0,'name');
?></font></td><?php }?>
		<?php if(!empty($_POST["bank"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php $sarf_id= mysql_result($rs,$i,'bank_id'); 
$rs_sarf=mysql_query("select *from lk_bank where id=$sarf_id"); echo mysql_result($rs_sarf,0,'name');
?></font></td><?php }?>
</td>
<?php if(!empty($_POST["acc"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<font size="2">
	<?php echo mysql_result($rs,$i,'acc_bank');?></font></td><?php }?>
	
			<?php if(!empty($_POST["begindate"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'come_date');?></font></td><?php }?>
		
	<?php if(!empty($_POST["comedate"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<font size="2">
	<?php 	echo mysql_result($rs,$i,'begin_date');?></font></td><?php }?>
	
	<?php if(!empty($_POST["section"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php $section_id= mysql_result($rs,$i,'section_id'); 
$rs_sec=mysql_query("select *from tb_section where id=$section_id"); echo mysql_result($rs_sec,0,'name');
?></font></td><?php }?>

	<?php if(!empty($_POST["job1"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php $job_id= mysql_result($rs,$i,'job_id'); 
$rs_job=mysql_query("select *from lk_jop where id=$job_id"); echo mysql_result($rs_job,0,'name');
?></font></td><?php }?>

	<?php if(!empty($_POST["class"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php $cat= mysql_result($rs,$i,'cat_id'); 
$rs_cat=mysql_query("select *from lk_cat where id=$cat"); echo mysql_result($rs_cat,0,'name');
?></font></td><?php }?>

	<?php if(!empty($_POST["expout"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php echo mysql_result($rs,$i,'exp_out');?></font></td><?php }?>

			<?php if(!empty($_POST["expin"])){ ?>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<font size="2">
		<?php 
		/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
$rptdate=date('Y-m-d');
$b_date=@mysql_result($rs,$i,'begin_date');
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
	echo $expir_yearin1;
	
	?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
<?php $expir_month=date("m",$exp_unix);
$expir_day=date("d",$exp_unix);
if ($expir_day <14 )
$expir_month--;
	//echo $expir_month;
	echo ($expir_yearin1*12)+$expir_month;
	?>
	</td>
	<?php }?>
	<?php if(!empty($_POST["end"])){
?>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<span style="<?php if(date('Y-m-d',$enddate)> date('Y-m-d') ) echo "background-color: #FF0000";?>"><?php echo date('Y-m-d',$enddate);?>	
	</span>	</td><?php }?>
		<?php if(!empty($_POST["holy"])){
		$emp_id=mysql_result($rs,$i,'id');
		///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////
		$holiy_type=4;
//echo 'Info : '.$_POST["holiy_type"];
mysql_query("SET NAMES 'utf8'");
$year_tody= date("Y");
$rptdate=date("Y-m-d");

if(!empty($holiy_type) ){
	$year_hol=date('Y');
	if(!empty($_GET["id"])){
		$notCalcThisHolday = ' and id <> '.$_GET["id"];
	}else $notCalcThisHolday = '';
	
	$days_emp_holiyday=0;
	if($holiy_type != 4){
		$rs_holiycheck=mysql_query("select * from lk_holiday where id=$holiy_type");
		$holiydays=mysql_result($rs_holiycheck,0,'days');
		$query = 'select * from tb_holiy_emp where emp_id='.$_GET["emp_id"].' and hol_id= '.$holiy_type.' and year= '.$year_hol.' '.$notCalcThisHolday;
		
		$rs_searchholiyemp=mysql_query($query);
		if($rs_searchholiyemp)
			$xsearchholiy=mysql_num_rows($rs_searchholiyemp);
		if($xsearchholiy>0){
			for($e=0;$e<$xsearchholiy;$e++){
				$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
			}
		}
		$available_holiyday=$holiydays-$days_emp_holiyday;
	}else{
	$rs_empsection=mysql_query("select * from tb_employee where id=$emp_id");
	$job_id=mysql_result($rs_empsection,0,'job_id');
	/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
	$b_date=@mysql_result($rs_empsection,0,'begin_date');
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
	/*----------------حساب أيام الإجازة حتى اليوم-----------------*/
	
	$comming_date1=mysql_result($rs_empsection,0,'begin_date');
	//echo mysql_result($rs_empsection,0,'begin_date');
	$begin_year1=explode("-",$comming_date1);
	$exip_year=$year_tody - $begin_year1[0]; //سنوات العمل داخل القناة
	
	$expir_yearin1++;
	//echo  $expir_yearin1; 
	//$rs_job=mysql_query("select *from lk_jop where id=$job_id");
	//$holiydays=mysql_result($rs_job,0,'holiday')*  $expir_yearin1;
	/*----------------  أيام الإجازة حتى اليوم-----------------*/
	$rs_job=mysql_query("select * from lk_jop where id=$job_id");
	$hol_daies = mysql_result($rs_job,0,'holiday');
	$holiydays= $hol_daies * $expir_yearin1;
	
	//$rs_holiycheck=mysql_query("select *from lk_holiday where id=$_POST[holiy_type]");
	//$holiydays=mysql_result($rs_holiycheck,0,'days');
    //$rs_searchholiyemp=mysql_query("select *from tb_holiy_emp where emp_id=$_SESSION[emp_id] and hol_id=$_POST[holiy_type] and year=$year_hol");
	$rs_searchholiyemp=mysql_query("select sum(hol_day) as takeDaies from tb_holiy_emp where emp_id=$emp_id and hol_id=$holiy_type ");
	$days_emp_holiyday = mysql_result($rs_searchholiyemp,0,'takeDaies');
	if(empty($days_emp_holiyday))
	  $days_emp_holiyday = 0;
	/*if($rs_searchholiyemp)
		$xsearchholiy = mysql_num_rows($rs_searchholiyemp);
	if($xsearchholiy>0){
		for($e=0;$e<$xsearchholiy;$e++){
			$days_emp_holiyday=$days_emp_holiyday+mysql_result($rs_searchholiyemp,$e,'hol_day');
		}
	}*/
	$available_holiyday=$holiydays-$days_emp_holiyday;
	}

}

		
		
		?>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<span lang="en-us"><?php echo @$available_holiyday;?></span></td>
	<?php }?>
		</tr>
		<?php }?>
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