<!DOCTYPE HTML>
<html lang="pl">
<head>

  <meta charset="utf-8" />
  <link rel="stylesheet" href="" type="text/css">
  <title>Finanse</title>
</head>
<body>
<a href="kontogracza.php">POWRÓT</a>
</body>
</html>
<?php
include"functions.php";
include"financesController.php";

if (empty($finances))
{
    echo 'Twój bilans finansowy jest pusty!';
} else {
    echo '<table><tr><th>Transakcja</th><th>Budżet przed</th><th>Kwota Transakcji</th><th>Budżet Po</th><th>Data</th></tr>';
    foreach ($finances as $row)
        {
        echo"<tr><th>" . $row["comment"].
        "</th><th>  " . $row["moneyBefore"].
         "</th><th>  " . $row["value"].
         " </th><th>" . $row["moneyAfter"].
         " </th><th>" . $row["data"].
         


        "</th></tr>";
            }
        echo '</table>';
            }


