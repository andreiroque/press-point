<?php
session_start();

include 'connection.php';


if(isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];
  $query = "SELECT COUNT(*) AS orders FROM cart WHERE cart.user_id ='$user_id' AND cart.status='Added'";

  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    echo $row['orders'];
  }
}else{
  echo 0;
}


mysqli_close($conn);
?>