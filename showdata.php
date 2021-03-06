<!DOCTYPE html>
<html>
	<title>Data LINE</title>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('#dtMaterialDesignExample').DataTable();
				$('#dtMaterialDesignExample_wrapper').find('label').each(function () {
				$(this).parent().append($(this).children());
				});
				$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
				$('input').attr("placeholder", "Search");
				$('input').removeClass('form-control-sm');
				});
				$('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
				$('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
				$('#dtMaterialDesignExample_wrapper select').removeClass(
				'custom-select custom-select-sm form-control form-control-sm');
				$('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
				$('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
				$('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
			});
		</script>
		<style>
			table, th, td {
			  border: 1px solid black;
			  border-collapse: collapse;
			}
			div.container {
			    margin: 0 auto;
			    max-width:80%;
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
		<div class="header"><center><h1>Data on LINE Bot </h1></center></div>
		<div class="container">
			<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm" style="background-color:#f1f1c1" width="20%">Time
			      </th>
			      <th class="th-sm" style="background-color:#f1f1c1" width="25%">Group id
			      </th>
			      <th class="th-sm" style="background-color:#f1f1c1" width="20%">Displayname
			      </th>
			      <th class="th-sm" style="background-color:#f1f1c1" width="5%">Message type
			      </th>
			      <th class="th-sm" style="background-color:#f1f1c1" width="30%">Message
			      </th>
			      <!-- <th class="th-sm">Location
			      </th> -->
			      
			    </tr>
			  </thead>
			  <tbody>
			    <?php // callback.php

					//$id = $_GET["no"];
					header('Content-type:text/html; charset=utf-8');
					//require "vendor/autoload.php";
					//require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

					$access_token = 'HyW97ugLh5mEBYG+G2VCRbXrfqajv+kOrR+uHtkyItGUABVj7AfJ3+gp8j0VykAov1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuUkTrYUWIzQBqf8v39IGKVW3G3+wwZ3xEAgcPgggMGNyAdB04t89/1O/w1cDnyilFU=';

					$servername = "pbot001.cuicotomxesg.us-east-2.rds.amazonaws.com";
					$username = "pbot001";
					$password = "123456789";
					$dbname = "pbot001db";
								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								mysqli_set_charset($conn,"utf8");
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
									
								} 
								//echo "success";
								$m_id = "";
								$ty = "";
								$sql = "SELECT *,CONVERT_TZ(time_update,'+00:00','+07:00') as timez FROM pbot001db.chatbot ";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
									    if($row["message_type"]!="")
									    {
									    echo "<tr>";
									    echo "<td>".$row["timez"]."</td>";
									    echo "<td>".$row["group_id"]."</td>";
									    echo "<td>";
										   if($row["displayname"]!="")
										    	echo $row["displayname"];
										    else
											echo $row["user_id"];
									    echo "</td>";
									    echo "<td>".$row["message_type"]."</td>";
									    echo "<td>";
										if($row["message_type"] == "sticker" || $row["message_type"] =="text")
											echo $row["message"];
										else if($row["message_type"] == "location")
											echo $row["message"]." ".$row["location"];
										else
										{
											echo "<iframe width='300px' height='300px' src='https://pbot01.herokuapp.com/testgetuser.php?no=".$row["no"]."'></iframe><br>";
											echo "<a href='https://pbot01.herokuapp.com/testgetuser.php?no=".$row["no"]."' target='_blank'>show</a>";
										}
									    echo "</td>";
									    // echo "<td>".$row["location"]."</td>";

										$m_id = $row["message"];
										$ty = $row["message_type"];	
										echo "</tr>";
									    }
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
