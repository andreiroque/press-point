<?php

include 'connection.php';


if(isset($_GET['product_id']) && isset($_GET['switch_id']) && isset($_GET['quantity'])){
  $product_id = $_GET['product_id'];
  $switch_id = $_GET['switch_id'];
  $quantity = $_GET['quantity'];

  $query = "UPDATE product_variants SET stock = stock + $quantity WHERE product_id='$product_id' AND switch_id='$switch_id'";

  if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Successfully updated stocks!"]);
  }else{
    echo json_encode(["status" => "error", "message" => "Failed to update stocks!"]);
  }

}


mysqli_close($conn);
?>