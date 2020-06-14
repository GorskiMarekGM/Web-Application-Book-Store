<?php

session_start();
//sprawdza czy uzytkownik przesyla login i haslo
if((!isset($_POST['login'])) || (!isset($_POST['pass'])))
{
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

#polaczenie(obiekt) -> connect_errno(wlasciwosc obiektu)

if($connection->connect_errno!=0)
{
	echo "Error: ".$connection->connect_errno;
}
else
{					
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	
	//zabezpieczanie MySql injaction
	//htmlentities zamienia wszystkie znaki na encje np > to &gt
	//ent_quotes zamienia nawiasy i cudzyslowie
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
	
	//$sql = "SELECT * FROM uzytkownicy WHERE user = '$login' AND pass='$pass'";
	//if - gdy w zapytaniu wystapi blad
	// %s =wstawiamy lancuch, argumenty podane po przecinku, tak jak w c#{0}, {1}
	echo "3";
	if($result =@$connection ->query(
	sprintf("SELECT * FROM users WHERE name = '%s' AND pass='%s'",
	//funkcja skonstruowana do chronienia przed wstrzykiwaniem MySql
	//mysqli_real_escape_string(identyfikator polaczenia(obiek mysqli),ciag znakow ktory chcemy poddac sanityzacji)
	mysqli_real_escape_string($connection, $login),
	mysqli_real_escape_string($connection, $pass)
		)))
	{
		//zwraca ile wierszow wystapilo
		$HowManyUsers=$result->num_rows;
		echo "1";
		if($HowManyUsers>0)
		{
			$_SESSION['loged']= true;
			echo "2";
			//tworzenie tablicy z danymi uzytkownika
			//associacja zwraca wynik z komorki, zamiast numeru id w tablicy
			$row = $result ->fetch_assoc();
			$_SESSION['id'] = $row['id'];
			$_SESSION['user'] = $row['name'];
			$_SESSION['email'] = $row['email'];
			
			//usuwa zmienna blad
			unset($_SESSION['error']);
			$result->close();
			
			//przekierowanie do userpage.php
			header('Location: userpage.php');

		}else{
			$_SESSION['error']= '<span style="color:red">Wrong login or password!</span>';
			header('Location: index.php');				}
	}
	
	$connection->close();
}

?>