// if string contains number
function containsNumbers(str) {
	var numberFormat = /[0-9]/;
	return numberFormat.test(str);
}

// if email is valid
function validateEmail(email) {
	var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	return mailFormat.test(email);
}