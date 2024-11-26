<?php
session_start();


if(!isset($_SESSION['id'])){
  echo '<script>alert("Please Login or Sign Up first!")</script>';
  echo '<script>window.location="sign-in.php"</script>';
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="order-confirmation.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
      integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <title>Order Confirmation</title>
  </head>

  <body>
    <div class="container">
      <div class="header">
        <i class="bx bxs-check-circle"></i>
        <h1>Order Confirmed!</h1>
        <p>
          Your order is now in our system and is currently being efficiently
          prepared for shipment.
        </p>
      </div>

      <div class="order-summary">
        <h1>Order Summary</h1>
        <p>
          <strong>Order ID:</strong> <span class="information">#12345</span>
        </p>
        <p>
          <strong>Item Name:</strong>
          <span class="information">Apex Press</span>
        </p>
        <p><strong>Quantity:</strong> <span class="information">1</span></p>
        <p>
          <strong>Shipping Option:</strong>
          <span class="information">Express Shipping</span>
        </p>
        <p>
          <strong>Payment Method:</strong>
          <span class="information">Online Banking</span>
        </p>
      </div>

      <div class="actions">
        <a href="/track-order" class="track-order">Order Status</a>
        <a href="index.php">Continue Shopping</a>
      </div>
    </div>
  </body>
</html>
