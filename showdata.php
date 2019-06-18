<!DOCTYPE html>
<html>
	<title>Data LINE</title>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="https://pbot01.herokuapp.com/css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="https://pbot01.herokuapp.com/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="https://pbot01.herokuapp.com/js/jquery.dataTables.js"></script>
		<style>
			div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>Data LINE </h1></div>
		<div class="container">
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Time</th>
							<th>Group id</th>
							<th>Displayname</th>
							<th>Message type</th>
							<th>Message</th>
							<th>location</th>	
						</tr>
					</thead>
					<tbody>
						<?
						header('Content-type:text/html; charset=utf-8');
						require "vendor/autoload.php";
						require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

						$access_token = 'HyW97ugLh5mEBYG+G2VCRbXrfqajv+kOrR+uHtkyItGUABVj7AfJ3+gp8j0VykAov1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuUkTrYUWIzQBqf8v39IGKVW3G3+wwZ3xEAgcPgggMGNyAdB04t89/1O/w1cDnyilFU=';


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
					</tbody>
			</table>
		</div>
	</body>
</html>
