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
				<p align="center">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center">LATD TECHNOLOGY GENERAL REPORT</td>
			</tr>
			<tr>
				<td nowrap width="36%"><b><?php  if(!empty($_POST["end"])) echo " &nbsp;&nbsp;&nbsp; تقرير العقودات المنتهية &nbsp;&nbsp; ";  if($_POST["D1"]==2) echo "     حسب القسم&nbsp;&nbsp;"; if($_POST["D1"]==3) echo "      حسب الوظيفة"; ?><font color= #CC3300><?php echo "&nbsp;&nbsp;".@$rp_name."&nbsp;&nbsp;";?></font></b></td>
				<td width="40%">
				<p align="left">Date<b><font size="2">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
	<tr>
		<td>
		<table   style="border-style:solid; border-width:1px; page-break-after:always; border-collapse:collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" cellpadding="0" >
		<td bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>#</b></font></td>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<p align="center"><font size="2">Employee
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2">Job Id</td>
		<?php if(!empty($_POST["sex"])){?>

		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Gender</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["bdate"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Birth date</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["address"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Address</b></font></td><?php }?>
			<?php if(!empty($_POST["phone1"])){?>

		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Phone(1)</b></font></td><?php }?>
			<?php if(!empty($_POST["phone2"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Phone(2)</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["tameen_no"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Insurance Number</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["tameen_date"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Insuerance Date</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["status"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Social Status</b></font><b><font size="1"> </font></b></td><?php }?>
			<?php if(!empty($_POST["chield"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Children</b></font></td>
		<?php }?>
			<?php if(!empty($_POST["work"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Work Center</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["bank"])){ ?>

		<td height="0" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Exchange Center</b></font></td><?php }?>
		<?php if(!empty($_POST["acc"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Account Number</b></font></td><?php }?>
		<?php if(!empty($_POST["begindate"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Hiring Date</b></font></td><?php }?>
		
			<?php if(!empty($_POST["comedate"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Work Start Date</b></font></td><?php }?>
			<?php if(!empty($_POST["section"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Department</b></font></td><?php }?>
		
			<?php 	if(!empty($_POST["job1"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Job</b></font></td><?php }?>
		
			<?php if(!empty($_POST["class"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Category</b></font></td>
		<?php }?>
		
	<?php if(!empty($_POST["expout"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Practical Experience</b></font></td>
		<?php }?>
		
			<?php if(!empty($_POST["expin"])){ ?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Exp-Within the Company</b></font></td>
		
		
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>In Months</b></font></td><?php }?>
		<?php if(!empty($_POST["end"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>End of Service Date</b></font></td>
		<?php }?>
		<?php if(!empty($_POST["holy"])){?>
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Innual Vacation Balance</b></font></td>
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
	
	if(!empty($_POST["rptdis"]))
	{
	$rs=mysql_query("select *from tb_employee where  des_salary=0 order by name");
	$rp_name="كل الموظفين الذين تم إنهاء خدمتهم";

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
$emp_id=mysql_result($rs,$i,'id');
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
	//echo $expir_yearin1;
	
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
		
		///////////////////////////حساب عدد ايام الاجازة المتبقية/////////////////////////
		$holiy_type=4;
//echo 'Info : '.$_POST["holiy_type"];
mysql_query("SET NAMES 'utf8'");
 $rs_emp=mysql_query("select *from tb_employee where id=$emp_id"); 
$row1=mysql_fetch_array($rs_emp);
$job_id=$row1[18];
///////////// الخبرة العملية داخل قناة الشروق ///////////////////
	$b_date=$row1[15];
	$p_date=$row1[35];
	if($p_date!="0000-00-00")
	$b_date=$p_date;
	
		if($b_date!="0000-00-00"){
			$rptdate=date("Y-m-d");
			$ex=strtotime($b_date);
			$now_date=strtotime($rptdate);
			$exp_unix=$now_date-$ex;
			$expir_yearin=date("Y",$exp_unix);
			$expir_yearin1=$expir_yearin-1970;
		}else
			$expir_yearin1=0;
	 $expir_yearin1++;
	// echo  $expir_yearin1;
		///////////////////////////////////////////////////////////////
	
	///////////////////////////////حساب الإجازة السنوية /////////////
				///ايام الإجازة حتى الآن///
				if($p_date!="0000-00-00")
				{
				$rsbalance=mysql_query("select *from tp_promotion where emp_id=$emp_id order by id desc limit 1");
				$balance=mysql_result($rsbalance,0,'holybalance');
				
				$rsholyjob=mysql_query("select *from lk_jop where id=$job_id");
				$holyday=mysql_result($rsholyjob,0,'holiday');
				
				$blanceholyday=($expir_yearin1 * $holyday)  + $balance;	
		
					}
				else
				{
				$rsholyjob=mysql_query("select *from lk_jop where id=$job_id");
				$holyday=mysql_result($rsholyjob,0,'holiday');
				$blanceholyday=$expir_yearin1 * $holyday;
				
				}
			
				/*******************/
				// حساب الإجازات المستحقة//
				if($p_date=="0000-00-00"){
				$rs_holy=mysql_query("select sum(hol_day) as Sumdays from tb_holiy_emp where emp_id=$emp_id and hol_id=4");
				$holysum=mysql_result($rs_holy,0,'Sumdays');
			    $holybalance=$blanceholyday - $holysum;
			    }
			    else
			    {
			    $year=explode("-",$p_date);
			    $year=$year[0];
			    $rs_holy=mysql_query("select sum(hol_day) as Sumdays from tb_holiy_emp where emp_id=$emp_id and hol_id=4 and year >=$year");
				$holysum=mysql_result($rs_holy,0,'Sumdays');
			    $holybalance=$blanceholyday - $holysum;

			    }
				$available_holiyday = $holybalance;
				/**********************/
				


		
		
		?>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<span lang="en-us"><?php echo @$available_holiyday;?></span></td>
	<?php }?>
		</tr>
		
					</table>
		</tb></td>
	</tr>

</table>
	</div>
</form>

</body>
<?php 

}
}
else
header ("location: login.php");
?>