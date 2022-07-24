<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';



if (isset($_SESSION['email'])) {
	$userclient = $_SESSION['email'];
  $nme_query=mysqli_query($database ,"SELECT * FROM users WHERE email='".$userclient."' ");
  $query=mysqli_query($database ,"SELECT * FROM profile WHERE email='".$userclient."' ");
  $row=mysqli_fetch_assoc($query);
  $row2=mysqli_fetch_assoc($nme_query);
		$idto=$row2['id'];
  $username=$row2["username"];
	$status=$row["status"];
	$img=$row["image"];
	$myself=$row2['id'];
}
else {
	header("Location: register.php");

}


if(isset($_GET['chatid']) or isset($_SESSION['id'])){


	$chatwith =$_SESSION['id'];
	$usersent =mysqli_query($database ,"SELECT * FROM users  WHERE  (id='".$chatwith."')");
	$row=mysqli_fetch_assoc($usersent);
  $chatEmail=$row["email"];
	$chatname=$row["username"];

  $chatprofile =mysqli_query($database ,"SELECT * FROM profile  WHERE  (email='".$chatEmail."')");
  $nme=mysqli_fetch_assoc($chatprofile);
  $getimage=$nme['image'];
  $chatstatus=$nme['status'];


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
  <link rel="stylesheet" type="text/css" href="Assets/styles/bootsrap.css">
  <link rel="stylesheet" type="text/css" href="Assets/styles/style.css">

</head>
<style >
@font-face {
	font-family: 'Bellota-BoldItalic';
	src: url('../fonts/Bellota-BoldItalic.otf');
}
    .card{
      margin-top: 6rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-radius: 0 0 15px 15px;

      width: 250px;
      padding-bottom: 15px;
      background-color: white;
  }

  .card img{
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-image: linear-gradient(60deg, #2AAA8A, #4169E1);
      padding: 5px;
      margin-top: -45px;
  }

  .card h2{
      margin: 10px 0;
  }

  .cont{
      width: 90%;
      height: 0;
      overflow: hidden;
      text-align: center;
      transition: all 0.6s ease;
  }
.cont  p{
  font-family: 'Bellota-BoldItalic';
  font-weight: bold;
  font-size: 15px;
  color: red;
}
  .card .cont .link i{
      font-size: 25px;
      color: rgb(82, 82, 82);
      transition: all 0.2s ease;
  }

  .card .cont .link i:hover{
      color: black;
      cursor: pointer;
  }

  .card:hover > .cont{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      text-align: center;
      height: 150px;
  }

  .card:hover > .link{
      width: 40%;
      display: flex;
      justify-content: space-between;
  }

      </form>


form input[type=text]:focus,
form input[type="password"]:focus {
	border-color:cornflowerblue;
}

  input[type=submit] {
	padding:25px 50px;
    padding: 3px 40px;
    background: #9A86A4;
    border: none;
    color: white;
    cursor: pointer;
    display: inline-block;
    float: right;
    clear: right;
    border-radius: 4px;
    transition: 0.2s ease all;
  }

input[type=submit]:hover {
	opacity:0.8;
}

input[type="submit"]:active {
	opacity:0.4;
}

/*friends*/




#friend-list {
  display: block;
  margin: 0;
  padding: 0;
  width: 250px;
  height: 100%;
  background: #EEE;
  list-style-type: none;
}
.friend_link{
	text-decoration: none;
}

.friend {
  width: 250px;
  height: 60px;
  background: #EEE;
  border-bottom: 1px solid #DDD;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.friend img {
  width: 45px;
  height: 45px;
  border-radius: 30px;
  border: 2px solid #AAA;
  object-fit: cover;
  margin-left: 5px;
  margin-right: 10px;
}

.friend .name {
  font-size: 18px;
}

.friend.selected {
  background: #43A047;
  color: white;
}

.friend.selected img {
  border-color: white;
}

.friend:not(.selected):hover {
  background: #DDD;
}

</style>
  <body>
    <main class='mychat'>
      <aside class='left'>
        <nav class=''>

          <div class="card">
                  <img src="<?php echo $img; ?>" alt="">
                  <h2><?php echo $username; ?></h2>
                  <div class="cont">
                      <p><?php echo $status; ?>
                      </p>
                      <div class="link">
                          <a href="#"><i class="fab fa-codepen"></i></a>
                          <a href="#"><i class="fab fa-github"></i></a>
                      </div>
                  </div>
              </div>



        </nav>
        <nav class='left__navh left__nav--spacer c-friends'>
          <div class='left__header'>
            <h2>Friends<span></span></h2>

						<a style="display:inline-block;" class='button' href='friendrequests.php' >Requests</a>


          </div>

						<ul id='friend-list'>

							    <?php

   						$sqldata=mysqli_query($database,"SELECT friends FROM users  WHERE email='$userclient' ");
   					$row = mysqli_fetch_array($sqldata);

    $myFriends = explode (",", $row['friends']);
    	foreach($myFriends as $frnd)
      {
      $friend =mysqli_query($database ,"SELECT * FROM profile  WHERE  (email='".$frnd."')");


			$row=mysqli_fetch_assoc($friend );

			if(mysqli_num_rows($friend))
			{
  		$img=$row["image"];


			$friendname =mysqli_query($database ,"SELECT * FROM users  WHERE  (email='".$frnd."')");
		$row2=mysqli_fetch_assoc($friendname );

			if(mysqli_num_rows($friendname))
			{

			$name=$row2['username'];
			$id=$row2['id'];

			echo "

			<a class='.friend_link' href='index.php?chatid=$id'>
			  <li class='friend selected'>

			      <img src='$img' />
			      <div class='name'>
			        $name
			      </div>
			    </li></a>";

				}

				}
}
?>
					</ul>
        </nav>
      </aside>
      <section class='c-chats'>
        <div class='c-chats__header'>
          <div>
            <label aria-label='Search your active chats.'><i data-feather='search'></i></label>
            <input type='text' placeholder='Search'>
          </div>
        </div>
      </section>

    <section class='c-openchat'>
        <div class='c-openchat__header'>
          <ul>

            <li class='c-openchat__li'><a class='c-openchat__link' href='discover.php' title=''><i class="fas fa-user-friends"></i>&nbsp Discover</a></li>
            <li class='c-openchat__li'><a class='c-openchat__link' href='' title=''><i class="fa fa-bell" aria-hidden="true"></i>&nbsp Notifications <span class='c-notification'>2</span></a></li>
              <li class='c-openchat__li'><a  class='c-openchat__link' href='logout.php' title=''><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp Logout</a></li>

          </ul>
        </div>
        <div  class='c-openchat__box'>
          <div class='c-openchat__box__header'>

							<?php

							if(isset($_SESSION['id']))
							{

								echo "
								          <img class='c-openchat__box__pp' src='$getimage' alt=''>
								            <p class='c-openchat__box__name'>$chatname</p>
														<p style ='color:#16003B;'  class='c-openchat__box__name'>::- $chatstatus</p>
														";

							}


							 ?>



          </div>
          <div class='c-openchat__box__info'>


    <div  style="margin-top:5px;border-radius:10px;"class="container-fluid bg-light" id="chat">
      <div class="content d-flex flex-column" id="chat-content">
				<?php
				if(isset($_SESSION['id'])){

		$chats=mysqli_query($database,"SELECT * FROM messages where (userfrom='".$myself."') AND  (userto= '".$chatwith."')
								OR (userfrom='".$chatwith."') AND  (userto='".$myself."' )");

								while ($chat=  mysqli_fetch_assoc($chats)) {

									if($chat['userfrom']==$myself)
									{
									echo
										"
									<div style='text-align:right;'>
										<p style='background-color:lightblue;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
										".$chat["message"]."
										</p></div>

										";
									}
									else {
											echo
											"
											<div style='text-align:left;'>
											<p style='background-color:yellow;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
											".$chat["message"]."
											</p></div>

											";

									}
									}
			}


				 ?>


      </div>
      <form class="tools form-row">
        <input style="border-radius: 5px;height: 50px;" id="message" class="form-control col mr-2" type="text" placeholder="Type your message..">
        <div class="emoji-list" id="emoji-list">

        </div>
        <button  style="height:50px;border-radius:5px;"id="emoji" class="form-control col-1 mr-2" type="button"  placeholder="From">
          <i class="far fa-grin-alt"></i>
        </button>
        <input id='send' type="submit" name="" value="Send">


      </form>
    </div>
  </div>

        </div>
      </section>
    </main>

  </body>


			<script type="text/javascript">

	$(document).ready(function(){
		$('#send').on("click",function()
{
	var message = document.getElementById("message").value;

	var from ='<?php echo $idto; ?>';
	var to ='<?php echo $chatwith; ?>';

	$.ajax({
		url:"insertMessage.php",
		method:"POST",
		data:{
			fromUser:from,
			toUser:to,
			message:message
		},
		dataType:"text",

		success:function(data)
		{
			alert(data);
			$("#message").val("");
		}
	});

});
});
		</script>

<!--	<script src="Assets/javascript/message.js"></script>-->

</html>
