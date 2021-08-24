<?php
header("Content-type: application/json; charset=utf-8");
include '../conndb.php';
//$query = "SELECT products.product_name, products.product_price, products.product_cat, product_category.cat_name FROM products, product_category WHERE products.product_cat_id = product_category.cat_id";
$query = "SELECT * FROM `shops`";
$result = mysqli_query($con, $query);
$rows = array();
$shops = array();

while($row = mysqli_fetch_assoc($result)){
    $shopID = $row['shop_id'];
    $shopName = $row['shop_name'];
    $shopImage = $row['shop_image'];

     $reqCateogry = "SELECT * FROM `product_category` WHERE shop_id = '".$shopID."'";
     $reqCateogry = mysqli_query($con, $reqCateogry);

     $catNames = array();
     while($catNamess = mysqli_fetch_assoc($reqCateogry)){
         $cat_id = $catNamess['cat_id'];
         $cat_name = $catNamess['cat_name'];
         $shop_id = $catNamess['shop_id'];
         $cat_image = $catNamess['cat_image'];

         $reqProduct = "SELECT * FROM `products` WHERE product_cat_id = '".$cat_id."'";
         $reqProduct = mysqli_query($con, $reqProduct);
         $productNames = array();
         while($productName = mysqli_fetch_assoc($reqProduct)){
             $productNames[] = $productName;
         }


        $catNames[] = array('cat_id'=>$cat_id, 'cat_name'=>$cat_name,'shop_id'=>$shop_id,'cat_image'=>$cat_image,'products'=>$productNames);

    }

     $shops[] = array('shop_id'=>$shopID, 'shop_name'=>$shopName,'shop_image'=>$shopImage,'category'=>$catNames);

   

}
//Return result to jTable
$fullar = "{ status: 1, message:'Hello', shops: ".json_encode($shops)." }";
echo $fullar;


?>