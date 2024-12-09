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
    <link rel="stylesheet" href="order-history.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>User Dashboard</title>
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
                    <a href="user-dashboard.php"><i class='bx bx-user-circle'></i>
                        <span>Account Settings</span></a>
                </li>
                <li>
                    <a href="order-history.php" class="active"><i class='bx bx-history' ></i>
                        <span>Order History</span></a>
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
            <div class="user-wrapper">
                <div>
                    <h5><?php echo $name ?></h5>
                    <small><?php echo $role ?></small>
                </div>
            </div>
        </header>
        <main>
            <div class="recent-grid">
                <h1>Order History</h1>
                <table>
                    <thead>
                       <tr>
                          <th>Order ID</th>
                          <th>Products</th>
                          <th>Total Price</th>
                          <th>Status</th>
                       </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query1 = "SELECT o.order_id, GROUP_CONCAT(CONCAT(p.name, ' (Qty: ', c.quantity, ')') SEPARATOR ', ') AS product_details, SUM(c.quantity * p.price) + 150 AS total_price, o.status, o.created_at FROM cart c INNER JOIN products p ON c.product_id = p.product_id INNER JOIN orders o ON c.order_id = o.order_id WHERE c.user_id = '$user_id' AND c.status = 'Checked Out' GROUP BY o.order_id, o.status ORDER BY o.created_at DESC;";

                            $result = mysqli_query($conn, $query1);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo'
                                        <tr>
                                            <td>'. $row['order_id'] .'</td>
                                            <td>'. $row['product_details'] .'</td>
                                            <td>₱ '. $row['total_price'] .'</td>
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
        });
    </script>

</body>

</html>

<?php mysqli_close($conn); ?>