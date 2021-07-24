<?php
$servername = "localhost";
$username = "root";
$password = "Spirit123*";
$dbname = "star_login";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_GET) {
    if (isset($_GET['singlebutton'])) {

$product_id = mysqli_real_escape_string($conn,$_GET['product_id']);
$product_name = mysqli_real_escape_string($conn,$_GET['product_name']);
$product_price = mysqli_real_escape_string($conn,$_GET['product_price']);
$product_categorie = mysqli_real_escape_string($conn,$_GET['product_categorie']);
$product_description = mysqli_real_escape_string($conn,$_GET['product_description']);
$percentage_discount = mysqli_real_escape_string($conn,$_GET['percentage_discount']);
$enable_display = mysqli_real_escape_string($conn,$_GET['enable_display']);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO products (product_id, product_name, product_price, product_cat, product_cat_id, product_details)
VALUES ('$product_id', '$product_name', '$product_price','$product_categorie', 'cat_id', '$product_description')";
if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}   

 }
}
$conn->close();
?>