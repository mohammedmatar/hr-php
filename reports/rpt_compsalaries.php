<?php 
include("../config.php");
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
$rs_section1=mysql_query("select *from tb_section where id <>8 order by name");
$f=mysql_num_rows($rs_section1);
$salarray=array();


for($js=0;$js < $f ;$js++){
$salarray[$js]=0;
$sum_sal=0;
$id1=@mysql_result($rs_section1,$js,'id');


	$rs_emp=mysql_query("select *from tb_employee   where des_salary=1 and section_id=$id1;");
	//echo "select *from tb_employee   where des_salary=1 and section_id=$idsec";
	
	$xemp=mysql_num_rows($rs_emp);
	//echo $xemp."<hr>";


					for($i=0;$i<$xemp;$i++){
					//////////////الإجازة بدون أجر///////////
					$empholy= @mysql_result($rs_emp,$i,'id');
					$rs_holy=mysql_query("SELECT * FROM tb_holiy_emp WHERE 	emp_id=$empholy and hol_id=1 and begin_date <='$datehol' and end_date >='$datehol' ");
					$xholy=@mysql_num_rows($rs_holy);
					if ($xholy == 0 ){
				//////////////الإجازة بدون أجر نهاية///////////

					///////////////////////////////////////////
					$cat= @mysql_result($rs_emp,$i,'cat_id');
					$job= @mysql_result($rs_emp,$i,'job_id');
					$emp_id= @mysql_result($rs_emp,$i,'id');
					$status= @mysql_result($rs_emp,$i,'status_id');
					$chaild_count=@mysql_result($rs_emp,$i,'chaild_count');
					$exp_in=@mysql_result($rs_emp,$i,'exp_in');
					/*-----------حساب سنوات الخبرة داخل  الشركة--------------------------*/
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
					///echo $sum_sal."<hr>";
					
//$salarray[$j]=$sum_sal;

	
}

}
$salarray[$js]=$sum_sal;

}

$allsalary=array_sum($salarray);

$r3=count($salarray);

$precent=array();
for($vv=0;$vv < $r3;$vv++){
$precent[$vv]=($salarray[$vv]/$allsalary)*100;
}
//echo $allsalary;


?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Salary Chart ....</title>
		
		
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/highcharts.js"></script>
		
		<!-- 1a) Optional: add a theme file -->
		<!--
			<script type="text/javascript" src="../js/themes/gray.js"></script>
		-->
		
		<!-- 1b) Optional: the exporting module -->
		<script type="text/javascript" src="js/modules/exporting.js"></script>
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				
				var colors = Highcharts.getOptions().colors,
					categories = [<?php for($ii=0;$ii < $f; $ii++){ echo "'".mysql_result($rs_section1,$ii,'name')."',";}?>],
					name = 'Disable Chart Salary',
					
					data = [
					<?php for($ii=0;$ii < $f;$ii++){?>
					{ 
							y: <?php echo round($precent[$ii]);?>,
							color: colors[<?php echo $ii;?>],
							drilldown: {
								name: '<?php echo mysql_result($rs_section1,$ii,'name');?>'
								//data: [4.55, 1.42],
								//color: colors[<?php echo $ii;?>]
							}
						}<?php echo ",";}?>
						];
						
				
				function setChart(name, categories, data, color) {
					chart.xAxis[0].setCategories(categories);
					chart.series[0].remove();
					chart.addSeries({
						name: name,
						data: data,
						color: color || 'white'
					});
				}
				
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container', 
						type: 'column'
					},
					title: {
						text: '<?php echo "Salary Of  Month ".$_POST['month']." Year  ".$_POST['year'];?>'
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: categories							
					},
					yAxis: {
						title: {
							text: 'Total Basic Salary '
						}
					},
					plotOptions: {
						column: {
							cursor: 'pointer',
							point: {
								events: {
									click: function() {
										var drilldown = this.drilldown;
										if (drilldown) { // drill down
											setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
										} else { // restore
											setChart(name, categories, data);
										}
									}
								}
							},
							dataLabels: {
								enabled: true,
								color: colors[0],
								style: {
									fontWeight: 'bold'
								},
								formatter: function() {
									return this.y +'%';
								}
							}					
						}
					},
					tooltip: {
						formatter: function() {
							var point = this.point,
								s = this.x +':<b>'+ this.y +'% percentage</b><br/>';
							if (point.drilldown) {
								s += '';
							} else {
								s += '';
							}
							return s;
						}
						
					},
					series: [{
						name: name,
						data: data,
						color: 'white'
					}],
					exporting: {
						enabled: false
					}
				});
				
				
			});
				
		</script>
		
	</head>
	<body>
		<div align="center">
		<table width=80% border=1 style="border: 3px double #996600; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" bgcolor="#FBFBFB"><tr><td>
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
</td></tr>
		</table>
				
		</div>
				
	</body>
</html>