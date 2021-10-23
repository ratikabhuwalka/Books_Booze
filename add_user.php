<?php
include('config.php');
if(isset($_POST['submit']))
{

// $file = $_FILES['image']['name'];
// $file_loc = $_FILES['image']['tmp_name'];
// $folder="images/"; 
// $new_file_name = strtolower($file);
// $final_file=str_replace(' ','-',$new_file_name);

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$address=$_POST['address'];
$homeno=$_POST['homeno'];
$mobileno=$_POST['mobileno'];

    
$sql ="INSERT INTO User(fname,lname, email, mobileno, address, homeno) VALUES(:fname,:lname, :email, :mobileno, :address, :homeno)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':fname', $fname, PDO::PARAM_STR);
$query-> bindParam(':lname', $lname, PDO::PARAM_STR);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':address', $address, PDO::PARAM_STR);
$query-> bindParam(':homeno', $homeno, PDO::PARAM_STR);
$query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('User Added Successfully!');</script>";
echo "<script type='text/javascript'> document.location = 'get_user.php'; </script>";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">

	
        
</script>


</head>


<body>
	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="text-center text-bold mt-2x">Add New User</h1>
                        <div class="hr-dashed"></div>
						<div class="well row pt-2x pb-3x bk-light text-center">
                         <form method="post" class="form-horizontal" enctype="multipart/form-data" name="regform" onSubmit="return validate();">
                            <div class="form-group">
                            <label class="col-sm-1 control-label">First Name<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="fname" class="form-control" required>
                            </div>
                            <label class="col-sm-1 control-label">Last Name<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="lname" class="form-control" required>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-1 control-label">Email<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="text" name="email" class="form-control" required>
                            </div>
                            <label class="col-sm-1 control-label">Mobile Phone<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="number" name="mobileno" class="form-control" required>
                            </div>

                            
                            </div>

                             <div class="form-group">
                            <label class="col-sm-1 control-label">Address<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="textarea" name="address" class="form-control" required>
                            </div>
                            <label class="col-sm-1 control-label">Home Phone<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                            <input type="number" name="homeno" class="form-control" required>
                            </div>

                            </div>


								<br>
                                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                </form>
                                <br>
                                <br>
								<p><a href="index.php" >Home</a></p>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>
</html>