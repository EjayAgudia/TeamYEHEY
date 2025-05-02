<?php
$servername = "localhost";
$username = "root";
$password = "";  // usually empty in XAMPP/MAMP
$dbname = "ecommerce";  // 🔥 replace with your actual DB name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
