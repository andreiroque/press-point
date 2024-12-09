<?php

include 'connection.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_desc = $_POST['description'];


  if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK){
    $file = $_FILES['picture'];
    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_file_name = $product_name . "." . $file_ext;

    $folder_dir = "product-images/";
    $file_path = $folder_dir . $new_file_name;

    if(move_uploaded_file($file['tmp_name'], $file_path)){
      $query = "INSERT INTO products(name, description, price, picture) VALUES ('$product_name','$product_desc','$product_price','$new_file_name')";
      if(mysqli_query($conn, $query)){
        echo json_encode(["status" => "success", "message" => "Product Added Successfully"]);
      }
    }


  }


}



mysqli_close($conn);
?>