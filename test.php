<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connection/connect.php';

if (isset($_SESSION['email'])) {
	$userclient = $_SESSION['email'];
  $nme_query=mysqli_query($database ,"SELECT username FROM users WHERE email='".$userclient."' ");
  $query=mysqli_query($database ,"SELECT * FROM profile WHERE email='".$userclient."' ");
  $row=mysqli_fetch_assoc($query);
  $row2=mysqli_fetch_assoc($nme_query);

      $username=$row2["username"];
  		$status=$row["status"];
			$img=$row["image"];

}
else {
	header("Location: register.php");

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
    <link rel="stylesheet" type="text/css" href="Assets/styles/mystyle.css">
  </head>

  <body>
    <svg display="none">
  	<symbol id="close" viewBox="0 0 20 20">
  		<line x1="2" y1="2" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
  		<line x1="2" y1="18" x2="18" y2="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
  	</symbol>
  	<symbol id="left" viewBox="0 0 20 20">
  		<polyline points="11,7 8,10 11,13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
  	</symbol>
  	<symbol id="right" viewBox="0 0 20 20">
  		<polyline points="9,7 12,10 9,13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
  	</symbol>
  </svg>
  <div id="img_grid" class="img-grid">
  	<div class="img-grid__detail-pane" data-open="false">
  		<div class="img-grid__detail-pane-left">
  			<img class="img-grid__detail-pane-img" alt="Random image" src="https://picsum.photos/seed/_1/300/225.webp" width="300" height="225" data-image>
  		</div>
  		<div class="img-grid__detail-pane-right">
  			<button class="img-grid__detail-pane-close" type="button" aria-label="Close" data-action="close">
  				<svg class="img-grid__detail-pane-close-svg" width="20px" height="20px">
  					<use xlink:href="#close" />
  				</svg>
  			</button>
  			<div class="img-grid__detail-pane-info">
  				<div>
  					<h5 class="img-grid__detail-pane-title" data-title>Random Image 1</h5>
  					<p class="img-grid__detail-pane-site">picsum.photos</p>
  				</div>
  				<a class="img-grid__detail-pane-btn" href="#">View Image</a>
  			</div>
  			<div class="img-grid__detail-pane-arrows">
  				<button class="img-grid__detail-pane-btn img-grid__detail-pane-btn--arrow" type="button" aria-label="Previous" data-action="prev" disabled>
  					<svg class="img-grid__detail-pane-arrow-svg" width="20px" height="20px">
  						<use xlink:href="#left" />
  					</svg>
  				</button>
  				<button class="img-grid__detail-pane-btn img-grid__detail-pane-btn--arrow" type="button" aria-label="Next" data-action="next">
  					<svg class="img-grid__detail-pane-arrow-svg" width="20px" height="20px">
  						<use xlink:href="#right" />
  					</svg>
  				</button>
  			</div>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="0">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_1/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 1</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="1">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_2/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 2</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="2">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_3/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 3</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="3">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_4/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 4</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="4">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_5/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 5</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="5">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_6/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 6</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="6">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_7/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 7</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="7">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_8/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 8</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="8">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_9/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 9</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  	<div class="img-grid__cell">
  		<button class="img-grid__cell-img-btn" type="button" data-action="open" data-id="9">
  			<img class="img-grid__cell-img" alt="Random image" src="https://picsum.photos/seed/_10/300/225.webp" width="300" height="225" data-thumb>
  		</button>
  		<div class="img-grid__cell-caption">
  			<a class="img-grid__cell-caption-link" href="#">
  				<span class="img-grid__cell-caption-title">Random Image 10</span><br>
  				<span class="img-grid__cell-caption-subtitle">picsum.photos</span>
  			</a>
  		</div>
  	</div>
  </div>

  <script src="Assets/javascript/test.js">

  </script>
  </body>
</html>
