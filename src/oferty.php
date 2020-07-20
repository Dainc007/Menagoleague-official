<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
 //wymagane do połączenia z bazą
require_once"connect.php";

//Sprawdzamy, czy jesteś zalogowany
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
//po złożeniu oferty
if(isset($_POST['submit'])) {
// ustawiam dla pewności wszystkie zmienne
$idteams = $_SESSION['idteams'];
$team_name = $_SESSION['teamname'];
$money = $_SESSION['money'];
$idplayers = $_POST['idplayers'];
$idteams2 = $_POST['idteams2'];
$cena = $_POST['cena'];
$kom = $_POST['kom'];
$comment = "Złożyliśmy ofertę transferową w wysokości $cena";

//sprawdzamy, czy stać nas na transfer
if($money>=$cena) {
    //Jeśli tak, sprawdzamy czy nie składamy oferty samemu sobie
    if($idteams2 != $idteams) {
      
        // Create connection
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        mysqli_query($conn,"SET CHARSET utf8");
    mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
        // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
                                      }
        //Sprawdzmy, czy gracz nie zlozyl juz oferty za tego samego zawodnika wczesniej
        $sql3 = "SELECT * FROM oferty WHERE idplayers=$idplayers AND id_k=$idteams AND STATUS=0";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows <= 0) {
          //Jeśli nie ma zadnej oferty mozemy działać
          //Dodajemy rekord do tabeli z ofertami
          $sql = "INSERT INTO oferty VALUES (null, '$idteams' , '$team_name' , '$idteams2', '$kom', default, '$cena', '$idplayers')";
          $result = $conn->query($sql);
          //dodajemy wpis do finansów
          $sql10 = "INSERT INTO finances VALUES (null, $idteams, '$comment', $money, $cena, $money-$cena, DEFAULT)";
              $result10 = $conn->query($sql10);
          //Zamrazamy pieniadze za oferte
          $sql2 = "UPDATE teams SET money=$money-$cena WHERE idteams=$idteams";
          $result2 = $conn->query($sql2);
          header('Location: ok.php');
          $result->free_result();
          $result2->free_result();
          $conn->close();
        }         else {
                        //usunalem zwalnianie resulta
                         
                        $conn->close();
                          echo " Złożyłeś już ofertę za tego zawodnika!";
                          echo "<br> <a href='oferty.php'>Powrót!</a>";
                          exit();
                      }                    
        






    }
        else   {
                 echo " Nie możesz złożyć oferty samemu sobie!";
                echo "<br> <a href='oferty.php'>Powrót!</a>";
                exit();

                 }


}

        else   {
                  echo "Nie stać Cię na przeprowadzenie tego transferu";
                  echo "<br> <a href='oferty.php'>Powrót!</a>";
                    exit();
                }



 }

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
<link rel="stylesheet" href="/CSS/kontogracza.css" type="text/css">
  <meta charset="utf-8" />
  <title></title>
</head>

 <body>
 <nav class="menu">

          
          <a href="/wyszukiwarka.php">Wyszukiwarka</a>
          <a href="transferlist.php">Lista Transferowa</a>
          <a href="transfery.php">Sprzedaj Zawodnika</a>


</nav>
<h4>Złóż ofertę za zawodnika</h4>
   <form action="oferty.php" method="POST" >
     <input type="number" min="1" name="idplayers" required > ID zawodnika <br>
     <input type="number" min="1" name="idteams2" required > ID Drużyny <br>
     <input type="number" min="1" name="cena" required > Kwota Transferu <br>
     <input type="text" maxlength="300" name="kom" width="300" height="300" required > Komentarz <br>
     <input type="submit" name="submit" value="Złóż ofertę"disabled >
    </form>


       
       

  </body>
    </html>