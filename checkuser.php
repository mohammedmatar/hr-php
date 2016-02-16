<?php 
// http://www.itechroom.com : Technology News, Web Development and more
include("config.php");
if ($_GET["page"]=="employee")
$rs_arr=mysql_query("select emp_number from tb_employee");
else
$rs_arr=mysql_query("select emp_number from tb_collaborator");

$xarr=mysql_num_rows($rs_arr);
$arr_user=array();
for($i=0;$i < $xarr;$i++)
$arr_user[]=mysql_result($rs_arr,$i,'emp_number');

//$arr_user=array("itechroom", "trialuser");

$username=$_POST['emp_number'];

if(in_array($username,$arr_user) ) 
{echo '<span class="error">الرقم موجود مسبقاً</span>';exit;}

else if(strlen($username) < 3 || strlen($username) > 15){echo '<span class="error">الرقم يجب ان يتكون من 4 ارقام على الاقل</span>';}
else if (preg_match("/^[a-zA-Z0-9]+$/", $username)) 
{
       echo '<span class="success">الرقم متاح.</span>';
} 
else 
{
      echo '<span class="error">عليك إدخال ارقام فقط.</span>';
}

?>