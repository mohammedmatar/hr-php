<div align="center">
<table border="1" width="80%" id="table1" style="border:2px solid #244893; border-collapse: collapse; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr">
	<tr class="sub_menu_emp" >
		<td class="sub_menu_emp">
		<a href="index.php?mnu_id=<?php echo $_GET["mnu_id"];?>&page=employee.php&id=<?php echo $_SESSION['emp_id']/*mysql_result($rs_select,0,'id')*/;?>">
		Basic Iformation</a></td>
		<td class="sub_menu_emp">
		<a href="index.php?mnu_id=<?php echo $_GET["mnu_id"];?>&page=employee_jop_details.php&id=<?php echo $_SESSION['emp_id']/*mysql_result($rs_select,0,'id')*/;?>">
		Job Detils</a></td>
		<td class="sub_menu_emp">
		<a href="index.php?mnu_id=<?php echo $_GET["mnu_id"];?>&page=allowance.php&id=<?php echo $_SESSION['emp_id']/*mysql_result($rs_select,0,'id')*/;?>">
		Emp Allowance</a></td>
		<td class="sub_menu_emp">
		<a href="index.php?mnu_id=<?php echo $_GET["mnu_id"];?>&page=tax.php&id=<?php echo $_SESSION['emp_id']/*mysql_result($rs_select,0,'id')*/;?>">
		Emp Tax</a></td>
		<!--td class="sub_menu_emp"><span lang="ar-sa">الأرشيف</span></td-->
	</tr>
</table>
</div>
