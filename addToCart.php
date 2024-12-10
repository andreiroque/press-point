<?php
session_start();

include "connection.php";

if (isset($_GET['product_id']) && isset($_SESSION['id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['id'];
    $quantity = 1;

    $query = "SELECT p.name, p.price, pv.switch_id, pv.stock 
              FROM product_variants pv 
              INNER JOIN products p ON pv.product_id = p.product_id 
              WHERE pv.product_id = $product_id AND pv.stock > 0";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $switch_id = $row['switch_id'];

        $checkQuery = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND switch_id = '$switch_id' AND status='Added'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existing = mysqli_fetch_assoc($checkResult);
            $newQuantity = $existing['quantity'] + $quantity;

            $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE user_id = '$user_id' AND product_id = '$product_id' AND switch_id = '$switch_id' AND status='Added'";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Quantity updated successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $insertQuery = "INSERT INTO cart (user_id, product_id, switch_id, quantity) 
                            VALUES ('$user_id', '$product_id', '$switch_id', '$quantity')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "Added to cart successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Product not found or out of stock.";
    }
}

mysqli_close($conn);
?>
