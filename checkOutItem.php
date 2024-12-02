<?php
session_start();

include 'connection.php';

if(isset($_SESSION['id']) && isset($_GET['total'])){
  $user_id = $_SESSION['id'];
  $total_amount = $_GET['total'];

  
  $query = "INSERT INTO orders(user_id, total_price) VALUES ('$user_id', '$total_amount')";
  if(mysqli_query($conn, $query)){
    $query1 = "UPDATE cart SET status='Checked Out' WHERE user_id='$user_id'";
    if(mysqli_query($conn, $query1)){
      echo json_encode(["status" => "success", "message" => "Successfully updated cart!"]);
    }else{
      echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
  }else{
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
  }
}


mysqli_close($conn);
?>