<?php

include 'connection.php';


if(isset($_GET['product_id']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['description'])){
  $product_id = $_GET['product_id'];
  $name = $_GET['name'];
  $price = $_GET['price'];
  $desc = $_GET['description'];

  $query = "UPDATE products SET name='$name', description='$desc', price='$price'  WHERE product_id=$product_id";


  if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Product Successfully Updated!"]);
  }
  


}



mysqli_close($conn);
?>