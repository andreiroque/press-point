<?php

include 'connection.php';


if(isset($_GET['order_id']) && isset($_GET['new_status'])){
  $order_id = $_GET['order_id'];
  $new_status = $_GET['new_status'];

  $query = "UPDATE orders SET status='$new_status' WHERE order_id='$order_id'";

  
  if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Order Successfully Updated!"]);
  }else{
    echo json_encode(["status" => "error", "message" => "Failed updating order!"]);
  }


  
}



mysqli_close($conn);
?>