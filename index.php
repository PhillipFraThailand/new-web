<?php
    session_start();
    // $_SESSION['userId'] = 'hans';
?>

<h1>index.php</h1>

<?php
    // if session is set show header and body
    if ( isset($_SESSION['userId']) ) {
    ?>
    <h1>logged in</h1>
    <?php
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
?>

<h1>landing page</h1>
<?php
    require_once('landingPage.php');
    print_r($_SESSION);
    echo('<pre>');
    print_r($GLOBALS);
    echo('</pre>');
}
?>

