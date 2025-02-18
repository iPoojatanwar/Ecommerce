<?php
include "./HEADER/header.html";
require "connection.php";
echo '<nav id="navbar" class="navbar navbar-lg navbar-light bg-white-50">
  <div class="container-fluid">
    <input type="search" class="form-control" placeholder="Search">
  </div>
</nav></div>';
$query = "SELECT * FROM imagedata";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
     body{
      background-color:#D0DDD0 !important;
     }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid gray;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  const inputfield = document.querySelector("#navbar input");
const productitems = Array.from(document.querySelectorAll("#product .col-md-4"));

inputfield.addEventListener('input', function() {
  const query = inputfield.value.toLowerCase();

  productitems.forEach(function(product) {
    const name = product.querySelector('.card-title').textContent.toLowerCase();
    if (name.includes(query)) {
      product.style.display = "block";
    } else {
      product.style.display = "none";
    }
  });
});

</script>
</body>
</html>
<?php
include "./FOOTER/footer.html"
?>