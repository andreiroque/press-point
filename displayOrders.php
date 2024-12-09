<?php

include 'connection.php';


if(isset($_GET['sort'])){
  $sort = $_GET['sort'] == "oldest" ? "ASC" : "DESC";

  $query = "SELECT o.order_id, GROUP_CONCAT(CONCAT(p.name, ' (Qty: ', c.quantity, ')') SEPARATOR ', ') AS product_details, SUM(c.quantity * p.price) + 150 AS total_price, o.status, o.created_at FROM cart c INNER JOIN products p ON c.product_id = p.product_id INNER JOIN orders o ON c.order_id = o.order_id GROUP BY o.created_at $sort";

  $result = mysqli_query($conn, $query);
  $orders = [];
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $orders [] = $row;
    }
  }

  echo json_encode($orders);
}


mysqli_close($conn);
?>