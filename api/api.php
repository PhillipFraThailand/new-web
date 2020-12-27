<?php
    session_start();
    require_once('user.php');
    require_once('sanitizer.php');
    
    // get the method type
    $verb = $_SERVER['REQUEST_METHOD'];
    switch ($verb) {
        default:
            echo('Hi please read the documentation for usage or try using OPTIONS');
            exit;
        break;
        case 'OPTIONS':
            echo('Examples of usage...');
            exit;
            break;
        case 'POST':
            echo('you used POST');
            // have a POST method with a switch in?
            break;
        case 'GET':
            echo('you use GET');
            break;
    }
    switch (isset($_POST)) {
        case 'user':
            echo('user entity');
        break;
        default;
            echo('default entity');
        break;
    }
if ( !isset($_POST['entity']) || !isset($_POST['action'])) {
    // echo('Error in POST request. Maybe the entity or action is not set? or you are trying to GET?');
    print_r($_POST);
} else {
    $entity = $_POST['entity'];
    $action = $_POST['action'];
    echo($verb);
    switch($entity) {
        //user entity
        case 'user':
            //login
            switch($action) {
                case 'login':
                    loginUser();
                    echo('Response: ' . http_response_code(200));
                break;
                //logout
                case 'logout':
                    //free all sesssions variables 
                    session_unset();
                    //clear sessions from server
                    session_destroy();
                break;
                //register
                case 'register':
                    registerUser();
                break;
            }
        break;

        //artists entity
        case 'artists':
            require_once('artists.php');
            $artists = new Artists();

            switch($action) {
                case 'GET':
                    // header("HTTP/1.1 200 OK");
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
        // I assume the form is requiring everything which is debateable 
        if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {
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

        // call create to insert into DB returns bool
        $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);

        // if insert was succesfull
        if ($user) {
            echo(http_response_code(200));
        } else {
            echo(http_response_code(500));
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
        header("HTTP/1.1 200 OK");
        //    echo(http_response_code(200));
            // return true;
       } else {
        //    return false;
        header("HTTP/1.1 400 BAD REQUEST");
            // echo(http_response_code(401));    // unauthorized
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

