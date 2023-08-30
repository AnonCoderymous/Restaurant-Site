<!-- START OF ADMIN PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<script src="https://kit.fontawesome.com/0d1b6d31de.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<title>Welcome &bull; Admin Dashboard</title>
</head>
<?php
// start session
session_start();

// check if admin is authorized
if(isset($_SESSION[ 'auth' ])) {

	// include the connection file
	include '../php/config.php';

	// totalItems Empty String
	$totalItems = '';

	// get total number of orders
	$query = "SELECT uid FROM `orders` WHERE 1";

	// execute query
	$execquery = mysqli_query($conn, $query);

	// get the rows returned
	$rows = mysqli_num_rows($execquery);

	// get the total revenue
	$query = 'SELECT SUM(replace(json_extract(order_item, \'$.order_total\'), \'"\', \'\')) AS TOTAL FROM orders WHERE 1';

	// execute query
	$execquery = mysqli_query($conn, $query);

	// get the result from database
	$result = mysqli_fetch_assoc($execquery);

	// get the TOTAL value from database
	$total = $result[ 'TOTAL' ];

	// total item(s) sold
	$query = 'SELECT replace(json_extract(order_item, \'$.order_items\'), \'"\', \'\') AS ITEMS FROM orders WHERE 1';

	// execute query
	$execquery = mysqli_query($conn, $query);

	// get the result from database
	while($result = mysqli_fetch_assoc($execquery)) {
		// push the values to the string
		$totalItems .= $result[ 'ITEMS' ].',';
	}

	// split each items
	// to count total
	// number of items
	// sold
	$split_item = explode(',', $totalItems);

	// get list of all users
	$query = 'SELECT * FROM `users` WHERE 1';

	// execute query
	$execquery = mysqli_query($conn, $query);

	// count users
	$userCount = mysqli_num_rows($execquery);

	// query to fetch
	// admin details
	$query = 'SELECT afname,alname,admin_img FROM `admin`';

	// execute query
	$execquery = mysqli_query($conn, $query);

	// fetch admin firstname and lastname
	$result = mysqli_fetch_assoc($execquery);

	// extract data from result array
	extract($result);
?>
<body>
	<!-- START OF MAIN -->
	<section class="main">
		
		<!-- START OF NAVBAR -->
		<section class="nav">
			<div class="left">
				<div class="admin_menu">
					<div class="menu activeNav">
						<a href=".">
							<i class="fa-solid fa-toolbox"></i>
							dashboard
						</a>
					</div>
					<div class="menu">
						<a href="admin-profile.php">
							<i class="fa-solid fa-user"></i>
							profile
						</a>
					</div>
					<div class="menu">
						<a href="orders.php">
							<i class="fa-solid fa-bag-shopping"></i>
							orders
						</a>
					</div>
					<div class="menu">
						<a href="users.php">
							<i class="fa-solid fa-user"></i>
							users
						</a>
					</div>
				</div>
			</div>
			<div class="middle">
				<div class="txt">
					Welcome, Admin
				</div>
			</div>
			<div class="right">
				<div class="parent">
					<div class="notification">
						<i class="fa-solid fa-bell"></i>
						<span id="redDot"></span>
					</div>
					<div class="adminIcon">
						<div class="img">
							<img src=<?php echo '"./images/'.$admin_img.'"'; ?>>
						</div>
					</div>
					<div class="roleArea">
						<div class="name"><?php echo $afname.' '.$alname; ?></div>
						<div class="role">Admin</div>
					</div>
					<div class="dropdown">
						<i class="fa-solid fa-angle-down"></i>
					</div>
				</div>
				<div class="dropdown_menu">
					<div><a href="logout.php">logout</a></div>
					<div><a href="admin-profile.php">account</a></div>
				</div>
			</div>
		</section>
		<!-- END OF NAVBAR -->

		<!-- START OF CARD SECTIONS -->
		<section class="cards">
			<div class="revenue">
				<div class="txt">
					this month revenue
				</div>
				<div class="amt">
					&#x20B9; <?php 
						if($total < 1){
							echo 0;
						}
						echo $total;
					?>
				</div>
			</div>
			<div class="earnings">
				<div class="txt">
					total earning
				</div>
				<div class="amt">
					&#x20B9; <?php 
						if($total < 1){
							echo 0;
						}
						echo $total;
					?>
				</div>
			</div>
			<div class="totalorders">
				<div class="txt">
					total orders
				</div>
				<div class="amt">
					<?php echo $rows; ?>
				</div>
			</div>
			<div class="productsSold">
				<div class="txt">
					products sold
				</div>
				<div class="amt">
					<?php echo count($split_item)-1;; ?>
				</div>
			</div>
			<div class="totalUsers">
				<div class="txt">
					Total Users
				</div>
				<div class="amt">
					<?php echo $userCount; ?>
				</div>
			</div>
			<div class="totalVisits">
				<div class="txt">
					Total Visits
				</div>
				<div class="amt">
					<?php echo 50; ?>
				</div>
			</div>
			<div class="totalEnquiries">
				<div class="txt">
					Total Enquiries
				</div>
				<div class="amt">
					<?php echo 83; ?>
				</div>
			</div>
			<div class="totalComplaints">
				<div class="txt">
					Total Complaints
				</div>
				<div class="amt">
					<?php echo 33; ?>
				</div>
			</div>
		</section>
		<!-- END OF CARD SECTIONS -->

	</section>
	<!-- END OF MAIN -->

	<!-- START OF USER(S) TABLE -->
	<?php /* <section class="showUsers">
		<h1>No Users Found</h1>
	</section>
	<?php
		} else {
	?>
	<section class="showUsers">
		<h1>Registered Users</h1>
		<br/>
		<table class="paginated">
	    <thead>
	      <tr class="headers">
	      	<th scope="col">sno.</th>
	      	<th scope="col">uid</th>
	        <th scope="col">first name</th>
	        <th scope="col">last name</th>
	        <th scope="col">email</th>
	        <th scope="col">status</th>
	        <th scope="col">edit</th>
	        <th scope="col">delete</th>
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
		        <td><?php echo $users[ 'uid' ]; ?></td>
		        <td><?php echo $users[ 'fname' ]; ?></td>
		        <td><?php echo $users[ 'lname' ]; ?></td>
		        <td><?php echo $users[ 'email' ]; ?></td>
		        <td><?php if($users[ 'pass' ] === NULL){ echo '<div style="color: maroon; font-weight:bold;">IN-ACTIVE</div>'; } else { echo '<div style="color:green; font-weight:bold;">ACTIVE</div>'; } ?></td>
		        <td><a href=<?php echo '"./editUser.php?uid='.$users[ 'uid' ].'"'; ?>><i class="fa-solid fa-pen-to-square"></i></a></a></td>
		        <td><a href=<?php echo '"./removeUser.php?uid='.$users[ 'uid' ].'"'; ?>><i class="fa-solid fa-trash"></i></td>
		      </tr>
	      	<?php } } ?>
	    </tbody>
	  </table>
	</section> */ ?>
	<!-- END OF USER(S) TABLE -->

	<!-- Script File(s) -->
	<script src="./js/dashboard.js"></script>

</body>
</html><?php mysqli_close($conn); } else {
	header('Location: .');
} exit; ?>
<!-- END OF ADMIN PAGE -->