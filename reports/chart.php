<?php
if(isset($_REQUEST['report_by'])&&$_REQUEST['report_by']=="year")
{

}
?>
<table width="60%" align="center" border="1" bgcolor="#abubaker" class="text1">
<tr>
<td width="100%" align="center" height="500">
<?php
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 500, 250, 'http://'. $_SERVER['SERVER_NAME'] .':8080/NCT_SYSTEM/chart-data.php', false );?>
</td></tr></table>