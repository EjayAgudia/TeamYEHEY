<?php
require_once 'db_connect.php';

// Update watch images
$queries = [
    // Watches
    "UPDATE products SET image = 'images/watch1.jpg' WHERE name = 'Rolex Submariner'",
    "UPDATE products SET image = 'images/watch2.jpg' WHERE name = 'Omega Seamaster'",
    "UPDATE products SET image = 'images/watch3.jpg' WHERE name = 'Casio G-Shock'",
    "UPDATE products SET image = 'images/watch4.jpg' WHERE name = 'Fossil Chronograph'",
    
    // Shirts
    "UPDATE products SET image = 'images/shirt1.jpg' WHERE name = 'Polo Ralph Lauren'",
    "UPDATE products SET image = 'images/shirt2.jpg' WHERE name = 'Tommy Hilfiger Tee'",
    "UPDATE products SET image = 'images/shirt3.jpg' WHERE name = 'Adidas Originals'",
    "UPDATE products SET image = 'images/shirt4.jpg' WHERE name = 'Nike Dri-FIT'",
    
    // Shoes
    "UPDATE products SET image = 'images/shoe1.jpg' WHERE name = 'Adidas Ultraboost'",
    "UPDATE products SET image = 'images/shoe2.jpg' WHERE name = 'Puma Running Shoes'",
    "UPDATE products SET image = 'images/shoe3.jpg' WHERE name = 'Vans Classic'",
    "UPDATE products SET image = 'images/shoe4.jpg' WHERE name = 'Converse Chuck Taylor'",
    
    // Speakers/Headphones
    "UPDATE products SET image = 'images/sp1.jpg' WHERE name = 'JBL Tune 500BT'",
    "UPDATE products SET image = 'images/sp2.jpg' WHERE name = 'Bose QuietComfort'",
    "UPDATE products SET image = 'images/sp3.jpg' WHERE name = 'Sennheiser HD 450BT'",
    "UPDATE products SET image = 'images/sp4.jpg' WHERE name = 'Marshall Major IV'"
];

$success = true;
$errors = [];

foreach ($queries as $query) {
    if (!mysqli_query($conn, $query)) {
        $success = false;
        $errors[] = mysqli_error($conn);
    }
}

if ($success) {
    echo "All product images have been updated successfully!";
} else {
    echo "There were some errors updating the images:<br>";
    foreach ($errors as $error) {
        echo "- " . $error . "<br>";
    }
}
?> 