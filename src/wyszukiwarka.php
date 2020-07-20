<?php
//Czy jesteś zalogowany?
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}
//koniec czy jesteś zalogowany

require_once"connect.php";
$idteams = $_SESSION['idteams'];

if(isset($_POST['name'])) {
$name = $_POST['name'];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT *
FROM players
inner join teams ON players.idteams = teams.idteams
 where playername like '%$name%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: ".$row["idplayers"]. " Name: " . $row["playername"]. " - Pozycja: " . $row["pozycja"]. " - Skill: " . $row["skill"]." -  Klub: " . $row["teamname"].  "<br>";
        }  echo " <a href='wyszukiwarka.php'>Powrót!</a> <br>";
} else {
    echo "0 results";
}

$result->free_result();
$sql->free_result();
$conn->close();
}


// Wszyscy grający w jednej drużynie
if(isset($_POST['team'])) {
$team = $_POST['team'];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql2 = "SELECT *
FROM players
inner join teams ON players.idteams = teams.idteams
 where teamname like '%$team%'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "Name: " . $row["playername"]. " - Pozycja: " . $row["pozycja"]. " - Skill: " . $row["skill"]." -  Klub: " . $row["teamname"].  "<br>";
        }  echo " <a href='wyszukiwarka.php'>Powrót!</a> <br>";
} else {
    echo "0 results";
}
$result2->free_result();
$sql2->free_result();
$conn->close();

}


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>

<body>


   <form action="wyszukiwarka.php" method="post">
     <input type="text" name="name"> Nazwa Piłkarza
     <input type="submit" name="wyszukaj" value="wyszukaj"> <br>

   </form>
   Wyszukaj wszystkich piłkarzy z drużyny
    <form action="wyszukiwarka.php" method="post">
     <input type="text" name="team"> Nazwa Drużyny
     <input type="submit" name="wyszukajdruzyne" value="wyszukaj">

   

    <a href="transfery.php">Powrót!</a> <br>



  <body>
    </html>
