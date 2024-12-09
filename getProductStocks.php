<?php

include 'connection.php';


$query = "SELECT p.product_id, p.name as product_name, s.name as switch_name, pv.stock, p.status, p.received_at FROM products p INNER JOIN product_variants pv ON p.product_id = pv.product_id INNER JOIN switches s ON pv.switch_id = s.switch_id WHERE p.status='Shown' ORDER BY p.received_at DESC";

$result = mysqli_query($conn, $query);
$stocks = [];

if(mysqli_num_rows($result) > 0 ){
  while($row = mysqli_fetch_assoc($result)){
    $stocks[] = $row;
  }
}

echo json_encode($stocks);


mysqli_close($conn);
?>