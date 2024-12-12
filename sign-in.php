<?php 
session_start();

include "connection.php";



if(isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];
  $user_query = "SELECT role FROM users WHERE user_id='$user_id'";
  $user_result = mysqli_query($conn, $user_query);
  if(mysqli_num_rows($user_result) > 0){
    $row = mysqli_fetch_assoc($user_result);
    echo '<script>console.log("'. $row['role'] .'")</script>';
    if($row['role'] == "Admin"){
      echo '<script>window.location="admin-dashboard.php"</script>';
    }else if($row['role'] == "Customer"){
      echo '<script>window.location="user-dashboard.php"</script>';
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sign-in.css" />
    <link rel="icon" href="product-images/press-point-logo.png" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
    />
    <title>Press Point - Sign In</title>
    <script>
        function displayLoginModal(){
          setTimeout(() => {
            
            const modal = document.querySelector("#login-modal");
            const confirm = document.querySelector("#confirm");
    
            modal.style.display = "flex";
            confirm.addEventListener("click", ()=>{
              modal.style.display = "none";
              window.location="index.php";
            });
          }, 100);
        }
        function displayNoAccountModal(){
          setTimeout(() => {
            
            const modal = document.querySelector("#no-account-modal");
            const confirm = document.querySelector("#no-account-modal #confirm");
    
            modal.style.display = "flex";
            confirm.addEventListener("click", ()=>{
              modal.style.display = "none";
            });
          }, 100);
        }
    </script>
  </head>

  <body>
    <?php
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email-address'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='Active'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $_SESSION['id'] = $row['user_id'];
          $_SESSION['role'] = $row['role']; 
          echo '<script>displayLoginModal();</script>';
        }else{
          echo '<script>displayNoAccountModal();</script>';
        }
      }

    ?>
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
            <a href="forgot-password.php">Forgot Password?</a>
          </div>
          <button type="submit" class="sign-in-button">Sign In</button>
        </form>

        <div class="sign-up-container">
          <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
        </div>
      </div>
    </div>
    <div class="modal" id="login-modal">
      <div class="modal-content">
        <h1>Log In</h1>
        <p>You have logged in successfully!</p>
        <div class="modal-buttons">
          <button id="confirm">Okay</button>
        </div>
      </div>
    </div>
    
    <div class="modal" id="no-account-modal">
      <div class="modal-content">
        <h1>Login</h1>
        <p>Wrong email or password, please try again!</p>
        <div class="modal-buttons">
          <button id="confirm">Okay</button>
        </div>
      </div>
    </div>
    
    <script src="press-point.js"></script>
  </body>
</html>

<?php mysqli_close($conn); ?>