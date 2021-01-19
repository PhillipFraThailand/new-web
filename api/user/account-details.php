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
    
    $email = $_SESSION['email'];
    $email = sanitize_input($email);
    
    $details = $user->findUser($email);

    print_r(json_encode($details));
?>