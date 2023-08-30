// menu page logic
const form = document.forms.searchForm,
searchInput = document.querySelector('.search'),
p_desc = document.querySelector('.p_desc'),
addToCartButtons = document.querySelectorAll('.add_cart_item'),
removeFromCartButtons = document.querySelectorAll('.remove_cart_item'),
quantityArea = document.querySelector('#qty'),
quantityLi = document.querySelector('body > nav > div.navigations > ul > li:nth-child(4)'),
quantityTxt = document.querySelector('body > nav > div.navigations > ul > li:nth-child(3) > a'),
searchIcon = document.querySelector('.fa-magnifying-glass');
let cartItem = localStorage.getItem('Cart_Items'),
cartItemArray = [];

// reduce the space
// of quantity area
quantityLi.style.display = 'none';

// display cart quantity
if(cartItem !== null) {
	let items = cartItem.split(',');
	quantityArea.innerText = items.length;
	quantityArea.style.display = 'block';
	quantityArea.style.visibility = 'visible';
	quantityTxt.classList.toggle('focused');
	quantityLi.style.display = 'block';
}

// don't submit form
form.onsubmit = function() {
	return false;
}

// hide search icon when input is focused
form.addEventListener('focusin', function() {
	searchIcon.style.transition = '0.4s ease-out';
	searchIcon.style.display = 'none';
  	searchIcon.style.visibility = 'hidden';
});

// if focused out, show the search icon
form.addEventListener('focusout', function() {
	searchIcon.style.transition = '0.4s ease-out';
	searchIcon.style.display = 'block';
	searchIcon.style.visibility = 'visible';
});

// disable cart Button
function disableCartButton(btn) {
	btn.innerHTML = 'Added to Cart &check;';
	btn.classList.add('addedBtn');
	btn.setAttribute('disabled', 'true');
}

// show remove cart button
function showRemoveCartBtn(btn) {
	btn.style.display = 'block';
	btn.style.visibility = 'visible';
}

// function reverse
function removeItemBtn(showbtn, removebtn) {
	showbtn.innerText = 'Add to Cart';
	showbtn.classList.remove('addedBtn');
	removebtn.style.display = 'none';
	removebtn.style.visibility = 'hidden';
}

// when user clicks on
// Add To Cart button
for( let i=0; i<addToCartButtons.length; i++ ) {
	addToCartButtons[i].onclick = function() {
		if(cartItem === null || cartItem.length <= 0) {
			disableCartButton(addToCartButtons[i]);
			showRemoveCartBtn(removeFromCartButtons[i]);
			cartItemArray.push(addToCartButtons[i].id);
		}else{
			disableCartButton(addToCartButtons[i]);
			showRemoveCartBtn(removeFromCartButtons[i]);
			cartItemArray = cartItem.split(',');
			cartItemArray.push(addToCartButtons[i].id);
		}

		localStorage.setItem('Cart_Items', cartItemArray);

		quantityArea.innerText = cartItemArray.length;
		quantityArea.style.display = 'block';
		quantityArea.style.visibility = 'visible';
		if(quantityTxt.classList.contains('focused')===false){
			quantityTxt.classList.toggle('focused');
		}
		quantityLi.style.display = 'block';
	}
}

// when user clicks
// remove item button
for( let r=0; r<removeFromCartButtons.length; r++ ) {
	removeFromCartButtons[r].onclick = function() {
		let c_items = localStorage.getItem('Cart_Items');
		if(c_items.includes(',') === true){
			c_items = c_items.split(',');
			if(c_items.includes(removeFromCartButtons[r].id)) {
				let index = c_items.indexOf(removeFromCartButtons[r].id);
				c_items.splice(index, 1);
				cartItemArray.splice(index, 1);
				localStorage.setItem('Cart_Items', c_items);
				removeItemBtn(addToCartButtons[r], removeFromCartButtons[r]);
			}
		}else{
			localStorage.removeItem('Cart_Items');
			removeItemBtn(addToCartButtons[r], removeFromCartButtons[r]);
			quantityArea.style.display = 'none';
			quantityArea.style.visibility = 'hidden';
		}

		quantityArea.innerText = c_items.length;
		c_items = '';
		window.location = window.location;
	}
}

// iterate through cartItem array
// and disable buttons
if(cartItem !== null) {
	let splitted_items = cartItem.split(',');

	for(let j=0; j<addToCartButtons.length; j++) {
		for(let m=0; m<splitted_items.length; m++) {
			if((splitted_items[m] === addToCartButtons[j].id) === true) {
				disableCartButton(addToCartButtons[j]);
				showRemoveCartBtn(removeFromCartButtons[j]);
			}
		}
	}
}

// search products
searchInput.addEventListener('keyup', function(){

	// if empty value in input
	if(searchInput.value == '') {
		return;
	}

	// form data
	let formData = new FormData(document.forms.searchForm);

	// if XMLHttpRequest Supported
	if(window.XMLHttpRequest) {
		let xhr = new XMLHttpRequest();
		xhr.open('GET', './php/showItems.php?search='+searchInput.value);
		xhr.send(null);

		xhr.onload = function() {
			console.log(xhr.response);
		}
	}
});