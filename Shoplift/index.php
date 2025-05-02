<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shoplift</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Delius+Swash+Caps|Andika&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Andika', sans-serif;
      margin-bottom: 200px;
      background-color: rgb(177, 77, 77);
      color: #333;
    }
    #banner_content {
      background: rgba(0, 0, 0, 0.7);
      padding: 50px 30px;
      border-radius: 10px;
      color: #fff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    #bg {
      background: url('images/banner.jpg') no-repeat center center;
      background-size: cover;
      height: 450px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .product-card img {
      border-radius: 0.5rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      max-height: 200px;
      object-fit: cover;
    }
    .product-card img:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }
    .product-card .title {
      margin-top: 15px;
      font-weight: bold;
      font-size: 1.1rem;
    }
    .exclusive-section {
      padding-top: 60px;
      padding-bottom: 30px;
      text-align: center;
    }
    .exclusive-section h3 {
      font-size: 2rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 40px;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
    }
    .footer {
      margin-top: 60px;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php
    include 'includes/header_menu.php';
    include 'includes/check-if-added.php';
  ?>

  <!-- Banner Section -->
  <div id="bg">
    <div class="container text-center">
      <div id="banner_content">
        <h1 class="display-4 mb-3">We sell Happiness, You get Happiness!</h1>
        <p class="lead mb-4">Get up to 60% off on premium brands</p>
        <a href="products.php" class="btn btn-warning btn-lg text-white shadow">Shop Now!</a>
      </div>
    </div>
  </div>

  <!-- Exclusive Section -->
  <div class="exclusive-section">
    <h3>✨ Exclusive Categories ✨</h3>
    <div class="container">
      <div class="row text-center">
        <?php
        $categories = [
          ["img" => "images/watchs.jpg", "title" => "Watches", "link" => "#watch"],
          ["img" => "images/cloth.jpg", "title" => "Clothing", "link" => "#shirt"],
          ["img" => "images/shoess.jpg", "title" => "Shoes", "link" => "#shoes"],
          ["img" => "images/headset.jpg", "title" => "Headphones", "link" => "#headphones"],
          ["img" => "images/bag.png", "title" => "Bags", "link" => "#bags"],
          ["img" => "images/access.jpg", "title" => "Accessories", "link" => "#accessories"],
          ["img" => "images/sun.jpg", "title" => "Sunglasses", "link" => "#sunglasses"],
          ["img" => "images/elec.jpg", "title" => "Electronics", "link" => "#electronics"]
        ];
        foreach ($categories as $cat): ?>
          <div class="col-6 col-md-3 py-3 product-card">
            <a href="products.php<?= $cat['link'] ?>">
              <img src="<?= $cat['img'] ?>" class="img-fluid mb-2" alt="<?= htmlspecialchars($cat['title']) ?>">
              <div class="title"><?= htmlspecialchars($cat['title']) ?></div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <?php include 'includes/footer.php'; ?>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!-- Error Handling Popups -->
  <?php if (isset($_GET['error'])): ?>
    <script>
      $(document).ready(function() {
        $('#signup').modal('show');
        alert("<?= htmlspecialchars($_GET['error']); ?>");
      });
    </script>
  <?php endif; ?>

  <?php if (isset($_GET['errorl'])): ?>
    <script>
      $(document).ready(function() {
        $('#login').modal('show');
        alert("<?= htmlspecialchars($_GET['errorl']); ?>");
      });
    </script>
  <?php endif; ?>

  <!-- Login Error Modal -->
  <script>
    $(document).ready(function() {
      <?php if (isset($_SESSION['login_error'])): ?>
          $('#loginModal').modal('show');
      <?php endif; ?>
    });
  </script>

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="loginModalLabel">Login Failed</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          if (isset($_SESSION['login_error'])) {
              echo htmlspecialchars($_SESSION['login_error']);
              unset($_SESSION['login_error']);
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="index.php" class="btn btn-primary">Try Again</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
