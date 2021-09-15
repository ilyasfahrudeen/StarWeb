<?php
include 'conndb.php';

if ($_POST) {
    if (isset($_POST['singlebutton'])) {
$shop_name = mysqli_real_escape_string($con,$_POST['shop_name']);
$is_showing = mysqli_real_escape_string($con,$_POST['is_show']);

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

$sql = "INSERT INTO shops (shop_name, shop_image, is_show)
VALUES ('$shop_name','$filename','$is_showing')";
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