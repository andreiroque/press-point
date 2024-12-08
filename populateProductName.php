<?php

include 'connection.php';


$query = "SELECT product_id, name AS product_name FROM products";
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