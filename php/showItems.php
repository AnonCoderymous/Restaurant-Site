<?php
	// if request method is POST
	if( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {

		// query variable
		$query = '';

		// error response
		$errorResponse = array('error' => false, 'msg' => '');

		// include connection file
		include 'config.php';

		// if item_id is set
		// show info of product
		// whose item_id is matched
		if( isset($_GET[ 'item_id' ]) && !empty($_GET[ 'item_id' ])) {

			// sanitize the item id from Sql Injection
			// and convert into integer
			$item_id = mysqli_real_escape_string($conn, intval($_GET[ 'item_id' ]));

			// get columns of particular item_id
			$query = 'SELECT * FROM `items` WHERE item_id='.$item_id;

			// execute query
			$execquery = mysqli_query($conn, $query);

			// check if item is present
			$rows = mysqli_num_rows($execquery);

			// if item is not present
			// show error response
			// and exit script
			if($rows <= 0) {
				$errorResponse[ 'error' ] = true;
				$errorResponse[ 'msg' ] = 'Product Not Found';
				echo(json_encode($errorResponse));
				exit;
			}

			// fetch results
			$results = mysqli_fetch_assoc($execquery);

			// show results
			echo(json_encode($results));

		} else if( isset($_GET[ 'search' ]) && !empty($_GET[ 'search' ])) { 	// if user is searching

			// sanitize search parameter
			$search = mysqli_real_escape_string($conn, $_GET[ 'search' ]);

			// searched products Info
			$searchArray = array();

			// incrementer
			$f=0;

			$query = "SELECT * FROM `items` WHERE item_name LIKE '%${search}%' OR item_type LIKE '%{$search}%' OR item_description LIKE '%{$search}%'";

			// execute query
			$execquery = mysqli_query($conn, $query);

			// fetch results
			$rows = mysqli_num_rows($execquery);

			// if products are found
			// append them to the array
			if( $rows !== 0 ) {
					while($results = mysqli_fetch_assoc($execquery)) {
						$searchArray[$f] = array(
							'item_id' => $results[ 'item_id' ],
							'item_type' => $results[ 'item_type' ],
							'item_tag' => $results[ 'item_tag' ],
							'item_name' => $results[ 'item_name' ],
							'item_qty' => $results[ 'item_qty' ],
							'item_price' => $results[ 'item_price' ],
							'item_description' => $results[ 'item_description' ],
							'item_img' => $results[ 'item_img' ]
						);
						$f++;
					}

				// show the results
				// of the search products array
				echo(json_encode($searchArray));

			} else {
				echo('No products found.');
			}

			// show results
			// echo(json_encode($results));

		} else {

			// products array
			// all products info
			// will be stored here
			$productsArray = array();

			$i=0;

			// if item_id is not set
			// show all products
			$query = 'SELECT * FROM `items`';

			// execute query
			$execquery = mysqli_query($conn, $query);

			// fetch results
			// and store into productsArray
			while($results = mysqli_fetch_assoc($execquery)) {
				$productsArray[$i] = array(
						'item_id' => $results[ 'item_id' ],
						'item_type' => $results[ 'item_type' ],
						'item_tag' => $results[ 'item_tag' ],
						'item_name' => $results[ 'item_name' ],
						'item_qty' => $results[ 'item_qty' ],
						'item_price' => $results[ 'item_price' ],
						'item_description' => $results[ 'item_description' ],
						'item_img' => $results[ 'item_img' ]
				);
				$i++;
			}

			echo(json_encode($productsArray));
		}

		mysqli_close($conn);

	} else {
		$errorResponse[ 'error' ] = true;
		$errorResponse[ 'msg' ] = 'Invalid Request Type';
		echo(json_encode($errorResponse));
	}

	exit;
?>