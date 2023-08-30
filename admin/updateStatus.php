<?php
	// start the session
	session_start();

	// check if session
	// and order ID isset
	if(isset($_SESSION[ 'auth' ]) && isset($_GET[ 'order_id' ])) {

		// include database connection file
		include '../php/config.php';

		// convert into integeger
		// and sanitize data
		$order_id = mysqli_real_escape_string($conn, intval($_GET[ 'order_id' ]));

		// update the order status query
		$query = "UPDATE `orders` SET `order_status`='FULLFILLED' WHERE order_id=".$order_id;

		// run the query
		$execquery = mysqli_query($conn, $query);

		// success execution
		// of query
		if($execquery) {

			// display success prompt
			// and redirect to orders page
			echo '
				<script>
					window.alert("Status updated successfully.");
					window.location = "orders.php";
				</script>
			';

		} else {

			// if query execution fails

			echo '
				<script>
					window.alert("An Error occured. Try again later.");
					window.location = "orders.php";
				</script>
			';			

		}

		mysqli_close($conn);
	} else {

		// redirect to admin login page
		header('Location: .');
	}

	exit;
?>