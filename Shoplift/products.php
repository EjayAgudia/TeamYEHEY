<?php
session_start();
include 'db_connect.php'; // Your DB connection file
include_once 'includes/check-if-added.php';

// Function to render individual product
function renderProduct($id, $name, $price, $image, $conn)  
{
    ?>
    <div class="col-md-3 col-6 py-3">
        <div class="card h-100">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="card-img-top img-fluid">
            <div class="card-body text-center">
                <h6 class="card-title"><?php echo htmlspecialchars($name); ?></h6>
                <p class="card-text">Price: Php <?php echo number_format($price, 2); ?></p>
                <?php 
                if (!isset($_SESSION['email'])) { ?>
                    <a href="#login" role="button" class="btn btn-warning text-white" data-toggle="modal">Add To Cart</a>
                <?php 
                } else {
                    if (check_if_added_to_cart($id, $conn)) {
                        echo '<button class="btn btn-secondary" disabled>Added to cart</button>';
                    } else {
                        echo '<a href="cart-add.php?id=' . $id . '" class="btn btn-warning text-white">Add to cart</a>';
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php
}

// Function to render product categories
function renderProductCategory($conn, $category) {
    // Mapping of category keywords to match product names
    $categoryMappings = [
        'watch' => ['Watch', 'Watches', 'Timepiece'],
        'tshirt' => ['T-Shirt', 'Shirt', 'Tee'],
        'shoe' => ['Shoe', 'Shoes', 'Sneaker', 'Boot'],
        'headphone' => ['Headphone', 'Speaker', 'Audio']
    ];

    // Build a dynamic LIKE condition
    $likeConditions = [];
    foreach ($categoryMappings[$category] as $keyword) {
        $likeConditions[] = "name LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
    }
    $whereClause = implode(' OR ', $likeConditions);

    // Construct the SQL query
    $sql = "SELECT id, name, price, image FROM products WHERE $whereClause";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $image = !empty($row['image']) ? $row['image'] : 'images/default.jpg';
            renderProduct($row['id'], $row['name'], $row['price'], $image, $conn);
        }
    } else {
        echo "<div class='col-12'><p class='text-white'>No $category products found.</p></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoplift - Products</title>
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZdeAj1Qb4OmF4LiWz8nCmNfx9cL7LIzxMsNwMHcYGZp9l+36zqDkZjDyX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <style>
        body {
            background-color: rgb(177, 77, 77);
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: 0.3s;
        }
        .jumbotron {
            background-color: #fff3f3;
        }
        .product-section {
            margin-bottom: 2rem;
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

        <h3 class="text-white">Our Products</h3>

        <div id="products-container">
            <!-- Watches Section -->
            <div id="watches" class="product-section">
                <h4 class="text-white">Watches</h4>
                <div class="row">
                    <?php renderProductCategory($conn, 'watch'); ?>
                </div>
            </div>

            <!-- T-Shirts Section -->
            <div id="tshirts" class="product-section">
                <h4 class="text-white">T-Shirts</h4>
                <div class="row">
                    <?php renderProductCategory($conn, 'tshirt'); ?>
                </div>
            </div>

            <!-- Shoes Section -->
            <div id="shoes" class="product-section">
                <h4 class="text-white">Shoes</h4>
                <div class="row">
                    <?php renderProductCategory($conn, 'shoe'); ?>
                </div>
            </div>

            <!-- Headphones/Speakers Section -->
            <div id="headphones" class="product-section">
                <h4 class="text-white">Headphones/Speakers</h4>
                <div class="row">
                    <?php renderProductCategory($conn, 'headphone'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
    // Initialize popovers and dropdowns
    $(document).ready(function(){
        // Enable popovers
        $('[data-toggle="popover"]').popover();
        
        // Enable dropdowns (though this should be automatic with Bootstrap)
        $('.dropdown-toggle').dropdown();

        // Smooth scrolling for navbar links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100 // Offset for fixed navbar
                }, 1000);
            }
        });
    });
    </script>

    <?php
    // Add error handling scripts
    if (isset($_GET['error'])) {
        $z = htmlspecialchars($_GET['error']);
        echo "<script>
        $(document).ready(function(){
            $('#signup').modal('show');
            alert('" . $z . "');
        });
        </script>";
    }
    if (isset($_GET['errorl'])) {
        $z = htmlspecialchars($_GET['errorl']);
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

<?php
// Close the database connection
mysqli_close($conn);
?>
