<!-- START OF USERS PAGE -->
<?php
	// start the session
	session_start();

	// check if session
	// and order ID isset
	if(isset($_SESSION[ 'auth' ])) {

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

		// get the order details
		$usersQuery = 'SELECT fname, lname, email, pass, replace(json_extract(home_address, \'$.country\'), \'"\', \'\') AS COUNTRY, replace(json_extract(home_address, \'$.city\'), \'"\', \'\') AS CITY, replace(json_extract(home_address, \'$.state\'), \'"\', \'\') AS STATE, replace(json_extract(home_address, \'$.landmark\'), \'"\', \'\') AS LANDMARK, replace(json_extract(home_address, \'$.pincode\'), \'"\', \'\') AS PINCODE , replace(json_extract(home_address, \'$.address\'), \'"\', \'\') AS ADDRESS FROM `users`';

		// execute query
		$execquery = mysqli_query($conn, $usersQuery);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<script src="https://kit.fontawesome.com/0d1b6d31de.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="orders.css">
	<link rel="stylesheet" type="text/css" href="manage-account.css">
	<title>Users &bull; Admin Dashboard</title>
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
				<h3>Users</h3>
			</div>
		</div>
	</section>
	<!-- END OF NAVBAR-->

	<!-- START OF PATH -->
	<div class="path">
		<div class="txt">
			<span><a href="dashboard.php">Home</a></span>
			<span><i class="fa-solid fa-right-long"></i></span>
			<span><a href="users.php">Users</a></span>
		</div>
	</div>
	<!-- END OF PATH -->

	<!-- START OF ORDERS(S) TABLE -->
	<?php
		// count orders
		$count = mysqli_num_rows($execquery);

		// if no orders
		if($count < 1) {
	?>
	<section class="showOrders">
		<h1>No Orders Found</h1>
	</section><?php } else { ?>
	<section class="showOrders">
		<table class="paginated">
	    <thead>
	      <tr class="headers">
	      	<th scope="col">sno.</th>
	        <th scope="col">first name</th>
	        <th scope="col">last name</th>
	        <th scope="col">email</th>
	        <th scope="col">home address</th>
	        <th scope="col">office address</th>
	        <th scope="col">status</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$i=0;
	    		while($users = mysqli_fetch_assoc($execquery)){
	    			$i++;
	    	?>
		       <tr>
		       	<td><?php echo $i; ?></td>
		        <td><?php echo $users[ 'fname' ]; ?></td>
		        <td><?php echo $users[ 'lname' ]; ?></td>
		        <td><?php echo $users[ 'email' ]; ?></td>
		        <td><?php echo $users[ 'ADDRESS' ].' ,<br/>'.$users[ 'LANDMARK' ].' ,<br/>'.$users[ 'CITY' ].' , '.$users[ 'STATE' ].' , '.$users[ 'COUNTRY' ].' , '.$users[ 'PINCODE' ]; ?></td>
		        <td><?php echo $users[ 'ADDRESS' ].' ,<br/>'.$users[ 'LANDMARK' ].' ,<br/>'.$users[ 'CITY' ].' , '.$users[ 'STATE' ].' , '.$users[ 'COUNTRY' ].' , '.$users[ 'PINCODE' ]; ?></td>
		        <td>
		        	<?php
		        		if($users[ 'pass' ] === NULL)
		        			echo '<font style="color:red; font-weight:bold;">IN-ACTIVE</font>';
		        		else
		        			echo '<font style="color:green; font-weight:bold;">ACTIVE</font>';
		        	?>
		        </td>

		      </tr>
	      	<?php } ?>
	    </tbody>
	  </table>
	</section>
	<!-- END OF USER(S) TABLE -->

</body>
</html><?php mysqli_close($conn); } } else { header('Location: .'); } exit; ?>

<!-- END OF  USERS PAGE -->
