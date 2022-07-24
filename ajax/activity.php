<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');



$fromUser =$_REQUEST['fromUser'];
$toUser=$_REQUEST['toUser'];


$query = mysqli_query($database, "UPDATE messages SET status='0' WHERE userto='".$fromUser."' AND userfrom='".$toUser."' AND status = '1'");



?>
