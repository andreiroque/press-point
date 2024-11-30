<?php
session_start();


include 'connection.php';

$user_id = $_SESSION['id'];

$query = "SELECT p.product_id, p.price, c.quantity FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE user_id='$user_id'";

$result = mysqli_query($conn, $query);

$summaryTotal = [];

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $product_id = $row['product_id'];
    $summaryTotal[$product_id] = $row['price'] * $row['quantity'];
  }
}

echo json_encode($summaryTotal);


?>