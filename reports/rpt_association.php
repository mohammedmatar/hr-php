<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");

/*$rs_bank_cap=mysql_query("select *from tb_employee  where des_salary=1 group BY bank_id,cat_id");
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
			$datehol=$rptdate;

/* ---------------------------------------------------*/
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 and bank_id<>20 and  begin_date <='$rptdate'    /*and id=28*/   order BY name  ");
$xemp=mysql_num_rows($rs_emp);
$rcount=$xemp/20;
if($rcount >1 && $rcount <=2 )
$num_page=2;
else
$num_page=round(($rcount+1),0);
$rpt=0;

$rs_type=mysql_query("select *from lk_loan_type where type=1");
$xtype=mysql_num_rows($rs_type);
$sumlonearray=array();

for($rrr=0;$rrr < $xtype;$rrr++)
$sumlonearray[$rrr]=mysql_result($rs_type,$rrr,'id');

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
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				&nbsp;</p>
				<p align="center">LATD TECHNOLOGY</p>
				<p align="center"><font size="5"><b>CHARITY BENEFITS&nbsp; </b></font></td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				&nbsp;</td>
			</tr>
			<tr>
				<td nowrap width="20%">
				<p align="left"><b>Date</b></td>
				<td width="57%">
				<?php echo $rptdate;?><b><font size="4"></font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="left">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
<?php 
for($g=0;$g<$num_page;$g++){  ?>

	<tr>
		<td>
		<div align="center">
		<table  style=" page-break-after:always; border-collapse:collapse" cellpadding="0" width="80%" dir="ltr" >
		<td width="1%" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" bordercolor="#000000">
		<font size="2"><b>#</b></font></td>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="27%">
		<p align="center"><font size="1"><b>Employee</b></font><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Employee Id</b></font></td><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Charity Discount </b></font></td>
		</td>
		<?php 
		
		for($r=0;$r < $xtype;$r++){
		
		?>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<span lang="ar-sa"><font size="1"><b><?php echo mysql_result($rs_type,$r,'name');?></b></font></span></td>		<?php }?>
		</tr>
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
	for($i=$rpt;$i<$rptcemp;$i++){
//////////////الإجازة بدون أجر////////////////
	$empholy= @mysql_result($rs_emp,$i,'id');
	$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
	$xholy=@mysql_num_rows($rs_holy);
	if ($xholy == 0 ){
//////////////الإجازة بدون أجر نهاية///////////


	///////////////////////////////////////////
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
	//echo $expir_yearin1."<br>";
	
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
if(@mysql_result($rs_emp,$i,'name')!=""){
	$sum_totsal= @$sum_totsal+$totsal;
//	echo  $sum_totsal."<br>";
	}
	
 //	round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2);
/**********************نهاية*************************/
/**********************الإستقطاعات*************************/
$rs_cut=mysql_query("select *from tb_tax where id=$emp_id");

	$charity=@mysql_result($rs_cut,0,'charity');//خصم الجمعية الخيرية
	$sum_charity=@$sum_charity+$charity;
	
	$tax=@mysql_result($rs_cut,0,'tax');//الضريبة
	$sum_tax=@$sum_tax+$tax;
	
	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$tameen=8*$totsal/100;
	else
	$tameen=0;
	if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_tameen=@$sum_tameen+round($tameen,2);
	
	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$tameen17=17*$totsal/100;
	else
	$tameen17=0;
	if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_tameen17=@$sum_tameen17+round($tameen17,2);


	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$tameen25=25*$totsal/100;
	else
	$tameen25=0;
	if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_tameen25=@$sum_tameen25+round($tameen25,2);

/*---------------------------الدمغة---------------------*/
	if(@mysql_result($rs_emp,$i,'bank_id')!=20)
	$stamp=0.50;
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
$total_dis=$tameen+$tax+$charity+$total_lone+$stamp;
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
	<tr>
	<td width="1%" align="center" bordercolor="#000000"><font size="2"><b><?php echo $counter;?></b></font></td>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?>style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="28%" align="right">
		<font size="2">
		<b>
		<?php echo @mysql_result($rs_emp,$i,'name');?></b></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<b><font size="2"> 
	<?php echo @mysql_result($rs_emp,$i,'emp_number');?></font></b>
	<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
	<b><font size="2"> 
	<?php echo @$charity;?></font></b></td>
	</td>
	
	<?php for($r=0;$r < $xtype;$r++){?>
	<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">
		<span lang="ar-sa"><font size="2"><b>
		<!----------------------------------حساب اقساط السلفيات------------------------------------->
		<?php
		$lonetype=mysql_result($rs_type,$r,'id');
		$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and end_date >='$rptdate' and begin_date <= '$rptdate' and loan_type=$lonetype ");
	$xlone=@mysql_num_rows($rs_lone);

	$total_lone=0;
	for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;//قيمة القسط الشهري
	$all_loan=@mysql_result($rs_lone,$l,'loan');//قيمة السلفية
	$loan_count=@mysql_result($rs_lone,$l,'loan_number');//عدد الاقساط
	
	/*--------حساب عدد الاقساط المدفوعة----------------*/
	$begin_date=@mysql_result($rs_lone,$l,'begin_date');//تاريخ بداية السلفية

	$ex1=strtotime($begin_date);//تاريخ بداية السلفية
	$now=$rptdate;//تاريخ استخراج التقرير
	$now_date1=strtotime($now);
	$exp_unix12=$now_date1-$ex1;
	$month_number=date("m",$exp_unix12)-1;//حساب عدد الشهور
	
}
	$push_cash=@$month_number * $total_lone;
	$rest=@$all_loan-$push_cash;//متبقي المبلغ
	$sum_lone=round($total_lone,2)+@$sum_lone;//جملة الاقساط المدفوعة
	
	
	
	
	echo round($total_lone,2);
	
	$arrcount=count($sumlonearray);
	if ($arrcount >0 ){
	if($sumlonearray[0]==$lonetype)
	$sum1=$sum1+$total_lone;
	}
	if($sumlonearray[1]==$lonetype)
	$sum2=$sum2+$total_lone;
	
if($sumlonearray[2]==$lonetype)
	$sum2=$sum2+$total_lone;
	

if($sumlonearray[3]==$lonetype)
	$sum3=$sum3+$total_lone;
	
	
	if($sumlonearray[4]==$lonetype)
	$sum4=$sum4+$total_lone;
	


		?>
<!----------------------------------حساب اقساط السلفيات------------------------------------->

		
		</b></font></span></td>		<?php }?>
				</tr>
			<?php
			}
			 }
			}
			?>
		</table>
		<p>&nbsp;</div>
		</tb></td>
	</tr>
<?php 
$rpt=$rpt+20;
$xemp=$xemp%20;
}?>
<tr><td>

<div align="center">

<table border="0" width="80%" id="table7" dir="ltr" height="53">
	<tr>
		<td width="72">
		<p align="center"><font size="1"><b>Charity Discount</b></font></td>
		<td>&nbsp;</td>
		<td rowspan="2" width="76"><b>Total</b></td>
		<?php for($r=0;$r < $xtype;$r++){?>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<span lang="ar-sa"><font size="1"><b><?php echo mysql_result($rs_type,$r,'name');?></b></font></span></td>		<?php }?>
	</tr>
	<tr>
		<td width="72">
		<p align="center"><b><font size="4"><?php echo number_format(round(@$sum_charity,2),2,'.',', ');?></font></b></td>
		<td><?php // print_r($sumlonearray);?></td>
		<?php for($r=0;$r < $xtype;$r++){
		$lonid=mysql_result($rs_type,$r,'id');
		?>
		<td height="22" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<span lang="ar-sa"><font size="1"><b><?php 
		if($sumlonearray[0]==mysql_result($rs_type,$r,'id'))
	    echo number_format(round($sum1,2),2,'.',', ');
	
if($sumlonearray[1]==mysql_result($rs_type,$r,'id'))
	    echo number_format(round($sum2,2),2,'.',', ');
	
if($sumlonearray[2]==mysql_result($rs_type,$r,'id'))
	    echo number_format(round($sum3,2),2,'.',', ');
	    
	if($sumlonearray[3]==mysql_result($rs_type,$r,'id'))
	    echo number_format(round($sum4,2),2,'.',', ');
	
	if($sumlonearray[4]==mysql_result($rs_type,$r,'id'))
	    echo number_format(round($sum5,2),2,'.',', ');
	



		
		?></b></font></span></td>		<?php }?>
	</tr>
</table>

</div>


</td></tr>
</table>
	</div>
</form>

</body>
<?php }
else
header ("location: login.php");
?>