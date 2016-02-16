

<?php

//this is a path to PHP mailer class you have dowloaded

include("../PHPMailer_v5.1/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); // set mailer to use SMTP

$mail->Host = "192.168.1.211"; // specify main and backup server

$mail->SMTPAuth = true; // turn on SMTP authentication

$mail->Username = "mazin.i@ashorooq.tv"; // SMTP username

$mail->Password = "itsme"; // SMTP password

$mail->From = "tariq.s@ashorooq.tv"; //do NOT fake header.

$mail->FromName = "MailMan";

$mail->AddAddress("tariq.s@ashorooq.tv"); // Email on which you want to send mail

//$mail->AddReplyTo("Reply to Email ", "Support and Help"); //optional

$mail->IsHTML(true);

$mail->Subject = "Just a Test";

$mail->Body = "Hello. I am testing <b>PHP Mailer.</b>";

if(!$mail->Send())

{

echo $mail->ErrorInfo;

}else{

echo "email was sent";

}

?>
