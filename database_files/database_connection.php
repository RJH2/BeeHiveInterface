<?php

	$dsn = 'mysql:host=localhost;dbname=beehive_database';
	$username = 'beeuser';
	$password = 'password';
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	try {
		$db = new PDO($dsn, $username, $password, $options);
	} catch (PDOEXCEPTION $e) {
		$error_message = $e->getMessage();
		echo $error_message . "<br>";
		exit();
	}


	function display_db_error() {
		echo $error_message . "<br>";
		exit;
	}

?>
