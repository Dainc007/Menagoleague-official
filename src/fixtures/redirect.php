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
  <meta charset="utf-8" http-equiv="Refresh" content="1; url=http://menagoleague.pl/playerAccount/central">
  <title></title>
</head>

 <body>
  <p> Operacja przebiegła pomyślnie. Proszę czekać...</p>
  <p> Zaraz nastąpi przekierowanie</p>

  </body>
    </html>