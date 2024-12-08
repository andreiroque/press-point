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
                    <a href="admin-dashboard.php" class="active"><i class='bx bx-desktop'></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="inventory.php"><i class='bx bx-clipboard'></i>
                        <span>Inventory</span></a>
                </li>
                <li>
                    <a href="orders.php"><i class='bx bx-shopping-bag'></i>
                        <span>Orders</span></a>
                </li>
                <li>
                    <a href="products.php"><i class='bx bx-purchase-tag-alt'></i>
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
                        <h1 class="total_products"></h1>
                        <span>Total Products</span>
                    </div>
                    <div>
                        <i class='bx bx-shopping-bag'></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1 class="total_orders"></h1>
                        <span>Total Orders</span>
                    </div>
                    <div>
                        <i class='bx bx-bar-chart-square'></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1 class="pending_orders"></h1>
                        <span>Pending Orders</span>
                    </div>
                    <div>
                        <i class='bx bx-cart-download'></i>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1 class="total_revenue"></h1>
                        <span>Total Revenue</span>
                    </div>
                    <div>
                        <i class="bx bx-money"></i>
                    </div>
                </div>
            </div>

            <div class="recent-grid">
                <label for="table"><h1>Recent Orders</h1></label>
                <table>
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $recent_order_query = "SELECT o.order_id, u.name, o.created_at as order_placed, o.total_price, o.status FROM orders o INNER JOIN users u ON o.user_id = u.user_id ORDER BY o.created_at DESC LIMIT 5;";
                            $recent_order_result = mysqli_query($conn, $recent_order_query);

                            $date = "";
                            

                            if(mysqli_num_rows($recent_order_result) > 0){
                                while($row = mysqli_fetch_assoc($recent_order_result)){
                                    $date = date_create($row['order_placed']);

                                    $formatted_price = number_format($row['total_price'], 2);

                                    echo '
                                        <tr>
                                            <td>'. $row['order_id'] .'</td>
                                            <td>'. $row['name'] .'</td>
                                            <td>'. date_format($date, "F j, Y") .'</td>
                                            <td>₱ '. $formatted_price .'</td>
                                            <td>'. $row['status'] .'</td>
                                        </tr>
                                    ';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
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
            window.location.href = 'logOut.php';
        });

        cancelbutton.addEventListener('click', () => {
            alertbox.classList.remove('show');
            background.classList.remove('show');
        });

        background.addEventListener('click', () => {
            alertbox.classList.remove('show');
            background.classList.remove('show');
        });

        function getTotalProducts(){
            const totalProducts = document.querySelector(".total_products");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "getTotalProducts.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    totalProducts.innerHTML = response.result;
                }
            }
            xhr.send();
        }

        function getTotalOrders(){
            const totalOrders = document.querySelector(".total_orders");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "getTotalOrders.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    totalOrders.innerHTML = response.result;
                }
            }
            xhr.send();
        }

        function getPendingOrders(){
            const pendingOrders = document.querySelector(".pending_orders");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "getPendingOrders.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    pendingOrders.innerHTML = response.result;
                }
            }
            xhr.send();
        }

        function getTotalRevenue(){
            const totalRevenue = document.querySelector(".total_revenue");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "getTotalRevenue.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    totalRevenue.innerHTML = "₱ " + response.result;
                }
            }
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', () => {
            getTotalProducts();
            getTotalOrders();
            getPendingOrders();
            getTotalRevenue();
        });
    </script>

</body>

</html>
<?php mysqli_close($conn); ?>