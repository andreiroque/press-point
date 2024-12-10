<?php
session_start();


include 'connection.php';


if(isset($_GET['product_id']) && isset($_GET['switch_name']) && isset($_GET['quantity']) && isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];
  $product_id = $_GET['product_id'];
  $switch_name = $_GET['switch_name'];
  $quantity = $_GET['quantity'];

  $query = "SELECT switch_id FROM switches WHERE name='$switch_name'";

  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $switch_id = $row['switch_id'];

    $cart_query = "INSERT INTO cart(user_id, product_id, switch_id, quantity) VALUES('$user_id', '$product_id', '$switch_id', '$quantity')";
    if(mysqli_query($conn, $cart_query)){
      echo json_encode(["status" => "success", "message" => "Item added to cart Successfully!"]);
    }else{
      echo json_encode(["status" => "error", "message" => "Failed to add item to cart!"]);
    }
    
  }

}




mysqli_close($conn);
?>