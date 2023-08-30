<?php
	// if uid is set
	if(isset($_REQUEST[ 'uid' ])) {

		// include db connection file
		include '../php/config.php';

		// convert string to integer
		$uid = intval($_REQUEST[ 'uid' ]);

		// delete user record query
		$query = 'DELETE FROM `users` WHERE uid='.$uid;

		// execute query
		$execquery = mysqli_query($conn, $query);

		// count rows affected
		if(mysqli_affected_rows($conn) > 0) {
			echo '<script>
				window.alert("User has been removed.");
				window.location = ".";
			</script>';
		}

		mysqli_close($conn);

	}

	exit;
?>