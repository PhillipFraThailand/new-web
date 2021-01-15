<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once('user.php');
    require_once('../utility/sanitizer.php');
    $user = new User();
    
    $data = json_decode(file_get_contents("php://input"));

    // i assume that the frontend is requireing everything which is debateable
    if ( isset($data->firstName) ) {
        $user = new User();

        $firstName = sanitize_input($data->firstName);
        $password = sanitize_input($data->password);
        $lastName = sanitize_input($data->lastName);
        $company = sanitize_input($data->company);
        $address = sanitize_input($data->address);
        $city = sanitize_input($data->city);
        $state = sanitize_input($data->state);
        $country = sanitize_input($data->country);
        $postalCode = sanitize_input($data->postalCode);
        $phone = sanitize_input($data->phone);
        $fax = sanitize_input($data->fax);
        $email = sanitize_input($data->email);

        $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);

        if ($user) {
            http_response_code(202);
            echo(json_encode('success'));
        } else {
            echo(http_response_code(500));
            echo(json_encode('failure'));
        }
    } else {
        echo(json_encode('Please fill out everything in the form'));
        http_response_code(400);
    }
?>