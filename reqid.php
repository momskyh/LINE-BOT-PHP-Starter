<?php
 
$strAccessToken = "3vNgSp/la0b1krxIOXtihqmcz9VYy5VPpRM2uUfx/PbJmMM1kvtFdzeH5rRrugsAqqUoFR3Z5XVRlh4CnTULSDEkZmeUwXHUhTcu2N+XzgUgCiNZEVFaHBSwKBNVuAAA7IPbklpk3NosapVbbS/+zgdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$jsondata = file_get_contents("news2018.json");
 
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "flex";
  $arrPostData['messages'][0]['flex'] = $jsondata;
 
}else{
  $arrPostData = array();
  $userId = $arrJson['events'][0]['source']['userId'];
  $url = 'https://api.line.me/v2/bot/profile/'.$userId;
  $headers = array('Authorization: Bearer ' . $strAccessToken);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);
  curl_close($ch);
  include("botpush2.php");
  $arrPostData['to'] = "Ud5680fffd4957a5bc2af997beabc72ba";
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "New User Line infor => ".$result ."Message => ".$arrJson['events'][0]['message']['text'] ;
  // "Message ".$arrJson['events'][0]['source']['messages'];
}
 
 
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
echo $ch;
?>
