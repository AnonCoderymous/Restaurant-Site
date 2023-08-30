<?php

// start a session
session_start();

// check if login button was clicked
// and request method is set to POST
if(($_SERVER[ 'REQUEST_METHOD' ] === strtoupper( 'post' )) === true && isset($_POST[ 'login' ])) {

	// include database connection file
	include '../php/config.php';

	// extract the data
	extract($_POST);

	// sanitize the data
	$email = mysqli_real_escape_string($conn, $email);
	$pass = mysqli_real_escape_string($conn, $pass);

	// query to check if admin
	// credentials are valid
	$loginQuery = "SELECT * FROM `admin` WHERE admin_email='$email' AND admin_pass='$pass'";


	// execute query
	$execloginQuery = mysqli_query($conn, $loginQuery);

	// count rows
	$rows = mysqli_num_rows($execloginQuery);

	// check if rows are less than 1
	if($rows < 1) {
		// credentials invalid prompt
		echo '<script>alert("Login Credentials are Incorrect.");';
		echo 'window.location=".";</script>';
	} else {

		// credentials are valid
		// create a session
		$_SESSION[ 'auth' ] = true;

		// redirect to dashboard
		header('Location: dashboard.php');
	}

	mysqli_close($conn);
}

exit;

?>