<?php
require "includes/common.php";
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoplift - Your Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: rgb(177, 77, 77);
        }
        .table-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<?php include 'includes/header_menu.php'; ?>

<div class="d-flex justify-content-center">
    <div class="col-md-8 my-5 table-responsive table-container">
        <h3 class="text-center mb-4">🛒 Your Cart</h3>
        <table class="table table-striped table-bordered table-hover">
            <?php
            $sum = 0;
            $user_id = $_SESSION['user_id'];
            $query = "SELECT products.price AS Price, products.id, products.name AS Name 
                      FROM users_products 
                      JOIN products ON users_products.item_id = products.id 
                      WHERE users_products.user_id='$user_id' AND status='Added To Cart'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) >= 1) {
            ?>
            <thead>
                <tr>
                    <th>Item Number</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    $sum += $row["Price"];
                    echo "<tr>
                            <td>#{$row['id']}</td>
                            <td>{$row['Name']}</td>
                            <td>Php " . number_format($row['Price']) . "</td>
                            <td><a href='cart-remove.php?id={$row['id']}' class='btn btn-sm btn-danger'>Remove</a></td>
                          </tr>";
                }
            ?>
                <tr>
                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                    <td colspan="2" class="font-weight-bold">Php <?php echo number_format($sum); ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <form action="success.php" method="POST">
                            <div class="form-group text-left">
                                <label for="paymentMethod"><strong>Select Payment Method:</strong></label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Cash on Delivery" checked>
                                    <label class="form-check-label" for="cod">Cash on Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="Credit Card">
                                    <label class="form-check-label" for="credit_card">Credit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="gcash" value="GCash">
                                    <label class="form-check-label" for="gcash">GCash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="PayPal">
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Confirm Order</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            <?php
            } else {
                echo "<div class='text-center'><img src='images/emptycart.png' class='img-fluid' height='150' width='150'></div><br/>";
                echo "<div class='text-center font-weight-bold h5 text-white'>Your cart is empty. Add items to the cart first!</div>";
            }
            ?>
        </table>
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
