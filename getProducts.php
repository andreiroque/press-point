<?php

include 'connection.php';


$query = "SELECT picture, name AS product_name, FORMAT(price, 2) AS price FROM products WHERE status='Shown'";

$result = mysqli_query($conn, $query);

$products = [];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $products[] = $row;
  }
}


echo json_encode($products);

mysqli_close($conn);
?>