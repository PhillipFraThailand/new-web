<?php
    // require_once('database-connection.php');
    require_once('../config/database-connection.php');
    require_once('../utility/sanitizer.php');

    // artists model
    class Artist extends DB {

        // get artists
        function getArtists() {
            $results = array();
            $limit = 25;

            // Pagination if cookie and check if 0 or negative.
            if (isset($_GET['page']) && ($_GET['page'] > 0)) {
                $page = (int)$_GET['page'];
                $offset = ($page * $limit -1);
            } else {
                $offset = 0;
            };

            // Query
            $query = <<<QUERY
                SELECT * FROM artist   
                LIMIT $limit OFFSET $offset;
            QUERY;

            // Run query and save result in $stmt
            $stmt = $this->pdo->query($query);

            // Add rows from statement to results
            while($row = $stmt->fetch()) {
                $results[] = $row; 
            }

            // Close connection
            $stmt = null;
            
            // return results 
            // return(json_encode($data));
            return($results);
        }

        // get by id
        function getArtistById($id) {
            $query = <<<QUERY
                SELECT * FROM artist   
                WHERE ArtistId = ?;
            QUERY;

            //prepare and execute
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);

            //returns false on failure
            $result = $stmt->fetch();
            
            if ($result) {
                return(json_encode($result));
            } else {
                return false;
            }

            $stmt = null;
        }

        // create
        function createArtist($name){
            $query = <<<QUERY
                INSERT INTO artist (Name)
                VALUES(?);
            QUERY;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$name]);

            if ($stmt) {
                return true;
            } else {
                return false;
            }
        }

        // update
        function updateArtist($name, $id) {
            $query = <<<QUERY
                UPDATE artist
                SET Name = ?
                WHERE ArtistId = ?;
            QUERY;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$name, $id]);

            // if trying to change to same variable it does not count as an affected row
            $affectedRows = $stmt->rowCount();

            if ($affectedRows === 0) {
                return false;
            } else {
                return true;
            }

            $stmt = null;
        }

        // delete
        function deleteArtist($id) {
            $query =<<<QUERY
                DELETE FROM artist
                WHERE ArtistId = ?
            QUERY;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);

            $affectedRows = $stmt->rowCount();

            if($affectedRows == 0) {
                return false;
            } else {
                return true;
            }
        }
    }
?>