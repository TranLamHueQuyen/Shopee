<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ql_banhang";
	
	// Create connection
	// Example (MySQLi Object-Oriented)
	$con = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	} else {
		echo "Connected successfully";
	}
	
?>