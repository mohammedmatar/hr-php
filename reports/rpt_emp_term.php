<?php 
session_start();
include("../config.php");
if($_SESSION["login"]==1){
	@mysql_query("SET NAMES 'utf8'");
	
	//رقم الموظف
	$empId = $_POST['emp_id'];
	//شهور الاجر الاضافي
	$bounsMonyMonthes =  str_replace( ' ', '',trim( $_POST['monthes']));	
	
	//حساب راتب الشهر الاخير في كل الاحوال
	if(isset($_POST['calcLastMonthSalary']))
		$calcLastMonthSalary = $_POST['calcLastMonthSalary'];
	else	
		$calcLastMonthSalary =  0;
	//نهاية حساب راتب الشهر الاخير في كل الاحوال
	//البيانات الاساسيه للموظف
	$queryB = "select begin_date,come_date,cat_id,exp_out,status_id,chaild_count,bank_id,tb_employee.name as name,year(begin_date) as year,month(begin_date) as month,day(begin_date) as day,lk_Bank.name as bank from tb_employee left join lk_Bank on(tb_employee.bank_id=lk_Bank.id) where des_salary=0 and tb_employee.id=$empId";
	$rs_emp = @mysql_query($queryB);
	$workBeginDate = @mysql_result($rs_emp,0,'begin_date');
	$employmentDate = @mysql_result($rs_emp,0,'come_date');
	$emp_cat_id = @mysql_result($rs_emp,0,'cat_id');
	$emp_exp_out = @mysql_result($rs_emp,0,'exp_out');
	$status = @mysql_result($rs_emp,0,'status_id');
	$chaild_count = @mysql_result($rs_emp,0,'chaild_count');
	$empName = @mysql_result($rs_emp,0,'name');
	$begindateY =mysql_result($rs_emp,0,'year');
	$begindateM =mysql_result($rs_emp,0,'month');
	$begindateD =mysql_result($rs_emp,0,'day');
	$bank_id =mysql_result($rs_emp,0,'bank_id');
	$bankName = mysql_result($rs_emp,0,'bank');
	//نهاية البيانات الاساسية
	
	//الراتب الاساسي
	$rs_bsal= @mysql_query("select * from tb_salary where cat_id=$emp_cat_id and exp=$emp_exp_out");
	$basicSalary = @mysql_result($rs_bsal,0,'bsalary');
	//نهاية الراتب الاساسي
	
	//بيانات نهاية الخدمة
	$rs_emp_term=@mysql_query("select date,other_mony,year(date) as year,month(date) as month,day(date) as day,name from tb_term inner join lk_term on(term_id=lk_term.id) where emp_id=".$empId);
	$rptdate=mysql_result($rs_emp_term,0,'date');
	$otherMony=mysql_result($rs_emp_term,0,'other_mony');
	$enddateY =mysql_result($rs_emp_term,0,'year');
	$enddateM =mysql_result($rs_emp_term,0,'month');
	$enddateD =mysql_result($rs_emp_term,0,'day');
	$termName =mysql_result($rs_emp_term,0,'name');
	//نهاية بيانات نهاية الخدمة
	$dayend=explode("-",$rptdate);
	
	//بيانات أخر راتب
	$lastSalaryInfo = "SELECT * FROM tb_arcitive_salary WHERE name = '".$empName."' AND id=(SELECT max(id) FROM tb_arcitive_salary WHERE name = '".$empName."' )";
	$lastSalaryInfoRes = @mysql_query($lastSalaryInfo);
	$lastSalaryFoudRow = @mysql_fetch_array($lastSalaryInfoRes);
	$lastSalaryYear = $lastSalaryFoudRow['year'];
	$lastSalaryMonth = $lastSalaryFoudRow['month'];
	$lastSalaryDay = getMonthDays($lastSalaryYear,$lastSalaryMonth);
	//نهاية بيانات اخر مرتب
	
	//حساب مدة العمل بالتفصيل سنين وشهور وايام
	//فترة العمل داخل القناة
	$workExp = date_difference(array ('year' => $begindateY, 'month' => $begindateM, 'day' => $begindateD) , array ('year' => $enddateY, 'month' => $enddateM, 'day' => $enddateD));
	if($workExp['days'] > 15){
		$workExp['months'] = $workExp['months'] +1;
		$reminderDaiesSalary= 0;
	}else{
	    $reminderDaiesSalary= $enddateD;
	}
	
	$workMonths = $workExp['years']*12 + $workExp['months'];
	//نهاية فترة العمل داخل القناة
	
	//حساب علاوة الخبرة داخل القناة 5 % عن كل سنة
	$expInChannel = $workExp['years'];
	if($workExp['months'] >= 11)
		$expInChannel++;
	
	$expsalaryBounce =0;
	$lastSalrayAdd = 0;
	if($expInChannel > 0 ){
	    for($i=0;$i<$expInChannel;$i++){
			$lastSalrayAdd = $basicSalary*5/100;
			$basicSalary = $basicSalary + ($basicSalary*5/100);
		}	
		$basicSalary = round($basicSalary,2);	
	}	
	//نهاية حساب علاوة سنوات الخبر ة داخل القناة
	
	//فوائد مابعد الخدمة
	$endWorkSalary = round(($basicSalary / 12) * $workMonths,2);
	//نهاية فوائد مابعد الخدمة
	
	
	//مجموع البدلات
	$sum_bouns_mony = 0;
	//البدلات
	//بدل السكن
	if ($status==1){
		$sum_cashstatus=round((20 * $basicSalary)/100,2);
	}else if($status==2){
		$sum_cashstatus=round((15 * $basicSalary)/100,2);
	}else if ($status==3){
		$sum_cashstatus=0;
	}
	//نهاية بدل السكن
	
	//بدل الابناء
	if($chaild_count == 1 ){
		$sum_chaild = round(2*$basicSalary/100 , 2);
	}else if($chaild_count == 2 ){
		$sum_chaild = round(4*$basicSalary/100,2);
	}else if($chaild_count ==3){
		$sum_chaild = round(6*$basicSalary/100,2);
	}else if($chaild_count ==0){
		$sum_chaild=0;
	}
	//نهاية بدل الابناء
	
	//مجموع البدلات
	$sum_bouns_mony = $sum_bouns_mony + $sum_cashstatus + $sum_chaild;
	
	//بيانات البدلات
	$rs_allaw = @mysql_query("select * from tb_allow where id=$empId");
	$work=@mysql_result($rs_allaw,0,'fl_work');//طبيعة عمل
	$cloth= @mysql_result($rs_allaw,0,'fl_cloth');//بدل لبس
	$manager=@mysql_result($rs_allaw,0,'fl_manager');//بدل إدارة
	$cashequal=@mysql_result($rs_allaw,0,'fl_cashequal');//مكافئه
	$gravity=@mysql_result($rs_allaw,0,'fl_gravity');//خطورة
	$mobil=@mysql_result($rs_allaw,0,'fl_mobil');//موبايل
	$tension=@mysql_result($rs_allaw,0,'fl_tension');//توتر
	$capital1=@mysql_result($rs_allaw,0,'fl_capital1');//عاصمة
	$sal_differ=@mysql_result($rs_allaw,0,'fl_sal_differ');//فرق راتب
	//نهاية بيانات البدلات 
	
	//بدل طبيعة عمل
	if($work == 1){
		$sum_work = round(7*$basicSalary/100,2);//إجمالي طبيعة العمل
	}else{
		$sum_work=0;
	}
	//نهاية بدل طبيعة عمل
	
	//بدل لبس
	$sum_close=round($cloth,2);
	//نهاية بدل لبس
	
	//بدل إدارة
	$sum_manager=round($manager,2);
	//نهاية بدل إدارة
	
	//بدل المكافئة
	$sum_cashequal=round($cashequal,2);
	//نهاية بدل المكافئة
	
	//بدل خطورة
	$sum_gravity=round($gravity,2);
	//نهاية بدل خطورة

	//بدل موبايل
	$sum_mobile=round($mobil,2);
	//نهاية بدل موبايل
	
	//بدل توتر
	$sum_tension=round($tension,2);
	//نهاية بدل توتر

	//بدل عاصمة
	$sum_capital1=round($capital1,2);
	//نهاية بدل عاصمة

	//بدل فرق راتب
	$sum_sal_differ=round($sal_differ,2);
	//نهاية بدل فرق راتب
	
	//نهايةالبدلات
	
	//مجموع البدلات
	$sum_bouns_mony = $sum_bouns_mony + $sum_work + $sum_close + $sum_manager + $sum_cashequal + $sum_gravity + $sum_mobile + $sum_tension + $sum_capital1 + $sum_sal_differ;
	
	//الراتب مع العلاوات
	$totsal = $basicSalary + $sum_bouns_mony;
	//مجموع الاستقطاعات
	$sum_sub_mony = 0;
	//---------------------------الإستقطاعات---------------------------
	//---------------------------الدمغة---------------------
	if($bank_id != 20)
		$stamp=0.50;
	else
		$stamp=0;
	//----------------------------------------نهايةالدمغة--------------------
	
	//---------------------------بيانات الاستقطاعات---------------------------
	$rs_cut=@mysql_query("select * from tb_tax where id=$empId");
	$sum_charity=@mysql_result($rs_cut,0,'charity');//خصم الجمعية الخيرية
	$sum_tax=@mysql_result($rs_cut,0,'tax');//الضريبة
	//--------------------------- نهاية بيانات الاستقطاعات---------------------------
	
	//التأمينات
	if($bank_id != 20)
		$sum_tameen=round( 8 * $totsal / 100,2);
	else $sum_tameen=0;
		
	if($bank_id !=20)
		$sum_tameen17= round(17* $totsal/100,2);
	else
		$sum_tameen17=0;
	
	if($bank_id !=20 )
		$sum_tameen25=round(25*$totsal/100,2);
	else
		$sum_tameen25=0;
		
	//مجموع الاستقطاعات
	$sum_sub_mony = $sum_sub_mony + $stamp + $sum_charity + $sum_tax + $sum_tameen;
		
	//صافي الراتب الشهري
	$monthlySalary = $basicSalary + $sum_bouns_mony - $sum_sub_mony;
	
	//صافي الراتب الشهري
	$monthly = $basicSalary + $sum_bouns_mony;

	//حساب الراتب الاخير
	$serialNo = 4;
	//رواتب متأخرة 
	$lateSalary = 0;
	
	$difLastSalaryAndEndDate = date_difference(array ('year' => $lastSalaryYear, 'month' => $lastSalaryMonth, 'day' => $lastSalaryDay) , array ('year' => $enddateY, 'month' => $enddateM, 'day' => $enddateD));
	$difLastSalaryAndEndDateMonths = $difLastSalaryAndEndDate['years']*12 +  $difLastSalaryAndEndDate['months'];
	$lateSalary = $monthlySalary * $difLastSalaryAndEndDateMonths;
	$frogatAllaowa = 0;
	if(($difLastSalaryAndEndDateMonths > $enddateM)&&($lastSalrayAdd>0))
		$frogatAllaowa = ($difLastSalaryAndEndDateMonths-$enddateM)*$lastSalrayAdd;
	$lateSalary = $lateSalary - $frogatAllaowa;
	
	$lateSalaryView ='<tr><td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;'.($serialNo++).'</span></b></td><td width="60%"><b><span lang="ar-sa">&nbsp;&nbsp; رواتب متأخرة';
	$lateSalaryView .='</span></b></td><td width="15%">&nbsp;&nbsp;'.$lateSalary.'</td></tr>';
	//رواتب متأخرة نهاية
	
	
	//التأكد من اخر شهر تم صرفه ام لا
	$lastSalaryFoud = "SELECT count(*) as c FROM `tb_arcitive_salary` where name='".$empName."' and year=".$enddateY." and month=".$enddateM;
	$lastSalaryFoudRes = @mysql_query($lastSalaryFoud);
	$lastSalaryFoudRow = @mysql_fetch_array($lastSalaryFoudRes);
	if(($lastSalaryFoudRow['c']==0) || ($calcLastMonthSalary==1)){
		if($enddateD > 15){
			//مرتب شهر كامل
			$lastSalary = $monthly;
		}else{
			//مرتب ايام العمل
			$lastMonthDaies = $enddateD;
			$lastSalary = round($lastMonthDaies*($monthly/30) , 2);//$monthlySalary
		}
	}else $lastSalary = 0;	
	//نهاية حساب الراتب الاخير
	
	
	//----------------------------السلفيات-----------------------
	$loanRowView ='';
		
	$loanCountQuery = "select count(*) as cou from tb_employee_loan where emp_id=$empId and end_date >='$rptdate'";
	$loanCountRes = @mysql_query($loanCountQuery);
	$loanCountRow=@mysql_fetch_array($loanCountRes);
	$countRemLoan = 0;
	$countRemLoan = $loanCountRow['cou'];
	$sumRemLoan = 0;
	if($countRemLoan > 0){
		$loanTypeQuery = "select id,name from lk_loan_type";
		$loanTypes = @mysql_query($loanTypeQuery);
		while($loanTypeRow=@mysql_fetch_array($loanTypes)){
			$loanQuery = "select loan,loan_number,year(end_date)as endyear,month(end_date)as endmonth,day(end_date)as endday from tb_employee_loan where emp_id=$empId and end_date >='".$rptdate."' and loan_type=".$loanTypeRow['id'];
			$loanRes = @mysql_query($loanQuery);
			$loan = 0;
			while($loanRow=@mysql_fetch_array($loanRes)){
				$diffmonthes = date_difference(array ('year' => $lastSalaryYear, 'month' => $lastSalaryMonth, 'day' => $lastSalaryDay) , array ('year' => $loanRow['endyear'], 'month' => $loanRow['endmonth'], 'day' => $loanRow['endday']));
				$dMonthes = $diffmonthes['months'];
				$loanRemNo = $diffmonthes['years'] *12 + $dMonthes;
				$loan = $loan + round((($loanRow['loan'] / $loanRow['loan_number'])*$loanRemNo) , 2);
			}
			if($loan > 0){
				$loanRowView .='<tr><td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;'.($serialNo++).'</span></b></td><td width="60%"><b><span lang="ar-sa">&nbsp;&nbsp;'.$loanTypeRow['name'];
				$loanRowView .='</span></b></td><td>&nbsp;</td><td width="15%">&nbsp;&nbsp;'.$loan.'</td></tr>';
				$sumRemLoan = $sumRemLoan + $loan;
			}
			
			
		}
		
	}
	//----------------------------نهاية السلفيات-----------------
	
	//متبقي أجر إضافي
	if(strlen($bounsMonyMonthes) > 0){
		$bMonthes = explode("+",$bounsMonyMonthes);
		$bounsHoursQ = " select ifnull(sum(h1),0) as hh1,ifnull(sum(h2),0) as hh2 , ifnull(sum(h3),0) as hh3 from tb_overtime";
		$whereC = " where ";
		$orr = ' ';
		$displayMonthNames = "(";
		foreach ($bMonthes as $month_B){
			if($month_B <= $enddateM){
				$whereC .= $orr.' (emp_id='.$empId.' and year='.$enddateY.' and month='.$month_B.')';
				$orr = ' or ';
				$displayMonthNames .= ' '.getMonthName($month_B);
			}else{
				$whereC .= $orr.'(emp_id='.$empId.' and year='.($enddateY-1).' and month='.$month_B.')';
				$orr = ' or ';
				$displayMonthNames .= ' '.getMonthName($month_B);
			}
	}
	$displayMonthNames .= ')';
	$bounsHoursQ .= $whereC;
	$rs_hours=@mysql_query($bounsHoursQ);
	$normalHours = @mysql_result($rs_hours,0,'hh1');
	$ottalHours = @mysql_result($rs_hours,0,'hh2');
	$egazzaHours = @mysql_result($rs_hours,0,'hh3');
	
	$normalHours = $normalHours * ($basicSalary /160);
	$ottalHours = $ottalHours * ($basicSalary /120);
	$egazzaHours = $egazzaHours * ($basicSalary /120);
	
	$bounsHoursSalary = round ($normalHours + $ottalHours + $egazzaHours ,2);
	}
	else{
	$bounsHoursSalary = 0;
	$displayMonthNames = "";
	}
	//نهاية متبقي أجر إضافي
	
	
	//-----------------------------الجزاءات-----------------------
	$sanQuery = "select ifnull(sum(discount_day),0) as daies from tb_emp_sanctions inner join tb_sanctionsitem on(tb_emp_sanctions.sanitem_id=tb_sanctionsitem.id) where (emp_id=$empId and san_date >= '$rptdate')or(emp_id=$empId and san_date between '".$enddateY."-".$enddateM."-01'"." and '$rptdate') and discount=1";
	$rs_sanction=@mysql_query($sanQuery);
	$sanDaies = mysql_result($rs_sanction,0,'daies');
	$sanMony = $sanDaies *( $basicSalary /30);
	//----------------------------نهاية الجزاءات---------------------------
	
	//الراتب الشهري ناقص الجزاءات
	$monthlySalary = $monthlySalary - $sanMony;
	
	//مجموع المبلغ المستحق للموظف
	$totalMonyForTermEmp = $endWorkSalary + $lastSalary + $bounsHoursSalary - $sumRemLoan - $otherMony; //+ $lateSalary 
	$cridet=$endWorkSalary + $lastSalary + $bounsHoursSalary;  //+ $lateSalary 
	$depit=$sumRemLoan + $otherMony;
	
?>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo date("Y/m/d H:i:s");?></title>
<style type="text/css">
table.sample {
	border-width: 0px;
	border-spacing: 2px;
	border-style: none;
	border-color: ;
	border-collapse: collapse;
	background-color: ;
}
table.sample th {
	
	border-width: 1px;
	padding: 0px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: 9px 9px 9px 9px;
}
table.sample td {
	border-width: 1px;
	padding: 0px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: 9px 9px 9px 9px;
}
</style>

</head>

<body>

<form method="POST" action="">
	<div align="center">

	<table width="75%" style="border-style:solid; border-width:0; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" id="table5">
		<tr>
		<td width="98%" align="left" colspan="21" class="tdtitleemp" bgcolor="#FFFFFF">
			<table border="0" width="100%" id="table6">
			<tr>
				<td>
				<p align="center">
				<img border="0" src="../images/logo.GIF" width="85" height="74"></td>
			</tr>
			<tr>
				<td>
				<p align="center"><b>
				<font size="4">
				<span lang="ar-sa">LEAD TECH</span></font>
				</b></td>
			</tr>
			<tr>
				<td style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><span lang="ar-sa"><b><font size="4">Department of Sudan</font></b></span>
				<table border="0" width="90%" id="table7" dir="ltr">
					<tr>
						<td width="98%"><span lang="ar-sa"><b>Date</b>
						<?php echo date("Y/m/d");?></span></td>
					</tr>
					<tr>
						<td>
						<p align="right"><b><span lang="ar-sa"><font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<center>The </font></span><font size="4"> </font>
						<span lang="ar-sa"><font size="4">Manager of Sudan Office
						</font></span></b></td></center>
					</tr>
					<tr>
						<td>
						<p align="center"><b><span lang="ar-sa"><font size="4">&nbsp;&nbsp; 
						Care of C/of The Administration and Finance Director Department </font>
						</span></b>
						</td>
					</tr>
					<tr>
						<td>
						<p align="center">&nbsp; Greetings</td>
					</tr>
					<tr>
						<td>
						<p align="center"><u><b><span lang="ar-sa">
						<font size="4">Subject: Dues Owned for /  </font></span>
						<font size="4"> <?php echo @mysql_result($rs_emp,0,'name');?>
						</font></b></u>
						</td>
					</tr>
				</td>	
			</tr>
	</table>
	<br />
	<table border="0" width="100%" id="table8" dir="ltr">
		<tr>
			<td width="20%"><b>Hiring Date</b></td>
			<td><?php echo $employmentDate ?></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td width="20%">
			<p dir="ltr"><b>Starting Date</b></td>
			<td><?php echo $workBeginDate ?></td>
		</tr>
		<tr>
			<td width="20%"><b>Contract End Date</b></td>
			<td><?php echo $rptdate ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td width="25%"><b>Work Duration in Months</b></td>
			<td><?php echo $workMonths;?></td>
		</tr>
		<tr>
			<td width="20%"><b>Cause of Termination</b></td>
			<td><?php echo $termName ?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td width="25%"><b>Exchange Center</b></td>
			<td><?php echo $bankName;?></td>
		</tr>
	</table>
	<div align="right">			
	<table class="sample" dir="ltr"  width="81%">		
		<tr>
			<td width="5%" align="center" rowspan="2"><b><span lang="ar-sa"> &nbsp;#</span></b></td>
			<td width="63%" align="center" rowspan="2"><b><span lang="ar-sa"> &nbsp;&nbsp;</span>Item</b></td>
			<td width="32%" align="center" colspan="2"><b><span lang="ar-sa"> &nbsp;&nbsp;</span>Amount</b></td>
		</tr>
		<tr>
			<td width="15%" align="center"><b>To</b></td>
			<td width="17%" align="center"><b>From</b></td>
		</tr>
		<tr>
			<td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;1</span></b></td>
			<td width="63%"><b><span lang="ar-sa"> &nbsp;&nbsp;</span>After 
			Service Benefits</b></td>
			<td width="15%">&nbsp;&nbsp;<?php echo $endWorkSalary; ?></td>
			<td width="17%">&nbsp;</td>
		</tr>
		<tr>
			<td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;2</span></b></td>
			<td width="63%"><b><span lang="ar-sa">&nbsp;&nbsp;Last Month Salary&nbsp;(</span>&nbsp;<?php if(isset($_POST['calcLastMonthSalary'])) echo $dayend[2]; else echo "0";?>&nbsp; <span lang="ar-sa">) Days </span></b></td>
			<td width="15%">&nbsp;&nbsp;<?php echo $lastSalary; ?></td>
			<td width="17%">&nbsp;</td>
		</tr>
		<tr>
			<td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;3</span></b></td>
			<td width="63%"><b><span lang="ar-sa">&nbsp;&nbsp;Extra Payment Arrears<?php if(strlen($displayMonthNames) > 2) echo  $displayMonthNames;?> </span></b></td>
			<td width="15%">&nbsp;&nbsp;<?php echo $bounsHoursSalary; ?></td>
			<td width="17%">&nbsp;</td>
		</tr>
		<!--tr>
			<td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;4</span></b></td>
			<td width="60%"><b><span lang="ar-sa">&nbsp;&nbsp;السلفيات </span></b></td>
			<td width="15%">&nbsp;&nbsp;<?php //echo $sumRemLoan; ?></td>
		</tr-->
		<?php //if($lateSalary > 0) echo $lateSalaryView;echo $loanRowView; ?>
		<tr>
			<td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;<?php $serialNo--; echo $serialNo;?></span></b></td>
			<td width="63%"><b><span lang="ar-sa">&nbsp;&nbsp;</span>Others</b></td>
			<td width="15%"></td>
			<td width="17%">&nbsp;&nbsp;<?php echo $otherMony; ?></td>
		</tr>
		<tr>
			<td width="67%" align="center" colspan="2"><p align="center"><b>Total</b></p></td>
			<td width="15%" align="center"><b><?php echo $cridet;?></b></td>
			<td width="17%" align="center"><b><?php echo $depit;?></b></td>
		</tr>
		<tr>
			<!--td width="5%" align="center"><b><span lang="ar-sa"> &nbsp;&nbsp;</span></b></td-->
			<td width="63%"  align="center" colspan="2"><p align="center"><b>
			Deus Owned</b></p></td>
			<td width="32%" colspan="2">
			<p align="center"><b>&nbsp;&nbsp;<?php echo $totalMonyForTermEmp; ?></b></td>
		</tr>
	</table>
	</div>			
	
	<div align="left">
	<table border="0" width="85%" id="table8">
		<br /><br /><br /><br />
		<tr>
			<td width="40%"><b><span lang="ar-sa">Certify of Administration Department ....................................</span></b></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td width="60%"><b>Certify of Administration Department Director<span lang="ar-sa"> <br>.............................</span></b></td>
			
		</tr>	
	</table>			
	</div>
	
	</div>
		
</form>

</body>
<?php }
else
header ("location: login.php");
?><?php
/*
    License:  do whatever you want with this code
    
    Disclaimer:  This code works well on my system, but may not on yours.  Use
    with circumspection and trepidation.  If this code blows up your system,
    I recommend vituperation.
*/



/*
    function smoothdate simply takes a year, month, and a day, and
    concatenates them in the form YYYYMMDD
    
    the function date_difference uses this function
*/

function smoothdate ($year, $month, $day)
{
    return sprintf ('%04d', $year) . sprintf ('%02d', $month) . sprintf ('%02d', $day);
}


/*
    function date_difference calculates the difference between two dates in
    years, months, and days.  There is a ColdFusion funtion called, I
    believe, date_diff() which performs a similar function.
    
    It does not make use of 32-bit unix timestamps, so it will work for dates
    outside the range 1970-01-01 through 2038-01-19.  This function works by
    taking the earlier date finding the maximum number of times it can
    increment the years, months, and days (in that order) before reaching
    the second date.  The function does take yeap years into account, but does
    not take into account the 10 days removed from the calendar (specifically
    October 5 through October 14, 1582) by Pope Gregory to fix calendar drift.
    
    As input, it requires two associative arrays of the form:
    array (    'year' => year_value,
            'month' => month_value.
            'day' => day_value)
    
    The first input array is the earlier date, the second the later date.  It
    will check to see that the two dates are well-formed, and that the first
    date is earlier than the second.
    
    If the function can successfully calculate the difference, it will return
    an array of the form:
    array (    'years' => number_of_years_different,
            'months' => number_of_months_different,
            'days' => number_of_days_different)
            
    If the function cannot calculate the difference, it will return FALSE.
    
*/

function date_difference($first, $second)
{
    $month_lengths = array (31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    $retval = FALSE;

    if (    checkdate($first['month'], $first['day'], $first['year']) &&
            checkdate($second['month'], $second['day'], $second['year'])
        )
    {
        $start = smoothdate ($first['year'], $first['month'], $first['day']);
        $target = smoothdate ($second['year'], $second['month'], $second['day']);
                            
        if ($start <= $target)
        {
            $add_year = 0;
            while (smoothdate ($first['year']+ 1, $first['month'], $first['day']) <= $target)
            {
                $add_year++;
                $first['year']++;
            }
                                                                                                            
            $add_month = 0;
            while (smoothdate ($first['year'], $first['month'] + 1, $first['day']) <= $target)
            {
                $add_month++;
                $first['month']++;
                
                if ($first['month'] > 12)
                {
                    $first['year']++;
                    $first['month'] = 1;
                }
            }
                                                                                                                                                                            
            $add_day = 0;
            while (smoothdate ($first['year'], $first['month'], $first['day'] + 1) <= $target)
            {
                if (($first['year'] % 100 == 0) && ($first['year'] % 400 == 0))
                {
                    $month_lengths[1] = 29;
                }
                else
                {
                    if ($first['year'] % 4 == 0)
                    {
                        $month_lengths[1] = 29;
                    }
                }
                
                $add_day++;
                $first['day']++;
                if ($first['day'] > $month_lengths[$first['month'] - 1])
                {
                    $first['month']++;
                    $first['day'] = 1;
                    
                    if ($first['month'] > 12)
                    {
                        $first['month'] = 1;
                    }
                }
                
            }
                                                                                                                                                                                                                                                        
            $retval = array ('years' => $add_year, 'months' => $add_month, 'days' => $add_day);
        }
    }
                                                                                                                                                                                                                                                                                
    return $retval;
}
function getMonthName($monthNo){
	$monthName="";
	switch($monthNo){
	    case "1" :$monthName="يناير"; break;
		case "2" :$monthName="فبراير"; break;
		case "3" :$monthName="مارس"; break;
		case "4" :$monthName="أبريل"; break;
		case "5" :$monthName="مايو"; break;
		case "6" :$monthName="يوليو"; break;
		case "7" :$monthName="يونيو"; break;
		case "8" :$monthName="اغسطس"; break;
		case "9" :$monthName="سبتمبر"; break;
		case "10" :$monthName="اكتوبر"; break;
		case "11" :$monthName="نوفمبر"; break;
		case "12" :$monthName="ديسمبر"; break;
	}
    return $monthName;
}
function getMonthDays($year,$monthNo){
	$monthDay="";
	switch($monthNo){
	    case "1":case "3":case "5":case "7":case "8":case "10":case "12": $monthDay=31; break;
		case "2" :if(($year%4)==0)
					$monthDay=29;
				  else
					$monthDay=28;	
		break;
		case "4":case "6":case "9":case "11": $monthDay=30; break;
	}
    return $monthDay;
}

?>