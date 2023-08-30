<?php
	session_start();
	if(isset($_SERVER[ 'REQUEST_METHOD' ]) 
	&& ($_SERVER[ 'REQUEST_METHOD' ] === strtoupper('get')) === true && !isset($_SESSION[ 'isAuth' ])) {
		include './php/header.php';
?>

<body>
	<!-- Scroll Top Button -->
	<div class="scroll_btn blurEffect">TOP &uarr;</div>

	<!-- Alert Popup -->
	<div class="form-popup">
		<div class="popup-area">
			<h1>Missing details.</h1>
			<p><i class="fa-solid fa-circle-exclamation"></i>
				Please enter your email address.
			</p>
			<button onclick="closePopup()">Okay</button>
		</div>
	</div>

	<!-- Success Popup -->
	<div class="success-form-popup">
		<div class="success-popup-area">
			<h1>Missing details.</h1>
			<p><i class="fa-solid fa-circle-exclamation"></i>
				Please enter your email address.
			</p>
			<button onclick="closeSuccessPopup()">Okay</button>
		</div>
	</div>

	<!-- Navigation Bar -->
	<nav class="navbar blurEffect">
		<div class="icon sdetail">
			<img src="./images/favicon.jpg" alt="Icon">
			<div class="pagettl">Shipping details</div>
		</div>
		<div class="navigations">
			<ul>
				<li><a href=".">home</a></li>
				<li><a href="cart.php">cart</a></li>
				<li><a href="feedback.php">feedback</a></li>
			</ul>
		</div>
		</div>
	</nav>

	<section class="detail blurEffect">
		<div class="details_area">
			<div class="form_area">
				<form name="checkoutForm" autocomplete="on">
					<div class="title">
						shipping details
					</div>
					<div class="inputsArea">
						<div class="name_flds">
							<div class="fname">
								<label for="fname">Firt Name</label>
								<input type="text" error-tag="first name" name="fname" placeholder="First Name" required="">
							</div>
							<div class="lname">
								<label for="lname">Last Name</label>
								<input type="text" error-tag="last name" name="lname" placeholder="Last Name" required="">
							</div>
						</div>
						<div class="inputEmail">
							<div class="emailLabelSpan">
								<label for="email">Email Address</label>
								<span>
									<input type="checkbox" name="emailUpdates" checked />
									Get Order updates on Whatsapp and Email
								</span>
							</div>
							<input type="text" error-tag="email" name="email" placeholder="Email Address" required="">
						</div>
						<label for="country">Country/Region</label>
						<input type="text" error-tag="country" name="country" placeholder="" value="India" readonly="" required="">
						<label for="streetaddress">Street Address</label>
						<input type="text" error-tag="address" name="address" placeholder="Building No. Apartment, Flat no." required="">
						<label for="landmark">Map Location (Landmark)</label>
						<input type="text" error-tag="landmark" name="landmark" placeholder="Near ABC Apartment, Opposite to MNC Building etc.." required="">
						<div class="cdetails">
							<div class="city">
								<label for="city">City</label>
								<input type="text" error-tag="city" name="city" placeholder="City" required="">
							</div>
							<div class="states">
								<label for="state">State</label>
								<select name="state">
									<?php
										$indianStates = [
										'MH' => 'Maharashtra',
										'AR' => 'Arunachal Pradesh',
										'AS' => 'Assam',
										'BR' => 'Bihar',
										'CT' => 'Chhattisgarh',
										'GA' => 'Goa',
										'GJ' => 'Gujarat',
										'HR' => 'Haryana',
										'HP' => 'Himachal Pradesh',
										'JK' => 'Jammu and Kashmir',
										'JH' => 'Jharkhand',
										'KA' => 'Karnataka',
										'KL' => 'Kerala',
										'MP' => 'Madhya Pradesh',
										'AR' => 'Arunachal Pradesh',
										'MN' => 'Manipur',
										'ML' => 'Meghalaya',
										'MZ' => 'Mizoram',
										'NL' => 'Nagaland',
										'OR' => 'Odisha',
										'PB' => 'Punjab',
										'RJ' => 'Rajasthan',
										'SK' => 'Sikkim',
										'TN' => 'Tamil Nadu',
										'TG' => 'Telangana',
										'TR' => 'Tripura',
										'UP' => 'Uttar Pradesh',
										'UT' => 'Uttarakhand',
										'WB' => 'West Bengal',
										'AN' => 'Andaman and Nicobar Islands',
										'CH' => 'Chandigarh',
										'DN' => 'Dadra and Nagar Haveli',
										'DD' => 'Daman and Diu',
										'LD' => 'Lakshadweep',
										'DL' => 'National Capital Territory of Delhi',
										'PY' => 'Puducherry'];
										foreach($indianStates as $abbr => $name)
											echo '<option value="'.$abbr.'">'.$name.'</option>';
									?>
								</select>
							</div>
							<div class="pin">
								<label for="pincode">Pincode</label>
								<input type="text" error-tag="pincode" name="pincode" placeholder="Pincode" required="">
							</div>
						</div>
						<label for="phonenumber">Phone Number</label>
						<input type="text" error-tag="phone number" name="phone" placeholder="Phone Number for order updates" required="">
						<input type="submit" id="checkoutButton" name="submitButton" value="Continue to shipping">
					</div>
				</form>
			</div>
		</div>
	</section>
	<script src="./js/functions.js"></script>
	<script src="./js/checkout.js"></script>
</body>
</html><?php } ?>