<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once"../connect.php";

session_start();
if ($_SESSION['idteams'] !=1)
{
  header('Location: index.php');
  echo "<strong>Nie masz uprawnień</strong>";
  exit();
}
$CG =3; //współczynnik rozgrywek LM
$LD =60; //liczba drużyn

//wciskamy "dodaj mecz"
if(isset($_POST['submit']))
{
  //Ustawiamy zmienne
$data = date(" Y-m-d ");
$idteam1 = $_POST['idteam1'];
$idteam2 = $_POST['idteam2'];
$g1 = $_POST['g1'];
$g2 = $_POST['g2'];
$liga = $_POST['liga'];
//Sprawdzamy poprawność danych
if($idteam1 != $idteam2)
  { 

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//sprawdzamy czy wynik jest już w bazie

$sql10 = "SELECT * FROM Terminarz WHERE idteam1=$idteam1 AND idteam2=$idteam2 AND g_1 is not null OR idteam1=$idteam2 AND idteam2=$idteam1 AND g_1 is not null";

$result10 = $conn->query($sql10);
if ($result10->num_rows > 0) {
    echo "Ten mecz istnieje już w bazie!";
     echo "<a href='wyniki.php'>POWRÓT</a>";
    exit();
} else {
    //pobieramy informację, które miejsce w rankingu zajmują zespoły
$CG =3; //współczynnik rozgrywek LM
$sql20 = "SELECT spot FROM ranking WHERE idteams=$idteam1";
$sql21 = "SELECT spot FROM ranking WHERE idteams=$idteam2";
$result20 = $conn->query($sql20);
if ($result20->num_rows > 0) {
    while($row = $result20->fetch_assoc()) {
      $spot1 = $row["spot"];
    }  
}
$result21 = $conn->query($sql21);
if ($result21->num_rows > 0) {
    while($row = $result21->fetch_assoc()) {
      $spot2 = $row["spot"];
    }  
}


$sql = "UPDATE Terminarz SET g_1=$g1, g_2=$g2 WHERE idteam1=$idteam1 AND idteam2=$idteam2";
$result = $conn->query($sql);
//zwiekszamy liczbę zdobytych goli, straconych goli, rozegranych meczów i aktualizujemy bilans
$sql8 = "UPDATE Tabela SET scored=scored+$g1, lost=lost+$g2, GP=GP+1, bilans=scored-lost WHERE idteams=$idteam1";
$sql9 = "UPDATE Tabela SET scored=scored+$g2, lost=lost+$g1, GP=GP+1, bilans=scored-lost WHERE idteams=$idteam2";
$result8 = $conn->query($sql8);
$result9 = $conn->query($sql9);

if($g1 > $g2) {
  //tutaj wpisujemy co się dzieje gdy g1>g2
    //zwiekszamy liczbę wygranych o 1
  $sql2 = "UPDATE Tabela SET W=W+1, pkt=pkt+3 WHERE idteams=$idteam1";
  $result2 = $conn->query($sql2);
  //liczymy i ustawiamy ranking drużyny wygranej
  $sql22 = "UPDATE ranking SET pkt=pkt + 3 * $CG * $LD-$spot2 WHERE idteams=$idteam1";
  $result22 = $conn->query($sql22);
  //zwiekszamy liczbę przegranych o 1
$sql3 = "UPDATE Tabela SET L=L+1 WHERE idteams=$idteam2";
$result3 = $conn->query($sql3);

  header('Location: ../ok2.php');
  } else
    {
      if($g2 > $g1)
      {
        //Tu wpisujemy co sie dzieje jeśli g1<g2
        $sql4 = "UPDATE Tabela SET W=W+1, pkt=pkt+3 WHERE idteams=$idteam2";
        $result4 = $conn->query($sql4);
        //zwiekszamy liczbę przegranych o 1
      $sql5 = "UPDATE Tabela SET L=L+1 WHERE idteams=$idteam1";
      $result5 = $conn->query($sql5);
      //dodajemy punkty do rankingu
      $sql25 = "UPDATE ranking SET pkt=pkt + 3 * $CG * $LD-$spot1 WHERE idteams=$idteam2";
      $result25 = $conn->query($sql25);
        header('Location: ../ok2.php');
        } else {
              if($g1 == $g2) {
                //Tu wpisujemy co się dzieje jeśli g1 i g2 są równe
                $sql6 = "UPDATE Tabela SET D=D+1, pkt=pkt+1 WHERE idteams=$idteam1";
                $result6 = $conn->query($sql6);
                $sql7 = "UPDATE Tabela SET D=D+1, pkt=pkt+1 WHERE idteams=$idteam2";
                $result7 = $conn->query($sql7);
                //wpisy do rankingu
                $sql23 = "UPDATE ranking SET pkt=pkt + 1 * $CG * $LD-$spot2 WHERE idteams=$idteam1";
                $sql24 = "UPDATE ranking SET pkt=pkt + 1 * $CG * $LD-$spot1 WHERE idteams=$idteam2";
                $result23 = $conn->query($sql23);
                $result24 = $conn->query($sql24);
                  header('Location: ../ok2.php');
                }
              }
  }
}


$conn->close();
  } else {
        echo "Drużyna1 i Drużyna2 nie mogą być takie same!";
        echo "<a href='wyniki.php'>POWRÓT</a>";
        exit();
      }
}




?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title>Tabela</title>
</head>

<body>
<a href="/admin/menu.php">Powrot</a><br>
Tutaj wpisujemy wyniki meczów ligowych
<form method="POST">
  <input type="number" required name="idteam1">Gospodarze  <br> <input type="number" required name="g1">Bramki(Gosp.)<br>
  <br><input type="number" required name="idteam2">Goście <br>
  
  <input type="number" required name="g2">Bramki(Goście)<br> <br>
 
  <input type="radio" name="liga" value="1">Anglia
    <input type="radio" name="liga" value="2">Hiszpania
    <input type="radio" name="liga" value="3">Włochy
    <input type="radio" name="liga" value="4">Ekstraklasa
    <input type="radio" name="liga" value="5">1 Liga

  <input type="submit"  name="submit" value="Dodaj mecz">
  
</form>

</body>
    </html>
<?php

  if(isset($_GET['idLeague']))
{ include_once"../fixturesController.php";
    $idLeague = $_GET['idLeague'];   
    
    
    $fixturesController = new FixturesController();
    $selectFixturesByLeague = $fixturesController->getLeagueFixtures($idLeague);
    
    if (empty($selectFixturesByLeague)) 
    {
    echo' Wystąpił problem podczas wyświetlania terminarza';
    } else
     {  
        $selectTeamNames = $fixturesController->getTeamNames();
        
        $teamname = array_column($selectTeamNames, 'teamname');
        
        echo '<table><tr><th>Gospodarz</th><th> </th><th> </th><th>Gość</th><th>Kolejka</th><th>Data<th></tr>';
        foreach ($selectFixturesByLeague as $match)
        {
        echo "<tr><td>(ID: ".$match['idteam1'].")".$teamname[$match['idteam1']-1]."</td><td>".$match['g_1']." : </td><td>".$match['g_2']."</td><td>(ID: ".$match['idteam2'].")".$teamname[$match['idteam2']-1]."</td><td>".$match['kolejka']                 ."</td><td>".$match['data']."</td></tr>";
        }
        echo '</table>';
    }
    

} else 
{
    echo '<h4>Pokaż Terminarz</h4>
    <form method="GET" action="wyniki.php">
    <input type="radio" name="idLeague" value="1">Premier league
    <input type="radio" name="idLeague" value="2">La Liga
    <input type="radio" name="idLeague" value="3">Serie A
    <input type="radio" name="idLeague" value="4">Ekstraklasa
    <input type="radio" name="idLeague" value="5">Fortuna 1 liga <br><br> 
    <input type="submit" value="Pokaż"> </form> ';
}