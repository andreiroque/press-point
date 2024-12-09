<?php
include 'connection.php';

if (isset($_GET['product_id']) && isset($_GET['switch_id']) && isset($_GET['quantity'])) {
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
            $query1 = "UPDATE products SET received_at = CURRENT_TIMESTAMP() WHERE product_id = '$product_id'";
            if (mysqli_query($conn, $query1)) {
                echo json_encode(["status" => "success", "message" => "Stock updated successfully and received_at updated!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update received_at"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update stock!"]);
        }
    } else {
        $insertQuery = "INSERT INTO product_variants (product_id, switch_id, stock) VALUES ('$product_id', '$switch_id', '$quantity')";
        if (mysqli_query($conn, $insertQuery)) {
            $query1 = "UPDATE products SET received_at = CURRENT_TIMESTAMP() WHERE product_id = '$product_id'";
            if (mysqli_query($conn, $query1)) {
                echo json_encode(["status" => "success", "message" => "New product variant added, stock updated, and received_at updated!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update received_at"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add new product variant."]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input data."]);
}

mysqli_close($conn);
?>
