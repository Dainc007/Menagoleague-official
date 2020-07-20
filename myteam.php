<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  header('Content-Type: text/html; charset=UTF-8');
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}
$date = date("y-m-d ");
$idteams = $_SESSION['idteams'];
$money = $_SESSION['money'];


if ($idteams ==0)
{
  echo "Nie masz klubu<br>";
  echo '<a href="kontogracza.php">Powrót!</a>';

  exit();
}
else
{

require_once"connect.php";

echo '<a href="myPlayersStats.php">Statystyki Piłkarzy</a> <br>';

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$idteams = $_SESSION['idteams'];
$sql = "SELECT * FROM players WHERE idteams=$idteams";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

        echo  " - ID: " . $row["idplayers"].
        " - Name: " . $row["playername"].
        " - Pozycja: " . $row["pozycja"].
        " - Skill: " . $row["skill"].
         " - Pensja: " . $row["pensja"].


        "<br>";
    }
} else {
    echo "W Twojej drużynie nie ma jeszcze piłkarzy";
}

$conn->close();

}
//gdy wciśniemy zapłać
  if(isset($_POST['pensja'])) {
      //Czy stać nas na to?
      if($money>$pensjazespolu) {
      // Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql3 = "UPDATE teams SET money=money-$pensjazespolu where idteams=$idteams";
$result3 = $conn->query($sql3);


  } else
    {
      echo "<br><b>Nie stać Cię na pensję dla swoich piłkarzy!<b>";
      echo '<a href="myteam.php">Powrót!</a>';
      exit();
    }
  }

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8"/>
  <title>Moja Drużyna</title>
</head>

<body>
<p>Klub wypłaca pensję zawodnikom automatycznie w każdą niedzielę o północy.<br></p>
  <a href="kontogracza.php">Powrót!</a>

  <form>
      <input type="number" name="id"> ID zawodnika <br>
      <input type="number"> Wysokość tygodniówki <br>
      <input type="submit" name="raise" value="Zaproponuj Podwyżkę" onclick="return confirm('Czy na pewno?');">
  </form>
  <p> Zastanów się, zanim zwolnisz zawodnika - operacji nie można cofnąć. Twój piłkarz stanie się wolnym zawodnikiem</p>
  <p style="color:red"> <i>Twój zespół powinien składać się z co najmniej <b> 20</b> piłkarzy. Mniejsza liczba zawodników naraża Cię na <b>WALKOWER</b> w przypadku kontuzji lub zawieszenia.<i></p>
  <form action="fire.php" method="POST">
      <input type="number" name="idfire"> ID zawodnika, który zostanie zwolniony<br>
      <input type="submit" name="release" value="Zwolnij zawodnika">
  </form>

  <div class="wystaw">
            <h4> Wystaw piłkarza na listę transferową </h4>
            <form action="transferlist.php" method="post">
                Nazwa: <input type="text" name="name" value=""required>
                <label>ID:<input type="number" name="idplayers" value="" required></label><br>
                <label>Pozycja:<input type="text" name="position" value="" required> </label><br>
                <label>Skill:<input type="number" name="skill" value="" required> </label><br>
                <label>Cena:<input type="number" name="cena" value="" required></label><br>
                
                <label>Podaj dane do kontaktu - FB/GamerTag bądź
                    jakikolwiek inny preferowany przez Ciebie sposób kontaktu:<input type="text" name="kontakt" value="" required> </label> <br>
                <input type="submit" name="submit" value="Dodaj">
        </div>
  <body>
    </html>
