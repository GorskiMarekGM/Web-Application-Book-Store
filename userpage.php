<?php

#connect to our database from file connect.php
include('connect.php');
#start session
session_start();

#if user is not loged go to index.php, and log in
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
		<script type="text/javascript" src="javascript.js"></script>
		<link rel="stylesheet" href="styles/stylemenu.css">
		
		<title>Home</title>
		</head>
<body>
	<div class="navbar">
		<a href="#" class="logo"><?php echo $_SESSION['user'] ?></a>
		<ul class="nav">
		<!-- check if currently logged user is an admin -->
		<?php
			$sql = "SELECT user_level FROM users where id = '".$_SESSION['id']."'";

			// $conn is in connect.php file
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				// output data of each row
				while($row = $result->fetch_assoc()) {
					if($row["user_level"]==1)
					{
						//If user is an admin display admin page
						?><li><a href="adminpanel.php">Admin</a></li><?php
					}
				}
			}
		?>
			<li><a href="#home">Home</a></li>
			<li><a href="#books">Books</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#cart">Cart</a></li>
			<li><a href="#logout">Logout</a></li>
		</ul>
	</div>
<div class="banner-area" id="home">
	<div class="home-area" id="home">
			<Div class ="container-area">
				<p>
					<?php
						#Create Home page with books

						$sql = "SELECT id, image FROM books";

						// $conn is in connect.php file
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							echo "<table id='t02'> <tr>";
							
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo 
									"<td><a href='book.php?id=".$row["id"].
									"'><img src='books/".$row["image"].
									"' height='300px' width='200px'></a></td>";
							}
							echo "</tr></table>";
						} else {
							echo "0 results";
						}
					?>
				</p>
			</Div>
		</div>
	</div>
        
        <div class="books-area" id="books">
                <div class="text-part">
                    <h1>Our Books</h1>
                    <p>
						<?php
							#Display all books from store

							$books_table = "SELECT id, title, author, price, image, available FROM books";
							
							// $conn is in connect.php file
							$result = $conn->query($books_table);

							if ($result->num_rows > 0) {
								echo "<table id='t01'>
								<tr>
									<th>Image</th>
									<th>Title</th>
									<th>Author</th>
									<th>Price</th>
									<th>Available</th>
									<th>Add to Cart</th>
								</tr>";
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr>
												<td>
													<a href='book.php?id=".$row["id"]."'><img src='books/".$row["image"]."' height='75' width='50'></a>".
												"</td> ".
												"<td>".$row["title"]."</td> ".
												"<td>".$row["author"]."</td> ".
												"<td>".$row["price"]."</td> ".
												"<td>".$row["available"]."</td> ".
												
												"<td><input type='button' onClick='add_to_cart(".$row['id'].",".$row['available'].")' name='Add' value='Add'>
												
												</td>";
										echo "</tr>";
								}
								echo "</table>";
							} else {
								echo "0 results";
							}
						?>
					</p>
                </div>
		</div>
		<div class="about-area" id="about">
                <div class="text-part">
                    <h1>About Us</h1>
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod maximus dui. Quisque vel lectus sit amet ante imperdiet pretium ut in magna.
						 Donec et nibh porta, lacinia metus at, lacinia purus. Sed nisl sapien, dictum sed fringilla ut, aliquam sit amet diam. Vestibulum eu elit sed orci
						  gravida feugiat in sed odio. Donec ligula ligula, malesuada id metus ut, scelerisque faucibus erat. Vestibulum interdum iaculis metus condimentum
						   hendrerit. In non lectus ac urna accumsan tincidunt ac vel velit. Duis ut semper velit. Maecenas in est dapibus,
						 mollis mi id, venenatis nunc. Nam non nulla a mauris lobortis pharetra. Aliquam posuere massa vel quam pharetra efficitur.
						</p>
                </div>
        </div>
		<div class="cart-area" id="cart">
                <div class="text-part">
                    <h1>Your Cart</h1>
					<p>
						<?php

							#Display your cart, content of cart depend on each user

							$cart = "SELECT cart.id as cart, users.id, books.id, image, author, title, price
							FROM books
							INNER JOIN cart
							ON books.id = cart.book_id
							INNER JOIN users
							ON cart.user_id = users.id
							where users.id = '".$_SESSION['id']."'";
							
							// $conn is in connect.php file
							$result = $conn->query($cart);

							if ($result->num_rows > 0) {
								echo "<table id='t01'>
								<tr>
									<th>Image</th>
									<th>Title</th>
									<th>Author</th>
									<th>Price</th>
									<th>Delete</th>
								</tr>";
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr>
												<td>
													<a href='book.php?id=".$row["id"]."'><img src='books/".$row["image"]."' height='75' width='50'></a>".
												"</td> ".
												"<td>".$row["title"]."</td> ".
												"<td>".$row["author"]."</td> ".
												"<td>".$row["price"]."</td> ".
												"<td><input type='button' onClick='deleteme(".$row["cart"].")' name='Remove' value='Remove'>
												</td>";

									
								}
								echo "</table>";
							} else {
								echo "Your cart is empty";
							}
						?>
					</p>
			   </div>
        </div>
        <div class="logout-area" id="logout">
                <div class="text-part">
                    <h1>Logout!</h1>
                    <p>
						<?php
						echo "<p> Hello  ".$_SESSION['user'].'! [<a href="logout.php" style="color:white;">Log Out</a>]</p>';
						echo "<p><b>E-mail</b>:  ".$_SESSION['email'];
						?>
					</p>
                </div>
        </div>
<?php $conn->close();?>
</body>
</html>