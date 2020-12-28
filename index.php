<?php
    session_start();

    // if session is set show header and body
    if ( isset($_SESSION['userId']) ) {
        require_once('header.php');
        // check if admin
        switch ($_SESSION['admin']) {
            case 'YES':
                require_once('adminBody.php');
                break;
            case 'NO':
                require_once('body.php');
            break;
    
            default:
                echo('default body');
                echo('<pre>');
                print_r($_SESSION);
                echo('</pre>');
            break;
        }
    // if not logged in
    } else {
        require_once('landingPage.php');
    }
?>