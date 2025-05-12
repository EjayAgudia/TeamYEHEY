<?php
session_start();
include 'db_connect.php'; // Your DB connection file
include_once 'includes/check-if-added.php'; // ✅ Include it ONCE at the top

function renderProduct($id, $name, $price, $image, $conn)  // ✅ Pass $conn here if needed inside check_if_added_to_cart
{
    ?>
    <div class="col-md-3 col-6 py-3">
        <div class="card h-100">
            <div class="product-image-container">
                <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($name); ?>" class="card-img-top product-image">
                <div class="product-overlay">
                    <div class="overlay-content">
                        <?php 
                        if (!isset($_SESSION['email'])) { ?>
                            <a href="index.php#login" class="btn btn-light btn-sm">View Details</a>
                        <?php 
                        } else {
                            if (check_if_added_to_cart($id, $conn)) {
                                echo '<button class="btn btn-light btn-sm" disabled>Added to cart</button>';
                            } else {
                                echo '<a href="cart-add.php?id=' . $id . '" class="btn btn-light btn-sm">Add to cart</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <h6 class="card-title"><?php echo htmlspecialchars($name); ?></h6>
                <p class="card-text price">Php <?php echo number_format($price); ?></p>
                <?php 
                if (!isset($_SESSION['email'])) { ?>
                    <a href="index.php#login" role="button" class="btn btn-primary btn-block">Add To Cart</a>
                <?php 
                } else {
                    if (check_if_added_to_cart($id, $conn)) {
                        echo '<button class="btn btn-secondary btn-block" disabled>Added to cart</button>';
                    } else {
                        echo '<a href="cart-add.php?id=' . $id . '" class="btn btn-primary btn-block">Add to cart</a>';
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php
}

// Get category from URL parameter
$category = isset($_GET['category']) ? $_GET['category'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoplift - Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #e63946;
            --secondary-color: #1d3557;
            --accent-color: #457b9d;
            --light-color: #f1faee;
            --dark-color: #1d3557;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ff6b6b 100%);
            min-height: 100vh;
            color: var(--dark-color);
        }

        .card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .product-image-container {
            height: 250px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 15px;
            border-radius: 15px 15px 0 0;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 15px 15px 0 0;
        }

        .card:hover .product-overlay {
            opacity: 1;
        }

        .overlay-content {
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .card:hover .overlay-content {
            transform: translateY(0);
        }

        .jumbotron {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        .category-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .category-nav .nav-link {
            color: var(--dark-color);
            padding: 10px 20px;
            border-radius: 25px;
            margin: 0 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .category-nav .nav-link:hover,
        .category-nav .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            height: 2.4rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            color: var(--dark-color);
        }

        .price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .btn {
            border-radius: 25px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #d62828;
            border-color: #d62828;
            transform: translateY(-2px);
        }

        .btn-light {
            background-color: white;
            color: var(--primary-color);
            border: none;
        }

        .btn-light:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--dark-color);
        }

        h3.text-white {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 200px;
            }
            
            .category-nav .nav-link {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<?php include 'includes/header_menu.php'; ?>

<div class="container my-5">
    <div class="jumbotron text-center">
        <h1>Welcome to Shoplift!</h1>
        <p>We've got all the stuff you need, right here in one place. Happy shopping!</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <!-- Category Navigation -->
    <div class="category-nav">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link <?php echo !$category ? 'active' : ''; ?>" href="products.php">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $category === 'Watches' ? 'active' : ''; ?>" href="?category=Watches">Watches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $category === 'Clothing' ? 'active' : ''; ?>" href="?category=Clothing">Clothing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $category === 'Shoes' ? 'active' : ''; ?>" href="?category=Shoes">Shoes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $category === 'Headphones' ? 'active' : ''; ?>" href="?category=Headphones">Headphones</a>
            </li>
        </ul>
    </div>

    <h3 class="text-white"><?php echo $category ? $category : 'All Products'; ?></h3>
    <div class="row">
        <?php
        // Fetch products from the database
        $sql = "SELECT id, name, price, image FROM products";
        if ($category) {
            $category = mysqli_real_escape_string($conn, $category);
            $sql .= " WHERE category = '$category'";
        }
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $image = !empty($row['image']) ? $row['image'] : 'images/default.jpg';
                renderProduct($row['id'], $row['name'], $row['price'], $image, $conn);
            }
        } else {
            echo "<p class='text-white'>No products found in this category.</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>

<?php
if (isset($_GET['error'])) {
    $z = $_GET['error'];
    echo "<script>
    $(document).ready(function(){
        $('#signup').modal('show');
        alert('" . $z . "');
    });
    </script>";
}
if (isset($_GET['errorl'])) {
    $z = $_GET['errorl'];
    echo "<script>
    $(document).ready(function(){
        $('#login').modal('show');
        alert('" . $z . "');
    });
    </script>";
}
?>
</body>
</html>
