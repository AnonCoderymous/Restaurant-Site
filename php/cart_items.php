<?php
	if($_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset($_GET[ 'item_id' ])) {

		// include the connection file;
		include 'config.php';

		// sanitize the item_id value
		$items_id = mysqli_real_escape_string($conn, $_GET[ 'item_id' ]);

		// empty products array
		$products = array();

		// sql_query
		$query = 'SELECT * FROM `items` WHERE item_id=';

		$items_id = explode(',', $_GET[ 'item_id' ]);

		// loop through each item_id
		// and append data to array		
		foreach ($items_id as $item_id ) {
			$item_query = $query.$item_id;
			$result = mysqli_query($conn, $item_query);
			$rows = mysqli_num_rows($result);
			if( $rows < 1 ){
				$products[ $item_id ] = 'Invalid Product.';
			}else{
				$data = mysqli_fetch_assoc($result);
				$products[ $item_id ] = array(
					'item_id' => $data[ 'item_id' ],
					'item_img' => $data[ 'item_img' ],
					'item_name' => $data[ 'item_name' ],
					'item_price' => $data[ 'item_price' ]
				);
			}
		}

		echo(json_encode($products));

		mysqli_close($conn);
	}
?>