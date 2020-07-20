<?php
include"functions.php";
include"preSeasonTournamentsController.php";

if (empty($getAllTournaments))
{
echo "Obecnie nie ma otwartych turniejów";
echo " <a href='createPreseasonTournament.php'>Kliknij tutaj, by stworzyć turniej</a> <br>";
} else
  {
    foreach ($getAllTournaments as $tournament)
    {
      if($tournament['status'] == 0) {echo 'Publiczny<br>';} else {echo 'Prywatny<br>';}
      echo 'Identyfikator Turnieju: '.$tournament['id'].'<br> Założyciel '.$tournament['teamname'].'<br>Uczestnik2  id - '.$tournament['member2'].' <br> Uczestnik3 id - '.$tournament['member3'].'';
      echo '<br>Uczestnik4 id - '.$tournament['member4'].'<br> Data Rozpoczęcia: '.$tournament['date'].'<br>Dodatkowe Informacje: '.$tournament['comment'].' <br> Wpisowe: '.$tournament['fee'].' Menagocoins<br><br>';
    }
  }
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="" type="text/css">
  <title>Turnieje przedsezonowe</title>
</head>
  <body>
    <br>
<h4> Dołącz do turnieju</h4>
<form action="preSeasonTournamentsController.php" method="POST">
<input type="number" name="id" required> ID Turnieju <br>
<input type="number" name="password" required> hasło (jeśli turniej jest publiczny wpisz 0) <br>
<input type="submit" name="joinTournament" value="Dołącz" onclick="return confirm('Jesteś pewien? Może zostać pobrane wpisowe');">
</form>
</body>
</html>