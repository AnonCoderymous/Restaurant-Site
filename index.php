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
		<div class="icon">
			<img src="./images/favicon.jpg" alt="Icon">
		</div>
		<div class="navigations">
			<ul>
				<li><a href=".">home</a></li>
				<li><a href="#about">about</a></li>
				<li><a href="menu.php">menu</a></li>
				<li><a href="feedback.php">feedback</a></li>
				<li><a href="auth.php?opr=signup" class="btns">sign up</a></li>
				<li><a href="auth.php?opr=login" class="btns">login</a></li>
			</ul>
		</div>
		</div>
	</nav>

	<!-- BANNER SECTION -->
	<section class="banner">

		<!-- Background Image -->
		<div class="bg_img"></div>
		<div class="bg_txt">
			<div class="t1">
				<div class="line"></div>
				<div class="t1_txt">Hello, new Friend!</div>
			</div>
			<div class="t2">
				<div class="t2_txt_1"><h1>Welcome Back</h1></div>
				<div class="t2_txt_2"><h1>to Tasty</h1></div>
			</div>
			<div class="t3">
				<div class="t3_txt">
					Are your Hungry?
					Order your favourite foods now, 
					<br/>
					and get delivered within minutes.
				</div>
			</div>
			<div class="t4">
				<a href="#" class="orders">Order Now</a>
				<a href="menu.php" class="menu">Open Menu</a>
			</div>
		</div>
	</section>

	<!-- Middle Banner Section -->
	<section class="mdl_banners">
		<div class="mdl_main_div">
			<div class="left_div">
				<div class="img_section">
					<img src="./images/mdl_banner.jpeg" alt="Pizza Logo">
					<div class="img_cover">
						<h1>specially made</h1>
						<h1>pizza</h1>
						<h1 class="tinny">freshly baked</h1>
						<button>fresh & tasty</button>
					</div>
				</div>
			</div>
			<div class="right_div">
				<div class="top_div">
					<div class="img_section">
						<img src="./images/mdl_banner2.jpeg" alt="French Fries Logo">
						<div class="img_cover">
							<h1>quality</h1>
							<h1>potato</h1>
							<h1>fries</h1>
							<h3 style="margin-left: 10px;">delicious</h3>
						</div>
					</div>
					<div class="img_section">
						<img src="./images/mdl_banner3.jpeg" alt="French Fries Logo">
						<div class="img_cover">
							<h1 style="color: yellow;">soft drinks</h1>
							<h1 style="color: black;">chilled</h1>
						</div>
					</div>
				</div>
				<div class="bottom_div">
					<div class="img_section">
						<img src="./images/mdl_banner4.jpeg" alt="Garlic Mushroom Logo">
						<div class="img_cover bottom" style="color: black;">
							<h1>garlic</h1>
							<h1>mushroom</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Bottom Banner Section -->
	<section class="bottom_banners">
		<div class="banner_area">
			<div class="img">
				<img src="./products/chicken_fried_rice.jpg" alt="Chicken Fried Rice">
			</div>
			<div class="img">
				<img src="./products/chicken_pizza.jpg" alt="Chicken Pizza">
			</div>
			<div class="img">
				<img src="./products/chicken_gravy.jpg" alt="Chicken Gravy">
			</div>
		</div>
		<div class="img_txt">
			<h1>Dishes made with fresh ingredients</h1>
			<h1>FRESHLY BAKED</h1>
			<button>View Menu</button>
		</div>
	</section>

	<!-- Bottom Banner -->
	<section class="features">
		<div class="features_area">
			<div class="feature">
				<div class="f_img">
					<img src="./images/quality.png">
				</div>
				<div class="f_tt">
					Best Quality
				</div>
				<div class="f_txt">
					We only use fresh carefully <br/>selected ingredients.
				</div>
			</div>
			<div class="feature">
				<div class="f_img">
					<img src="./images/clock.png">
				</div>
				<div class="f_tt">
					On Time
				</div>
				<div class="f_txt">
					When we deliver we do our <br/> outmost to be ontime.
				</div>
			</div>
			<div class="feature">
				<div class="f_img">
					<img src="./images/chef.png">
				</div>
				<div class="f_tt">
					Pizza Chef
				</div>
				<div class="f_txt">
					We are not a chain. Your food <br/> is made by a real chef.
				</div>
			</div>
			<div class="feature">
				<div class="f_img">
					<img src="./images/dish.png">
				</div>
				<div class="f_tt">
					Taste our Food
				</div>
				<div class="f_txt">
					We take great pride in quality <br/> and taste of our food.
				</div>
			</div>
		</div>
	</section>

	<!-- Bottom Images -->
	<section class="b_images_area">
		<div class="b_img_sec">
			<img src="https://source.unsplash.com/500x500/?pizza">
		</div>
		<div class="b_img_sec">
			<img src="./images/footerimg6.jpg">
		</div>
		<div class="b_img_sec">
			<img src="./images/footerimg1.jpg">
		</div>
		<div class="b_img_sec">
			<img src="./products/chicken_gravy.jpg">
		</div>
		<div class="b_img_sec">
			<img src="./images/footerimg4.jpg">
		</div>
	</section>

	<!-- Footer -->
	<section class="footer">
		<div class="navigation">
			<ul>
				<li><a href="index.php">home</a></li>
				<li><a href="index.php">order</a></li>
				<li><a href="index.php">menu</a></li>
				<li><a href="index.php">contact</a></li>
				<li><a href="index.php">About</a></li>
				<li><a href="index.php">FAQ</a></li>
				<li><a href="index.php">Terms and Conditions</a></li>
			</ul>
		</div>
		<div class="favicon">
			<img src="./images/favicon.jpg" alt="Favicon">
		</div>
		<div class="info">
			<ul>
				<li>ABC Restaurants</li>
				<li>Mumbai, Maharashtra</li>
				<li>Telephone: +91 7756983995</li>
			</ul>
		</div>
		<div class="copyright">
			Copyright © <script type="text/javascript">document.write(new Date().getFullYear())</script> FoodSites[.]com. All rights reserved.
		</div>
	</section>

	<!-- Script File -->
	<script type="text/javascript" src="./js/index.js" defer></script>

</body>
</html><?php } ?>