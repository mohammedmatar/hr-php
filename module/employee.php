<?php 
//mysql_query("SET NAMES 'utf8'");

if(!empty($_GET["mess"]))
	$mess = $_GET["mess"];
	
if(!empty($_GET["id"])){
	$_SESSION['emp_id'] = $_GET["id"];
}	
///////////////////Command Save///////////////////////////////
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
	
	if(!empty($_POST["name"])){
		$rs_save=mysql_query("insert into   tb_employee (name,status_id,work_id,emp_number,bdate,fulladdress,phone1,phone2,phone3,sex,chaild_count,bank_id,acc_bank,tameen_date,active,email)
		values('$_POST[name]',$_POST[status_id],$_POST[work_id],$_POST[emp_number],'$_POST[bdate]','$_POST[fulladdress]',$_POST[phone1],$_POST[phone2],$_POST[phone3],$_POST[sex],$_POST[chaild_count],$_POST[bank_id],$_POST[acc_bank],'$_POST[tameen_date]',$_POST[active],'$_POST[email]')");
		if($rs_save){
		$mess="data saved";
			$new_emp_id = mysql_query("SELECT LAST_INSERT_ID() as id");
			$lrow = mysql_fetch_row($new_emp_id);
			$_SESSION['emp_id'] = $lrow[0];
			$_SESSION['emp_name'] = $_POST["name"];
			header("location: index.php?mnu_id=2&page=employee.php&emp_id=".$_GET[emp_id]."&mess=".$mess);
		}else
		$mess="data is not saved";
	}else
		$mess="pleace complete the data";
}
///////////////////Command save -update- ///////////////////////////////
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["name"]) ){
		$rs_save=mysql_query(" update   tb_employee set 
			name  ='$_POST[name]'  ,
			status_id =$_POST[status_id],
			work_id=    $_POST[work_id],
			emp_number=    $_POST[emp_number] ,
			bdate =   '$_POST[bdate]',
			fulladdress=    '$_POST[fulladdress]',
			phone1 =    $_POST[phone1],
			phone2= $_POST[phone2],
			phone3=$_POST[phone3],
			sex=$_POST[sex],
			chaild_count=$_POST[chaild_count] ,
			bank_id =   $_POST[bank_id]  ,
			acc_bank=  $_POST[acc_bank],				
			tameen_date='$_POST[tameen_date]',
			active=$_POST[active],
			email='$_POST[email]'	
		where id=$_GET[id] ");
		if($rs_save){
		$mess="update successful";
			$_SESSION['emp_name'] = $_POST["name"];
		}else
		$mess="update failed !";
	}
/////////////////////////Command Delete///////////////////
if($_GET["op"]=="Delete" && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from   tb_employee where id=$_GET[id] ");
	if($rs_save){
		$mess="delete successful";
		unset($_SESSION['emp_id']);
		unset($_SESSION['emp_name']);
		header("location: index.php?mnu_id=2&page=employee.php&mess=".$mess);
	}else
		$mess="Delete Failed";
	}

/*if(empty($_GET["pagging"]))
	$_GET["pagging"]=0;
*/
if(empty($_POST["new"]) && empty($_POST["delete"]) && empty($_POST["search"]) && empty($_POST["save"]) && empty($_GET["id"])){
   unset($_SESSION['emp_id']);
}

$rs_data=mysql_query("select *from   tb_employee where des_salary <>0 order by name limit $_GET[pagging],$limit_lk");
$x=mysql_num_rows($rs_data);
$pub="3";
if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select *from   tb_employee where id=$_GET[id]");
	$_SESSION['emp_name'] = @mysql_result($rs_select,0,'name');
}else if(isset($_SESSION['emp_id'])){
	$rs_select=mysql_query("select * from   tb_employee where id=".$_SESSION['emp_id']);
	$_SESSION['emp_name'] = @mysql_result($rs_select,0,'name');
}
//////////////////Command New////////////////////////////////
if(!empty($_POST["new"])){
	$_SESSION['emp_name'] = 'basic information';
	header("location: index.php?mnu_id=2&page=employee.php ");
}
if(!empty($_POST["search"])){
	header("location: index.php?mnu_id=2&page=emp_search.php ");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title></title>
<script language=javascript >
function myload(){
<?php
while(list($key,$val)=each($_POST)){
	echo" document.emp.".$key.".value='$val';\n";
}
?>
}
function deleteImage(x){
var conf = confirm("confirm delete ?");
if(conf == true){
window.location = "index.php?mnu_id=2&op=Delete&page=employee.php&id="+x;
}
}

</script>
</head>

<body onload="myload()">

<form method="POST" action="" name="emp">
<div><?php if( !empty($_GET["id"]) || isset($_SESSION['emp_id']))
	@include("menu.php");
?>
</div>
<div align="center">

<table width="80%" style="border-style:solid; border-width:1px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">employee personal information</td>
	</tr>
	<tr>
		<td width="98%" align="left" colspan="4" class="tdtitleemp">
		<?php echo $_SESSION['emp_name']; ?>
		</td>
	</tr>
	<tr>
		<td width="98%"  colspan="4" class="message"><?php echo $mess;?></td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>employee name</b></font></span></td>
		<td width="25%" height="25"><input type="text" name="name" size="17" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'name');?>">	</td>
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>job/functional id</b></font></span></td>
		<td width="36%" height="25"><input type="text" name="emp_number" id="emp_number" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'emp_number');else echo "0";?>" ><span lang="en-us"><span id="usercheck" style="padding-left:10px; ; vertical-align: middle;"></span>
</td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left"><font size="2"><b>gender</b></font></td>
		<td width="25%" height="25"><font size="3">
		<select size="1" name="sex">
		<option>-----</option>
		<option value="1" <?php if(mysql_result($rs_select,0,'sex')==1) echo "selected";?> >male</option>
		<option value="2" <?php if(mysql_result($rs_select,0,'sex')==2) echo "selected";?>>female</option>
		</select></font>
		</td>
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>birth date</b></font></span></td>
		<td width="36%" height="25">
		<font size="2"><b><input type="text" size="8" name="bdate" id="bdate" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'bdate'); else echo "0000-00-00";?>" />
		<img id="f_btn2"  src="images/calendar.jpg" />	 
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn2", "bdate", "%Y-%m-%d");
				//]]></script>	
		</b></font>
		</td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left" valign="top">
		<span lang="en-us"><font size="2"><b>job center</b></font></span></td>
		<td width="25%" height="25" valign="top">
		<select size="1" name="work_id">
		<option>-----</option>
		<?php 
		if(!empty($_GET["id"])) $work_id=@mysql_result($rs_select,0,'work_id');
		$rs_work=mysql_query("select *from lk_work  order by name asc");
		$xwork=mysql_num_rows($rs_work);
		
		for($ii=0;$ii<$xwork;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_work,$ii,'id');?>" <?php if(mysql_result($rs_work,$ii,'id')==$work_id) echo "selected";?> ><?php echo mysql_result($rs_work,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="14%" height="25" align="left" valign="top">
		<span lang="en-us"><font size="2"><b>address</b></font></span></td>
		<td width="36%" height="25" valign="top">
		<input type="text" name="fulladdress" size="41" AUTOCOMPLETE="Off"   value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'fulladdress'); else echo "Sudan";?>"></td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left"><font size="2"><b>social status</b></font></td>
		<td width="25%" height="25">
		<select size="1" name="status_id">
		<option>-----</option>
		<?php 
		if(!empty($_GET["id"])) $status_id=@mysql_result($rs_select,0,'status_id');
		$rs_status=mysql_query("select *from lk_status");
		$xstatus=mysql_num_rows($rs_status);
		
		for($ii=0;$ii<$xstatus;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_status,$ii,'id');?>" <?php if(mysql_result($rs_status,$ii,'id')==$status_id) echo "selected";?> ><?php echo mysql_result($rs_status,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="14%" height="25" align="left">
		<span lang="en-us"><font size="2"><b>children&nbsp; </b></font></span></td>
		<td width="36%" height="25"><font size="2"><b>
		<input type="text" name="chaild_count" size="10" AUTOCOMPLETE="Off"   class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'chaild_count');else echo "0";?>"></b></font></td>
	</tr>
	<tr>
		<td width="14%" height="25" align="left"><font size="2"><b>exchange center</b></font></td>
		<td width="25%" height="25">
		<select size="1" name="bank_id">
		<option value="0" <?php if ($bank_id==0)echo "selected";?> >-----</option>

		<?php 
		if(!empty($_GET["id"])) $bank_id=@mysql_result($rs_select,0,'bank_id'); else  $bank_id=0;
	
		$rs_bank=mysql_query("select *from lk_bank  order by name asc");
		$xbank=mysql_num_rows($rs_bank);
		
		for($ii=0;$ii<$xbank;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_bank,$ii,'id');?>" <?php if(mysql_result($rs_bank,$ii,'id')==$bank_id) echo "selected"; ?> ><?php echo mysql_result($rs_bank,$ii,'name');?></option>
		<?php }?>
		</select></td>
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>bank account number </b></font></span></td>
		<td width="36%" height="25">
		<font size="2"><b>
		<input type="text" name="acc_bank" size="10" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'acc_bank');else echo "0";?>"></b></font></td>
	</tr>
	<tr>
			<td width="14%" height="25" align="left"><span lang="en-us">
			<font size="2"><b>phone number 1</b></font></span></td>
			<td width="25%" height="25">
				<input type="text" name="phone1" size="10" AUTOCOMPLETE="Off"  class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'phone1');else echo "0";?>">
			</td>
			<td width="14%" height="25" align="left"><span lang="en-us">phone 
			number 2</span></td>
			<td width="25%" height="25">
			<input type="text" name="phone2" size="10" AUTOCOMPLETE="Off"  class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'phone2');else echo "0";?>">
			</td>
	</tr>
		<tr>
		<td width="14%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>social insurance number</b></font></span></td>
		<td width="25%" height="25">
		<input type="text" name="phone3" size="10" AUTOCOMPLETE="Off"  class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'phone3');else echo "0";?>">
		</td>
		<td width="14%" height="25" align="left"><span lang="en-us">insurance 
		date</span></td>
		<td width="25%" height="25">
		<input type="text" size="8" name="tameen_date" id="tameen_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'tameen_date');?>" />
		<img id="f_btn1"  src="images/calendar.jpg" />	
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "tameen_date", "%Y-%m-%d");
				//]]></script>		
		</td>
					<!--td valign="top" width="16">
		<font size="2"><b>
		<a href="#" onClick='javascript:window.open("calendar.php?form=emp&field=tameen_date","","top=200,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'><img border="0" src="images/b_calendar.png" width="16" height="16"></a></b></font></td-->
				</tr>
			
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<p align="left"><span lang="en-us"><font size="2"><b>active employee?</b></font></span></td>
		<td>
		<font size="3">
		<select size="1" name="active">
		<option>-----</option>
		<option value="1" <?php if(mysql_result($rs_select,0,'active')==1) echo "selected";?> >yes</option>
		<option value="0" <?php if(mysql_result($rs_select,0,'active')==0) echo "selected";?>>no</option>
		</select></font></td>
		<td>
		<p align="left"><span lang="en-us"><font size="2"><b>e_mail</b></font></span></td>
		<td>
		<input type="text" name="email" size="41" AUTOCOMPLETE="Off"   value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'email');?>"></td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="New" name="new" class="button"></td>
					<td>
					<input type="submit" value="Save" name="save" class="button"></td>
					<td>
					<input type="submit" value="Search" name="search" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;</td>
					<td>
					<input type="button" value="Delete" class="button" name="<?php echo $_GET['id']; ?>" onClick="deleteImage(<?php echo $_GET['id']; ?>)"style="cursor:pointer;">
					<!--input type="submit" value="Delete" name="delete" class="button"></td-->
				</tr>
			</table></div></td>
	</tr>
	<tr>
		<td colspan="4">
		<a href="reports/rpt_salarycard.php?id=<?php echo $_GET["id"];?>">salary certificate</a></td>
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
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">Name</td></td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select * from tb_employee order by name asc $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><a href=\"".curPageURL().curPageParamter('id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\"  src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	//echo '<br />'.$table;
	//echo $testPage->display_jump_menu().'      ';
	//echo $testPage->display_pages();
  ?>
</div>
</body>
</html>