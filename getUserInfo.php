<?php
session_start();

include 'connection.php';


if(isset($_SESSION['id'])){

  $user_id = $_SESSION['id'];

  $query = "SELECT name, phone_number, address, role FROM users WHERE user_id='$user_id'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $phone_number = $row['phone_number'];
    $address = $row['address'];
    $role = $row['role'];

    echo json_encode(["status" => "success", "name" => $name, "phone_number" => $phone_number, "address" => $address, "role" => $role]);
  }else{
    echo mysqli_error($conn);
  }

}



mysqli_close($conn);
?>