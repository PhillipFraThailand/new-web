<?php
    require_once('header.php');
    require_once('database-connection.php');

    //Service which handles retrieving data for artists
    class Artists extends DB{

        // Fetch artists
        function fetchArtists() {
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

            // Run the Query and save result in $stmt
            $stmt = $this->pdo->query($query);
            
            // Add the rows from statement to results
            while($row = $stmt->fetch()) {
                $results[] = [$row['Name']]; 
            }
            // Close connection
            $stmt = null;
            
            return(json_encode($results));
        }
    }
?>