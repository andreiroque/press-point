<?php
session_start();

include 'connection.php';

if (isset($_SESSION['id']) && isset($_GET['product_id']) && isset($_GET['switch_name']) && isset($_GET['quantity'])) {
    $prod_id = $_GET['product_id'];
    $switch_name = $_GET['switch_name'];
    $quantity = $_GET['quantity'];
    $user_id = $_SESSION['id'];

    $switch_query = "SELECT s.switch_id, p.stock 
                     FROM product_variants p 
                     INNER JOIN switches s ON p.switch_id = s.switch_id 
                     WHERE s.name = '$switch_name' AND product_id = '$prod_id'";
    $switch_result = mysqli_query($conn, $switch_query);

    if (mysqli_num_rows($switch_result) > 0) {
        $row = mysqli_fetch_assoc($switch_result);
        $switch_id = $row['switch_id'];

        $checkQuery = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$prod_id' AND switch_id = '$switch_id'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $existing = mysqli_fetch_assoc($checkResult);
            $newQuantity = $existing['quantity'] + $quantity;

            $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE user_id = '$user_id' AND product_id = '$prod_id' AND switch_id = '$switch_id'";
            if (mysqli_query($conn, $updateQuery)) {
                echo json_encode(["status" => "success", "message" => "Quantity updated successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
            }
        } else {
            $insertQuery = "INSERT INTO cart (user_id, product_id, switch_id, quantity) 
                            VALUES ('$user_id', '$prod_id', '$switch_id', '$quantity')";
            if (mysqli_query($conn, $insertQuery)) {
                echo json_encode(["status" => "success", "message" => "Added to cart successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
            }
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid product or switch."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

mysqli_close($conn);
?>
