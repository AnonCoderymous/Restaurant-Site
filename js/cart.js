const cart_area = document.querySelector('.main'),
cartItems = localStorage.getItem('Cart_Items');

// if localStorage is null
// or empty
if( cartItems === null || cartItems === '') {
	cart_area.innerHTML = `
		<center>
			<div class='cimg'>
				<img src='./images/empty_cart.png' alt='Empty Cart'/>
			</div>
			<div class='ctitle'>
				Your Cart is <span style='color:orangered'>Empty!</span>
			</div>
			<div class='ctxt'>
				Must add items to cart before you proceed to check out.
			</div>
			<div class='cbtn'>
				<a href='menu.php'><i class="fa-solid fa-bag-shopping"></i> return to shop</a>
			</div>
		</center>
	`;
}else{

	// if localStorage is not empty
	// check if XMLHttpRequest
	// is supported
	if(window.XMLHttpRequest) {

		const xhr = new XMLHttpRequest();
		xhr.open('GET', './php/cart_items.php?item_id='+cartItems, true);
		xhr.send(null);

		xhr.onprogress = () => {
			let fetchedData = JSON.parse(xhr.response),
			left = document.querySelector('.left'),
			right = document.querySelector('.right'),
			total = 0,
			sno=1,
			html = '';

			html = `
				<table>
				  <tr>
				  	<th>Sno</th>
				    <th>Image</th>
				    <th>Name</th>
				    <th>Price</th>
				    <th>Quantity</th>
				    <th>Remove</th>
				  </tr>
			`;

			Object.values(fetchedData).map(item => {
				total += parseInt(item.item_price);
				html += `
					<tr>
						<td>${sno}</td>
					    <td><img src='./products/${item.item_img}' /></td>
					    <td>${item.item_name}</td>
						<td>${item.item_price}</td>
						<td class='qtyArea'>
							<button class='decreaseQuantity' name='${item.item_name}' id='${item.item_id}' disabled='true'>-</button>
							<input type='text' value=1 />
							<button class='increaseQuantity' name='${item.item_name}' id='${item.item_id}'>+</button>
						</td>
						<td class='removeButton' title='Remove Item'><button onclick='removeItem(${item.item_id})'><i class="fa-solid fa-circle-xmark"></i></button></td>						
					</tr>
				`;
				sno++;
			});



			html += `</table>`;
			left.innerHTML = html;
			right.innerHTML = `
				<div class='totalArea'>
					<h3>Order Summary</h3>
					<hr>
					<div class='subttarea'>
						<div class='txt'>Subtotal</div>
						<div class='amt'>&#x20B9; ${total}</div>
					</div>
					<hr>
					<div class='otherCosts'>
						<div class='coststxt'>Free shipping <input type=radio checked /></div>
						<div class='coststxt'>Flat rate: &#x20B9;10.00 <input type=radio disabled /></div>
						<div class='coststxt'>Pick up: &#x20B9;20.00 <input type=radio disabled /></div>
						<div class='coststxtn'>Shipping options will be updated during checkout.</div>
						<div class='clcshipping'>Calculate shipping</div>
					</div>
					<hr>
					<div class='cart_tt'>
						<div class='tttxt'>Total</div>
						<div class='ttamt'>&#x20B9;${total}</div>
					</div>
					<div class='anchor'>
						<a href='checkout.php'>Proceed to checkout</a>
					</div>
				</div>
			`;
			localStorage.setItem('Cart_Total', total);

			const iquantitybtns = document.querySelectorAll('.increaseQuantity');
			let citem = {};
			for(let i=0; i<iquantitybtns.length; i++) {
				iquantitybtns[i].onclick = () => {
					window.alert('Sorry, due to shortage of stock quantity of each unit(s) can\'t be more than 1.');
				}
			}
		}

		// if error occured
		// due to invalid url or network down
		xhr.onerror = () => {
			console.log('Network down. Please check your connection.');
		}

	}
}

// when remove item button is clicked
function removeItem(item_id) {
	let splitted_items = cartItems.split(',');
	if(splitted_items.includes(item_id.toString())){
		if(splitted_items.length <= 1) {
			localStorage.removeItem('Cart_Items');
			localStorage.removeItem('Cart_Total');
		}else{
			let index = splitted_items.indexOf(item_id.toString());
			splitted_items.splice(index, 1);
			localStorage.setItem('Cart_Items', splitted_items);
		}
	}
	window.location.reload();
}