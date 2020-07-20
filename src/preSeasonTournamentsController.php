<?php
  require_once"connectPDO.php";
  session_start();
try{

    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo 'Not Connected '.$ex->getMessage();
}
$money = $_SESSION['money'];
$idteams = $_SESSION['idteams'];
$stmt = $con->prepare("SELECT * from tournaments JOIN teams ON tournaments.creator=teams.idteams");
$stmt->execute();
$getAllTournaments = $stmt->fetchAll();

if(isset($_POST['createTournament']))
{ $comment = $_POST['comment'];
 $fee = $_POST['fee'];
  $status = $_POST['status'];
   $password = $_POST['password'];
    $date = $_POST['date'];
    if ($money>$fee) {
    $createTournament = $con->prepare("INSERT INTO tournaments VALUES (null,$idteams,0,0,0,$fee,$fee,$status,$password,'$date', '$comment')");
  $createTournament->execute();
  $updateFinances = $con->prepare("INSERT INTO finances VALUES (null,$idteams,'Turniejowe wpisowe',$money,$fee,$money-$fee,DEFAULT)");
  $updateFinances->execute();
  $payFee = $con->prepare("UPDATE teams SET money=money-$fee WHERE idteams=$idteams");
  $payFee->execute();
  
  header('Location: ok.php');
    } else {
        echo 'Nie stać Cię na stworzenie turnieju z tak wysokim wpisowym!';
        exit();
     }
}

if(isset($_POST['joinTournament']))
{   $id = $_POST['id'];
    $password = $_POST['password'];
    $stmt = $con->prepare("SELECT * FROM tournaments WHERE id=$id");
    $stmt->execute();
    $checkMembers = $stmt->fetchAll();
    foreach ($checkMembers as $member)
    {
     $member2 = $member['member2'];  $member3 = $member['member3'];  $member4 = $member['member4']; $fee = $member['fee'];  
    }

if($money>$fee) {
    if($member2 == 0) {
        $joinTournament = $con->prepare("UPDATE tournaments SET member2=$idteams WHERE id=$id ");
        $joinTournament->execute();
        $updateFinances = $con->prepare("INSERT INTO finances VALUES (null,$idteams, 'Turniejowe wpisowe',$money,$fee,$money-$fee,DEFAULT)");
        $updateFinances->execute();
        $payFee = $con->prepare("UPDATE teams  SET money=money-$fee WHERE idteams=$idteams");
        $payFee->execute();
        $updatePrize = $con->prepare("UPDATE tournaments  SET prize=prize+$fee WHERE id=$id");
        $updatePrize->execute();
        header('Location: ok.php');
        exit();
    } 
        if($member3 == 0) {
        $joinTournament = $con->prepare("UPDATE tournaments SET member3=$idteams WHERE id=$id ");
        $joinTournament->execute();
        $updateFinances = $con->prepare("INSERT INTO finances VALUES (null,$idteams, 'Turniejowe wpisowe',$money,$fee,$money-$fee,DEFAULT)");
        $updateFinances->execute();
        $payFee = $con->prepare("UPDATE teams  SET money=money-$fee WHERE idteams=$idteams");
        $payFee->execute();
        $updatePrize = $con->prepare("UPDATE tournaments  SET prize=prize+$fee WHERE id=$id");
        $updatePrize->execute();
        header('Location: ok.php');
        exit();
    }
     if($member4 == 0) {
        $joinTournament = $con->prepare("UPDATE tournaments SET member4=$idteams WHERE id=$id ");
        $joinTournament->execute();
        $updateFinances = $con->prepare("INSERT INTO finances VALUES (null,$idteams, 'Turniejowe wpisowe',$money,$fee,$money-$fee,DEFAULT)");
        $updateFinances->execute();
        $payFee = $con->prepare("UPDATE teams SET money=money-$fee WHERE idteams=$idteams");
        $payFee->execute();
        $updatePrize = $con->prepare("UPDATE tournaments  SET prize=prize+$fee WHERE id=$id");
        $updatePrize->execute();
        header('Location: ok.php');
        exit();
    } else {
       
        echo " <a href='preSeasonTournamentsView.php'>Powrót!</a> <br>";
         echo 'Turniej jest pełen!';
    }

 } else {
     echo 'Nie stać Cię na pokrycie wpisowego!';
     exit();
  }


    

}

