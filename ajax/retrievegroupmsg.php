<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');


$userclient=$_SESSION['email'];
$output="";



$nme_query2=mysqli_query($database ,"SELECT * FROM profile WHERE email='".$userclient."' ");
$row22=mysqli_fetch_assoc($nme_query2);
$pic=$row22["image"];

$nme_query=mysqli_query($database ,"SELECT * FROM users WHERE email='".$userclient."' ");
$row2=mysqli_fetch_assoc($nme_query);
$fromUser=$row2["username"];

$chats=mysqli_query($database,"SELECT * FROM publicchat");




		while ($chat=  mysqli_fetch_assoc($chats)) {

					if($chat['name']==$fromUser)
					{


            $output.="
            <div class='msg right-msg'>
              <div class='msg-img' style='background-image: url(".$pic.")'></div>

              <div class='msg-bubble'>
                <div class='msg-info'>
                <div class='msg-info-name'>".$chat['name']."</div>
                <div class='msg-info-time'>".$chat['msgdate']."</div>
                </div>

                <div class='msg-text'>
                  ".$chat['message']."
                </div>
              </div>
            </div>";


          }

  else {
    $output.="
  <div class='msg left-msg'>
      <div class='msg-img' style='background-image: url(https://image.flaticon.com/icons/svg/327/327779.sv)'></div>

      <div class='msg-bubble'>
        <div class='msg-info'>
        <div class='msg-info-name'>".$chat['name']."</div>
        <div class='msg-info-time'>".$chat['msgdate']."</div>
        </div>
        <div class='msg-text'>
          ".$chat['message']."
        </div>
      </div>
    </div>
";
}

}




echo $output;


 ?>
