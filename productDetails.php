<?php
session_start();
include "./HEADER/header.html";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$name = isset($_GET['name']) ? urldecode($_GET['name']) : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$image = isset($_GET['image']) ? $_GET['image'] : '';
$description = isset($_GET['description']) ? urldecode($_GET['description']) : '';

$item_add=false;
if (isset($_POST['add_to_cart'])) {

    $product = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'description' => $description,
        'quantity' => isset($_POST['quantity']) ? $_POST['quantity'] : 1 
    ];

    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $product;
    $item_add=true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    #item-add{
        position: absolute;
        font-family:  monospace;
        border-radius: 20px;
        top: 70vh;
        color: white;
        background-color: black;
        padding:  1% 1%;
        left: 50%;
    }
</style>
<body>
    <div class="container page py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card product-card">
                    <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="card-img-top">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card product-card">
                    <div class="card-body product-details bg-light">
                        <h3><?php echo $name; ?></h3>
                        <p><?php echo $description; ?></p>
                        <p><strong>Price:</strong> $<?php echo $price; ?></p>
                        <form method="POST">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1">
                            <button type="submit" name="add_to_cart" class="btn btn-primary mt-2">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <div id="item-add"></div>
<?php if ($item_add): ?>
    <script>
        let item = document.querySelector("#item-add");

    
        const check = document.createElement("span");
        check.innerText = "✔️";
        check.classList.add("border", "border-white", "p-2", "m-2", "rounded-circle", "fs-6"); 
        item.appendChild(check);

        
        let description = document.createElement("span");
        description.innerHTML = "Item added";
        description.classList.add("text-white", "fs-4", "fw-bold", "mx-2"); 
        description.style.transform="0.8  ease-in" 
        item.appendChild(description);

    
        const cross = document.createElement('span');
        cross.innerText = "❌";
        cross.classList.add("border", "border-white", "p-2", "m-2", "rounded-circle", "fs-6");
        item.appendChild(cross);

        
        cross.addEventListener('click', function () {
            item.remove();
        });
    
    setTimeout(function(){
         item.style.opacity="0"
         item.style.opacity="0"
    },1500)
    </script>
<?php endif; ?>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
