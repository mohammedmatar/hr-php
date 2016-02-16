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
/* ---------------------------------------------------*/
$rptdatejan=$year."-".'01'."-".'30';//تاريخ اول كشف في السنة 
if($month > '01' && $month <='12')
$monthnewt=$month-1;
elseif($month == '01')
{
$monthnewt='12';
$year=$year-1;
}

$rptdatenext=$year."-".$monthnewt."-".$day;// تاريخ كشف الشهر السابق

//echo  $rptdatejan."<br>";
//echo $rptdatenext;
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 and bank_id<>20 and tameen_date<>'0000-00-00' /* and id=32*/   order BY name  ");
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
				<td colspan="3">
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<p align="center">
				<b>
				<span lang="ar-sa"><font size="5">NATIONAL FUND FOR SOCIAL INSURANCE</font></span></b></td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><span lang="ar-sa"><b><font size="4">KHARTOUM STATE OFFICE</font></b></span><div align="center">
					<table border="0" width="70%" id="table7" dir="ltr">
					<tr>

				
				
				&nbsp;</b></b></td>
						<td width="64%"><b>DETECTION OF NEW EMPLOYEES DURING INSURANCE YEAR 
						(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rptdate;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						)</b></td>
					</tr>
					<tr>
						<td colspan="2">
						<p align="center"><b>REGISTRATION NUMBER (18469)</b></td>
					</tr>
					<tr>
						<td colspan="2">
						<table border="0" width="100%" id="table8" dir="ltr">
							<tr>
								<td width="139" align="left"><b>Business Owner Name</b></td>
								<td width="147" align="left"><b><font size="4">
								LEAD Technology</font></b></td>
								<td width="95" align="left"><b>Phone</b></td>
								<td align="left">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
			<tr>
				<td nowrap width="36%">&nbsp;</td>
				<td width="40%">
				&nbsp;</td>
				<td width="22%" height="0" style="font-size: 12pt" align="left">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
<?php 
for($g=0;$g<$num_page;$g++){ ?>
	<tr>
		<td>
		<div align="center">
		<table  style=" page-break-after:always; border-collapse:collapse" cellpadding="0" width="80%" dir="ltr" >
		<td width="1%" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" bordercolor="#000000">
		<font size="2"><b>#</b></font></td>
		<td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="23%">
		<p align="center"><b><font size="1">Employee</font></b><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="9%">
		<font size="1"><b>Insurance Number</b></font><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%">
		<font size="1"><b>Service Start Date</b></font><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%">
		<font size="1"><b>Start of Year Payment</b></font><td height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%">
		<font size="1"><b>Last Month Payment</b></font><td width="37" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Monthly Payment</b></font></td>
		<td width="36" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>Addition or Substraction</b></font></td>
		<td width="141" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">8% Insurance</font></b></td>
		<td width="66" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">17% Insurance</font></b></td>
		<td width="56" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1">25% Insurance</font></b></td>
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
		//	echo $expir_yearin1."<br>";
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
/*--------------------------------------------------------------------------*/
						//////////////////////////////////////////حساب راتب اول السنة 
						/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
							$b_datejan=@mysql_result($rs_emp,$i,'begin_date');
							//echo $b_datejan." تاريخ التعيين<br> ".$rptdatejan."تاريخ بداية السنة<br>";
							
						if($b_datejan!="0000-00-00"){
							$exjan=strtotime($b_datejan);
							$now_datejan=strtotime($rptdatejan);
							$exp_unixjan=$now_datejan-$exjan;
							$expir_yearinjan=date("Y",$exp_unixjan);
							$expir_yearin1jan=$expir_yearinjan-1970;
							//echo $expir_yearin1jan."<br>--";
							}
							else
							$expir_yearin1jan=0;
							//exit;
								/*---------------------------------------------*/
							$exp_outjan=@mysql_result($rs_emp,$i,'exp_out');
							//echo $expir_yearin1."<br>";
							
							////////////////////المرتب الاساسي////////////////////////
						//////حساب الزيادة السنوية حسب سلم الرواتب////////
						$expalljan=$expir_yearin1jan + $exp_outjan;
													$rs_jobjan=mysql_query("select *from lk_jop where id=$job ");
							$exp_jobjan=@mysql_result($rs_job,0,'exp');
							if ($expalljan <=@$exp_jobjan)
							{
							$exp_outjan=$expalljan;
							$expir_yearin1jan=0;
							}
							elseif($expalljan > @$exp_jobjan)
							{
							$exp_outjan=$exp_jobjan;
							$expir_yearin1jan=$expalljan - $exp_jobjan;
							}
						/////////////////////////////////////////////////////////
					//	echo $expir_yearin1jan."<br>";
						
						
							$rs_bsaljan=mysql_query("select * from tb_salary where cat_id=$cat and exp=$exp_outjan");
						
							$sal1jan=@mysql_result($rs_bsaljan,0,'bsalary');
						//	echo $sal1jan."<br>";
							/*******************************/
							$day_saljan=($sal1jan/30);
							$sal_comdatejan=strtotime($b_datejan);
							$sal_datejan=date("Y")."-".'01'."-"."30";
							$salnow_datejan=strtotime($sal_datejan);
							$sal_exp_unixjan=$now_datejan-$exjan;
							$expir_dayjan=date("d",$sal_exp_unixjan);
							$date_beginworkjan=explode("-",$b_datejan);
						
						if(@$date_beginworkjan[1]==01 && $date_beginworkjan[0]==$year)
						{
						$expir_dayjan=$expir_dayjan-1;
						$sal1jan=$day_saljan*$expir_dayjan;
						}
							/*******************************/
							
								///////////////////////////////////////////////////////////////////////
							
							if($expir_yearin1jan >0 )
							{
							$xexpjan=$expir_yearin1jan;
							for($j=0;$j < $xexpjan;$j++)
								{
								$expir_yearin1jan=(5 *$sal1jan)/100;
								$sal1jan=$sal1jan + @$expir_yearin1jan;
								}
							}
							$sum_saljan=@$sum_saljan+round($sal1jan,2);//إجمالي المرتب الأساسي
						//echo $sal1jan;
						//exit;
						////////////////نهاية حساب راتب أول السنة /////////////
/*---------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------*/
						//////////////////////////////////////////حساب راتب الشهر السابق
						/*-----------حساب سنوات الخبرة داخل القناة--------------------------*/
							$b_datenext=@mysql_result($rs_emp,$i,'begin_date');
							//echo $b_datenext." تاريخ التعيين<br> ".$rptdatenext."تاريخ بداية السنة<br>";
							
						if($b_datenext!="0000-00-00"){
							$exnext=strtotime($b_datenext);
							$now_datenext=strtotime($rptdatenext);
							$exp_unixnext=$now_datenext-$exnext;
							$expir_yearinnext=date("Y",$exp_unixnext);
							$expir_yearin1next=$expir_yearinnext-1970;
							//echo $expir_yearin1next."<br>--";
							}
							else
							$expir_yearin1next=0;
							//exit;
								/*---------------------------------------------*/
							$exp_outnext=@mysql_result($rs_emp,$i,'exp_out');
							//echo $expir_yearin1."<br>";
							
							////////////////////المرتب الاساسي////////////////////////
						//////حساب الزيادة السنوية حسب سلم الرواتب////////
						$expallnext=$expir_yearin1next + $exp_outnext;
													$rs_jobnext=mysql_query("select *from lk_jop where id=$job ");
							$exp_jobnext=@mysql_result($rs_job,0,'exp');
							if ($expallnext <=@$exp_jobnext)
							{
							$exp_outnext=$expallnext;
							$expir_yearin1next=0;
							}
							elseif($expallnext > @$exp_jobnext)
							{
							$exp_outnext=$exp_jobnext;
							$expir_yearin1next=$expallnext - $exp_jobnext;
							}
						/////////////////////////////////////////////////////////
					//	echo $expir_yearin1next."<br>";
						
						
							$rs_bsalnext=mysql_query("select * from tb_salary where cat_id=$cat and exp=$exp_outnext");
						
							$sal1next=@mysql_result($rs_bsalnext,0,'bsalary');
						//	echo $sal1next."<br>";
							/*******************************/
							$day_salnext=($sal1next/30);
							$sal_comdatenext=strtotime($b_datenext);
							$sal_datenext=date("Y")."-".'01'."-"."30";
							$salnow_datenext=strtotime($sal_datenext);
							$sal_exp_unixnext=$now_datenext-$exnext;
							$expir_daynext=date("d",$sal_exp_unixnext);
							$date_beginworknext=explode("-",$b_datenext);
						
						if(@$date_beginworknext[1]==01 && $date_beginworknext[0]==$year)
						{
						$expir_daynext=$expir_daynext-1;
						$sal1next=$day_salnext*$expir_daynext;
						}
							/*******************************/
							
								///////////////////////////////////////////////////////////////////////
							
							if($expir_yearin1next >0 )
							{
							$xexpnext=$expir_yearin1next;
							for($j=0;$j < $xexpnext;$j++)
								{
								$expir_yearin1next=(5 *$sal1next)/100;
								$sal1next=$sal1next + @$expir_yearin1next;
								}
							}
							$sum_salnext=@$sum_salnext+round($sal1next,2);//إجمالي المرتب الأساسي
						//echo $sal1next;
						//exit;
						////////////////نهاية حساب راتب الشهر السابق /////////////
/*---------------------------------------------------------------------------------------*/


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
	}
	

/*---------------------------------------------------------------------------------*/




									/////////////حساب البدالات والاستقطاعات  عند بداية السنة //////////////////
									
										if ($status==1){
						$cash_statasjan=(20 *$sal1jan)/100;
							$sum_cashstatusjan=@$sum_cashstatusjan + round($cash_statasjan,2);//إجمالي بدل السكن
					}
						elseif($status==2){
						$cash_statasjan=(15 *$sal1jan)/100;
							$sum_cashstatusjan=@$sum_cashstatusjan + round($cash_statasjan,2);//إجمالي بدل السكن
					}
						elseif ($status==3){
						$cash_statasjan=0;
							$sum_cashstatusjan=@$sum_cashstatusjan + round($cash_statasjan,2);//إجمالي بدل السكن
					}
					
								if($chaild_count ==1){
								$cash_chaildjan=2*$sal1jan/100;
								$sum_chaildjan=@$cash_chaildjan+round(@$sum_chaildjan,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==2){
								$cash_chaildjan=4*$sal1jan/100;
								$sum_chaildjan=@$cash_chaildjan+round(@$sum_chaildjan,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==3){
								$cash_chaildjan=6*$sal1jan/100;
								$sum_chaildjan=@$cash_chaild+round(@$sum_chaildjan,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==0){
								$cash_chaildjan=0;
								$sum_chaildjan=@$cash_chaildjan+round(@$sum_chaildjan,2);//إجمالي بدل الابناء
					}
					
						$rs_allawjan=mysql_query("select *from tb_allow where id=$emp_id");
						$workjan=@mysql_result($rs_allaw,0,'fl_work');//طبيعة عمل
						if($work==1){
						$workjan=7*$sal1jan/100;
							$sum_workjan=@$sum_workjan+round($workjan,2);//إجمالي طبيعة العمل
					}
						else
						{
						$workjan=0;
							$sum_workjan=@$sum_workjan+round($workjan,2);//إجمالي طبيعة العمل
					}
						
						
					/**********************البدلات*************************/
						$clothjan=@mysql_result($rs_allaw,0,'fl_cloth');//بدل لبس
					
					if(@mysql_result($rs_allaw,0,'fl_cloth')!=0 || @mysql_result($rs_allaw,0,'fl_cloth')=="" ){
						$sum_closejan=@$sum_closejan+round($clothjan,2);//إجمالي بدل لبس
					}
						$managerjan=@mysql_result($rs_allaw,0,'fl_manager');//بدل إدارة
						
					if(@mysql_result($rs_allaw,0,'fl_manager')!=0 || @mysql_result($rs_allaw,0,'fl_manager')=="" ){
						$sum_managerjan=@$sum_manager+round($managerjan,2);//إجمالي بدل إدارة
					}
						$cashequaljan=@mysql_result($rs_allaw,0,'fl_cashequal');//مكافئه
						
					if(@mysql_result($rs_allaw,0,'fl_cashequal')!=0 || @mysql_result($rs_allaw,0,'fl_cashequal')=="" ){
						$sum_cashequaljan=@$sum_cashequal+round($cashequaljan,2);//إجمالي المكافئة
						}
						$gravityjan=@mysql_result($rs_allaw,0,'fl_gravity');//خطورة
						
					if(@mysql_result($rs_allaw,0,'fl_gravity')!=0 || @mysql_result($rs_allaw,0,'fl_gravity')!="" ){
						$sum_gravityjan=@$sum_gravityjan+round($gravityjan,2);//إجمالي خطورة
					}
						$mobiljan=@mysql_result($rs_allaw,0,'fl_mobil');//موبايل
					
					if(@mysql_result($rs_allaw,0,'fl_mobil')!=0 || @mysql_result($rs_allaw,0,'fl_mobil')=="" ){
						
						$sum_mobilejan=@$sum_mobilejan+round($mobiljan,2);//إجمالي موبايل
						}
						$tensionjan=@mysql_result($rs_allaw,0,'fl_tension');//توتر
						
					if(@mysql_result($rs_allaw,0,'fl_tension')!=0 || @mysql_result($rs_allaw,0,'fl_tension')=="" ){
						$sum_tensionjan=@$sum_tensionjan+round($tensionjan,2);//إجمالي توتر
					}
						$capital1jan=@mysql_result($rs_allaw,0,'fl_capital1');//عاصمة
					
						if(@mysql_result($rs_allaw,0,'fl_capital1')!=0 || @mysql_result($rs_allaw,0,'fl_capital1')=="" ){
					
						$sum_capital1jan=round($capital1jan,2)+@$sum_capital1jan;//جملة عاصمة
					}
						$sal_differjan=@mysql_result($rs_allaw,0,'fl_sal_differ');//فرق راتب
					
						if(@mysql_result(@$rs_allaw,0,'fl_sal_differ')!=0 || @mysql_result(@$rs_allaw,0,'fl_sal_differ')=="" ){
						$sum_sal_differjan=round($sal_differjan,2)+@$sum_sal_differjan;//جملة فرق راتب
						}
					/**********************نهايةالبدلات*************************/
					
					/**********************إجمالي المرتب*************************/
							$totsaljan=round(@$clothjan,2)+round(@$managerjan,2)+round(@$cashequaljan,2)+round(@$gravityjan,2)+round(@$mobiljan,2)+round(@$tensionjan,2)+round(@$capital1jan,2)+round(@$sal_differjan,2)+round(@$workjan,2)+round(@$cash_chaildjan,2)+round(@$cash_statasjan,2)+round(@$sal1jan,2);//جملة الراتب
					//			
					if(@mysql_result($rs_emp,$i,'name')!=""){
						$sum_totsaljan= @$sum_totsaljan+$totsaljan;
					
						}
						///////////////---------------------------------------------------------------------------
						
						


									/////////////حساب البدالات والاستقطاعات  عند بداية السنة //////////////////
									
										if ($status==1){
						$cash_statasnext=(20 *$sal1next)/100;
							$sum_cashstatusnext=@$sum_cashstatusnext + round($cash_statasnext,2);//إجمالي بدل السكن
					}
						elseif($status==2){
						$cash_statasnext=(15 *$sal1next)/100;
							$sum_cashstatusnext=@$sum_cashstatusnext + round($cash_statasnext,2);//إجمالي بدل السكن
					}
						elseif ($status==3){
						$cash_statasnext=0;
							$sum_cashstatusnext=@$sum_cashstatusnext + round($cash_statasnext,2);//إجمالي بدل السكن
					}
					
								if($chaild_count ==1){
								$cash_chaildnext=2*$sal1next/100;
								$sum_chaildnext=@$cash_chaildnext+round(@$sum_chaildnext,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==2){
								$cash_chaildnext=4*$sal1next/100;
								$sum_chaildnext=@$cash_chaildnext+round(@$sum_chaildnext,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==3){
								$cash_chaildnext=6*$sal1next/100;
								$sum_chaildnext=@$cash_chaild+round(@$sum_chaildnext,2);//إجمالي بدل الابناء
					}
								if($chaild_count ==0){
								$cash_chaildnext=0;
								$sum_chaildnext=@$cash_chaildnext+round(@$sum_chaildnext,2);//إجمالي بدل الابناء
					}
					
						$rs_allawnext=mysql_query("select *from tb_allow where id=$emp_id");
						$worknext=@mysql_result($rs_allaw,0,'fl_work');//طبيعة عمل
						if($work==1){
						$worknext=7*$sal1next/100;
							$sum_worknext=@$sum_worknext+round($worknext,2);//إجمالي طبيعة العمل
					}
						else
						{
						$worknext=0;
							$sum_worknext=@$sum_worknext+round($worknext,2);//إجمالي طبيعة العمل
					}
						
						
					/**********************البدلات*************************/
						$clothnext=@mysql_result($rs_allaw,0,'fl_cloth');//بدل لبس
					
					if(@mysql_result($rs_allaw,0,'fl_cloth')!=0 || @mysql_result($rs_allaw,0,'fl_cloth')=="" ){
						$sum_closenext=@$sum_closenext+round($clothnext,2);//إجمالي بدل لبس
					}
						$managernext=@mysql_result($rs_allaw,0,'fl_manager');//بدل إدارة
						
					if(@mysql_result($rs_allaw,0,'fl_manager')!=0 || @mysql_result($rs_allaw,0,'fl_manager')=="" ){
						$sum_managernext=@$sum_manager+round($managernext,2);//إجمالي بدل إدارة
					}
						$cashequalnext=@mysql_result($rs_allaw,0,'fl_cashequal');//مكافئه
						
					if(@mysql_result($rs_allaw,0,'fl_cashequal')!=0 || @mysql_result($rs_allaw,0,'fl_cashequal')=="" ){
						$sum_cashequalnext=@$sum_cashequal+round($cashequalnext,2);//إجمالي المكافئة
						}
						$gravitynext=@mysql_result($rs_allaw,0,'fl_gravity');//خطورة
						
					if(@mysql_result($rs_allaw,0,'fl_gravity')!=0 || @mysql_result($rs_allaw,0,'fl_gravity')!="" ){
						$sum_gravitynext=@$sum_gravitynext+round($gravitynext,2);//إجمالي خطورة
					}
						$mobilnext=@mysql_result($rs_allaw,0,'fl_mobil');//موبايل
					
					if(@mysql_result($rs_allaw,0,'fl_mobil')!=0 || @mysql_result($rs_allaw,0,'fl_mobil')=="" ){
						
						$sum_mobilenext=@$sum_mobilenext+round($mobilnext,2);//إجمالي موبايل
						}
						$tensionnext=@mysql_result($rs_allaw,0,'fl_tension');//توتر
						
					if(@mysql_result($rs_allaw,0,'fl_tension')!=0 || @mysql_result($rs_allaw,0,'fl_tension')=="" ){
						$sum_tensionnext=@$sum_tensionnext+round($tensionnext,2);//إجمالي توتر
					}
						$capital1next=@mysql_result($rs_allaw,0,'fl_capital1');//عاصمة
					
						if(@mysql_result($rs_allaw,0,'fl_capital1')!=0 || @mysql_result($rs_allaw,0,'fl_capital1')=="" ){
					
						$sum_capital1next=round($capital1next,2)+@$sum_capital1next;//جملة عاصمة
					}
						$sal_differnext=@mysql_result($rs_allaw,0,'fl_sal_differ');//فرق راتب
					
						if(@mysql_result(@$rs_allaw,0,'fl_sal_differ')!=0 || @mysql_result(@$rs_allaw,0,'fl_sal_differ')=="" ){
						$sum_sal_differnext=round($sal_differnext,2)+@$sum_sal_differnext;//جملة فرق راتب
						}
					/**********************نهايةالبدلات*************************/
					
					/**********************إجمالي المرتب*************************/
							$totsalnext=round(@$clothnext,2)+round(@$managernext,2)+round(@$cashequalnext,2)+round(@$gravitynext,2)+round(@$mobilnext,2)+round(@$tensionnext,2)+round(@$capital1next,2)+round(@$sal_differnext,2)+round(@$worknext,2)+round(@$cash_chaildnext,2)+round(@$cash_statasnext,2)+round(@$sal1next,2);//جملة الراتب
					//			
					if(@mysql_result($rs_emp,$i,'name')!=""){
						$sum_totsalnext= @$sum_totsalnext+$totsalnext;
					
						}
///---------------------------------------------------------------------------------------------
						
					 //	round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2);
					/**********************نهاية*************************/
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
$balance=$totsal - $totsaljan;
									
									/////////////////نهاية حساب بدلات بداية السنة ////////////////////
					

/*---------------------------------------------------------------------------------*/
if(@mysql_result($rs_emp,$i,'name')!=""){

$counter=$i+1;
		?>
	<tr>
	<td width="1%" align="center" bordercolor="#000000"><font size="2"><b><?php echo $counter;?></b></font></td>

		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?>style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="25%" align="right">
		<font size="2">
		<b>
		<?php echo @mysql_result($rs_emp,$i,'name');?></b></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="9%" align="center">
	<b><font size="2"> 
	<?php echo @mysql_result($rs_emp,$i,'phone3');?></font></b><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%" align="center">
		<b><font size="2">
		<?php echo @mysql_result($rs_emp,$i,'tameen_date');?></font></b><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%" align="center">
	<font size="2"><b>
	<?php echo round($totsaljan,2);?></b></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="3%" align="center">
	<font size="2"><b>
<?php echo round($totsalnext,2);?></b></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="37">
		<font size="2">
		<b>
		<?php echo round($totsal,2);?></b></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="36">
		<font size="2" <?php if($balance <0 ){?>color="#CC0000" <?php }?>><b>
		
<?php echo round($balance,2);?></b></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="141">
		<font size="2">
		<b>
		<?php echo round($tameen,2);?></b></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="66">
	<b><font size="2">
	<?php echo round($tameen17,2);?></font></b></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="56">
	<b><font size="2">
	<?php echo round($tameen25,2);?></font></b></td>
		</tr>
			<?php
			}
			 }
			
			?>
		</table>
		</div>
		</tb></td>
	</tr>
<?php 
$rpt=$rpt+20;
$xemp=$xemp%20;
}?>

</table>
<table dir="ltr" style="border-collapse: collapse" width="80%">
	<tr>
		
		<td bgcolor="#FFFFFF" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="46%">
		&nbsp;<td width="12%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="1"> <span lang="ar-sa">Monthly Payment Total</span></font></b></td>
		<td width="13%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<span lang="ar-sa"><font size="1"><b>8% Insurance Total</b></font></span></td>
		<td width="10%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>17% Insurance Total</b></font></td>
		<td width="11%" height="25" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="1"><b>25% Insurance Total</b></font></td>
		</tr>
	<tr>
		
		<td bgcolor="#FFFFFF" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="46%">
		Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="12%">
		<b>
		<?php echo  number_format(round(@$sum_totsal,2),2,'.',', ');?></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="13%">
		<b>
		<?php echo number_format(round(@$sum_tameen,2),2,'.',', ');?></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="10%">
		<b>
		<?php echo number_format(round(@$sum_tameen17,2),2,'.',', ');?></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="11%">
		<b>
		<?php echo number_format(round(@$sum_tameen25,2),2,'.',', ');?></b></td>
		</tr>
</table>
	</div>
</form>

</body>
<?php }
else
header ("location: login.php");
?>