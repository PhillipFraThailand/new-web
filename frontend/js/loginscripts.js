// SIGN UP
$("#signup-button").click(function() {
    $("$signup-modal").show();
});

// REGISTER
$("#register-button").click(function() {
    signupURL = './api/user/create.php';

    var firstName = $("#firstNameInp").val().trim();
    var lastName = $("#lastNameInp").val().trim();
    var password = $("#passwordInp").val().trim();
    var company = $("#companyInp").val().trim();
    var address = $("#addressInp").val().trim();
    var city = $("#cityInp").val().trim();
    var state = $("#stateInp").val().trim();
    var country = $("#countryInp").val().trim();
    var postalCode = $("#postalCodeInp").val().trim();
    var phone = $("#phoneInp").val().trim();
    var fax = $("#faxInp").val().trim();
    var email = $("#emailInp").val().trim();

    $.ajax({
        url:signupURL,
        type:'POST',
        data: JSON.stringify({
            firstName: firstName,
            lastName: lastName,
            password: password,
            company: company,
            address: address,
            city: city,
            state: state,
            country: country,
            postalCode: postalCode,
            phone: phone,
            fax: fax,
            email: email
        }), success: function(data) {
            location.reload();
        }, failure: function(e) {
            console.log('failure: ' + e);
        }, error: function(e) {
            console.log('error: ' + e);
            console.log(e);
        }
    })
});

// SIGN OUT
$("#signout-nav").click(function() {
    console.log('logout button');
    signoutURL = "./api/user/logout.php";
    $.ajax({
        url:signoutURL,
        type:'POST',

        success: function(a,b,data) {
            console.log('success logging out');

            // setTimeout(function(){
                location.reload();
            // }, 1000);
        },
        failure: function(errMsg) {
            console.log(errMsg);
            console.log('error logging out');
        },
        error: function(e) {
            console.log('error');
            console.log(e);
            setTimeout(function(){
                location.reload();
            }, 1000);
        }
    })
});

// SIGN IN
$("#login-button").click(function() {
    var loginURL = './api/user/login.php';
    var email = $("#emailInput").val().trim();
    var password = $("#passwordInput").val().trim();

    if( email != "" && password != "" ) {
        $.ajax({
            url:loginURL,
            type:'POST',
            crossDomain: true,
            data: JSON.stringify({
                email:email,
                password:password
            }),  
            success: function(data) {   
                location.reload();

                if (data['admin'] == 'YES') {
                    isAdmin = true;
                    console.log('isAdmin: ', isAdmin);
                } else {
                    console.log('isAdmin: ', isAdmin);
                }
            },
            failure: function(errMsg) {
                console.log('failure');
                console.log(errMsg);
            },
            error: function(e) {
                console.log('error');
                console.log(e);
            },
        }
    )}
});
