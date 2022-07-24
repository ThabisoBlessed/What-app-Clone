<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';

if (isset($_SESSION['email'])) {
	$userclient = $_SESSION['email'];

}
else {
	header("Location: register.php");

}

if(isset($_GET['userid'])){
	$decline_id =$_GET['userid'];
	$usersent =mysqli_query($database ,"SELECT * FROM users  WHERE  (id='".$decline_id."')");
	$row=mysqli_fetch_assoc($usersent);
  $userfrom=$row["email"];


  $updateRequestsTable=mysqli_query($database,"DELETE FROM friend_requests WHERE userto ='$userclient' AND userfrom='$userfrom'");
              header("Location:friendrequests.php");

}


if(isset($_GET['id'])){

	$accept_id =$_GET['id'];
	$usersent =mysqli_query($database ,"SELECT * FROM users  WHERE  (id='".$accept_id."')");
	$row=mysqli_fetch_assoc($usersent);
	$userfrom=$row["email"];

$acceptfriend=mysqli_query($database,"UPDATE users SET friends=CONCAT(friends,'$userfrom,') WHERE email='$userclient'");
$acceptfriend=mysqli_query($database,"UPDATE users SET friends=CONCAT(friends,'$userclient,') WHERE email='$userfrom'");

$updateRequestsTable=mysqli_query($database,"DELETE FROM friend_requests WHERE userto ='$userclient' AND userfrom='$userfrom'");

header("Location:friendrequests.php");

}




?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Chat-App </title>
    <link rel="icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  </head>

  <style media="screen">


@font-face {
	font-family: 'Bellota-BoldItalic';
	src: url('../fonts/Bellota-BoldItalic.otf');
}


    #header {
    z-index: 999;
    position: fixed;

    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 9%;
    background: hsla(230, 8%, 15%, .9);
    backdrop-filter: saturate(180%) blur(16px);
    -wwbkit-backdrop-filter: saturate(180%) blur(16px);
    box-shadow: 0 6px 4px hsla(0, 4%, 15%, .2);
}
.navbar
{
  margin-left: 47rem;

}



.navbar li {

    display: inline-block;
    padding-right: 3rem;
}

.navbar li a {
    position: relative !important;
    color: hsl(195, 12%, 94%, .7);
    transition: all 0.3s ease .1s;
    text-decoration: none;
}

.navbar li a:hover {

    color: hsla(195, 12%, 100%, 0.9);
}
nav ul li a::before,
nav ul li a::after {
    content: "";
    position: absolute;
    bottom: -8px;
    right: 0;
    left: auto;
    width: 0;
    height: 3px;
}

nav ul li a::before {
    background-color: #235aa6;
    transition: all .25s cubic-bezier(.694, .048, .335, 1) .15s;
}

nav ul li a::after {
    background-color: #f25757;
    transition: all .25s cubic-bezier(.694, .048, .335, 1);
}

nav ul li a:hover::after,
nav ul li a:hover::before {
    width: 100%;
    left: 0;
}

body {
  background-color: #9A86A4;
  background-size: cover;
  	font-family: 'Bellota-BoldItalic';
}
.row
{
  margin: 20px 100px;
}


.page-content-wrapper .page-content {
     margin-left: 0;
     padding: 0;
}

.page-content-wrapper .page-content {
     padding: 0 !important;
}

.grouping {
     margin: 0;
     padding: 0;
     list-style: none;
}

.grouping > li {
     margin: 0 0 20px;
}

.grouping > li > img {
     float: left;

     height: 118px;
}

.grouping > li > .info {
     overflow: hidden;
     background-color: #f5f5f5;
     position: relative;
     height: 110px;
     padding-top: 7px;
     padding-right: 40px;
     text-align: left;
}

.grouping > li > .info > .title {
     font-size: 17pt;
     margin: 0;
     color: #c00;
}

.grouping > li > .info > .desc {
     font-size: 12pt;
     font-weight: 300;
     margin: 0;
}

.grouping > li > .info a {
     margin: 0 10px;
}



.grouping > li > .info > ul {
     display: table;
     width: 100%;
     margin: 10px 0 0;
     padding: 0;
     list-style: none;
     text-align: center;
}

.grouping > li > .info > ul > li {
     display: table-cell;
     font-size: 11pt;
     font-weight: 300;
     padding: 3px 0 3px 10px;
     text-align: left;
     color: #1e1e1e;
     border-right: 1px solid #fff;
}

.grouping > li > .info > ul > li > small {
     margin-left: 4px;
     color: #c00;
}

.grouping > li > .info > .title,
.grouping > li > .info > .desc {
     padding: 0 10px;
}



.grouping > li > .info > ul {
     position: absolute;
     bottom: 0;
     left: 0;
     border-top: 1px solid #fff;
     background-color: #d9d9d9;
}

@media only screen and (max-width: 480px) {
     .grouping > li > img {
          width: 100%;
          height: 100%;
     }
     .grouping > li > .info > .title {
          font-size: 12pt;
          margin: 0;
          color: #c00;
     }
     .grouping > li > .info > .desc {
          font-size: 10pt;
          font-weight: 300;
          margin: 0;
     }



     .grouping > li > .info > ul > li {
          display: table-cell;
          font-size: 10pt;
          font-weight: 300;
          padding: 3px 0 3px 10px;
          text-align: left;
          color: #1e1e1e;
          border-right: 1px solid #fff;
     }
}
.button{
font-size: 20px;
color:#fff;
font-family: 'Bellota-BoldItalic';
border: none;
padding: 5px;
width: 100%;
text-decoration: none;
border-radius: 4px;
}
  </style>


  <body>
      <header id='header'>

  <nav>
    <ul class='navbar'>
      <li class='c-openchat__li'><a class='c-openchat__link' href='index.php' title=''><i class="fa fa-envelope"></i>&nbsp Messages</a></li>
      <li class='c-openchat__li'><a class='c-openchat__link' href='' title=''><i class="fa fa-bell" aria-hidden="true"></i>&nbsp Notifications</a></li>
      <li class='c-openchat__li'><a  class='c-openchat__link' href='logout.php' title=''><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp Logout</a></li>

    </ul>
  </nav>

</header>

<?php


	$userfriends =mysqli_query($database ,"SELECT * FROM friend_requests  WHERE  (userto='".$userclient."') AND (display='yes')");
	$row=mysqli_fetch_assoc($userfriends);
  $userfrom=$row["userfrom"];

  $sentfriends =mysqli_query($database ,"SELECT * FROM users  WHERE  (email='".$userfrom."')");


  $nme=mysqli_fetch_assoc($sentfriends);

	if(mysqli_num_rows($sentfriends)>0)
	{
  $name=$nme['username'];
	$id=$nme['id'];

  $sentimage =mysqli_query($database ,"SELECT * FROM profile  WHERE  (email='".$userfrom."')");
  $nme=mysqli_fetch_assoc($sentimage);
  $getimage=$nme['image'];
  $status=$nme['status'];




echo "

    <div style='margin-top:7rem;'class='row'>
     <div class='col-md-6'>
          <ul class='grouping'>
               <li>
                    <img src='$getimage' alt=''>
                    <div class='info'>
                         <h2 class='title'>$name</h2>
                         <p class='desc'>$status</p>
                         <ul >
                              <li style='background:red;'class='btn btn-bid'><a class='button' href='friendrequests.php?userid=$id' >Decline Request</a></li>
                              <li style='background:#112B3C;'class='btn btn-bid'><a class='button' href='friendrequests.php?id=$id' >Make Friend</a></li>
                         </ul>
                    </div>
               </li>
          </ul>

     </div>
</div>
";



}
 ?>




  </body>
</html>
