<?php

include 'connection.php';


$query = "SELECT FORMAT(COALESCE(SUM(total_price), 0), 2) AS total_revenue FROM orders WHERE status='Delivered';";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  echo json_encode(["status" => "success", "result" => $row['total_revenue']]);
}



mysqli_close($conn);
?>