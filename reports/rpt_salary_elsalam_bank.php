<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");
$sum_totsal=0;
/* ----------------------Day Report-----------------------------*/
	$month=$_POST["month"];
	$year=$_POST["year"];
	
if($month==02)
$day=28;
else
$day=30;
	
	$rptdate=$year."-".$month."-".$day;
	$date=$year."-".$month."-"."1";
	$datehol=$rptdate;
/* ---------------------------------------------------*/
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 and bank_id=1 order BY name  ");
$xemp=mysql_num_rows($rs_emp);
	$rs_holyc=mysql_query("SELECT count(id)as emphol FROM tb_holiy_emp WHERE 	 hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
$xemp=$xemp-mysql_result($rs_holyc,0,'emphol');

$xemp1=$xemp;
$rcount=$xemp/27;
//echo $rcount;
//5.03333333333 
if($rcount >1 && $rcount <=2 )
$num_page=2;
else
$num_page=round(($rcount+1),0);
//echo $num_page;
$rpt=0;
//echo $num_page;

//if ($xemp % 30==0)
//$num_page++;
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
				<p align="center">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b><br>
				&nbsp;</b></td>
\\\\
			</tr>
			<tr>
				<td nowrap width="36%">&nbsp;</td>
				<td width="40%">
				<p align="left"><b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
				<td width="22%" height="0" style="font-size: 11pt" align="left">
				<b><?
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
?></b></td>
			</tr>
		</table>
		</td>
	</tr>
<?php 
$num_page--;
for($g=0;$g<$num_page;$g++){ ?>
	<tr>
		<td>
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" dir="ltr" >
		<td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%">
		<b>#</b><td align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="24%">
		<p align="center"><b><span lang="ar-sa">&nbsp;</span>Employee Name</b><td width="11%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		Job Id</td>
		<td width="21%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>Account Number</b><span lang="ar-sa"><b> </b></span></td>
		<td width="37%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		Net Salary</td>
	</tr>
	<?php 	
	if($g==0)
	{
	if($xemp < 30)
$rptcemp=$xemp;
else
	$rptcemp=30;
}
	else
	{
	if($xemp==30)
	$rptcemp=$xemp-30;
	else
	if($xemp >30)
	$rptcemp=$xemp%30;
	$rptcemp=$rptcemp+30;
	}
	
//	echo "<br>"."<font color=$000000>".$rptcemp."</font>"."<br>";


	for($i=$rpt;$i<$rptcemp;$i++){
	///////////////////////////////////////////
	//////////////الإجازة بدون أجر///////////
	$empholy= @mysql_result($rs_emp,$i,'id');
	$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
	$xholy=@mysql_num_rows($rs_holy);
	if ($xholy == 0 ){
//////////////الإجازة بدون أجر نهاية///////////

	$cat= @mysql_result($rs_emp,$i,'cat_id');
	$emp_id= @mysql_result($rs_emp,$i,'id');
	$status= @mysql_result($rs_emp,$i,'status_id');
	$chaild_count=@mysql_result($rs_emp,$i,'chaild_count');
	$exp_in=@mysql_result($rs_emp,$i,'exp_in');
	$job= @mysql_result($rs_emp,$i,'job_id');
	/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
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
//////حساب الزيادة السنوية حسب سلم الرواتب////////
$expall=$expir_yearin1 + $exp_out;
	$rs_job=mysql_query("select *from lk_jop where id=$job ");
	$exp_job=@mysql_result($rs_job,0,'exp');
	if ($expall <=@$exp_job)
	{
	$exp_out=$expall;
	$expir_yearin1=0;
	}
	elseif($expall > @$exp_job)
	{
	$exp_out=$exp_job;
	$expir_yearin1=$expall - $exp_job;
	}
/////////////////////////////////////////////////////////


	$rs_bsal=mysql_query("select * from tb_salary where cat_id=$cat and exp=$exp_out");

	$sal1=@mysql_result($rs_bsal,0,'bsalary');
	/*******************************/
	$day_sal=($sal1/30);
	$sal_comdate=strtotime($b_date);
	$sal_date=date("Y")."-".date("m")."-"."30";
	$salnow_date=strtotime($sal_date);
	$sal_exp_unix=$now_date-$ex;
	$expir_day=date("d",$sal_exp_unix);
//echo 	$expir_day."<br> ";
//echo $sal_date."      ".$b_date." | ".$expir_day."<br>";
$date_beginwork=explode("-",$b_date);

if(@$date_beginwork[1]==$month && $date_beginwork[0]==$year)
{
$expir_day=$expir_day-1;
$sal1=$day_sal*$expir_day;
}
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
	$sum_sal=@$sum_sal+round($sal1,2);//إجمالي المرتب الأساسي

	if ($status==1){
	$cash_statas=(20 *$sal1)/100;
	$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//إجمالي بدل السكن
}
	elseif($status==2){
	$cash_statas=(15 *$sal1)/100;
		$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//إجمالي بدل السكن
}
	elseif ($status==3){
	$cash_statas=0;
		$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//إجمالي بدل السكن
}
$cash_chaild=0;
			if($chaild_count ==1){
			$cash_chaild=2*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//إجمالي بدل الابناء
}
			if($chaild_count ==2){
			$cash_chaild=4*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//إجمالي بدل الابناء
}
			if($chaild_count ==3){
			$cash_chaild=6*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//إجمالي بدل الابناء
}
			if($chaild_count ==0){
			$cash_chaild=0;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//إجمالي بدل الابناء
}

	$rs_allaw=mysql_query("select *from tb_allow where id=$emp_id");
	$work=@mysql_result($rs_allaw,0,'fl_work');//طبيعة عمل
	if($work==1){
	$work=7*$sal1/100;
		$sum_work=@$sum_work+round($work,2);//إجمالي طبيعة العمل
}
	else
	{
	$work=0;
		$sum_work=@$sum_work+round($work,2);//إجمالي طبيعة العمل
}
	
	
/**********************البدلات*************************/
	$cloth=@mysql_result($rs_allaw,0,'fl_cloth');//بدل لبس

if(@mysql_result($rs_allaw,0,'fl_cloth')!=0 || @mysql_result($rs_allaw,0,'fl_cloth')!="" ){
	$sum_close=@$sum_close+round($cloth,2);//إجمالي بدل لبس
}
	$manager=@mysql_result($rs_allaw,0,'fl_manager');//بدل إدارة
	
if(@mysql_result($rs_allaw,0,'fl_manager')!=0 || @mysql_result($rs_allaw,0,'fl_manager')!="" ){
	$sum_manager=@$sum_manager+round($manager,2);//إجمالي بدل إدارة
}
	$cashequal=@mysql_result($rs_allaw,0,'fl_cashequal');//مكافئه
	
if(@mysql_result($rs_allaw,0,'fl_cashequal')!=0 || @mysql_result($rs_allaw,0,'fl_cashequal')!="" ){
	$sum_cashequal=@$sum_cashequal+round($cashequal,2);//إجمالي المكافئة
	}
	$gravity=@mysql_result($rs_allaw,0,'fl_gravity');//خطورة
	
if(@mysql_result($rs_allaw,0,'fl_gravity')!=0 || @mysql_result($rs_allaw,0,'fl_gravity')!="" ){
	$sum_gravity=@$sum_gravity+round($gravity,2);//إجمالي خطورة
}
	$mobil=@mysql_result($rs_allaw,0,'fl_mobil');//موبايل

if(@mysql_result($rs_allaw,0,'fl_mobil')!=0 || @mysql_result($rs_allaw,0,'fl_mobil')!="" ){
	
	$sum_mobile=@$sum_mobile+round($mobil,2);//إجمالي موبايل
	}
	$tension=@mysql_result($rs_allaw,0,'fl_tension');//توتر
	
if(@mysql_result($rs_allaw,0,'fl_tension')!=0 || @mysql_result($rs_allaw,0,'fl_tension')!="" ){
	$sum_tension=@$sum_tension+round($tension,2);//إجمالي توتر
}
	$capital1=@mysql_result($rs_allaw,0,'fl_capital1');//عاصمة

	if(@mysql_result($rs_allaw,0,'fl_capital1')!=0 || @mysql_result($rs_allaw,0,'fl_capital1')!="" ){

	$sum_capital1=round($capital1,2)+@$sum_capital1;//جملة عاصمة
}
	$sal_differ=@mysql_result($rs_allaw,0,'fl_sal_differ');//فرق راتب

	if($sal_differ !=0 || $sal_differ !="" ){
	$sum_sal_differ=round($sal_differ,2)+@$sum_sal_differ;//جملة فرق راتب
	//echo $sal_differ;
	}
	$add20=@mysql_result(@$rs_allaw,0,'add20'); //الزيادة
	
	if(@mysql_result(@$rs_allaw,0,'add20')!=0 || @mysql_result(@$rs_allaw,0,'add20')=="" ){
	$sum_sal_add20=round($add20,2)+@$sum_sal_add20;//جملة الزيادة
	}

/**********************نهايةالبدلات*************************/

/**********************إجمالي المرتب*************************/
		$totsal=round(@$cloth,2)+round(@$manager,2)+round(@$cashequal,2)+round(@$gravity,2)+round(@$mobil,2)+round(@$tension,2)+round(@$capital1,2)+round(@$sal_differ,2)+round(@$work,2)+round(@$cash_chaild,2)+round(@$cash_statas,2)+round(@$sal1,2)+round(@$add20,2);//جملة الراتب
//		echo $i."<br>";
		//if(@$totsal != "" || @$totsal!=0)
	$sum_totsal=	round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2)+round(@$sum_sal_add20,2);
		//$sum_totsal=$totsal+$sum_totsal;//جملة إجمالي المرتبات
//	echo $sum_totsal."<br>";
/**********************نهاية*************************/
/**********************الإستقطاعات*************************/
$rs_cut=mysql_query("select *from tb_tax where id=$emp_id");

	$charity=@mysql_result($rs_cut,0,'charity');//خصم الجمعية الخيرية
	$sum_charity=@$sum_charity+$charity;
	
	$tax=@mysql_result($rs_cut,0,'tax');//الضريبة
	$sum_tax=@$sum_tax+$tax;
	
	if(@mysql_result($rs_emp,$i,'bank_id')!=20 && @mysql_result($rs_emp,$i,'bank_id')==@1 )
	{
	$tameen=8*$totsal/100;
	//echo $tameen."<br>";
	}
	else
	{
	$tameen=0.00;
	}
	//$sum_tameen=$sum_tameen+$tameen;
	$sum_tameen=@$sum_tameen+round($tameen,2);
	
	/*---------------------------الدمغة---------------------*/
	if(@mysql_result($rs_emp,$i,'bank_id')!=20 && @mysql_result($rs_emp,$i,'bank_id')==1)
	$stamp=1;
	else
	$stamp=0;
		if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_stamp=@$sum_stamp+@$stamp;
/*---------------------------نهايةالدمغة---------------------*/

/**********************نهاية*************************/
/*--------------------السلفيات-----------------------*/
$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' ");
$xlone=@mysql_num_rows($rs_lone);
$total_lone=0;
for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;
}
$sum_lone=round($total_lone,2)+@$sum_lone;
/*--------------------End---------------------------*/
/*--------------------الجزاءات-----------------------*/

	$rs_san=mysql_query("select *from tb_emp_sanctions where emp_id=$emp_id and san_date >=  '$date' and san_date <='$rptdate' ");
	$xsan=@mysql_num_rows($rs_san);
	$cut_daycash=0;
	$sal_day=$sal1/30;
for($s=0;$s<$xsan;$s++){
$sanitem_id=@mysql_result($rs_san,$s,'sanitem_id');
$rs_sanitem=mysql_query("select *from tb_sanctionsitem where id=$sanitem_id and discount=1");
$cut_daycash=$cut_daycash+($sal_day *@mysql_result($rs_sanitem,0,'discount_day')) ;//حساب خصم الجزاءات
}
$sum_cut=@$sum_cut+round($cut_daycash,2);
/*--------------------End---------------------------*/


/**********************جملة الاستقطاعات*************************/
$total_dis=$tameen+$tax+$charity+$total_lone+$stamp+$cut_daycash;
	$sum_des=@$sum_des+round($total_dis,2);
/**********************نهاية*************************/

/**********************صافي المرتب *************************/
if(@mysql_result($rs_emp,$i,'bank_id')==1){
	$Nbs=$totsal-$total_dis;
	$sum_safee=@$sum_safee+$Nbs;
	}
	//echo $sum_safee;
/**********************نهاية*************************/

if(@mysql_result($rs_emp,$i,'name')!=""){
$counter=$i+1;
		?>
	<tr  bgcolor="<?php if ($counter % 2==0) echo "#666666"; else echo "#FFFFFF"; ?>">
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%" height="0">
		<p align="center"><span lang="ar-sa"><?php echo $counter;?></span><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="24%" height="0">
		<?php echo @mysql_result($rs_emp,$i,'name');?><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="11%">
		<?php echo @mysql_result($rs_emp,$i,'emp_number');?>
		</td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="21%">
		<?php echo @mysql_result($rs_emp,$i,'acc_bank');?></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="37%">
		<b>
		<?php echo number_format(round(@$Nbs,2),2,'.',', ');?></b></td>
		</tr>
			<?php
			$xi=$xi+1;
			}
			 }
			 }
			
			?>
			
</table>
		
<?php 
//$xi=$xi+1;
//echo $xi;
if($xemp1==$xi){
?>	
<!--tr>
<td bgcolor="#FFFFAE" style="border-left-style: solid; border-left-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo $counter+1;?></td>
<td bgcolor="#FFFFAE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><span lang="ar-sa">سلمى سيد محمد محجوب</span></td>
<td bgcolor="#FFFFAE" align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">6161</td>
<td bgcolor="#FFFFAE" align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">13209</td>
<td bgcolor="#FFFFAE" align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">5,000</td>

</tr-->
<table width="100%" dir="ltr">		<tr>
		
		<td bgcolor="#FFFFFF" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="59%" colspan="4">
		<b>Total</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="37%">
		<b><font size="2">
		<?php 
		
  $sum_safee=@$sum_safee;//+ 5000;
		echo number_format(round(@$sum_safee,2),2,'.',', ');?></font></b></td>
		</tr>
		

<?php }?>
						
		</table>
		</tb></td>
	</tr>
<?php 
$rpt=$rpt+30;
$xemp=$xemp%30;
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