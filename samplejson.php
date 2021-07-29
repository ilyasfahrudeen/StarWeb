<?php
header("Content-type: application/json; charset=utf-8");
include 'conndb.php';
$query = "SELECT products.product_name, products.product_price, products.product_cat, product_category.cat_name FROM products, product_category WHERE products.product_cat_id = product_category.cat_id";
$result = mysqli_query($con, $query);
$rows = array();
while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
}
//Return result to jTable
$qryResult = array();
$qryResult['logs'] = $rows;
echo json_encode($qryResult);

?>