// admin-profile logic
// to handle basic operations
const changePassHref = document.querySelector('.href div'),
passArea = document.querySelector('.passArea'),
hiddenInputs = document.querySelectorAll('input[type=hidden]');

// when user clicks
// change password button
changePassHref.addEventListener('click', function(){
	for(let input of hiddenInputs){
		input.type = 'password';
		changePassHref.style.display = 'none';
		changePassHref.style.visibility = 'hidden';
		passArea.style.display = 'block';
		passArea.querySelector('.label label').innerText = 'Password';
		hiddenInputs[0].setAttribute('name', 'apass');
		hiddenInputs[1].setAttribute('name', 'anewpass');
	}
});