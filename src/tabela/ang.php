<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once"../connect.php";



// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *
FROM Tabela
 join teams ON Tabela.idteams = teams.idteams
 where lig=1
 ORDER BY pkt DESC, bilans DESC, scored DESC
 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<table class="table"><tr><th>Nazwa</th><th>GP</th><th>W</th><th>D</th><th>L</th><th> + </th><th> - </th><th> +/- </th><th>pkt</th></tr>';
    while($row = $result->fetch_assoc()){

        echo  "<tr><td>" . $row["teamname"].
        "</td><td>" . $row["GP"]."</td><td>".
        "" . $row["W"]."</td><td>".
         "" . $row["D"]."</td><td>".
         "" . $row["L"]."</td><td>".
        "" . $row["scored"]."</td><td>".
        "" . $row["lost"]."</td><td>".
        "" . $row["bilans"]."</td><td>".
         "" . $row["pkt"]."</td></tr>".
        "";

    }
    echo '</table>';
} else {
    echo "Pusto";
}


$conn->close();





?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<link rel="stylesheet" href="../CSS/ang.css" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
  <meta charset="utf-8" />
  <title>Tabela</title>
</head>

<body>

<button><a href="tit2.php">POWRÓT!</a><button> <br>

</body>
    </html>