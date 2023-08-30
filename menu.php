<?php
	include './php/header.php';
	include './php/config.php';

	// query to fetch
	// all products
	// from database
	$query = 'SELECT item_id, item_name, item_description, item_price, item_img FROM `items`';

	// execute query
	$execquery = mysqli_query($conn, $query);
?>

<body>
	<!-- Scroll Top Button -->
	<div class="scroll_btn">TOP &uarr;</div>

	<!-- Navigation Bar -->
	<nav class="navbar fixed">
		<div class="icon">
			<img src="./images/favicon.jpg" alt="Icon">
			<div class="pagettl">menu</div>
		</div>
		<div class="navigations">
			<ul>
				<li>
					<form id="searchForm">
						<input type="text" name="search" class="search" placeholder="Search Item...">
					</form>
					<i class="fa-solid fa-magnifying-glass"></i>
				</li>
				<li><a href=".">home</a></li>
				<li><a href="cart.php">cart</a></li>
				<li><span id="qty">1</span></li>
				<li><a href="auth.php?opr=signup" class="btns">sign up</a></li>
				<li><a href="auth.php?opr=login" class="btns">login</a></li>
			</ul>
		</div>
		</div>
	</nav>

	<!-- Display Products -->
	<section class="products">
		<div class="product_area">
			<ul><?php echo PHP_EOL;
				while($results = mysqli_fetch_assoc($execquery)) { ?>
				<li>
					<div class="p_area">
						<div class="p_img"><?php echo "<img src='./products/".$results[ 'item_img' ]."' />"; ?></div>
						<div class="p_name"><?php echo $results[ 'item_name' ]; ?></div>
						<div class="p_price">&#x20B9; <?php echo $results[ 'item_price' ]; ?></div>
						<div class="p_ratings">
							Ratings: 
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star-half-stroke"></i>
						</div>
						<div class="p_desc"><?php echo $results[ 'item_description' ]; ?></div>
						<div class="btn_area">
							<div class="add_cart_item" id=<?php echo '"'.$results[ 'item_id' ].'"'; ?>>Add to Cart
							</div>
							<div class="remove_cart_item" id=<?php echo '"'.$results[ 'item_id' ].'"'; ?>>Remove</div>
						</div>
					</div>
				</li>
<?php } ?>
			</ul>
		</div>
	</section>

	<!-- Script File(s) -->
	<script type="text/javascript" src="./js/index.js" defer></script>
	<script type="text/javascript" src="./js/menu.js" defer></script>
</body>