<?php
include 'conndb.php';

if ($_GET) {
    if (isset($_GET['singlebutton'])) {
$shop_id = mysqli_real_escape_string($con,$_GET['shop_name']);
$product_id = mysqli_real_escape_string($con,$_GET['product_id']);
$product_name = mysqli_real_escape_string($con,$_GET['product_name']);
$product_price = mysqli_real_escape_string($con,$_GET['product_price']);
//$product_categorie = mysqli_real_escape_string($con,$_GET['product_categorie']);
$product_categorie_id = mysqli_real_escape_string($con,$_GET['product_categorie']);
$product_description = mysqli_real_escape_string($con,$_GET['product_description']);
$percentage_discount = mysqli_real_escape_string($con,$_GET['percentage_discount']);
$enable_display = mysqli_real_escape_string($con,$_GET['enable_display']);

// Check connection
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
}
$sql = "INSERT INTO products (product_id, product_name, product_price, product_cat_id, product_details, enable_display, shop_id)
VALUES ('$product_id', '$product_name', '$product_price','$product_categorie_id', '$product_description', '$enable_display', '$shop_id')";
if ($con->query($sql) === TRUE) {
    echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message
} else {
echo "Error: " . $sql . "<br>" . $con->error;
}   

 }
}
$con->close();
?>