<?php
session_start();
include_once("connect.php");

$insert = "INSERT INTO cart(id, user_id, book_id, quantity)
VALUES ('',
".$_SESSION["id"].",
".$_GET["add"].",
1 )";

$query = mysqli_query($conn, $insert) or die($insert);
header("Location: userpage.php#cart");

?>