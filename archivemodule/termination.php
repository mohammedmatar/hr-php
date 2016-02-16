<?php 
//mysql_query("SET NAMES 'utf8'");

if(!empty($_GET["mess"]))
	$mess = $_GET["mess"];

if(isset($_POST['date']))
   $termDate =  $_POST['date'];
else $termDate = date('Y-m-d');

if(isset($_POST['other_amount']))
   $other_mony =  $_POST['other_amount'];
else $other_mony = "0";

$testQR = mysql_query("select count(*) as c from tb_term where emp_id=".$_GET["emp_id"]);
$founInTerm  = mysql_result($testQR,0,'c');
if(!empty($_POST["save"])&&(isset($_GET["updFiled"]))||($founInTerm > 0)){
	$updateF = 1;
}else $updateF = 0;

///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"])&&($updateF==0)){
	if(!empty($_POST["date"])){
		
		$rs_save=mysql_query("insert into tb_term (emp_id,term_id,date,other_mony)values($_GET[emp_id],$_POST[term_id],'$_POST[date]',$_POST[other_amount])");
		if($rs_save){
			$rs_emp_update=mysql_query("update tb_employee set des_salary=0 where id=$_GET[emp_id]");
			$mess="Saved";
		}else
			$mess="Not Saved";
	}else
		$mess="Please Compelete the Data";
}
///////////////////Command update///////////////////////////////
if(!empty($_POST["save"]) && ($updateF==1)){
	if(!empty($_POST['date'])){
		
		$updQuery=" update tb_term set term_id=".$_POST['term_id'].",date='".$_POST['date']."',other_mony=".$_POST['other_amount']." where emp_id=".$_GET['emp_id'];
		$rs_save=mysql_query($updQuery);
		if($rs_save){
			$mess="successful Update";
			
		}else
			$mess="Update Failed !";
			
	}else
		$mess="Please Compelete the Data".$_POST['date']."+".$_POST['other_amount'];
}

////////////////////////Command Delete///////////////////
if(!empty($_POST["delete"]) && !empty($_GET["emp_id"]) ){
	$rs_save=mysql_query("delete from tb_term where emp_id=$_GET[emp_id] ");
	if($rs_save){
		$rs_emp_update=mysql_query("update tb_employee set des_salary=1 where id=".$_GET['emp_id']);
		$mess="Successful Delete";
		header("location: index.php?mnu_id=2&page=termination.php&emp_id=".$_GET[emp_id]."&mess=".$mess);
	}else
		$mess="Delete Failed !";
}
	
	if(empty($_GET["pagging"]))
	$_GET["pagging"]=0;
	$rs_data=mysql_query("select * from  tb_term order by id desc  limit $_GET[pagging],$limit_lk");
	$x=mysql_num_rows($rs_data);
	$pub="3";
	
	if(empty($_POST["delete"])){
		$rs_select=mysql_query("select * from  tb_term where emp_id=".$_GET['emp_id']);
		
	}

if(!empty($_POST["save"])&&(isset($_GET["updFiled"]))||($founInTerm > 0)){
	$upddata =mysql_query("select * from tb_term where emp_id=".$_GET["emp_id"]);
	
	$termDate = @mysql_result($upddata,0,'date');
	$other_mony = @mysql_result($upddata,0,'other_mony');
	
}
	//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=emp_search_term.php ");
}
ss
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body>

<form method="POST" action="" name="term">

<div align="center">

<table border="0" width="80%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="4" class="tdtitle">End of Service</td>
	</tr>
	<tr>
		<td width="97%" colspan="4" class="tdtitle">
		<span lang="en-us"><?php if(empty($_GET["id"])) $emp=$_GET["emp_id"]; else $emp=@mysql_result($rs_select,0,'emp_id'); $rs_emp=mysql_query("select *from tb_employee where id=$emp"); echo @mysql_result($rs_emp,0,'name');?></span></td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message">
		<?php echo $mess;?></td>
	</tr>
	<tr>
		<td width="31%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Cause</b></font></span></td>
		<td width="22%" height="25" align="right">
		<select size="1" name="term_id" align="right">
		<?php 
		if(!empty($_GET["emp_id"])) $term_id=@mysql_result($rs_select,0,'term_id');
		$rs_term=mysql_query("select * from lk_term");
		$xterm=mysql_num_rows($rs_term);
		
		for($ii=0;$ii<$xterm;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_term,$ii,'id');?>" <?php if(mysql_result($rs_term,$ii,'id')==$term_id) echo "selected";?> ><?php echo mysql_result($rs_term,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="11%" height="25">
		<span lang="en-us"><font size="2"><b>Date</b></font></span></td>
		<td width="43%" height="25">
		<font size="2"><b>
		
		<input type="text" size="12" name="date" id="date" readonly="1" value="<?php echo $termDate;//@mysql_result($rs_select,0,'date'); ?>" />
		 <img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "date", "%Y-%m-%d");
				//]]></script>
		<!--span lang="en-us">
		</span><a href="#" onClick='javascript:window.open("calendar.php?form=term&field=date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="16" height="16"></a-->
		</b></font></td>
	</tr>
	<tr><td align="left"><span lang="en-us"><font size="2"><b>Other</b></font></span></td><td collspan="2"><input type="text" name="other_amount" AUTOCOMPLETE="Off"  value="<?php echo $other_mony;//@mysql_result($rs_select,0,'other_mony'); ?>"></td></tr>
	
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td><input type="hidden" value="<?php if(isset($_GET["updFiled"])) echo "1"; else echo "0";?>" id="updateF" name="updateF">
					<input type="submit" value="New" name="new" class="button"></td>
					<td>
					<input type="submit" value="Save" name="save" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
					<input type="submit" value="Delete" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>
<br />
<div align="center">
<?php 
    
	$result = mysql_query("select count(*) as noOfrows from tb_term");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td  align=\"center\" class=\"tdtitle\">Cause</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tb_term.id,tb_employee.name,lk_term.name,tb_term.emp_id from tb_term left join tb_employee on(tb_term.emp_id=tb_employee.id) left join lk_term on(tb_term.term_id=lk_term.id) order by tb_term.id desc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\" width=\"30\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+pagination_page')."&id=".$row[0]."&emp_id=".$row[3]."\"><img border=\"0\" alt=\"إختيار\" title=\"إختيار\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>
</div>
</body>

</html>