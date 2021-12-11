<?php 
        
        include('config.php');

        $averageRating = "SELECT a.productId as productId, b.name as productName, b.img as productLink, ROUND(AVG(a.rating), 1) AS averageRating, COUNT(a.rating) as numOfRatings 
        FROM review as a INNER JOIN Products as b WHERE a.productId = b.id GROUP BY a.productId ORDER BY averageRating DESC LIMIT 5";
        $query = $dbh -> prepare($averageRating);
        $query->execute();
        $result=$query->fetchAll(PDO::FETCH_OBJ);
        
        echo json_encode($result);

        // $highest_review = "SELECT a.productId as productId, b.name as productName, b.img as productLink, GROUP_CONCAT(a.rating SEPARATOR ', ') 
        // AS ratings, GROUP_CONCAT(a.review SEPARATOR '|') AS reviews, COUNT(a.review) as numOfReviews 
        // FROM review as a INNER JOIN Products as b WHERE a.productId = b.id GROUP BY a.productId ORDER BY COUNT(a.review) DESC LIMIT 5";
        // $query = $dbh -> prepare($highest_review);
        // $query->execute();
        // $highestReviewResult=$query->fetchAll(PDO::FETCH_OBJ);
        // $reviews=array();
        // $reviews["data"]=array();

        // foreach($highestReviewResult as $row){
        //     $review=array(
        //         "productId" => $row->productId,
        //         "productName" => $row->productName,
        //         "productLink" => $row->productLink,
        //         "ratings" => $row->ratings,
        //         "reviews" => $row->reviews,
        //         "numOfReviews" => $row->numOfReviews,
        //     );


        //     array_push($reviews["data"], $review);
        // }

        // // set response code - 200 OK
        // http_response_code(200);

        
        // echo json_encode($highestReviewResult);
        // // show products data in json format
        // echo json_encode($reviews["data"]);
        //         if($query->rowCount() > 0)
        //         {
        //             $review = json_encode($highestReviewResult);
        //             echo $review;
        //         }

        
    ?>