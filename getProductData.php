<?php
            include('config.php');
            $sql = "SELECT * from  Products";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $json = json_encode($results);

            echo $json
?>	
          