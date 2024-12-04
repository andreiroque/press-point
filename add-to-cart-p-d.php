<?php
session_start();

include 'connection.php';


if(isset($_SESSION['id']) && isset($_GET['product_id']) && isset($_GET['switch_name']) && isset($_GET['quantity'])){
  $prod_id = $_GET['product_id'];
  $switch_name = $_GET['switch_name'];
  $quantity = $_GET['quantity'];
  $user_id = $_SESSION['id'];
  

  $switch_query = "SELECT s.switch_id, p.stock FROM product_variants p INNER JOIN switches s ON p.switch_id = s.switch_id WHERE s.name  ='$switch_name' AND product_id='$prod_id'";

  $switch_result = mysqli_query($conn, $switch_query);
  if(mysqli_num_rows($switch_result) > 0){
    $row = mysqli_fetch_assoc($switch_result);
    $switch_id = $row['switch_id'];
    $stock = $row['stock'];

    $query = "INSERT INTO cart(user_id, product_id, switch_id, quantity) VALUES('$user_id', '$prod_id', '$switch_id', '$quantity')";

    if(mysqli_query($conn, $query)){
      echo json_encode(["status" => "success", "message" => "Successfully added to cart!"]);
    }
  }
}else{
  echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);
?>