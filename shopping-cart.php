<?php
session_start();

if(!isset($_SESSION['id'])){
    echo '<script>alert("Please Login or Sign Up first!")</script>';
    echo '<script>window.location="sign-in.php"</script>';
}


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shopping-cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Shopping Cart</title>
</head>

<body>

    <header>
        <a href="index.php" class="logo"><img src="product-images/press-point-logo.png" alt=""></a>
        <ul class="navigationmenu">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li>
            <li><a href="index.php#shop">Shop</a></li>
        </ul>

        <div class="navigation-icon">
            <a href="#"><i class='bx bx-search'></i></a>
            <a href="sign-in.html"><i class='bx bx-user'></i></a>
            <a href="#"><i class='bx bx-cart'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Summary Total</th>
            </tr>

            <tr>
                <td>
                    <div class="cart-information">
                        <img src="product-images/apex-press.png">
                        <div>
                            <p>Apex Press</p>
                            <p>Php 4,500.00</p>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>Php 4,500.00</td>
            </tr>

            <tr>
                <td>
                    <div class="cart-information">
                        <img src="product-images/drift-press.png">
                        <div>
                            <p>Drift Press</p>
                            <p>Php 4,500.00</p>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>Php 4,500.00</td>
            </tr>

            <tr>
                <td>
                    <div class="cart-information">
                        <img src="product-images/fusion-press.png">
                        <div>
                            <p>Fusion Press</p>
                            <p>Php 4,500.00</p>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>Php 4,500.00</td>
            </tr>
        </table>
    </div>

</body>

</html>