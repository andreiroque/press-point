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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
  <script>
    function sendMail(email){
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "sendOtp.php?email=" + email, true);
      xhr.onload = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          const response = JSON.parse(xhr.responseText);
          console.log(response);
          if(response.status == "success"){
            Swal.fire({
              title: `${response.message}`,
              text: "We've sent the OTP code in your email, kindly check your inbox.",
              icon: "success",
              confirmButtonText: "Ok"
            }).then((result)=> {
              if(result.isConfirmed){
                window.location="verify-otp.php";
              }
            })
          }else if(response.status == "error"){
            console.log(response.message);
          }
        }
      }
      xhr.send();
    }
  </script>
</head>
<body>
  <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email = $_POST['email-address'];

      $query = "SELECT * FROM users WHERE email='$email'";

      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        $email = $row['email'];

        $_SESSION['email'] = $email;

        echo '<script>sendMail("'. $email .'")</script>';

      }else{
        echo '<script>
                Swal.fire({
                  title: "Email Not Found!",
                  text: "Please create an account first",
                  icon: "warning",
                  confirmButtonText: "Ok"
                }).then((result) => {
                  if(result.isConfirmed){
                    window.location="sign-up.php";
                  }
                });
              </script>';
              session_unset();
              session_destroy();
      }

    }

  ?>
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