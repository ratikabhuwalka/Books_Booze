<!-- Classic tabs -->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Books & Booze</title>
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/rating.css" rel="stylesheet" />

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
</head>



<body>

<?php
include('config.php');

$id = $_GET['id'];
$sql = "SELECT * from  Products where id=$id";
$query = $dbh -> prepare($sql);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
  {
    $name = $result->name;
    $price = $result->price;
    $img = $result->img;
    $category = $result->category;
    $description = $result->description;
    $author = $result->author;
    $genre = $result->genre;
    $published = $result->published;

  }


    $rating_stats = "SELECT ROUND(AVG(a.rating), 1) AS averageRating, COUNT(a.rating) as numOfRatings 
        FROM review as a INNER JOIN Products as b WHERE a.productId = b.id and a.productId = $id GROUP BY a.productId";
        $query = $dbh -> prepare($rating_stats);
        $query->execute();
        $rating_obj=$query->fetch(PDO::FETCH_OBJ);
        
        $avgRating = (int)$rating_obj->averageRating;
        $numReviews = (int)$rating_obj->numOfRatings;

    if(isset($_POST['submit']))
    {
        echo "submitting..";

        // $file = $_FILES['image']['name'];
        // $file_loc = $_FILES['image']['tmp_name'];
        // $folder="images/"; 
        // $new_file_name = strtolower($file);
        // $final_file=str_replace(' ','-',$new_file_name);

        $userName=$_POST['name'];
        $review=$_POST['review'];
        $email=$_POST['email'];
        $rating = $_POST["rate"];;

        $sql ="INSERT INTO review(productId,username, emailId, rating, review) VALUES(:id,:userName, :email, :rating, :review)";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':id', $id, PDO::PARAM_STR);
        $query-> bindParam(':userName', $userName, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':rating', $rating, PDO::PARAM_STR);
        $query-> bindParam(':review', $review, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
        echo "<script type='text/javascript'>alert('Review Added Successfully!');</script>";
        echo "<meta http-equiv='refresh' content='0'>";
        // echo "<script type='text/javascript'> document.location = 'get_user.php'; </script>";
        }
        else 
        {
        $error="Something went wrong. Please try again";
        }

    }


?>
<!--Section: Block Content-->
<section class="mb-5">


  <div class="row padding">
  
  <div class="col-md-12 col-lg-6">
    <centre>
    <div class="row product-gallery mx-1">
    <div class="col-md-6">
          
              <img src=<?php echo $img; ?>
                width="500px"
                height = "500px"
              >
  
    </div>
    </div>
    </centre>
    </div>


		<div class="col-lg-6">

      <h5><?php echo $name; ?></h5>
        <ul class = "list-inline" white-space="nowrap" overflow="hidden">
        <?php
                    $stars = $avgRating;
                    $count = 1;
                    
                    for($i = 1; $i <= 5; $i++){
                        if($stars >= $count){
                            $printstar = 
                            "<li class='list-inline-item' display='inline'>
                            <i class='fas fa-star fa-sm text-primary'></i>
                            </li>";
                        } else {
                            $printstar =
                            "<li class='list-inline-item' display='inline'>
                            <i class='far fa-star fa-sm text-primary'></i>
                            </li>";
                        }
                        $count++;

                        echo $printstar;
                      }
          ?>
      </ul>
      <p><span class="mr-1"><strong>$<?php echo $price; ?></strong></span></p>
      <p class="pt-1"><?php echo $description; ?></p>
      <div class="table-responsive">
        <table class="table table-sm table-borderless mb-0">
          <tbody>
            <tr>
              <th class="pl-0 w-25" scope="row"><strong>Author</strong></th>
              <td><?php echo $author; ?></td>
            </tr>
            <tr>
              <th class="pl-0 w-25" scope="row"><strong>Genre</strong></th>
              <td><?php echo $genre; ?></td>
            </tr>
            <tr>
              <th class="pl-0 w-25" scope="row"><strong>Publish Date</strong></th>
              <td><?php echo $published; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="table-responsive mb-2">
        <table class="table table-sm table-borderless">
          <tbody>
            <tr>
              <td class="pl-0 pb-0 w-25">Quantity</td>
            </tr>
            <tr>
              <td class="pl-0">
                <div class="def-number-input number-input safari_only mb-0">
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                    class="minus">-</button>
                  <input class="quantity" min="0" name="quantity" value="1" type="number">
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                    class="plus">+</button>
                </div>
              </td>
             
            </tr>
          </tbody>
        </table>
      </div>
      <button type="button" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
      <button type="button" class="btn btn-light btn-md mr-1 mb-2"><i
          class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
    </div>
  </div>

</section>
<!--Section: Block Content-->
<div class="classic-tabs border rounded px-4 pt-1">

  <ul class="nav tabs-primary nav-justified" id="advancedTab" role="tablist">
  <li class="nav-item">
      <a class="nav-link active show" id="description-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="description" aria-selected="true">Reviews & Ratings(<?php echo $numReviews;?>)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#add-review" role="tab" aria-controls="reviews" aria-selected="false">Add Review</a>
    </li>
  </ul>
  <hr>
  <div class="tab-content" id="advancedTabContent">
    <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="description-tab">
        <h5>Reviews</h5>


        <?php 
        
        include('config.php');
        $sql = "SELECT * from  review where productId=$id";
        $query = $dbh -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
         foreach($results as $result)
         {
          ?>
             <h5 class="small text-muted text-uppercase mb-2"><?php echo htmlentities($result->userName);?></h5>
                <ul class = "list-inline" white-space="nowrap" overflow="hidden">

                  <?php
                    $stars = $result->rating;
                    $count = 1;
                    
                    for($i = 1; $i <= 5; $i++){
                        if($stars >= $count){
                            $printstar = 
                            "<li class='list-inline-item' display='inline'>
                            <i class='fas fa-star fa-sm text-primary'></i>
                            </li>";
                        } else {
                            $printstar =
                            "<li class='list-inline-item' display='inline'>
                            <i class='far fa-star fa-sm text-primary'></i>
                            </li>";
                        }
                        $count++;

                        echo $printstar;
                      }
                  ?>
                </ul>
                <p class="pt-1"> <?php echo htmlentities($result->review);?></p>
                <hr>
          <?php  }} ?>
            
    </div>
    
    
    <div class="tab-pane fade" id="add-review" role="tabpanel" aria-labelledby="reviews-tab">
      <h5 class="mt-4">Add a review</h5>

      <div>
        <!-- Your review -->
        <form method="post">

            <div class="rate">
              <input type="radio" id="star5" name="rate" value="5" />
              <label for="star5" title="text">5 stars</label>
              <input type="radio" id="star4" name="rate" value="4" />
              <label for="star4" title="text">4 stars</label>
              <input type="radio" id="star3" name="rate" value="3" />
              <label for="star3" title="text">3 stars</label>
              <input type="radio" id="star2" name="rate" value="2" />
              <label for="star2" title="text">2 stars</label>
              <input type="radio" id="star1" name="rate" value="1" />
              <label for="star1" title="text">1 star</label>
            </div>
            <br/> <br/>
            <div class="md-form md-outline">
            <label for="form76">Review</label>
            <textarea id="form76" name="review" class="md-textarea form-control pr-6" rows="4"></textarea>
            </div>
            <!-- Name -->
            <div class="md-form md-outline">
            <label for="form75">Name</label>
            <input type="text" name="name" id="form75" class="form-control pr-6">
            </div>
            <!-- Email -->
            <div class="md-form md-outline">
            <label for="form77">Email</label>
            <input type="email" name="email" id="form77" class="form-control pr-6">
            </div>
            <br/>
            <div class="text-right pb-2">
            <button type="submit" name="submit" class="btn btn-primary">Add a review</button>
            </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- Classic tabs -->
</body>
</html>