<?php

include 'connection.php';


$query = "SELECT * from switches";

$result = mysqli_query($conn, $query);

$switches = [];

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $switches[] = $row;
  }
  echo json_encode($switches);
}



mysqli_close($conn);
?>