<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  header('Content-Type: text/html; charset=UTF-8');

  session_start();
  require_once"connect.php";
  require_once"functions.php";

checklogged();
$idteams = $_SESSION['idteams'];

$conn = new mysqli($host, $db_user, $db_password, $db_name);
  mysqli_query($conn,"SET CHARSET utf8");
  mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
  $sql = "SELECT playername, SUM(gole) AS goals,SUM(czerwone) AS reds ,SUM(zolte) AS yellows,SUM(asysty) AS assists FROM Stats
                          JOIN Terminarz
                          ON Stats.idgame=Terminarz.idgame
                          JOIN players
                          ON Stats.idplayers=players.idplayers
                          JOIN teams
                          ON players.idteams=teams.idteams
                          Where teams.idteams=$idteams
                          Group By Stats.idplayers
						Order By goals DESC";
  $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
    // output data of each row
    echo "<table><tr><th>Zawodnik</th><th>Bramki</th><th> Asysty </th><th> Żółte </th><th> Czerwone </th></tr>";
    while($row = $result->fetch_assoc()) {
        
        echo  "<tr><td>" . $row["playername"].
        "</td><td>" . $row["goals"].
        "</td><td>" . $row["assists"].
        "</td><td>" . $row["yellows"].
         "</td><td>" . $row["reds"].


        "</td></tr>";
    } echo '</table> <a href="myteam.php">Powrót!</a>';
} else {
    echo "Żaden z Twoich piłkarzy nie zagrał jeszcze meczu w tym sezonie";
}


        
$conn->close();
