<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['lemail']);
    $password = mysqli_real_escape_string($conn, $_POST['lpassword']);
    $password = md5($password);
    
    $query = "SELECT * FROM users WHERE email_id = '$email' AND password = '$password' AND role = 'admin'";
    $result = mysqli_query($conn, $query);
    
    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email_id'];
        $_SESSION['role'] = 'admin';
        header('Location: admin.php');
        exit();
    }
    
    $_SESSION['login_error'] = "Invalid email or password";
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Shoplift</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: rgb(177, 77, 77);
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: rgb(177, 77, 77);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="text-center mb-4">Admin Login</h1>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="lemail">Email:</label>
                <input type="email" id="lemail" name="lemail" required>
            </div>
            
            <div class="form-group">
                <label for="lpassword">Password:</label>
                <input type="password" id="lpassword" name="lpassword" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html> 