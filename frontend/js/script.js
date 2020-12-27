$(document).ready(function(){

//hide content. it flashes on the frontpage right now hmm...
    $("#artists-div").hide();
    $("#tracks-div").hide();
    let URL = "./backend/api.php";

//ARTISTS
    $("#artists-nav").click(function(){
        // send POST (but get) for artists
        $.ajax({
            url:URL,
            type:'get',
            data:{
                entity:"artists",
                action:'GET'
            },
            success: function(res) {
                data = JSON.parse(res);
                console.log(data);
                console.log('name: ' + data[0].Name);
                setupArtistsTable(data);
            },
            failure: function(errMsg){
                console.log(errMsg);
            }
        })
    });

    // Table setup
    function setupArtistsTable(data){
        var tRow = '';
        data.forEach(element => {
            tRow += '<tr><td>' + element.Name + '</td></tr>';
            console.log('element name: ' + element.Name);
        });
        $("#artists-table").find('tBody').html(tRow);
        $("#artists-div").show();
    };

// SIGN UP
    $("#signup-button").click(function() {
        console.log('signup click');
        // $("$signup-modal").modal('show');
        $("$signup-modal").show();
    });
    
// REGISTER
    $("#register-button").click(function() {
        var entity = "user";
        var action = "register"

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
            url:URL,
            type:'POST',
            data: {
                entity:entity,
                action: action,
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
            }, success: function(data) {
                console.log(data);
            }
        })
    });

// logout
    $("#signout-nav").click(function(){
        var entity = "user";
        var action = "logout";
        console.log('FE: logout button', action, entity);
    
        $.ajax({
            url:URL,
            type:'POST',
            data:{
            entity:entity,
            action:action 
            },
            success: function(data) {
                console.log('success logging out');
                console.log('FE: ',data);
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            failure: function(errMsg) {
                console.log(errMsg);
                console.log('error logging out');
            }
        })
    });

    // SIGN IN
    $("#login-button").click(function() {

        var loginURL = './api/user/login.php';

        var email = $("#emailInput").val().trim();
        var password = $("#passwordInput").val().trim();
        console.log(email, password);

        if( email != "" && password != "" ) {
            console.log('sending request');

            $.ajax({
                url:loginURL,
                type:'POST',
                // dataType:'json',                     // no difference
                // contentType: "application/json",    // error                          // php://input
                // contentType:"application/x-www-form-urlencoded; charset=UTF-8",      // $_POST
                data:{
                    email:email,
                    password:password
                },  
                success: function(textStatus, status, data) {
                    console.log(data);
                    console.log('success');
                    location.reload();


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

    function sleep(milliseconds, func){
        setTimeout(()=> {
        },milliseconds)
    }
// EOF
});
