<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
$json = file_get_contents('php://input');
$obj = json_decode($json);
$phone_number = $obj->{'phone_number'};
$token = $obj->{'token'};
  }
?>