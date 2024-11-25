<?php 
session_start();

include "connection.php";



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sign-up.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
    />
    <title>Press Point - Sign Up</title>
  </head>

  <body>
    <header>
      <a href="index.php" class="logo"
        ><img src="product-images/press-point-logo.png" alt=""
      /></a>
      <ul class="navigationmenu">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#products">Products</a></li>
        <li><a href="index.php#shop">Shop</a></li>
      </ul>
      <div class="navigation-icon">
        <a href="#"><i class="bx bx-search"></i></a>
        <a href="sign-in.html"><i class="bx bx-user"></i></a>
        <a href="shopping-cart.html"><i class="bx bx-cart"></i></a>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>

    <div class="wrapper">
      <div class="container">
        <div class="left">
          <img src="product-images/press-point-logo-style.png" />
        </div>
        <div class="right">
          <h1>Sign Up</h1>
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" required />
            </div>
            <div class="form-group">
              <label for="email-address">Email Address</label>
              <input type="email" id="email-address" required />
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm Password</label>
              <input type="password" id="password" required />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" required />
            </div>
            <div class="actions">
              <label><input type="checkbox" /> Show Password</label>
            </div>
            <button type="submit" class="sign-in-button">Sign Up</button>
          </form>
          <div class="sign-up-container">
            <p>Already have an account? <a href="sign-in.php">Sign In</a></p>
          </div>
        </div>
      </div>
    </div>
    <script src="press-point.js"></script>
  </body>
</html>

<?php mysqli_close($conn); ?>