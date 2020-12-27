<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // create the artist model
    include_once('artist.php');
    $artist = new Artist();

    // $_POST[''] only works if i use // contentType: "application/json"
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->name)) {
        $name = $data->name;

        $status = $artist->createArtist($name);
        if ($status) {
            http_response_code(202);
        } else {
            http_response_code(500);
        }

    } else {
        echo('Bad request. Try posting all the variables');
        http_response_code(400);
    }
?>