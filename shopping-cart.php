<?php
session_start();


include 'connection.php';

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
            <a href="sign-in.php"><i class='bx bx-user'></i></a>
            <span class="cart" data-count="0">
                <a href="shopping-cart.php"><i class='bx bx-cart'></i></a>
            </span>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Summary Total</th>
            </tr>

                <?php
                    $user_id = $_SESSION['id'];
                    $query = "SELECT c.product_id, p.name, p.price, p.picture, c.quantity FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id' AND c.status='Added'";

                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                                <tr>
                                    <td>
                                        <div class="cart-information">
                                            <img src="product-images/'. $row['picture'] .'">
                                            <div>
                                                <p>'. $row['name'] .'</p>
                                                <p><strong>₱</strong> '. $row['price'] .'</p>
                                                <br>
                                                <a onclick="removeItemFromCart(this)" data-product-id="'. $row['product_id'] .'">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input type="number" value="'. $row['quantity'] .'" onchange="modifyProdQuantity(this)" data-prod-id="'. $row['product_id'] .'"></td>
                                    <td class="tSummary"></td>
                                </tr>
                            ';
                        }
                    }else{
                        echo '
                        <tr>
                            <td colspan="3" height="500px" style="font-size:2rem; text-align: center;" >Nothing in the cart yet :(</td>
                        </tr>
                        ';
                    }
                ?>
        </table>
        <table>
            <tr>
                <td colspan="3" height="50px"style="text-align: right;" class="action">
                    <h3 class="grand-total"></h3>
                    <a href="check-out.php">Check out</a>
                </td>
            </tr>
        </table>
        <div>
        </div>
    </div>
    <script>

        function removeItemFromCart (anchor){
            const product_id = anchor.getAttribute("data-product-id"); 
            
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "removeItemFromCart.php?product_id=" + product_id, true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if(response.message == "Item successfully Removed!"){
                        // display toast.
                    }
                    checkSummaryTotal();
                    getGrandTotal();
                    getCartNotif();
                }
            }
            xhr.send();
        }

        function checkSummaryTotal (){
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "summaryTotal.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const totals = JSON.parse(xhr.responseText);
                    document.querySelectorAll("tr").forEach((row) => {
                        const input = row.querySelector("input[data-prod-id]");
                        if(input){
                            const prodId = input.getAttribute("data-prod-id");
                            const totalCell = row.querySelector(".tSummary");
                            if(totals[prodId] && totalCell){
                                const total = totals[prodId];
                                totalCell.innerHTML = `<strong>₱ ${total.toLocaleString()}.00</strong>`;
                            }
                        }
                    });
                }
            }
            xhr.send();
        }

        function modifyProdQuantity (input){
            const prod_id = input.getAttribute("data-prod-id");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "modifyQuantity.php?product_id=" + prod_id + "&quantity=" + input.value, true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    console.log(xhr.responseText);
                    checkSummaryTotal();
                    getGrandTotal();
                    getCartNotif();
                }else{
                    console.error(xhr.responseText);
                }
            }
            xhr.send();
        }

        function getGrandTotal(){

            const xhr = new XMLHttpRequest();
            xhr.open("GET","getCartGrandTotal.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    // do something :)
                   const grand_total = JSON.parse(xhr.responseText);
                   document.querySelector(".grand-total").innerHTML = grand_total === null ? "" : "Total: ₱ " + grand_total;
                }
            }
            xhr.send();

        }

        function getCartNotif(){
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "checkCart.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const cart = document.querySelector(".cart");
                    cart.setAttribute("data-count", xhr.responseText);
                }
            }
            xhr.send();
        }

        window.addEventListener("DOMContentLoaded", ()=> {
            getCartNotif();
            checkSummaryTotal();
            getGrandTotal();
        })
    </script>

</body>

</html>

<?php mysqli_close($conn);?>