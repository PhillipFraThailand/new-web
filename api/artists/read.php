<?php 
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once('artist.php');

    $artist = new Artist();
    
    $result['data'] = $artist->getArtists();

    $result['admin'] = $_SESSION['admin'];
    
    print_r(json_encode($result));

?>