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
    <script defer src="frontend/js/loginscripts.js"></script>
    <script defer src="frontend/js/script.js"></script>
    <title>Track Provider</title>
</head>

<!-- LOGIN -->
	<div class="modal-dialog modal-login"> <!-- enables the sizing and closing -->
		<div class="modal-content">

            <!-- Header and close button -->
			<div class="modal-header">
				<h4 class="modal-title">Please login to continue</h4>
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
				<button class="btn " data-toggle="modal" data-target="#signup-modal">Sign up</button>
			</div>
		</div>
	</div>

    <!-- SIGN UP -->
    <div class="modal fade" id="signup-modal">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">

                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <form> <!--- form to make required work --->
                    <!-- Input fields -->
                    <div class="form-group">
                        <input id="firstNameInp" type="text" class="form-control" placeholder="First name" name="firstName" required="required">
                    </div>

                    <div class="form-group">
                        <input id="lastNameInp" type="text" class="form-control" placeholder="Last name" name="lastName" required="required">
                    </div>

                    <div class="form-group">
                        <input id="passwordInp" type="text" class="form-control" placeholder="Password" name="password" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="companyInp" type="text" class="form-control" placeholder="Company" name="company" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="addressInp" type="text" class="form-control" placeholder="Address" name="address" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="cityInp" type="text" class="form-control" placeholder="City" name="city" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="stateInp" type="text" class="form-control" placeholder="State" name="state" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="countryInp" type="text" class="form-control" placeholder="Country" name="country" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="postalCodeInp" type="text" class="form-control" placeholder="Postal code" name="postalCode" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="phoneInp" type="text" class="form-control" placeholder="Phone number" name="phone" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="faxInp" type="text" class="form-control" placeholder="Fax" name="fax" required="required">
                    </div>
                    
                    <div class="form-group">
                        <input id="emailInp" type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>

                    <div class="form-group">
                        <input id="register-button" class="btn btn-primary btn-block btn-lg" value="Register"></input>
                    </div>
                    </form>
                </div> <!--- modal body end--->
            </div>
        </div>
    </div>