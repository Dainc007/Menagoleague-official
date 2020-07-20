<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  ?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>

<body>
    <a href="tit2.php">Powrót!</a>
  <form method="GET">
<input type="checkbox" id="ang" name="liga" value="1"> Anglia <br>
  <input type="checkbox" id="hiszp" name="liga" value="2"> Hiszpania <br>
  <input type="checkbox" id="wl" name="liga" value="3"> Włochy <br>
  <input type="checkbox" id="eks" name="liga" value="4"> Ekstraklasa <br>
  <input type="checkbox" id="eks2" name="liga" value="5"> 1 liga Polska <br>
<br> <br>
  <input type="radio" id="g" name="order" value="gole" required> Bramki <br>
  <input type="radio" id="a" name="order" value="asysty"> Asysty <br>
  <input type="radio" id="c" name="order" value="czerwone"> Czerwone Kartki <br>

  <input type="submit" name="szukaj" value="Pokaż Listę">
</form>

</body>
    </html>

<?php

if(isset($_GET['szukaj'])) {
  $host ="localhost";
  $db_user = "14760_menago";
  $db_password = "Rv8K@79sIA!0D";
  $db_name ="14760_menago";

  
  $order = $_GET['order'];
  $liga = $_GET['liga'];

  // Create connection
  $conn = new mysqli($host, $db_user, $db_password, $db_name);
  mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                          }


                          $sql = "SELECT SUM($order), playername,teamname FROM Stats
                          JOIN Terminarz
                          ON Stats.idgame=Terminarz.idgame
                          JOIN players
                          ON Stats.idplayers=players.idplayers
                          JOIN teams
                          ON players.idteams=teams.idteams
                          Where lig=$liga
                          Group By Stats.idplayers
                          Order by SUM($order) DESC
                          ";
                        $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                              // output data of each row
                              echo "<table><tr><th>Zawodnik</th><th>Drużyna</th><th> $order </th></tr>";
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr><td> " . $row["playername"]. "</td><td>" . $row["teamname"]. "</td><td> " . $row["SUM($order)"]. "  </td></tr>";
                              }
                              echo '</table>';
                          } else {
                              echo "Wybierz Kraj a następnie rodzaj statystyk, które chciałbyś zobaczyć";
                          }
                          $result->free_result();

                          $conn->close();

                        }




 ?>
