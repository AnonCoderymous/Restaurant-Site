<?php
// start a session
session_start();

// check if admin is authenticated
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

	// get the order details
	$ordersQuery = 'SELECT uid, order_id, replace(json_extract(order_item, \'$.order_items\'), \'"\', \'\') AS ITEMS, replace(json_extract(order_item, \'$.order_total\'), \'"\', \'\') AS TOTAL , replace(json_extract(order_address, \'$.country\'), \'"\', \'\') AS COUNTRY, replace(json_extract(order_address, \'$.city\'), \'"\', \'\') AS CITY, replace(json_extract(order_address, \'$.state\'), \'"\', \'\') AS STATE, replace(json_extract(order_address, \'$.pincode\'), \'"\', \'\') AS PINCODE, replace(json_extract(order_address, \'$.address\'), \'"\', \'\') AS ADDRESS, replace(json_extract(order_address, \'$.landmark\'), \'"\', \'\') AS LANDMARK, order_status FROM `orders` WHERE 1';

	// execute query
	$execquery = mysqli_query($conn, $ordersQuery);
?>
<!-- START OF ORDERS PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/jpg" href="../images/favicon.jpg">
	<script src="https://kit.fontawesome.com/0d1b6d31de.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="orders.css">
	<link rel="stylesheet" type="text/css" href="manage-account.css">
	<title>Admin Portal &bull; Orders Page</title>
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
				<h3>Orders Page</h3>
			</div>
		</div>
	</section>
	<!-- END OF NAVBAR-->

	<!-- START OF PATH -->
	<div class="path">
		<div class="txt">
			<span><a href="dashboard.php">Home</a></span>
			<span><i class="fa-solid fa-right-long"></i></span>
			<span><a href="orders.php">Orders</a></span>
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
	        <th scope="col">items</th>
	        <th scope="col">quantity</th>
	        <th scope="col">delivery address</th>
	        <th scope="col">total amount</th>
	        <th scope="col">google map</th>
	        <th scope="col">status</th>
	        <th scope="col">change status</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$i=0;
	    		while($users = mysqli_fetch_assoc($execquery)){

	    			// fetch the user details query
	    			$userQuery = "SELECT fname, lname, email FROM `users` WHERE `users`.`uid`=".$users[ 'uid' ];

	    			// run the query
	    			$execquery2 = mysqli_query($conn, $userQuery);

	    			// fetch results
	    			$results2 = mysqli_fetch_assoc($execquery2);

	    			// make an array of all
	    			// items
	    			$items = explode(',', $users[ 'ITEMS' ]);

	    			$i++;
	    	?>
		       <tr>
		       	<td><?php echo $i; ?></td>
		        <td><?php echo $results2[ 'fname' ]; ?></td>
		        <td><?php echo $results2[ 'lname' ]; ?></td>
		        <td><?php echo $results2[ 'email' ]; ?></td>
		        <td>
		        	<?php
		        		foreach($items as $itemEach) {
		        			
		        			// query to get name
		        			// of item
		        			$itemQuery = "SELECT item_name, item_img FROM `items` WHERE item_id=".$itemEach;

		        			// execute query
		        			$execitemQuery = mysqli_query($conn, $itemQuery);

		        			// fetch the results
		        			$r = mysqli_fetch_assoc($execitemQuery);
		        			echo $r[ 'item_name' ].'<br/><br/>';

		        		}
		        	?>
		        </td>
		        <td>1</td>
		        <td><?php echo $users[ 'ADDRESS' ].' , '.$users[ 'LANDMARK' ].' , '.$users[ 'CITY' ].' , '.$users[ 'STATE' ].' , '.$users[ 'COUNTRY' ].' , '.$users[ 'PINCODE' ]; ?></td>
		        <td><?php echo $users[ 'TOTAL' ]; ?></td>
		        <td id="maps"><a href=<?php echo '"https://www.google.com/maps/search/'.$users[ 'ADDRESS' ].' , '.$users[ 'LANDMARK' ].' , '.$users[ 'CITY' ].' , '.$users[ 'STATE' ].' , '.$users[ 'COUNTRY' ].' , '.$users[ 'PINCODE' ].'"'; ?> target="_blank"><img src="./images/googlemaps.png"></a></td>
		        <td><?php
		        	if($users[ 'order_status' ] === 'PENDING')
		        		echo '<font style="color:red; font-weight: 700;">'.$users[ 'order_status' ].'</font>';
		        	else
		        		echo '<font style="color:green; font-weight: 700;">'.$users[ 'order_status' ].'</font>';
		        ?></td>
		        <td>

		        	<?php if($users[ 'order_status' ] === 'PENDING')
		        		echo '<a href="updateStatus.php?order_id='.$users[ 'order_id' ].'">DELIEVERED</a>';
		        	else
		        		echo '<font style="color:green; font-weight: 700;">FULL FILLED</font>';

		        	?>
		        </td>
		      </tr>
	      	<?php } ?>
	    </tbody>
	  </table>
	</section>
	<!-- END OF USER(S) TABLE -->

</body>
</html><?php } } else { header('Location: .'); } ?>