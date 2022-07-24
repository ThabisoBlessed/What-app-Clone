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

if(isset($_POST['post'])){

  	$user_status = strip_tags($_POST['Status']);
  	$uploadOk = 1;
		$imageName = $_FILES['fileToUpload']['name'];
		$errorMessage = "";

  if($imageName != "") {

    $targetDir = "Assets/images/proff_pics/";
    $imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);


    if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
      echo $errorMessage;
		}

    if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
      $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
      $uploadOk = 0;
    }


    	if($uploadOk) {
				if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				echo $userclient;
	  $query = mysqli_query($database, "INSERT INTO profile VALUES (NULL, '$userclient','$imageName','$user_status')");
      header("Location: index.php");
         	exit();
				}
		}
		else{
			$uploadOk = 0;
			echo "<div class='alert alert-danger' role='alert'>Image not uploaded.</div>";
		}

  }
	else{
			echo "<div class='alert alert-danger' role='alert'>Image empty.</div>";
			exit();
		}
}



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <meta charset="utf-8">
  <title>My Chat-App </title>
  <link rel="icon" href="favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<style media="screen">
  @font-face {
	font-family: 'Bellota-BoldItalic';
	src: url('../fonts/Bellota-BoldItalic.otf');
}
body{
  background: #112B3C;
  font-size:20px;
  font-family: 'Bellota-BoldItalic';
}
button:hover{
  cursor:pointer;
}
.container{

  background:#fff;
  min-width:300px;
  width:100%;
  max-width:600px;
  height:90vh;
  margin:auto;
  border:5px solid white;
  border-radius:10px;
  padding:10px;
}

.navbar-top{
  width:100%;
  background:transparent;
  font-size:16px;
  padding:10px 0px;
  border-bottom: 1px solid grey;
}
#homebutton{
  background:#e8e8e8;
  border:2px solid grey;
  border-radius:10px;
  padding:5px 10px;
  outline:none;
}
.info{
  width:100%;
}
.profile-picture-div{
  width:100%;
  text-align:center;
  position:relative;
}
#profile-picture{
  top:10px;
  position:relative;
  width:200px;
  height:200px;
  border-radius:50%;
  border:5px solid :#07d100;
}
#editpicture{
  cursor:pointer;
  outline:none;
  background::#e8e8e8;
  border:2px solid grey;
  border-radius:10px;
  padding:5px 10px;
}
.data{
  width:100%;
  text-align:center;
}
.data textarea{
  width:100%;
	font-family: 'Bellota-BoldItalic';
  max-width:300px;
  background:#e8e8e8;
  padding:10px;
  outline:none;
  border-radius:10px;
}
.footer{
  text-align:center;
}
#savebutton{
  background:#0a54ff;
  color:white;
  padding:5px 30px;
  outline:none;
  border-radius:5px;
  font-size:16px;
}
#savebutton:active{
  cursor:wait;
}

.navbar-top p
{
  font-family: 'Bellota-BoldItalic';
  font-size: 20px;
  color:#570A57;
}
</style>
  <body>

    <div class="container">
    <div class="navbar-top">
      <p > Hello.. , upload  profile picture and set your  Status, </p>
    </div>
    <div class="info">
      <form  action="profile.php" method="post" enctype="multipart/form-data">
      <div class="profile-picture-div">

        <img id="profile-picture" src="#" alt="Uploaded Image" accept="image/png, image/jpeg" style="display:none;"><br><br>

        <input type="file" name="fileToUpload" id="fileToUpload" value="upload" >

      </div>
      <br>
      <div class="data">
        <label for="">Status</label><br>
        <textarea name="Status" rows="4" cols="60"></textarea>

      </div>
      <br>
      <div class="footer">
        <button id="savebutton" name="post" id="post_button">Save<br><i class="fa fa-arrow-down"></i></button>

      </div>
</form>
    </div>
    </div>
  </div>




<script type="text/javascript">

    document.getElementById('fileToUpload').addEventListener('change', function(){
      if (this.files[0] ) {
        var imgp = new FileReader();
        imgp.readAsDataURL(this.files[0]);
        imgp.addEventListener('load', function(event) {
          document.getElementById('profile-picture').setAttribute('src', event.target.result);
          document.getElementById('profile-picture').style.display = 'inline-flex';
        });
      }
    });
</script>
  </body>
</html>
