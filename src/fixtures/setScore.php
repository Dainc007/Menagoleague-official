<?php
include"setScoreController.php";


if(isset($_POST['report_score']))
{

    $g1 = $_POST['g1'];
    $g2 = $_POST['g2'];
    $idteam1 = $_POST['idteam1'];
    $idteam2 =  $_POST['idteam2'];
    $date = $_POST['data'];
    $raport = $_POST['raport'];



    $setScoreController = new SetScoreController();
    $setGameScore = $setScoreController->setGameScore($g1, $g2, $raport, $idteam1, $date, $idteam2);

    $setHostsGameResult = $setScoreController->setHostsGameResult($g1, $g2, $idteam1);
    $setVisitorsGameResult = $setScoreController->setVisitorsGameResult($g2, $g1, $idteam2);

    if($g1==$g2)
    {
       $setDraw = $setScoreController->setDraw($idteam1,$idteam2);
       header('Location: redirect');
       exit(); 
    } else
     {
        if($g1>$g2)
        {
        $winner = $idteam1; $looser = $idteam2;
        }

        if($g1<$g2)
        {
        $winner = $idteam2; $looser = $idteam1;
        }

        $setWinner = $setScoreController->setWinner($winner);
        $setLooser = $setScoreController->setLooser($looser);

    }

   

   


    header('Location: redirect');
    
    
}