<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

  //sprawdzamy, czy jesteś zalogowany
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}

//sprawdzamy czy kasa jest ustawiona
if (!isset($_SESSION['money']))
    {
      header('Location: kontogracza.php');
      exit();
    }

//załączamy plik który umożliwia połączenie z bazą
require_once"connect.php";

//Gdy wciśniemy guzik
if(isset($_POST['submit'])) {
  $liczba = rand(42,65);
  $idteams = $_SESSION['idteams'];
  $cena = 15000000;
  $money = $_SESSION['money'];
  $comment = "Kupno Paczki o numerze $liczba";
$date = date("y-m-d ");
  //Najpierw należy sprawdzić, czy stać nas na paczkę!
  if($money>$cena){
  

        // Tworzymy polączenie
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        // Sprawdzamy połączenie
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
            }
$sql3 = "SELECT * FROM players WHERE idplayers=$liczba AND skill between 83 and 87 AND idteams is null ";
$sql2 = "UPDATE teams SET money=money-$cena where idteams=$idteams";
$sql = "UPDATE players SET idteams=$idteams WHERE idplayers=$liczba AND idteams is null";
$sql8 = "INSERT INTO finances VALUES (null, $idteams, '$comment', $money, $cena, $money-$cena, DEFAULT)";

$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    //robimy wpis do finansów klubu:
    $result8 = $conn->query($sql8);
  //Zabieramy pieniądze
  $result2 = $conn->query($sql2);
  //jeśli jest taki piłkarz dodajemy go
$result = $conn->query($sql);

//operacja wykonana, teraz nalezy ja zapisac do pliku
$nazwa_pliku = "txt/paczka.txt";

if (is_writeable($nazwa_pliku))
  {
   if ($plik = fopen($nazwa_pliku, "a"))
     {
      if (fwrite($plik, "ID: $idteams kupił  Mega paczkę nr $liczba dnia $date w wysokości $cena Budżet przed: $money"."
"." ") !== FALSE);
        else echo "Zapis do pliku się nie powiódł...";

      fclose($plik);

     } else echo "Nie mogę nawiązać połączenia z plikiem...";

  } else echo "Do pliku nie można dopisać informacji lub on nie istnieje...";

$conn->close();
header('Location: ok.php');
exit();
} else {
  echo "Wystąpił błąd o numerze $liczba  Zgłoś się do administratora i przekaż mu numer błędu <br> Możliwe również, że system miał problem z dopasowaniem zawodnika z uwagi na niewielką liczbę paczek. <br> możesz się wylogować, zalogować ponownie i spróbować kupić paczkę jeszcze raz>";
  echo " <a href='paczka.php'>Powrót!</a> <br>";
  exit();
}

}

else {
  echo "Nie stać Cię na paczke";
  
  exit();
}

}

//druga paczka
if(isset($_POST['submit2'])) {
  $liczba = rand(161,205);
  $idteams = $_SESSION['idteams'];
  $cena2 = 5000000;
  $money = $_SESSION['money'];
  $comment2 = "Kupno Paczki o numerze $liczba";
$date = date("y-m-d ");
  //Najpierw należy sprawdzić, czy stać nas na paczkę!
  if($money>$cena2){
  

        // Tworzymy polączenie
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        // Sprawdzamy połączenie
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
            }
$sql4 = "SELECT * FROM players WHERE idplayers=$liczba AND skill between 80 and 82 AND idteams is null ";
$sql5 = "UPDATE teams SET money=money-$cena2 where idteams=$idteams";
$sql6 = "UPDATE players SET idteams=$idteams WHERE idplayers=$liczba AND idteams is null";
$sql9 = "INSERT INTO finances VALUES (null, $idteams, '$comment2', $money, $cena2, $money-$cena2, DEFAULT)";

$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
  //Zabieramy pieniądze
  $result9 = $conn->query($sql9);
  //dodajemy wpis do finansów klubu
  $result5 = $conn->query($sql5);
  //jeśli jest taki piłkarz dodajemy go
$result6 = $conn->query($sql6);

//operacja wykonana, teraz nalezy ja zapisac do pliku
$nazwa_pliku = "txt/paczka.txt";

if (is_writeable($nazwa_pliku))
  {
   if ($plik = fopen($nazwa_pliku, "a"))
     {
      if (fwrite($plik, "ID: $idteams kupił Standardową paczkę nr $liczba dnia $date w wysokości $cena2 Budżet przed: $money"."
"." ") !== FALSE);
        else echo "Zapis do pliku się nie powiódł...";

      fclose($plik);

     } else echo "Nie mogę nawiązać połączenia z plikiem...";

  } else echo "Do pliku nie można dopisać informacji lub on nie istnieje...";

$conn->close();
header('Location: ok.php');
exit();
} else {
  echo "Wystąpił błąd o numerze $liczba  Zgłoś się do administratora i przekaż mu numer błędu <br> Możliwe również, że system miał problem z dopasowaniem zawodnika z uwagi na niewielką liczbę paczek. <br> możesz się wylogować, zalogować ponownie i spróbować kupić paczkę jeszcze raz";
  echo " <a href='paczka.php'>Powrót!</a> <br>";
    exit();
}

}

else {
  echo "Nie stać Cię na paczke";
  
  exit();
}
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>

<body>
  <form method="POST">
  <input type="submit"  name="submit" value="Kup Mega Paczkę" onclick="return confirm('Czy na pewno?');" disabled> Chwilowo wyczerpano zapas zawodników
  </form> <br>
  <form method="POST">
  <input type="submit"  name="submit2" value="Kup Standardową Paczkę" disabled onclick="return confirm('Czy na pewno?');"> Wszystkie standardowe paczki zostały wykupione
  </form> <br>
  <p style="color:red"> UWAGA. W bazie zdarzają się błędne Ovr zawodników. Jeśli trafił Ci się piłkarz z za wysokim, bądź za niskim ovr względem paczki którą zakupiłeś poinformuj administratora </p>
  <br><br> <a href="transfery.php">Powrót</a>
</body>
    </html>