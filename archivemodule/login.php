<?php 
session_start();
if(isset($_SESSION["login"])){
	header("location:index.php?mnu_id=1&page=hr.php");
}
if (!empty($_POST["enter"])){
	$login=mysql_query("select *from tbl_user where name='$_POST[name]' and pass=md5('$_POST[pass]')");
if($login){
$x=mysql_num_rows($login);
$mess="";
if($x>0){
	$_SESSION["per"]=mysql_result($login,0,'per');
	$_SESSION["login"]=1;
	if ($_SESSION["per"]==2 ||$_SESSION["per"]==1 ){
	header("location: index.php?mnu_id=2");
	}
	elseif($_SESSION["per"]==3)
		header("location: index.php?mnu_id=3");

	}
	else
	$mess="Invalid Username/Password";
}}
?>
<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
html {
  height: 100%;
  margin-bottom: 1px;
}
body{
	font-size:12pt;
	font-family:tahoma;
	background:#555555;
}
form {
  margin: 0;
  padding: 0;
}

body {
	font-family: Helvetica,Arial,sans-serif;
	line-height: 1.3em;
	margin: 0px 0px 0px 0px;
	font-size: 12px;
	color: #333;
}

a:link, a:visited {
	text-decoration: none;
	font-weight: normal;
}

a:hover {
	text-decoration: underline;
	font-weight: normal;
}

input.button { cursor: pointer; }

p { margin-top: 0; margin-bottom: 5px; }

img { border: 0 none; }

#login_form{
	width:500px;
	margin-left:auto;
	margin-right:auto;
	margin-top:50px;
	margin-bottom:0;
	padding:0;
	direction:rtl;
	background:#808080;
	border:10px solid #E0E0E0;
}

#login_form .error{
	font-weight:bold;
	width:464px;
	margin:0;
	color:#BF582A;
	padding:0;
	padding-right:35px;
	height:30px;
	background:#FFFFFF url(images/notice-alert.png) right center no-repeat;
	border:1px solid #444444;
}

#login_form .error p{
	margin-top:10px;
}
* html #login_form .error{
	width:463px;
}
#login_form .title{
	font-weight:bold;
	font-size:14pt;
	width:499px;
	margin:0;
	color:#444444;
	padding:0;
	text-align:center;
	height:30px;
	background:#FFFFFF;
	border:1px solid #444444;
}
* html #login_form .title{
	width:498px;
}
#login_form .title p{
	margin-top:10px;
}

#login_form .label{
	width:150px;
	color:#FFFFFF;
	font-weight:bold;
}

#login_form table{
	border:1px solid #444444;
	border-collapse: collapse;
	width:500px;
}
#login_form table td{
	border:1px solid #444444;
}
#login_form tr{
	height:30px;
}
#login_form td{
	padding-right:5px;
}

.button{
	width:75px;
}
</style>
</head>

<body>
<div id="login_form" align="center">
<form method="POST" action="">
<input type="hidden" name="D1" value="3" />
<?php
	if (empty($mess)){
?>
<div class="title"><span lang="en-us">Human Resources System</span></div>
<?php
	}else{
?>
<div class="error"><p><?php echo $mess; ?></p></div>
<?php
	}//else
?>
	<div align="center">
	<table dir="ltr">
				<tr>
					<td width="111" align="center" class="label">
					<span lang="en-us"><font size="2">Username</font></span></td>
					<td><input type="text" name="name" size="45"></td>
				</tr>
				<tr>
					<td width="111" align="center" class="label"><b><font size="2">Password</font></b></td>
					<td><input type="password" name="pass" size="46"></td>
				</tr>
				<tr>
					<td width="111">&nbsp;</td>
					<td>
					<input type="submit" value="Login" name="enter" style="font-weight: 700"></td>
				</tr>
			
	
	
</table>
</div>
</div>
</form>

</body>

</html>