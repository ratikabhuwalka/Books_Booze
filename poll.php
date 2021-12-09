<?php
include('config.php');
if(isset($_POST['submit']))
{

        function selectAllItemsRand(){
            $contents = Query("SELECT * FROM pollitems ORDER BY RAND()");
            return $contents;
        }

        function selectAllItemsByVote(){
            $contents = Query("SELECT * FROM pollitems ORDER BY `votes` DESC");
            return $contents;
        }

        function selectVoteFrom($name){
            $contents = Query("SELECT * FROM pollitems WHERE `name`='".$name."'");
            foreach($contents as $content){
                return $content['votes'];
            }
        }

        function addVoteTo($name){
            Query("UPDATE `pollitems` SET `votes`='".(selectVoteFrom($name)+1)."' WHERE `name`='".$name."'");
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
    <div class="wrapper poll">
        <h1>Vote for your favorite punk rock band</h1>
        <div class="pollitems">
            <?php
                $pollitems = selectAllItemsRand();
                $i = 0;
                foreach($pollitems as $pollitem){
            ?>
            <input type="radio" class="pollInput" name="pollInput" value="<?=$pollitem['name'];?>" id="poll<?=$i;?>">
            <label for="poll<?=$i;?>" class="pollLabel">
                <img src="images/<?=$pollitem['image'];?>" alt="<?=$pollitem['name'];?>">
                <h2><?=$pollitem['name'];?></h2>
            </label>
            <?php
                    $i++;
                }
            ?>
        </div>
        <a href="#" class="submitPoll">Vote</a>
    </div>
</body>
</html>