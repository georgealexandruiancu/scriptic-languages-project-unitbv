<?php
session_start();
include("../config/config.php");



$goodMessage = "";
if (isset($_SESSION['connected']) === true && $_SESSION['role'] == 'administrator') {

	$coordiantesView_query = "SELECT * FROM coordinates_default";
	$coordiantesView = $connection->query($coordiantesView_query);

	$users_query = "SELECT * FROM users";
	$users = $connection->query($users_query);

	if (isset($_POST['pushCheckpoint'])) {
		$title = $_POST['title'];
		$description = $_POST['description'];
		$coordX = $_POST['coordX'];
		$coordY = $_POST['coordY'];
		$color_marker = $_POST['color_marker'];

		// INSERT IN DB
		$query = "INSERT INTO coordinates_default 
			(title, description, coordX, coordY, marker_color) 
			VALUES('$title','$description','$coordX','$coordY', '$color_marker')";

		$result = mysqli_query($connection, $query);

		if ($result) {
			$goodMessage = "Checkpoint was saved";
		} else {
			$goodMessage = "Something went wrong";
		}
	}

	if (isset($_POST['editStatus'])) {
		$data = $_POST['editStatus'];
		$id = explode("/", $data)[1];
		$status = explode("/", $data)[0];

		// edit status IN DB
		$query_edit_status = "UPDATE `coordinates_default` SET `status`= '$status' WHERE `id`= '$id'";
		$result = mysqli_query($connection, $query_edit_status);

		if ($result) {
			echo "<script>alert('Data was changed');</script>";
			$coordiantesView = $connection->query($coordiantesView_query);
		}
	}

	if (isset($_POST['editStatusUser'])) {
		$data = $_POST['editStatusUser'];
		$id = explode("/", $data)[1];
		$status = explode("/", $data)[0];

		// edit status IN DB
		$query_edit_status = "UPDATE `users` SET `locked`= '$status' WHERE `id`= '$id'";
		$result = mysqli_query($connection, $query_edit_status);

		if ($result) {
			echo "<script>alert('Data was changed');</script>";
			$users = $connection->query($users_query);
		}
	}
} else {
	header("Location: admin-index.php");
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
				<a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#CreateCheckpoint">Create checkpoint</a>
				<a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#ViewCheckpoint">View checkpoints</a>
				<a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#ViewUsersModal">Users</a>
			</div>
		</div>
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


	<!-- View checkpoint -->
	<div class="modal fade" id="ViewCheckpoint" tabindex="-1" role="dialog" aria-labelledby="ViewCheckpoint" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ViewCheckpoint">View Checkpoints</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Title</th>
								<th scope="col">Description</th>
								<th scope="col">Coord X</th>
								<th scope="col">Coord Y</th>
								<th scope="col">Color</th>
								<th scope="col">Status</th>
								<th scope="col">Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($coordiantesView->num_rows > 0) {
								while ($row = $coordiantesView->fetch_assoc()) { ?>
									<tr>
										<th scope="row"><?php echo $row['id'] ?></th>
										<td><?php echo $row['title'] ?></td>
										<td><?php echo $row['description'] ?></td>
										<td><?php echo $row['coordX'] ?></td>
										<td><?php echo $row['coordY'] ?></td>
										<td><?php echo $row['marker_color'] ?></td>
										<td><?php echo $row['status'] ?></td>
										<td>
											<?php if ($row['status'] == 1) { ?>
												<form method="post">
													<button class="btn btn-danger" type="submit" name="editStatus" value="0/<?php echo $row['id'] ?>">Set Inactive</button>
												</form>
											<?php } else { ?>
												<form method="post">
													<button class="btn btn-primary" type="submit" name="editStatus" value="1/<?php echo $row['id'] ?>">Set Active</button>
												</form>
											<?php } ?>
										</td>

									</tr>
							<?php  }
							} ?>
						</tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ViewUsersModal" tabindex="-1" role="dialog" aria-labelledby="ViewUsersModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">View Users</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Email</th>
								<th scope="col">Name</th>
								<th scope="col">Locked mode</th>
								<th scope="col">EDIT</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($users->num_rows > 0) {
								while ($row2 = $users->fetch_assoc()) { ?>
									<tr>
										<th scope="row"><?php echo $row['id'] ?></th>
										<td><?php echo $row2['id'] ?></td>
										<td><?php echo $row2['email'] ?></td>
										<td><?php echo $row2['name'] ?></td>
										<td><?php echo $row2['locked'] ?></td>
										<td>
											<?php if ($row2['locked'] == 1) { ?>
												<form method="post">
													<button class="btn btn-warning" type="submit" name="editStatusUser" value="0/<?php echo $row2['id'] ?>">Set Active</button>
												</form>
											<?php } else { ?>
												<form method="post">
													<button class="btn btn-danger" type="submit" name="editStatusUser" value="1/<?php echo $row2['id'] ?>">Set Inactive</button>
												</form>
											<?php } ?>
										</td>
									</tr>
							<?php  }
							} ?>
						</tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
				</div>
			</div>
		</div>
	</div>




	<?php include("../components/admin/script.php") ?>


	<script>
		$(document).ready(function() {
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
		})
	</script>


	<?php include("../components/admin/maps.php") ?>
	<!-- Menu Toggle Script -->


</body>

</html>