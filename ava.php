<?php
        include_once("connect.php");


        //sprawdza czy uzytkownik przesyla login i haslo
        if((isset($_POST['login'])) || (isset($_POST['pass'])))
        {
            $insert = "UPDATE books SET available = available - 1 WHERE `id` = ".$_GET['id']."";
    
            $query = mysqli_query($conn, $insert) or die($insert);

            
        }
        #header('Location: index.php');
       
        exit();
?>