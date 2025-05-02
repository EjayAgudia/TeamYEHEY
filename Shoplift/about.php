<?php
require ("includes/common.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>About Us | Shoplift</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <style>
    .about-hero {
      background: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') center center/cover no-repeat;
      height: 400px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
    }
    .about-hero h1 {
      font-size: 3rem;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
    }
    .section-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 20px;
      border-left: 5px  rgb(177, 77, 77);
      padding-left: 15px;
    }
    .contact-form {
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 30px;
      border-radius: 8px;
    }
  </style>
</head>

<body style="overflow-x:hidden; padding-bottom:100px;">

<?php include 'includes/header_menu.php'; ?>

<div class="about-hero">
  <h1>About Shoplift</h1>
</div>

<div class="container my-5">
  <div class="row align-items-center mb-5" >
    <div class="col-md-6">
    <h2 class="section-title" style="color: rgb(177, 77, 77);">Who We Are</h2>
      <p>Welcome to <strong>Shoplift</strong>, your number one destination for all things trendy and affordable. We're passionate about delivering a seamless online shopping experience, offering a wide variety of products to suit every taste and lifestyle.</p>
      <p>Founded in 2023, Shoplift has quickly grown from a small idea to a thriving online store, thanks to our dedication to customer service and quality products. Our mission is simple: to make shopping enjoyable, easy, and reliable—24/7, 365 days a year.</p>
    </div>
    <div class="col-md-6">
      <img src="images/one.jpg" class="img-fluid rounded shadow">
    </div>
  </div>

  <div class="row align-items-center mb-5">
    <div class="col-md-6 order-md-2">
    <h2 class="section-title" style="color: rgb(177, 77, 77);">Our Vision & Mission</h2>
      <p>We aim to become the most customer-centric online store, where shoppers can discover anything they might want to buy online, at unbeatable prices. Our commitment to innovation and customer satisfaction drives us to stay ahead of trends and deliver the best shopping experiences.</p>
      <p>Whether you're looking for the latest fashion, tech gadgets, or home essentials, Shoplift is here to meet your needs with quality and care.</p>
    </div>
    <div class="col-md-6 order-md-1">
      <img src="images/two.jpg" class="img-fluid rounded shadow">
    </div>
  </div>

  <!-- Our Team Section -->
  <div class="row text-center my-5">
    <div class="col">
    <h2 class="section-title" style="color: rgb(177, 77, 77);">Our Team</h2>
      <p class="lead">Meet the visionary leaders behind Shoplift:</p>
      <ul class="list-unstyled">
        <li><strong>Agudia, Ejay</strong> – CEO</li>
        <li><strong>Foronda, Emmanuel</strong> – CEO</li>
        <li><strong>Andres, Paul Raynee</strong> – CEO</li>
        <li><strong>Ocampo, Dwayne</strong> – CEO</li>
        <li><strong>Oboob, Christian</strong> – CEO</li>
      </ul>
    </div>
  </div>
  <!-- End Our Team Section -->

  <div class="row text-center">
    <div class="col">
      <h2 class="section-title" style="color: rgb(177, 77, 77);">Live Support</h2>
      <p class="lead">We’re available 24/7 to help you with any issues or inquiries. Your satisfaction is our priority.</p>
    </div>
  </div>
</div>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 contact-form">
      <h3 class="section-title" style="color: rgb(177, 77, 77);">Contact Us</h3>
      <form action="https://formspree.io/EnterYourEmail" method="POST">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
        </div>
        <div class="form-group">
          <label for="message">Your Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
        </div>
        <input type="hidden" name="_next" value="http://localhost/foody/about.php" />
        <button type="submit" class="btn btn-warning btn-block">Send Message</button>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    if (window.location.href.indexOf('#login') != -1) {
      $('#login').modal('show');
    }
  });
</script>

</body>
</html>
