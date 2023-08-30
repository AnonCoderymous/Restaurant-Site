<?php
	if(isset($_SERVER[ 'REQUEST_METHOD' ]) 
	&& ($_SERVER[ 'REQUEST_METHOD' ] === strtoupper('get')) === true) {
		include './php/header.php';
?>

<body>
	<!-- Scroll Top Button -->
	<div class="scroll_btn">TOP &uarr;</div>

	<!-- Navigation Bar -->
	<nav class="navbar">
		<div class="icon cout">
			<img src="./images/favicon.jpg" alt="Icon">
			<div class="pagettl">check out</div>
		</div>
		<div class="navigations">
			<ul>
				<li><a href=".">home</a></li>
				<li><a href="menu.php">menu</a></li>
				<li><a href="feedback.php">feedback</a></li>
			</ul>
		</div>
		</div>
	</nav>

	<section class="main">
		<div class="left">
			
		</div>
		<div class="right">
			
		</div>
	</section>

	<script type="text/javascript" src="./js/index.js" defer></script>
	<script type="text/javascript" src="./js/cart.js" defer></script>
</body>
</html><?php } ?>