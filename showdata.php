<html>
	<head></head>
	<body>
		<table>

		<?php // callback.php

					$servername = "pbot01.hopto.org";
					$username = "research_usr";
					$password = "123456789";
					$dbname = "pbot01";
					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					mysqli_set_charset($conn,"utf8");
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					} 

					$m_id = "";
					$ty = "";
					$sql = "SELECT * FROM chatbot ";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    echo "<tr>";
					    echo "<td>".$row["time"]."<td>";
					    echo "<td>".$row["group_id"]."<td>";
					    echo "<td>".$row["displayname"]."<td>";
					    echo "<td>".$row["message"]."<td>";
					    echo "<td>".$row["location"]."<td>";
					    echo "<td>".$row["message_type"]."<td>";
						$m_id = $row["message"];
						$ty = $row["message_type"];	
						echo "</tr>";
					    }
					} else {
					    echo "0 results";
					}
					$conn->close();
		?>
		</table>
	</body>
</html>
