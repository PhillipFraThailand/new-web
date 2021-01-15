<?php
    session_start();
    
    // set headers (might not be needed but i got some weird errors at some point with insomnia(postman))
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require_once('user.php');
    require_once('../utility/sanitizer.php');
    

        $data = json_decode(file_get_contents("php://input"));
        
        if ( isset($data->email) ) {
            $user = new User();
            $email = $data->email;
            $password = $data->password;
    
            $result = $user->createSession($email, $password);
    
            if ($result) {
                if ($_SESSION['admin'] == 'YES') {
                    http_response_code(200);
                    // echo(json_encode($_SESSION['admin']));
                    echo(json_encode($_SESSION));
                } else {
                    http_response_code(200);
                    echo(json_encode($_SESSION));
                }
            } else {
                http_response_code(200);
                echo(json_encode('Could not log in'));
            }
        } else { 
            http_response_code(400);
            echo(json_encode('Email is not set'));
        }
?>

<?php       
// Unused code
        // // POST: contentType:"application/x-www-form-urlencoded; charset=UTF-8"
        // if ( isset($_POST['email']) && isset($_POST['password']) ) {
            
            //     $email = $_POST['email'];
            //     $password = $_POST['password'];
            
        //     $user = new User();
        //     $result = $user->createSession($email, $password);
    
        //     if($result) {
        //         http_response_code(200);
        //         print_r(json_encode($_SESSION));
        //     } else {
        //         http_response_code(400);
        //         echo $result;
        //     }
        // } else {
        //     http_response_code(400);
        //     echo('Please provide a email and a password');
        // }
?>