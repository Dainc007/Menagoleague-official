<?php

  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once"connect.php";
  //sprawdzamy, czy jesteś zalogowany
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}
//Podstawowe informacje i pliki
  require_once"connect.php";
$idteams = $_SESSION['idteams'];
$team_name = $_SESSION['teamname'];
 $money = $_SESSION['money'];

//sprawdzamy, czy masz drużynę


if ($idteams !=0)
{

    //sprawdzamy, czy budżet klubu wyświetla się poprawnie. W przeciwnym razie zostaniesz przeniesiony
    // Jest to zabezpieczenie przed wejściem do pliku oferty.php bez uprzedniego wejścia na forum.php
    if (!isset($_SESSION['money']))
    {
      header('Location: kontogracza.php');
      exit();
    }


  
  if(isset($_POST['transfer']))
  {
    //ustalamy zmienne      
    $idplayers = $_POST['idplayers'];
    $idteams2 = $_POST['idteams2'];
    $cena = $_POST['cena'];
    $money = $_SESSION['money'];
    $comment = "Sprzedaliśmy piłkarza o id $idplayers";
    // Tworzymy połączenie z bazą
    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    // Sprawdzamy dla zabezpieczenia
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    //sprawdzamy, czy zawodnik zmienił już klub w tym oknie transferowym
    $sql8 = "SELECT * FROM oferty WHERE idplayers=$idplayers AND status=1";
    $result8 = $conn->query($sql8);
    if ($result8->num_rows > 0)
      {
      echo 'Ten zawodnik zmienił już klub w tym oknie transferowym. Jego sprzedaż jest niemożliwa';
      exit();
      } else 
      {
        //Sprawdzamy, czy faktycznie otrzymaliśmy ofertę za zawodnika, którego usiłujemy sprzedać. Cena musi się zgadzać, status też
        $sql = "SELECT * FROM oferty WHERE idplayers=$idplayers AND id_k =$idteams2 AND status=0 AND kwota=$cena";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
          //Złożono ofertę za zawodnika i jest ona aktywna. Sprawdzamy czy zawodnik faktycznie nalezy do nas
          $sql2 = "SELECT * FROM players WHERE idplayers=$idplayers AND idteams=$idteams";
          $result2 = $conn->query($sql2);
            if ($result->num_rows > 0)
            {
            //Piłkarz należy do nas. Możemy wykonać transfer
            //Zabieramy piłkarza
            $sql4="UPDATE players SET idteams=$idteams2 WHERE idplayers=$idplayers AND idteams=$idteams";
            $result4 = $conn->query($sql4);
            //Dodajemy wpis do finansów
            $sql10 = "INSERT INTO finances VALUES (null, $idteams, '$comment', $money, $cena, $money+$cena, DEFAULT)";
            $result10 = $conn->query($sql10);
            //Dajemy należne pieniążki
            $sql3 = " UPDATE teams SET money=$money+$cena WHERE idteams=$idteams";
            $result3 = $conn->query($sql3);
            //Zmieniamy status oferty
            $sql5 = " UPDATE oferty SET STATUS=1 WHERE idplayers=$idplayers AND id_k=$idteams2 AND status=0";
            $result5 = $conn->query($sql5);
            //Anulujemy wszystkie pozostałe oferty za piłkarza, w końcu zmienił już klub
            $sql6 = " UPDATE oferty SET STATUS=2 WHERE idplayers=$idplayers AND id_k!=$idteams2 AND status=0";
            $result6 = $conn->query($sql6);
            //usuwamy wszystkie oferty o tym id z listy transferowej
             $sql7 = " DELETE from transferlist WHERE idplayers=$idplayers";
            $result7 = $conn->query($sql7);
            

            header('Location: ok.php');
            $result->free_result();
            $result2->free_result();
            $result3->free_result();
            $result4->free_result();
            $result5->free_result();
            $result6->free_result();
            $conn->close();

            } else 
              { $conn->close();
              echo "Nie możesz sprzedać piłkarza, który nie należy do Ciebie!";
              echo '<a href="transfery.php">Powrót!</a>';
              exit();
              }


        }   else { $conn->close();
              echo "Klub, któremu usiłujesz sprzedać piłkarza nie jest zainteresowany jego kupnem.";
              echo '<a href="transfery.php">Powrót!</a>';
              exit();
                }

      }

  }
 


} else {
    echo "Nie masz klubu<br>";
    echo '<a href="kontogracza.php">Powrót!</a>';
    exit();
      }





?>





<!DOCTYPE HTML>
<html lang="pl">
<head>

  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/kontogracza.css" type="text/css">
  <title>Moja Drużyna</title>
</head>

<body>
    <nav class="menu">

          <a href="/kontogracza.php">Menu Główne</a>
          <a href="/wyszukiwarka.php">Wyszukiwarka</a>
          <a href="http://menagoleague.pl/transferlist.php?order=idtransferlist&szukaj=Poka%C5%BC+List%C4%99">Lista Transferowa</a>
          <a href="oferty.php">Oferty</a>
          <a href="http://menagoleague.pl/pack/packView">Paczki</a>



</nav>
<p style="color:green">Okno Transferowe jest obecnie<b> OTWARTE</b></p>
<h4>Sprzedaj zawodnika</h4>
    <form method="post">
    <input type="number" name="idplayers" min="1" value="" required > ID piłkarza z Twojej drużyny, którego chciałbyś sprzedać<br>
    <input type="number" name="idteams2" min="1" value="" required > ID drużyny, której chcesz sprzedać zawodnika  <br>
    <input type="number" name="cena" min="1" value="" required > kwota transferu <br>
     <input type="submit" name="transfer" value="Sprzedaj" disabled>   <br> <br>
    </form>
   


  <body>
<?php include"powiadomienia.php"; ?>
    </html>