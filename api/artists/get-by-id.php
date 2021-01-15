<?php
session_start();

    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // create the artist model
    include_once('artist.php');
    require_once('../utility/sanitizer.php');

    $artist = new Artist();

    // if get[id] set, else close connection
    if (isset($_GET['id'])) {
        $id = sanitize_input($_GET['id']);


        $result = $artist->getArtistById($id);
        
        if ($_session['admin'] = 'YES') {
            $result['admin'] = 'YES';
        } else {
            $result['admin'] = 'NO';
        }
        if ($result) {
                echo($result);
                http_response_code(201);
        } else {
            http_response_code(400);
            echo('Are you sure the id exist?');
        }

    } else {
        http_response_code(400);
        echo('Example of usage: "localhost:8080/new-web/api/artists/get-by-id.php/?id=1"');
    }
?>