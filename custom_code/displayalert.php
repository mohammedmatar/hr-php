<?php
include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../css/temp.css" rel="stylesheet" type="text/css" />
</head>
<style>
body{
	direction:rtl;
}
table{
	border:1px solid #505050;
	border-collapse:collapse;
}
td,th{
	border:1px solid #E8E8E8;
}
table.main{
	width:90%;
}
table.main th{
	background-color:#ffffcc;
	color:#000000;
}
</style>

<body  align="center">
<?php
$type=((!empty($_REQUEST['type']))?($_REQUEST['type']):('empty'));
$query='';
switch($type){
	case '1':$header="contracts expired over the next three months";$query='SELECT tb_employee.name,tb_section.name,come_date,begin_date,test_end_date,end_date FROM tb_employee left join tb_section on(section_id=tb_section.id) WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 3 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 2 MONTH))  and des_salary<>0 order by tb_section.name asc';break;
	case '2':$header="contracts expired over the next two months";$query='SELECT tb_employee.name,tb_section.name,come_date,begin_date,test_end_date,end_date FROM tb_employee left join tb_section on(section_id=tb_section.id) WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 2 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 1 MONTH)) and des_salary<>0 order by tb_section.name asc';break;
	case '3':$header="contracts expired in a month";$query='SELECT tb_employee.name,tb_section.name,come_date,begin_date,test_end_date,end_date FROM tb_employee left join tb_section on(section_id=tb_section.id) WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 1 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 0 MONTH)) and des_salary<>0 order by tb_section.name asc';break;
	case '4':$header="expired contracts";$query='SELECT tb_employee.name,tb_section.name,come_date,begin_date,test_end_date,end_date FROM tb_employee left join tb_section on(section_id=tb_section.id) WHERE (end_date <  date_format(now(),"%Y-%m-%d")) and des_salary<>0 order by tb_section.name asc';break;
	case '5':$header="cotracts nearly completed the testing period";$query='SELECT tb_employee.name,tb_section.name,come_date,begin_date,test_end_date,end_date FROM tb_employee left join tb_section on(section_id=tb_section.id) WHERE ((test_end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 15 Day))and(test_end_date > date_format(now(),"%Y-%m-%d"))and(des_salary<>0))';break;
	default:echo 'Wrong alert type.';exit;
}
/*********select alert data*****************/
echo '<div  align="center"><b>';
echo '<br /><img height="96" width="101" src="../images/logo.jpg" align="center" />';
echo '<br />LATD TECHNOLOGY';
echo '<br /><h3>'.$header.'</h3></b></div>';

echo '<table class="main"  align="center">';
echo '<tr>';
echo '	<th style="width:20px">#</th>';
echo '	<th style="width:110px">Employee</th>';
echo '	<th style="width:90px">Department</th>';
echo '	<th style="width:80px">Hiring Date</th>';
echo '	<th style="width:80px">Starting Date</th>';
echo '	<th style="width:80px">End of Testing period</th>';
echo '	<th style="width:80px">Contract Epirement Date</th>';
echo '</tr>';

//echo $query;
$result = mysql_query($query);
$odd_even='odd';
$counter=0;
while($row = @mysql_fetch_row($result)){
	$counter+=1;
	echo '<tr class="'.$odd_even.'">';
	echo '	<td style="width:20px;text-align:center">'.$counter.'	</td>';
	echo '	<td style="width:110px;text-align:center">'.$row['0'].'	</td>';//name
	echo '	<td style="width:90px;text-align:center">'.$row['1'].'	</td>';//dept
	echo '	<td style="width:80px;text-align:center">'.$row['2'].'	</td>';//test_end_date
	echo '	<td style="width:80px;text-align:center">'.$row['3'].'	</td>';//end_date
	echo '	<td style="width:80px;text-align:center">'.$row['4'].'	</td>';//end_date
	echo '	<td style="width:80px;text-align:center">'.$row['5'].'	</td>';//end_date

	echo '</tr>';
	
	if($odd_even=='odd'){
		$odd_even='even';
	}else{
		$odd_even='odd';
	}
	

}//while

;
mysql_close($link);
?>
</body>
</html>