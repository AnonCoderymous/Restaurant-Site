<?php
// start session
session_start();

// check if session exists
if(isset($_SESSION[ 'auth' ])){

// include connection file
include '../php/config.php';

// query
// to fetch the data
// of admin
$query = 'SELECT * FROM `admin`';

// execute query
$execquery = mysqli_query($conn, $query);

// fetch the results
$r = mysqli_fetch_assoc($execquery);

// extract data
extract($r);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<script src="https://kit.fontawesome.com/0d1b6d31de.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" href="manage-account.css">
	<title>Manage Account &bull; Admin Dashboard</title>
</head>
<body>

	<!-- START OF NAVBAR-->
	<section class="navbar">
		<div class="nav-1">
			<div class="col-0">
				<img src="../images/favicon.jpg" alt="Favicon">
			</div>
			<div class="col-1">
				<div class="txtArea">
					<span id="name"><?php echo $afname.' '.$alname; ?></span>
				</div>
				<div class="user-icon">
					<i class="fa-solid fa-user"></i>
				</div>
			</div>
		</div>
		<div class="nav-2">
			<div class="head">
				<h3>Administration</h3>
			</div>
		</div>
	</section>
	<!-- END OF NAVBAR-->


	<!-- START OF PATH -->
	<div class="path">
		<div class="txt">
			<span><a href="dashboard.php">Home</a></span>
			<span><i class="fa-solid fa-right-long"></i></span>
			<span><a href="admin-profile.php">Administration</a></span>
		</div>
	</div>
	<!-- END OF PATH -->

	<!-- START OF FORM -->
	<section class="form">
		<form action="edit-admin-prof.php" method="POST" autocomplete="off" enctype="multipart/form-data">
			<div class="admin_img">
				<img src=<?php echo '"./images/'.$admin_img.'"'; ?>>
				<div class="uploadArea">
					<input type="file" title="Choose an image" name="adminProf">
					<button type="button">Change Picture</button>
				</div>
			</div>
			<label>First Name</label>
			<input type="text" name="afname" placeholder="" value=<?php echo '"'.$afname.'"'; ?> required  />
			<label>Last Name</label>
			<input type="text" name="alname" placeholder="" value=<?php echo '"'.$alname.'"'; ?> required />
			<label>Email</label>
			<input type="email" name="aemail" value=<?php echo '"'.$admin_email.'"'; ?>>
			<div class="passArea">
				<div class="label"><label>Password: </label></div>
				<input type="hidden" placeholder="Current Password" required/>
				<input type="hidden" placeholder="New Password" required />
				<div class="href"><div>Change password?</div></div>
			</div>
			<div class="typeArea">
				<div class="label"><label>Type: </label></div>
				<div class="txt">Administrator</div>
			</div>
			<div class="statusArea">
				<div class="label"><label>Status: </label></div>
				<div class="txt">Active</div>
			</div>
			<div class="buttonArea">
				<a href="dashboard.php">Cancel</a>
				<button type="submit" value="save" name="editProf">Save</button>
			</div>
		</form>
	</section>
	<!-- END OF FORM -->

	<!-- Script File(s) -->
	<script src="./js/admin-profile.js"></script>
</body>
</html>
<?php
	mysqli_close($conn);
	} else {
		header('Location: .');
	}

	exit;
?>