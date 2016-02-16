<?php
class alert {
	function __construct(){
	
	}
	function display(){
	
		$month=(int)date("n");
		$query1='SELECT count(*) as c FROM tb_employee WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 3 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 2 MONTH)) and des_salary<>0';
	
		$counter1=0;
		$counter2=0;
		$counter3=0;
		$counter4=0;
		$counter5=0;
		
		$result = mysql_query($query1);
		if($row = mysql_fetch_row($result)){
			$counter1=$row['0'];
		}
		
		$query1='SELECT count(*) as c FROM tb_employee WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 2 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 1 MONTH)) and des_salary<>0';
		$result = mysql_query($query1);
		if($row = mysql_fetch_row($result)){
			$counter2=$row['0'];
		}
		
		$query1='SELECT count(*) as c FROM tb_employee WHERE (end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 1 MONTH)) and (end_date > date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 0 MONTH)) and des_salary<>0';
		$result = mysql_query($query1);
		if($row = mysql_fetch_row($result)){
			$counter3=$row['0'];
		}
		
		$query1='SELECT count(*) as c FROM tb_employee WHERE (end_date <  date_format(now(),"%Y-%m-%d"))  and des_salary<>0';
		$result = mysql_query($query1);
		if($row = mysql_fetch_row($result)){
			$counter4=$row['0'];
		}
		
		$query1='SELECT count(*) as c FROM tb_employee WHERE ((test_end_date < date_add(date_format(now(),"%Y-%m-%d"),INTERVAL 15 Day))and(test_end_date > date_format(now(),"%Y-%m-%d"))and(des_salary<>0))';
		$result = mysql_query($query1);
		if($row = mysql_fetch_row($result)){
			$counter5=$row['0'];
		}
		
		if($counter1==0 && $counter2==0 && $counter3==0 && $counter4==0 && $counter5==0){
			return '';
		}
	
		
		
		$str= "<div class=\"displayBox\">";
		$str.= '<h4><span><a id ="displayBox" href="#" color="red">Important Alerts </a><!--img id="plus" name="plus" src="images/plus.gif"/--></span></h4>';
		$str.="<div class=\"box\"  style=\"5px 5px no-repeat\">";
		$str.="<dl>";
		
		if($counter1!=0){		
			$str.="	<div><ul><li><a href=\"custom_code/displayalert.php?type=1\" target=\"_BLANK\"><FONT COLOR=\"#990000\">You have a number($counter1) Contracts expire in three months</b></FONT></a></li</ul></div><br/>";
		}
							
		if($counter2!=0){		
			$str.="	<div><ul><li><a href=\"custom_code/displayalert.php?type=2\" target=\"_BLANK\"><FONT COLOR=\"#990000\">You have a number($counter2) Contracts expire in two months</b></FONT></a></li</ul></div><br/>";
		}
							
		if($counter3!=0){		
			$str.="	<div><ul><li><a href=\"custom_code/displayalert.php?type=3\" target=\"_BLANK\"><FONT COLOR=\"#990000\">You have a number($counter3) Contracts expire in  month</b></FONT></a></li</ul></div><br/>";
		}
							
		if($counter4!=0){		
			$str.="	<div><ul><li><a href=\"custom_code/displayalert.php?type=4\" target=\"_BLANK\"><FONT COLOR=\"#990000\">You have a number($counter4)Completed contracts</b></FONT></a></li</ul></div>";
		}
		
		if($counter5!=0){		
			$str.="	<div><ul><li><a href=\"custom_code/displayalert.php?type=5\" target=\"_BLANK\"><FONT COLOR=\"#990000\">You have a number($counter5)Contracts nearing completion on the probation period for them</b></FONT></a></li</ul></div>";
		}
							
		$str.="	</dl>";
		$str.="</div>";
		$str.="</div>";
		$hide=1;
		$script=' <script language="javascript">';
		$script.='$(document).ready(function(){';
		if($hide==1){
			$script.='$(".displayBox div.box").hide();';
		}else{
			$script.='$(".displayBox div.box").show();';
		}	
		$script.='';
		$script.='$(\'#displayBox\').click(function(){$(".displayBox div.box").toggle(200);});';
		$script.=' });';
		//$script.='$(\'#plus\').click(function(){$(\'#plus\').atrr(\'src\',\'images/muns.gif\');});';
		$script.='</script> ';
		
		return $str.$script;
	}

}
?>