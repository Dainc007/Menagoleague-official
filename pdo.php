<?php
require_once"connectPDO.php";
try{
    
    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'Not Connected '.$ex->getMessage();
}

$stmt = $con->prepare("SELECT * FROM teams");
$stmt->execute();
$users = $stmt->fetchAll();



?>
