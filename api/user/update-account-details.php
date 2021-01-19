<?php
    session_start();
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once('user.php');
    require_once('../utility/sanitizer.php');
    $user = new User();
    
    $data = json_decode(file_get_contents('php://input'));

    if (isset($data->firstName)) {
        $oldEmail = $_SESSION['email'];

        $firstName = sanitize_input($data->firstName);
        $lastName = sanitize_input($data->lastName);
        $oldPassword = sanitize_input($data->oldPassword);
        $newPassword = sanitize_input($data->newPassword);
        $company = sanitize_input($data->company);
        $address = sanitize_input($data->address);
        $city = sanitize_input($data->city);
        $state = sanitize_input($data->state);
        $country = sanitize_input($data->country);
        $postalCode = sanitize_input($data->postalCode);
        $phone = sanitize_input($data->phone);
        $fax = sanitize_input($data->fax);
        $newEmail = sanitize_input($data->newEmail);

    } else {
        http_response_code(400);
        echo(json_encode('Please post all the values'));
    };

    $result = $user->updateUser($firstName, $lastName, $oldPassword, $newPassword, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $oldEmail, $newEmail);

    if ($result) {
        http_response_code(201);
        echo(json_encode($result));
    } else {
        http_response_code(500);
        echo(json_encode('Database error'));
    }

?>