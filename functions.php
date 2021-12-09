<?php

//connecte to mysql database ecommerce

function getProductall(){
    include('config.php');

    $sql = "SELECT * from  Products";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
    $json = json_encode($results);
    
    echo "
    <div class='container-fluid padding' data-aos='fade-up'
		data-aos-offset='200'
		data-aos-delay='50'
		data-aos-duration='1000'>
	<div class='row padding'>
    
    ";
    
    
    foreach($results as $result)
    {					
        $pro_id = $result->id;
        $pro_cat = $result->category;
        $pro_description = $result->description;
        $pro_title = $result->name;
        $pro_price = $result->price;
        $pro_image = $result->img;


      
        
        echo "

        <div class='col-md-4'>
        <a href ='product_detail.php?id=$pro_id'>
        <div class='card'>
            <img class='card-img-top' src=$pro_image>
            <div class='card-body'>
                <h4 class='card-title'>$pro_title</h4>
                <p class='card-text'> 
                Price: $ $pro_price
                </p>
                <a href='#' class='btn btn-outline-secondary'>Browse</a>
            </div>
        </div>
        </a>
        </div>
        

    ";
    }


    echo "</div>
    </div>
    ";
    }
}

?>