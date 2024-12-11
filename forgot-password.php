<?php
session_start();

include 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="forgot-password.css">
  <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
  />
</head>
<body>
  <main>
    <div class="form-container">
      <form class="form" method="post">
        <div class="form-group">
          <label for="email-address">Email Address</label>
          <input type="email" id="email-address" name="email-address" required />
          <i class="bx bx-user"></i>
        </div>
        <button type="submit" class="sign-in-button">Enter email</button>
      </form>
    </div>
  </main>
</body>
</html>

<?php mysqli_close($conn); ?>