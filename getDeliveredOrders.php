<?php

include 'connection.php';


$query = "SELECT COUNT(order_id) AS delivered_orders FROM orders WHERE status = 'Delivered'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
  echo json_encode(["status" => "success", "result" => $row['delivered_orders']]);
}



mysqli_close($conn);
?>