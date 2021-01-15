<?php

	ini_set('max_execution_time', 300);

	require_once('database_files/database_connection.php');
	require('database_files/database_queries.php');
	
	// Get the temperature values for the bee hives (ids 1-6)
	$temperature_values = get_temperature_values();
	
	// Stores the hive ids that have recorded values.
	$hive_id = array();
	
	// Store the hive ids that have recorded values in the past 24 hours.
	foreach ($temperature_values as $values) :
		if (!in_array($values['hive_id'], $hive_id)) {
			$hive_id[] = $values['hive_id'];
		}
	endforeach;
	
	sort($hive_id);
	
	// Get the outside temperature values stored in the database.
	$outside_temperature_values = get_outside_temperature_values();
	
	// Store the unique dates and hours for the records in the past 24 hours.
	// (e.g. 10th day 12th hour, 11th day 2nd hour, etc.)
	$controller_array = array();
	foreach ($outside_temperature_values as $values) :
			$date_value = strtotime($values['date']);
			$date_final = date('d', $date_value);
			$hour_final = date('H', $date_value);
				
			$date_array = array($date_final, $hour_final);
				
			if(!in_array($date_array, $controller_array)) {
				$controller_array[] = $date_array;
			}
	endforeach;
	
	// Array to store the date, hour, and average temperature for the hour (Outside temperatures).
	$outside_temperature_array = array();
	
	for ($e = 0; $e < count($controller_array); $e++) {
			$counter = 0;
			$average = 0;
			$date_final_store;
			$hour_final_store;
			foreach ($outside_temperature_values as $values) :
				$date_value = strtotime($values['date']);
				$date_final = date('d', $date_value);
				$hour_final = date('H', $date_value);
				if($controller_array[$e][0] == $date_final && $controller_array[$e][1] == $hour_final) {
					$average += $values['Temperature_value'];
					$date_final_store = $date_final;
					$hour_final_store = $hour_final;
					$counter++;
				}
			endforeach;
			
			$average = ($average / $counter);
			$temp_array = array($date_final_store, $hour_final_store, $average);
			$outside_temperature_array[] = $temp_array;
			
	}

?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
<style>
#hive_temperature {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#hive_temperature td, #hive_temperature th {
  border: 1px solid #ddd;
  padding: 8px;
}

#hive_temperature tr:nth-child(even){background-color: #f2f2f2;}

#hive_temperature tr:hover {background-color: #ddd;}

#hive_temperature th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body style="font-family: 'ABeeZee', sans-serif;">
	
	<div style="font-size:75px; text-align:center; margin-bottom:50px;"><?php echo date("D, M, Y h:i"); ?></div>
	
	<img src="images/hive_image_total/hive_image_total.jpg" style="width:100%; border:2px solid black">
	
	<br><br>
	
	<h3>Reference Table</h3>
	<table id="hive_temperature" style="width:200px; background:white;">
		<tr>
			<th>Hour</th>
		</tr>
		<tr>
			<td>In-Hive Temperature</td>
		</tr>
		<tr>
			<td>Outside Temperature</td>
		</tr>
		<tr style="border-top:2px solid black;">
			<td>Temperature Difference</td>
		</tr>
	</table>
	
	<br>


<?php

	// Display the temperature averages for each hive that has records in the database.
	for ($i = 0; $i < count($hive_id); $i++) {
		
		// Display the name of the hive.
		echo "<h3>Hive " . ($hive_id[$i]) . "</h3>";
		
		// Display the table of temperature values for the hive.
		echo "<table id='hive_temperature' style='background:white;'>";
		echo "<tr>";
		
		$controller_array = array();
		
		// Check each temperature record for the current hive id.
		foreach ($temperature_values as $values) :
		
			// Check for the current hive id.
			if ($values['hive_id'] == $hive_id[$i]) {
				
				$date_value = strtotime($values['date']);
				$date_final = date('d', $date_value);	// Get the date of the record.
				$hour_final = date('H', $date_value);	// Get the time of the record (hour).
				
				// Add the date and time to the date array.
				$date_array = array($date_final, $hour_final);
				
				// Check if the date and time value has already been added to the array.
				// TO DO: REMOVE "0" BEFORE SINGLE DIGIT HOUR VALUES.
				if(!in_array($date_array, $controller_array)) {
					if ($hour_final > 12) {
						echo "<th>" . ltrim(($hour_final - 12), '0') . "</th>";	// Display the hour value.
					} else if ($hour_final == 0) {
						echo "<th>12</th>";	// Display the hour value.
					} else {
						echo "<th>" . ltrim($hour_final, '0') . "</th>";	// Display the hour value.
					}
					
					$controller_array[] = $date_array;	// Add the date and time values to the controller array.
				}
				
			}
		endforeach;
		echo "</tr>";
		
		$average_difference_array = array();
		
		echo "<tr>";
		for ($e = 0; $e < count($controller_array); $e++) {
			
			$counter = 0;	// Count the number of temperature records recorded.
			$average = 0;	// Store the average for the selected hour.
			
			foreach ($temperature_values as $values) :
			
				// There can only be six possible temperature records per hour (There can be less than six).
				if ($counter < 6) {
					$date_value = strtotime($values['date']);
					$date_final = date('d', $date_value);	// Store the date.
					$hour_final = date('H', $date_value);	// Store the time.
					
					// Check to see if the current temperature record has the same date, time, and hive value as the comparison value
					// in the controller array.
					if($controller_array[$e][0] == $date_final && $controller_array[$e][1] == $hour_final && $hive_id[$i] == $values['hive_id']) {
						$average += $values['Temperature_value'];	// Add the temperature value to the average for the selected hour.
						$counter++;	// Increase the counter by one.
					}
				}
			endforeach;
			
			$average = ($average / $counter);	// Store the average temperature for the hour.
			$average_difference_array[] = $average;
			
			echo "<td>" . substr($average, 0, 5)  . "</td>";	// Display the temperature average for the hour.
			
		}
		
		echo "</tr>";
		
		$difference_array = array();
		
		echo "<tr>";
		$counter = 0;
		foreach ($outside_temperature_array as $outside_temperature) :
			
			$comparison_temperature_array = array($outside_temperature[0], $outside_temperature[1]);
			if (in_array($comparison_temperature_array, $controller_array)) {
				echo "<td>" . substr($outside_temperature[2], 0, 5)  . "</td>";
				$difference_array[] = substr(($average_difference_array[$counter] - $outside_temperature[2]), 0, 5);
				$counter++;
			}
			
		endforeach;
		echo "</tr>";
		
		
		echo "<tr>";
		foreach ($difference_array as $temperature_average) :
			echo "<td style='border-top:2px solid black'>" . $temperature_average  . "</td>";
		endforeach;
		echo "</tr>";
		
		
		echo "</table>";
		
		echo "<br>";
	}

?>


</body>
</html>
