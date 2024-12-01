<?php
session_start();


include 'connection.php';

if(isset($_GET['product_id']) && isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];
  $product_id = $_GET['product_id'];

  $query = "UPDATE cart SET status ='Removed' WHERE product_id='$product_id' AND user_id='$user_id'";

  if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Item successfully Removed!"]);
  }else{
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
  }
}


mysqli_close($conn);
?>