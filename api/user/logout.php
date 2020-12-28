<?php
    session_start();

    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if (isset ($_SESSION['userId']) ) {
        echo(json_encode('success'));
        http_response_code(200);
        session_destroy();
    } else {
        echo(json_encode('no session to destroy'));
        http_response_code(200);
    }