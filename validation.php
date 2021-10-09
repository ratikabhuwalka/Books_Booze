<?php
    $contacts = file('contact.txt');

    

    if($_POST["Username"] == 'admin' && $_POST["Password"] == 'admin'){
        foreach ($contacts as $line) {
            echo "<br />\n" . htmlspecialchars($line) . "<br /><br />\n";
        }
    }

    else{
        echo "Incorrect Username/Password";
    }

    ?>
