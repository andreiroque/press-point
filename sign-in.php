<?php 
session_start();

include "connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $email = $_POST['email-address'];
  $password = $_POST['password'];
  
  $query = "SELECT * FROM users WHERE email='$email' and password='$password'";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['user_id'];
    $_SESSION['role'] = $row['role']; 
    echo '<script>alert("Name: '. $row['name'] . " Role: ". $row['role'] . " Status: ". $row['status'] .'")</script>';
    echo '<script>window.location="index.php"</script>';
  }else{
    echo '<script>alert("Wrong email or password, please try again!")</script>';
    echo '<script>window.location="sign-in.php"</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sign-in.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
    />
    <title>Press Point - Sign In</title>
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
        <a href="sign-in.php"><i class="bx bx-user"></i></a>
        <span class="cart" data-count="0">
          <a href="shopping-cart.php"><i class="bx bx-cart"></i></a>
        </span>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>

    <div class="container">
      <div class="left">
        <img src="product-images/press-point-logo-style.png" />
      </div>
      <div class="right">
        <h1>Sign In</h1>
        <form class="form" method="post">
          <div class="form-group">
            <label for="email-address">Email Address</label>
            <input type="email" id="email-address" name="email-address" required />
            <i class="bx bx-user"></i>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
            <i class="bx bx-lock-alt"></i>
          </div>
          <div class="actions">
            <label
              ><input type="checkbox" onclick="showHidePassword()" /> Show
              Password</label
            >
            <a href="#">Forgot Password?</a>
          </div>
          <button type="submit" class="sign-in-button">Sign In</button>
        </form>

        <div class="sign-up-container">
          <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
        </div>
      </div>
    </div>
    <script src="press-point.js"></script>
  </body>
</html>

<?php mysqli_close($conn); ?>