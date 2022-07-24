<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';

if (isset($_SESSION['email']))
{
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
else
{
  	header("Location: register.php");
}

if(isset($_GET['chatid'])){
	$chatwith =$_GET['chatid'];
	$_SESSION['chatwith']=$_GET['chatid'];
	$usersent =mysqli_query($database ,"SELECT * FROM users  WHERE  (id='".$chatwith."')");
	$row=mysqli_fetch_assoc($usersent);
  $chatEmail=$row["email"];
	$chatname=$row["username"];

  $chatprofile =mysqli_query($database ,"SELECT * FROM profile  WHERE  (email='".$chatEmail."')");
  $nme=mysqli_fetch_assoc($chatprofile);
  $getimage=$nme['image'];
  $chatstatus=$nme['status'];

$useravail=true;

}
else {
	$useravail=false;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>My Chat-App </title>
  <link rel="icon" href="favicon.ico">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
	<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="Assets/styles/bootsrap.css">
  <link rel="stylesheet" type="text/css" href="Assets/styles/style.css">

</head>
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

      </aside>
      <section style="font-family: 'Bellota-BoldItalic';padding:1rem;width:30%;" class='c-chats'>
        <div class='c-chats__header'>
          <div>
            <label aria-label='Search your active chats.'><i data-feather='search'></i></label>
            <input type='text' placeholder='Search'>
          </div>
        </div>
				<nav  style="width:90%;border-radius:4px;"class='left__navh left__nav--spacer c-friends'>
          <div class='left__header'>
            <h4>Check<span></span></h4>
						<a style="display:inline-block;" class='button' href='friendrequests.php' >Requests</a>
          </div>
            <ul style='width:100%;' class="friend_list" id='friend-list'>
            </ul>
        </nav>
      </section>

    <section class='c-openchat'>
        <div class='c-openchat__header'>
          <ul>
						<li class='c-openchat__li'><a class='c-openchat__link' href='chat.php' title=''><i class="fa fa-users" aria-hidden="true"></i>&nbsp Public Chat</a></li>
						<li class='c-openchat__li'><a class='c-openchat__link' href='discover.php' title=''><i class="fas fa-user-friends"></i>&nbsp Discover</a></li>
            <li class='c-openchat__li'><a class='c-openchat__link' href='' title=''><i class="fa fa-bell" aria-hidden="true"></i>&nbsp Notifications <span class='c-notification'>2</span></a></li>
            <li class='c-openchat__li'><a  class='c-openchat__link' href='logout.php' title=''><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp Logout</a></li>

          </ul>
        </div>
        <div  class='c-openchat__box'>
          <div class='c-openchat__box__header'>
								<?php
							if(isset($_SESSION['chatwith'])&&$useravail)
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

    <div  style="background: url('Assets/images/img.png'); margin-top:5px;border-radius:10px;"class="container-fluid bg-light" id="chat">
      <div class="content d-flex flex-column" id="msg_chat">

      </div>

				<div class="tools form-row">

					<?php
							if(isset($_SESSION['chatwith'])&&$useravail){
							echo "
        <input style='border-radius: 5px;height: 50px;'' id='message' class='form-control col mr-2' type='text' placeholder='Type your message..'>
				<input id='send' type='submit'  value='Send'>";
}

?>
</div>

<script type="text/javascript">
$(document).ready(function(){

		var from ='<?php echo $idto; ?>';
	var to ='<?php echo $chatwith; ?>';

		setInterval(function(){
  	retrievemsg();
	}, 1000);


$('#send').on("click",function()
{
	$.playSound("Assets/mp3/click.mp3");
	var message = document.getElementById("message").value;

$.ajax({
		url:"ajax/insertMessage.php",
		method:"POST",
		data:{
			fromUser:from,
			toUser:to,
			message:message,
		},
		dataType:"text",

		success:function(data)
		{
			$("#message").val("");
			setInterval(function(){
  	retrievemsg();
	}, 1000);
		}
	})
});

function retrievemsg() {
		$.ajax({
  		url:'ajax/retrieve.php',
  		method:"POST",
			cache:false,
				data:{
			fromUser:from,
			toUser:to,
		},
		dataType:"text",
  		success:function(data)
			{

					$('#msg_chat').empty();
				$('#msg_chat').append(data);

			}

  	});
   }


$(document).on('click', '.start_chat', function(){

	  	$.ajax({
  		url:'ajax/activity.php',
  		method:"POST",
			data:{
			fromUser:from,
			toUser:to,
		},
		dataType:"text",
			cache:false,
  		success:function(data){}

  	})

});

});
</script>

    </div>
  </div>
  </div>
  </section>
  </main>
</body>
  <script>

  $(document).ready(function(){
   friends_lists();
   setInterval(function(){
  	activity();
  	friends_lists();
   }, 5000);

   function friends_lists() {
  	$.ajax({
  		url:'ajax/friends_lists.php',
  		method:"POST",
			cache:false,
  		success:function(data){
				 $('.friend_list').empty();
				$('.friend_list').append(data);
  		}

  	})
   }

  });
  </script>

</html>
