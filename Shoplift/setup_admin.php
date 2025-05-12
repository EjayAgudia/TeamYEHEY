<?php
require_once 'db_connect.php';

// Admin credentials
$admin_email = 'admin@shoplift.com';
$admin_password = md5('admin123'); // Password: admin123
$admin_first = 'Admin';
$admin_last = 'User';

// Check if admin already exists
$query = "SELECT * FROM users WHERE email_id = '$admin_email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // Create admin user
    $query = "INSERT INTO users (email_id, first_name, last_name, password, role) 
              VALUES ('$admin_email', '$admin_first', '$admin_last', '$admin_password', 'admin')";
    
    if (mysqli_query($conn, $query)) {
        echo "Admin user created successfully!<br>";
        echo "Email: admin@shoplift.com<br>";
        echo "Password: admin123";
    } else {
        echo "Error creating admin user: " . mysqli_error($conn);
    }
} else {
    echo "Admin user already exists!";
}
?> 