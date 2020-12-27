<?php
    require_once('../config/database-connection.php');
    require_once('../utility/sanitizer.php');

    header("Access-Control-Allow-Origin: *");
    class User extends DB {
        public int $userId;
        public string $email;
        public string $firstName;
        public string $lastName;
        public string $address;

        function findUser($email) {
            // Query
            $query = <<<SQL
                SELECT *
                FROM customer where Email = ?;
            SQL;

            // Prepare the statement
            $stmt = $this->pdo->prepare($query);

            // execute the query which returns true on success and false on failure
            if ($stmt->execute([$email])) {
                
                // If no result return false
                if($stmt->rowCount() === 0) {
                    return false;
                } else {
                    $row = $stmt->fetch();
                    return $row;
                }
            // if the query to db was a failure
            } else {
                return false;
            }
        }

        // create a customer in db
        function create($firstName, $lastName, $password, $company, $address, 
                            $city, $state, $country, $postalCode, $phone, $fax, $email) {
            // check if user already exists
            $query = <<<SQL
                SELECT COUNT(*) AS total FROM customer WHERE email = ?;
            SQL;

            //  prepare the statement
            $stmt = $this->pdo->prepare($query);
            
            //if the query to db was a success check the result
            if ( $stmt->execute([$email]) ) {

                // if the email exist we fail
                if($stmt->fetch()['total'] > 0) {
                    return false;

                // if the email does not exist continue
                } else {

                    // hash the password
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    // create the query
                    $query = <<<SQL
                        INSERT INTO customer (FirstName, LastName, Password, Company, Address, City, 
                                State, Country, PostalCode, Phone, Fax, Email) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);
                        SQL;
                        
                    // Prepare the statement
                    $stmt = $this->pdo->prepare($query);
                }
            }

            // If the execution is a success
            if($stmt->execute([$firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email])) {
                $this->disconnect();
                return true;
                
            // error in query execution
            } else {
                return false;
            }
        }

        // Updates a user
        function updateUser($firstName, $lastName, $oldPassword, $newPassword, $company, $address, 
                            $city, $state, $country, $postalCode, $phone, $fax, $oldEmail, $newEmail) {
            // Update query
            $updateQuery = <<<SQL
                UPDATE customer 
                SET FirstName = ?, LastName = ?, Password = ?, Company = ?, Address = ?, City = ?, State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?, Email = ?
                WHERE Email = ?;
            SQL;
            
            // Get user query
            $getUserQuery = <<<SQL
                SELECT CustomerId, Password FROM customer WHERE Email = ?;
            SQL;

            // check if the user is trying to update the email
            if ($oldEmail != $newEmail) {
                // prepare, execute and continue if query succeeds
                $stmt = $this->pdo->prepare($getUserQuery);
                if ( $stmt->execute([$oldEmail]) ) {

                    // extract result and verify password
                    $row = $stmt->fetch();
                    $validPassword = password_verify($oldPassword, $row['Password']);

                    // if password is valid check if there is no user with the new mail already
                    if ($validPassword) {
                        $query = <<<SQL
                            SELECT COUNT(*) AS total FROM customer WHERE email = ?;
                        SQL;

                        //  prepare and execute the query. If its a success check count
                        $stmt = $this->pdo->prepare($query);
                        if( $stmt->execute([$newEmail]) ) {
                            // if email exists return false
                            if ($stmt->rowCount() > 0) {
                                return false;    
                            // if email is not taken update the row
                            } else {                                
                                //  prepare and execute the query. If its a success check count
                                $stmt = $this->pdo->prepare($updateQuery);
                                if ($stmt->execute([$firstName, $lastName, $newPassword, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $newEmail, $oldEmail])) {
                                    $this->disconnect();
                                    return true;

                                // if error in query execution
                                } else {
                                    $this->disconnect();
                                    return false;
                                }
                            }   
                        }
                    } else {
                        //error validating password for user
                        echo('error validating password for user');
                    }
                } else {
                    // error checking user
                    echo('error checking user');
                }
            } elseif ($oldEmail = $newEmail) {
                // add user without checking email

            }
        }

        // validate login credentials
        function createSession($email, $password) {
            // query gets the user with the email
            $query = <<<SQL
                SELECT CustomerId, FirstName, LastName, Password 
                FROM customer WHERE Email = ?;
            SQL;
            
            // Create prepared statement
            $stmt = $this->pdo->prepare($query);
    
            //if the query was a success
            if ( $stmt->execute([$email]) ) {
                // check if the result was empty, if then stop
                if($stmt->rowCount() === 0) {
                    $this->disconnect();
                    return false;
                    
                // if result was not empty try to validate and create the session
                } else {
                    // get result & validate password
                    $row = $stmt->fetch();
                    $login = password_verify($password, $row['Password']);

                    // if valid password set session
                    if ($login) {
                        $_SESSION['userId'] = sanitizeDB_output($row['CustomerId']);
                        $_SESSION['firstName'] = sanitizeDB_output($row['FirstName']);
                        $_SESSION['lastName'] = sanitizeDB_output($row['LastName']);
                        $_SESSION['email'] = $email;

                        if($password == 'admin') {
                            $_SESSION['admin'] = 'YES';
                        } else {
                            $_SESSION['admin'] = 'NO';
                        }
                        return true;
                    } else {
                        return false;
                    }
                }    
            }                
        }
    }
?>