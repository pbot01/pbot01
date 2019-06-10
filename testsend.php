<?php
require "vendor/autoload.php";
$access_token = 'la3nQ7rJ7FR8r0eTQPiYFfeE1vHNVIcdS4OoqTvWuRw/tGu9WG/joyP4vPOnQBqrv1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuVOwQrSKYZLYDck8hN/7PCuKeEWSlXfuR2iLyUTTRgovwdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'e614b22719cb2e71e927dbd972d7249a';
$idPush = 'U935fd498360db058d05404b3006cfa3a'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
