
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LATD TECH - Attendance Report</title>

</head>

<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");
$rs=mysql_query("select *from tb_employee  where des_salary=1 and section_id=$_POST[section] and active=1  order by name");//*/ emp_number=9103
$x=mysql_num_rows($rs);
/*$user="sa";
//$password="tvzstreaming";
//$database="BioStar";
//$server="192.168.1.3";
//$conn=odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $user, $password);*/
$conn = odbc_connect('ams','sa','tvzstreaming');

$reportdelet=odbc_exec($conn ,"delete from report");
$datetodate=explode("/",$_POST["begin_date"]);
$datetodate=$datetodate[2]."-".$datetodate[0]."-".$datetodate[1];
$resreport = odbc_exec($conn ,"Select * from View_1 where sLogTime like '%$datetodate%'");
//echo "Select * from View_1 where sLogTime like'%$datetodate%'";
//exit;

while (odbc_fetch_row($resreport)){
    $date=odbc_result($resreport,"sLogTime");
	$id=odbc_result($resreport,"sCardNo");
	//echo $id."<p>";
     $resreport1 = @odbc_exec($conn ,"insert into report(EmpID,date)values($id,'$date')");
     
          }

		  $datefrom=$_POST["year"]."/".$_POST["month"]."/"."01";
$dateto=$_POST["year"]."/".$_POST["month"]."/"."30";
	
$choise=$_POST["D1"];
   ?>
<body>

<div align="center">
	<table border="0" width="100%" bgcolor="#FFFFFF" dir="rtl" id="table1">
		<tr>
			<td>
			<p align="center"><font size="4" color="#A86500"><b>LATD TECHNOLOGY</b></font></td>
		</tr>
		<tr>
			<td>
			<p align="center"><font size="4"><b>DAILY TIME&amp; ATTENDANCE</b></font></td>
		</tr>
		<tr>
			<td>
			<div align="center">
				<table border="0" width="70%" bgcolor="#FFFFFF" dir="ltr" id="table2">
					<tr>
						<td width="97%" colspan="3">
						<hr color="#008000" size="1"></td>
					</tr>
					<tr>
						<td width="52%">
						<p dir="rtl"><?php echo $_POST["begin_date"]?></td>
						<td width="11%">
						<p align="right"><b>Date</b></td>
						<td width="34%">
						<p align="right" dir="rtl"><b>Department</b></td>
					</tr>
					<tr>
						<td width="97%" colspan="3">
						<p dir="rtl" align="center"><?php echo date("Y/m/d H:i:s");?><?
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
					<tr>
						<td width="97%" colspan="3">
						<hr color="#A86500" size="5"></td>
					</tr>
				</table>
			</div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center">
				<table border="0" width="700" bgcolor="#FFFFFF" dir="rtl" id="table3" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
					<tr>

						<td bgcolor="#E6B86B" align="center"><b>Leaving Time</b></td>

						<td align="center" valign="top" bgcolor="#E6B86B"><b>
						Arriving Time</b></td>
						<td align="center" valign="top" bgcolor="#E6B86B"><b>
						Status</b></td>
						<td align="center" valign="top" bgcolor="#E6B86B"><b>Job 
						ID</b></td>
						<td align="center" valign="top" bgcolor="#E6B86B" width="262">
						<b>Name</b></td>
					</tr>
					<?php 
				
					for($i=0;$i <$x;$i++){
					$DateCome[1]='00:00:00';
					$empid =mysql_result($rs,$i,'emp_number');
					$empno=mysql_result($rs,$i,'id');
						$convdate=explode("/",$_POST["begin_date"]);
$m=$convdate[0];
$d=$convdate[1];
$y=$convdate[2];
$convdate=$y."-".$m."-".$d;
$rs_holiy=mysql_query("select *from tb_holiy_emp where emp_id=$empno and  begin_date <='$convdate' and end_date >='$convdate'");


//echo "select *from tb_holiy_emp where emp_id=$ empno and  begin_date <='$convdate' and end_date >='$convdate'"."<br>";
							
$xholiy=@mysql_num_rows($rs_holiy);
						
						
						$date_now=$_POST["begin_date"];
							
							
$res2 = odbc_exec($conn ,"Select TOP 1 *from View_2 where date ='$date_now' and EmpID='$empid' order by ID " );
$res3 = odbc_exec($conn ,"Select TOP 1 *from View_2 where date ='$date_now' and EmpID='$empid' order by ID DESC " );

//زمن الحضور
	if(odbc_result($res2,"time")=="")
						$time= "0000:00:00";
						else
						$time= odbc_result($res2,"time");
	//زمن الانصراف
	if(odbc_result($res3,"time")=="")
						$timeout= "0000:00:00";
						else
						$timeout= odbc_result($res3,"time");
												
//satatus				
 if(odbc_result($res2,"time")=='00:00:00' || odbc_result($res2,"time")=="" ) 
						{
						if ($xholiy >0)
						$status="<b><font color=#107A02 size=4>Vacation </font></b>";
						else
						$status= "Absent";
						 }
						 else 
						 $status= "Present";         
// الرقم الوظيفي
$emp_number= mysql_result($rs,$i,'emp_number');
// الاسم
$name=mysql_result($rs,$i,'name');
if($choise==2)
{
if($status=="Absent"){
$name="";
$emp_number="";
$time="";
$status="";
}

}elseif($choise==3)
if($status=="Present"){
$name="";
$emp_number="";
$time="";
$status="";

}
if($status=="Present")
$status="<b>Present</b>";
elseif($status=="Absent")
$status= "<b><font color=#FF0000>Absent</font></b>";


					?>
					<tr>
						<td style="border-style: solid; border-width: 2px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
						<p align="center"><?php	echo $timeout;	?></td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
						
 <?php echo $time;?>
						
						</td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
						<?php echo $status;?>
						</td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo $emp_number;?></td>
						<td align="center" width="262" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo $name;?>			
						</td>
					</tr>
					<?php }?>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>

</body>
<?php }
else
header ("location: login.php");
?>