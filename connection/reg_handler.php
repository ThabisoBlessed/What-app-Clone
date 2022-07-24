<?php

// 0-username , 1-email ,2-password,3-confirm_password
$user_cred=array();
$user_cred_errors = array();

if(isset($_POST['reg_btn'])){

  	$user_cred[0] = strip_tags($_POST['user']);
  	$user_cred[0] = str_replace(' ', '', $user_cred[0]);
  	$user_cred[0] = ucfirst(strtolower($user_cred[0]));
  	$_SESSION['username'] = $user_cred[0];

  	$user_cred[1] = strip_tags($_POST['email']);
  	$user_cred[1] = str_replace(' ', '', $user_cred[1]);
  	$user_cred[1]= ucfirst(strtolower($user_cred[1]));
  	$_SESSION['email'] = $user_cred[1];


  	$user_cred[2] =strip_tags($_POST['password1']);
  	$user_cred[3] =strip_tags($_POST['password2']);



  if(filter_var($user_cred[1], FILTER_VALIDATE_EMAIL)) {
    $user_cred[1] = filter_var($user_cred[1], FILTER_VALIDATE_EMAIL);
    $check_email= mysqli_query($database, "SELECT email FROM users WHERE email='$user_cred[1]'");
    $rows = mysqli_num_rows($check_email);

    if($rows > 0) {
      array_push($user_cred_errors,"Email already in use<br>");
    }


}

      	if(strlen($user_cred[0])<4) array_push($user_cred_errors, "Username vert short!<br>");

      	if($user_cred[2]!= $user_cred[3]) {
      		array_push($user_cred_errors,  "Passcode error!!<br>");
      	}
      	else {
      		if(preg_match('/[^A-Za-z0-9]/', $user_cred[0])) {
      			array_push($user_cred_errors, "Password should be in English characters!!!<br>");
      		}
      	}

      	if(strlen($user_cred[2]) < 5) {array_push($user_cred_errors, "password is short!!!");}



        if(empty($user_cred_errors)) {

        $pass = md5($user_cred[2]);

        $user_check = mysqli_query($database, "SELECT username FROM users WHERE username='$user_cred[0]'");


        $username = $user_cred[0];
        $check_username_query = mysqli_query($database, "SELECT username FROM users WHERE username='$username'");


            $i = 0;

            while(mysqli_num_rows($check_username_query) != 0) {
              $i++;
              $username = $username . "_" . $i;
              $check_username_query = mysqli_query($database, "SELECT username FROM users WHERE username='$username'");
            }

         $query = mysqli_query($database, "INSERT INTO users VALUES (NULL, '$username', '$user_cred[1]', '$pass',',','0')");

         header("Location: profile.php");
         	exit();

}
        else {
          $string=implode(",",$user_cred_errors);
}
}

//$login

// login

if(isset($_POST['submit_btn'])) {

	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

	$_SESSION['email'] = $email;
	$password = md5($_POST['password']);

	$login = mysqli_query($database, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$rows= mysqli_num_rows($login);

	if($rows == 1) {
		$row = mysqli_fetch_array($login);
		$username = $row['username'];
    echo $username;
		$_SESSION['username'] = $username;
  $query = mysqli_query($database, "UPDATE users SET status='1' WHERE email='$email'");
		header("Location: index.php");
		exit();
	}
	else {
		array_push($user_cred_errors, "Email or password was incorrect<br>");
	}
}
 ?>
