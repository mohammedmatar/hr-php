<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
	$catogry=1;
	$jobname1=0;
/*$rs_bank_cap=mysql_query("select *from tb_employee  where des_salary=1  group BY bank_id,cat_id");
$bank_name=array();
$xcap_bank=mysql_num_rows($rs_bank_cap);
for($cap=0;$cap<$xcap_bank;$cap++)
$bank_name[$cap]=mysql_result($rs_bank_cap,$cap,'bank_id');
//print_r($bank_name);
*/

/* ----------------------Day Report-----------------------------*/
	
	$month=date("m");
	$year=date("Y");
	
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

<title>بطاقة الراتب الإجمالي للموظف
</title>

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
				&nbsp;</td>
			</tr>
			<tr>
				<td>
				<p align="center">
				&nbsp;</td>
			</tr>
			<tr>
				<td style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><font size="4"><b>TOTAL SALARY CARD</b></font></td>
			</tr>
			</table>
		</td>
	</tr>
<?php 
for($g=0;$g<$num_page;$g++){ ?>

	<?php 	
	if($g==0)
	$rptcemp=20;
	else
	{
	if($xemp==20)
	$rptcemp=$xemp-20;
	else
	if($xemp >20)
	$rptcemp=$xemp%20;
	$rptcemp=$rptcemp+20;
	}
	
//	echo "<br>"."<font color=$000000>".$rptcemp."</font>"."<br>";
	for($i=$rpt;$i<1;$i++){
	//////////////الإجازة بدون أجر///////////
	$empholy= @mysql_result($rs_emp,$i,'id');
	$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
	$xholy=@mysql_num_rows($rs_holy);
	if ($xholy == 0 ){
//////////////الإجازة بدون أجر نهاية///////////

	///////////////////////////////////////////
	$cat= @mysql_result($rs_emp,$i,'cat_id');
	$name=mysql_result($rs_emp,$i,'name');	

	$job= @mysql_result($rs_emp,$i,'job_id');
	$emp_number=@mysql_result($rs_emp,$i,'emp_number');
	$come_date=@mysql_result($rs_emp,$i,'come_date');
	$begin_date=@mysql_result($rs_emp,$i,'begin_date');
	$empjob=$job;
	$section_id=@mysql_result($rs_emp,$i,'section_id');
	$section=mysql_result(mysql_query("select *from  tb_section_main where id=$section_id"),0,"name");
	$dept_id=@mysql_result($rs_emp,$i,'dept_id');
	$dept=mysql_result(mysql_query("select *from lk_depart where id=$dept_id"),0,'name');
	$emp_id= @mysql_result($rs_emp,$i,'id');
	$status= @mysql_result($rs_emp,$i,'status_id');
	$chaild_count=@mysql_result($rs_emp,$i,'chaild_count');
	$exp_in=@mysql_result($rs_emp,$i,'exp_in');
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
	$jobname1=@mysql_result($rs_job,0,'name');
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
	$catogry=mysql_result(mysql_query("select *from lk_cat where id=$cat "),0,'name');
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
if(@mysql_result($rs_emp,$i,'name')!=""){
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
	
	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$tameen=8*$totsal/100;
	else
	$tameen=0;
	if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_tameen=@$sum_tameen+round($tameen,2);
/**********************نهاية*************************/
/*---------------------------الدمغة---------------------*/
	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$stamp=1;
	else
	$stamp=0;
		if(@mysql_result($rs_emp,$i,'name')!="")
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
	if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_des=@$sum_des+round($total_dis,2);
/**********************نهاية*************************/

/**********************صافي المرتب *************************/
	$Nbs=$totsal-$total_dis;
	if(@mysql_result($rs_emp,$i,'name')!="")
		
	$sum_safee=@$sum_safee+round($Nbs,2);
/**********************نهاية*************************/

if(@mysql_result($rs_emp,$i,'name')!=""){

$counter=$i+1;
		?>
	
			<?php
			}}
			 }
			
			?>
		</table>
		</tb></td>
	</tr>
<?php 
$rpt=$rpt+20;
$xemp=$xemp%20;
}?>

</table>

	</div>
</form>

	<div align="center">
		<table border="0" width="60%" id="table11" dir="rtl" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
			<tr>
				<td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<div align="center">
				<table border="0" width="100%" id="table12" dir="ltr">
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Date</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo date("Y/m/d");?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Name</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><b><?php echo $name;?></b></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<b><font size="2">Job<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $jobname1;?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Category</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $catogry;?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Job ID</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $emp_number;?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Hiring Date</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $come_date?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Work Starting Date</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $begin_date?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Counted Experience Years</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $expall;?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<b><font size="2">Department<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $dept;?></font></td>
					</tr>
					<tr>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="147">
						<font size="2"><b>Unit/Department</b></font></td>
						<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 10px; padding-top: 1px; padding-bottom: 1px">
						<font size="2"><?php echo $section;?></font></td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
			<tr>
				<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<table border="0" width="100%" id="table13" dir="ltr">
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Basic Salary</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($sal1,2);?></font></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b><font size="2">Housing Allowance<span lang="ar-sa"> </span> 
						</font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($cash_statas,2);?></font></td>
					</tr>
					<?php if($cash_chaild >0){?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b><font size="2">Children Allowance<span lang="ar-sa"> </span> </font></b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($cash_chaild,2);?></font></td>
					</tr>
					<?php }
					if($work >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Work Nature Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($work,2);?></font></td>
					</tr>
					<?php } 
					if($mobil >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Phone Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($mobil,2);?></font></td>
					</tr>
					<?php }
					if($manager >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Management Allowance </b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($manager,2);?></font></td>
					</tr>
					<?php }
					if($cloth >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b><font size="2">Appearance Allowance<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo $cloth;?></font></td>
					</tr>
					<?php }
					if($capital1 >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Capital Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($capital1,2);?></font></td>
					</tr>
					<?php }
					if($tension >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Tension Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($tension,2);?></font></td>
					</tr>
					<?php }
					if($cashequal >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Reward</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($cashequal,2);?></font></td>
					</tr>
					<?php }
					if($sal_differ >0){
					?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Salary Allowance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($sal_differ,2);?></font></td>
					</tr>
					<?php }?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>20% Addition</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($add20,2);?></font></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b>Total<span lang="ar-sa"> </span></b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<b><?php echo round($totsal,2);?>
</b>
</td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b><font size="2">Taxes Stamp<span lang="ar-sa"> </span> 
						</font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo $tax+$stamp;?></font></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Social Insurance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<?php echo $tameen?></td>
					</tr>
					<?php if($total_lone >0){?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Salary Advance</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($total_lone,2);?></font></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<b><font size="2">Charity<span lang="ar-sa"> </span> </font> </b></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($charity,2);?></font></td>
					</tr>
					<?php if($cut_daycash >0 ){?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2"><b>Sanctions</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2"><?php echo round($cut_daycash,2);?></font></td>
					</tr>
					<?php }?>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="38%">
						<font size="2" color="#FF0000"><b>Total</b></font></td>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="53%">
						<font size="2" color="#FF0000"><b><?php echo round($total_dis,2);?></b></font></td>
					</tr>
					<tr>
						<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" colspan="2">
						<table border="0" width="100%" id="table14" dir="ltr">
							<tr>
								<td width="173" style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
								<b>Net</b></td>
								<td style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
								<b><?php echo round($Nbs,2);?></b></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
	</div>
	
<table border="0" width="100%" id="table15">
	<tr>
		<td>
		<span lang="en-US">
		<div dir="rtl" style="unicode-bidi:embed;margin:0 36pt 0 18pt;" align="right">
			<p align="center"><font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;" dir="rtl">
			<font face="Simplified Arabic" size="1">
			<span style="font-size:8pt;" lang="ar-AE"><b> Arkaweet, Khartoum- Sudan L. </b></span></font>
			<font face="Arial,sans-serif" size="1">
			<span style="font-size:8pt;" dir="ltr"><b></b></span></font><font face="Simplified Arabic" size="1"><span style="font-size:8pt;" lang="ar-AE"><b> 
			</span><span style="font-size:8pt;">&nbsp;&nbsp; </span><span style="font-size:8pt;" lang="ar-AE">Block 65 </span> </b></font><font face="Arial,sans-serif" size="1">
			<span style="font-size:8pt;" dir="ltr"><b></b></span></font><font face="Simplified Arabic" size="1"><span style="font-size:8pt;" lang="ar-AE"><b> 
			– </span><span style="font-size:8pt;">Phone</span><span style="font-size:8pt;" lang="ar-AE">: </span> </b></font><font size="1">
			<span style="font-size:8pt;" dir="ltr"><b>183 527000</b></span></font><font face="Arial,sans-serif" size="1"><span style="font-size:7pt;" dir="ltr"><b>&nbsp;&nbsp;
			</b></span><span style="font-size:8pt;" dir="ltr"><b>&nbsp;</b></span></font><font face="Simplified Arabic" size="1"><span style="font-size:8pt;"><b>&nbsp;</b></span></font><font face="Arial,sans-serif" size="1"><span style="font-size:8pt;" dir="ltr"><b></b></span></font><font face="Simplified Arabic" size="1"><span style="font-size:8pt;" lang="ar-AE"><b>&nbsp;&nbsp; 
		Fax </b></span></font><font face="Arial,sans-serif" size="1">
			<span style="font-size:7pt;" dir="ltr"><b>+249 183 216945</b></span></font></span></font></div>
		<div style="text-indent:-18pt;text-align:center;margin:0 0 0 36pt;" align="center">
			<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><font size="1">
			<span style="font-size:7pt;">-</span></font><font><span style="font-size:;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</span></font><font face="Arial,sans-serif" size="1">
			<span style="font-size:7pt;"><b>Khartoum – Eltaief – Block 23 – 
			Building 14 – Tel: +249 183 527000&nbsp;&nbsp; Fax: +249 183 216945</b></span></font></span></font></div>
		</span></td>
	</tr>
</table>
	
</body>
<?php } 
else
header ("location: login.php");
?>