<?php
session_start();

include 'connection.php';

if(isset($_SESSION['id'])){
  $user_id = $_SESSION['id'];
  $query = "SELECT name, role FROM users WHERE user_id='$user_id'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $role = $row['role'];
    if($role != "Admin"){
      echo '<script>alert("You do not have permission to view this page.")</script>';
      echo '<script>window.location="index.php"</script>';
    }
  }
}else{
  echo '<script>alert("Please login or sign up first!")</script>';
  echo '<script>window.location="sign-in.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="inventory.css" />
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
    <title>Admin Dashboard</title>
  </head>

  <body>
    <input type="checkbox" id="navigation-toggle" />
    <div class="sidebar">
      <div class="sidebar-brand">
        <h1><i class="bx bx-pointer"></i><span>Press Point</span></h1>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="admin-dashboard.php"
              ><i class="bx bx-desktop"></i> <span>Dashboard</span></a
            >
          </li>
          <li>
            <a href="inventory.php" class="active"
              ><i class="bx bx-clipboard"></i> <span>Inventory</span></a
            >
          </li>
          <li>
            <a href="orders.php"
              ><i class="bx bx-shopping-bag"></i> <span>Orders</span></a
            >
          </li>
          <li>
            <a href="products.php"
              ><i class="bx bx-purchase-tag-alt"></i> <span>Products</span></a
            >
          </li>
          <li>
            <a id="signout-button"
              ><i class="bx bx-log-out"></i> <span>Sign Out</span></a
            >
          </li>
          <div class="background"></div>
          <div class="alert-box" id="signout-alert">
            <div class="icon">
              <i class="bx bx-question-mark"></i>
            </div>
            <p>Are you sure you want to sign out?</p>
            <div class="buttons">
              <button id="confirm-signout" class="button">
                Yes, Sign Out!
              </button>
              <button id="cancel-signout" class="button">Cancel</button>
            </div>
          </div>
        </ul>
      </div>
    </div>
    <div class="main-content">
      <header>
        <h1>
          <label for="navigation-toggle"><i class="bx bx-menu"></i></label
          >Dashboard
        </h1>
        <!-- <div class="search-wrapper">
          <input type="search" />
          <i class="bx bx-search"></i>
        </div> -->
        <div class="user-wrapper">
          <div>
            <h5><?php echo $name; ?></h5>
            <small><?php echo $role; ?></small>
          </div>
        </div>
      </header>

      <main>
        <div class="recent-grid">
          <div class="form-section">
            <form id="form">
              <div class="options">
                <label for="select">Product Name:</label>
                <select name="product_name" id="product_name" required></select>
              </div>
              <div class="options">
                <label for="select">Product Variant:</label>
                <select name="product_variants" id="product_variants" required>
                </select>
              </div>
              <input
                type="number"
                placeholder="Product Quantity"
                min="1"
                name="product_quantity"
                id="product_quantity"
                required
              />
              <button type="submit">Add New Stocks</button>
            </form>
          </div>

          <table>
            <thead>
              <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Variant</th>
                <th>Product Quantity</th>
                <th>Product Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="order-id">01</td>
                <td class="name">Apex Press</td>
                <td class="quantity">500</td>
                <td class="status">Available</td>
              </tr>
              <tr>
                <td class="order-id">02</td>
                <td class="name">Drift Press</td>
                <td class="quantity">500</td>
                <td class="status">Available</td>
              </tr>
              <tr>
                <td class="order-id">03</td>
                <td class="name">Fusion Press</td>
                <td class="quantity">500</td>
                <td class="status">Available</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
      
      <div id="toast" class="toast hidden">
        <p class="message"></p>
      </div>
    </div>

    <script>
        const signoutbutton = document.getElementById("signout-button");
        const alertbox = document.getElementById("signout-alert");
        const background = document.querySelector(".background");
        const confirmbutton = document.getElementById("confirm-signout");
        const cancelbutton = document.getElementById("cancel-signout");

        signoutbutton.addEventListener("click", () => {
          alertbox.classList.add("show");
          background.classList.add("show");
        });

        confirmbutton.addEventListener("click", () => {
          window.location.href = "logOut.php";
        });

        cancelbutton.addEventListener("click", () => {
          alertbox.classList.remove("show");
          background.classList.remove("show");
        });

        background.addEventListener("click", () => {
          alertbox.classList.remove("show");
          background.classList.remove("show");
        });

        function populateProductName(){
          const productDropdown = document.querySelector("#product_name");
          const xhr = new XMLHttpRequest();
          xhr.open("GET", "populateProductName.php", true);
          xhr.onload = function(){
            const response = JSON.parse(xhr.responseText);
            response.forEach((product) => {
              const option = document.createElement("option");
              option.value = product.product_id;
              option.textContent = product.product_name;
              productDropdown.appendChild(option);
            });
          }
          xhr.send();
        }

        function populateProductVariant(productId){
          const switchVariant = document.querySelector("#product_variants");
          const xhr = new XMLHttpRequest();
          xhr.open("GET", "populateProductVariant.php?id=" + productId, true);//not quite sure how to handle passing product_id
          xhr.onload = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
              const response = JSON.parse(xhr.responseText);
              switchVariant.innerHTML = ''

              response.forEach((variant) => {
                const option = document.createElement("option");
                option.value = variant.switch_id;
                option.textContent = variant.switch_variant;
                switchVariant.appendChild(option);
              });
            }
          }
          xhr.send();
        }

        function getProductStocks(){
          const xhr = new XMLHttpRequest();
          xhr.open("GET", "getProductStocks.php", true);
          xhr.onload = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
              const response = JSON.parse(xhr.responseText);
              console.log(response);
            }
          }
          xhr.send();
        }

        function updateStocks(productId,switchId,quantity){
          const xhr = new XMLHttpRequest();
          xhr.open("GET", "updateStocks.php?product_id=" + productId + "&switch_id=" + switchId + "&quantity=" + quantity, true);
          xhr.onload = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
              const response = JSON.parse(xhr.responseText);
              if(response.status == "success"){
                const message = document.querySelector(".message");
                message.innerHTML = response.message;
                const toast = document.getElementById("toast");
                toast.classList.remove("hidden");
                toast.classList.add("show");
                setTimeout(() => {
                toast.classList.remove("show");
                toast.classList.add("hidden");
                }, 5000);
                document.querySelector("#product_quantity").value = "";
                populateStockTable();
              }
            }
          }
          xhr.send();
        }
        
        function populateStockTable(){
          const tableBody = document.querySelector("table tbody");
          const xhr = new XMLHttpRequest();
          xhr.open("GET", "getProductStocks.php", true);
          xhr.onload = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
              const response = JSON.parse(xhr.responseText);
              tableBody.innerHTML = "";
              response.forEach((data) => {
                const row = `
                    <tr>
                      <td>${data.product_id}</td>
                      <td>${data.product_name}</td>
                      <td>${data.switch_name}</td>
                      <td>${data.stock}</td>
                      <td>${data.status}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML("beforeend", row);
              });
            }
          }
          xhr.send();
        }

      document.querySelector("#product_name").addEventListener("change", function() {
        const productId = this.value;
        if(productId){
          populateProductVariant(productId);
        }else{
          const variantDropdown = document.querySelector("#product_variants");
          variantDropdown.innerHTML = '';
        }
      });

      document.querySelector("#form").addEventListener("submit", (e)=> {
        e.preventDefault();
        const productId = document.querySelector("#product_name").value;
        const switchId = document.querySelector("#product_variants").value;
        const quantity = document.querySelector("#product_quantity").value;
        updateStocks(productId,switchId,quantity);
      })

      document.addEventListener("DOMContentLoaded", () => {
        populateProductName();
        setTimeout(() => {
          const productId = document.querySelector("#product_name").value;
          if(productId){
            populateProductVariant(productId);
          }else{
            const variantDropdown = document.querySelector("#product_variants");
            variantDropdown.innerHTML = '';
          }
        }, 100);
        populateStockTable();
      });
    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>