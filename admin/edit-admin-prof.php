<?php
// start session
session_start();

	// check if session exists
	if(isset($_SESSION[ 'auth' ])) {

		// check request method is post
		if($_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset($_POST[ 'editProf' ])) {

			// default values
			$isUpdated = false;

			// include database connection file
			include '../php/config.php';

			// extract the data
			// sent through post method
			extract($_POST);

			// check if first name is valid
			for($i=0; $i<strlen($afname); $i++){
				if(ctype_digit($afname[$i])){
					echo '<script> window.alert("First Name is valid. Please only enter alphabets."); </script>';
					echo '<script> window.location = "admin-profile.php"; </script>';
					break;
					exit;
				}
			}

			// check if last name is valid
			for($i=0; $i<strlen($alname); $i++){
				if(ctype_digit($alname[$i])){
					echo '<script> window.alert("Last Name is valid. Please only enter alphabets."); </script>';
					echo '<script> window.location = "admin-profile.php"; </script>';
					break;
					exit;
				}
			}

			// update the details query
			$updateq= "UPDATE `admin` SET `afname`='{$afname}',`alname`='{$alname}',`admin_email`='{$aemail}' WHERE 1";

			// execute query
			$execquery1 = mysqli_query($conn, $updateq);

			if($execquery1) {
				$isUpdated = true;
			}

			// if image is set
			if(isset($_FILES[ 'adminProf' ]) && !empty($_FILES[ 'adminProf' ][ 'tmp_name' ])) {
				
				// target directory
				$target_dir = 'images/';

				// file name
				$target_file = $target_dir . basename($_FILES[ 'adminProf' ][ 'name' ]);

				// file extension
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Allow certain file formats
				if($imageFileType !== 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'
				&& $imageFileType != 'gif' ) {
					echo '<script> window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed."); </script>';
					echo '<script> window.location = "admin-profile.php"; </script>';
					$isUpdated = false;
					exit;
				}

				// if file has been uploaded
				if (move_uploaded_file($_FILES['adminProf']['tmp_name'], $target_file)) {
    				$isUpdated = true;
				}

				// update the image path
				$ImgPathQuery = "UPDATE `admin` SET `admin_img`='{$_FILES[ "adminProf" ][ "name" ]}' WHERE 1";

				// execute query
				$execImgPathQuery = mysqli_query($conn, $ImgPathQuery);

				if($execImgPathQuery) {
					$isUpdated = true;
				}
			}

			// if passwords are set
			if(isset($_POST[ 'apass' ]) && isset($_POST[ 'anewpass' ])) {

				// store them in respective variables
				$apass = $_POST[ 'apass' ];
				$anewpass = $_POST[ 'anewpass' ];

				// if both passwords are same
				if($apass === $anewpass) {
					echo '<script> window.alert("New password can\'t be same as old password."); </script>';
					echo '<script> window.location = "admin-profile.php"; </script>';
					exit;
				}

				// query to check if current pass is valid
				$checkPass = "SELECT admin_id FROM `admin` WHERE admin_pass='{$apass}'";


				// execute query
				$execcheckPass = mysqli_query($conn, $checkPass);

				// count rows
				$rows = mysqli_num_rows($execcheckPass);

				// if current password is invalid
				// show prompt
				if($rows < 1) {

					echo '<script> window.alert("Current Password is invalid."); </script>';
					echo '<script> window.location = "admin-profile.php"; </script>';
					exit;

				} else {

					// if current password is valid
					// change password
					$updateq = "UPDATE `admin` SET `admin_pass`='{$anewpass}' WHERE 1";

					// execute update query
					$execquery2 = mysqli_query($conn, $updateq);

					$isUpdated = true;
				}

			}

			if($isUpdated == true) {

				// if details have been updated
				echo '<script>window.alert("Details have been updated."); </script>';
				echo '<script>window.location = "admin-profile.php"; </script>';

			}
		} else {

			// if request method is not post
			header('Location: ../admin');
		}

	} else {

		// if session expired or unexists
		header('Location: ../admin');
	}
?>