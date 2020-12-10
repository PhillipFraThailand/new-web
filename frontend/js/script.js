$(document).ready(function(){
    // const URL = "./backend/api.php";
    const URL = "backend/api.php";

// submit login
    $("#login-button").click(function(){
        var email = $("#emailInput").val().trim();
        var password = $("#passwordInput").val().trim();
        var entity = "user";
        var action = "login";
        console.log(email);
        console.log(password);
        console.log(action);

        if( email != "" && password != "" ) {
            $.ajax({
                url:URL,
                type:'POST',
                data:{
                    entity:entity,
                    action: action, 
                    email:email,
                    password:password
                },  
                success: function(data){
                    console.log(data);
                    console.log('success');
                    $('#login-modal').modal('hide');
                    // location.reload();
                },
                failure: function(errMsg) {
                    console.log('failure');
                    console.log(errMsg);
                },
            }
        )}
    });


    // logout
    $("#logout-button").click(function(){
        // event.preventDefault();
        var entity = "user";
        var action = "login";
        console.log('logout button');
    
        $.ajax({
            url:URL,
            type:'POST',
            data:{
            entity:entity,
            action:action 
            },
            success: function(data) {
                console.log(data);
                console.log('success logging out');
            },
            failure: function(errMsg) {
                console.log(errMsg);
                console.log('error logging out');
                }
        })
    
    });






});
