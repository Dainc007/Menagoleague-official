<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
  header('Location: index.php');
  exit();
}

require_once"connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
  echo "Error:".$polaczenie->connect_errno . "Opis:".$polaczenie->connect_error;
}
else
{

  $login = $_POST['login'];
  $haslo = $_POST['haslo'];

  $login = htmlentities($login, ENT_QUOTES, "UTF-8");
  

if($rezultat = @$polaczenie->query(
  sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
  mysqli_real_escape_string($polaczenie,$login))))
{
$ilu_userow = $rezultat->num_rows;
if($ilu_userow>0)
{
  $wiersz = $rezultat->fetch_assoc();

	if (password_verify($haslo, $wiersz['haslo']))
				{

  $_SESSION['zalogowany'] = true;
  $_SESSION['iduzytkownicy'] = $wiersz['iduzytkownicy'];
  $_SESSION['login'] = $wiersz['login'];
  $_SESSION['gamertag'] = $wiersz['gamertag'];
  $_SESSION['email'] = $wiersz['email'];
  $_SESSION['idteams'] = $wiersz['idteams'];

  unset($_SESSION['blad']);
  $rezultat->free_result();
  header('Location: kontogracza.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}

} else {
  $_SESSION['blad'] = '<span style="color:red">NIEPRAWIDLOWY LOGIN LUB HASLO</span>';
  header('Location: index.php');

}

}
  $polaczenie->close();
}


?>
