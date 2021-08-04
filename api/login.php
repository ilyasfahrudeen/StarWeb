<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
$json = file_get_contents('php://input');
$obj = json_decode($json);
$phone_number = $obj->{'phone_number'};
$token = $obj->{'token'};

$check_query = "SELECT * FROM `user_details` WHERE EXISTS (SELECT * FROM `user_details` WHERE phone_number=".$phone_number.")";
$result = mysqli_query($con, $check_query);

$check_exist = mysqli_num_rows($result);

if($check_exist>0){
    $user_details_query = "SELECT * FROM `user_details` WHERE phone_number=".$phone_number;
    $user_details = mysqli_query($con, $user_details_query);
foreach($user_details as $row){
    $fullar = "{ status: 1, message:'User found!', user_details: ".json_encode($row)." }";
    echo $fullar;}
}else{
    $newUserQuery = "INSERT INTO `user_details`(`phone_number`, `token`) VALUES (".$phone_number.",".$token.")";
    if ($con->query($newUserQuery) === TRUE) {
        $newUser = array('phone_number'=>$phone_number, 'token'=>$token);
        $fullar = "{ status: 1, message:'New user added!', user_details: ".json_encode($newUser)." }";
        echo $fullar;
    } else {
        $fullar = "{ status: 0, message:'". $con->error."', user_details: [] }";
        echo $fullar;
    } }
  }
?>