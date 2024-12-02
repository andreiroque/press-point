<?php
session_start();

include 'connection.php';

if(!isset($_SESSION['id'])){
    echo '<script>alert("Please Login or Sign Up first!")</script>';
    echo '<script>window.location="sign-in.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="check-out.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Check Out</title>
</head>

<body>

    <a href="index.php" class="back-button">
        <button class="previous-button"><i class="bx bx-arrow-back"></i> Back</button>
    </a>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="post">

                    <div class="row">
                        <div class="col-50">
                            <h1>Billing Address</h1>
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="firstname" required>
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" required>
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required>
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" required>
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" id="zip" name="zip" required>
                                </div>
                            </div>

                            <h1>Shipping Options</h1>
                            <label>Select Shipping Option</label>
                            <select id="shipping-method" name="shipping-method" required>
                                <option value="custom">Custom Shipping</option>
                                <option value="express">Express Shipping</option>
                                <option value="same-day">Same Day Shipping</option>
                            </select>
                        </div>

                        <div class="col-50">
                            <h1>Payment Methods</h1>
                            <label>Select Payment Method</label>
                            <select id="payment-methods" name="payment" required>
                                <option value="credit-debit-card">Credit Card / Debit Card</option>
                                <option value="mobile-wallet">Mobile Wallet</option>
                                <option value="online-banking">Online Banking</option>
                                <option value="remittance-center">Remittance Center</option>
                                <option value="upon-delivery-payment">Upon Delivery Payment</option>
                            </select>

                            <label for="account-number">Account Number</label>
                            <input type="text" id="account-number" name="account-number" required>
                            <label for="accountholdername">Account Holder Name</label>
                            <input type="text" id="accountholder-name" name="account-holdername" required>
                            <label for="account-code">Account Code</label>
                            <input type="text" id="account-code" name="account-code" required>

                        </div>

                    </div>
                    <input type="submit" value="Place Order" class="button">
                </form>
            </div>
        </div>

        <div class="col-25">
            <div class="container">
                <h1>Shopping Cart <span class="price" style="color:black"></span></h1>
                <?php
                    if(isset($_SESSION['id'])){
                        $user_id = $_SESSION['id'];
                        $shipping_fee = 150;

                        $query = "SELECT p.name AS product_name, p.price, c.quantity FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id' AND c.status='Added'";

                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<p><a>'. $row['product_name'] .'</a><span class="price">₱ '. $row['price'] .' ('. $row['quantity'] .')</span></p>';
                            }
                            echo '<p><a>Shipping Fee</a><span class="price">₱ '. $shipping_fee .'.00</span></p>';
                        }

                        $query1 = "SELECT SUM((p.price * c.quantity)) + $shipping_fee as total_amount FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id' AND c.status='Added'";

                        if($result1 = mysqli_query($conn, $query1)){
                            $row = mysqli_fetch_assoc($result1);
                            echo '<hr>';
                            echo '<p class="total-amount" data-total="'. $row['total_amount'] .'">Total <span class="price" style="color: black;"><b>₱ '. $row['total_amount'] .'</b></span></p>';
                        }

                    }
                ?>
            </div>
        </div>
    </div>
    <script>

        const form = document.querySelector("form");
        form.addEventListener("submit", (e) => {
            // do something :)
            checkOut();
            e.preventDefault();
        })

        function checkOut(){
            const total = document.querySelector(".total-amount");
            const total_amount = total.getAttribute("data-total");
            console.log(total_amount);
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "checkOutItem.php?total=" + total_amount, true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response.status == "success"){
                        window.location = "order-confirmation.php";
                    }
                }
            }
            xhr.send();
        }

        const checkCart = () => {
            const cartItem = document.querySelector(".price");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "checkCart.php", true);
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    cartItem.innerHTML = "<b>"+ xhr.responseText +"</b>"
                }
            }
            xhr.send();
        }

        window.addEventListener("DOMContentLoaded", ()=> {
            checkCart();
        })
    </script>
</body>

</html>
<?php mysqli_close($conn);?>