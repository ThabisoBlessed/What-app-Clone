<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../connection/connect.php');


$fromUser =$_REQUEST['fromUser'];
$toUser=$_REQUEST['toUser'];


$output="";


$chats=mysqli_query($database,"SELECT * FROM messages WHERE (userfrom='".$fromUser."') AND  (userto= '".$toUser."')
OR (userfrom='".$toUser."') AND  (userto='".$fromUser."' )");

		while ($chat=  mysqli_fetch_assoc($chats)) {

					if($chat['userfrom']==$fromUser)
					{
					$output.=
					"
				<div style='text-align:right;'>
					<p style='background-color:lightblue;word-wrap:break-word;display:inline-block;padding:10px;border-radius:10px;max-width:70%;'>
					".$chat["chatmessage"]."
					</p></div>

					";
				}
					else {
						$output.=
						"
						<div style='text-align:left;'>
						<p style='background-color:yellow;word-wrap:break-word;display:inline-block;padding:10px;border-radius:10px;max-width:70%;'>
						".$chat["chatmessage"]."
						</p></div>

						";

					}
				}
        echo $output;

 ?>
