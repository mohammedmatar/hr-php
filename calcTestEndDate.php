<?php
session_start();
if($_SESSION["login"]!=1){
	header("location: login.php");
}
 include("config.php");
			$counter1 = 0 ;
			$counter2 = 0 ;
			$queryString = 'select year(begin_date) as year,month(begin_date) as month,day(begin_date) as day ,name,begin_date,id from tb_employee ';//WHERE des_salary <>0 $db->real_escape_string();
			$result = mysql_query($queryString);
			while ($row = mysql_fetch_row($result)) {
				$begindateY = $row[0];
				$begindateM = $row[1];
				$begindateD = $row[2];
				$enddateY = date('Y');
				$enddateM = date('m');
				$enddateD = date('d');
				
				$datediff = date_difference(array ('year' => $begindateY, 'month' => $begindateM, 'day' => $begindateD) , array ('year' => $enddateY, 'month' => $enddateM, 'day' => $enddateD));
				
				$dateOneYearAdded = strtotime(date("Y-m-d", strtotime($row[4])) . " +4 month");	
				$endDate = date('Y-m-d', $dateOneYearAdded);
				
				$query = "update tb_employee set test_end_date ='".$endDate."' where id = ".$row[5];
				
				$res= mysql_query($query);
				if($res)
					$counter1++;
				else 
					$counter2++;
				
				}
		echo 'Succ = '.$counter1.' Failed = '.$counter2;
function smoothdate ($year, $month, $day)
{
    return sprintf ('%04d', $year) . sprintf ('%02d', $month) . sprintf ('%02d', $day);
}
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
?>