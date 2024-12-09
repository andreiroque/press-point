<?php

include 'connection.php';


if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];


  $query = "UPDATE products SET status='Hidden' WHERE product_id='$product_id'";

  if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message"=> "Product Deleted Successfully!"]);
  }

}



mysqli_close($conn);
?>