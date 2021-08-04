<?php
include 'conndb.php';

if ($_POST) {
    if (isset($_POST['singlebutton'])) {
$shop_id = mysqli_real_escape_string($con,$_POST['shop_name']);
$product_id = mysqli_real_escape_string($con,$_POST['product_id']);
$product_name = mysqli_real_escape_string($con,$_POST['product_name']);
$product_price = mysqli_real_escape_string($con,$_POST['product_price']);
$product_quantity = mysqli_real_escape_string($con,$_POST['product_quantity']);
$product_categorie_id = mysqli_real_escape_string($con,$_POST['product_categorie']);
$product_description = mysqli_real_escape_string($con,$_POST['product_description']);
$percentage_discount = mysqli_real_escape_string($con,$_POST['percentage_discount']);
$enable_display = mysqli_real_escape_string($con,$_POST['enable_display']);

$filename = $_FILES['image']['name'];
$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
 
// Check connection
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
}
if( in_array($imageFileType,$extensions_arr) ){
    if(move_uploaded_file($_FILES["image"]["tmp_name"],'upload/'.$filename)){

$sql = "INSERT INTO products (product_name, product_price, product_cat_id, product_details, enable_display, shop_id, product_quantity, image_path)
VALUES ('$product_name', '$product_price','$product_categorie_id', '$product_description', '$enable_display', '$shop_id', '$product_quantity', '$filename')";
if ($con->query($sql) === TRUE) {
    echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message
} else {
echo "Error: " . $sql . "<br>" . $con->error;
}   
}
}
 }
}
$con->close();
?>