<html>
<body>
<section class="main-section alabaster" id="tops">
	<div class="container fullsize">
<?php
//curl_setopt($curl_handle, CURLOPT_URL, "http://info.ratikabhuwalka.me/Books_Booze/get_user.php");
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_HEADER, 0);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
$contents = curl_exec($curl_handle);
curl_setopt($curl_handle, CURLOPT_URL, "http://www.mylampstack.com/users.php");
$contents = $contents.",".curl_exec($curl_handle);


#echo "<br/>";
curl_close($curl_handle);

foreach (explode(",",$contents) as $content) {
    echo $content."<br/>";
}

?>
        
    </div>
</section>
</body>
</html>