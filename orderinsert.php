<?php 

    header("refresh: 3;");
    session_start();
include('conndb.php');

if ($_POST) {

    if(isset($_POST['added'])){
    //  echo json_encode(array("status" => 1));
   //   echo '<script type="text/javascript"> alert("Data Inserted Seccessfully!"); </script>';  // alert message

        $orderId = $_POST['orderId'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $remark = $_POST['remark'];
        $status = $_POST['status'];
     //   $query = "UPDATE `orders` SET `quantity`=".$quantity.",`price`=".$price.",`order_status`=".$remark.",`remark`= ".$remark.",`product_name`=".$product." WHERE `order_id` =".$orderId;
     //   echo json_encode(array("status" => 1));
     $query = "UPDATE `orders` SET `remark`='".$remark."', `order_status`='".$status."' WHERE order_id ='".$orderId."'";
        if (mysqli_query($con,$query)){
            echo json_encode(array("status" => 1));
        }
        else{
            echo json_encode(array("status"=>2));
        }
    }

if(isset($_POST["order_id"]))  
 {  
   
    $shop_query = "SELECT * FROM shops";
    $shop_result = mysqli_query($con, $shop_query);

    $delivery = '';

    

      $output = '';  
      $query = "SELECT * FROM orders WHERE order_id = '".$_POST["order_id"]."'";  
      $result = mysqli_query($con, $query);  
      $output .= '  
      <div class="form-group">';  
      while($row = mysqli_fetch_array($result))  
      {  
          if($row['order_status'] == '1'){
            $delivery = '<option selected value ="1">Pending</option>
            <option value ="2">Delivered</option>
            <option value ="3">Cancelled</option>';
          }elseif($row['order_status'] == '2'){
            $delivery = '<option value ="1">Pending</option>
            <option selected value ="2">Delivered</option>
            <option value ="3">Cancelled</option>';
        }elseif($row['order_status'] == '3'){
            $delivery = '<option value ="1">Pending</option>
            <option value ="2">Delivered</option>
            <option selected value ="3">Cancelled</option>';
        }
           $output .= '  
           <label for="exampleFormControlTextarea1"> Order ID</label>
           <input class="form-control" readonly id="order_id" name="order_id" value="'.$row['order_id'].'">
           <label for="exampleFormControlTextarea1"> Remark</label>
           <input class="form-control" id="remark" name="remark" value="'.$row['remark'].'">
           <label for="exampleFormControlTextarea1"> Delivery Status</label>
           <select id="status" name="status" class="form-control">
           '.$delivery.'
           </select>
           ';  
      }  
      $output .= '  
      </div>  
      ';  
      echo $output;  
 }  
}


if(isset($_POST["order_id_view"]))  
 {  
   
    

    

      $output = '';  
      if($_SESSION['shop_id']=='0'){
        $query = "SELECT * FROM `orders_products` WHERE `order_id` ='".$_POST["order_id_view"]."'";  
    }else{
      $query = "SELECT * FROM `orders_products` WHERE shop_id=".$_SESSION['shop_id']." AND `order_id` ='".$_POST["order_id_view"]."'";  
      }
      $result = mysqli_query($con, $query);  
      $output .= '  
      <div class="bs-example">
          <table class="table">
              <thead>
                  <tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Shop Name</th>
                  </tr>
              </thead>
              ';  
      while($row = mysqli_fetch_array($result))  
      {  
        $shop_query = "SELECT * FROM shops WHERE shop_id=".$row['shop_id'];
        $shop_result = mysqli_query($con, $shop_query);
           $output .= '<tbody>
            <td> '.$row['product_name'].'</td>
            <td> '.$row['quantity'].'</td>';
            while($sho = mysqli_fetch_array($shop_result)){
            $output .= '<td> '.$sho['shop_name'].'</td>';
            }
            $output .= '</tbody>';  
      }  
      $output .= '  
      
      </table>
      </div>  
      ';  
      echo $output;  
 }  

?>