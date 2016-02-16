<?php 
//mysql_query("SET NAMES 'utf8'");
if(!empty($_GET["mess"]))
	$mess=$_GET["mess"];
	
//--------------------------Command Save----------------------------
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
	$rs_save=mysql_query("insert into  tb_coll_overtime(emp_id,year,month,h1,h2,h3)values($_GET[emp_id],$_POST[year],$_POST[month],$_POST[h1],$_POST[h2],$_POST[h3])");
	if($rs_save){
		$mess="data saved";
		$new_emp_id = mysql_query("SELECT LAST_INSERT_ID() as id");
		$lrow = mysql_fetch_row($new_emp_id);
		header("location: index.php?mnu_id=2&page=collaborator_overtime.php&emp_id=".$_GET[emp_id]."&mess=".$mess."&id=".$lrow[0]);
	}else
		$mess="data not saved";
}
//--------------------------Command Update----------------------------
if(!empty($_POST["save"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query(" update tb_coll_overtime  set 
				year=$_POST[year],
				month=$_POST[month],
				h1=$_POST[h1],
				h2=$_POST[h2],
				h3=$_POST[h3]	
			where id=$_GET[id] ");
	if($rs_save)
		$mess="update successfully";
	else
		$mess="update failed !";
}
//--------------------------Command Delete----------------------------
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from    tb_coll_overtime   where id=$_GET[id] ");
	if($rs_save){
		$mess="successful delition";
		header("location: index.php?mnu_id=2&page=collaborator_overtime.php&emp_id=".$_GET[emp_id]."&mess=".$mess);
	}else
		$mess="deletion failed !";
}

//---------------------------Load overtime Data----------------------------------
if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select * from    tb_coll_overtime  where id=$_GET[id]");
}
//---------------------------Load Employee Data----------------------------------
$rs_emp=mysql_query("select *from tb_collaborator where id=$_GET[emp_id]");
$_SESSION["emp_id"]=mysql_result($rs_emp,0,'id');
$_SESSION["emp_name"]=mysql_result($rs_emp,0,'name');
//---------------------------Command search----------------------------------	
if(!empty($_POST["search"])){
	header("location: index.php?mnu_id=2&page=collaborator_search_overtime.php");
}
//////////////////Command search////////////////////////////////
if(!empty($_POST["new"])){
header("location: ".curPageURL().getCurPageParamter('mnu_id+page+emp_id'));
}
?>

<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>

<body>

<form method="POST" action="" name="loan">

<div align="center">

<table border="0" width="70%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<!--tr>
		<td colspan="6" class="tdtitleemp">extra payment</td>
	</tr-->
	<tr>
		<td colspan="6" class="tdtitleemp"><?php echo $_SESSION["emp_name"];?></td>
	</tr>
	
	<tr>
		<td width="86%"  colspan="6" class="message">
		<?php echo $mess; ?></td>
	</tr>
	<tr>
		<td width="17%" height="25" align="left"><b><font size="2">Month</font></b></td>
		<td width="16%" height="25">
<?php if(!empty($_GET["id"])) $monthselect= @mysql_result($rs_select,0,'month');else $monthselect=date("m")-1;?>	

	<select size="1" name="month" style="font-weight: 700">
		<option value="01" <?php if(($monthselect==1 ) || (date('m')=='01' && (empty($_GET["id"])))) echo "selected";?>>Jan</option>
		<option value="02" <?php if(($monthselect==2 ) || (date('m')=='02' && (empty($_GET["id"])))) echo "selected";?>>Feb</option>
		<option value="03" <?php if(($monthselect==3 ) || (date('m')=='03' && (empty($_GET["id"])))) echo "selected";?>>Mar</option>
		<option value="04" <?php if(($monthselect==4 ) || (date('m')=='04' && (empty($_GET["id"])))) echo "selected";?>>Apr</option>
		<option value="05" <?php if(($monthselect==5 ) || (date('m')=='05' && (empty($_GET["id"])))) echo "selected";?>>May</option>
		<option value="06" <?php if(($monthselect==6 ) || (date('m')=='06' && (empty($_GET["id"])))) echo "selected";?>>Jun</option>
		<option value="07" <?php if(($monthselect==7 ) || (date('m')=='07' && (empty($_GET["id"])))) echo "selected";?>>july</option>
		<option value="08" <?php if(($monthselect==8 ) || (date('m')=='08' && (empty($_GET["id"])))) echo "selected";?>>Aug</option>
		<option value="09" <?php if(($monthselect==9 ) || (date('m')=='09' && (empty($_GET["id"])))) echo "selected";?>>Sep</option>
		<option value="10" <?php if(($monthselect==10) || (date('m')=='10' && (empty($_GET["id"])))) echo "selected";?>>Oct</option>
		<option value="11" <?php if(($monthselect==11) || (date('m')=='11' && (empty($_GET["id"])))) echo "selected";?>>Nov</option>
		<option value="12" <?php if(($monthselect==12) || (date('m')=='12' && (empty($_GET["id"])))) echo "selected";?>>Dec</option>
		</select></td>
		<td width="16%" height="25" align="left"><b><font size="2">year</font></b></td>
		<td width="45%" height="25" colspan="3">
		<?php if(!empty($_GET["id"])) $yearselect= @mysql_result($rs_select,0,'year');?>	

		<select size="1" name="year" style="font-weight: 700">
		<option value="2010" <?php if(($yearselect==2010) || (date('Y')==2010 && (empty($_GET["id"])))) echo "selected";?>>2010</option>
		<option value="2011" <?php if(($yearselect==2011) || (date('Y')==2011 && (empty($_GET["id"])))) echo "selected";?>>2011</option>
		<option value="2012" <?php if(($yearselect==2012) || (date('Y')==2012 && (empty($_GET["id"])))) echo "selected";?>>2012</option>
		<option value="2013" <?php if(($yearselect==2013) || (date('Y')==2013 && (empty($_GET["id"])))) echo "selected";?>>2013</option>
		<option value="2014" <?php if(($yearselect==2014) || (date('Y')==2014 && (empty($_GET["id"])))) echo "selected";?>>2014</option>
		<option value="2015" <?php if(($yearselect==2015) || (date('Y')==2015 && (empty($_GET["id"])))) echo "selected";?>>2015</option>
		<option value="2016" <?php if(($yearselect==2016) || (date('Y')==2016 && (empty($_GET["id"])))) echo "selected";?>>2016</option>
		<option value="2017" <?php if(($yearselect==2017) || (date('Y')==2017 && (empty($_GET["id"])))) echo "selected";?>>2017</option>
		<option value="2018" <?php if(($yearselect==2018) || (date('Y')==2018 && (empty($_GET["id"])))) echo "selected";?>>2018</option>
		<option value="2019" <?php if(($yearselect==2019) || (date('Y')==2019 && (empty($_GET["id"])))) echo "selected";?>>2019</option>
		<option value="2020" <?php if(($yearselect==2020) || (date('Y')==2020 && (empty($_GET["id"])))) echo "selected";?>>2020</option>
		</select></td>
	</tr>
	<tr>
		<td width="17%" height="25" align="left"><font size="2"><b>offecial hours</b></font></td>
		<td width="17%" height="25"><input name="h1" size="10" AUTOCOMPLETE="Off"   class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'h1');else echo "0";?>" style="font-weight: 700"></td>
	</tr>
	<tr>	
		<td width="17%" height="25" align="left"><font size="2"><b>vecation hours</b></font></td>
		<td width="17%" height="25"><input name="h2" size="10" AUTOCOMPLETE="Off"   class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'h2');else echo "0";?>" style="font-weight: 700"></td>
	</tr>
	<tr>	
		<td width="17%" height="25" align="left"><b><font size="2">off days hours </font></b></td>
		<td width="17%" height="25"><input name="h3" size="10" AUTOCOMPLETE="Off"   class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'h3');else echo "0";?>" style="font-weight: 700"></td>
	</tr>
	<tr>
		<td colspan="6">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633" dir="rtl">
				<tr>
					<td>
					<input type="submit" value="new" name="new" class="button"></td>
					<td>
					<input type="submit" value="save" name="save" class="button"></td>
					<td>
					<input type="submit" value="another employee" name="search" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
					<input type="submit" value="delete" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<div align="center">
<?php 
  
	$result = mysql_query("select count(*) as noOfrows from tb_coll_overtime where emp_id=$_GET[emp_id] ");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">السنة</td><td  align=\"center\" class=\"tdtitle\">الشهر</td></td><td  align=\"center\" class=\"tdtitle\">عادية</td></td><td  align=\"center\" class=\"tdtitle\">عطلات</td></td><td  align=\"center\" class=\"tdtitle\">إجازات</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select id,year,month,h1,h2,h3 from tb_coll_overtime  where emp_id=$_GET[emp_id]  order by year desc,month desc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[1]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[3]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[4]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[5]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+emp_id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"إختيار\" title=\"إختيار\" src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>
</html>