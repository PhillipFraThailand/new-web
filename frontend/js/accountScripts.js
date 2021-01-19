$(document).ready( function() {
    isSetupAccount = false;

    $('#account-nav').on('click', function(){
        $('#artists-div').hide();
        $('#tracks-div').hide();
        $('#albums-div').hide();
        $('#cart-div').hide();
        getAccountInfo();
    });

    // update button show modal
    $('#account-table').on('click', '.update-btn', function(){
        $('#firstNameInp').val(this.getAttribute('data-firstName'));
        $('#lastNameInp').val(this.getAttribute('data-lastName'));
        $('#companyInp').val(this.getAttribute('data-company'));
        $('#addressInp').val(this.getAttribute('data-address'));
        $('#cityInp').val(this.getAttribute('data-city'));
        $('#stateInp').val(this.getAttribute('data-state'));
        $('#countryInp').val(this.getAttribute('data-country'));
        $('#postalCodeInp').val(this.getAttribute('data-postalCode'));
        $('#phoneInp').val(this.getAttribute('data-phone'));
        $('#faxInp').val(this.getAttribute('data-fax'));
        $('#emailInp').val(this.getAttribute('data-email'));

        $('#updateAccount-modal').modal('show');
    });

    // submit new values to php
    $('#update-account-btn').on('click', function() {
        let updateAccountUrl = './api/user/update-account-details.php';
        let firstName = $("#firstNameInp").val().trim();
        let lastName = $("#lastNameInp").val().trim();
        let oldPassword = $("#oldPasswordInp").val().trim();
        let newPassword = $("#newPasswordInp").val().trim();
        let company = $("#companyInp").val().trim();
        let address = $("#addressInp").val().trim();
        let city = $("#cityInp").val().trim();
        let state = $("#stateInp").val().trim();
        let country = $("#countryInp").val().trim();
        let postalCode = $("#postalCodeInp").val().trim();
        let phone = $("#phoneInp").val().trim();
        let fax = $("#faxInp").val().trim();
        let newEmail = $("#emailInp").val().trim();

        $.ajax({
            url: updateAccountUrl,
            type:'post',
            data: JSON.stringify({
                firstName: firstName,
                lastName: lastName,
                oldPassword: oldPassword,
                newPassword: newPassword,
                company: company,
                address: address,
                city: city,
                state: state,
                country: country,
                postalCode: postalCode,
                phone: phone,
                fax: fax,
                newEmail: newEmail
            }),
            success:function() {
                $('#updateAccount-modal').modal('hide');
                getAccountInfo();
            },
            error:function(e) {
                console.log(e);
            }
        })
    });

    function getAccountInfo() {
        let accountUrl = './api/user/account-details.php';
        
        $.ajax({
            url:accountUrl,
            type:'get',
            success:function(data) {
                setupAccountTable(data);
            }, 
            error:function(e){
                console.log(e);
            }
        });
    }

    function setupAccountTable(data) {
        let tRow = '';
        isSetupAccount = true;
        console.log(data)
        
        data.forEach(e => {
            let address = '<td>' + e.Address + '</td>';
            let city = '<td>' + e.City + '</td>';
            let company = '<td>' + e.Company + '</td>';
            let email = '<td>' + e.Email + '</td>';
            let fax = '<td>' + e.Fax + '</td>';
            let firstName = '<td>' + e.FirstName + '</td>';
            let lastName = '<td>' + e.LastName + '</td>';
            let phone = '<td>' + e.Phone + '</td>';
            let postalCode = '<td>' + e.PostalCode + '</td>';;
            let state = '<td>' + e.State + '</td>';
            let dataAttributes = `data-address="${e.Address}" data-city="${e.City}" data-company="${e.Company}" data-email="${e.Email}" data-fax="${e.Fax}" data-firstName="${e.FirstName}" 
                                data-lastName="${e.LastName}" data-phone="${e.Phone}" data-postalCode="${e.PostalCode}" data-state="${e.State}" data-country="${e.Country}"`;
            let updateBtn = '<td>' +`&nbsp <button class="btn btn-primary update-btn" ${dataAttributes}>Update</button>` + '</td>';

            tRow += '<tr>' + firstName + lastName + email + phone + fax + company +  address + city + postalCode + state + updateBtn + '</td></tr>';
        });
        
        $("#account-table").find('tBody').html(tRow);
        $("#account-div").show();   
    }

});

