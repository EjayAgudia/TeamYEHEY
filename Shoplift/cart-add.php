<?php
require 'db_connect.php';
session_start();

// Debug session to check what is available
// REMOVE OR COMMENT THIS IN PRODUCTION
// var_dump($_SESSION);
// die();

// Check if a valid product ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = (int) $_GET['id'];

    // Initialize user_id
    $user_id = $_SESSION['user_id'] ?? null;

    // If user_id is not in session, try to fetch it via email
    if (!$user_id && isset($_SESSION['email'])) {
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
        $query_user = "SELECT id FROM users WHERE email_id = '$email' LIMIT 1";
        $result_user = mysqli_query($conn, $query_user);

        if ($result_user && mysqli_num_rows($result_user) === 1) {
            $row = mysqli_fetch_assoc($result_user);
            $user_id = (int) $row['id'];
        } else {
            // User not found in DB, force logout or error
            header('Location: index.php#login');
            exit();
        }
    }

    if ($user_id) {
        // Prevent duplicate entries by checking if the item is already in the cart
        $check_query = "
            SELECT 1 FROM users_products 
            WHERE user_id = $user_id AND item_id = $item_id AND status = 'Added To Cart'
            LIMIT 1
        ";
        $check_result = mysqli_query($conn, $check_query);

        if (!$check_result) {
            die('Database error during check: ' . mysqli_error($conn));
        }

        if (mysqli_num_rows($check_result) === 0) {
            // Item not yet in cart; insert it
            $insert_query = "
                INSERT INTO users_products (user_id, item_id, status)
                VALUES ($user_id, $item_id, 'Added To Cart')
            ";

            if (mysqli_query($conn, $insert_query)) {
                // Redirect with success message
                header('Location: products.php?success=added');
                exit();
            } else {
                // Handle query error
                die('Database error during insert: ' . mysqli_error($conn));
            }
        } else {
            // Already in cart, just redirect back
            header('Location: products.php?success=already_added');
            exit();
        }
    } else {
        // No user logged in; redirect to login
        header('Location: index.php#login');
        exit();
    }
} else {
    // Invalid or missing ID; redirect to products page
    header('Location: products.php?error=invalid_id');
    exit();
}
?>
