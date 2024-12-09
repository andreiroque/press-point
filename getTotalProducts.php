<?php

include 'connection.php';


$query = "SELECT COUNT(name) AS total_products FROM products WHERE status='Shown'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  echo json_encode(["status" => "success", "result" => $row['total_products']]);
};


mysqli_close($conn);
?>