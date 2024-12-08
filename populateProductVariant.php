<?php

include 'connection.php';

if(isset($_GET['id'])){
  $product_id = $_GET['id'];
  $query = "SELECT pv.switch_id, s.name AS switch_variant FROM switches s INNER JOIN product_variants pv ON s.switch_id = pv.switch_id WHERE pv.product_id='$product_id'";

  $result = mysqli_query($conn, $query);

  $switch_variant = [];
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $switch_variant[] = $row;
    }
  }

  echo json_encode($switch_variant);

}



mysqli_close($conn);
?>