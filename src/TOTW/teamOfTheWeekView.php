<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8"/>
  <title>TOTW</title><link rel="stylesheet" href="../CSS/TOTW.css" type="text/css">
</head>
 
<?php
include"teamOfTheWeekController.php";

echo '  <a href="../tabela/tit2.php">Powrót</a><br>
        Wybierz kraj, a następnie wpisz numer kolejki
        <form method="GET" action="teamOfTheWeekView.php">
        <input type="radio" name="lig" value="1" required>Anglia
        <input type="radio" name="lig" value="2">Hiszpania
        <input type="radio" name="lig" value="3">Włochy
        <input type="radio" name="lig" value="4">Ekstraklasa
        <input type="radio" name="lig" value="5">1 liga <br><br>
        <input type="number" name="kol" min="1" max="9" required>

        <input type="submit" value="Pokaż"> </form>';



if(isset($_GET['lig']))
{   $lig = $_GET['lig'];
    $kol = $_GET['kol'];
    
    $TOTWController = new TOTWController();
    $getTwoBestStrikers = $TOTWController->getTwoBestStrikers($lig, $kol);
    $getFourBestMiddle = $TOTWController->getFourBestMiddle($lig, $kol);
    $getFourBestDefenders = $TOTWController->getFourBestDefenders($lig, $kol);
    $getBestGk = $TOTWController->getBestGk($lig, $kol);
    
    if(empty($getTwoBestStrikers))
    {
        echo 'TOTW nie zostało jeszcze wygenerowane';
    } else
     {  echo '<div class="pitch"><h4>Najlepsza jedenastka '.$kol.' kolejki</h4>';
        //echo '<img src="../CSS/pictures/soccer-field.png" ';
        foreach ($getTwoBestStrikers as $striker) 
        {
        echo '<img src="../CSS/pictures/footballer.png" alt="Zawodnik">'. $striker['playername'].'('.$striker['teamname'].')';
        }
        echo "<br>";
        foreach ($getFourBestMiddle as $middle) 
        {
        echo '<img src="../CSS/pictures/footballer.png" alt="Zawodnik">'.$middle['playername'].'('.$middle['teamname'].')';
        }
        echo "<br>";
        foreach ($getFourBestDefenders as $defender) 
        {
        echo '<img src="../CSS/pictures/footballer.png" alt="Zawodnik">'.$defender['playername'].'('.$defender['teamname'].')';
        }
        echo "<br>";
        foreach ($getBestGk as $goalkeeper) 
        {
        echo '<img src="../CSS/pictures/footballer.png" alt="Zawodnik">'.$goalkeeper['playername'].'('.$goalkeeper['teamname'].')';
        }
        echo '</div> ';
       
    }
    

} else {
    echo '<a href="../tabela/tit2.php">Powrót</a><br>
    <form method="GET" action="teamOfTheWeekView.php">
        <input type="radio" name="lig" value="1">Anglia
        <input type="radio" name="lig" value="2">Hiszpania
        <input type="radio" name="lig" value="3">Włochy
        <input type="radio" name="lig" value="4">Ekstraklasa
        <input type="radio" name="lig" value="5">1 liga <br><br>
        <input type="number" name="kol" min="1" max="9" required>

        <input type="submit" value="Pokaż"> </form> ';
 }
