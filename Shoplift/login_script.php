<?php
require("includes/common.php");
session_start();

$email = mysqli_real_escape_string($con, $_POST['lemail']);
$password = mysqli_real_escape_string($con, $_POST['lpassword']);
$password = md5($password);

$query = "SELECT id, email_id FROM users WHERE email_id='$email' AND password='$password'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num == 0) {
    $_SESSION['login_error'] = "Please enter correct E-mail ID and Password.";
    header("location: index.php#login");
    exit();
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['email'] = $row['email_id'];
    $_SESSION['user_id'] = $row['id'];
    header("location: products.php");
    exit();
}
?>
