<?php
require_once"connect.php";
function generateFixtures()
{

}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>

  <meta charset="utf-8" />
  <title>Moja Drużyna</title>
</head>

<body>
<form method="POST">
  <input type="submit" name="generateFixtures">
  <input type="number"  name="idteam1" value="$_POST['idteam1']"> <br>
  <input type="number"  name="idteam2"> <br>
  <input type="number"  name="idteam3"> <br>
  <input type="number"  name="idteam4"> <br>
  <input type="number"  name="idteam5"> <br>
  <input type="number"  name="idteam6"> <br>
  <input type="number"  name="idteam7"> <br>
  <input type="number"  name="idteam8"> <br>
  <input type="number"  name="idteam9"> <br>
  <input type="number"  name="idteam10"> <br>
  <input type="number"  name="numberOfTeams"> Liczba drużyn <br>
</body>
</html>
<?php
if(isset($_POST['generateFixtures'])) {
$idteam1 = $_POST['idteam1']; $idteam2 = $_POST['idteam2']; $idteam3 = $_POST['idteam3']; $idteam4 = $_POST['idteam4']; $idteam5 = $_POST['idteam5'];
$idteam6 = $_POST['idteam6']; $idteam7 = $_POST['idteam7']; $idteam8 = $_POST['idteam8']; $idteam9 = $_POST['idteam9']; $idteam10 = $_POST['idteam10'];


        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        // Sprawdzamy dla zabezpieczenia
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        

$array = array(0,$idteam1,$idteam2,$idteam3,$idteam4,$idteam5,$idteam6,$idteam7,$idteam8,$idteam9,$idteam10);

$numberOfTeams = $_POST['numberOfTeams'];
   echo 'druzyn: <b>'.$numberOfTeams.'</b><hr />';

   $pairs = array(($numberOfTeams-1), ($numberOfTeams/2));
   echo 'kolejek: <b>'.$pairs[0].'</b><br />';
   echo 'meczow w kolejce: <b>'.$pairs[1].'</b><hr />';

   for($i=1; $i<$numberOfTeams; $i++) {
       if($i <= $numberOfTeams/2) {
           $pair[2*$i-2][0][0] = $i;
           $pair[2*$i-2][0][1] = $numberOfTeams;
        $w = 2*$i-2;
     } else {
       $pair[2*$i-1-$numberOfTeams][0][1] = $i;
           $pair[2*$i-1-$numberOfTeams][0][0] = $numberOfTeams;
        $w = 2*$i-1-$numberOfTeams;
     }

     $j = $i+1;

     for($k=1; $k<=$numberOfTeams-2; $k++) {
       if($j >= $numberOfTeams) {
           $j = 1;
       }
        if($k <= ($numberOfTeams-2)/2) {
           $pair[$w][$k][0] = $j;
        } else {
           $pair[$w][$numberOfTeams-1-$k][1] = $j;
        }
        $j++;
     }
  }

  for($i=1; $i<$numberOfTeams; $i++) {
   //wstaw echo jesli chcesz podział na kolejki
   for($j=0; $j<$numberOfTeams/2; $j++) {
       $sql = "(null,". $array[$pair[$i-1][$j][0]].",".$array[$pair[$i-1][$j][1]].","."null,"."null,"."3,"."'2020-06-28',"."5,".$i. "),<br>";
       echo $sql;

   }
   echo "<br />";
  }

  echo '<hr /><pre>';
  var_dump($array);
  echo '</pre>';


}

        