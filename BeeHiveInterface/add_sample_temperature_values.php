<?php

	require_once('database_files/database_connection.php');
	require('database_files/database_queries.php');
	
	delete_temperature_values_test();
	
	$temperature_array = array(100.123, 80.13, 70.14, 90.10, 60.400, 110, 80, 30, 55, 97, 105, 80);
	
	for ($i = 0; $i < 7; $i++) { 
		for ($y = 0; $y < 24; $y++) {
			for ($o = 0; $o < 6; $o++) {
				
				$date = date("Y-m-d");
				$date_calculation = date("Y-m-d H:i:s", strtotime('-' . (24 - $y) . ' hour'));
				$date_time = new DateTime($date_calculation);
				$date_value = $date_time->format("Y-m-d");
				$time_value = $date_time->setTime($date_time->format("H"), ($o * 10), $date_time->format("s"))->format('H:i:s');
				$location_value = rand(0, count($temperature_array) - 1);
				$temperature_value = $temperature_array[$location_value];
				
				$date_value = $date_value . " " . $time_value;
				
				record_temperature_test($i + 1, $temperature_value, $date_value);
			}
		}
	}
	
?>
