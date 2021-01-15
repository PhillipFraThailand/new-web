$(document).ready(function(){
    //hiding content. it flashes on the frontpage right now hmm...
    $("#artists-div").hide();
    $("#tracks-div").hide();
    isAdmin = false;
    isSetup = false;

    

// HOME
$('#home-nav').click(function() {
    console.log(isAdmin)
    $("#artists-div").hide();
});

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
                data: JSON.stringify({
                    email:email,
                    password:password
                }),  
                success: function(data) {   
                    // setTimeout(function(e) {
                        location.reload();
                    // }2000)

                    // console.log(data)
                    // console.log('admin', data['admin']);

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

// ARTISTS
    $("#artists-nav").click(function() {
        getArtistsURL = './api/artists/read.php'
        $.ajax({
            url:getArtistsURL,
            type:'GET',

            success: function(res) {
                console.log('data', res['data']);
                console.log('isadmin: ' + res['admin']);

                if (res['admin'] == 'YES') {
                    isAdmin = true;
                } else {
                    console.log('No admin')
                };
                setupArtistsTable(res['data']);
            },
            failure: function(errMsg) {
                console.log(errMsg);
            }, error: function(e) {
                console.log('error', e);
            }
        })
    });
    // Table setup
    function setupArtistsTable(data) {
        let tRow = '';
        
        if (isAdmin == true && !isSetup) {
            isSetup = true;
            let createBtn = `&nbsp <button id="create-btn" class="btn btn-success create-btn">Create artist</button>`;
            $('#artists-table').find('#options-th').append(createBtn);
        }
        
        data.forEach(element => {
            let artistId = element.ArtistId
            
            if (isAdmin == true) {
                let deleteBtn = `&nbsp <button id="$delete-btn${artistId}" data-artistId="${artistId}" data-artistName="${element.Name}" class="btn btn-danger delete-btn">Delete</button>`;
                let updateBtn = `&nbsp <button id="update-btn${artistId}" data-artistId="${artistId}" class="btn btn-primary update-btn">Update</button>`;
                tRow += '<tr><td>' + element.Name + '</td><td>' + updateBtn + deleteBtn + '</td></tr>';
            } else {
                tRow += '<tr><td>' + element.Name + '</td></tr>'; //cart 
            }
            
        });
        $("#artists-table").find('tBody').html(tRow);
        $("#artists-div").show();
    };

    // create-btn
    $('#artists-table').on('click', '.create-btn', function() {
        $('#createArtist-modal').modal('show');
    });

    // create-btn submit
    $('#createArtist-yes').on('click', function() {
        let createUrl = './api/artists/create.php';
        let artistName = $('#artistName-inp').val().trim();

        if (artistName != "") {

            $.ajax({
                url:createUrl,
                type: 'POST',
                data: JSON.stringify({
                    name:artistName
                }),
                success:function(data) {
                    console.log('success');
                },
                failure:function(errMsg) {
                    console.log('failure update');
                },
                error:function(e) {
                    console.log('error');
                }
            })
        } else {
            alert('Fill out the field please')
        }
    });

    // update-btn shows update name modal and sets id to be set
    $('#artists-table').on('click', '.update-btn', function() {
        let id = this.getAttribute('data-artistId');
        $('#artistId-inp').val(id)
        $('#updateArtist-modal').modal('show');
    });
    
    // update-btn submit
    $("#updateName-submit").on('click', function(e) {
        let updateURL = './api/artists/update.php';
        let name = $("#update-inp").val().trim(); 
        let id = $("#artistId-inp").val().trim();

        if (name != "") {
            console.log(id,name)

            $.ajax({
                url: updateURL,
                type: 'POST',
                data: JSON.stringify({
                    id:id,
                    name:name                
                }),
                success:function(response) {
                    console.log('updated');
                    $("#updateArtist-modal").modal('hide');
                },
                failure:function(errMsg) {
                    console.log('failure update');
                },
                error:function(e) {
                    console.log('error');
                }
            })
        } else {
            alert('please provide a name');
        }
    });

    // delete-btn
    $("#artists-table").on('click', '.delete-btn', function() {
        let artistName = this.getAttribute('data-artistName');
        let id = this.getAttribute('data-artistId');
        
        $('#artistId-delInp').val(id);
        $('#confirm-delete-txt').html('Sure you want to delete "' + artistName + '"');
        $("#deleteArtist-modal").modal('show');
    });
    
    // delete-btn no
    $('#deleteArtist-no').on('click', function() {
        $("#deleteArtist-modal").modal('hide');
    });

    // delete-btn yes
    $('#deleteArtist-yes').on('click', function() {
        let deleteUrl ='./api/artists/delete.php'
        let id = $('#artistId-delInp').val().trim();

        $.ajax({
            url:deleteUrl,
            type: 'POST',
            data: JSON.stringify({
                id:id
            }),
            success:function(data) {
                console.log('success');
                alert('Artist deleted');
                $('#deleteArtist-modal').modal('hide');

            },
            failure:function(errMsg) {
                console.log('failure update');
            },
            error:function(e) {
                console.log('error');
                alert('Check possible constraint violations: no deletions were made');
            }
        });
    });

}); // EOF
