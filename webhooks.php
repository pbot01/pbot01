<?php // callback.php
header('Content-type:text/html; charset=utf-8');
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'iLDkHbjueMjxmKu3rbb09lc1z3mu95S93R2Hr00mrm/fyvLdmAU9egAUIrCcCbnjv1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuVLv13g6rIQYs6KLGW/Aph+LatpMjqDrZKLS8UUjsFCHQdB04t89/1O/w1cDnyilFU=';
$servername = "pbot001.cuicotomxesg.us-east-2.rds.amazonaws.com";
$username = "pbot001";
$password = "123456789";
$dbname = "pbot001db";
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
			$text .= $content;
			$replyToken = $event['replyToken'];

// 			//get display name
			
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
			
			$text .= $disname;
			
// 			// Create connection
// 			$conn = new mysqli($servername, $username, $password, $dbname);
// 			// Check connection
// 			//mysqli_set_charset($conn,"utf8");
// 			if ($conn->connect_error) {
// 			    die("Connection failed: " . $conn->connect_error);
// 				$text .= "connection error ";
// 			} 
// 			$sql = "INSERT INTO pbot001db.chatbot (message_type,time_update,user_id,message,group_id,displayname) VALUES ('text',SYSDATE(),'".$uid."', '".$ms."', '".$gid."', '".$disname."')";
// 			if ($conn->query($sql) === TRUE) {
				
// 				$text .= "success";
// 			} else {
// 			    	$text .= "fail";
// 			}
// 			$conn->close();
			
			//$replyToken = $event['replyToken'];

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
			
			echo $result . "\r\n";

		}
		else if ($event['type'] == 'message' && $event['message']['type'] == 'location') {
			// Get text sent
			
			$uid = $event['source']['userId'];
			$gid = $event['source']['groupId'];
			$dt= date('Y-m-d H:i:s');
			$ms= $event['message']['title']." ".$event['message']['address'];
			$lo= "latitude:".$event['message']['latitude']." longitude:".$event['message']['longitude'];
			
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
			
			$servername = "pbot02db.cuicotomxesg.us-east-2.rds.amazonaws.com";
			$username = "pbot02";
			$password = "123456789";
			$dbname = "pbot02db";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			mysqli_set_charset($conn,"utf8");
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "INSERT INTO chatbot (message_type,time,user_id,message,group_id,displayname,location) VALUES ('location',SYSDATE(),'".$uid."', '".$ms."', '".$gid."', '".$disname."', '".$lo."')";
			if ($conn->query($sql) === TRUE) {
				
				$text = "success";
			} else {
			    	$text = "fail";
			}
			$conn->close();
		}
		else {
						// Get text sent
			$uid = $event['source']['userId'];
			$gid = $event['source']['groupId'];
			$ty = $event['message']['type'];
			$dt= date('Y-m-d H:i:s');
			$ms= $event['message']['id'];
			$text = $event['source']['userId'].' ';
			$text .= date('Y-m-d H:i:s').' ';
			$text .= $event['message']['id'].' ';
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
			
			$servername = "pbot02db.cuicotomxesg.us-east-2.rds.amazonaws.com";
			$username = "pbot02";
			$password = "123456789";
			$dbname = "pbot02db";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			mysqli_set_charset($conn,"utf8");
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "INSERT INTO chatbot (message_type,time,user_id,message,group_id,displayname) VALUES ('".$ty."',SYSDATE(),'".$uid."', '".$ms."', '".$gid."', '".$disname."')";
			if ($conn->query($sql) === TRUE) {
				
				$text = "success";
			} else {
			    	$text = "fail";
			}
			$conn->close();
		}
	}
}
echo "OK";
