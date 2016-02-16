<?php 
$rs_emp=mysql_query("select *from tb_employee where id=$_GET[id]");
$emp_id=mysql_result($rs_emp,0,'id');
$rs_allow=mysql_query("select *from tb_allow where id=$_GET[id] ");
if($rs_allow)
$xallow=mysql_num_rows($rs_allow);

///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && !empty($_GET["id"]) && $xallow <= 0 ){
if(!empty($_GET["id"])){
//mysql_query("SET NAMES 'utf8'");
$rs_save=mysql_query("insert into tb_allow (fl_cloth,fl_manager,fl_cashequal,fl_gravity,fl_mobil,fl_tension,fl_capital1,fl_sal_differ,fl_work,id)
values($_POST[cloth],$_POST[manager],$_POST[flcash],$_POST[qravity],$_POST[mobil],$_POST[tension],$_POST[capital1],$_POST[sal_differ],$_POST[work],$_GET[id])");
if($rs_save)
$mess="تم حفظ البيانات";

else
$mess="لم يتم حفظ البيانات";
}
else
$mess="الرجاء إكمال البيانات";
}
if(!empty($_POST["save"]) && !empty($_GET["id"]) && $xallow >0   ){
$rs_save=mysql_query(" update  tb_allow set 
				fl_cloth=$_POST[cloth],
				fl_manager=$_POST[manager],
				fl_cashequal=$_POST[flcash],
				fl_gravity=$_POST[qravity],
				fl_mobil=$_POST[mobil],
				fl_tension=$_POST[tension],
				fl_capital1=$_POST[capital1],
				fl_sal_differ=$_POST[sal_differ],
				fl_work=$_POST[work]


		where id=$_GET[id] ");
if($rs_save)
$mess="تم تعديـــل البيانات بنجاح";
else
$mess="لم يتم تعديل البيانات !";
}
/////////////////////////////////////////////////////////////

if(empty($_GET["pagging"]))
$_GET["pagging"]=0;

if(!empty($_GET["id"])){
$rs_select=mysql_query("select *from  tb_allow where id=$_GET[id]");
if($rs_select)
$xsel=mysql_num_rows($rs_select);
if($xsel <= 0)
$rs_select=mysql_query("select *from  tb_employee where id=$_GET[id]");
}
//////////////////Command search////////////////////////////////
if(!empty($_POST["search"])){
header("location: index.php?mnu_id=2&page=emp_search.php ");
}

?>
<head>
<script language=javascript >
function myload(){
<?php/*
while(list($key,$val)=each($_POST)){
	echo" document.emp.".$key.".value='$val';\n";
}*/
?>
}

</script>
</head>
<body onload="myload()">

<form method="POST" action="" name="emp">
<div><div><?php if( !empty($_GET["id"]) || isset($_SESSION['emp_id']))
	@include("menu.php");
?></div>
<div align="center">
<table width="80%" style="border-style:solid; border-width:1px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="rtl" class="tb_bgcolrform">
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">البــــدلات</td>
	</tr>
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">
		<?php  echo $_SESSION['emp_name'];?>
		</td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message"><?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="20%" height="25" align="left"><font size="2"><b>مظهر</b></font></td>
		<td width="30%" height="25">
		<input type="text" name="cloth" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"]) && @mysql_result($rs_select,0,'fl_cloth')!="") echo @mysql_result($rs_select,0,'fl_cloth'); else echo "0";?>"></td>
		<td width="13%" height="25" align="left">
		<font size="2"><b>إدارة</b></font></td>
		<td width="33%" height="25">
		<?php if(!empty($_GET["id"])) $tmanager= @mysql_result($rs_select,0,'fl_manager'); ?>
		<select size="1" name="manager">
		<option value="0" <?php if ( $tmanager==0) echo "selected";?>>0</option>
		<option value="50" <?php if ( $tmanager==50) echo "selected";?>>50</option>
		<option value="250" <?php if ( $tmanager==250) echo "selected";?>>250</option>
		<option value="500" <?php if ( $tmanager==500) echo "selected";?>>500</option>
		<option value="1000" <?php if ( $tmanager==1000) echo "selected";?>>1000</option>

		</select></td>
	</tr>
	<tr>
		<td width="20%" height="25" align="left"><font size="2"><b>نت</b></font></td>
		<td width="30%" height="25">
		<input type="text" name="qravity" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"]) && @mysql_result($rs_select,0,'fl_gravity')!="") echo @mysql_result($rs_select,0,'fl_gravity'); else echo "0";?>"></td>
		<td width="13%" height="25" align="left"><font size="2" ><b>طبيعة عمل</b></font></td>
		<td width="33%" height="25">
				<?php if(!empty($_GET["id"])) $twork= @mysql_result($rs_select,0,'fl_work'); ?>

		<select size="1" name="work">
				<option value="1" <?php if ( $twork==1) echo "selected";?>>يستحق</option>
				<option value="0" <?php if ( $twork==0) echo "selected";?>>لا سيتحق</option>
				</select></td>
	</tr>
	<tr>
		<td width="20%" height="25" align="left"><font size="2"><b>هاتف</b></font></td>
		<td width="30%" height="25">
				<?php if(!empty($_GET["id"])) $tphone= @mysql_result($rs_select,0,'fl_mobil'); ?>

		<select size="1" name="mobil">
		<option value="0" <?php if($tphone==0) echo "selected";?>>0</option>
		<option value="50" <?php if($tphone==50) echo "selected";?>>50</option>
		<option value="200" <?php if($tphone==200) echo "selected";?>>200</option>
		<option value="400" <?php if($tphone==400) echo "selected";?>>400</option>
		<option value="1000" <?php if($tphone==1000) echo "selected";?>>1000</option>

		</select></td>
		<td width="13%" height="25" align="left"><font size="2"><b>توتر</b></font></td>
		<td width="33%" height="25">
		<input type="text" name="tension" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"]) &&  @mysql_result($rs_select,0,'fl_tension')!="") echo @mysql_result($rs_select,0,'fl_tension'); else echo "0";?>"></td>
	</tr>
	<tr>
		<td width="20%" height="26" align="left"><font size="2"><b>عاصمة</b></font></td>
		<td width="30%" height="26">
		<input type="text" name="capital1" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"]) && @mysql_result($rs_select,0,'fl_capital1')!="") echo @mysql_result($rs_select,0,'fl_capital1'); else echo "0";?>"></td>
		<td width="13%" height="26" align="left"><font size="2"><b>فرق راتب</b></font></td>
		<td width="33%" height="26">
		<input type="text" name="sal_differ" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])&& @mysql_result($rs_select,0,'fl_sal_differ')!="") echo @mysql_result($rs_select,0,'fl_sal_differ'); else echo "0";?>"></td>
	</tr>
	<tr>
		<td width="20%" height="24" align="left"><b>مكافئة</b></td>
		<td width="30%" height="24" colspan="3">
		<select size="1" name="flcash">
		<?php if(!empty($_GET["id"])) $tcash= @mysql_result($rs_select,0,'fl_cashequal'); ?>

		<option value="0" <?php if($tcash==0) echo "selected";?>>0</option>
		<option value="300" <?php if($tcash==300) echo "selected";?>>300</option>
		<option value="500" <?php if($tcash==500) echo "selected";?>>500</option>
		</select></td>
		
	</tr>
	<tr>
		<td colspan="4">
		&nbsp;</td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
  
	$result = mysql_query("select count(*) as noOfrows from tb_employee");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">الاسم</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from tb_employee order by name asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"إختيار\" title=\"إختيار\" src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	//echo '<br />'.$table;
	//echo $testPage->display_pages();
  ?>
</div>
</body>
</html>