<?php
			$servername = "pbot01.hopto.org";
			$username = "research_usr";
			$password = "123456789";
			$dbname = "pbot01";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
				
			} 
			$sql = "INSERT INTO chatbot ( user_id, message) VALUES ('test', 'test')";
			if ($conn->query($sql) === TRUE) {
				echo "success";

			} else {
			    	echo "fail";

			}
			$conn->close();
?>
