<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $user_id = $obj['user_id'];

    $check_query = "SELECT * FROM orders WHERE user_id=".$user_id." ORDER BY order_status LIMIT 20";
    $result = mysqli_query($con, $check_query);
    $orders = array();

    while ($row = mysqli_fetch_array($result)) {
       $order_id = $row['order_id'];
       $user_id = $row['user_id'];
       $address = $row['address'];
       $phone = $row['phone_number'];
       $time = $row['order_time'];
       $total = $row['total_price'];
       $order_status = $row['order_status'];
       $reqProduct = "SELECT * FROM `orders_products` WHERE order_id = '".$order_id."'";
       $reqProduct = mysqli_query($con, $reqProduct);
       $productNames = array();
       while($productName = mysqli_fetch_assoc($reqProduct)){
           $productNames[] = $productName;
       }
       if(!empty($productNames)){
       $orders[] = array('order_id'=>$order_id, 'user_id'=>$user_id, 'total'=>$total, 'address'=>$address,'phone'=>$phone,'time'=>$time,'order_status'=>$order_status,'orders_details'=>$productNames);
       }
    }
if(!empty($orders)){
$fullar = "{ status: 1, message:'Order details', orders: ".json_encode($orders)." }";
}else{
    $fullar = "{ status: 1, message:'Order details is empty', orders: ".json_encode($orders)." }";
}
echo $fullar;

}
?>