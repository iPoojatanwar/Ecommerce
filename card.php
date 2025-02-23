<?php
session_start();
include "header.html";

$cart = isset($_SESSION['cart']) && !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $removeIndex = $_POST['remove_item'];
    unset($_SESSION['cart'][$removeIndex]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
    $cart = $_SESSION['cart']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
body {
    background-color: #D0DDD0 !important;
}
</style>
<body>
    <div class="container py-5">
        <center class=" border m-4 bg-white"><h3>Your Cart</h3></center>

        <?php if (!empty($cart)): ?>
            <div class="row" id="cartItems">
                <?php 
                $totalAmount = 0;
                foreach ($cart as $index => $item):
                    $itemTotal = $item['price'] * $item['quantity']; 
                    $totalAmount += $itemTotal; 
                ?>
                    <div class="col-md-4 mb-4" id="item-<?= $index ?>">
                        <div class="card">
                            <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5><?= $item['name']; ?></h5>
                                <p><?= $item['description']; ?></p>
                                <p><strong>Price:</strong> $<?= $item['price']; ?></p>
                                <p><strong>Quantity:</strong> <?= $item['quantity']; ?></p>
                                <p><strong>Total:</strong> $<?= $itemTotal; ?></p>
                                <form method="POST">
                                    <input type="hidden" name="remove_item" value="<?= $index ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                  <a href="sign-in.php">Checkout</a>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <h4 class="text-center" id="totalAmount">Total: $<?= $totalAmount; ?></h4>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        
        function updateTotalPrice() {
            let totalAmount = 0;
            document.querySelectorAll('.col-md-4').forEach(function(item) {
                let itemTotal = parseFloat(item.querySelector('.card-body p:last-child').textContent.replace('Total: $', '').trim());
                totalAmount += itemTotal;
            });
            document.getElementById('totalAmount').textContent = 'Total: $' + totalAmount.toFixed(2);
        }

    
        document.querySelectorAll('.btn-danger').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = button.closest('form');
                form.submit();
                updateTotalPrice();
            });
        });
    </script>
    </body>
    </html>
