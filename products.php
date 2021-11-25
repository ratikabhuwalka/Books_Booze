<section class="main-section paddind" id="products"><!--main-section-start-->
	<div class="container">
    	<h2>Products</h2>
      <div class="portfolioFilter">  
        <ul class="Portfolio-nav wow fadeIn delay-02s">
            <li><a href="#" data-filter="*" class="current" >All</a></li>
            <li><a href="most_visited.php" data-filter="*" class="current" >Most Visited</a></li>
            <li><a href="recently_visited.php" data-filter="*" class="current" >Recently Visited</a></li>
        </ul>  
    </div>
    <div class="portfolioContainer wow fadeInUp delay-04s">
            <table>
                <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Category</th>
                        </tr>
                </thead>	
			<tbody>

            <?php
            include('config.php');
            $sql = "SELECT * from  Products";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            $json = json_encode($results);
            foreach($results as $result)
            {				?>	
                                                    <tr>
                                                        <td><?php echo htmlentities($result->id);?></td>
                                                        <td><?php echo htmlentities($result->name);?></td>
                                                        <td><?php echo htmlentities($result->price);?></td>
                                                        <td><?php echo htmlentities($result->img);?></td>
                                                        <td><?php echo htmlentities($result->description);?></td>
                                                        <td><?php echo htmlentities($result->category);?></td>
                                                    </tr>
                                                    <!-- <?php $cnt=$cnt+1; }} ?> -->
                                                    
            </tbody>

            </table>
                <?php echo $json; ?>
            </div> 
        
        </div>
</section>