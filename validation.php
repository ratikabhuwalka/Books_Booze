<html>
  <head>  
    <?php
        // $user_pass = file('credentials.txt');
        // $credentials = explode(",",$user_pass[0]);
        $lines = file('contact.txt');

        foreach ($lines as $line_num => $line) {
            echo "<br />\n" . htmlspecialchars($line) . "<br /><br />\n";
        }


        if($_POST["Username"] == 'admin' && $_POST["Password"] == 'admin'){
            foreach ($lines as $line_num => $line) {
                echo "<br />\n" . htmlspecialchars($line) . "<br /><br />\n";
            }
        }

        else{
            echo "Incorrect Username/Password";
        }

        ?>
    </head>
</html>