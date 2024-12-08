<?php

include 'connection.php';


$query = "SELECT COUNT(order_id) AS shipped_orders FROM orders WHERE status='Shipped'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
  echo json_encode(["status" => "success", "result" => $row['shipped_orders']]);
}



mysqli_close($conn);
?>