<?php
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Product Edit</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Star Online</h1>
                <?php
                if($_SESSION['is_admin'] == 0){
             		echo '<a href="orders.php"><i class="fas fa-user-circle"></i>Orders</a>
                <a href="category.php"><i class="fas fa-user-circle"></i>Category</a>
                <a href="product.php"><i class="fas fa-user-circle"></i>Product</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="shop.php"><i class="fas fa-user-circle"></i>Shop</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>';
                }else{
                    echo '<a href="orderdetails.php"><i class="fas fa-user-circle"></i>Orders</a>
                    <a href="productchange.php"><i class="fas fa-user-circle"></i>Product Edit</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>';
                }
                ?>
			</div>
		</nav>
		<div class="content">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->

<legend>PRODUCT EDIT</legend>
<head>
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    /* --------------------------- */
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

</head>
<body>
<h3>

 <?php 
include 'conndb.php';
 $query = "SELECT * FROM `shops` WHERE `shop_id`='".$_SESSION["shop_id"]."'";  
 $result = mysqli_query($con, $query); 
 while($row = mysqli_fetch_array($result)){
     if($row['is_show'] == '0'){
        echo '<div id="setQuickVar1"><label class="switch"><input id="shop_on" type="checkbox" data-switchery checked
        /> <span class="slider round"> </lable>
        </div> <div id="resultQuickVar1">Shop is visible</div> </span>
        </label>';
     } else {
        echo '<div id="setQuickVar1"><label class="switch"><input id="shop_on" type="checkbox" data-switchery checked
        /> <span class="slider round"> </lable>
        </div> <div id="resultQuickVar1">Shop is not visible</div> </span>
        </label>';
     }
 } 
?>

</h3>
<div style="overflow-x:auto;">
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Showing</th>
            
            </tr>
        </thead>
        <tbody>
            
            <?php
      include 'conndb.php';


      if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  $total_records_per_page = 20;

  $offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";


  } else {
      $page_no = 1;
      }
      $total_records_per_page = 20;
      $offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$result_count = mysqli_query(
    $con,
    "SELECT COUNT(*) As total_records FROM `orders`"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1


    if($_SESSION['is_admin'] == 0){
        $sqli = "SELECT * FROM `products`
        ORDER BY enable_display DESC LIMIT $offset, $total_records_per_page";
    }else{
      $sqli = "SELECT * FROM `products` WHERE shop_id=".$_SESSION['shop_id']."
      ORDER BY enable_display DESC LIMIT $offset, $total_records_per_page";
    }
$result = mysqli_query($con, $sqli);
while ($row = mysqli_fetch_array($result)) {
  
    if($row['enable_display'] == 'yes'){
        echo '<tr class="table-warning">';
        $row['order_status'] = 'Pending';
         } elseif($row['enable_display'] == 'no'){        
              echo ' <tr class="table-danger">';
              $row['order_status'] = 'Cancelled';
         }
 // echo '<td> '.$row['order_id'].'</td>';
 echo '<td name="MyTable" ><input type="hidden" name="td_1" value="value_1">'.$row['product_name'].'</td>';
  echo '<td> '.$row['product_details'].'</td>';
  echo '<td> ₹'.$row['product_price'].'</td>';
  echo '<td> '.$row['enable_display'].'</td>';
//   echo '<td><input type="button" name="view" value="view" id="'.$row['order_id'].'" class="btn btn-info btn-xs view_item" data-toggle="modal" data-target="#dd"/></td>';
//   echo '<td><input type="button" name="edit" value="edit" id="'.$row['order_id'].'" class="btn btn-info btn-xs edit_data" data-toggle="modal" data-target="#dd"/></td>';
//   //if($_SESSION['is_admin'] == 0){
    echo '<td><input type="button" name="status" value="Edit" id="'.$row['product_id'].'" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#staticBackdrop"/></td>';
    //}
  }
  
      ?>
               

        </tbody>
    </table>
    <ul class="pagination">
<?php if($page_no > 1){
echo "<li><a href='?page_no=1'>First Page</a></li>";
} ?>
    
<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){
echo "href='?page_no=$previous_page'";
} ?>>Previous</a>
</li>
    
<li <?php if($page_no <= 4) {			
 for ($counter = 1; $counter < 8; $counter++){		 
	if ($counter == $page_no) {
	   echo "<li class='active'><a>$counter</a></li>";	
		}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";
for (
     $counter = $page_no - $adjacents;
     $counter <= $page_no + $adjacents;
     $counter++
     ) {		
     if ($counter == $page_no) {
	echo "<li class='active'><a>$counter</a></li>";	
	}else{
        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
          }                  
       }
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}?>>
</ul>
</div>
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
            var productId = $('#product_id').val();
            var price = $('#price').val();
            var enableDisplay = $('#enable_display').val();
        

            $.ajax({
                url: "productchangeinsert.php",
                type: "POST",
                catch: false,
                data: {
                    added: 1,
                    productId: productId,
                    price: price,
                    enableDisplay: enableDisplay
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                      //  $('#dataModal').modal().hide();
                        swal("Price Updated!", {
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
            var product_id = $(this).attr("id");
            $.ajax({
                url: "productchangeinsert.php",
                method: "POST",
                data: {
                    product_id: product_id
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

   //toggle
   $(document).ready(function() { 
     $('#shop_on').on('click', function() {
       var checkStatus = this.checked ? 'ON' : 'OFF';
     //    alert(checkStatus);
        $.post("productchangeinsert.php", {"quickVar1a": checkStatus}, 
        function(data) {
           $('#resultQuickVar1').html(data);
        });

     });
});

var tog = document.getElementById('shop_on');
tog.checked;
</script>

	</body>
</html>