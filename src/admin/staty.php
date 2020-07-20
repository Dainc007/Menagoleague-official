<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once"../connect.php";

session_start();

include"../functions.php";
checkIfAdmin();

//ostatnie wyniki
// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "Select idgame, idteam1, idteam2, g_1, g_2, data, lig, teamname from Terminarz
JOIN teams
ON Terminarz.idteam1=teams.idteams
Where g_1 is not null
Order By  data DESC, Lig ASC
LIMIT 30";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
 echo '<table><tr><th>ID Meczu</th><th>Id Gosp.</th><th>Team</th><th>Wynik</th><th>ID Gości</th><th>Data Spotkania</th><th>Liga</th></tr>';
    while($row = $result2->fetch_assoc()) {

        echo  "<tr><th>" . $row["idgame"].
        "</th><th> " . $row["idteam1"].
        "</th><th>" . $row["teamname"].
        "</th><th>  " . $row["g_1"].
         " : " . $row["g_2"].
         " </th><th>" . $row["idteam2"].
         " </th><th>" . $row["data"].
         " </th><th>" . $row["lig"].


        "</th></tr>";
    }
    echo '</table>';
} else {
    echo "Pusto";
}

if(isset($_POST['test'])){
     //Ustawiamy zmienne
$data = date(" Y-m-d ");
$idgame = $_POST['idgame'];
$id1 = $_POST['id1'];
$ocena1 = $_POST['ocena1'];
$g1 = $_POST['g1'];
$a1 = $_POST['a1'];
$z1 = $_POST['z1'];
$c1 = $_POST['c1'];

$id2 = $_POST['id2'];
$ocena2 = $_POST['ocena2'];
$g2 = $_POST['g2'];
$a2 = $_POST['a2'];
$z2 = $_POST['z2'];
$c2 = $_POST['c2'];

$id3 = $_POST['id3'];
$ocena3 = $_POST['ocena3'];
$g3 = $_POST['g3'];
$a3 = $_POST['a3'];
$z3 = $_POST['z3'];
$c3 = $_POST['c3'];

$id4 = $_POST['id4'];
$ocena4 = $_POST['ocena4'];
$g4 = $_POST['g4'];
$a4 = $_POST['a4'];
$z4 = $_POST['z4'];
$c4 = $_POST['c4'];

$id5 = $_POST['id5'];
$ocena5 = $_POST['ocena5'];
$g5 = $_POST['g5'];
$a5 = $_POST['a5'];
$z5 = $_POST['z5'];
$c5 = $_POST['c5'];

$id6 = $_POST['id6'];
$ocena6 = $_POST['ocena6'];
$g6 = $_POST['g6'];
$a6 = $_POST['a6'];
$z6 = $_POST['z6'];
$c6 = $_POST['c6'];

$id7 = $_POST['id7'];
$ocena7 = $_POST['ocena7'];
$g7 = $_POST['g7'];
$a7 = $_POST['a7'];
$z7 = $_POST['z7'];
$c7 = $_POST['c7'];

$id8 = $_POST['id8'];
$ocena8 = $_POST['ocena8'];
$g8 = $_POST['g8'];
$a8 = $_POST['a8'];
$z8 = $_POST['z8'];
$c8 = $_POST['c8'];

$id9 = $_POST['id9'];
$ocena9 = $_POST['ocena9'];
$g9 = $_POST['g9'];
$a9 = $_POST['a9'];
$z9 = $_POST['z9'];
$c9 = $_POST['c9'];

$id10 = $_POST['id10'];
$ocena10 = $_POST['ocena10'];
$g10 = $_POST['g10'];
$a10 = $_POST['a10'];
$z10 = $_POST['z10'];
$c10 = $_POST['c10'];

$id11 = $_POST['id11'];
$ocena11 = $_POST['ocena11'];
$g11 = $_POST['g11'];
$a11 = $_POST['a11'];
$z11 = $_POST['z11'];
$c11 = $_POST['c11'];

$id12 = $_POST['id12'];
$ocena12 = $_POST['ocena12'];
$g12 = $_POST['g12'];
$a12 = $_POST['a12'];
$z12 = $_POST['z12'];
$c12 = $_POST['c12'];

$id13 = $_POST['id13'];
$ocena13 = $_POST['ocena13'];
$g13 = $_POST['g13'];
$a13 = $_POST['a13'];
$z13 = $_POST['z13'];
$c13 = $_POST['c13'];

$id14 = $_POST['id14'];
$ocena14 = $_POST['ocena14'];
$g14 = $_POST['g14'];
$a14 = $_POST['a14'];
$z14 = $_POST['z14'];
$c14 = $_POST['c14'];

$id15 = $_POST['id15'];
$ocena15 = $_POST['ocena15'];
$g15 = $_POST['g15'];
$a15 = $_POST['a15'];
$z15 = $_POST['z15'];
$c15 = $_POST['c15'];

$id16 = $_POST['id16'];
$ocena16 = $_POST['ocena16'];
$g16 = $_POST['g16'];
$a16 = $_POST['a16'];
$z16 = $_POST['z16'];
$c16 = $_POST['c16'];

$id17 = $_POST['id17'];
$ocena17 = $_POST['ocena17'];
$g17 = $_POST['g17'];
$a17 = $_POST['a17'];
$z17 = $_POST['z17'];
$c17 = $_POST['c17'];

$id18 = $_POST['id18'];
$ocena18 = $_POST['ocena18'];
$g18 = $_POST['g18'];
$a18 = $_POST['a18'];
$z18 = $_POST['z18'];
$c18 = $_POST['c18'];

$id19 = $_POST['id19'];
$ocena19 = $_POST['ocena19'];
$g19 = $_POST['g19'];
$a19 = $_POST['a19'];
$z19 = $_POST['z19'];
$c19 = $_POST['c19'];

$id20 = $_POST['id20'];
$ocena20 = $_POST['ocena20'];
$g20 = $_POST['g20'];
$a20 = $_POST['a20'];
$z20 = $_POST['z20'];
$c20 = $_POST['c20'];

$id21 = $_POST['id21'];
$ocena21 = $_POST['ocena21'];
$g21 = $_POST['g21'];
$a21 = $_POST['a21'];
$z21 = $_POST['z21'];
$c21 = $_POST['c21'];

$id22 = $_POST['id22'];
$ocena22 = $_POST['ocena22'];
$g22 = $_POST['g22'];
$a22 = $_POST['a22'];
$z22 = $_POST['z22'];
$c22 = $_POST['c22'];

$id23 = $_POST['id23'];
$ocena23 = $_POST['ocena23'];
$g23 = $_POST['g23'];
$a23 = $_POST['a23'];
$z23 = $_POST['z23'];
$c23 = $_POST['c23'];

$id24 = $_POST['id24'];
$ocena24 = $_POST['ocena24'];
$g24 = $_POST['g24'];
$a24 = $_POST['a24'];
$z24 = $_POST['z24'];
$c24 = $_POST['c24'];

$id25 = $_POST['id25'];
$ocena25 = $_POST['ocena25'];
$g25 = $_POST['g25'];
$a25 = $_POST['a25'];
$z25 = $_POST['z25'];
$c25 = $_POST['c25'];

$id26 = $_POST['id26'];
$ocena26 = $_POST['ocena26'];
$g26 = $_POST['g26'];
$a26 = $_POST['a26'];
$z26 = $_POST['z26'];
$c26 = $_POST['c26'];

$id27 = $_POST['id27'];
$ocena27 = $_POST['ocena27'];
$g27 = $_POST['g27'];
$a27 = $_POST['a27'];
$z27 = $_POST['z27'];
$c27 = $_POST['c27'];

$id28 = $_POST['id28'];
$ocena28 = $_POST['ocena28'];
$g28 = $_POST['g28'];
$a28 = $_POST['a28'];
$z28 = $_POST['z28'];
$c28 = $_POST['c28'];

$id29 = $_POST['id29'];
$ocena29 = $_POST['ocena29'];
$g29 = $_POST['g29'];
$a29 = $_POST['a29'];
$z29 = $_POST['z29'];
$c29 = $_POST['c29'];

$id30 = $_POST['id30'];
$ocena30 = $_POST['ocena30'];
$g30 = $_POST['g30'];
$a30 = $_POST['a30'];
$z30 = $_POST['z30'];
$c30 = $_POST['c30'];
// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['checkbox1'])) {
$sql = "INSERT INTO Stats VALUES (null,'$idgame', '$id1', '$ocena1', '$g1', '$a1', '$z1', '$c1',DEFAULT);";
}
if(isset($_POST['checkbox2'])) {
$sql .=" INSERT INTO Stats VALUES (null,'$idgame', '$id2', '$ocena2', '$g2', '$a2', '$z2', '$c2',DEFAULT);";
}
if(isset($_POST['checkbox3'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id3', '$ocena3', '$g3', '$a3', '$z3', '$c3',DEFAULT);";
}

if(isset($_POST['checkbox4'])) {
    $sql .= "INSERT INTO Stats VALUES (null,'$idgame', '$id4', '$ocena4', '$g4', '$a4', '$z4', '$c4',DEFAULT);";
}

if(isset($_POST['checkbox5'])) {
    $sql .=" INSERT INTO Stats VALUES (null,'$idgame', '$id5', '$ocena5', '$g5', '$a5', '$z5', '$c5',DEFAULT);";
}

if(isset($_POST['checkbox6'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id6', '$ocena6', '$g6', '$a6', '$z6', '$c6',DEFAULT);";
}

if(isset($_POST['checkbox7'])) {
    $sql .= "INSERT INTO Stats VALUES (null,'$idgame', '$id7', '$ocena7', '$g7', '$a7', '$z7', '$c7',DEFAULT);";
}

if(isset($_POST['checkbox8'])) {
    $sql .=" INSERT INTO Stats VALUES (null,'$idgame', '$id8', '$ocena8', '$g8', '$a8', '$z8', '$c8',DEFAULT);";
}

if(isset($_POST['checkbox9'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id9', '$ocena9', '$g9', '$a9', '$z9', '$c9',DEFAULT);";
}

if(isset($_POST['checkbox10'])) {
    $sql .=" INSERT INTO Stats VALUES (null,'$idgame', '$id10', '$ocena10', '$g10', '$a10', '$z10', '$c10',DEFAULT);";
}

if(isset($_POST['checkbox11'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id11', '$ocena11', '$g11', '$a11', '$z11', '$c11',DEFAULT);";
}

if(isset($_POST['checkbox12'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id12', '$ocena12', '$g12', '$a12', '$z12', '$c12',DEFAULT);";
}

if(isset($_POST['checkbox13'])) {
    $sql .=" INSERT INTO Stats VALUES (null,'$idgame', '$id13', '$ocena13', '$g13', '$a13', '$z13', '$c13', DEFAULT);";
}

if(isset($_POST['checkbox14'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id14', '$ocena14', '$g14', '$a14', '$z14', '$c14',DEFAULT);";
}

if(isset($_POST['checkbox15'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id15', '$ocena15', '$g15', '$a15', '$z15', '$c15',DEFAULT);";
}

if(isset($_POST['checkbox16'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id16', '$ocena16', '$g16', '$a16', '$z16', '$c16',DEFAULT);";
}

if(isset($_POST['checkbox17'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id17', '$ocena17', '$g17', '$a17', '$z17', '$c17',DEFAULT);";
}

if(isset($_POST['checkbox18'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id18', '$ocena18', '$g18', '$a18', '$z18', '$c18',DEFAULT);";
}

if(isset($_POST['checkbox19'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id19', '$ocena19', '$g19', '$a19', '$z19', '$c19',DEFAULT);";
}
if(isset($_POST['checkbox20'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id20', '$ocena20', '$g20', '$a20', '$z20', '$c20',DEFAULT);";
}
if(isset($_POST['checkbox21'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id21', '$ocena21', '$g21', '$a21', '$z21', '$c21',DEFAULT);";
}
if(isset($_POST['checkbox22'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id22', '$ocena22', '$g22', '$a22', '$z22', '$c22',DEFAULT);";
}
if(isset($_POST['checkbox23'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id23', '$ocena23', '$g23', '$a23', '$z23', '$c23',DEFAULT);";
}
if(isset($_POST['checkbox24'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id24', '$ocena24', '$g24', '$a24', '$z24', '$c24',DEFAULT);";
}
if(isset($_POST['checkbox25'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id25', '$ocena25', '$g25', '$a25', '$z25', '$c25',DEFAULT);";
}
if(isset($_POST['checkbox26'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id26', '$ocena26', '$g26', '$a26', '$z26', '$c26',DEFAULT);";
}
if(isset($_POST['checkbox27'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id27', '$ocena27', '$g27', '$a27', '$z27', '$c27',DEFAULT);";
}

if(isset($_POST['checkbox28'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id28', '$ocena28', '$g28', '$a28', '$z28', '$c28',DEFAULT);";
}
if(isset($_POST['checkbox29'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id29', '$ocena29', '$g29', '$a29', '$z29', '$c29',DEFAULT);";
}
if(isset($_POST['checkbox30'])) {
    $sql .= " INSERT INTO Stats VALUES (null,'$idgame', '$id30', '$ocena30', '$g30', '$a30', '$z30', '$c30',DEFAULT);";
}

if ($conn->multi_query($sql) === TRUE) {
  header('Location: ../ok2.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
  
 }

if(isset($_POST['teamid'])) { 
$teamid = $_POST['teamid'];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
                          }
                          
$sql = "SELECT idplayers, playername FROM players WHERE idteams=$teamid order by playername ASC";
$result = $conn->query($sql);
$id = $_POST['name'];
$n = "id";
$cb = "checkbox";
$o = "ocena";
$g = "g";
$a = "a";
$z = "z";
$c = "c";
$i=1;
$j=1;
$k=1;
$l=1;
$m=1;
$y=1;
$x=1;
$v=1;


if ($result->num_rows > 0) {
    echo '<form method="POST"><input type="number" required name="idgame">ID meczu';
    echo '<table> <tr><th>Nazwisko</th><th></th><th>Ocena Meczowa</th><th>Bramki</th><th>Asysty</th><th>żółte</th><th>Czerwone</th></tr><tr>';
    while($player = $result->fetch_assoc()) {
       echo '<td><input type="checkbox" name="'.$cb.''.$v++.'" value="">'.$player['playername'].'</td><td><input hidden  type="number" name="'.$n.''.$i++.'" value="'.$player['idplayers'].'">
       </td>'.'<td><input type="number" name="'.$o.''.$j++.'" min="0" max="100"></td>'.'<td><input type="number" name="'.$g.''.$k++.'" min="0" max="10" value=""></td>'.'<td><input type="number" name="'.$a.''.$l++.'" min="0" max="10" value=""></td>'.'<td><input type="number" name="'.$z.''.$m++.'" min="0" max="2" value=""></td>'.'<td><input type="number" name="'.$c.''.$y++.'" min="0" max="1" value=""></td></tr>';
       
    }
     echo '</table><input type="submit" name="test" value="Prześlij"></form>';
     echo '<a href="/admin/menu.php">Powrot</a>';
     exit();
} else {
    echo "Obecnie żaden piłkarz nie jest wystawiony na sprzedaż<br><br>";
}

$result->free_result();

$conn->close();

}
 






?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title>Test</title>
</head>
<body>
<form method="POST">
     <input type="number" name="teamid"> ID drużyny
     <input type="submit" name="wyszukajpoid" value="wyszukaj">
   </form>
   </body>
   </html>

<?php

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql3 = "Select * from Stats
Order By idstats DESC, DATA DESC, idplayers DESC
LIMIT 28";

$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    // output data of each row
 echo '<table><tr><th>ID Stats</th><th>Id Meczu</th><th>Id Zawodnika</th><th>Ocena Meczowa</th><th>Gole</th><th>Asysty</th><th> Z </th><th> C </th><th>DATA</th></tr>';
    while($row = $result3->fetch_assoc()) {

        echo  "<tr><th>" . $row["idstats"].
        "</th><th> " . $row["idgame"].
        "</th><th>" . $row["idplayers"].
        "</th><th>  " . $row["ocena"].
         "</th><th> " . $row["gole"].
         " </th><th>" . $row["asysty"].
         " </th><th>" . $row["zolte"].
          " </th><th>" . $row["czerwone"].
          " </th><th>" . $row["DATA"].


        "</th></tr>";
    }
    echo '</table>';
} else {
    echo "Pusto";
}
    

 