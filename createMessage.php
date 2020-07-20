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
$recipient = $_POST['recipient'];
$topic = $_POST['topic'];
$message = $_POST['message'];
$createMessage = $con->prepare("INSERT INTO mailbox VALUES (null, $idteams, $recipient, '$topic', '$message', DEFAULT, DEFAULT)");
$createMessage->execute();
header('Location: ok.php');
