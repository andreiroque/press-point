<?php
session_start();

include 'connection.php';

if(!isset($_SESSION['id'])){
    echo '<script>alert("Please Login or Sign Up first!")</script>';
    echo '<script>window.location="sign-in.php"</script>';
}
echo '<script>console.log("'. $_SESSION['prod_id'] .'")</script>';

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

    <a href="product-description.php" class="back-button">
        <button class="previous-button"><i class="bx bx-arrow-back"></i> Back</button>
    </a>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="order-confirmation.php">

                    <div class="row">
                        <div class="col-50">
                            <h1>Billing Address</h1>
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="firstname">
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" id="zip" name="zip">
                                </div>
                            </div>

                            <h1>Shipping Options</h1>
                            <label>Select Shipping Option</label>
                            <select id="shipping-method" name="shipping-method">
                                <option value="custom">Custom Shipping</option>
                                <option value="express">Express Shipping</option>
                                <option value="same-day">Same Day Shipping</option>
                            </select>
                        </div>

                        <div class="col-50">
                            <h1>Payment Methods</h1>
                            <label>Select Payment Method</label>
                            <select id="payment-methods" name="payment">
                                <option value="credit-debit-card">Credit Card / Debit Card</option>
                                <option value="mobile-wallet">Mobile Wallet</option>
                                <option value="online-banking">Online Banking</option>
                                <option value="remittance-center">Remittance Center</option>
                                <option value="upon-delivery-payment">Upon Delivery Payment</option>
                            </select>

                            <label for="account-number">Account Number</label>
                            <input type="text" id="account-number" name="account-number">
                            <label for="accountholdername">Account Holder Name</label>
                            <input type="text" id="accountholder-name" name="account-holdername">
                            <label for="account-code">Account Code</label>
                            <input type="text" id="account-code" name="account-code">

                        </div>

                    </div>
                    <input type="submit" value="Place Order" class="button">
                </form>
            </div>
        </div>

        <div class="col-25">
            <div class="container">
                <h1>Shopping Cart <span class="price" style="color:black"><b>5</b></span></h1>
                <p><a href="#">Apex Press</a> <span class="price">Php 1,000.00</span></p>
                <p><a href="#">Drift Press</a> <span class="price">Php 1,000.00</span></p>
                <p><a href="#">Fusion Press</a> <span class="price">Php 1,000.00</span></p>
                <p><a href="#">Impulse Press</a> <span class="price">Php 1,000.00</span></p>
                <p><a href="#">Nexus Press</a> <span class="price">Php 1,000.00</span></p>
                <hr>
                <p>Total <span class="price" style="color:black"><b>Php 5,000.00</b></span></p>
            </div>
        </div>
    </div>

</body>

</html>