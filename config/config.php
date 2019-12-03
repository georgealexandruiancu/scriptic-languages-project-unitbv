<?php 

$connection = mysqli_connect('127.0.0.1', 'root', '');
if(!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}

// --------------------------------------------
// MAKE A SETUP WITH '../setup/createDB.php'.
// RENAME 'admin_cms' with your DB name created previous the setup '../setup/createDB.php'.
// --------------------------------------------

$select_db = mysqli_select_db($connection, 'ls-project');
if(!$select_db){
	die("Database Selection Failed" . mysqli_error($connection));
}

?>