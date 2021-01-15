<?php

	// Purpose: Get the temperature averages (by hour) for the past 24 hours for the selected hive.
	function get_temperature_averages_by_hive($hive_id) {
		global $db;
    	$query = 'SELECT AVG(temperature_value) as average, date
				  FROM temperature_record 
				  WHERE hive_id = :hive_id AND date > DATE_ADD(NOW(), INTERVAL -24 HOUR)
				  GROUP BY HOUR(date)
				  ORDER BY temperature_id ASC';
    	try {
    	    $statement = $db->prepare($query);
			$statement->bindValue(':hive_id', $hive_id);
    	    $statement->execute();
    	    $result = $statement->fetchAll();
    	    $statement->closeCursor();
    	    return $result;
    	} catch (PDOException $e) {
    	    print($e->getMessage());
    	}
	}

	// Purpose: Get the average for the outside temperature for the selected hour.
	function get_outside_temperature_average_by_hour($hour) {
		
		global $db;
    	$query = 'SELECT AVG(temperature_value) as average FROM temperature_record WHERE hive_id = 7 AND HOUR(date) = :hour';
    	try {
    	    $statement = $db->prepare($query);
			$statement->bindValue(':hour', $hour);
    	    $statement->execute();
    	    $result = $statement->fetchAll();
    	    $statement->closeCursor();
    	    return $result;
    	} catch (PDOException $e) {
    	    print($e->getMessage());
    	}
	}

	// Purpose: Delete all temperature values in the database (Testing purposes).
	function delete_temperature_values_test() {
		global $db;
    	$query = 'DELETE FROM temperature_record';
    	try {
    	    $statement = $db->prepare($query);
    	    $statement->execute();
    	    $statement->closeCursor();
    	} catch (PDOException $e) {
    	    $error_message = $e->getMessage();
    	    echo $error_message;
			return false;
    	}
	}
	
	// Purpose: Record a new temperature value.
	function record_temperature_test($hive_id, $temperature_value, $date) {
		global $db;
    	$query = 'INSERT INTO temperature_record
                 (hive_id, temperature_value, date)
              VALUES
                 (:hive_id, :temperature_value, :date)';
    	try {
    	    $statement = $db->prepare($query);
			$statement->bindValue(':hive_id', $hive_id);
			$statement->bindValue(':temperature_value', $temperature_value);
			$statement->bindValue(':date', $date);
    	    $statement->execute();
			$result = $db->lastInsertId();
    	    $statement->closeCursor();
    	} catch (PDOException $e) {
    	    $error_message = $e->getMessage();
    	    echo $error_message;
			return false;
    	}
	}

	// Purpose: Record a temperature value for the selected hive.
	function record_temperature($hive_id, $temperature_value, $date_value) {
	global $db;
    		$query = 'INSERT INTO temperature_record
        	         (hive_id, temperature_value, date)
        	      VALUES
        	         (:hive_id, :temperature_value, :date)';
    		try {
    		    $statement = $db->prepare($query);
			$statement->bindValue(':hive_id', $hive_id);
			$statement->bindValue(':temperature_value', $temperature_value);
				$statement->bindValue(':date', $date_value);
    		    $statement->execute();
				$result = $db->lastInsertId();
    		    $statement->closeCursor();
    		} catch (PDOException $e) {
    		    $error_message = $e->getMessage();
    		    echo $error_message;
				return false;
    		}	
	}
	
	// Purpose: record that an email has been sent from the server.
	function record_email($date_value) {
		global $db;
    	$query = 'INSERT INTO emails_sent
                 (date)
              VALUES
                 (:date)';
    	try {
    	    $statement = $db->prepare($query);
			$statement->bindValue(':date', $date_value);
    	    $statement->execute();
			$result = $db->lastInsertId();
    	    $statement->closeCursor();
    	} catch (PDOException $e) {
    	    $error_message = $e->getMessage();
    	    echo $error_message;
			return false;
    	}
	}
	
	// Purpose: Get the ids of all available hives.
	function get_hive_ids() {
		global $db;
    	$query = 'SELECT * FROM temperature_record WHERE hive_id != 7 AND date > DATE_ADD(NOW(), INTERVAL -24 HOUR) GROUP BY hive_id';
    	try {
    	    $statement = $db->prepare($query);
    	    $statement->execute();
    	    $result = $statement->fetchAll();
    	    $statement->closeCursor();
    	    return $result;
    	} catch (PDOException $e) {
    	    print($e->getMessage());
    	}
	}
	
	// Purpose: Get the total number of emails that have been sent.
	function get_email_total() {
		global $db;
    	$query = 'SELECT * FROM emails_sent';
    	try {
    	    $statement = $db->prepare($query);
    	    $statement->execute();
    	    $result = $statement->fetchAll();
    	    $statement->closeCursor();
    	    return $result;
    	} catch (PDOException $e) {
    	    print($e->getMessage());
    	}
	}

?>