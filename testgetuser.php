<?php // callback.php

$id = $_GET["no"];
header('Content-type:text/html; charset=utf-8');
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'RhQrCpgxwJ3DUCe2/uDut4sgB9cTSFx7XJ0337EKGUgs6b/Jr3haYG51CRlsK3OHY77Gn5rYCYrcjLFCD2Rsdq813OPLWNSOpfV5jGuVOfWLYoNXODd633yT7wNlnIhTEw/6aFxep0doAcFYp8YTbQdB04t89/1O/w1cDnyilFU=';


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

			$m_id = "";
			$ty = "";
			$sql = "SELECT * FROM chatbot where no = ".$id;
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
				$m_id = $row["message"];
				$ty = $row["message_type"];	
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
			if($ty=="video")
			{
				$url = "https://api.line.me/v2/bot/message/".$m_id."/content";
				$headers = array('Content-Type: video/mp4', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				header('Content-type: video/mp4');
				echo $result;
			}
			else if($ty=="image")
			{
				$url = "https://api.line.me/v2/bot/message/".$m_id."/content";
				$headers = array('Content-Type: image/jpeg', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				header('Content-type: image/jpeg');
				echo $result;
			}
			else if($ty=="audio")
			{
				$url = "https://api.line.me/v2/bot/message/".$m_id."/content";
				$headers = array('Content-Type: audio/mpeg', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				header('Content-type: audio/mpeg');
				echo $result;
			}
			else if($ty=="file")
			{
				$url = "https://api.line.me/v2/bot/message/".$m_id."/content";
				$headers = array('Content-Type: text/plain', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				header('Content-type: text/plain');
				echo $result;
			}
			else
				echo $m_id;
