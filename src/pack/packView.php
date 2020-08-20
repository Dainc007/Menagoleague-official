<?php
include"packController.php";
include"checkUser.php"; //sprawdź dokładnie ściezke! <-------------

$checkUser = new CheckUser();
$setHedders = $checkUser->setHedders();
$checkIfUserIsLogged = $checkUser->checkIfUserIsLogged();
$checkIfMoneyIsSet = $checkUser->checkIfMoneyIsSet();

if(isset($_POST['submit'])){
    $packController = new PackController();
    $getPlayersWithoutClub = $packController->getPlayersWithoutClub();

    if(empty($getPlayersWithoutClub))
    {
    echo 'Paczki zostały wyprzedane!';
    } else {
    $idteams = $_SESSION['idteams'];
    $price = 15000000;
    $money = $_SESSION['money'];
    $comment = "Kupno Paczki o numerze $rand";

    $rand = rand(0,count($getPlayersWithoutClub));
    $int = $getPlayersWithoutClub[$rand]['idplayers'];
    

    if($money<$price) {
        echo 'Nie stać Cię na zakup paczki!';
        exit();
        } else {
            
            $takeMoneyFromUser = $packController->takeMoneyFromUser($price, $idteams);
            $updatePlayerClub = $packController->updatePlayerClub($idteams, $int);
            header('Location: ../ok.php');
            
        }

    }

}

if(isset($_POST['submit2'])){
    $packController = new PackController();
    $getPlayersFromTop = $packController->getPlayersFromTop();

    if(empty($getPlayersFromTop))
    {
    echo 'Paczki zostały wyprzedane!';
    } else {
    $idteams = $_SESSION['idteams'];
    $price = 28000000;
    $money = $_SESSION['money'];
    $comment = "Kupno Paczki o numerze $rand";

    $rand = rand(0,count($getPlayersFromTop));
    $int = $getPlayersFromTop[$rand]['idplayers'];
    

    if($money<$price) {
        echo 'Nie stać Cię na zakup paczki!';
        exit();
        } else {
            
            $takeMoneyFromUser = $packController->takeMoneyFromUser($price, $idteams);
            $updatePlayerClub = $packController->updatePlayerClub($idteams, $int);
            header('Location: ../ok.php');
            
        }

    }

}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>

<body>
  <form method="POST">
  <input type="submit"  name="submit" value="Kup Standardową Paczkę" onclick="return confirm('Czy na pewno? Decyzji nie można cofnąć');"> Paczka Standard(cena 15 milionów, ovr 83-87)
  Zawiera takich zawodników jak Cavani, Coutinho, Trapp czy Matuidi (około 20 piłkarzy) 
  </form> <br>
  <form method="POST">
  <input type="submit"  name="submit2" value="Kup Paczkę Top50" onclick="return confirm('Czy na pewno? Decyzji nie można cofnąć');"> Paczka Top50 Zawiera zawodników z ovr 88 lub wyższym. cena 28 milionów. Paczka może zawierać około 42 piłkarzy, w tym Messi, Ronaldo, Van Dijk, Alison lub Oblak
  </form> <br>
 

</body>
    </html>

























