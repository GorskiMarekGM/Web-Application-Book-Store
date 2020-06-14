<?php
session_start();
include_once("connect.php");

$insert = "UPDATE users
SET user_level = '".$_POST["number"]."'
WHERE id = '".$_POST["id"]."'";

$query = mysqli_query($conn, $insert) or die($insert);
header("Location: adminpanel.php");

?>