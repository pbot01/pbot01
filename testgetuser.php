<?php // callback.php

$id = $_GET["no"];
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
			mysqli_set_charset($conn,"utf-8");
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
			else
				echo $m_id;
