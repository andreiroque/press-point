<?php

include 'connection.php';



if(isset($_GET['product_name'])){
  $product_name = $_GET['product_name'];

  $query = "SELECT * FROM products WHERE name='$product_name'";

  $result = mysqli_query($conn, $query);

  $products = [];
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
      
    echo json_encode($row);
    
  }


}




mysqli_close($conn);
?>