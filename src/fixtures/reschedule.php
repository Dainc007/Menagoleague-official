<?php
include"rescheduleController.php";

if(isset($_POST['reschedule_game']))
{
    $new_date = $_POST['new_date'];
    $date = date("Y-m-d");
    $idgame = $_POST['idgame'];
    $old_date = $_POST['old_date'];

    if($date>$old_date)
    {
        echo 'Nie mozesz zmienic daty meczu, którego termin już upłynął';
        exit();
    }

    if($date>=$new_date)
    {
        echo 'Nie mozesz zmienic daty meczu na termin z przeszłości, bądź na dzisiaj';
        exit();
    }

     //if($old_date>$new_date)
    //{
        //echo 'Nie mozesz skrócić terminu meczu!';
        //exit();
    //}

    if($old_date==$new_date)
    {
        echo 'Ten termin meczu już obowiązuje. Nie musisz go przekładać';
        exit();
    }

    $rescheduleController = new RescheduleController();
    $rescheduleUserGame = $rescheduleController->rescheduleUserGame($new_date,$old_date,$idgame);
    header('Location: redirect.php');

    









}
