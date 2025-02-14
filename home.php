<?php
include "./HEADER/header.html";
require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOMERCE WEBSITE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6He47QJ5t3E2T0Q3TtVOy8L+Vcmj3z+yV5zxRqqF2gK5zTbHtBfnlcbFZX" crossorigin="anonymous">
    
    <style>
        body{
            background-image: none;
            background-color:#D0DDD0 !important;
        }
        .container-image {
            background-image: url("https://static.wixstatic.com/media/e4f166_485b2452762a4cfcb87dd8bf7e6d9d9a~mv2.jpg");
            background-size: 100% 100%;
            background-position: center;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .container-image .content {
            
            padding: 10px;
            max-width: 700px;
            position: relative;
            left: -80px;
            
        }

        .container-image h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: brown;
            animation: fadeIn 4s forwards;
        }

        .container-image p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            color: #FFE31A;
            opacity: 0;
            animation:  fadeIn 1s 1.2s forwards; 
        }

        .container-image .btn {
            font-size: 1.25rem;
            border-radius: 50px;
            animation: fadeIn 2s 2s forwards;
        }
        .card:hover {
            transition: transform 0.3s  ease , box-shadow 0.2s ease;
            box-shadow: 0.1px 1px 12px black;
  transform: translateY(-12px);
        }
        .card{
            border: 2px solid gray;
        }
        .container-image:hover .content h1,
        .container-image:hover .content p,
        .container-image:hover .content .btn
        
         {
            opacity: 1;

            transition: all 0.3s ease-in-out;
        }
.container .h2{
    color: black;
    padding: 12px 0;
box-shadow: 1px 1px 5px black;
}
.container .h2:hover{
    box-shadow: 1px 1px 1px black;  
}       
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        .btn-shop-now:hover {
    background-color:red; 
    color: #fff; 
    transition: background-color 0.3s ease; 
    }
        
    .star-rating i {
        color: #ffcc00;
        font-size: 1.2em; 
    }
    .star-rating i.far {
        color: #ddd; 
    }

    </style>

</head>

<body>
    <div class="container-image">
        <div class="content">
            <h1>Welcome to Shop Now!</h1>
            <p>Your destination for the latest trends in fashion. Explore our wide selection of products and enjoy incredible deals!</p>
            <a href="product.php" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>

    

    <section class="categories py-5">
        <div class="container">
            <h2 class=" h2 text-center mb-4 ">Featured Categories</h2>
            <?php
            $query = "SELECT * FROM imagedata LIMIT 4";
            $result = mysqli_query($database_conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $count = 0;
                echo '<section id="product" class="featured-products py-5">';
                echo '<div class="container">';
            
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($count % 3 == 0)
                    
                     {  
                    echo '<div class="row">';
                    }
            
                    
                    $image = $row['Image'];
                    $name = $row['Name'];
                    $description = $row['Description'];
                    $price = $row['Price'];
                    $rating = $row['Rating'];
            
                    echo '<div class="col-md-4 mb-4">'; 
                    echo "<div class='card'>";
                    echo "<img src='$image' class='card-img' alt='Product'>";
                    echo "<div class='card-body bg-success text-white'>";
                    echo "<h5 class='card-title'>$name</h5>";
                    echo "<p class='card-text'>$description</p>";
                    echo "<p class='price' style='font-weight: bold; font-size: 1.2em;'>$$price</p>";
                    echo "<div class='star-rating'>$rating</div>";
                    echo '<a href="productDetails.php?id=' .'&image=' . urlencode($row['Image']) . '&name=' . urlencode($row['Name']) . '&description=' . urlencode($row['Description']) . '&price=' . $row['Price'] . '&rating=' . urlencode($row['Rating']) . '" class="btn btn-dark text-white w-100 hover:bg-dark">Shop Now</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
            
                    $count++;    
                }
            
                echo '</div>';
                echo '</section>';
            }
            
            ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU7rD0T7a5kRrF6dG61l4hmlFwB9zF7K2v3SPuF5k0Jr/7fV3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p7bM06CgNw6u/1Xg6nql+FbDBkZmVo9g/sX5VPTm8h5+fK5" crossorigin="anonymous"></script>
</body>

</html>

<?php
include "./FOOTER/footer.html"
?>