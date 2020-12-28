<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // create the artist model
    require_once('user.php');
    require_once('../utility/sanitizer.php');
    $user = new User();

    // $_POST[''] only works if i use // contentType: "application/json"
    // $data = file_get_contents("php://input");

    http_response_code(201);

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

        // echo(json_encode($firstName . $lastName . $password . $company . $address . $city . $state . $country . $postalCode . $phone . $fax .  $email));

        // call create to insert into DB returns bool
        $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);

        // if insert was succesfull i have to echo some json so ajax thinks its a success 
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



    // if (isset($data->name)) {
    //     $name = $data->name;

    //     $status = $artist->createArtist($name);
    //     if ($status) {
    //         http_response_code(202);
    //     } else {
    //         http_response_code(500);
    //     }

    // } else {
    //     echo('Bad request. Try posting all the variables');
    //     http_response_code(400);
    // }
?>