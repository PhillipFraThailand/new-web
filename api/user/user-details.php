<!-- EDIT MODAL -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog"> <!-- enables the sizing and closing -->
        <div class="modal-content">

        <!-- Header and close button -->
        <div class="modal-header">
            <h4 class="modal-title">Edit details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <!-- Input fields -->
        <div class="modal-body">
            <form action="api.php" method="POST">

                <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" placeholder="<?php echo($firstName); ?>" name="firstName" required="required" value="<?php echo($firstName); ?>">
                </div>

                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" placeholder="<?php echo($lastName); ?>" name="lastName" required="required" value="<?php echo($lastName); ?>">
                </div>

                <div class="form-group">
                    <label>Old password</label>
                    <input type="text" class="form-control" placeholder="<?php echo($password); ?>" name="oldPassword" required="required">
                </div>

                <div class="form-group">
                    <label>New password</label>
                    <input type="text" class="form-control" placeholder="New password" name="newPassword" required="required">
                </div>

                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" placeholder="<?php echo($company); ?>" name="company" required="required"  value="<?php echo($lastName); ?>">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="<?php echo($address); ?>" name="address" required="required"  value="<?php echo($address); ?>">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="<?php echo($city); ?>" name="city" required="required"  value="<?php echo($city); ?>">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" placeholder="<?php echo($state); ?>" name="state" required="required" value="<?php echo($state); ?>">
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" placeholder="<?php echo($country); ?>" name="country" required="required"  value="<?php echo($country); ?>">
                </div>

                <div class="form-group">
                    <label>Postal code</label>
                    <input type="text" class="form-control" placeholder="<?php echo($postalCode); ?>" name="postalCode" required="required"  value="<?php echo($postalCode); ?>">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="<?php echo($phone); ?>" name="phone" required="required"  value="<?php echo($phone); ?>">
                </div>

                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control" placeholder="<?php echo($fax); ?>" name="fax" required="required"  value="<?php echo($fax); ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="<?php echo($email); ?>" name="newEmail" required="required"  value="<?php echo($email); ?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block btn-lg" name="action" value="updateUser"></button>
                </div>
            </form>
        </div>
    </div>
</div>
