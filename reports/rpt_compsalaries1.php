<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){

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
$rs_emp=mysql_query("select *from tb_employee  where des_salary=1 GROUP BY section_id    ");
$xemp=mysql_num_rows($rs_emp);

if($_POST[bank] ==1){
$rs_holyc=mysql_query("SELECT count(id)as emphol FROM tb_holiy_emp WHERE 	 hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
$xemp1=$xemp-mysql_result($rs_holyc,0,'emphol');
$xemp=$xemp1;

}
else
$xemp1=$xemp;

//echo $xemp1;
$rcount=$xemp/22;

if($rcount >=1 && $rcount <2 )
$num_page=2;
else
$num_page=round(($rcount+1),0);
$rpt=0;

$xi=0;

?>

<head>

<title>&lt;?php echo date(&quot;Y/m/d H:i:s&quot;);?&gt;</title>

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
				&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="border-top-style: solid; border-top-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
				<p align="center"><font size="5"><b>LEAD</b></font><b><font size="5"> 
				TECHNOLOGY<br>
				Company Salaries by Department</font></b></td>
			</tr>
			<tr>
				<td nowrap width="36%"><font size="4"><b>Center</b></font><b><font size="4"> 
				:<?php 
				$rs_bank=mysql_query("select *from lk_bank where id=$_POST[bank]");
				echo @mysql_result($rs_bank,0,'name');

				?></font></b></td>
				<td width="40%">
				<p align="left"><b><font size="2">Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</font></b></td>
				<td width="22%" height="0" style="font-size: 12pt" align="right"><?php echo date("Y/m/d H:i:s");?><?
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
		<!--td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>��</b></font></td-->
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Appearance</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Capital</b></font><b><font size="2"> </font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Tension</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Rewards</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Salary Allowance</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Addition</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Total Salary</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Taxes</b></font></td>
		<td width="1%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<font size="2"><b>Stamp</b></font></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
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
		<font size="2">Total Discount</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Net Salary</font></b></td>
		<td width="2%" align="center" valign="top" bgcolor="#E6B86B" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		<b>
		<font size="2">Signature</font></b></td>
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
		//////////////������� ���� ���///////////
	$empholy= @mysql_result($rs_emp,$i,'id');
	$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
	$xholy=@mysql_num_rows($rs_holy);
	if ($xholy == 0 || $xholy =="" ){
//////////////������� ���� ��� �����///////////
	///////////////////////////////////////////
	$cat= @mysql_result($rs_emp,$i,'cat_id');
	$emp_id= @mysql_result($rs_emp,$i,'id');
	$status= @mysql_result($rs_emp,$i,'status_id');
	$chaild_count=@mysql_result($rs_emp,$i,'chaild_count');
	$exp_in=@mysql_result($rs_emp,$i,'exp_in');
		$job= @mysql_result($rs_emp,$i,'job_id');

	/*-----------���� ����� ������ ���� ������--------------------------*/
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
	
	////////////////////������ �������////////////////////////

//////���� ������� ������� ��� ��� �������////////
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
	$sum_sal=@$sum_sal+round($sal1,2);//������ ������ �������

	if ($status==1){
	$cash_statas=(20 *$sal1)/100;
	$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//������ ��� �����
}
	elseif($status==2){
	$cash_statas=(15 *$sal1)/100;
		$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//������ ��� �����
}
	elseif ($status==3){
	$cash_statas=0;
		$sum_cashstatus=@$sum_cashstatus + round($cash_statas,2);//������ ��� �����
}
$cash_chaild=0;
			if($chaild_count ==1){
			$cash_chaild=2*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//������ ��� �������
}
			if($chaild_count ==2){
			$cash_chaild=4*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//������ ��� �������
}
			if($chaild_count ==3){
			$cash_chaild=6*$sal1/100;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//������ ��� �������
}
			if($chaild_count ==0){
			$cash_chaild=0;
			$sum_chaild=@$cash_chaild+round(@$sum_chaild,2);//������ ��� �������
}

	$rs_allaw=mysql_query("select *from tb_allow where id=$emp_id");
	$work=@mysql_result($rs_allaw,0,'fl_work');//����� ���
	if($work==1){
	$work=7*$sal1/100;
		$sum_work=@$sum_work+round($work,2);//������ ����� �����
}
	else
	{
	$work=0;
		$sum_work=@$sum_work+round($work,2);//������ ����� �����
}
	
	
/**********************�������*************************/
	$cloth=@mysql_result($rs_allaw,0,'fl_cloth');//��� ���

if(@mysql_result($rs_allaw,0,'fl_cloth')!=0 || @mysql_result($rs_allaw,0,'fl_cloth')!="" ){
	$sum_close=@$sum_close+round($cloth,2);//������ ��� ���
}
	$manager=@mysql_result($rs_allaw,0,'fl_manager');//��� �����
	
if(@mysql_result($rs_allaw,0,'fl_manager')!=0 || @mysql_result($rs_allaw,0,'fl_manager')!="" ){
	$sum_manager=@$sum_manager+round($manager,2);//������ ��� �����
}
	$cashequal=@mysql_result($rs_allaw,0,'fl_cashequal');//������
	
if(@mysql_result($rs_allaw,0,'fl_cashequal')!=0 || @mysql_result($rs_allaw,0,'fl_cashequal')!="" ){
	$sum_cashequal=@$sum_cashequal+round($cashequal,2);//������ ��������
	}
	$gravity=@mysql_result($rs_allaw,0,'fl_gravity');//�����
	
if(@mysql_result($rs_allaw,0,'fl_gravity')!=0 || @mysql_result($rs_allaw,0,'fl_gravity')!="" ){
	$sum_gravity=@$sum_gravity+round($gravity,2);//������ �����
}
	$mobil=@mysql_result($rs_allaw,0,'fl_mobil');//������

if(@mysql_result($rs_allaw,0,'fl_mobil')!=0 || @mysql_result($rs_allaw,0,'fl_mobil')!="" ){
	
	$sum_mobile=@$sum_mobile+round($mobil,2);//������ ������
	}
	$tension=@mysql_result($rs_allaw,0,'fl_tension');//����
	
if(@mysql_result($rs_allaw,0,'fl_tension')!=0 || @mysql_result($rs_allaw,0,'fl_tension')!="" ){
	$sum_tension=@$sum_tension+round($tension,2);//������ ����
}
	$capital1=@mysql_result($rs_allaw,0,'fl_capital1');//�����

	if(@mysql_result($rs_allaw,0,'fl_capital1')!=0 || @mysql_result($rs_allaw,0,'fl_capital1')!="" ){

	$sum_capital1=round($capital1,2)+@$sum_capital1;//���� �����
}
	$sal_differ=@mysql_result($rs_allaw,0,'fl_sal_differ');//��� ����

	if($sal_differ !=0 || $sal_differ !="" ){
	$sum_sal_differ=round($sal_differ,2)+@$sum_sal_differ;//���� ��� ����
	//echo $sal_differ;
	}
	
	$add20=@mysql_result(@$rs_allaw,0,'add20'); //�������
	
	if(@mysql_result(@$rs_allaw,0,'add20')!=0 || @mysql_result(@$rs_allaw,0,'add20')=="" ){
	$sum_sal_add20=round($add20,2)+@$sum_sal_add20;//���� �������
	}


/**********************������������*************************/

/**********************������ ������*************************/
		$totsal=round(@$cloth,2)+round(@$manager,2)+round(@$cashequal,2)+round(@$gravity,2)+round(@$mobil,2)+round(@$tension,2)+round(@$capital1,2)+round(@$sal_differ,2)+round(@$work,2)+round(@$cash_chaild,2)+round(@$cash_statas,2)+round(@$sal1,2)+round(@$add20,2);//���� ������
//		echo $i."<br>";
		//if(@$totsal != "" || @$totsal!=0)
	$sum_totsal=	round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2)+round(@$sum_sal_add20,2);
		//$sum_totsal=$totsal+$sum_totsal;//���� ������ ��������
//	echo $sum_totsal."<br>";
/**********************�����*************************/
/**********************�����������*************************/
	/*--------------------������ ������� �������-----------------------*/
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

	$charity=@mysql_result($rs_cut,0,'charity');//��� ������� �������
	$charity=$charity+$total_lone1;
	$sum_charity=@$sum_charity+$charity;

/*------------------------------------------*/
	$tax=@mysql_result($rs_cut,0,'tax');//�������
	$sum_tax=@$sum_tax+$tax;
	
	if(@mysql_result($rs_emp,$i,'bank_id')!=20 && @mysql_result($rs_emp,$i,'bank_id')==@$_POST[bank] )
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
	
	/*---------------------------������---------------------*/
	if(@mysql_result($rs_emp,$i,'bank_id')!=20 && @mysql_result($rs_emp,$i,'bank_id')==@$_POST[bank])
	$stamp=1;
	else
	$stamp=0;
		if(@mysql_result($rs_emp,$i,'name')!="")
	$sum_stamp=@$sum_stamp+@$stamp;
/*---------------------------�����������---------------------*/

/**********************�����*************************/
/*--------------------��������------��� ������� �������-----------------*/
$rs_lone=mysql_query("select *from tb_employee_loan where emp_id=$emp_id and loan_type<>2 and loan_type<>3 and loan_type<>4 and loan_type<>6 and end_date >='$rptdate' and begin_date <= '$rptdate' ");
$xlone=@mysql_num_rows($rs_lone);
$total_lone=0;
for($l=0;$l<$xlone;$l++){
	$lone=@mysql_result($rs_lone,$l,'loan')/@mysql_result($rs_lone,$l,'loan_number');
	$total_lone=$total_lone+$lone;
}
$sum_lone=round($total_lone,2)+@$sum_lone;
/*--------------------End---------------------------*/

/*--------------------��������-----------------------*/

	$rs_san=mysql_query("select *from tb_emp_sanctions where emp_id=$emp_id and san_date >=  '$date' and san_date <='$rptdate' ");
	$xsan=@mysql_num_rows($rs_san);
	$cut_daycash=0;
	$sal_day=$sal1/30;
for($s=0;$s<$xsan;$s++){
$sanitem_id=@mysql_result($rs_san,$s,'sanitem_id');
$rs_sanitem=mysql_query("select *from tb_sanctionsitem where id=$sanitem_id and discount=1");
$cut_daycash=$cut_daycash+($sal_day *@mysql_result($rs_sanitem,0,'discount_day')) ;//���� ��� ��������
}
$sum_cut=@$sum_cut+round($cut_daycash,2);
/*--------------------End---------------------------*/


/**********************���� �����������*************************/
	$total_dis=$tameen+$tax+$charity+$total_lone+$stamp+$cut_daycash;
	$sum_des=@$sum_des+round($total_dis,2);
/**********************�����*************************/

/**********************���� ������ *************************/
if(@mysql_result($rs_emp,$i,'bank_id')==@$_POST[bank]){
	$Nbs=$totsal-$total_dis;
	$sum_safee=@$sum_safee+$Nbs;
	}
	//echo $sum_safee;
/**********************�����*************************/

if(@mysql_result($rs_emp,$i,'name')!=""){
$counter=$i+1;
$name=@mysql_result($rs_emp,$i,'name');
/*----------------------�������----------------------------*/
if(!empty($_POST["archive"])){
$emploay_id=@mysql_result($rs_emp,$i,'id');
$bsal=round($sal1,2);
$home=round(@$cash_statas,2); 
$child=round(@$cash_chaild,2); 
$work=round(@$work,2); 
$phone=round(@$mobil,2);
$manager=round(@$manager,2);
$net=round(@$gravity,2);
$cloth=round(@$cloth,2);
$capit=round(@$capital1,2);
$tens=round(@$tension,2);
$bonse= round(@$cashequal,2);
$difrent= round(@$sal_differ,2);
$add20= round(@$add20,2);
$totalsal=round(@$totsal,2);
$tax=round(@$tax,2);
$dams=$stamp;
$tameen=round(@$tameen,2);
$loan=round(@$total_lone,2); 
$khairya=round(@$charity,2);
$cuts= round(@$cut_daycash,2);
$totalcuts=round(@$total_dis,2);
$emp_salary=round(@$Nbs,2);
$rs_arch=mysql_query("insert into tb_arcitive_salary(name,year,month,bank_id,bsal,home,child,	work,phone,manager,net,cloth,capit,tens,bonse,difrent,add20,totalsal,tax,dams,tameen,loan,khairya,cuts,totalcuts,emp_salary,emp_id)values('".$name."',$_POST[year],$_POST[month],$_POST[bank],$bsal,$home,$child,$work,$phone,$manager,$net,$cloth,$capit,$tens,$bonse,$difrent,$add20,$totalsal,$tax,$dams,$tameen,$loan,$khairya,$cuts,$totalcuts,$emp_salary,$emploay_id)");
}
/*----------------------����� ������� ----------------------*/

		?>
	<tr  bgcolor="<?php if ($counter % 2==0) echo "#666666"; else echo "#FFFFFF"; ?>">
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="1%" height="0">
		<p align="center"><span lang="ar-sa"><font size="2"><?php echo $counter;?></font></span><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="7%" height="0">
		<font size="2">
		<?php echo @mysql_result($rs_emp,$i,'name');?></font><td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round($sal1,2); ?>
		</font>
		</td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$cash_statas,2); ?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$cash_chaild,2); 		?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$work,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$mobil,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo round(@$manager,2);?></font></td>
		<!--td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<font size="2">
		<?php echo round(@$gravity,2);?></font></td-->
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$cloth,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$capital1,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$tension,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
	<font size="2">
	<?php echo round(@$cashequal,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$sal_differ,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="0%">
		<font size="2">
		<?php echo round($add20,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$totsal,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$tax,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="0%">
	<font size="2">	<?php echo $stamp;?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$tameen,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2"><?php echo round(@$total_lone,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$charity,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2"><?php echo round(@$cut_daycash,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<font size="2">
		<?php echo round(@$total_dis,2);?></font></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo round(@$Nbs,2);?></font></b></td>
		<td <?php if($i%2==0){?> bgcolor="#FFFFFF"<?php  } else {?>bgcolor="#E6E6E6"<?php }?> style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		</td>
		</tr>
			<?php
			$xi=$xi+1;
			}
			} 
			}
			?>
		
<?php 

if($xemp1==$xi){
?>	
		<tr>
		
		<td bgcolor="#FFFFFF" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" width="10%" colspan="2">
		Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_sal,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_cashstatus,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_chaild,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_work,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_mobile,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_manager,2),2,'.',', ');?></font></b></td>
		<!--td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_gravity,2),2,'.',', ');?></font></b></td-->
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b>
		<?php echo number_format(round(@$sum_close,2),2,'.',', ');?></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_capital1,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_tension,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
	<b><font size="2">
	<?php echo number_format(round(@$sum_cashequal,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_sal_differ,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
	<b><font size="2">	<?php echo number_format(round(@$sum_sal_add20,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php 
				//$totsum1=round(@$sum_sal,2)+round(@$sum_chaild,2)+round(@$sum_cashstatus,2)+round(@$sum_work,2)+round(@$sum_mobile,2)+@$sum_manager+round(@$sum_gravity,2)+round(@$sum_close,2)+round(@$sum_capital1,2)+round(@$sum_tension,2)+round(@$sum_cashequal,2)+round(@$sum_sal_differ,2);
			//echo round(@$totsum1,2);
		echo number_format(round($sum_totsal,2),2,'.',', ');
		?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_tax,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="1%">
		<b><font size="2">
		<?php echo number_format(round($sum_stamp,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_tameen,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_lone,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_charity,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_cut,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="2%">
		<b><font size="2">
		<?php echo number_format(round(@$sum_des,2),2,'.',', ');?></font></b></td>
		<td bgcolor="#EEEEEE" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center" width="3%" colspan="2">
		<b><font size="2">
		<?php 
		

		echo number_format(round(@$sum_safee,2),2,'.',', ');?></font></b></td>
		</tr>
<?php  } ?>
						
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


<?php 
include("pie_chart.php");
?>