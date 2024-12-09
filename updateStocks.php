<?php
include 'connection.php';

$product_id = $_GET['product_id'];
$switch_id = $_GET['switch_id'];
$quantity = $_GET['quantity'];

$checkQuery = "SELECT stock FROM product_variants WHERE product_id = '$product_id' AND switch_id = '$switch_id'";
$result = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $newStock = $row['stock'] + $quantity;

    $updateQuery = "UPDATE product_variants SET stock = '$newStock' WHERE product_id = '$product_id' AND switch_id = '$switch_id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(["status" => "success", "message" => "Stock updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update stock."]);
    }
} else {
    $insertQuery = "INSERT INTO product_variants (product_id, switch_id, stock) VALUES ('$product_id', '$switch_id', '$quantity')";
    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(["status" => "success", "message" => "New product variant added and stock updated."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add new product variant."]);
    }
}
?>
