<?php
 
$strAccessToken = "ZOQK8BKZR37sUirdSwc4lzgPXyCcYcEW0rkcd3DJNMf9lOsMDznLQZ6g7hONnns5e892HCCEC/69VmGlcAkwWsuNJsmQ0gga6JoLqt3sXQSSVIxz0GrUnOQw346HUVaFaAd9VOpR8yBYvJAQAlXLRgdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
}else{
 $messageback = $arrJson['events'][0]['message']['text'];
 $msgback = explode(" ", $messageback);
   if($msgback[0] == "regis"){
      $messageback = $arrJson['events'][0]['message']['text'];
      $msgback = explode(" ", $messageback);
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
      $arrPostData['to'] = "Uf77dfcdeb8e04bca8a90ad721d8104a9";
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = "New User Line infor => ".$result ."<br>" ."รหัสพนักงาน => ".$msgback[1];
      // "Message ".$arrJson['events'][0]['source']['messages'];
   }else{
   }
}
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
