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

    // POST: contentType:"application/x-www-form-urlencoded; charset=UTF-8"
    if ( isset($_POST['email']) && isset($_POST['password']) ) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = new User();
        $result = $user->createSession($email, $password);

        if($result) {
            http_response_code(200);
            print_r(json_encode($_SESSION));
        } else {
            http_response_code(400);
            echo $result;
        }
    } else {
        http_response_code(400);
        echo('Please provide a email and a password');
    }

// saving this in case
// php:input: contentType: "application/json"
    // $data = json_decode(file_get_contents("php://input"));
    // header('Content-Type: application/json');

    // if ( isset($data->email)) {
    //     $res = json_encode('email is set');
    //     http_response_code(200);
    //     echo($res);
    // } else { 
    //     $res = json_encode('email is not set');
    //     http_response_code(400);
    //     echo($res);
    // }

    // echo $encData;
    // print_r($data->email);

?>