<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Weather Map</title> 
	<?php include("components/admin/head.php")?>
	<link rel="stylesheet" href="styles/style.main.css" />

</head>
<body>
	<div class="video-bg">
		<video src="assets/video-bg.mp4#t=20" autoplay muted loop></video>
	</div>
	<div class="overlay">
		<div class="title">
			Weather Map App
		</div>
		<div class="menu">
			<a href="pages/user-index.php">
				<button class="btn btn-primary">Login</button>
			</a>
			<p>- OR -</p>
			<a href="pages/user-register.php">
				<button class="btn btn-warning">Register</button>
			</a>
		</div>
		<div class="menu-admin">
			<a href="pages/admin-index.php">
				Are you admin ? Login here
			</a>
		</div>
	</div>
</body>
</html>