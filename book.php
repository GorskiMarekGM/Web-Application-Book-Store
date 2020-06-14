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
			<li><a href="userpage.php#home">Home</a></li>
			<li><a href="userpage.php#books">Books</a></li>
			<li><a href="userpage.php#about">About</a></li>
			<li><a href="userpage.php#cart">Cart</a></li>
			<li><a href="userpage.php#logout">Logout</a></li>
		</ul>
	</div>
    <div class="book-bg">
        <div class="books-area" id="books">
            <div class="text-part">
                <h1>Books Area</h1>
                <p>
                    <?php

                    if(isset($_GET['id'])){
                            $book_id = $_GET['id'];
                    }else{
                        echo 'There is no book id';
                    }
                    
                        $sql = "SELECT id, title, author, price, image, available FROM books WHERE id = $book_id";

                        // $conn is in connect.php file
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<div class='book-description'>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo 
                                "<div class='book-image'>
                                    <img src='books/".$row["image"]."' height='100%' width='100%'>
                                </div>
                                <div class='book-data'>
                                    <h2>Title:</h2>  <p>".$row["title"]."</p>
                                    <h2>Author:</h2> <p>".$row["author"]."</p>
                                    <h2>Price:</h2> <p>".$row["price"]." zł</p>
                                </div>
                                <div class='book-about'>
                                    <h2> About </h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sollicitudin risus risus, at dictum turpis malesuada id. Sed sit amet lacinia mauris. Vivamus rhoncus ex vel urna egestas, id semper diam porttitor. Donec nec ultricies arcu. Curabitur interdum, justo a lacinia vestibulum, nibh orci consequat urna, eget rhoncus leo felis sed quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum quis nisl sed sem ornare aliquet eget eu nulla. Cras sed risus ut est gravida lobortis porttitor in orci. </p>

                                </div>";
                                            
                            }
                            echo "</div>";
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                </p>
                <a href="index.php"><div class="back"> Return </div></a>
            </div>
        </div>
   </div>
</body>
</html>