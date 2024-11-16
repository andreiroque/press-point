<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "press_point";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
  echo "<script>console.error('Error: ". mysqli_connect_error() ."')</script>";
}else{
  echo "<script>console.log('Successfully Connected!')</script>";
}


?>