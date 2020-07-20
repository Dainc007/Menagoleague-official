<?php
  require_once"connectPDO.php";
  session_start();
try{

    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'Not Connected '.$ex->getMessage();
}
$idteams = $_SESSION['idteams'];
$stmt = $con->prepare('SELECT * from players where idteams=0 ORDER BY playername ASC');
$stmt->execute();
$players = $stmt->fetchAll();

if(isset($_POST['sign']))
{
    $idplayers = $_POST['idplayers'];
    $stmt2 = $con->prepare("UPDATE players SET idteams=$idteams WHERE idplayers=$idplayers AND idteams=0");
    $stmt2->execute();
    header('Location: ok.php');
} 