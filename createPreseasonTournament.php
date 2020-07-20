<?php

include"functions.php";
include"preSeasonTournamentsController.php";
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
    <h4> Stwórz Turniej</h4>
<form action="preSeasonTournamentsController.php" method="POST">
  <input type="datetime" name="date" required> Data rozpoczęcia (dokładnie w takim formacie: 2020-06-15 21:00:00) <br>
  <input type="number" name="fee" required> Wpisowe (Jeśli nie chcesz wpisowego - wpisz 0) <br>
  <input type="number" name="password" required> hasło (jeśli turniej ma być publiczny wpisz 0)
   <input type="radio" id="public" checked name="status" value="0"> publiczny
  <input type="radio" id="private" name="status" value="1"> prywatny <br>
  <input type="text" name="comment"> Dodatkowe informacje (np. podział nagród)
  <input type="submit" name="createTournament" value="Stwórz turniej">
</body>
</html>
