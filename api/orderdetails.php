<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $phone_number = $obj['phone_number'];
 $token = $obj['token'];
 $offset = $obj['off_set'];
 $total_records_per_page = $obj['records_per_page'];

 $result_count = mysqli_query(
    $con,
    "SELECT COUNT(*) As total_records FROM `orders`"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    echo $total_records."-".$total_no_of_pages;

}
?>