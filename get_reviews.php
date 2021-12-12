<?php 
        
        include('config.php');

        $averageRating = "SELECT a.productId as productId, b.name as productName, b.img as productLink, ROUND(AVG(a.rating), 1) AS averageRating, COUNT(a.rating) as numOfRatings 
        FROM review as a INNER JOIN Products as b WHERE a.productId = b.id GROUP BY a.productId ORDER BY averageRating DESC LIMIT 5";
        $query = $dbh -> prepare($averageRating);
        $query->execute();
        $result=$query->fetchAll(PDO::FETCH_OBJ);
        
       
        // $highest_review = "SELECT a.productId as productId, b.name as productName, b.img as productLink, GROUP_CONCAT(a.rating SEPARATOR ', ') 
        // AS ratings, GROUP_CONCAT(a.review SEPARATOR '|') AS reviews, COUNT(a.review) as numOfReviews 
        // FROM review as a INNER JOIN Products as b WHERE a.productId = b.id GROUP BY a.productId ORDER BY COUNT(a.review) DESC LIMIT 5";
        // $query = $dbh -> prepare($highest_review);
        // $query->execute();
        // $highestReviewResult=$query->fetchAll(PDO::FETCH_OBJ);
        // $reviews=array();

        $reviews=array();

        foreach($result as $row){
            $review=array(
                "productId" => $row->productId,
                "productName" => $row->productName,
                "productLink" => $row->productLink,
                "averageRating" => $row->averageRating,
                "numOfRatings" => $row->numOfRatings,
            );

            array_push($reviews, $review);
        }
        echo json_encode($reviews);
        // set response code - 200 OK
        // $secondChancesProductsResponse = json_encode($reviews);
        // $allProducts = array();

        // $arr= json_decode($secondChancesProductsResponse);

        // foreach ($arr as $scprod) {
        //   array_push($allProducts, $scprod);
        // }
  
        // echo $allProducts[0]->productId;

        http_response_code(200);

        
        // echo json_encode($highestReviewResult);
        // // show products data in json format
        // echo json_encode($reviews["data"]);
        //         if($query->rowCount() > 0)
        //         {
        //             $review = json_encode($highestReviewResult);
        //             echo $review;
        //         }

        
    ?>