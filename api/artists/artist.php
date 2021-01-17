<?php
    require_once('../config/database-connection.php');
    require_once('../utility/sanitizer.php');

    // artists model
    class Artist extends DB {

        // get artists
        function getArtists($offset, $limit) {
            $results = array();

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

            // close connection
            $stmt = null;
            // return results 
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
            $result = $stmt->execute([$name]);

            if ($result) {
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