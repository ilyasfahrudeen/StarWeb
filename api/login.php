<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $phone_number = $obj['phone_number'];
 $token = $obj['token'];
 $name = $obj['name'];

$check_query = "SELECT `phone_number` FROM `user_details` WHERE `phone_number`='".$phone_number."'";
$result = mysqli_query($con, $check_query);
if(mysqli_num_rows($result)>0){
    $update_token = "UPDATE `user_details` SET `token`='".$token."', `name`=".$name." WHERE phone_number=".$phone_number;
    mysqli_query($con,$update_token);
    $user_details_query = "SELECT * FROM `user_details` WHERE phone_number=".$phone_number;
        $user_details = mysqli_query($con, $user_details_query);
    foreach($user_details as $row){
        $fullar = "{ status: 1, message:'User found!', user_details: ".json_encode($row)." }";
        echo $fullar;}
}else{
    $newUserQuery = "INSERT INTO `user_details` (`phone_number`, `token`, `name`) VALUES ('".$phone_number."','".$token."','".$name."')";
    if ($con->query($newUserQuery) === TRUE) {
        $last_id = $con->insert_id;
        $newUser = array('user_id'=>$last_id, 'phone_number'=>$phone_number, 'token'=>$token, 'name'=>$name);
        $fullar = "{ status: 1, message:'New user added!', user_details: ".json_encode($newUser)." }";
        echo $fullar;
    } else {
        $fullar = "{ status: 0, message:'". $con->error."', user_details: [] }";
        echo $fullar;
    }
}

  }
?>