<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';
require 'connection/reg_handler.php';

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
  <link rel="stylesheet" type="text/css" href="Assets/styles/mystyle.css">
</head>


  <body>
    <div class="page">
      <div class="main">
        <div class="main-wrapper">
          <div class="login-methods">
            <div class="login-methods-signup "><a href="register.php">Sign up</a></div>
            <div class="login-methods-login"><a href="#">Sign in</a></div>
          </div>
          <form action="login.php" method="post">
            <div class="form-message">
              <div class="form-message-title"><h2>Hie </h2></div>
              <div class="form-message-body">login  and start chatting</div>
            </div>
            <div class="form-body">
              <input type="text" name="email" placeholder="E-mail" />
              <input type="password" name ="password" placeholder="Password" />
                <?php if(in_array("Email or password was incorrect<br>",$user_cred_errors)) echo  "Email or password was incorrect<br>"; ?>
              <button name="submit_btn" style="padding:10px; border-radius:4px; width:40; cursor:pointer;" type="submit">Go</button>
            </div>
          </form>

        </div>
        <div class="main-footer">
          <div class="title">Thabiso</div>
          <hr />
          <div class="copyright">
            Copyright © 2021 All rights reserved | created by
            Thabiso Blessed Ngulube</a>
          </div>
        </div>
      </div>

      <div class="pic">
        <img src="Assets/img/network.jpg" alt="display" />
      </div>
    </div>


  </body>
</html>
