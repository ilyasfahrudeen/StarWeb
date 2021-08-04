<?php


if(isset($_Post['idEditButton'])){
  //  echo "select button clicked and select method should be executed";
    $td1 = $_POST['td_1'];
  //  echo $td1;
    echo '<script type="text/javascript"> alert('.$td1.'); </script>';  // alert message

}
  
?>