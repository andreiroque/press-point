<?php
session_start();

if(!isset($_SESSION['id'])){
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
      <a href="index.php#shop" class="back-button"
        ><i class="fa fa-arrow-left"></i> Back</a
      >
    </div>

    <?php
      
      if(isset($_GET['id'])){
        $prodId = $_GET['id'];
        $_SESSION['prod_id'] = $prodId;
      }else if(isset($_SESSION['prod_id'])){
        $prodId = $_SESSION['prod_id'];
      }else{
        echo '<script>alert("Please choose a product first!")</script>';
        echo '<script>window.location="index.php"</script>';
      }

      $query1 = "SELECT * FROM products WHERE product_id='$prodId'";
      $result1 = mysqli_query($conn, $query1);


      $query2 = "SELECT s.name AS switch_name, pv.stock FROM product_variants pv INNER JOIN switches s ON pv.switch_id = s.switch_id WHERE pv.product_id='$prodId' AND pv.stock > 0";

      $result2 = mysqli_query($conn, $query2);
      $stock = 0;


      if(mysqli_num_rows($result1) > 0){
        while($row1 = mysqli_fetch_assoc($result1)){
          echo '
          <div class="container">
            <div class="image-section">
              <img src="product-images/'. $row1['picture'] .'" alt="image">
            </div>
            <div class="details-section">
              <h1>'. $row1['name'] .'</h1>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <p class="price">₱ '. $row1['price'] .'</p>
              <p class="product-information">'. $row1['description'] .'</p>
              <div class="options">
                <label for="switch">Switch Type:</label>
                <select id="switch" onchange="checkSlot(this)" data-product-id="'. $prodId .'">
                  ';
                  if(mysqli_num_rows($result2) > 0){
                    while($row2 = mysqli_fetch_assoc($result2)){
                      $stock = $row2['stock'];
                      echo '<option value="'. $row2['switch_name'] .'">'. $row2['switch_name'] .'</option>';
                    }
                  }
                  echo'
                </select>
              </div>
              <div class="options">
                <label for="quantity">Quantity:</label>
                <div class="quantity-wrapper">
                  <button id="decrease">-</button>
                  <input type="text" id="quantity" value="1" disabled>
                  <button id="increase">+</button>
                </div>
              </div>
              <div>
                  <h2 class="result"></h2>
              </div>
              <div class="actions">
                <a href="" class="add-to-cart"
                  ><i class="bx bx-cart"></i> Add to Cart</a
                >
                <a href="check-out.php" class="buy-now"
                  ><i class="bx bx-shopping-bag"></i> Buy Now</a
                >
            </div>
            </div>
          </div>
          ';
        }
      }
    ?>

    <div id="toast" class="toast hidden">
      <p>The item is now in your cart!</p>
    </div>

    <script>
      const quantityinput = document.getElementById("quantity");
      const decrease = document.getElementById("decrease");
      const increase = document.getElementById("increase");
      let maxStock = 1;
      
      const checkSlot = (select) => {
        quantityinput.value = 1;
        const productId = select.getAttribute("data-product-id");
        const xhr = new XMLHttpRequest();

        xhr.open("GET", "check-stock.php?product_id="+ productId + "&switch_name=" + select.value, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            maxStock = xhr.responseText;
            document.querySelector(".result").innerHTML = "Available Stock: " + xhr.responseText;
          }
        }
        xhr.send();
      }

      document.addEventListener("DOMContentLoaded", ()=> {
        const select = document.querySelector("#switch");
        checkSlot(select);
      });

      decrease.addEventListener("click", () => {
        let currentValue = parseInt(quantityinput.value) || 1;
        if (currentValue > 1) {
          quantityinput.value = currentValue - 1;
        }
      });

      increase.addEventListener("click", () => {
        let currentValue = parseInt(quantityinput.value) || 1;
        if(currentValue < maxStock){
          quantityinput.value = currentValue + 1;
        }
      });

      document.querySelector(".add-to-cart").addEventListener("click", (e) => {
        e.preventDefault();
        const switch_name = document.querySelector("#switch");
        const product_id = switch_name.getAttribute("data-product-id");
        const quantity = document.querySelector("#quantity");

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "add-to-cart-p-d.php?product_id=" + product_id + "&switch_name=" + switch_name.value + "&quantity=" + quantity.value, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            if(response.status == "success"){
              const toast = document.getElementById("toast");
              toast.classList.remove("hidden");
              toast.classList.add("show");
              setTimeout(() => {
                toast.classList.remove("show");
                toast.classList.add("hidden");
              }, 5000);
              
            }
          }
        }
        xhr.send();

      });



      document.querySelector(".buy-now").addEventListener("click", (e) => {
        e.preventDefault();
        const switch_name = document.querySelector("#switch");
        const product_id = switch_name.getAttribute("data-product-id");
        const quantity = document.querySelector("#quantity");

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "buyNow.php?product_id=" + product_id + "&switch_name=" + switch_name.value + "&quantity=" + quantity.value, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            console.log(response);
            if(response.status == "success"){
              window.location = "shopping-cart.php";
            }
            console.log(response);
          }
        }
        xhr.send();
      });


    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>