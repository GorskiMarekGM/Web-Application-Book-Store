<?php

session_start();
include_once("connect.php");

function AdminPage(){
    #Display content of admin page

    $admin = "SELECT * FROM `users`";

    // $conn is in connect.php file
    $result = $conn->query($admin);

    if ($result->num_rows > 0) {
        echo "<table id='t01'>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Set user level Admin=1, User=0</th>
        </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr style='color:black;'>"."<form action='changeuser.php' method='post'>".
                        "<td>".$row["id"]."</td> ".
                        "<input type='hidden' name='id' value='".$row["id"]."'/>".
                        "<td>".$row["name"]."</td> ".
                        "<td>".$row["email"]."</td> ".
                        "<td><input type='number' name='number' value='".$row["user_level"]."' min='0' max='1'>
                        <input type='submit' name='submit' value='Submit'>
                        </td>".
                        "</form>".
                "</tr>";
            
        }
        echo "</table>";
    } else {
        echo "Your cart is empty";
    }
}


?>