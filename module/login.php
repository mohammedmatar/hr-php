<?php
ob_start();
session_start();

		$ip=$_SERVER["REMOTE_ADDR"];
		$rs_secur=mysql_query("select *from secure where ip='$ip'");
		$xscur=mysql_num_rows($rs_secur);
		if($xscur > 0 )
		header("location: Splashtastic/index.html");

if(isset($_SESSION["login"])){
	header("location:index.php?mnu_id=1&page=hr.php");
}
if (!empty($_POST["enter"])){

$rs_secur=mysql_query("select *from secure where ip='$ip'");
		$xscur=mysql_num_rows($rs_secur);
		if($xscur > 0 )
		header("location: Splashtastic/index.html");

	$login=mysql_query("select *from tbl_user where name='$_POST[name]' and pass=md5('$_POST[pass]')");
	//echo "select *from tbl_user where name='$_POST[name]' and pass=md5('$_POST[pass]')";
	//exit;
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
		header("location: index.php?mnu_id=3&page=hr.php");

	}
	else
	{
	if($_SESSION["logcount"] < 0 || $_SESSION["logcount"]=="")
	$_SESSION["logcount"]=1;
	else
	$_SESSION["logcount"]++;
	
	if ($_SESSION["logcount"] >=3){
	$date=date("Y-m-d");
	$rs_ip=mysql_query("insert into secure(ip,date)values('$ip','$date')");
	}
	$mess="Invalid Username or Password. ";
	
	}
}}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">

<title>Lead Tech Login Form</title>

<style>

.logo {
    width: 213px;
    height: 36px;
    background: url('http://i.imgur.com/fd8Lcso.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    margin-top:170px;
    border-radius: 5px;
    border-top: 5px solid #897714;
   /* margin: 0 auto;*/
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('Splashtastic/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('Splashtastic/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('Splashtastic/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('Splashtastic/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #897714;
}

.login-block .button {
    width: 100%;
    height: 40px;
    background: #897714;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #e15960;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #ff7b81;
}

</style>
</head>

<body>

<form method=post action="">
<div class="login-block">
    <h1>Lead Tech HR System</h1>
    <h2><?php echo @$mess;?></h2>
    <input type="text" value="" placeholder="User Name " id="username" name="name" />
    <input type="password" value="" placeholder="Password" id="password" name="pass" />
<input  type=submit value="Login" id="button"  class="button" name="enter" >
</div>
</form>
</body>

</html>
<?php ob_flush();?>