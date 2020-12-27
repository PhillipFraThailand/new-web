<?php 
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // create the artist model
    include_once('artist.php');
    $artist = new Artist();

    $result = $artist->getArtists();

    echo(json_encode($result));

    //should add some if result <= 0 then say error
?>