<?php
session_start();
include 'db_connect.php'; // Your DB connection file
include_once 'includes/check-if-added.php'; // ✅ Include it ONCE at the top

function renderProduct($id, $name, $price, $image, $conn)  // ✅ Pass $conn here if needed inside check_if_added_to_cart
{
    ?>
    <div class="col-md-3 col-6 py-3">
        <div class="card h-100">
            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($name); ?>" class="card-img-top img-fluid">
            <div class="card-body text-center">
                <h6 class="card-title"><?php echo htmlspecialchars($name); ?></h6>
                <p class="card-text">Price: Php <?php echo number_format($price); ?></p>
                <?php 
                if (!isset($_SESSION['email'])) { ?>
                    <a href="index.php#login" role="button" class="btn btn-warning text-white">Add To Cart</a>
                <?php 
                } else {
                    if (check_if_added_to_cart($id, $conn)) {  // ✅ Pass $conn to the function
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
    </style>
</head>
<body>
<?php include 'includes/header_menu.php'; ?>

<div class="container my-5">
    <div class="jumbotron text-center">
        <h1>Welcome to Shoplift!</h1>
        <p>We’ve got all the stuff you need, right here in one place. Happy shopping!</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <h3 class="text-white">Our Products</h3>
    <div class="row">
        <?php
        // Fetch products from the database
        $sql = "SELECT id, name, price, image FROM products WHERE id >= 9";
        // Make sure your table is 'products'
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $image = !empty($row['image']) ? $row['image'] : 'images/default.jpg'; // fallback if image is missing
                renderProduct($row['id'], $row['name'], $row['price'], $image, $conn);  // ✅ Pass $conn
            }
        } else {
            echo "<p class='text-white'>No products found.</p>";
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
