<?php
session_start();

require_once"connect.php";
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/transferlist.css" type="text/css">
  <title></title>
</head>

<body>
<nav class="menu">

          <a href="/kontogracza.php">Menu Główne</a>
          <a href="/wyszukiwarka.php">Wyszukiwarka</a>
          <a href="/freeAgentView.php">Wolni zawodnicy</a>
          <a href="oferty.php">Oferty</a>



</nav> <br><br><br><br>
 <div class="list_wrap">
        <div class="list_choose">

            <div>
                <h4> Sortuj piłkarzy według: </h4>
            </div>
            <div class="input_class_wrap">
                <form method="GET" action="transferlist.php">
                    <div class="input_class">
                        <input type="radio" id="new" name="order" class="dwradio" value="idtransferlist">
                       <label for="new"> Najnowszych </label>
                    </div>


                    <div class="input_class"><input type="radio" id="c" name="order" value="Cena">
                        <label for="c"> Najdroższych</label>

                    </div>

                    <div class="input_class"><input type="radio" id="ovr" name="order" value="skill">
                        <label for="ovr">Najlepszych</label>

                    </div>

                    <div class="input_class" class="submit"><input type="submit" name="szukaj" value="Pokaż Listę"></div>
                </form>
            </div>
            
        </div>
        <div class="wystaw">
            <h4> Aby wystawić zawodnika na sprzedaż, przejdź do zakładki <a href="myteam/myTeamView">Moja Drużyna</a> </h4>
            <form action="transferlist.php" method="post">
                <label>Piłkarz:<input type="text" name="name" value="" required disabled></label>
                <label>Pozycja:<input type="text" name="position" value="" required disabled> </label>
                <label>Skill:<input type="number" name="skill" value="" required disabled> </label>
                <label>Cena:<input type="number" name="cena" value="" required disabled></label>
                <label>Podaj dane do kontaktu - FB/GamerTag bądź
                    jakikolwiek inny preferowany przez Ciebie sposób kontaktu:<input type="text" name="kontakt" value="" required> </label>
                <input type="submit" name="submit" value="Dodaj"disabled>
        </div>

        <div class="wycofaj">
            <h4> Wycofaj piłkarza z listy transferowej </h4>
            </form>

            <form action="transferlist.php" method="post">
                <label>Nr ogłoszenia:<input type="number" name="idtransferlist" value=""></label>
                <input type="submit" value="Wycofaj Ogłoszenie" name="delete">
            </form>
        </div>
    </div>
</body>

</html>
    

<?php


//Wyswietlamy liste transferowa
if(isset($_GET['szukaj'])) {
$order = $_GET['order'];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                          }
                          
$sql = "SELECT * FROM transferlist ORDER BY $order DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<table><tr><th>Zawodnik</th><th>Pozycja</th><th>SKILL</th><th>Cena</th><th>Kontakt</th></th><th> Nr ogłoszenia</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr><td> " . $row["playername"]. "</td><td>" . $row["pozycja"]. "</td><td> " . $row["skill"]. "  </td><td> " . $row["cena"]. "</td><td> " . $row["kontakt"]."  </td><td> " . $row["idtransferlist"]. "</td></tr>";
    }
    echo '</table>';
} else {
    echo "Obecnie żaden piłkarz nie jest wystawiony na sprzedaż<br><br>";
}


$result->free_result();

$conn->close();
}
//Nastepnie dodajemy nowego zawodnika na liste

$playername = $_POST['playername'];
$position = $_POST['position'];
$skill = $_POST['skill'];
$price = $_POST['price']; 
$contact = $_POST['contact'];
$idteams = $_SESSION['idteams'];
$idplayers = $_POST['idplayers'];

if(isset($_POST['submit'])) {
// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                          }
                          
$sql2 = "INSERT INTO transferlist VALUES (null, '$playername','$idplayers', '$position', '$skill', '$price', '$contact' , '$idteams', DEFAULT)";
header('Location: myteam/myTeamView.php');

$result2 = $conn->query($sql2);

$result->free_result();

$conn->close();
exit();
}
//usuwanie swoich zawodnikow z listy transferowej

if(isset($_POST['delete']))
{
    
    // Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                          }
 $idtransferlist = $_POST['idtransferlist'];
$sql3 = "DELETE FROM transferlist WHERE idteams=$idteams AND idtransferlist=$idtransferlist";
$result3 = $conn->query($sql3);
    
} else {
    echo "";
}

?>