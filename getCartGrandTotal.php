<?php
session_start();


include 'connection.php';

if(isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];

  $query = "SELECT SUM(p.price * c.quantity) as grand_total FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id' AND c.status='Added'";

  $grand_total = [];
  if($result = mysqli_query($conn, $query)){
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row['grand_total']);
  }

}




?>