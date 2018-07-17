<?php
header("Content-Type: application/json");
$josndata = file_get_contents("news2018.json");
echo $josndata
