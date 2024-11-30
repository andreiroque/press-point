<?php
session_start();


include 'connection.php';


if(isset($_GET['product_id'])  && isset($_SESSION['id']) && isset($_GET['quantity'])){
  $product_id = $_GET['product_id'];
  $user_id = $_SESSION['id'];
  $quantity = $_GET['quantity'];

  $query = "UPDATE cart SET quantity='$quantity' WHERE user_id='$user_id' AND product_id='$product_id'";

  if(mysqli_query($conn, $query)){
    echo "Quantity updated Successfully!";
  }else{
    echo mysqli_error($conn);
  }
}



mysqli_close($conn);
?>