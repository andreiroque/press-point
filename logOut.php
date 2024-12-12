<?php
session_start();
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
  <link rel="stylesheet" href="logOut.css">
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
</head>
<body>
  <div class="modal" id="delete-modal">
    <div class="modal-content">
      <h1>Sign Out</h1>
      <p>You have signed out successfully!</p>
      <div class="modal-buttons">
        <button id="confirm">Okay</button>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", ()=> {
      const modal = document.querySelector(".modal");
      const confirm = document.querySelector("#confirm");

      modal.style.display = "flex";
      confirm.addEventListener("click", ()=> {
        modal.style.display = "none";
        window.location="sign-in.php";
      });
    });
  </script>
</body>
</html>