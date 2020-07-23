<?php
  require_once"../connectPDO.php";
  session_start();
try{
    
    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'Not Connected '.$ex->getMessage();
}
$idteams = $_SESSION['idteams'];
$stmt = $con->prepare("SELECT * from mailbox where FromID=$idteams");
$stmt->execute();
$sentMessages = $stmt->fetchAll();

$stmt2 = $con->prepare("SELECT * from mailbox JOIN teams ON mailbox.fromID=teams.idteams where ToID=$idteams AND status=0 ORDER BY data DESC");
$stmt2->execute();
$receivedMessages = $stmt2->fetchAll();

$stmt3 = $con->prepare("SELECT idteams,teamname from teams");
$stmt3->execute();
$getRecipients = $stmt3->fetchAll();

if(isset($_POST['markAsRead']))
{
    $markAsRead = $con->prepare("UPDATE mailbox SET status=1 WHERE ToID=$idteams");
    $markAsRead->execute();
    header('Location: ok.php');
    
}


