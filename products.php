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
  echo '<script>window.location="index.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="products.css" />
    <link rel="icon" href="product-images/press-point-logo.png" type="image/x-icon">
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
            <a href="inventory.php"
              ><i class="bx bx-clipboard"></i> <span>Inventory</span></a
            >
          </li>
          <li>
            <a href="orders.php"
              ><i class="bx bx-shopping-bag"></i> <span>Orders</span></a
            >
          </li>
          <li>
            <a href="products.php" class="active"
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
              <i class="bx bx-help-circle"></i>
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
            <form method="POST" id="add-product-form" enctype="multipart/form-data">
              <input type="text" placeholder="Product Name" name="product_name" required />
              <input
              type="number"
                placeholder="Product Price"
                min="100"
                name="product_price"
                required
              />
              <input type="file" name="picture" required />
              <input type="text" placeholder="Product Description" name="description" required />
              <button type="submit" id="submit-btn">Add New Product</button>
            </form>
          </div>

          <table>
            <thead>
              <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img
                    src="product-images/apex-press.png"
                    class="product-image"
                  />
                </td>
                <td>Apex Press</td>
                <td>Php 4,500.00</td>
                <td>
                  <button class="edit-button">
                    <i class="bx bx-edit"></i>
                  </button>
                  <button class="delete-button">
                    <i class="bx bx-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>

      <div class="modal" id="edit-modal">
        <div class="modal-content">
          <form id="edit-product-form">
            <input
              type="text"
              id="edit-product-name"
              placeholder="Product Name"
              name="product_name" required
            />
            <input
              type="number"
              id="edit-product-price"
              placeholder="Product Price"
              name="product_price" required
            />
            <input
              type="text"
              id="description"
              placeholder="Product Description"
              name="description" required
              />
            <div class="modal-buttons">
              <button type="submit">Save Changes</button>
              <button type="button" id="cancel-edit">Cancel</button>
            </div>
          </form>
        </div>
      </div>

      <div class="modal" id="delete-modal">
        <div class="modal-content">
          <h1>Confirm Delete</h1>
          <p>Are you sure you want to remove this product?</p>
          <div class="modal-buttons">
            <button id="confirm-delete">Yes, Delete</button>
            <button id="cancel-delete">Cancel</button>
          </div>
        </div>
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

      document
        .querySelector('input[type="number"]')
        .addEventListener("input", function (e) {
          this.value = this.value.replace(/[^0-9.]/g, "");
        });

      function showToast(message, type) {
        const toast = document.createElement("div");
        toast.className = `toast ${type}`;
        toast.textContent = message;

        document.body.appendChild(toast);

        setTimeout(() => {
          toast.classList.add("show");
        }, 100);

        setTimeout(() => {
          toast.classList.remove("show");
          setTimeout(() => {
            toast.remove();
          }, 500);
        }, 5000);
      }


      const form = document.querySelector("#add-product-form");
      form.addEventListener("submit", (e)=>{
        e.preventDefault();
        addNewProduct();
      })
      function addNewProduct(){
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "addNewProducts.php", true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            // console.log(response);
            if(response.status == "success"){
              form.reset();
              showToast(response.message, "success")
              populateTable();
            }
          }
        }
        xhr.send(formData);
      }

      function populateTable(){
        const tableBody = document.querySelector("table tbody");
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "getProducts.php", true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            tableBody.innerHTML = "";
            response.forEach((data) => {
              const row = `
                      <tr>
                        <td><img class="product-image" src="product-images/${data.picture}" alt="picture"></td>
                        <td>${data.product_name}</td>
                        <td>₱ ${data.price}</td>
                        <td>
                          <button class="edit-button">
                            <i class="bx bx-edit"></i>
                          </button>
                          <button class="delete-button">
                            <i class="bx bx-trash"></i>
                          </button>
                        </td>
                      </tr>
              `;
              tableBody.insertAdjacentHTML("beforeend", row)
            })
          }
        }
        xhr.send();
        
      }

      let productId = 0;
      function getProductInfo(name){
        const nameInput = document.querySelector("#edit-product-name");
        const priceInput = document.querySelector("#edit-product-price");
        const imageInput = document.querySelector("#edit-product-image");
        const descriptionInput = document.querySelector("#description");
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "getProductInfo.php?product_name=" + name, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            nameInput.value = response.name;
            priceInput.value = response.price;
            descriptionInput.value = response.description;
            productId = response.product_id;
          }
        }
        xhr.send();
      }

      document.addEventListener("DOMContentLoaded", () => {

        const editButtons = document.querySelectorAll(".edit-button");
        const deleteButtons = document.querySelectorAll(".delete-button");
        const editModal = document.getElementById("edit-modal");
        const deleteModal = document.getElementById("delete-modal");
        const cancelEdit = document.getElementById("cancel-edit");
        const cancelDelete = document.getElementById("cancel-delete");
        const confirmDelete = document.getElementById("confirm-delete");

        editButtons.forEach((button) => {
          button.addEventListener("click", () => {
            editModal.style.display = "flex";
          });
        });

        cancelEdit.addEventListener("click", () => {
          editModal.style.display = "none";
        });

        deleteButtons.forEach((button) => {
          button.addEventListener("click", () => {
            deleteModal.style.display = "flex";
          });
        });

        cancelDelete.addEventListener("click", () => {
          deleteModal.style.display = "none";
        });

        [editModal, deleteModal].forEach((modal) => {
          modal.addEventListener("click", (e) => {
            if (e.target === modal) {
              modal.style.display = "none";
            }
          });
        });

        const saveChangesButton = document.querySelector(
          '#edit-product-form button[type="submit"]'
        );
        const confirmDeleteButton = document.getElementById("confirm-delete");

        

        let orderName = "";

        const tableBody = document.querySelector("table tbody");
        tableBody.addEventListener("click", (event) => {
          if (event.target.closest(".edit-button")) {
            const button = event.target.closest(".edit-button");
            const row = button.closest("tr");
            orderName = row.querySelectorAll("td")[1].textContent; 
            editModal.style.display = "flex";
            getProductInfo(orderName);

          }
          if(event.target.closest(".delete-button")){
            const button = event.target.closest(".delete-button");
            const row = button.closest("tr");
            orderName = row.querySelectorAll("td")[1].textContent;
            deleteModal.style.display = "flex";
            getProductInfo(orderName);
          }
        });

        saveChangesButton.addEventListener("click", (e) => {
          e.preventDefault();
          const nameInput = document.querySelector("#edit-product-name").value;
          const priceInput = document.querySelector("#edit-product-price").value;
          const descriptionInput = document.querySelector("#description").value;
          updateProduct(nameInput, priceInput, descriptionInput);
          document.getElementById("edit-modal").style.display = "none";
        });
        
        confirmDeleteButton.addEventListener("click", () => {
          deleteProduct();
          document.getElementById("delete-modal").style.display = "none";
        });


        populateTable();
      });

      function updateProduct(name, price, description){
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "updateProduct.php?product_id="+ productId +"&name=" + name + "&price=" + price + "&description=" + description, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            if(response.status == "success"){
              populateTable();
              showToast("Changes Saved Successfully!", "success");
            }
          }
        }
        xhr.send();
      }

      function deleteProduct(){
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "deleteProduct.php?product_id=" + productId, true);
        xhr.onload = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            const response = JSON.parse(xhr.responseText);
            console.log(response);
            if(response.status == "success"){
              populateTable();
              showToast(response.message, "error");
            }
          }
        }
        xhr.send();
      }
    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>