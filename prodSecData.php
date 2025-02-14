<?php
require "connection.php";  
$prodata = "CREATE TABLE IF NOT EXISTS imagedata (
    SrNO INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Image VARCHAR(255) NOT NULL,
    Name VARCHAR(234) NOT NULL,
    Description VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,  
    Rating VARCHAR(67) NOT NULL
)";

if (mysqli_query($database_conn, $prodata)) {
    echo "Table 'imagedata' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($connection) . "<br>";
}

$insertImgData = "INSERT INTO imagedata (Image, Name, Description, Price, Rating) VALUES (
    'https://www.titan.co.in/dw/image/v2/BKDD_PRD/on/demandware.static/-/Sites-titan-master-catalog/default/dw61458d43/images/Titan/Catalog/90188AP01_1.jpg?sw=600&sh=600',
    'Watch',
    'A sleek and stylish watch that adds elegance to your wrist. Available in different designs.',
    45.90,
    '⭐⭐⭐⭐'
)";
mysqli_close($database_conn);
?>
