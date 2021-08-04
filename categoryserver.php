<?php
include 'conndb.php';

if ($_POST) {
    if (isset($_POST['singlebutton'])) {
$shop_id = mysqli_real_escape_string($con,$_POST['shop_name']);
$category_id = mysqli_real_escape_string($con,$_POST['category_name']);

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

$sql = "INSERT INTO product_category (cat_name, shop_id, cat_image)
VALUES ('$category_id','$shop_id','$filename')";
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