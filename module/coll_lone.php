<?php 

//---------------------------Command search----------------------------------	
if(!empty($_POST["search"])){
	header("location: index.php?mnu_id=2&page=coll_lone_search.php");
}

//mysql_query("SET NAMES 'utf8'");

if(!empty($_GET["mess"]))
	$mess = $_GET["mess"];

//------------------------------Command Save------------------------------
if(!empty($_POST["save"]) && empty($_GET["id"]) ){
		if(!empty($_POST["loan"])){
			$rs_save=mysql_query("insert into   tb_coll_loan(emp_id,loan_type,loan_number,begin_date,end_date,loan,note)values($_GET[emp_id],$_POST[loan_type],$_POST[loan_number],'$_POST[begin_date]','$_POST[end_date]',$_POST[loan],'$_POST[note]')");
			if($rs_save){
				$mess="data saved";
				$new_emp_id = mysql_query("SELECT LAST_INSERT_ID() as id");
				$lrow = mysql_fetch_row($new_emp_id);
				header("location: index.php?mnu_id=2&page=coll_lone.php&emp_id=".$_GET[emp_id]."&mess=".$mess."&id=".$lrow[0]);
			}else
				$mess="data not saved";
		}else
			$mess="some fields are not filled ";
}
//------------------------------Command Update------------------------------
if(!empty($_POST["save"]) && !empty($_GET["id"]) && !empty($_POST["loan"]) ){
	$rs_save=mysql_query(" update   tb_coll_loan set 
				loan_type=$_POST[loan_type],
				loan_number=$_POST[loan_number],
				begin_date='$_POST[begin_date]',
				end_date='$_POST[end_date]',
				loan=$_POST[loan],
				note='$_POST[note]'
			where id=$_GET[id] ");
	if($rs_save)
		$mess="update successful";
	else
		$mess="update failed !";
}
//------------------------------Command Delete------------------------------
if(!empty($_POST["delete"]) && !empty($_GET["id"]) ){
	$rs_save=mysql_query("delete from   tb_coll_loan  where id=$_GET[id] ");
	if($rs_save){
		$mess="deletion complete";
		header("location: index.php?mnu_id=2&page=coll_lone.php&emp_id=".$_GET[emp_id]."&mess=".$mess);
	}else
		$mess="deletion failed";
		}

//-----------------------load data------------------------------
if(!empty($_GET["id"]) && empty($_POST["delete"])){
	$rs_select=mysql_query("select *from   tb_coll_loan where id=$_GET[id]");
}

//-----------------------------Select Emplyoeee-----------------------------
$rs_emp=mysql_query("select *from tb_collaborator where id=$_GET[emp_id]");
$_SESSION["emp_id"]=mysql_result($rs_emp,0,'id');
$_SESSION["emp_name"]=mysql_result($rs_emp,0,'name');
//-----------------------------Command New-----------------------------------
if(!empty($_POST["new"])){
	header("location: index.php?mnu_id=2&page=coll_lone.php&emp_id=$_GET[emp_id]");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" type="text/javascript">
function twoDigit(number){
     return (number < 10 ? '0' : '') + number
    }
	Date.prototype.addDays = function(days) {
		this.setDate(this.getDate()+parseInt(days));
		return this;
	}
	Date.prototype.addMonths = function(months)
	{
		this.setMonth(this.getMonth()+months);
		return this;
	}
	$(document).ready(function () {
	
	$("input,textarea,select").hover(function(){
		if ( $("#loan_number").val()!="" && $("#loan_number").val()!="0" && $("#begin_date").val()!=""){
			d = new Date($("#begin_date").val().replace('-','/').replace('-','/'));
			//d2= new Date($("#begin_date").val().replace('-','/').replace('-','/'));
			/*var road=0;
			if($("#fld_t6").val()!=""){
				road=parseInt($("#fld_t6").val());
			}*/
			d.addMonths(parseInt($("#loan_number").val())).toDateString();
			d.addDays(parseInt(-1)).toDateString();
			$("#end_date").val(d.getFullYear()+'-'+twoDigit(parseInt(d.getMonth())+1)+'-'+twoDigit(d.getDate()));
			//$("#work_date").val(d2.getFullYear()+'-'+twoDigit(parseInt(d2.getMonth())+1)+'-'+twoDigit(d2.getDate()));
		}
	});
	});
</script>
</head>

<body>

<form method="POST" action="" name="loan">

<div align="center">

<table border="0" width="60%" style="border-collapse: collapse; border: 1px solid #C0C0C0" dir="ltr" class="tb_bgcolrform">
	<tr>
		<td colspan="4" class="tdtitle"><span lang="en-us">Collaborators 
		Advances</span></td>
	</tr>
	<tr>
		<td colspan="4" class="tdtitleemp"><?php echo mysql_result($rs_emp,0,'name');?></td>
	</tr>
	<tr>
		<td width="86%"  colspan="4" class="message">
		<?php echo @$mess;?></td>
	</tr>
	<tr>
		<td width="12%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Advance type</b></font></span></td>
		<td width="87%" height="25" colspan="3">
		<select size="1" name="loan_type">
		<?php 
		if(!empty($_GET["id"])) $loantype=@mysql_result($rs_select,0,'loan_type');
		$rs_loan_type=mysql_query("select *from lk_loan_type");
		$xloan=mysql_num_rows($rs_loan_type);
		
		for($ii=0;$ii<$xloan;$ii++){
		?>
		<option value="<?php echo mysql_result($rs_loan_type,$ii,'id');?>" <?php if(mysql_result($rs_loan_type,$ii,'id')==$loantype) echo "selected";?> ><?php echo mysql_result($rs_loan_type,$ii,'name');?></option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td width="12%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>Amount</b></font></span></td>
		<td width="35%" height="25">
		<input type="text" name="loan" size="16" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'loan'); else echo '0';?>"></td>
		<td width="12%" height="25"  align="left"><span lang="en-us">
		<font size="2"><b>number of premium</b></font></span></td>
		<td width="39%" height="25">
		<input type="text" name="loan_number" id="loan_number" size="16" AUTOCOMPLETE="Off" class="text" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'loan_number'); else echo '0';?>"></td>
	</tr>
	<tr>
		<td width="12%" height="25" align="left"><font size="2"><b>premium start</b></font></td>
		<td width="35%" height="25">
		<font size="2"><b>
			
			 <input type="text" size="8" name="begin_date" id="begin_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'begin_date'); else echo date('Y-m-').'01'; ?>" />
			 <img id="f_btn1"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn1", "begin_date", "%Y-%m-%d");
				//]]></script>	
		</b></font></td>
		<td width="12%" height="25"  align="left"><span lang="en-us">
		<font size="2"><b>premium end</b></font></span></td>
		<td width="39%" height="25">
		<font size="2"><b>
		
		 <input type="text" size="8" name="end_date" id="end_date" readonly="1" value="<?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'end_date');?>" />
		 <img id="f_btn2"  src="images/calendar.jpg" />
					<script type="text/javascript">//<![CDATA[
						var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() }
						//,showTime: true
						});
						cal.manageFields("f_btn2", "end_date", "%Y-%m-%d");
				//]]></script>	
		</b></font></td>
	</tr>
	<tr>
		<td width="12%" height="25" align="left"><span lang="en-us">
		<font size="2"><b>comments</b></font></span></td>
		<td width="86%" height="25" colspan="3">
		<font size="2"><b><textarea rows="2" name="note" cols="46"><?php if(!empty($_GET["id"])) echo @mysql_result($rs_select,0,'note');?></textarea></b></font></td>
	</tr>
	<tr>
		<td colspan="4">
		<div align="center">
			<table border="1" width="100" id="table1" style="border-collapse: collapse; border: 1px solid #666633">
				<tr>
					<td>
					<input type="submit" value="new" name="new" class="button"></td>
					<td>
					<input type="submit" value="save" name="save" class="button"></td>
					<td>
					<input type="submit" value="Another employee" name="search" class="button"></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
					<input type="submit" value="delete" name="delete" class="button"></td>
				</tr>
			</table></div></td>
	</tr>
</table>
</div>
</form>

<br>
<div align="center">

<?php 
    /*$link=mysql_connect("localhost","root","");
	$db=mysql_select_db("hr_db",$link);
	mysql_query("SET NAMES 'utf8'");*/
	$result = mysql_query("select count(*) as noOfrows from  tb_coll_loan where emp_id=$_GET[emp_id]");
	$no = @mysql_result($result,0,'noOfrows');
	$testPage = new Paginator();
	$testPage->items_total = $no;  
	$testPage->mid_range = 9;
	$testPage->default_ipp = 5;
	$testPage->paginate(); 
	$table = "<table border=\"1\" width=\"60%\" style=\"border-collapse: collapse\" dir=\"rtl\" height=\"10%\"><td align=\"center\" class=\"tdtitle\">#</td><td  align=\"center\" class=\"tdtitle\">نوع السلفية</td><td  align=\"center\" class=\"tdtitle\">price</td><td  align=\"center\" class=\"tdtitle\">Number of premiums </td><td align=\"center\" class=\"tdtitle\">Start Date</td><td align=\"center\" class=\"tdtitle\">End Date</td><td align=\"center\" class=\"tdtitle\">Comment</td><td align=\"center\" class=\"tdtitle\">&nbsp;</td>";
	$result = mysql_query("select tb_coll_loan.id ,lk_loan_type.name,tb_coll_loan.loan,loan_number,begin_date,end_date,note from  tb_coll_loan left join lk_loan_type on(tb_coll_loan.loan_type=lk_loan_type.id) where emp_id=$_GET[emp_id] $testPage->limit");
	while($row = mysql_fetch_row($result)){
		$table .="<tr><td align=\"center\">".$row[0]."</td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[1]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[2]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[3]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[4]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[5]."</font></td><td align=\"center\"><font size=\"2\" face=\"Tahoma\">".$row[6]."</font></td><td align=\"center\"><a href=\"".curPageURL().getCurPageParamter('mnu_id+page+emp_id')."&id=".$row[0]."\"><img border=\"0\"  alt=\"select\" title=\"select\" src=\"images/icon-32-edit.jpg\" width=\"24\" height=\"25\"></a></td></tr>";	
	}
	$table .= "</table>";
	echo '<br />'.$table.'<br />';
	echo $testPage->display_pages();
  ?>

</div>

</body>

</html>