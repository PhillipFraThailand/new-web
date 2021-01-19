<?php 
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once('track.php');
    require_once('../utility/sanitizer.php');

    $track = new Track();
    
    $limit = 25;

    if (isset($_GET['page']) && ($_GET['page'] > 0)) {
        $page = sanitize_input((int)$_GET['page']);
        $offset = ($page * $limit -1);
        // Make the next bage skip to end of DB for examn
        // $offset = 3501;
    } else {
        $offset = 0;
    };

    $result['data'] = $track->getTracks($offset,$limit);

    // because we cant set admin using insomnia..
    if (isset($_SESSION['admin'])) {
        $result['admin'] = $_SESSION['admin'];
    }
    
    print_r(json_encode($result));

?>