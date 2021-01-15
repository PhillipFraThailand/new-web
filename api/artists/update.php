<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require_once('artist.php');
    require_once('../utility/sanitizer.php');
    $artist = new Artist();

    $data = json_decode(file_get_contents("php://input"));
    
    if (isset($data->name) && isset($data->id) ) {
        $name = sanitize_input($data->name);
        $id = sanitize_input($data->id);

        $result = $artist->updateArtist($name, $id);

        if ($result) {
            http_response_code(204);
        } else {
            http_response_code(400);
        }
        
    } else {
        echo('Bad request, did you post a name and id?');
        http_response_code(400);
    }  
?>