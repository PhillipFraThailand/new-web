<?php
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
   
    require_once('track.php');
    require_once('../utility/sanitizer.php');

    $track = new Track();

    $data = json_decode(file_get_contents("php://input"));

    if ( isset($data->id) ) {
        $id = sanitize_input($data->id);

        $result = $track->deleteTrack($id);

        if ($result) {
            http_response_code(204);
        } else {
            http_response_code(400);
        }
        
    } else {
        http_response_code(400);
        echo('Try to post an id to be deleted');

    }
?>