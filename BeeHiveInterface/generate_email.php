<?php

	require_once('database_files/database_connection.php');	// Connection file.
	require('database_files/database_queries.php');	// Database queries file.
	require('phpmailer/src/PHPMailer.php');	// Send email file.
	require('phpmailer/src/Exception.php');
	require('phpmailer/src/SMTP.php');
	
	use PHPMailer\PHPMailer\PHPMailer;
	
	
	
	

	ini_set('max_execution_time', 300);	// Increase execution time for the file.
	
	$image_locations = array();
	$TOTAL_IMAGES = 0;
	
	$path = "images/hive_image_total/";
 
	if ($dir = opendir($path)) {
 
    	while (false !== ($entry = readdir($dir))) {
        	$files[] = $entry;
    	}
    	$images = preg_grep('/\.jpg$/i', $files);
			foreach($images as $image) {
      			$image_locations[] = $path . $image;
		  		$TOTAL_IMAGES++;
    	}
    	closedir($dir);
	}
	
	$total_emails = count(get_email_total()); // Give the day of the email message (E.g. Day 1).
	
	// Get the temperature values for the bee hives (ids 1-6)
	$temperature_values = get_hive_ids();
	
	// Stores the hive ids that have recorded values.
	$hive_id = array();
	
	// Store the hive ids that have recorded values in the past 24 hours.
	foreach ($temperature_values as $values) :
		$hive_id[] = $values['hive_id'];
	endforeach;
	
	// Sort hive id array to display hive information in order.
	sort($hive_id);

?>

<?php
$email_body = "<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css2?family=ABeeZee&display=swap' rel='stylesheet'>
<style>
#hive_temperature {
  font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
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
</style>";
	
	$email_body .=  "</head><body style='font-family: 'ABeeZee', sans-serif;'>";
	
	$email_body .=  "<div style='font-size:40px; text-align:center;'>" . date("D, d M, Y h:i") . "</div>";
	
	$email_body .=  "<div style='font-size:30px; text-align:center; margin-bottom:50px;'>Day: " . ($total_emails + 1) . "</div>";
	
	$email_body .=  "<h3>Reference Table</h3>";
	$email_body .=  "<table id='hive_temperature' style='width:200px; background:white;'>";
	$email_body .=  "<tr><th>Hour</th></tr>";
	$email_body .=  "<tr><td>In-Hive Temperature</td></tr>";
	$email_body .=  "<tr><td>Outside Temperature</td></tr>";
	$email_body .=  "<tr style='border-top:2px solid black;'><td>Temperature Difference</td></tr>";
	$email_body .=  "</table><br>";
	
	$email_body .= "<br>";
	
	$email_body .=  "<table id='hive_temperature' style='width:50%; background:white;'>";
	$email_body .=  "<tr><th>Color Reference</th></tr>";
	$email_body .=  "<tr><td><span style='color:orange;'>Orange:</span> Temperature Over 95 Degrees (In-Hive Only)</td></tr>";
	$email_body .=  "<tr><td><span style='color:green;'>Green:</span> In-Hive Temperature within +/- 10 Degrees of Outside Temperature</td></tr>";
	$email_body .=  "<tr><td><span style='color:red;'>Red:</span> In-Hive Temperature outside +/- 10 Degrees of Outside Temperature</td></tr>";
	$email_body .=  "</table><br>";
	
	$email_body .= "<br>";
	$email_body .= "<br>";



	// Display the temperature averages for each hive that has records in the database.
	foreach ($hive_id as $hive_values) :
		
		// Display the name of the hive.
		$email_body .=  "<h3>Hive " . ($hive_values) . "</h3>";
		
		// Get the temperature values for the selected hive.
		$hive_temperature_values = get_temperature_averages_by_hive($hive_values);
		
		// Display the table of temperature values for the hive.
		$email_body .=  "<table id='hive_temperature'>";
		$email_body .=  "<tr>";
		
		// Check each temperature record for the current hive id.
		foreach ($hive_temperature_values as $values) :
				
				$date_value = strtotime($values['date']);
				$hour_final = date('H', $date_value);	// Store the time.
				
				if ($hour_final > 12) {
					$email_body .=  "<th>" . ltrim(($hour_final - 12), '0') . "</th>";	// Display the hour value.
				} else if ($hour_final == 0) {
					$email_body .=  "<th>12</th>";	// Display the hour value.
				} else {
					$email_body .=  "<th>" . ltrim($hour_final, '0') . "</th>";	// Display the hour value.
				}
				
		endforeach;
		$email_body .=  "</tr>";
		
		$email_body .=  "<tr style='text-align:center;'>";
		foreach ($hive_temperature_values as $values) :
		
			if ($values['average'] >= 95) {
				$email_body .=  "<td style='color:orange;'>" . substr($values['average'], 0, 5)  . "</td>";
			} else {
				$email_body .=  "<td>" . substr($values['average'], 0, 5)  . "</td>";
			}
		
		endforeach;
		$email_body .=  "</tr>";
		
		$email_body .=  "<tr style='text-align:center;'>";
		foreach ($hive_temperature_values as $values) :
		
			$date_value = strtotime($values['date']);
			$hour_final = date('H', $date_value);
		
			$outside_average = get_outside_temperature_average_by_hour($hour_final);
			$email_body .=  "<td>" . substr($outside_average[0][0], 0, 5)  . "</td>";
			
		endforeach;
		$email_body .=  "</tr>";
		
		$email_body .=  "<tr style='text-align:center; border-top:2px solid black;'>";
		foreach ($hive_temperature_values as $values) :
			$date_value = strtotime($values['date']);
			$hour_final = date('H', $date_value);
		
			$outside_temperature = get_outside_temperature_average_by_hour($hour_final);
			$difference = $values['average'] - $outside_temperature[0][0];
			
			if ($difference >= 10 || $difference <= -10) {
				$email_body .=  "<td style='color:red;'><b>" . substr($difference, 0, 5)  . "</b></td>";
			} else {
				$email_body .=  "<td style='color:green;'><b>" . substr($difference, 0, 5)  . "</b></td>";
			}
			
		endforeach;
		$email_body .=  "</tr>";
		
		
		$email_body .=  "</table>";
	endforeach;


$email_body .=  "</body>";
$email_body .=  "</html>";

// Display the email in text format.
// echo htmlspecialchars($email_body) . "<br>";

try {
$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "yourEmailAddress@email.com";
$mail->Password = "yourPassword";
$mail->SetFrom("yourEmailAddress@email.com");
$mail->Subject = "Beehive" . date("D, M, Y h:i") . " - Average Temperatures";
$mail->Body = $email_body;

for ($i = 0; $i < $TOTAL_IMAGES; $i++) {
	$mail->addAttachment($image_locations[$i]);
}

$mail->AddAddress("yourEmailAddress@email.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    
    $date = date("Y-m-d");
	$date_calculation = date("Y-m-d H:i:s", strtotime('-' . 20 . ' hour'));
	$date_time = new DateTime($date_calculation);
	$date_value = $date_time->format("Y-m-d");
	$time_value = $date_time->setTime($date_time->format("H"), 0, $date_time->format("s"))->format('H:i:s');
			
	$date_value = $date_value . " " . $time_value;
    
    
    record_email($date_value);
	
 }
} catch (Exception $exception) {
	echo $exception . "<br>";
}

?>
