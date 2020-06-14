<?php
        include_once("connect.php");


        //sprawdza czy uzytkownik przesyla login i haslo
        if((isset($_POST['login'])) || (isset($_POST['pass'])))
        {
            $insert = "INSERT INTO `users` (`id`, `name`, `email`, `pass`) 
            VALUES (NULL, '".$_POST['login']."', '".$_POST['email']."', '".$_POST['pass']."')";
                              
            $query = mysqli_query($conn, $insert) or die($insert);

            
        }
        header('Location: index.php');
       
        exit();
?>