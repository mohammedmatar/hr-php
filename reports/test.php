<?php 
$user="sa";
$password="tvzstreaming";
$database="BioStar";
$server="192.168.1.3";
$conn=odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $user, $password);
$res2 = odbc_exec($conn ,"SELECT     * FROM         View_1 ");

?>