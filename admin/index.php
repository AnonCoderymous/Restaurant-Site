<?php
//start session
session_start();

// check if admin
// already logged in
if(!isset($_SESSION[ 'auth' ])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<script src="https://kit.fontawesome.com/0d1b6d31de.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>ABC Restaurant &bull; Admin Login</title>
</head>
<body>

	<!-- START MAIN SECTION -->
	<section class="main">

		<div class="heading">ABC Restaurant &bull; Admin Login</div>
		
		<!-- START LOGIN FORM -->
			<form action="login.php" method="POST" autocomplete="off">
				<label>Email</label>
				<input type="email" name="email" placeholder="Email" required />
				<label>Password</label>
				<input type="password" name="pass" placeholder="Password" required />
				<input type="submit" name="login" value="Log In" />
				<div class="forgotpass">
					<a href="#">Forgot your password?</a>
				</div>
			</form>
		<!-- END LOGIN FORM -->

	</section>
	<!-- END MAIN SECTION -->
</body>
</html>
<?php } else {
	header('Location: dashboard.php');
} exit; ?>