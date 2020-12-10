<?php

    class DB {
        protected $pdo;

        // public function connect() {
        public function __construct() {
            $server = 'localhost';
            $database = 'chinook_abridged';
            $user = 'root';
            $pwd = '';

            $DSN = 'mysql:host=' . $server . ';dbname=' . $database . ';charset=utf8'; // Options for PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,             // Throw PDO exeptions near the cause of the error
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,                   // Making PDO fetch associative arrays pr. default
                PDO::ATTR_EMULATE_PREPARES   => false,                              // Disables automatic formatting of returned data from database
            ];

            try {
                $this->pdo = @new PDO($DSN, $user, $pwd, $options); 
            } catch (\PDOException $exception) {
                echo 'Connection unsuccesful '. $exception . '<br>';
                die('Connection unsuccessful: ' . $exception->getMessage());
                exit();
            }
        }

        // Closes connection to DB
        public function disconnect() {
            $this->pdo = null;
        }
    }
?>