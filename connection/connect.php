<?php
session_start();

$database =mysqli_connect("localhost","root","","chat");

if(mysqli_connect_errno())
{
  echo"Database failed to connect!!".mysqli_connect_errno();
}

 ?>
