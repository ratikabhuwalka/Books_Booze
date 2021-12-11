<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/products.css">
        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class = "products">
            <div class = "container">
                <h1 class = "lg-title">Book Heaven</h1>
                <p class = "text-light">
                “There is more treasure in books than in all the pirates’ loot on Treasure Island and best of all, you can enjoy these riches every day of your life.” 
                ― Walt Disney


                </p>

                <div class = "product-items">


                <?php 
                
                include('config.php');

                $sql = "SELECT * from  Products";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0)
                {
                    foreach($results as $result)
                    {					
                        $pro_id = $result->id;
                        $pro_cat = $result->category;
                        $pro_description = $result->description;
                        $pro_title = $result->name;
                        $pro_price = $result->price;
                        $pro_image = $result->img;
                        $pro_genre = $result->genre;


                        $rating_stats = "SELECT ROUND(AVG(a.rating), 1) AS averageRating, COUNT(a.rating) as numOfRatings 
                        FROM review as a INNER JOIN Products as b WHERE a.productId = b.id and a.productId = $pro_id GROUP BY a.productId";
                        $query = $dbh -> prepare($rating_stats);
                        $query->execute();
                        $rating_obj=$query->fetch(PDO::FETCH_OBJ);
                        
                        $avgRating = (int)$rating_obj->averageRating;
                
                ?>

                    <!-- single product -->
                    <div class = "product">
                        <div class = "product-content">
                            <div class = "product-img">
                                <a href='product_info.php?id=<?php echo $pro_id?>'>
                                    <img src = <?php echo $pro_image?> alt = "product image" width="200" height="250"/>
                                </a>
                            </div>
                            <div class = "product-btns">
                                    <span><i class = "fas fa-plus"></i></span>
                                <button type = "button" class = "btn-buy"> Browse
                                    <span><i class = "fas fa-shopping-cart"></i></span>
                                </button>
                            </div>
                        </div>

                        <div class = "product-info">
                            <div class = "product-info-top">
                                <h2 class = "sm-title"><?php echo $pro_genre?></h2>
                                <div class = "rating">

                                <?php
                                    $stars = $avgRating;
                                    $count = 1;
                                    
                                    for($i = 1; $i <= 5; $i++){
                                        if($stars >= $count){
                                            $printstar =  "<span><i class = 'fas fa-star'></i></span>";
                                        } else {
                                            $printstar = "<span><i class = 'far fa-star'></i></span>";
                                        }
                                        $count++;

                                        echo $printstar;
                                    }
                                ?>
                                </div>
                            </div>
                            <a href = "#" class = "product-name"><?php echo $pro_title?></a>
                            <p class = "product-price">$ <?php echo $pro_price?></p>
                        </div>

                       
                    </div>
                    <!-- end of single product -->

                    <?php }} ?>
                    </div>
            </div>
        </div>

</body>
</html>
