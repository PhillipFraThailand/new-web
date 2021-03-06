<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once('artist.php');
    require_once('../utility/sanitizer.php');

    $artist = new Artist();

    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->name)) {
        $name = sanitize_input($data->name);

        $result = $artist->createArtist($name);

        if ($result) {
            http_response_code(204);
        } else {
            http_response_code(500);
        }

    } else {
        echo('Bad request. Try posting all the variables');
        http_response_code(400);
    }
?>