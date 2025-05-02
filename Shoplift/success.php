<?php
require "includes/common.php";
session_start();

$user_id = $_SESSION['user_id'];
$query = "UPDATE users_products SET status='Confirmed' WHERE user_id='$user_id' AND status='Added to cart'";
mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoplift</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="4;url=index.php" />
</head>
<body>
    <?php include 'includes/header_menu.php'; ?>

    <!-- Order Confirmation Modal -->
    <div class="modal fade" id="orderSuccessModal" tabindex="-1" role="dialog" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
          <div class="modal-header">
            <h5 class="modal-title" id="orderSuccessModalLabel">Order Confirmed</h5>
          </div>
          <div class="modal-body">
            <h5>Your order is confirmed. Thank you for shopping with us.</h5>
            <p>Click <a href="products.php">here</a> to purchase any other item.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- footer-->
    <?php include 'includes/footer.php' ?>
    <!--footer ends-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orderSuccessModal').modal('show');

            // Optional: Auto-close modal after 3 seconds (before redirect)
            setTimeout(function() {
                $('#orderSuccessModal').modal('hide');
            }, 3000);
        });

        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <?php
    if (isset($_GET['error'])) {
        $z = $_GET['error'];
        echo "<script type='text/javascript'>
            $(document).ready(function(){
                $('#signup').modal('show');
            });
        </script>";
        echo "<script type='text/javascript'>alert('" . $z . "')</script>";
    }

    if (isset($_GET['errorl'])) {
        $z = $_GET['errorl'];
        echo "<script type='text/javascript'>
            $(document).ready(function(){
                $('#login').modal('show');
            });
        </script>";
        echo "<script type='text/javascript'>alert('" . $z . "')</script>";
    }
    ?>
</body>
</html>
