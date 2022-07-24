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
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Chat-App</title>
    <link rel="icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
	<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
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

<section class="msger">
  <header class="msger-header">
    <div class="msger-header-title">
      <i class="fas fa-comment-alt"></i> Please Note ::::: this chat is public to everyone..!!
    </div>

  </header>

	<style media="screen">

.msger {
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  max-width: 70%;
  margin-top: 5.5rem;
	margin-left: 12rem;
  height: calc(100% - 50px);
  border:2px solid #ddd;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
}
.msger-header {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  border-bottom: 2px solid #ddd;
  background: #eee;
  color: #666;
}

.msger-chat {
  padding: 10px;
}
.msger-chat::-webkit-scrollbar {
  width: 6px;
}
.msger-chat::-webkit-scrollbar-track {
  background: #ddd;
}
.msger-chat::-webkit-scrollbar-thumb {
  background: #bdbdbd;
}
.msg {
  display: flex;
  align-items: flex-end;
  margin-bottom: 10px;
}
.msg:last-of-type {
  margin: 0;
}
.msg-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  background: #ddd;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 50%;
}
.msg-bubble {
  max-width: 450px;
  padding: 15px;
  border-radius: 15px;
  background:#ececec;
}


.msg-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.msg-info-name {
  margin-right: 10px;
  font-weight: bold;
}
.msg-info-time {
  font-size: 0.85em;
}

.left-msg .msg-bubble {
  border-bottom-left-radius: 0;
}

.right-msg {
  flex-direction: row-reverse;
}
.right-msg .msg-bubble {
  background: #579ffb;
  color: #fff;
  border-bottom-right-radius: 0;
}
.right-msg .msg-img {
  margin: 0 0 0 10px;
}

.msger-inputarea {
  display: flex;
  padding: 10px;
  border-top:2px solid #ddd;
  background: #eee;
}
.msger-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msger-input {
  flex: 1;
  background: #ddd;
}
.msger-send-btn {
  margin-left: 10px;
  background: rgb(0, 196, 65);
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.23s;
}
.msger-send-btn:hover {
  background: rgb(0, 180, 50);
}

	</style>

  <div  style="background:url('Assets/images/img2.jpeg');overflow-y:scroll;;height:70vh;" id= "myDiv"class="msger-chat">


  </div>

  <div class="msger-inputarea">
    <input type="text" id ="msger-input" class="msger-input" placeholder="Enter your message...">
    <button type="submit"id ="send" class="msger-send-btn">Send</button>
  </div>
</section>


  </body>


	<script type="text/javascript">

$(document).ready(function(){

		setInterval(function(){
  	retrievegroupmsg();
	}, 1000);


$('#send').on("click",function()
{

	var message = document.getElementById("msger-input").value;

$.ajax({
		url:"ajax/group.php",
		method:"POST",
		data:{
			message:message,
		},
		dataType:"text",

		success:function(data)
		{
		$.playSound("Assets/mp3/click.mp3");
			$("#msger-input").val("");

			setInterval(function(){
				retrievegroupmsg();
		}, 1000);

		}
	})
});


function retrievegroupmsg() {
		$.ajax({
  		url:'ajax/retrievegroupmsg.php',
  		method:"POST",
			cache:false,
  		success:function(data)
			{

					$('.msger-chat').empty();
				$('.msger-chat').append(data);
				$("html,#myDiv").animate({ scrollTop: 1120 }, 500);

			}

  	});
   }



});


	</script>
</html>
