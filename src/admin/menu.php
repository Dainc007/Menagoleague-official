<?php

session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}

if ($_SESSION['idteams'] !=1)
{
  header('Location: index.php');
  echo "<strong>Nie masz uprawnień</strong>";
  exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="" type="text/css">
  <title>Panel Admina</title>
</head>

<body>

  <nav class="menu">
          <a href="/admin/wyniki.php">Wyniki</a> <br>
          <a href="/admin/staty.php">Statystyki</a> <br> <br>
          <a href="/admin/wynikiLM.php">Wyniki - LM</a> <br>
          <a href="/admin/statyLM.php">Statystyki - LM</a> <br><br>
          <a href="/admin/adminFinances.php">Wpisy do finansów</a> <br><br>
          <a href="../rankingUpdate.php">Aktualizuj ranking</a> - Nie klikać! ;)
         
        
</nav>
</body>
</html>