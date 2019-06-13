<?php // callback.php
header('Content-type:text/html; charset=utf-8');
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'HyW97ugLh5mEBYG+G2VCRbXrfqajv+kOrR+uHtkyItGUABVj7AfJ3+gp8j0VykAov1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuUkTrYUWIzQBqf8v39IGKVW3G3+wwZ3xEAgcPgggMGNyAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			
			$uid = $event['source']['userId'];
			$gid = $event['source']['groupId'];
			$dt= date('Y-m-d H:i:s');
			$ms= $event['message']['text'];
			$text = $event['source']['userId'].' ';
			$text .= date('Y-m-d H:i:s').' ';
			$text .= $event['message']['text'].' ';
			$text = $content;
			$replyToken = $event['replyToken'];

			// Build message to reply back

			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
		
			// reply message	
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			//get display name
			
			$url = "https://api.line.me/v2/bot/profile/".$uid;
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			//echo $result;
			$profile =  json_decode($result, true); 
			$disname = $profile['displayName'];
			curl_close($ch);
			
			

			echo $result . "\r\n";
			
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
			$sql = "INSERT INTO chatbot (message_type,time,user_id,message,group_id,displayname) VALUES ('text',SYSDATE(),'".$uid."', '".$ms."', '".$gid."', '".$disname."')";
			if ($conn->query($sql) === TRUE) {
				
				$text = "success";
			} else {
			    	$text = "fail";
			}
			$conn->close();
		}
		else {
			
			$text .= $content;
			
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);


			if($event['type'] == 'image')
			{

				$url = "https://api.line.me/v2/bot/message/".$event['message']['id']."/content";
				$headers = array('Content-Type: image/jpeg', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				//header('Content-type: image/jpeg');
				//echo $result;
				$uid = $event['source']['userId'];
				$gid = $event['source']['groupId'];
				$dt= date('Y-m-d H:i:s');
				$ms= $result;


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
				$sql = "INSERT INTO chatbot (message_type,time,user_id,message,group_id,displayname) VALUES ('image',SYSDATE(),'".$uid."', '".$ms."', '".$gid."', '".$disname."')";
				if ($conn->query($sql) === TRUE) {
					
					$text = "success";
				} else {
				    	$text = "fail";
				}
				$conn->close();
			}
			
			echo $result . "\r\n";
		}
	}
}
