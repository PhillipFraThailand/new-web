<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/custom.css">
    <!-- Scripts -->
    <script defer src="frontend/js/jquery-3.5.1.js"></script>
    <script defer src="frontend/js/bootstrap.js"></script>
    <script defer src="frontend/js/script.js"></script>
    <title>Track Provider</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <!-- Burgermenu appears on small screen  -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo  -->
        <img src="frontend/Images/microphone.png" alt="Images/node.png" class="img-responsive">
        <a class="navbar-brand" href="#">Track Providers</a>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto" id="navbarSupportedContent">

                <button type="submit" class="btn btn-light">Home</button>

                <!-- Artist button -->
                <button id="artists-nav" type="submit" class="btn btn-light">Artists</button>

                    <button type="submit" class="btn btn-light" value="Submit">Albums</button>

                    <button type="submit" class="btn btn-light" >Tracks</button>

                    <button type="submit" class="btn btn-light" >Cart</button>

                <!-- Login / Account tab-->
                <div id="login-dropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">

                        <!-- Logged -->
                        <?php if (isset($_SESSION['userId'])): ?>
                            <button class="btn btn-light dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </button>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                                    <!-- DETAILS BUTTON                                     -->
                                    <button type="submit" class="btn btn-light dropdown-item">Details</button>
                                    <!-- LOGOUT BUTTON -->
                                    <button id="logout-button" type="submit" class="btn btn-light dropdown-item" name="action" value="logout">Sign out</button>

                                </div>
                        <?php endif; ?>

                        <!-- !Logged in require the loginModal-->
                        <?php if (!isset($_SESSION['userId'])):?>
                        <!-- Button to Trigger Modal -->
                            <button href="#login-modal" class="btn btn-light trigger-btn" data-toggle="modal">Sign in</a>
                        <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn bg-light my-2 my-sm-0"  type="submit">Search</button>
            </form>
        </div>
    </nav>


<!-- LOGIN MODAL -->
<div id="login-modal" class="modal fade">
	<div class="modal-dialog modal-login"> <!-- enables the sizing and closing -->
		<div class="modal-content">

            <!-- Header and close button -->
			<div class="modal-header">
				<h4 class="modal-title">User login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

			<div class="modal-body">
                <!-- Input fields -->
                <div class="form-group">
                    <input id="emailInput" type="text" class="form-control" placeholder="email" name="email" required="required">
                </div>
                
                <div class="form-group">
                    <input id="passwordInput" type="password" class="form-control" placeholder="password" name="password" required="required">
                </div>
                
                <!-- set action post variable to be login -->
                <input id="login-button" type="submit" value="Login" class="btn btn-primary btn-block btn-lg">
            </div>

            <!-- Sign up button -->
			<div class="modal-footer">
				<a href="" data-toggle="modal" data-target="#modalSignup">Sign up</a>
			</div>
		</div>
	</div>
</div>

<!-- SIGN UP MODAL -->
<div class="modal fade" id="modalSignup">
    <div class="modal-dialog"> <!-- enables the sizing and closing -->
        <div class="modal-content">

            <!-- Header and close button -->
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form action="api.php" method="POST">
                    <!-- Input fields -->
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First name" name="firstName" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last name" name="lastName" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" name="password" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Company" name="company" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Address" name="address" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="City" name="city" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="State" name="state" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Country" name="country" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Postal code" name="postalCode" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone number" name="phone" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Fax" name="fax" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>
                    <!-- set action post variable to be login -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" name="action" value="register"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>