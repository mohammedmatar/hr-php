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
$deptcount=array();


for($js=0;$js < $f ;$js++){
$deptcount[$js]=0;

$id1=@mysql_result($rs_section1,$js,'id');


	$rs_emp=mysql_query("select count(id) as empid from tb_employee   where des_salary=1 and section_id=$id1;");
	
$deptcount[$js]=mysql_result($rs_emp,0,'empid');	
	
	
}
//echo $allsalary;

$xc=count($deptcount);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Count Employ By Depatrment....</title>
		
		
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
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Count Employ By Depatrment'
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						data: [
						<?php for($jj=0;$jj <$xc;$jj++){?>
						
							['<?php echo mysql_result($rs_section1,$jj,'name');?>',   <?php echo round($deptcount[$jj]);?>],
							<?php }?>
							
							
						]
					}]
				});
			});
				
		</script>
		
	</head>
	<body>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
		
				
	</body>

</html>