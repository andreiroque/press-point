<?php
session_start();

if(!isset($_SESSION['username'])){
  header("Location: sign-in.php");
}

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="product-description.css" />
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
    <title>Product Description</title>
  </head>

  <body>
    <div class="back-button-container">
      <a href="index.php" class="back-button"
        ><i class="fa fa-arrow-left"></i> Back</a
      >
    </div>

    <div class="container">
      <div class="image-section">
        <img src="product-images/apex-press.png" />
      </div>

      <div class="details-section">
        <h1>Apex Press</h1>
        <i class="bx bxs-star"></i>
        <i class="bx bxs-star"></i>
        <i class="bx bxs-star"></i>
        <i class="bx bxs-star"></i>
        <i class="bx bxs-star"></i>
        <p class="price">5,050.00</p>
        <p class="product-information">
          Apex Press features a durable aluminum frame and measures 440 x 140 x
          40 mm alongside 105 keys that use various switch types for highly
          customizable performance, has a silent sound profile, and it supports
          both corded and cordless modes.
        </p>

        <div class="options">
          <label for="switch">Switch Type:</label>
          <select id="switch">
            <option value="Clicky Switch">Clicky Switch</option>
            <option value="Hybrid Switch">Hybrid Switch</option>
            <option value="Membrane Switch">Membrane Switch</option>
            <option value="Optical Switch">Optical Switch</option>
            <option value="Tactile Switch">Tactile Switch</option>
          </select>
        </div>

        <div class="options">
          <label for="quantity">Quantity:</label>
          <div class="quantity-wrapper">
            <button id="decrease">-</button>
            <input type="text" id="quantity" value="1" />
            <button id="increase">+</button>
          </div>
        </div>

        <div class="actions">
          <a href="" class="add-to-cart"
            ><i class="bx bx-cart"></i> Add to Cart</a
          >
          <a href="check-out.html" class="buy-now"
            ><i class="bx bx-shopping-bag"></i> Buy Now</a
          >
        </div>
      </div>
    </div>

    <div id="toast" class="toast hidden">
      <p>The item is now in your cart!</p>
    </div>

    <script>
      const quantityinput = document.getElementById("quantity");
      const decrease = document.getElementById("decrease");
      const increase = document.getElementById("increase");

      decrease.addEventListener("click", () => {
        let currentValue = parseInt(quantityinput.value) || 1;
        if (currentValue > 1) {
          quantityinput.value = currentValue - 1;
        }
      });

      increase.addEventListener("click", () => {
        let currentValue = parseInt(quantityinput.value) || 1;
        quantityinput.value = currentValue + 1;
      });

      document.querySelector(".add-to-cart").addEventListener("click", (e) => {
        e.preventDefault();
        const toast = document.getElementById("toast");
        toast.classList.remove("hidden");
        toast.classList.add("show");
        setTimeout(() => {
          toast.classList.remove("show");
          toast.classList.add("hidden");
        }, 5000);
      });
    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>