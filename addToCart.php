<?php

include "connection.php";


if(isset($_GET['product_id']) && isset($_GET['user_id'])){
  $product_id = $_GET['product_id'];
  $user_id = $_GET['user_id'];
  $quantity = 1;

  $query = "SELECT p.name, p.price, pv.switch_id, pv.stock FROM product_variants pv INNER JOIN products p ON pv.product_id = p.product_id WHERE pv.product_id=$product_id AND pv.stock > 0";

  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    echo $user_id . "\n";
    echo $row['name'] . "\n";
    echo $row['price'] . "\n";
    echo $row['switch_id'] . "\n";
    echo $quantity . "\n";

    $switch_id = $row['switch_id'];
  

    $query1 = "INSERT INTO cart(user_id, product_id, switch_id, quantity) VALUES ('$user_id', '$product_id', '$switch_id', '$quantity')";

    if($result1 = mysqli_query($conn, $query1)){
      echo "Added to cart Successfully!";
    }
  }
}


?>