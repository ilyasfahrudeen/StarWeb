<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$user_id = $obj['user_id'];
$phone_number = $obj['phone_number'];
$total = $obj['total'];
$address = $obj['address'];
$token = $obj['token'];
$product_array = $obj['order_product'];

$order_qurey = "INSERT INTO `orders` (`phone_number`, `total_price`, `address`, `order_status`, `user_id`) 
VALUES ('".$phone_number."', '".$total."', '".$address."', '1', '".$user_id."')";
//$order_result = mysqli_query($con, $order_qurey);
if ($order_result = mysqli_query($con, $order_qurey) === TRUE) {
  $fullar = "new :";
   foreach ($product_array as $order_pro){
    $fullar = $fullar.$order_pro['product_name'];
   $product_name = $order_pro['product_name'];
   $product_id = $order_pro['product_id'];
   $product_price = $order_pro['product_price'];
   $quantity = $order_pro['quantity'];
   $cat_id = $order_pro['cat_id'];
   $shop_id = $order_pro['shop_id'];
   $order_product_query = "INSERT INTO `orders_products` (`order_id`, `product_name`, `product_id`, `cat_id`, `shop_id`, `quantity`, `product_price`, `user_id`) 
   VALUES (LAST_INSERT_ID(), '".$product_name."', '".$product_id."', '".$cat_id."', '".$shop_id."', '".$quantity."', '".$product_price."', '".$user_id."')";
   mysqli_query($con, $order_product_query);
   }
  
  $fullar = $fullar."{ status: 1, message:'Order Placed!'}";
 // $fullar = "hello :".$product_array;
  echo $fullar;
} else {
  $fullar = "{ status: 0, message:'". $con->error."'}";
  echo $fullar;
}
  } else{
    echo 'No authentication ';
  }
?>