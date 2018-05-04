<?php
$access_token = 'h6qzlIg7k7SdqLjiq4CCa+AuVQpCGoPF+cg78G+HlBrBH1v6u2D/SP6slIAsydQAqqUoFR3Z5XVRlh4CnTULSDEkZmeUwXHUhTcu2N+XzgUTQVWW4oOrlMQnoIORLgV6H52Ctn3cEuIOrPUJbXWDTQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;