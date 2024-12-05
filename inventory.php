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
        <div class="search-wrapper">
          <input type="search" />
          <i class="bx bx-search"></i>
        </div>
        <div class="user-wrapper">
          <div>
            <h5>Andrei Marvin Roque</h5>
            <small>Admin</small>
          </div>
        </div>
      </header>

      <main>
        <div class="recent-grid">
          <div class="form-section">
            <form>
              <input type="text" placeholder="Product ID" required />
              <input type="text" placeholder="Product Name" required />
              <input
                type="number"
                placeholder="Product Quantity"
                min="1"
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
    </script>
  </body>
</html>
