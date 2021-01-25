<?php

	if (isset($_POST['hive_id']) && isset($_POST['temperature_value'])) {
		require_once('database_files/database_connection.php');
		require('database_files/database_queries.php');
		
		$hive_id = $_POST['hive_id'];
		$temperature_value = $_POST['temperature_value'];
		
		$date_calculation = date("Y-m-d H:i:s");
		$date_time = new DateTime($date_calculation);
		$date_value = $date_time->format("Y-m-d");
		$time_value = $date_time->setTime($date_time->format("H"), $date_time->format("i"), $date_time->format("s"))->format('H:i:s');
				
		$date_value = $date_value . " " . $time_value;
				
		
		record_temperature($hive_id, $temperature_value, $date_value);
	}

?>
