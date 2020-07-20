<?php

  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    require_once"connect.php";

session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}
//sprawdzamy, czy budżet klubu wyświetla się poprawnie. W przeciwnym razie zostaniesz przeniesiony
// Jest to zabezpieczenie przed wejściem do pliku oferty.php bez uprzedniego wejścia na forum.php

if (!isset($_SESSION['money']))
{
  header('Location: kontogracza.php');
  exit();
}

$frozen = $_SESSION['SUM(kwota)'];
$money = $_SESSION['money'];
$idteams = $_SESSION['idteams'];
$comment = "Wycofaliśmy oferty transferowe. Na konto ponownie wpłynęła kwota $frozen";

  //wycofujemy oferty
  if (isset($_POST['delete']))
  {

    $conn2 = new mysqli($host, $db_user, $db_password, $db_name);
    // Sprawdzamy połączenie
        if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
                                  }

    
    if($frozen !=0)
    {     $sql3 = "UPDATE oferty SET status=3 WHERE id_k=$idteams AND status !=1";
    $sql4 = "UPDATE teams SET money=money+$frozen WHERE idteams=$idteams";
    $sql5 = "INSERT INTO finances VALUES (null, $idteams, '$comment', $money, $frozen, $money+$cena, DEFAULT)";
    $result5 = $conn2->query($sql5);
    $result4 = $conn2->query($sql4);
    $result3 = $conn2->query($sql3);
    header('Location: ok.php');
    $result3->free_result();
    $result4->free_result();
    $conn2->close();
        
  
         } else
         {
             echo "<br><br><i>Brak ofert do wycofania</i>";
             echo "<br> <a href='kontogracza.php'>zamknij!</a>";
             exit();
           
         }
    
    } 
      
  

//załączamy plik który umożliwia połączenie z bazą


$idteams = $_SESSION['idteams'];
// Tworzymy polączenie
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Sprawdzamy połączenie
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                              }
//Wyświetlamy do powiadomień wszystkie rekordy z tabeli oferty, które otrzymaliśmy od innych użytkowników
$sql = "SELECT *
FROM players
inner join oferty ON players.idplayers = oferty.idplayers
inner join teams on players.idteams = teams.idteams
WHERE oferty.id_s=$idteams AND status =0";

//Wywołujemy pierwsze zapytanie i pokazujemy wyniki
$result = $conn->query($sql);
// to samo poniżej. Upewnij się do słuszności fetch..
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { 
        echo "  Klub: " . $row["team_k"]."(id:" . $row["id_k"].")"." jest zainteresowany kupnem naszego piłkarza. " . $row["playername"]. "
        Może do nich przejść za kwotę  " . $row["kwota"]."zł - Dodatkowy komentarz : " . $row["kom"].
        "<br>";
    }
} else {
    echo "<h4>Nie otrzymaliśmy żadnej oferty transferowej</h4>";
}

//Na koniec zwalniamy rezultat
$result->free_result();

//Sprawdzamy status wysłanych przez nas ofert
$sql2 = "SELECT *
FROM players
inner join oferty ON players.idplayers = oferty.idplayers
inner join teams on players.idteams = teams.idteams
WHERE oferty.id_k=$idteams
AND status!=3";

//Wywołujemy drugie zapytanie i pokazujemy wyniki
$result2 = $conn->query($sql2);
// to samo poniżej
if ($result2->num_rows > 0) {
    Echo "<br><h4>Wysłane oferty transferowe</h4>";
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo " Złożyliśmy ofertę kupna: " . $row["playername"].   "   W wysokości  " . $row["kwota"]. "
        Dodatkowy Komentarz " . $row["kom"]."  STATUS:" . $row["status"].
        "<br>";
    }
} else {
    echo "<p>Nie złożyliśmy żadnej oferty transferowej.";
    echo "<br> ";
}

//zamykamy połączenie
$conn->close();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title>panel</title>
</head>

<body>
<form method="post">
    <input type="submit" name="delete" value="Wycofaj Oferty" >
  </form>
  <br>Legenda <br>
 <i> 0 - Złożyłeś ofertę. Druga strona może ją w każdej chwili zaakceptować, badź odrzucić. <br>
  1 - Zaakceptowany - Zawodnik jest Twój. <br>
  2 - Odrzucony - Druga strona odrzuciła Twoją ofertę. <br>
  3 - Anulowany - Wycofałeś ofertę, bądź druga strona zaakceptowała inną ofertę za tego samego zawodnika.
  <br></i>

  

</body>
    </html>