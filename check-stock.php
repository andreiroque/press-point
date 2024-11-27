<?php

include 'connection.php';


if(isset($_GET['product_id']) && isset($_GET['switch_name'])){
  $product_id = $_GET['product_id'];
  $switch_name = $_GET['switch_name'];

  $query = "SELECT pv.stock FROM product_variants pv INNER JOIN switches s ON pv.switch_id = s.switch_id WHERE pv.product_id='$product_id' AND s.name ='$switch_name'";

  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    echo "<h1>Available Stock: ". $row['stock'] ."</h1>";
  }

}


?>