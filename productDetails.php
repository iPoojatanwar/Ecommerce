<?php 
session_start();
include "header.html";
require "connection.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $image = $_GET['image'];
    $name = $_GET['name'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $rating = $_GET['rating'];
} else {
    header("Location: index.php");
    exit;
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    
    $existingIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['name'] == $name) {
            $existingIndex = $index;
            break;
        }
    }


    if ($existingIndex !== -1) {
        $_SESSION['cart'][$existingIndex]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][] = [
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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
        <div class="row">
            <div class="col-md-6">
                <img src="<?= $image; ?>" alt="<?= $name; ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2><?= $name; ?></h2>
                <p><strong>Description:</strong> <?= $description; ?></p>
                <p><strong>Price:</strong> $<?= $price; ?></p>
                <p><strong>Rating:</strong> <?= $rating; ?> <i class="fas fa-star"></i></p>

            
                <form method="POST" action="productDetails.php?id=<?= $productId ?>&image=<?= urlencode($image) ?>&name=<?= urlencode($name) ?>&description=<?= urlencode($description) ?>&price=<?= $price ?>&rating=<?= urlencode($rating) ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>

        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php include "footer.html"; ?>
