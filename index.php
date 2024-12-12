<?php
session_start();


include "connection.php";

if(isset($_SESSION['id'])){
    echo '<script>console.log("Logged In!")</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
    integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="product-images/press-point-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./press-point.css">
    <title>Press Point</title>
</head>

<body>
    <header>
        <a href="#home" class="logo"><img src="product-images/press-point-logo.png" alt="image"></a>
        <ul class="navigationmenu">
            <li><a href="#home">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#shop">Shop</a></li>
        </ul>

        <div class="navigation-icon">
            <form method="GET" action="#shop">
                <input type="search" name="search" id="search" placeholder="Search products...">
                <button type="submit"><i class='bx bx-search'></i></button>
            </form>
            <a href="sign-in.php"><i class='bx bx-user'></i></a>
            <span class="cart" data-count="0">
                <a href="shopping-cart.php"><i class='bx bx-cart'></i></a>
            </span>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section id="home" class="main-home">
        <div class="main-text">
            <h5>Press Point</h5>
            <h1>The Ultimate Keyboard <br> Experience Awaits</h1>
            <p>November 2024</p>
            <a href="#products" class="main-button">Shop Now <i class='bx bx-right-arrow-alt'></i></a>
        </div>

        <div class="down-arrow">
            <a href="#shop" class="down"><i class='bx bx-down-arrow-alt'></i></a>
        </div>
    </section>

    <section id="products" class="main-products">
        <h1 class="heading">Our Featured Products</h1>
        <div class="wrapper">
            <div class="box">
                <i class='bx bxs-bookmark-heart'></i>
                <h1>Customer's Favorite</h1>
                <p>Explore our selection of customer's favorite from a wide range of products that have
                    earned the admiration and trust of customers, offering a true representation of quality and
                    satisfaction.</p>
                <a href="#shop" class="explore-button">Explore</a>
            </div>
            <div class="box">
                <i class='bx bxs-tree'></i>
                <h1>Holiday Specials</h1>
                <p>Immerse yourself in the holiday spirit and our collection of seasonal offers, festive
                    bundles, showcasing limited time discounts, and thoroughly selected items crafted to bring added joy
                    to your celebrations.</p>
                <a href="#shop" class="explore-button">Explore</a>
            </div>
            <div class="box">
                <i class='bx bxs-shopping-bags'></i>
                <h1>Limited Edition</h1>
                <p>Don't miss out on our highly coveted limited edition items that offer unique designs, available in
                    very limited quantities once they're gone, these exclusive products will never be available again.
                </p>
                <a href="#shop" class="explore-button">Explore</a>
            </div>
            <div class="box">
                <i class='bx bxs-rocket'></i>
                <h1>New Arrival</h1>
                <p>Be the first to shop our newest collection of products, freshly added to our store, featuring
                    cutting-edge designs, and innovative features that are bound to delight and elevate your experience.
                </p>
                <a href="#shop" class="explore-button">Explore</a>
            </div>
            <div class="box">
                <i class='bx bxs-hot'></i>
                <h1>Trending Now</h1>
                <p> Know the hottest products that are capturing everyone's attention, from the latest must-haves to the
                    most talked-about items, all reflecting the current trends that are dominating the market right now.
                </p>
                <a href="#shop" class="explore-button">Explore</a>
            </div>
        </div>
    </section>

    <section id="shop" class="main-shop">
        <div class="product-text">
            <h1>Discover Our Products</h1>
        </div>

        <div class="filter-container">
            <div class="category-head">
                <ul>
                    <a href="index.php#shop">
                        <div class="category-title" id="all">
                        <li>All</li>
                        </div>
                    </a>
                    <a href="index.php?category=Clicky#shop">
                        <div class="category-title" id="compact">
                            <li>Clicky</li>
                        </div>
                    </a>
                    <a href="index.php?category=Linear#shop">
                        <div class="category-title" id="ergonomic">
                            <li>Linear</li>
                        </div>
                    </a>
                    <a href="index.php?category=Tactile#shop">
                        <div class="category-title" id="gaming">
                            <li>Tactile</li>
                        </div>
                    </a>
                    <a href="index.php?category=Optical#shop">
                        <div class="category-title" id="mechanical">
                            <li>Optical</li>
                        </div>
                    </a>
                    <a href="index.php?category=Membrane#shop">
                        <div class="category-title" id="standard">
                            <li>Membrane</li>
                        </div>
                    </a>
                </ul>
            </div>
        </div>

        <div class="product-list">
            <?php


                $query = "SELECT DISTINCT p.product_id,p.name, FORMAT(p.price, 2) AS price, p.picture FROM products p INNER JOIN product_variants pv ON p.product_id = pv.product_id INNER JOIN switches s ON pv.switch_id = s.switch_id  WHERE p.status='Shown' ORDER BY p.product_id ASC";

                if(isset($_GET['category']) && $_GET['category'] != "All"){
                    $category = $_GET['category'];
                    $query = "SELECT DISTINCT p.product_id,p.name, FORMAT(p.price, 2) AS price, p.picture FROM products p INNER JOIN product_variants pv ON p.product_id = pv.product_id INNER JOIN switches s ON pv.switch_id = s.switch_id  WHERE p.status='Shown' AND s.name='$category' ORDER BY p.product_id ASC ";
                }

                if(isset($_GET['search']) && !empty($_GET['search'])){
                    $search = $_GET['search'];
                    $query = "SELECT DISTINCT p.product_id,p.name, FORMAT(p.price, 2) AS price, p.picture FROM products p INNER JOIN product_variants pv ON p.product_id = pv.product_id INNER JOIN switches s ON pv.switch_id = s.switch_id  WHERE p.status='Shown' AND p.name LIKE '%$search%' ORDER BY p.product_id ASC";
                }
                
                
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <div class="row">
                            <div class="img">
                                <img src="product-images/'. $row['picture'] .'" alt="image">
                            </div>
                            <div class="rating">
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                            </div>
                            <div class="price">
                                <h2>'. $row['name'] .'</h2>
                                <p><strong>₱</strong> '. $row['price'] .'</p>
                            </div>
                            <div class="view-icon">
                                <a href="product-description.php?id='. $row['product_id'] .'">
                                    <button class="button-icon">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="add-to-cart">
                                <a onclick="addToCart(this)" data-product-id="'. $row['product_id'] .'">
                                    <button class="button-icon">
                                        <i class="bx bx-plus-circle"></i>
                                    </button>
                                </a>
                            </div>
                        </div>';
                    }
                }else{
                    echo '<p>No products found!</p>';
                }

            ?>
        </div>
    </section>

    <section class="contact">
        <div class="contact-information">
            <div class="first-information">
                <h5>Follow Us</h5>
                <p>150 Dr. Sixto Antonio Avenue, Caniogan </p>
                <p>Pasig City</p>
                <p>0123456789</p>
                <p>press_point@gmail.com</p>
                <div class="social-icon">
                    <a href="#"><i class='bx bxl-discord-alt'></i></a>
                    <a href="#"><i class='bx bxl-facebook-square'></i></a>
                    <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                    <a href="#"><i class='bx bxl-telegram'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                </div>
            </div>

            <div class="second-information">
                <h5>Help Center</h5>
                <p>About Page</p>
                <p>Contact Us</p>
                <p>Product List</p>
                <p>Refund & Return</p>
                <p>Shop Policies</p>    
            </div>

            <div class="third-information">
                <h5>Products</h5>
                <p>Customer's Favorite</p>
                <p>Holiday Specials</p>
                <p>Limited Edition</p>
                <p>New Arrival</p>
                <p>Trending Now</p>
            </div>
        </div>
    </section>
    <div id="toast" class="toast hidden">
      <p>The item is now in your cart!</p>
    </div>
    <script>
        
        const addToCart = (anchor) => {
            const product_id = anchor.getAttribute("data-product-id");

            const xhr = new XMLHttpRequest();

            xhr.open("GET", "addToCart.php?product_id=" + product_id, true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    console.log(xhr.responseText);
                    checkCart();
                    // Implement the icon notification thingy.
                    const toast = document.getElementById("toast");
                    toast.classList.remove("hidden");
                    toast.classList.add("show");
                    setTimeout(() => {
                    toast.classList.remove("show");
                    toast.classList.add("hidden");
                    }, 5000);
                }
            }
            xhr.send();
        }

        function checkCart() {
            const xhr = new XMLHttpRequest();

            xhr.open("GET", "checkCart.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    console.log(xhr.responseText);
                    const cart = document.querySelector(".cart");

                    cart.setAttribute("data-count", xhr.responseText);
                }
            }
            xhr.send();
        }

        window.addEventListener("DOMContentLoaded", ()=> {
            checkCart();
        })

    </script>
    <script src="press-point.js"></script>
</body>

</html>

<?php mysqli_close($conn); ?>