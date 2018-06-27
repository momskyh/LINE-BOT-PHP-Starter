<?php
 
$strAccessToken = "h6qzlIg7k7SdqLjiq4CCa+AuVQpCGoPF+cg78G+HlBrBH1v6u2D/SP6slIAsydQAqqUoFR3Z5XVRlh4CnTULSDEkZmeUwXHUhTcu2N+XzgUTQVWW4oOrlMQnoIORLgV6H52Ctn3cEuIOrPUJbXWDTQdB04t89/1O/w1cDnyilFU=";
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";

$arrPostData = array();
$arrPostData['to'] = "Ud5680fffd4957a5bc2af997beabc72ba";
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "สวัสดี GROUP ID คุณคือ ".$arrJson['events'][0]['source']['groupId'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>
