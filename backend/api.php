<?php
    session_start();
    require_once('user.php');
    require_once('sanitizer.php');

if ( !isset($_POST['entity']) && !isset($POST_['action'])) {
    echo('error from php: ');
    print_r($_POST);
} else {
    $entity = $_POST['entity'];
    $action = $_POST['action'];
    $verb = $_SERVER['REQUEST_METHOD'];
    
    switch($entity) {
        //user
        case 'user':
            //login
            switch($action) {
                case 'login':
                    loginUser();
                    print_r($_SESSION);
                break;
                //logout
                case 'logout':
                    echo('session destroy');
                    // session_destroy();
                break;
                }

        break;
        //artists
        case 'artists':
            require_once('/Database/artists.php');
            $artists = new Artists();

            switch($action) {
                case 'getArtists':
                    echo json_encode($artists->fetchArtists());
                break;

                case 'deleteArtist':
                    echo('deleteArtist');
                break;
            }
        break;
        //tracks
    }
}
    
    // SIGNUP
    function registerUser(){
        $user = new User();
        // Currently i assume the form is requiring everything which is debateable
        if (isset($_POST['firstName'])) {
            $firstName = sanitize_input($_POST['firstName']);
            $lastName = sanitize_input($_POST['lastName']);
            $password = sanitize_input($_POST['password']);
            $company = sanitize_input($_POST['company']);
            $address = sanitize_input($_POST['address']);
            $city = sanitize_input($_POST['city']);
            $state = sanitize_input($_POST['state']);
            $country = sanitize_input($_POST['country']);
            $postalCode = sanitize_input($_POST['postalCode']);
            $phone = sanitize_input($_POST['phone']);
            $fax = sanitize_input($_POST['fax']);
            $email = sanitize_input($_POST['email']);
        };
        
        // call create to insert into DB
        $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);

        // if insert was succesfull
        if ($user) {
            echo('succes creating user! Go back to ');
            echo('<a href="./index.php">Home</a>');
        } else {
            echo('Error creating user');
        }
    }

    // LOGIN
    function loginUser(){
        $user = new User();
        // Sanitize inputs
       $email = sanitize_input($_POST['email']);
       $password = sanitize_input($_POST['password']);

       // if valid create session
       $validUser = $user->createSession($email, $password);
       if ($validUser) {
        //    return true;
            echo(http_response_code(200));
       } else {
        //    return false;
            echo(http_response_code(401));    // unauthorized
        }
    }

    // UPDATE USER (assumes the html requires all fields)
    function updateUser(){
        $user = new User();
        if (isset($_POST['firstName'])) {
            $firstName = sanitize_input($_POST['firstName']);
            $lastName = sanitize_input($_POST['lastName']);
            $oldPassword = sanitize_input($_POST['oldPassword']);
            $newPassword = sanitize_input($_POST['newPassword']);
            $company = sanitize_input($_POST['company']);
            $address = sanitize_input($_POST['address']);
            $city = sanitize_input($_POST['city']);
            $state = sanitize_input($_POST['state']);
            $country = sanitize_input($_POST['country']);
            $postalCode = sanitize_input($_POST['postalCode']);
            $phone = sanitize_input($_POST['phone']);
            $fax = sanitize_input($_POST['fax']);
            $newEmail = sanitize_input($_POST['newEmail']);

            $oldEmail = $_SESSION['email'];
        };

        $status = $user->updateUser($firstName, $lastName, $oldPassword, $newPassword, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $oldEmail, $newEmail);

        // if succes updating
        if ($status) {
            echo('success updating info');
        } else {
            echo('failure updating info');
        }

    }
?>

