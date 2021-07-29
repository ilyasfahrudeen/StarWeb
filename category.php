<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include('categoryserver.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
                <a href="product.php"><i class="fas fa-user-circle"></i>Product</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>
<div class="form-group">
  <label class="col-md-4 control-label" for="shop_name">SHOP</label>
  <div class="col-md-4">
    <select id="shop_name" name="shop_name" class="form-control">
    <option selected="selected">Choose one</option>
      <?php
      include 'conndb.php';
      $sqli = "SELECT * FROM shops";
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
  echo '<option value = '.$row['shop_id'].'>'.$row['shop_name'].'</option>';
  }
      ?>

    </select>

  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="category_name">Category Name</label>  
  <div class="col-md-4">
  <input id="category_name" name="category_name" placeholder="Category Name" class="form-control input-md" required="" type="text">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">auxiliary_images</label>
  <div class="col-md-4">
    <input id="filebutton" name="filebutton" class="input-file" type="file">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton">Single Button</label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Button</button>
  </div>
  </div>

</fieldset>
</form>


</div>
		</div>
	</body>
</html>