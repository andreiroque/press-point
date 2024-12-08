<?php

include 'connection.php';


$query = "SELECT COUNT(status) AS pending_orders FROM orders WHERE status='Pending'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  echo json_encode(["status" => "success", "result" => $row['pending_orders']]);
}



mysqli_close($conn);
?>