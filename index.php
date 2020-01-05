<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Weather Map</title> 
	<?php include("components/admin/head.php")?>
	<style>
		body {
			margin: 0;
			padding: 0;
		}
		.video-bg {
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			left: 0;
		}
		.video-bg video {
			position: absolute;
			top: 50%; 
			left: 50%;
			-webkit-transform: translateX(-50%) translateY(-50%);
			transform: translateX(-50%) translateY(-50%);
			min-width: 100%; 
			min-height: 100%; 
			width: auto; 
			height: auto;
			z-index: -1000; 
			overflow: hidden;
		}
		.overlay {
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			left: 0;
			background-color: rgba(0, 0, 0, 0.75);
		}
		.overlay .title {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			color: white;
			font-weight: bold;
			letter-spacing: 1px;
			margin-top: 100px;
			font-size: 2em;
		}

		.overlay .menu {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			color: white;
			font-weight: bold;
			letter-spacing: 1px;
			margin-top: 200px;
			font-size: 1.1em;
			text-align: center;
		}
		.overlay .menu p {
			margin-top: 20px;
		}
		.overlay .menu .btn {
			min-width: 150px;
		}
		.overlay .menu-admin {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			bottom: 30px;
			color: white;
			font-weight: bold;
			letter-spacing: 1px;
			font-size: 1.1em;
			text-align: center;
		}
		.overlay .menu-admin a {
			color: white !important;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="video-bg">
		<video src="assets/video-bg.mp4#t=20" autoplay muted></video>
	</div>
	<div class="overlay">
		<div class="title">
			Weather Map App
		</div>
		<div class="menu">
			<button class="btn btn-primary">Login</button>
			<p>- OR -</p>
			<button class="btn btn-warning">Register</button>
		</div>
		<div class="menu-admin">
			<a href="pages/admin-index.php">
				Are you admin ? Login here
			</a>
		</div>
	</div>
</body>
</html>