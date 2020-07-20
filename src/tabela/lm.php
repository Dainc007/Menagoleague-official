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
FROM TabelaLM
 join teams ON TabelaLM.idteams = teams.idteams
 Where Lig=1
 ORDER BY pkt DESC, bilans DESC
 ";
 $sql2 = "SELECT *
FROM TabelaLM
 join teams ON TabelaLM.idteams = teams.idteams
 Where Lig=2
 ORDER BY pkt DESC, bilans DESC
 ";
 $sql3 = "SELECT *
FROM TabelaLM
 join teams ON TabelaLM.idteams = teams.idteams
 Where Lig=3
 ORDER BY pkt DESC, bilans DESC
 ";
 $sql4 = "SELECT *
FROM TabelaLM
 join teams ON TabelaLM.idteams = teams.idteams
 Where Lig=4
 ORDER BY pkt DESC, bilans DESC
 ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<table class="table"><tr><th>Grupa A</th><th>GP</th><th>W</th><th>D</th><th>L</th><th> + </th><th> - </th><th> +/- </th><th>pkt</th></tr>';
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
    
} else {
    echo "Pusto";
}

//b
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    echo '<table class="table"><tr><th>Grupa B</th><th>GP</th><th>W</th><th>D</th><th>L</th><th> + </th><th> - </th><th> +/- </th><th>pkt</th></tr>';
    while($row = $result2->fetch_assoc()){ 
    

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
//c

$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    // output data of each row
    echo '<table class="table"><tr><th>Grupa C</th><th>GP</th><th>W</th><th>D</th><th>L</th><th> + </th><th> - </th><th> +/- </th><th>pkt</th></tr>';
    while($row = $result3->fetch_assoc()){ 
    

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
//d

$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
    // output data of each row
    echo '<table class="table"><tr><th>Grupa D</th><th>GP</th><th>W</th><th>D</th><th>L</th><th> + </th><th> - </th><th> +/- </th><th>pkt</th></tr>';
    while($row = $result4->fetch_assoc()){ 
    

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
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../CSS/1liga.css" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
  <title>Tabela</title>
</head>

<body>

<a href="tit2.php">POWRÓT!</a> <br>

</body>
    </html>