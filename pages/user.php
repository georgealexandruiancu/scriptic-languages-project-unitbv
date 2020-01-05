<?php 
	session_start();
	include("../config/config.php");



	$goodMessage = "";
	if (isset($_SESSION['connected']) === true && $_SESSION['role'] == 'user') {
		if (isset($_POST['pushCheckpoint'])) {
			$title = $_POST['title'];
			$description = $_POST['description'];
			$coordX = $_POST['coordX'];
			$coordY = $_POST['coordY'];
			$color_marker = $_POST['color_marker'];
			$status = 0;

			// INSERT IN DB
			$query = "INSERT INTO coordinates_default 
			(title, description, coordX, coordY, marker_color, status) 
			VALUES('$title','$description','$coordX','$coordY', '$color_marker', $status)";
	
			$result = mysqli_query($connection, $query);
	
			if ($result) {
				echo "<script>alert('Checkpoint was saved, wait for approving from admin');</script>";
				$goodMessage = "Checkpoint was saved, wait for approving from admin";
			} else {
				echo "<script>alert('Something went wrong, please try again later');</script>";
				$goodMessage = "Something went wrong, please try again later";
			}
		}
	} else {
		header("Location: user-index.php");
	}
?>
<!doctype html>
<html class="fixed">
	<head>

		<?php include("../components/admin/head.php") ?>
		<title>ADMIN DASHBOARD</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<body>

  <div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<div class="bg-light border-right" id="sidebar-wrapper">
	  <div class="sidebar-heading  o-title  color-secondary">
		  Weather map
		<p>Hi, <?php echo $_SESSION['username']; ?></p>
	</div>
	  <div class="list-group list-group-flush">
		<a href="#" class="list-group-item list-group-item-action bg-light"  data-toggle="modal" data-target="#CreateCheckpoint">Create checkpoint</a>
	  </div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<button class="btn btn-primary" id="menu-toggle">Fullscreen</button>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link  color-danger" href="middleware/logout.php">Logout <span class="sr-only">(current)</span></a>
				</li>
				</ul>
			</div>
		</nav>

	  <div class="container-fluid  u-post__rel  u-full  u-none-padding">
			<div id="map"></div>
	</div>
	<!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Create checkpoint -->
<div class="modal fade" id="CreateCheckpoint" tabindex="-1" role="dialog" aria-labelledby="CreateCheckpoint" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="CreateCheckpoint">Create checkpoint</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
			<form method="post" action="">
				<div class="form-group row">
					<label for="locationTitle" class="col-sm-2 col-form-label">Location Title</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" id="locationTitle" placeholder="Location Title.." name="title">
					</div>
				</div>

				<div class="form-group row">
					<label for="locationDescription" class="col-sm-2 col-form-label">Location Description</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" id="locationDescription" placeholder="Location Description.." name="description">
					</div>
				</div>

				<div class="form-group row">
					<label for="Latitude" class="col-sm-2 col-form-label">Latitude</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" id="Latitude" placeholder="Latitude" name="coordX">
					</div>
				</div>

				<div class="form-group row">
					<label for="Longitutde" class="col-sm-2 col-form-label">Longitutde</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" id="Longitutde" placeholder="Longitutde" name="coordY">
					</div>
				</div>
				<div class="form-group row">
					<label for="exampleFormControlSelect1" class="col-sm-2">Color marker</label>
					<div class="col-sm-10">
					<select class="form-control" id="exampleFormControlSelect1" name="color_marker">
						<option value="purple">Purple</option>
						<option value="red">Red</option>
						<option value="green">Green</option>
						<option value="ltblue">Cyan</option>
						<option value="yellow">Yellow</option>
						<option value="blue">Blue</option>
						<option value="orange">Orange</option>
					</select>
					</div>
				</div>
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
					<button type="submit" class="btn btn-primary" name="pushCheckpoint">Push Checkpoint</button>
				</form>
				</div>
		</div>
	</div>
</div>


  <?php include("../components/admin/script.php") ?>

  <!-- Menu Toggle Script -->
  <script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
  </script>

	<?php include("../components/admin/maps.php") ?>
	

</body>

</html>