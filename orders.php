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
    <link rel="stylesheet" href="orders.css" />
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
            <a href="orders.php" class="active"
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
        <div class="cards">
          <div class="card-single">
            <div>
              <h1>10</h1>
              <span>Total Orders</span>
            </div>
            <div>
              <i class="bx bx-bar-chart-alt"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1>50</h1>
              <span>Pending Orders</span>
            </div>
            <div>
              <i class="bx bx-note"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1>50</h1>
              <span>Shipped Orders</span>
            </div>
            <div>
              <i class="bx bx-package"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1>50</h1>
              <span>Delivered Orders</span>
            </div>
            <div>
              <i class="bx bx-door-open"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1>50</h1>
              <span>Cancelled Orders</span>
            </div>
            <div>
              <i class="bx bx-x-circle"></i>
            </div>
          </div>
        </div>

        <div class="sort-wrapper">
          <label for="sort-date">Arrange By Date:</label>
          <select id="sort-date">
            <option value="latest">Latest to Oldest</option>
            <option value="oldest">Oldest to Latest</option>
          </select>
        </div>

        <div class="recent-grid">
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Products</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date of Purchase</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="order-id">01</td>
                <td class="product">Apex Press</td>
                <td class="quantity">5</td>
                <td class="status">Delivered Order</td>
                <td class="purchase-date">November 30, 2024</td>
                <td>
                  <button class="edit-button">
                    <i class="bx bx-edit"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td class="order-id">02</td>
                <td class="product">Drift Press</td>
                <td class="quantity">5</td>
                <td class="status">Delivered Order</td>
                <td class="purchase-date">November 30, 2024</td>
                <td>
                  <button class="edit-button">
                    <i class="bx bx-edit"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>

      <div class="edit-modal">
        <div class="modal-content">
          <form id="edit-order-form">
            <label for="order-status">Order Status:</label>
            <select id="order-status" name="order-status">
              <option value="Pending Order">Pending Order</option>
              <option value="Shipped Order">Shipped Order</option>
              <option value="Delivered Order">Delivered Order</option>
              <option value="Cancelled Order">Cancelled Order</option>
            </select>
            <div class="modal-buttons">
              <button type="submit" class="button">Save Changes</button>
              <button type="button" class="button close-modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
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
      });

      document.addEventListener("DOMContentLoaded", () => {
        const editButtons = document.querySelectorAll(".edit-button");
        const deleteButtons = document.querySelectorAll(".delete-button");
        const editModal = document.querySelector(".edit-modal");
        const deleteModal = document.querySelector(".delete-modal");
        const closeButtons = document.querySelectorAll(".close-modal");
        const confirmDeleteButton = document.getElementById("confirm-delete");
        let currentOrderRow = null;

        editButtons.forEach((button) => {
          button.addEventListener("click", (e) => {
            currentOrderRow = e.target.closest("tr");
            const currentStatus =
              currentOrderRow.querySelector(".status").textContent;
            document.getElementById("order-status").value = currentStatus;
            editModal.style.display = "flex";
          });
        });

        deleteButtons.forEach((button) => {
          button.addEventListener("click", (e) => {
            currentOrderRow = e.target.closest("tr");
            deleteModal.style.display = "flex";
          });
        });

        closeButtons.forEach((button) => {
          button.addEventListener("click", () => {
            editModal.style.display = "none";
            deleteModal.style.display = "none";
          });
        });

        document
          .getElementById("edit-order-form")
          .addEventListener("submit", (e) => {
            e.preventDefault();
            const newStatus = document.getElementById("order-status").value;
            currentOrderRow.querySelector(".status").textContent = newStatus;
            editModal.style.display = "none";
          });

        confirmDeleteButton.addEventListener("click", () => {
          currentOrderRow.remove();
          deleteModal.style.display = "none";
        });
      });
    </script>
  </body>
</html>

<?php mysqli_close($conn); ?>