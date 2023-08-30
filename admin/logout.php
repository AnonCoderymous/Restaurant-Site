<?php
// start a session
session_start();

// check if session exists
if(isset($_SESSION[ 'auth' ])) {

	// unset session
	session_unset();

	// destroy session
	session_destroy();
}

	// redirect to login panel
	header('Location: .');

?>