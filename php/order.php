<?php
// start a session
session_start();

// check if form has been submitted
if(($_SERVER[ 'REQUEST_METHOD' ] === strtoupper('post')) === true && isset($_POST[ 'phone' ])){

	// response array
	$responseArray = array('error' => false, 'success' => true, 'auth' => true);

	// iterate through each field
	// to validate form
	foreach ($_POST as $key => $value) {

		// check if input field empty
		if(empty(trim($value))) {
			$responseArray[ 'error' ] = true;
			$responseArray[ 'empty' ] = true;
			$responseArray[ 'input' ] = $key;
		}

		// if name(s) are valid
		if($key === 'fname' || $key === 'lname') {
			for( $i=0; $i<strlen($value); $i++ ) {
				if( ctype_digit($value[$i]) ) {
					$responseArray[ 'error' ] = true;
					$responseArray[ 'invalid' ] = true;
					$responseArray[ 'input' ] = $key;
					break;
				}
			}
		}

		// validate email address
		if($key === 'email') {
			if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				$responseArray[ 'error' ] = true;
				$responseArray[ 'invalid' ] = true;
				$responseArray[ 'input' ] = $key;
			}
		}

		// validate address
		if($key === 'address') {
			if(strlen($value) < 15) {
				$responseArray[ 'error' ] = true;
				$responseArray[ 'invalid' ] = true;
				$responseArray[ 'input' ] = $key;
			}
		}

		// validate city
		if($key === 'city') {
			for( $j=0; $j<strlen($value); $j++ ) {
				if( ctype_digit($value[$j]) ) {
					$responseArray[ 'error' ] = true;
					$responseArray[ 'invalid' ] = true;
					$responseArray[ 'input' ] = $key;
					break;
				}
			}
		}

		// validate pincode
		if($key === 'pincode') {
			if(strlen($value) < 6){
				$responseArray[ 'error' ] = true;
				$responseArray[ 'invalid' ] = true;
				$responseArray[ 'input' ] = $key;
			} else {
				for( $inc=0; $inc<strlen($value); $inc++ ) {
					if( !ctype_digit($value[$inc]) ) {
						$responseArray[ 'error' ] = true;
						$responseArray[ 'invalid' ] = true;
						$responseArray[ 'input' ] = $key;
						break;
					}
				}
			}
		}

		// validate phone number
		if($key === 'phone') {
			if(strlen($value) < 10){
				$responseArray[ 'error' ] = true;
				$responseArray[ 'invalid' ] = true;
				$responseArray[ 'input' ] = $key;
			} else {
				for( $inc=0; $inc<strlen($value); $inc++ ) {
					if( !ctype_digit($value[$inc]) ) {
						$responseArray[ 'error' ] = true;
						$responseArray[ 'invalid' ] = true;
						$responseArray[ 'input' ] = $key;
						break;
					}
				}
			}
		}
	}

	// if form is correctly filled

	// include db connection file
	require_once 'config.php';

	// sanitize data
	// to prevent SQL Injection Attacks
	$uid = rand(1500, 2000);
	$fname = mysqli_real_escape_string($conn, trim($_POST[ 'fname' ]));
	$lname = mysqli_real_escape_string($conn, trim($_POST[ 'lname' ]));
	$email = mysqli_real_escape_string($conn, trim($_POST[ 'email' ]));
	$country = mysqli_real_escape_string($conn, trim($_POST[ 'country' ]));
	$address = mysqli_real_escape_string($conn, trim($_POST[ 'address' ]));
	$landmark = mysqli_real_escape_string($conn, trim($_POST[ 'landmark' ]));
	$city = mysqli_real_escape_string($conn, trim($_POST[ 'city' ]));
	$state = mysqli_real_escape_string($conn, trim($_POST[ 'state' ]));
	$pincode = mysqli_real_escape_string($conn, trim($_POST[ 'pincode' ]));
	$phone = mysqli_real_escape_string($conn, trim($_POST[ 'phone' ]));
	$order_items = mysqli_real_escape_string($conn, trim($_POST[ 'cartit' ]));
	$order_total = mysqli_real_escape_string($conn, trim($_POST[ 'carttt' ]));
	$order_id = rand(1000, 2000);

	$order_info = json_encode(array(
		'order_id' => $order_id,
		'order_items' => $order_items,
		'order_total' => $order_total
	), true);

	// check if user is registered
	// to site
	$query = "SELECT uid,pass FROM `users` WHERE email='$email'";

	// execute query
	$execquery = mysqli_query($conn, $query);

	// count rows returned
	$rows = mysqli_num_rows($execquery);

	$home_address = json_encode(array(
		'country' => $country,
		'city' => $city,
		'state' => $state,
		'pincode' => $pincode,
		'address' => $address,
		'landmark' => $landmark
	), true);

	$office_address = $home_address;

	// user is not registered
	if($rows < 1) {

		// insert data
		// but don't register user
		// by giving NULL value to pass

		
		// add entry to users table
		$query = "INSERT INTO `users`(`uid`, `fname`, `lname`, `email`, `pass`, `home_address`, `office_address`) VALUES ('{$uid}','{$fname}','{$lname}','{$email}',NULL,'{$home_address}','{$office_address}')";

		// add entry to orders table
		$query2 = "INSERT INTO `orders`(`uid`, `order_id`, `order_item`, `order_address`, `order_status`) VALUES ('{$uid}','{$order_id}','{$order_info}','{$home_address}', 'PENDING')";

		// execute insert query
		$execquery = mysqli_query($conn, $query);

		// execute query2
		$execquery2 = mysqli_query($conn, $query2);

		if($execquery && $execquery2) {
			$responseArray[ 'success' ] = true;
			$responseArray[ 'msg' ] = 'Order Placed.';
		}

	} else{

		// if user is registered to site
		// then just update the 
		// orders table

		// fetch the results from database
		$results = mysqli_fetch_assoc($execquery);

		// get the uid from database
		$db_uid = $results[ 'uid' ];
		$db_pass = $results[ 'pass' ];

		if($db_pass === NULL) {
			$responseArray[ 'success' ] = true;
			$responseArray[ 'auth' ] = false;
		}

		// insert the order table
		// with the fetched uid
		$query2 = "INSERT INTO `orders`(`uid`, `order_id`, `order_item`, `order_address`) VALUES ('{$db_uid}','{$order_id}','{$order_info}','{$home_address}')";

		// execute query
		$execquery2 = mysqli_query($conn, $query2);

		// check if executed successfully
		if($execquery2) {
			$responseArray[ 'success' ] = true;
			$responseArray[ 'msg' ] = 'Order Placed.';
		}
	}

	echo json_encode($responseArray);

	mysqli_close($conn);

}else{
	header('Location: .');
}
?>