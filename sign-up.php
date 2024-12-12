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
    <link rel="icon" href="product-images/press-point-logo.png" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
    />
    <title>Press Point - Sign Up</title>
    <script>
      function displaySignUpModal(){
          setTimeout(() => {
            
            const modal = document.querySelector("#sign-up-modal");
            const confirm = document.querySelector("#confirm");
    
            modal.style.display = "flex";
            confirm.addEventListener("click", ()=>{
              modal.style.display = "none";
              window.location="sign-in.php";
            });
          }, 100);
        }
    </script>
  </head>

  <body>
    <?php
      if($_SERVER['REQUEST_METHOD'] == "POST"){

        $name = $_POST['name'];
        $email = $_POST['email-address'];
        $password = $_POST['password'];
      
        $query = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";
        
        if(mysqli_query($conn, $query)){
          echo '<script>displaySignUpModal()</script>';
        }else{
          echo '<script>alert("Error: '. mysqli_error($conn) .'")</script>';
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

    <div class="wrapper">
      <div class="container">
        <div class="left">
          <img src="product-images/press-point-logo-style.png" />
        </div>
        <div class="right">
          <h1>Sign Up</h1>
          <form method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" required />
            </div>
            <div class="form-group">
              <label for="email-address">Email Address</label>
              <input type="email" id="email-address" name="email-address" required />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm Password</label>
              <input type="password" id="confirm-password" />
            </div>
            <div class="actions">
              <label><input type="checkbox" onclick="showHidePassword()"/> Show Password</label>
            </div>
            <button type="submit" class="sign-in-button">Sign Up</button>
          </form>
          <div class="sign-up-container">
            <p>Already have an account? <a href="sign-in.php">Sign In</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="sign-up-modal">
      <div class="modal-content">
        <h1>Sign up</h1>
        <p>You have created an account successfully!</p>
        <div class="modal-buttons">
          <button id="confirm">Okay</button>
        </div>
      </div>
    </div>

    <div class="modal" id="no-account-modal">
      <div class="modal-content">
        <h1>Sign up</h1>
        <p>Passwords does not match! please try again</p>
        <div class="modal-buttons">
          <button id="confirm">Okay</button>
        </div>
      </div>
    </div>
    <script>
      const form = document.querySelector("form");
      form.addEventListener("submit", (e)=>{
        e.preventDefault();
        const password = document.querySelector("#password").value;
        const confirmPassword = document.querySelector("#confirm-password").value;
        if(password != confirmPassword){
          setTimeout(() => {
            
            const modal = document.querySelector("#no-account-modal");
            const confirm = document.querySelector("#no-account-modal #confirm");
    
            modal.style.display = "flex";
            confirm.addEventListener("click", ()=>{
              modal.style.display = "none";
            });
          }, 100);
        }else{
          form.submit();
        }
      });
      
      function showHidePassword(){
        const password = document.querySelector("#password");
        const confirmPassword = document.querySelector("#confirm-password");
        if(password.type === "password" && confirmPassword.type === "password"){
          password.type = "text";
          confirmPassword.type = "text";
        }else{
          password.type = "password";
          confirmPassword.type = "password";
        }
      }
    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>