<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Handle different actions
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        handleAddProduct();
        break;
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            handleUpdateProduct();
        } else {
            showEditForm();
        }
        break;
    case 'delete':
        handleDeleteProduct();
        break;
    default:
        header('Location: admin.php');
        exit();
}

function handleAddProduct() {
    global $conn;
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = intval($_POST['price']);
    
    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "images/";
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $image = $target_dir . uniqid() . '.' . $file_extension;
        $target_file = $image;
        
        // Check if image file is a actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['error'] = "File is not an image.";
            header('Location: admin.php');
            exit();
        }
        
        // Check file size (5MB max)
        if ($_FILES["image"]["size"] > 5000000) {
            $_SESSION['error'] = "File is too large.";
            header('Location: admin.php');
            exit();
        }
        
        // Allow certain file formats
        if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "gif") {
            $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
            header('Location: admin.php');
            exit();
        }
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully
        } else {
            $_SESSION['error'] = "Error uploading image.";
            header('Location: admin.php');
            exit();
        }
    }
    
    $query = "INSERT INTO products (name, price, image) VALUES ('$name', $price, '$image')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Product added successfully!";
    } else {
        $_SESSION['error'] = "Error adding product: " . mysqli_error($conn);
    }
    
    header('Location: admin.php');
    exit();
}

function handleUpdateProduct() {
    global $conn;
    
    $id = intval($_POST['product_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = intval($_POST['price']);
    
    $query = "UPDATE products SET name = '$name', price = $price";
    
    // Handle image upload if new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "images/";
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $image = $target_dir . uniqid() . '.' . $file_extension;
        $target_file = $image;
        
        // Check if image file is a actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['error'] = "File is not an image.";
            header('Location: admin.php');
            exit();
        }
        
        // Check file size (5MB max)
        if ($_FILES["image"]["size"] > 5000000) {
            $_SESSION['error'] = "File is too large.";
            header('Location: admin.php');
            exit();
        }
        
        // Allow certain file formats
        if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "gif") {
            $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
            header('Location: admin.php');
            exit();
        }
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $query .= ", image = '$image'";
        } else {
            $_SESSION['error'] = "Error uploading image.";
            header('Location: admin.php');
            exit();
        }
    }
    
    $query .= " WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Product updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating product: " . mysqli_error($conn);
    }
    
    header('Location: admin.php');
    exit();
}

function handleDeleteProduct() {
    global $conn;
    
    $id = intval($_POST['product_id']);
    
    // Get the image filename before deleting
    $query = "SELECT image FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    
    // Delete the product
    $query = "DELETE FROM products WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        // Delete the image file if it exists
        if ($product && $product['image']) {
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }
        }
        $_SESSION['success'] = "Product deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting product: " . mysqli_error($conn);
    }
    
    header('Location: admin.php');
    exit();
}

function showEditForm() {
    global $conn;
    
    $id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    
    if (!$product) {
        header('Location: admin.php');
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product - Shoplift</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                background-color: rgb(177, 77, 77);
                color: #333;
            }
            .edit-container {
                max-width: 800px;
                margin: 50px auto;
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
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 5px;
            }
            .btn-primary {
                background-color: rgb(177, 77, 77);
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="edit-container">
            <h1>Edit Product</h1>
            <form action="admin_actions.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="image">Current Image:</label>
                    <?php if ($product['image']): ?>
                        <img src="<?php echo $product['image']; ?>" alt="Current product image" style="max-width: 200px;">
                    <?php endif; ?>
                    <br>
                    <label for="new_image">New Image (optional):</label>
                    <input type="file" id="new_image" name="image" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="admin.php" class="btn">Cancel</a>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}
?> 