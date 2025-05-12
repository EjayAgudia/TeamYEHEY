<!-- Navigation bar start -->
<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-danger bg-opacity-75 shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand" style="font-family: 'Delius Swash Caps'; font-size: 1.5rem;">Shoplift</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbar-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu">
                        <a href="products.php#watch" class="dropdown-item">Watches</a>
                        <a href="products.php#shirt" class="dropdown-item">T-Shirts</a>
                        <a href="products.php#shoes" class="dropdown-item">Shoes</a>
                        <a href="products.php#headphones" class="dropdown-item">Headphones/Speakers</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">About Us</a>
                </li>
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a href="cart.php" class="nav-link">Cart</a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a href="logout_script.php" class="nav-link">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="popover" data-trigger="hover" data-content="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                            <i class="fa fa-user-circle"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="#signup" class="nav-link" data-toggle="modal">
                            <i class="fa fa-user"></i> Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#login" class="nav-link" data-toggle="modal">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Navigation bar end -->

<!-- Login Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="login_script.php" method="post">
                    <div class="form-group">
                        <label for="lemail">Email address</label>
                        <input type="email" class="form-control" name="lemail" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="lpassword">Password</label>
                        <input type="password" class="form-control" name="lpassword" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block mt-3" name="Submit">Login</button>
                </form>
                <a href="#">Forgot password?</a>
            </div>
            <div class="modal-footer">
                <p class="mr-auto mb-0">New User? 
                    <a href="#signup" data-toggle="modal" data-dismiss="modal">Sign Up</a>
                </p>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Login Modal end -->

<!-- Signup Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="signup_script.php" method="post">
                    <div class="form-group">
                        <label for="eMail">Email address</label>
                        <input type="email" class="form-control" name="eMail" placeholder="Enter email" required>
                        <?php if (isset($_GET['error'])): ?>
                            <span class="text-danger"><?php echo htmlspecialchars($_GET['error']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">Agree to terms and conditions</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3" name="Submit">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mr-auto mb-0">Already Registered? 
                    <a href="#login" data-toggle="modal" data-dismiss="modal">Login</a>
                </p>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Signup Modal end -->
