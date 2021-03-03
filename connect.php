<?php

    /**
     * Pas de base de données, le client cherchant quelque chose de simple :)
     */
     
    $email = "eschor30@gmail.com";
    $pass = "1996";
 

    if( isset($_POST['email']) && isset($_POST['pass']) ){
 
        $submitted_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $submitted_password = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);

        if($submitted_email == $email && $submitted_password == $pass){
            session_start();
            $_SESSION['email'] = $email;
            echo "Success";    
        }
        else if ($submitted_email != $email){
            echo "Invalid email";
        }
        else if ($submitted_password != $pass){
            echo "Invalid password";
        }
        else{
            echo "Connection error";
        }
    }
?>