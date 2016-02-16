<?php 
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
  //return $pageURL;
  return 'index.php?';
}
function curPageParamter($notThis) {
    $paramters="";
	$escparapters = explode("+", $notThis);
	foreach($_REQUEST as $param => $val) { 
	 if(!in_array($param,$escparapters))
		 $paramters .= $param.'='.$val.'&'; 
	}
	$paramters = substr($paramters,0,strlen($paramters)-1);
	return $paramters;
}
function getCurPageParamter($notThis) {
    $paramters="";
	$escparapters = explode("+", $notThis);
	foreach($_REQUEST as $param => $val) { 
	 if(in_array($param,$escparapters))
		 $paramters .= $param.'='.$val.'&'; 
	}
	$paramters = substr($paramters,0,strlen($paramters)-1);
	return $paramters;
}

function Getexper($emp_id){
$rs_select_emp=mysql_query("select *from tb_employee where id=$emp_id");

	$bdate=mysql_result($rs_select_emp,0,'begin_date');
	$pdate=mysql_result($rs_select_emp,0,'prom_date');
	$rptdate=date("Y-m-d");






}
?>

