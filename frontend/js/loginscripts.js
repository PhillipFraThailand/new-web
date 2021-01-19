// SIGN UP
$("#signup-button").click(function() {
    $("$signup-modal").show();
});

// REGISTER
$("#register-button").click(function() {
    signupURL = './api/user/create.php';

    let firstName = $("#firstNameInp").val().trim();
    let lastName = $("#lastNameInp").val().trim();
    let password = $("#passwordInp").val().trim();
    let company = $("#companyInp").val().trim();
    let address = $("#addressInp").val().trim();
    let city = $("#cityInp").val().trim();
    let state = $("#stateInp").val().trim();
    let country = $("#countryInp").val().trim();
    let postalCode = $("#postalCodeInp").val().trim();
    let phone = $("#phoneInp").val().trim();
    let fax = $("#faxInp").val().trim();
    let email = $("#emailInp").val().trim();

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
