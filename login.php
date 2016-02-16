<?php
ob_start();
include("config.php");
?>
<html dir="ltr">
<head>
<link href="favicon.ico" rel="shortcut icon"/>
<title>LOGIN</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<img  src="Splashtastic/logoled.png" width="307" height="98" alt="" align=left style="margin-top:-175px;" />
<?php //echo $_SERVER['REMOTE_ADDR'];?>
<div align="center"><?php include("module/login.php");?></div>
</body>
</html>
<?php ob_flush();?>