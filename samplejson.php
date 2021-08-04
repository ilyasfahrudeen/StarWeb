<!DOCTYPE html>
<html>
<head>
    <title>Insert Image in MySql using PHP</title>
</head>
<body>
<?php
include 'conndb.php';
$msg = '';
$filename = $_FILES['image']['name'];
	
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
 
	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){
 
	// Upload files and store in database
	if(move_uploaded_file($_FILES["image"]["tmp_name"],'upload/'.$filename)){
		// Image db insert sql
      
		$insert = "INSERT INTO `testimg`(`image_path`) VALUES ('$filename')";
		if($con->query($insert) === TRUE){
		  echo 'Data inserted successfully'.$filename;
		}
		else{
		  echo 'Error: '.mysqli_error($conn);
		}
	}else{
		echo 'Error in uploading file - '.$_FILES['image']['name'].'';
	}
	}
?>
<form method='post' action='#' enctype='multipart/form-data'>
<div class="form-group">
 <input type="file" name="image" >
</div> 
<div class="form-group"> 
 <input type='submit' name='submit' value='Upload' class="btn btn-primary">
</div> 
</form>
</body>
</html>