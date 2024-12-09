<?php

include 'connection.php';


$query = "SELECT FORMAT(ROUND(COALESCE(SUM(p.price * oi.quantity) + 150, 0), 2), 2) AS total_revenue FROM  products p INNER JOIN order_items oi ON p.product_id = oi.product_id INNER JOIN orders o ON oi.order_id = o.order_id WHERE o.status = 'Delivered'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  echo json_encode(["status" => "success", "result" => $row['total_revenue']]);
}



mysqli_close($conn);
?>