<?php
	session_start();
	$fmsg = "";
	include('../config/config.php');
	
	if(isset($_POST) & !empty($_POST) ){
		$username = mysqli_real_escape_string($connection, $_POST['adminEmail']);
		$password = md5($_POST['adminPassword']);
		$sql = "SELECT * FROM `admins` WHERE email='$username' AND password='$password'";
		$result = mysqli_query($connection, $sql);
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if($count == 1){
			$_SESSION['username'] = $row['name'];
			$_SESSION['connected'] = true;
			$_SESSION['role'] = $row['role'];
		}else{
			$fmsg = "Invalid Username/Password";
		}
	}
	if(isset($_SESSION['connected']) == true && $_SESSION['role'] == 'administrator'){
		header("Location: dashboard.php");
	}
?>

<!doctype html>
<html class="fixed">
	<head>

		<?php include("../components/admin/head.php") ?>
		<link rel="stylesheet" href="../styles/style.main.css" />

</head>
	<body>
	<div class="video-bg">
		<video src="../assets/video-bg.mp4#t=20" autoplay muted loop></video>
	</div>
		<div class="container  u-pos__rel  color-positive__bg  u-padding-all  u-border__radius  u-margin-top">
			<div class="row  u-pos__rel">
				<div class="col-md-12  text-center  u-pos__rel">
					<!-- start: page -->
					<div class="u-margin-top-double">
						<h1>Admin Weather Locations</h1>
						
						<form method="post">
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="adminEmail">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="adminPassword">
							</div>
							<?php if($fmsg != "") {?>
							<p class="o-title o-title__text-danger  u-font-size__l"><?php echo $fmsg; ?></p>
							<?php } ?>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				
					<!-- end: page -->
				</div>
			</div>
		</div>
		

		<?php include("../components/admin/script.php") ?>

	</body>
</html>