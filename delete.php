<?php
session_start();
include("connect.php");

$select = "SELECT id FROM `cart` limit 1";
$select = "DELETE from cart where id = '".$_GET['del_id']."'";

$query = mysqli_query($conn, $select) or die($select);
header("Location: userpage.php#cart");

?>