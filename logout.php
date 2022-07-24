<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';


$email=$_SESSION['email'] ;
$query = mysqli_query($database, "UPDATE users SET status='0' WHERE email='$email'");
session_destroy();
header("Location:register.php")
 ?>
