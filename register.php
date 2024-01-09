<?php
session_start();
$_SESSION['errors'] = $errors;
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$name = $_POST['name'];
	if (empty($email) || empty($password) || empty($name)) {
		header("Location: login_register.php");
		echo "Please fill in all fields.";
	} else {
		$con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "INSERT INTO user (NAME, EMAIL, PASSWORD) VALUES ('$name', '$email', '$password')";

		if (mysqli_query($con, $sql)) {
			header("Location: login_register.php");
			echo "Registration successful.";
		} else {
			header("Location: login_register.php");
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}
?>