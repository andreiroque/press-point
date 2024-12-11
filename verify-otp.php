<?php
session_start();

include 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate OTP</title>
  <link rel="stylesheet" href="verify-otp.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
  
</head>
<body>
  <?php
    if(isset($_SESSION['email'])){
      $email = $_SESSION['email'];
    
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $otp_code = "";
        
        for($i = 1; $i <= 4; $i++){
          $otp_code .= $_POST[sprintf('code%s',$i)];
        }
        
        $query = "SELECT o.user_id FROM otp o INNER JOIN users u ON u.user_id = o.user_id WHERE u.email='$email' AND o.otp_code='$otp_code'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $_SESSION['id'] = $row['user_id'];
          
          echo '
              <script>
                Swal.fire({
                  title: "Logged in Successfully",
                  icon: "success",
                  text: "You have managed to verify your OTP successfully",
                  confirmButtonText: "ok"
                }).then((result) => {
                  if(result.isConfirmed){
                    window.location="index.php";
                    }
                });
              </script>
                ';
                
          echo '<script>console.log("'.$email.'")</script>';
          echo '<script>console.log("otp: '. $otp_code .'")</script>';
        }
      }
      
    }else{
      echo '
            <script>
            Swal.fire({
              title: "No email found!"
              icon: "warning",
              text: "Please try again",
              confirmButtonText: "ok"
            }).then((result)=>{
              if(result.isConfirmed){
                window.location="sign-in.ph";
              }
            });
            </script>
            ';
    }
  ?>
  <main>
    <div class="otp-container">
      <div class="icon-container">
        <div class="circle">
          <i class='bx bx-check-shield' ></i>
        </div>
      </div>
      <div class="title">
        <p>Enter OTP Code</p>
      </div>
      <div class="otp-codes">
        <form method="POST">
          <div class="input-codes">
            <input type="text" maxlength="1" name="code1" id="code1">
            <input type="text" maxlength="1" name="code2" id="code2">
            <input type="text" maxlength="1" name="code3" id="code3">
            <input type="text" maxlength="1" name="code4" id="code4">
          </div>
          <div class="submit-btn">
            <button type="submit">Verify OTP</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <script>
    
  </script>
</body>
</html>

<?php mysqli_close($conn); ?>