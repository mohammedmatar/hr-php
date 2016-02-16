
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-sa">
</head>

<table width="100%" style="border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; border-left-style:solid; border-left-width:1px; border-bottom-style:solid" dir="ltr">
	<?php 
	if($_SESSION["per"]!=3){
	?>
	<tr>
	<td class="tdtitle">Salaries</td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	

<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_salarymanager.php">
<span lang="en-us">S</span>alaries for all centers

<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_salarymanager_bank.php">
<span lang="en-us">S</span>alaries per center
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_manager_salafya.php">
<span lang="en-us">A</span>dvances view
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_salarymanager_taswia.php">
<span lang="en-us">T</span>otal settelment
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>


	<tr class="menu_link">
	<td  align ="right"  style="padding-right: 20px">
	
<p align="left">
	
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_association.php">
<span lang="en-us">C</span>harity benefits
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
	</td>
	</tr>


	<tr>
	<td class="tdtitle"><span lang="en-us">Extra Payment</span></td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	

<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_overtime.php">
<span lang="en-us">E</span>mployees extra payment

<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=emp_searchovertime.php">
<span lang="en-us">E</span>xtra payment per employee

<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
	<tr>
	<td class="tdtitle">Social Insurance</td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	

<!--tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_insurance.php">
<span lang="en-us">S</span>ocial insurance for employee

<!--hr size="1" color="#EBEBEB"></hr-->
<!--/a>
</td></tr-->
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_insuranceforbox.php">
<span lang="en-us">A</span>ddition and discount
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>


<tr>
	<td class="tdtitle"><span lang="en-us">G</span>eneral <span lang="en-us">R</span>eports</td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	

<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_emp_term.php">
<span lang="en-us">E</span>nd of service benifits
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=rpt_Garanal.php">
<span lang="en-us">D</span>etailed report
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<?php } else {?>

<tr>
	<td class="tdtitle">Time & Attendance</td>
	</tr>
	<tr class="menu_link"><td style="padding-right: 5px" align="center">	

<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=amsDailyrpt.php">
<span lang="en-us">A</span>ttendance per department for employees


<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=amsrpt.php">
<span lang="en-us">M</span>onthly attendance for employees
<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
<a href="index.php?mnu_id=<?php echo  $_GET["mnu_id"];?>&page=amsDailyrptall.php">
<span lang="en-us">D</span>aily attendance for employees


<!--hr size="1" color="#EBEBEB"></hr-->
</a>
</td></tr>
<tr class="menu_link">
	<td style="padding-right:20px" align="left" color="#EBEBEB">
&nbsp;</td></tr>
<?php }?>
</table>
