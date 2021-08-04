<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include('orderserver.php');
header("refresh: 25;");


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Orders</title>
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
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap 4 Table with Emphasis Classes</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<style>
    .bs-example{
    	margin: 10px;
    }
</style>
</head>
<body>
<div class="bs-example">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Shop</th>
                <th>Category</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Time</th>
                <th>Date</th>
                <th>Status</th>
                <th>Remark</th>
            
            </tr>
        </thead>
        <tbody>
            
            <?php
      include 'conndb.php';
      $sqli = "SELECT * FROM orders ORDER BY order_status";
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
    if($row['order_status'] == '1'){
    echo '<tr class="table-warning">';
    $row['order_status'] = 'Pending';
     }elseif($row['order_status'] == '2'){
        echo '<tr class="table-success">';
        $row['order_status'] = 'Delivered';
     } elseif($row['order_status'] == '3'){        
          echo ' <tr class="table-danger">';
          $row['order_status'] = 'Cancelled';
     }
 // echo '<td> '.$row['order_id'].'</td>';
 echo '<td name="MyTable" width="35%"><input type="hidden" name="td_1" value="value_1">'.$row['order_id'].'</td>';
  echo '<td> '.$row['shop_name'].'</td>';
  echo '<td> '.$row['cat_name'].'</td>';
  echo '<td> '.$row['product_name'].'</td>';
  echo '<td> '.$row['quantity'].'</td>';
  echo '<td> '.$row['price'].'</td>';
  echo '<td> '.$row['phone_number'].'</td>';
  echo '<td> '.$row['address'].'</td>';
  echo '<td> '.$row['order_time'].'</td>';
  echo '<td> '.$row['order_date'].'</td>';
  echo '<td> '.$row['order_status'].'</td>';
  echo '<td> '.$row['remark'].'</td>';
  echo '<td><input type="button" name="view" value="view" id="'.$row['order_id'].'" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#staticBackdrop"/></td>';
//   echo '<td><button class="clsActionButton" id="idEditButton">Edit</button></td></tr>';
  }
      ?>
               
            <!-- </tr>
            <tr class="table-secondary">
                <td>2</td>
                <td>Insurance</td>
                <td>02/07/2019</td>
                <td>Cancelled</td>
            </tr>
            <tr class="table-success">
                <td>3</td>
                <td>Water</td>
                <td>01/07/2019</td>
                <td>Paid</td>
            </tr>
            <tr class="table-info">
                <td>4</td>
                <td>Internet</td>
                <td>05/07/2019</td>
                <td>Change plan</td>
            </tr>
            <tr class="table-warning">
                <td>5</td>
                <td>Electricity</td>
                <td>03/07/2019</td>
                <td>Pending</td>
            </tr>
            <tr class="table-danger">
                <td>6</td>
                <td>Telephone</td>
                <td>06/07/2019</td>
                <td>Due</td>
            </tr>
            <tr class="table-active">
                <td>7</td>
                <td>DTH</td>
                <td>04/07/2019</td>
                <td>Deactivated</td>
            </tr>            
            <tr class="table-light">
                <td>8</td>
                <td>Car Service</td>
                <td>08/07/2019</td>
                <td>Call in to confirm</td>
            </tr>
            <tr class="table-dark">
                <td>9</td>
                <td>Gas</td>
                <td>06/07/2019</td>
                <td>Payment failed</td>
            </tr> -->
        </tbody>
    </table>
</div>

</fieldset>
</form>


</div>
		</div>
   <!-- View Data Modal-->
   <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <!-- <h4 class="modal-title">Employee Details</h4> -->
                </div>
               
                <div class="modal-body" id="order_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="update" id="update_data" class="btn btn-primary" value="Update">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
         $(document).on("click", "#update_data", function() {
           // alert("Hello! I am an alert box!!");
            var orderId = $('#order_id').val();
            var product = $('#product_name').val();
            var quantity = $('#quantity').val();
            var price = $('#price').val();
            var remark = $('#remark').val();
            var status = $('#status').val();

            $.ajax({
                url: "orderinsert.php",
                type: "POST",
                catch: false,
                data: {
                    added: 1,
                    orderId: orderId,
                    product: product,
                    quantity: quantity,
                    price: price,
                    remark: remark,
                    status: status
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                      //  $('#dataModal').modal().hide();
                        swal("Setting Updated!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    } else{
                        alert("Data Inserted Error!");
                    }
                }
            });
        });

        $(document).on('click', '.view_data', function() {
            //$('#dataModal').modal();
            var order_id = $(this).attr("id");
            $.ajax({
                url: "orderinsert.php",
                method: "POST",
                data: {
                    order_id: order_id
                },
                success: function(data) {
                    $('#order_detail').html(data);
                    $('#dataModal').modal('show');
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                        $('#dataModal').modal().hide();
                        swal("Setting Updated!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });

   
</script>
	</body>
</html>