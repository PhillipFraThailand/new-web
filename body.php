<main>
    <!----------- ARTISTS TABLE ----------->
    <div id="artists-div" class="navigation">
        <table class="table table-striped table-bordered table-hover" id="artists-table">
            <thead id="artists-head">
                <tr>
                    <th>Artist</th>
                </tr>
            </thead>
            <tbody id="artists-tbody"></tbody>
        </table>
        <nav id="pagination-nav">
            <ul class="pagination">
                <li id="previousArtist-link" class="page-item"><a class="page-link"><<</a></li>
                <li id="nextArtist-link" class="page-item"><a class="page-link">>></a></li>
            </ul>
        </nav>
    </div>

    <!----------- TRACKS TABLE  ----------->
    <div id="tracks-div" class="navigation">
        <table class="table table-striped table-bordered table-hover" id="tracks-table">
            <!-- TRACKS -->
            <thead id="tracks-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tracks-body"></tbody>
        </table>
        <nav id="pagination-nav">
            <ul class="pagination">
                <li id="previousTracks-link" class="page-item"><a class="page-link"><<</a></li>
                <li id="nextTracks-link" class="page-item"><a class="page-link">>></a></li>
            </ul>
        </nav>
    </div>

    <!----------- ALBUMS TABLE----------->
    <div id="albums-div" class="navigation">
        <table>
            <thead id="album-head" class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>test</th>
                    <th></th>
                    <th></th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="album-body"></tbody>
        </table>
    </div>

    <!----------- CART TABLE ----------->
    <div id="cart-div" class="navigation"> 
        <table id="cart-table" class="table table-striped table-bordered table-hover">
            <thead id="cart-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Price</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="cart-tbody"></tbody>
        </table>
    </div>

    <!----------- ACCOUNT ----------->
    <div id="account-div" class="navigation"> 
    <table class="table table-striped table-bordered table-hover" id="account-table">
            <!-- Account Details -->
            <thead id="tracks-head">
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Fax</th>
                    <th>Company</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Postal Code</th>
                    <th>State</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="account-body"></tbody>
        </table>
    </div>

    <!-- Update Acccount modal -->
    <div class="modal fade" id="updateAccount-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Update Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="post"> <!--- form to make required work --->
                    <div class="form-group">
                        <input id="firstNameInp" type="text" class="form-control" placeholder="First name" name="firstName" required="required">
                    </div>

                    <div class="form-group">
                        <input id="lastNameInp" type="text" class="form-control" placeholder="Last name" name="lastName" required="required">
                    </div>

                    <div class="form-group">
                        <input id="oldPasswordInp" type="text" class="form-control" placeholder="Old Password" name="password" required="required">
                    </div>

                    <div class="form-group">
                        <input id="newPasswordInp" type="text" class="form-control" placeholder="New Password" name="password" required="required">
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
                        <input id="update-account-btn" class="btn btn-primary btn-block btn-lg" value="Update"></input>
                    </div>
                    </form>
                </div> <!--- modal body end--->
                <div class="modal-footer">
                    <div class="clearfix">
                        <button  id="cancelUpdate" data-dismiss="modal" class="btn btn-warning btn-block btn-lg">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>