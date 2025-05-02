<?php
//This code checks if the product is added to cart. 
function check_if_added_to_cart($item_id, $conn) {
    if (!isset($_SESSION['user_id'])) {
        return false;  // No user logged in
    }
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users_products WHERE item_id='$item_id' AND user_id='$user_id' AND status='Added To Cart'";

    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) >= 1;
}

?>