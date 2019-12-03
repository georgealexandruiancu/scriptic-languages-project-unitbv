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
			$_SESSION['username'] = $username;
			$_SESSION['connected'] = true;
			$_SESSION['role'] = $row['role'];
		
		}else{
			$fmsg = "Invalid Username/Password";
		}
	}
	if(isset($_SESSION['connected']) == true){
		header("Location: dashboard.php");
	}
?>

<!doctype html>
<html class="fixed">
	<head>

		<?php include("../components/admin/head.php") ?>

</head>
	<body>
		<div class="container  u-pos__rel">
			<div class="row  u-pos__rel">
				<div class="col-md-12  text-center  u-pos__rel">
					<!-- start: page -->
					<div class="u-margin-top-double">
						<h1>Admin Weather Locations</h1>
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
							</div>
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