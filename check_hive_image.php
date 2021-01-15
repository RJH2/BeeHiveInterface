<?php

	// Process the request.
	// Get the name of the hive that is requesting the information.
	if (isset($_GET['hive_name'])) {
	
		// Based on the hive name, determine if the image cooresponding to the hive name is on the server.
		$hive_name = $_GET['hive_name'];
		
		// Check to see if the image for the selected hive exists on the server.
		if (file_exists('images/' . $hive_name . '.jpg')) {
			echo "yes";	// Confirm that the image is on the server.	
		} else {
			echo "no"; // Inform that the image is not on the server. - This will have the calling file execute the generate image
					   //												file on the hive device to send the image again.
		}
	}

?>