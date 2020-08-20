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
$stmt = $con->prepare("SELECT * from finances where idteams=$idteams ORDER BY data DESC");
$stmt->execute();
$finances = $stmt->fetchAll();
