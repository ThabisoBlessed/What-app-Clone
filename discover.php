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

	$_SESSION['id'] =$_GET['userid'];
	$user =mysqli_query($database ,"SELECT * FROM profile  WHERE  id='".$_SESSION['id']."'");

			$row=mysqli_fetch_assoc($user);

        $email=$row["email"];



	$reqs = mysqli_query($database, "SELECT * FROM friend_requests WHERE (userfrom='$userclient') AND (userto='$email') OR (userfrom='$email') AND (userto='$userclient')");
$rows2= mysqli_num_rows($reqs);

	if($rows2 == 0) {

$query = mysqli_query($database, "INSERT INTO friend_requests VALUES (NULL, '$userclient', '$email','yes')");


}

}?>


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
    <link rel="stylesheet" type="text/css" href="Assets/styles/bootsrap.css">
    <link rel="stylesheet" type="text/css" href="Assets/styles/mycss.css">
  </head>
<style media="screen">

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


<section style="margin-top:7rem;" class="card_friends">
      <?php


				$user =mysqli_query($database ,"SELECT * FROM profile  WHERE email !='".$userclient."'");






				while($row=mysqli_fetch_assoc($user))
				{
						$user2 =mysqli_query($database ,"SELECT * FROM users  WHERE email ='".$userclient."'");
				$rowq=mysqli_fetch_assoc($user2);


          $userid=$row["id"];
          $email=$row["email"];

          $image=$row["image"];
          $status=$row["status"];

          	$query = mysqli_query($database, "SELECT * FROM users WHERE email='$email'");
	           $rows=mysqli_fetch_assoc($query);
             $nme=$rows['username'];
						 $nme2=lcfirst($email);

						 $separator = "," . $nme2 . ",";
						if(!strstr($rowq['friends'],$separator))
						echo "
						<a href='#'>
						  <article class='card'>
						    <figure class='card-img'>
						      <img src='".$image."' />
						      <figcaption>
						      $nme
						      </figcaption>
						    </figure>
						    <div class='card-body'>
						    <a class='button' href='discover.php?userid=$userid' >Make Friend</a>
						    </div>
						  </article>
						</a>



						";

}





 ?>
</section>





  <script src="Assets/javascript/discover.js">

  </script>
  </body>
</html>
