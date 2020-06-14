<?php
include('connect.php');
session_start();

if(!isset($_SESSION['loged']))
{
	header('Location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1"/>
		
		<link rel="stylesheet" href="styles/stylemenu.css">
		<title>Books</title>
		</head>
<body>
	<div class="navbar">
		<a href="#" class="logo"><?php echo $_SESSION['user'] ?></a>
		<ul class="nav">
			<li><a href="adminpanel.php">Admin</a></li>
			<li><a href="userpage.php#home">Home</a></li>
			<li><a href="userpage.php#books">Books</a></li>
			<li><a href="userpage.php#about">About</a></li>
			<li><a href="userpage.php#cart">Cart</a></li>
			<li><a href="userpage.php#logout">Logout</a></li>
		</ul>
	</div>
    <div class="book-bg">
        <div class="books-area" id="books">
            <div class="text-part" ">
                <h1>Admin Panel</h1>
                <p>
                 <?php

                    #Display content of admin page

                    $cart = "SELECT * FROM `users`";

                    // $conn is in connect.php file
                    $result = $conn->query($cart);

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
                    ?>
                </p>
                <a href="index.php"><div class="back"> Return </div></a>
            </div>
        </div>
   </div>
</body>
</html>