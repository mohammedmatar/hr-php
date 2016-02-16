
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>اLETD TECHNOLOGY - تقرير الحضور الشهري للموظفين</title>
</head>

<?php 
session_start();

include("../config.php");
if($_SESSION["login"]==1){
mysql_query("SET NAMES 'utf8'");
$rs=mysql_query("select *from tb_employee  where des_salary=1 and  section_id=$_POST[section]  and active=1 order by name");/* emp_number=9103") */
$x=mysql_num_rows($rs);
$conn = odbc_connect("ams","sa","tvzstreaming");
$reportdelet=odbc_exec($conn ,"delete from report");

$resreport = odbc_exec($conn ,"Select * from View_1 ");
while (odbc_fetch_row($resreport)){
    $date=odbc_result($resreport,"sLogTime");
	$id=odbc_result($resreport,"sCardNo");
     $resreport1 = @odbc_exec($conn ,"insert into report(EmpID,date)values($id,'$date')");
	 
     
          }
$datefrom=$_POST["month"]."/"."01"."/".$_POST["year"];
$dateto=$_POST["month"]."/"."30"."/".$_POST["year"];
	
$res = odbc_exec($conn ,"Select  TOP 1 EmpID, Date, Time from View_2 where Date BETWEEN '$datefrom' and '$dateto' ");
//echo "Select  TOP 1  EmpID, Date, Time from View_2 where Date BETWEEN '$datefrom' and '$dateto' ";

	//odbc_result_all($res);

	$numRows = odbc_num_fields($res); 
	//echo $numRows;

   ?>
<body>

<div align="center">
	<table border="0" width="100%" bgcolor="#FFFFFF" dir="rtl" id="table1">
		<tr>
			<td>
			<p align="center"><b><font size="4" color="#A86500">LETD TECHNOLOGY
			</font></b></td>
		</tr>
		<tr>
			<td>
			<p align="center"><b>MONTHLY TIME AND ATTENDANCE</b></td>
		</tr>
		<tr>
			<td>
			<div align="center">
				<table border="0" width="70%" bgcolor="#FFFFFF" dir="rtl" id="table2">
					<tr>
						<td width="27%" align="right">
						<p align="right" dir="rtl"><b>YEAR<span lang="ar-sa"> : 
						<?php echo $_POST["year"];?></span></b></td>
						<td width="25%" align="right">
						<p dir="rtl"><?php echo $_POST["month"];?></td>
						<td width="11%">
						<p align="right"><b>MONTH</b></td>
						<td width="34%">
						<p align="right" dir="rtl"><b>DEPARTMENT :  <?php echo mysql_result(mysql_query("select *from tb_section where id=$_POST[section]"),0,'name');?></b></td>
					</tr>
					<tr>
						<td width="52%" colspan="2">
						<?php echo date("Y/m/d H:i:s");?><?
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
						<td width="11%">
						Date</td>
						<td width="34%">
						&nbsp;</td>
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
					<td align="center" valign="top" bgcolor="#E6B86B">Extra 
					Hours</td>

						<td align="center" valign="top" bgcolor="#E6B86B">Work 
						Hours</td>
						<td align="center" valign="top" bgcolor="#E6B86B">
						Required Hour</td>
						<td align="center" valign="top" bgcolor="#E6B86B">Job Id</td>
						<td align="center" valign="top" bgcolor="#E6B86B" width="262">
						<b>Name</b></td>
					</tr>
					<?php 
				
					for($i=0;$i <$x;$i++){
					$empid =mysql_result($rs,$i,'emp_number');
						if ($_POST["month"]==2 )
						$day=28;

						else
						$day=30;
							$sumHour=0;
						for($j=1;$j<=$day;$j++){
						if($j >9)
						$jj=$j;
						else
						$jj="0".$j;
						//$date_now=$_POST["year"]."/".$_POST["month"]."/".$jj;
						$date_now=$_POST["month"]."/".$jj."/".$_POST["year"];
						//$_POST["year"]."/".$_POST["month"]."/".$j;
						
$res2 = odbc_exec($conn ,"Select  TOP 1 *from View_2 where Date = '$date_now' and EmpID=$empid ");
//echo "Select  TOP 1 *from View_2 where Date = '$date_now' and EmpID=$empid "."<p>";

$res21 = odbc_exec($conn ,"Select   TOP 1 *from View_2 where Date = '$date_now' and EmpID=$empid  order by Time desc  ");

//echo "Select   TOP 1 *from View_2 where Date = '$date_now' and EmpID=$empid  order by Time desc  "."<br>";





 
  $DateCome=odbc_result($res2,"Time");
  $DateGo=odbc_result($res21,"Time");
 if ($DateGo !=0 && $DateCome !=0 )
 {

$DateCome=strtotime($DateCome);
$DateGo=strtotime($DateGo);


$TimeIn=($DateGo-$DateCome)/3600;

//$TimeIn=date("H",$TimeIn);
//echo $TimeIn."<br>";

$TimeIn=round($TimeIn);

}
else
$TimeIn=0;
if ($TimeIn <=0)
$sumHour=$sumHour+0;
else
$sumHour=$sumHour+$TimeIn;

//echo $sumHour;
					}?>
					<tr>
					<td style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
					<p dir="rtl" align="center"><?php 
					$overTime=$sumHour-mysql_result($rs,$i,'dayofmonth');
					echo $overTime;
					?></td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php 
						

						
					echo $sumHour;	
						?>
						</td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo mysql_result($rs,$i,'dayofmonth');?></td>
						<td align="center" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo mysql_result($rs,$i,'emp_number');?></td>
						<td align="center" width="262" style="border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"><?php echo mysql_result($rs,$i,'name');?>			
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