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
      $query2 = "SELECT o.order_id, p.product_id, s.switch_id, c.quantity, p.price FROM cart c INNER JOIN products p ON c.product_id = p.product_id INNER JOIN orders o ON c.user_id = o.user_id INNER JOIN switches s ON c.switch_id = s.switch_id WHERE c.user_id='$user_id'";
      $result = mysqli_query($conn, $query2);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $order_id = $row['order_id'];
          $product_id = $row['product_id'];
          $switch_id = $row['switch_id'];
          $quantity = $row['quantity'];
          $price = $row['price'];

          $query3 = "INSERT INTO order_items(order_id, product_id, switch_id, quantity, price) VALUES('$order_id', '$product_id', '$switch_id', '$quantity', '$price')";
          if(mysqli_query($conn, $query3)){
            $query4 = "UPDATE product_variants SET stock = stock - $quantity WHERE product_id ='$product_id' AND switch_id='$switch_id' AND stock >= $quantity";

            if(!mysqli_query($conn, $query4)){
              echo json_encode(["status" => "error", "message" => "Failed to update stock: " . mysqli_error($conn)]);
            }

          }else {
            echo json_encode(["status" => "error", "message" => "Failed to insert items: " . mysqli_error($conn)]);
          }
        }
        echo json_encode(["status" => "success", "message" => "Order saved successfully!"]);
      }
    }else{
      echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
  }else{
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
  }
}


mysqli_close($conn);
?>