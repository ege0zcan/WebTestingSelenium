<?php 
	// The MySQL database is setup locally. The credentials for that database is given in this file
	$host_name = "localhost";
	$username = "root";
	$password = "10lovers";
	$db_name = "bilkent";

	$mysqli = mysqli_connect($host_name, $username, $password, $db_name);
	if (!$mysqli) {
    		echo "Error: Unable to connect to MySQL." . PHP_EOL;
    		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    		exit;
	}
?>
