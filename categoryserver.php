<?php
include 'conndb.php';

if ($_GET) {
    if (isset($_GET['singlebutton'])) {
$shop_id = mysqli_real_escape_string($con,$_GET['shop_name']);
$category_id = mysqli_real_escape_string($con,$_GET['category_name']);


// Check connection
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
}
$sql = "INSERT INTO product_category (cat_name, shop_id )
VALUES ('$category_id','$shop_id')";
if ($con->query($sql) === TRUE) {
    echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message
} else {
echo "Error: " . $sql . "<br>" . $con->error;
}   

 }
}
$con->close();
?>