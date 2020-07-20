<?php
//Sprawdzamy, czy jesteś zalogowany
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}
//Strona powinna powiadomić Cię, że wszystko przebiegło pomyślnie a następnie przekierować ponownie do strony głównej
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" http-equiv="Refresh" content="0; url=http://menagoleague.pl/myteam/myTeamView.php">
  <title></title>
</head>

 <body>
   <p> Nie naciskaj "<b>wstecz</b>" ani <b>F5</b>, nie odświeżaj strony </p> <br>
    Twoja akcja przebiegła pomyślnie. <h4>Zaczekaj na przekierowanie</h4>

  </body>
    </html>