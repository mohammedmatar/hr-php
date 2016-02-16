<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){

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
$rs_emp=mysql_query("select *from tb_employee   where des_salary=1 and id=$_GET[id]  order BY name  ");
$xemp=mysql_num_rows($rs_emp);
$rcount=$xemp/20;
if($rcount >1 && $rcount <=2 )
$num_page=2;
else
$num_page=round(($rcount+1),0);
$rpt=0;
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
				<td>
				<p align="center">&nbsp;</td>
			</tr>
			<tr>
				<td>
				<p align="center">
				&nbsp;</td>
			</tr>
			<tr>
				<td style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><b><br>
				LATD TECHNOLOGY </b>
				<p align="center"><font size="4"><b>TOTAL SALARY CARD</b></font><p align="center">&nbsp;</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		<table  style="page-break-after:always; border-collapse:collapse" cellpadding="0" width="975" >
		
	</tr>
	<?php 	
	
	
//	echo "<br>"."<font color=$000000>".$rptcemp."</font>"."<br>";
	
	//////////////الإجازة بدون أجر///////////
	$empholy= @mysql_result($rs_emp,0,'id');
	$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
	$xholy=@mysql_num_rows($rs_holy);
	if ($xholy == 0 ){
//////////////الإجازة بدون أجر نهاية///////////

	///////////////////////////////////////////
	$cat= @mysql_result($rs_emp,0,'cat_id');
	$job= @mysql_result($rs_emp,0,'job_id');
	$emp_id= @mysql_result($rs_emp,0,'id');
	$status= @mysql_result($rs_emp,0,'status_id');
	$chaild_count=@mysql_result($rs_emp,0,'chaild_count');
	$exp_in=@mysql_result($rs_emp,0,'exp_in');
	/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
	$b_date=@mysql_result($rs_emp,0,'begin_date');
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
	$exp_out=@mysql_result($rs_emp,0,'exp_out');
	
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

if(@mysql_result($rs_allaw,0,'fl_cloth')!=0 || @mysql_result($rs_allaw,0,'fl_cloth')=="" ){
	$sum_close=@$sum_close+round($cloth,2);//إجمالي بدل لبس
}
	$manager=@mysql_result($rs_allaw,0,'fl_manager');//بدل إدارة
	
if(@mysql_result($rs_allaw,0,'fl_manager')!=0 || @mysql_result($rs_allaw,0,'fl_manager')=="" ){
	$sum_manager=@$sum_manager+round($manager,2);//إجمالي بدل إدارة
}
	$cashequal=@mysql_result($rs_allaw,0,'fl_cashequal');//مكافئه
	
if(@mysql_result($rs_allaw,0,'fl_cashequal')!=0 || @mysql_result($rs_allaw,0,'fl_cashequal')=="" ){
	$sum_cashequal=@$sum_cashequal+round($cashequal,2);//إجمالي المكافئة
	}
	$gravity=@mysql_result($rs_allaw,0,'fl_gravity');//خطورة
	
if(@mysql_result($rs_allaw,0,'fl_gravity')!=0 || @mysql_result($rs_allaw,0,'fl_gravity')!="" ){
	$sum_gravity=@$sum_gravity+round($gravity,2);//إجمالي خطورة
}
	$mobil=@mysql_result($rs_allaw,0,'fl_mobil');//موبايل

if(@mysql_result($rs_allaw,0,'fl_mobil')!=0 || @mysql_result($rs_allaw,0,'fl_mobil')=="" ){
	
	$sum_mobile=@$sum_mobile+round($mobil,2);//إجمالي موبايل
	}
	$tension=@mysql_result($rs_allaw,0,'fl_tension');//توتر
	
if(@mysql_result($rs_allaw,0,'fl_tension')!=0 || @mysql_result($rs_allaw,0,'fl_tension')=="" ){
	$sum_tension=@$sum_tension+round($tension,2);//إجمالي توتر
}
	$capital1=@mysql_result($rs_allaw,0,'fl_capital1');//عاصمة

	if(@mysql_result($rs_allaw,0,'fl_capital1')!=0 || @mysql_result($rs_allaw,0,'fl_capital1')=="" ){

	$sum_capital1=round($capital1,2)+@$sum_capital1;//جملة عاصمة
}
	$sal_differ=@mysql_result($rs_allaw,0,'fl_sal_differ');//فرق راتب



	
	if(@mysql_result(@$rs_allaw,0,'fl_sal_differ')!=0 || @mysql_result(@$rs_allaw,0,'fl_sal_differ')=="" ){
	$sum_sal_differ=round($sal_differ,2)+@$sum_sal_differ;//جملة فرق راتب
	}
	
	$add20=@mysql_result(@$rs_allaw,0,'add20'); //الزيادة
	
	if(@mysql_result(@$rs_allaw,0,'add20')!=0 || @mysql_result(@$rs_allaw,0,'add20')=="" ){
	$sum_sal_add20=round($add20,2)+@$sum_sal_add20;//جملة الزيادة
	}

/**********************نهايةالبدلات*************************/

/**********************إجمالي المرتب*************************/
		$totsal=round(@$cloth,2)+round(@$manager,2)+round(@$cashequal,2)+round(@$gravity,2)+round(@$mobil,2)+round(@$tension,2)+round(@$capital1,2)+round(@$sal_differ,2)+round(@$work,2)+round(@$cash_chaild,2)+round(@$cash_statas,2)+round(@$sal1,2)+round(@$add20,2);//جملة الراتب
		
//			
if(@mysql_result($rs_emp,0,'name')!=""){
	$sum_totsal= @$sum_totsal+$totsal;
////حساب الزيادة //////////
	//$add12=	($totsal*20)/100;
	/************************/
	//$rs_av=mysql_query("select *from tb_allow where id=$emp_id");
//	$xav=mysql_num_rows($rs_av);
	//if ($xav >0)
	//$rs_updateadd= mysql_query("update tb_allow set add20=$add12 where id=$emp_id  ");
	//else
//	$rs_updateadd=mysql_query("insert into  tb_allow (add20,id)values($add12,$emp_id)");
	//$xav=0;
			
	}
 //	round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2)+round(@$sum_sal_add20,2);
/**********************نهاية*************************/
/**********************الإستقطاعات*************************/
/*--------------------سلفيات الجمعية الخيرية-----------------------*/
$rs_lone1=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and loan_type in(2,3,4,6)  and end_date >='$rptdate' and begin_date <= '$rptdate' ");
$xlone1=@mysql_num_rows($rs_lone1);
$total_lone1=0;
for($l1=0;$l1<$xlone1;$l1++){
	$lone1=@mysql_result($rs_lone1,$l1,'loan')/@mysql_result($rs_lone1,$l1,'loan_number');
	$total_lone1=$total_lone1+$lone1;
}
//$sum_lone=round($total_lone,2)+@$sum_lone;
/*--------------------End---------------------------*/


$rs_cut=mysql_query("select *from tb_tax where id=$emp_id");

	$charity=@mysql_result($rs_cut,0,'charity');//خصم الجمعية الخيرية
		$charity=$charity+$total_lone1;

	$sum_charity=@$sum_charity+$charity;
	
	$tax=@mysql_result($rs_cut,0,'tax');//الضريبة
	$sum_tax=@$sum_tax+$tax;
	
	if(@mysql_result($rs_emp,0,'bank_id')!=20)
	$tameen=8*$totsal/100;
	else
	$tameen=0;
	if(@mysql_result($rs_emp,0,'name')!="")
	$sum_tameen=@$sum_tameen+round($tameen,2);
/**********************نهاية*************************/
/*---------------------------الدمغة---------------------*/
	if(@mysql_result($rs_emp,0,'bank_id')!=20)
	$stamp=1;
	else
	$stamp=0;
		if(@mysql_result($rs_emp,0,'name')!="")
	$sum_stamp=@$sum_stamp+@$stamp;
/*---------------------------نهايةالدمغة---------------------*/
/*--------------------السلفيات------دون الجمعية الخيرية-----------------*/
$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and loan_type<>2 and loan_type<>3 and loan_type<>4 and loan_type <>6  and end_date >='$rptdate' and begin_date <= '$rptdate' ");
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
$total_dis=$tameen+$tax+$charity+$total_lone+@$stamp+@$cut_daycash;
	if(@mysql_result($rs_emp,0,'name')!="")
	$sum_des=@$sum_des+round($total_dis,2);
/**********************نهاية*************************/

/**********************صافي المرتب *************************/
	$Nbs=$totsal-$total_dis;
	if(@mysql_result($rs_emp,0,'name')!="")
		
	$sum_safee=@$sum_safee+round($Nbs,2);
/**********************نهاية*************************/

		?>
				
		<tr>
	<td width="51%" colspan="24">
	<div align="center">
		<table border="0" width="60%" id="table7">
			<tr>
				<td>
				<table border="0" width="100%" id="table8" dir="ltr">
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						Date</td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b>Name</b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b>Job<span lang="ar-sa"> </span></b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Category</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Job ID</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Hiring Date</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Work Starting Date</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Counted Experience Years</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Department<span lang="ar-sa"> </span> </font> </b>&nbsp;</td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Unit/Department</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
				<table border="0" width="100%" id="table9" dir="ltr">
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Basic Salary</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo $sal1;?></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Housing Allowance<span lang="ar-sa"> </span> 
						</font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo $cash_statas;?></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Children Allowance<span lang="ar-sa"> </span> </font></b>&nbsp;</td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Work Nature Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Phone Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Management Allowance </b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Appearance Allowance<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Capital Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Tension Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Reward</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Salary Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>20% Addition</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b>Total<span lang="ar-sa"> </span></b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Taxes+ Stamp<span lang="ar-sa"> </span> 
						</font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Social Insurance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<font size="2"><b>Salary Advance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						<b><font size="2">Charity<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="210">
						Total</td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" colspan="2">
						<table border="0" width="100%" id="table10">
							<tr>
								<td width="173" style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
								<b>Net</b></td>
								<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
	</div>
	</td>

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