// the home page logic
const scroll_top_button = document.querySelector('.scroll_btn');

// scroll button function
window.onscroll = function(){
	let limit = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	if(window.pageYOffset !== limit) {
		scroll_top_button.style.display = 'none';
		scroll_top_button.style.visibility = 'hidden';
	}else{
		scroll_top_button.style.display = 'block';
		scroll_top_button.style.visibility = 'visible';
	}
}
scroll_top_button.onclick = function() {
	document.body.scrollTop = document.documentElement.scrollTop = 0;
}