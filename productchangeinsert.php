<?php 

    header("refresh: 3;");
    session_start();
include('conndb.php');

if ($_POST) {

    if (isset($_POST['quickVar1a'])){

        $query = "";
  if($_POST['quickVar1a'] == "ON"){
    
    $query = "UPDATE `shops` SET `is_show`=0 WHERE `shop_id`=".$_SESSION['shop_id'];
    if (mysqli_query($con,$query)){
        echo 'Shop is visible';
    }
  }else {
    $query = "UPDATE `shops` SET `is_show`=1 WHERE `shop_id`=".$_SESSION['shop_id'];
    if (mysqli_query($con,$query)){
        echo 'Shop is not visible';
    }
  }

    }
    if(isset($_POST['added'])){
    //  echo json_encode(array("status" => 1));
   //   echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message

        $productId = $_POST['productId'];
        $price = $_POST['price'];
        $enableDisplay = $_POST['enableDisplay'];
     //   $query = "UPDATE `orders` SET `quantity`=".$quantity.",`price`=".$price.",`order_status`=".$remark.",`remark`= ".$remark.",`product_name`=".$product." WHERE `order_id` =".$orderId;
     //   echo json_encode(array("status" => 1));
     $query = "UPDATE `products` SET `product_price`='".$price."',`enable_display`='".$enableDisplay."' WHERE product_id ='".$productId."'";
        if (mysqli_query($con,$query)){
            echo json_encode(array("status" => 1));
        }
        else{
            echo json_encode(array("status"=>2));
        }
    }

if(isset($_POST["product_id"]))  
 {  


    $delivery = '';

    

      $output = '';  
      $query = "SELECT * FROM products WHERE product_id = '".$_POST["product_id"]."'";  
      $result = mysqli_query($con, $query);  
      $output .= '  
      <div class="form-group">';  
      while($row = mysqli_fetch_array($result))  
      {  

        if($row['enable_display'] == 'yes'){
            $delivery = '<option selected value ="yes">Yes</option>
            <option value ="no">No</option>';
          }elseif($row['enable_display'] == 'no'){
            $delivery = '<option value ="yes">Yes</option>
            <option selected value ="no">No</option>';
        }
   
           $output .= '  
           <label for="exampleFormControlTextarea1"> Product ID</label>
           <input class="form-control" readonly id="product_id" name="product_id" value="'.$row['product_id'].'">
           <label for="exampleFormControlTextarea1"> Product Name</label>
           <input class="form-control" id="product_name" name="product_name" value="'.$row['product_name'].'">
           <label for="exampleFormControlTextarea1"> Description</label>
           <input class="form-control" id="product_details" name="product_details" value="'.$row['product_details'].'">
           <label for="exampleFormControlTextarea1"> Price</label>
           <input class="form-control" id="price" name="price" value="'.$row['product_price'].'">
           <label for="exampleFormControlTextarea1"> Show Product</label>
           <select id="enable_display" name="enable_display" class="form-control">
           '.$delivery.'
           </select>';  
      }  
      $output .= '  
      </div>  
      ';  
      echo $output;  
 }  
}




?>