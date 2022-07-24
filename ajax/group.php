<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');

$userclient=$_SESSION['email'];
$message =$_REQUEST['message'];

$nme_query=mysqli_query($database ,"SELECT * FROM users WHERE email='".$userclient."' ");
$row2=mysqli_fetch_assoc($nme_query);
$fromUser=$row2["username"];



$query=mysqli_query($database,"INSERT INTO publicchat  VALUES(NULL,'$fromUser','$message',now())");


 ?>
