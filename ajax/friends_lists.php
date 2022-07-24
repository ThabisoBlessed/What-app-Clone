<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');

$userclient=$_SESSION['email'];
$output="";

$sqldata=mysqli_query($database,"SELECT * FROM users  WHERE email='".$userclient."' ");


  $row = mysqli_fetch_array($sqldata);
$userto=$row['id'];

    $myFriends = explode (",", $row['friends']);


    	foreach($myFriends as $frnd)
      {
      $friend =mysqli_query($database ,"SELECT * FROM profile  WHERE  (email='".$frnd."')");
      $sqldata2=mysqli_query($database,"SELECT * FROM users  WHERE email='".$frnd."' ");


			$row=mysqli_fetch_assoc($friend );
      $row2=mysqli_fetch_assoc($sqldata2);
			if(mysqli_num_rows($friend))
			{
  		$img=$row["image"];
      $userfrom=$row2['id'];
      $query2=mysqli_query($database ,"SELECT * FROM messages WHERE userto='".$userto."' AND userfrom='".$userfrom."' AND status = '1'");

$count=mysqli_num_rows($query2);

$online_status="";

			$friendname =mysqli_query($database ,"SELECT * FROM users  WHERE  (email='".$frnd."')");
		$row2=mysqli_fetch_assoc($friendname );

			if(mysqli_num_rows($friendname))
			{

			$name=$row2['username'];
			$id=$row2['id'];
      if($row2['status']=='1')
      $online_status="<span class='blink'></span>";

			$output.="

        	<a class='friend_link start_chat' href='index.php?chatid=$id'>
			  <li style='width:100%;' class='friend selected'>

			      <img src='$img' />
			      <div class='name'>
			        $name
			      </div>
            ";


            	if($count > 0)
          		$output.= "<div style='backgroung:red;' class='online-notes'><span class='label'>$count</span></div>";
              else
              $output.= "<div  class='online-notes'><span>&nbsp</span></div>";




     $output.="
              <div style='padding-left:20px;' class='online-indicator'>
              $online_status
              </div>



			    </li></a>";


        }
      }
    }
    echo $output;

?>
