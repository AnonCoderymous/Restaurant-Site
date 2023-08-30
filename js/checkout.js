// checkout form logic
const form = document.forms.checkoutForm,
checkoutButton = document.querySelector('#checkoutButton'),
formPopup = document.querySelector('.form-popup'),
successformPopup = document.querySelector('.success-form-popup'),
blurEffect = document.querySelectorAll('.blurEffect'),
inputFields = document.querySelectorAll('form input[type=text]');

// don't submit the form
form.addEventListener('click', (e) => {
	e.preventDefault();
	return false;
});

// function to show alert
// Pop-up
function showPopup(errorTitle, errorTxt, errorButtonTxt) {
	let title = formPopup.querySelector('h1'),
	text = formPopup.querySelector('p'),
	button = formPopup.querySelector('button');

	formPopup.style.display = 'block';
	formPopup.style.visibility = 'visible';
	for(let blur of blurEffect){
		blur.style.filter = 'blur(2px)';
	}

	title.innerText = errorTitle
	text.innerHTML = errorTxt;
	button.innerText = errorButtonTxt;
}

// close popup
function closePopup() {
	formPopup.style.display = 'none';
	formPopup.style.visibility = 'hidden';
	for(let blur of blurEffect){
		blur.style.filter = 'blur(0px)';
	}
}

// show success popup
function showSuccessPopup(successTitle, successTxt, successButtonTxt) {
	let title = successformPopup.querySelector('h1'),
	text = successformPopup.querySelector('p'),
	button = successformPopup.querySelector('button');

	successformPopup.style.display = 'block';
	successformPopup.style.visibility = 'visible';
	for(let blur of blurEffect){
		blur.style.filter = 'blur(2px)';
	}

	title.innerText = successTitle
	text.innerHTML = successTxt;
	button.innerText = successButtonTxt;
}

// close success popup
function closeSuccessPopup() {
	successformPopup.style.display = 'none';
	successformPopup.style.visibility = 'hidden';
	for(let blur of blurEffect){
		blur.style.filter = 'blur(0px)';
	}
	window.location = '.';
	localStorage.clear();
}

// when checkout button is clicked
// perform neccessary operations
checkoutButton.addEventListener('click', function() {
	for(let input of inputFields) {
		if(input.value === '') {
			showPopup(`Missing Fields.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter your <b>${input.getAttribute('error-tag').toUpperCase()}</b>.`, 'Okay');
			return;
		}else{
			if(input.name === 'fname' || input.name === 'lname') {
				if(containsNumbers(input.value) === true) {
					showPopup(`Invalid Name.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter a valid <b>${input.getAttribute('error-tag').toUpperCase()}</b>.`, 'Okay');
					return;
				}
			}

			if(input.name === 'email') {
				if(validateEmail(input.value) === false) {
					showPopup(`Invalid Email Address.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter a valid <b>${input.getAttribute('error-tag').toUpperCase()}</b>.`, 'Okay');
					return;
				}
			}

			if(input.name === 'address') {
				if(input.value.length < 15) {
					showPopup(`Address is too short.`, `<i class="fa-solid fa-circle-exclamation"></i> Please define your address properly in 15 characters.`, 'Okay');
					return;
				}
			}

			if(input.name === 'city') {
				if(containsNumbers(input.value) === true) {
					showPopup(`Invalid City.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter your valid city.`, 'Okay');
					return;
				}
			}

			if(input.name === 'pincode') {
				if(isNaN(input.value) === true || input.value.length < 6) {
					showPopup(`Invalid Pincode.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter a valid pincode.`, 'Okay');
					return;
				}
			}

			if(input.name === 'phone') {
				if(isNaN(input.value) === true || input.value.length !== 10) {
					showPopup(`Invalid Phone Number.`, `<i class="fa-solid fa-circle-exclamation"></i> Please enter phone number (without contry code [+91]).`, 'Okay');
					return;
				}
			}
		}

	}

	// if XMLHttpRequest API is Supported
	// send data to server
	if(window.XMLHttpRequest){

		// make a form data list
		let formData = new FormData(document.forms.checkoutForm),

		// fetch order details
		cartTotal = localStorage.getItem('Cart_Total'),
		cartItems = localStorage.getItem('Cart_Items');

		// append the order details
		// to the formData lists
		formData.append('carttt', cartTotal);
		formData.append('cartit', cartItems);

		// create XMLHttpRequest handler
		const xhr = new XMLHttpRequest();
		xhr.open('POST', './php/order.php', true);
		xhr.send(formData);

		// if request is successfull
		xhr.onload = () => {
			let server_response = JSON.parse(xhr.responseText);
			if(server_response[ 'success' ] === true && server_response[ 'auth' ] === true) {
				showSuccessPopup(server_response[ 'msg' ], `<i class="fa-solid fa-check"></i> Your order will arrive shortly.`, 'Okay');
				return;
			}else if(server_response[ 'success' ] === true && server_response[ 'auth' ] === false) {
				showSuccessPopup(server_response[ 'msg' ], `<i class="fa-solid fa-check"></i> Your order will arrive shortly. It seems you are not registered to website, please register to track your order and experience an easier way while ordering.`, 'Okay');
				return;	
			}else{
				showPopup(`An error occurred.`, `Please check your network connectivity or try again after few minutes`, `Okay`);
				return;
			}
		}

		// if network is down
		// or if invalid URL
		xhr.onerror = () => {
			console.log('Network down, please try again later.');
		}


	}else{
		window.alert('[!] XMLHttpRequest is not supported in your browser.');
	}

});