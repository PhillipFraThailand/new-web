<?php
    require_once('../config/database-connection.php');
    require_once('../utility/sanitizer.php');
    
    class Track extends DB {

        //Get tracks
        function getTracks($offset, $limit) {
            $results = array();

            // Query
            $query = <<<QUERY
                SELECT SQL_CALC_FOUND_ROWS T.TrackId AS trackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                FROM track T
                INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                INNER JOIN genre G ON T.GenreId = G.GenreId
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

        //create track. nullables: albumId, bytes, composer, genreid
        function createTrack($name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice) {
            $query = <<<QUERY
                INSERT INTO track (Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);
            QUERY;

            try {
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute([$name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice]);

                if ($result) {
                    return true;
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
                return false;
            }
            
            $this->disconnect();
        }

        //delete track
        function deleteTrack($id){
            try {
                $query = <<<SQL
                    DELETE FROM track WHERE TrackId = ?;
                SQL;
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute([$id]);

                if($result){
                    return true;
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
                return false;
            }
        }

    }
?>