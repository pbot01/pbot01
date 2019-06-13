<?php // callback.php
header('Content-type:text/html; charset=utf-8');
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'HyW97ugLh5mEBYG+G2VCRbXrfqajv+kOrR+uHtkyItGUABVj7AfJ3+gp8j0VykAov1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuUkTrYUWIzQBqf8v39IGKVW3G3+wwZ3xEAgcPgggMGNyAdB04t89/1O/w1cDnyilFU=';

$url = "https://api.line.me/v2/bot/message/10036084556718/content";
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
// $profile =  json_decode($result, true); 
// 			$disname = $profile['displayName'];
//The cURL stuff...
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
// $picture = curl_exec($ch);
// curl_close($ch);
// //Display the image in the browser
// header('Content-type: image/jpeg');
// echo $picture;


			curl_close($ch);



