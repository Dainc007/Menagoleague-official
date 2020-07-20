<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once"../connect.php";
require_once"../connectPDO.php";
session_start();

include"../functions.php";
checkIfAdmin();

try{

    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'Not Connected '.$ex->getMessage();
}
if(isset($_POST['add']))
{
  $numberOfTeams = $_POST['numberOfTeams'];
  $value = $_POST['value'];
  $comment = $_POST['comment'];
  for ($i = 1; $i<$numberOfTeams; $i++) {
    $stmt = $con->prepare("INSERT INTO finances VALUES(null,$i,'$comment',0,$value,0,DEFAULT)");
    $stmt->execute();
  }
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="" type="text/css">
  <title>Panel Finansowy</title>
</head>
  <body>
    <br>
    <h4> Dodaj wpis do finansów</h4>
<form action="adminFinances.php" method="POST">
  <input type="number" name="numberOfTeams" required> Liczba Drużyn <br>
  <input type="number" name="value"> Kwota <br>
  <input type="text" name="comment"required> Komentarz <br>
  <input type="submit" name="add" value="Dodaj">
</form>

</body>
</html>
