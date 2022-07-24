<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');


$fromUser =$_REQUEST['fromUser'];
$toUser=$_REQUEST['toUser'];
$message =$_REQUEST['message'];
$status='1';
$sqlidata = mysqli_query($database, "INSERT INTO messages VALUES(NULL,'$fromUser', '$toUser', '$message','$status')");

 ?>
