<?php
session_start();

include 'connection.php';

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $query = "SELECT name, role FROM users WHERE user_id='$user_id' AND role='Admin'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $role = $row['role'];
    }
}else{
    echo '<script>alert("Please login or sign up first!")</script>';
    echo '<script>window.location="sign-in.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <input type="checkbox" id="navigation-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h1><i class='bx bx-pointer'></i><span>Press Point</span></h1>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="admin-dashboard.html" class="active"><i class='bx bx-desktop'></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="inventory.html"><i class='bx bx-clipboard'></i>
                        <span>Inventory</span></a>
                </li>
                <li>
                    <a href="orders.html"><i class='bx bx-shopping-bag'></i>
                        <span>Orders</span></a>
                </li>
                <li>
                    <a href="products.html"><i class='bx bx-purchase-tag-alt'></i>
                        <span>Products</span></a>
                </li>
                <li>
                    <a id="signout-button"><i class='bx bx-log-out'></i>
                        <span>Sign Out</span></a>
                </li>
                <div class="background"></div>
                <div class="alert-box" id="signout-alert">
                    <div class="icon">
                        <i class='bx bx-help-circle'></i>
                    </div>
                    <p>Are you sure you want to sign out?</p>
                    <div class="buttons">
                        <button id="confirm-signout" class="button">Yes, Sign Out</button>
                        <button id="cancel-signout" class="button">Cancel</button>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h1><label for="navigation-toggle"><i class='bx bx-menu'></i></label>Dashboard</h1>
            <div class="search-wrapper">
                <input type="search" />
                <i class='bx bx-search'></i>
            </div>
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
                        <span>Product Quantity</span>
                    </div>
                    <div>
                        <i class='bx bx-shopping-bag'></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>10</h1>
                        <span>Stock Remaining</span>
                    </div>
                    <div>
                        <i class='bx bx-bar-chart-square'></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>10</h1>
                        <span>Unit Sold</span>
                    </div>
                    <div>
                        <i class='bx bx-cart-download'></i>
                    </div>
                </div>
            </div>

            <div class="recent-grid">
                <table>
                    <thead>
                        <tr>
                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Product Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-category">Linear</td>
                            <td class="product-name">Apex Press</td>
                            <td class="product-sold">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const signoutbutton = document.getElementById('signout-button');
            const alertbox = document.getElementById('signout-alert');
            const background = document.querySelector('.background');
            const confirmbutton = document.getElementById('confirm-signout');
            const cancelbutton = document.getElementById('cancel-signout');

            signoutbutton.addEventListener('click', () => {
                alertbox.classList.add('show');
                background.classList.add('show');
            });

            confirmbutton.addEventListener('click', () => {
                window.location.href = 'sign-in.html';
            });

            cancelbutton.addEventListener('click', () => {
                alertbox.classList.remove('show');
                background.classList.remove('show');
            });

            background.addEventListener('click', () => {
                alertbox.classList.remove('show');
                background.classList.remove('show');
            });
        });
    </script>

</body>

</html>