<!DOCTYPE HTML>
<html lang="pl">
<head>
   <link rel="stylesheet" href="" type="text/css">
  <meta charset="UTF-8" />
  <title> Wolni Zawodnicy </title>
</head>
    <body>
    
    <form method="POST" action="freeAgentController.php">
    <input type="number" name="idplayers" required> ID zawodnika<br>
    <input type="submit" name="sign" value="zaproponuj kontrakt"disabled>
    </form>
    </body> 
</html>

<?php
include"functions.php";
include"freeAgentController.php";

if (empty($players))
{
    echo 'Brak wolnych zawodników';
} else {
    echo '<table><tr><th>Zawodnik</th><th>ID</th><th>Pozycja</th><th>Skill</th><th>Tygodniówka</th></tr>';
    foreach ($players as $player)
        {
        echo"<tr><th>" . $player["playername"].
        "</th><th>  " . $player["idplayers"].
         "</th><th>  " . $player["pozycja"].
         " </th><th>" . $player["skill"].
         " </th><th>" . $player["pensja"].



        "</th></tr>";
            }
        echo '</table>';
            }
?>

