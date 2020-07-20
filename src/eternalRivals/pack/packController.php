<?php

require_once"../DatabaseConnection.php";
session_start();

class PackController {

    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

    public function getPlayersWithoutClub()
    {
        $getPlayersWithoutClub = $this->connection->prepare('SELECT * FROM players WHERE skill BETWEEN 82 AND 87 AND idteams is null');
        $getPlayersWithoutClub->execute();
        return $getPlayersWithoutClub->fetchAll();
    }

    public function getPlayersFromTop()
    {
        $getPlayersFromTop = $this->connection->prepare('SELECT * FROM players WHERE skill>87 AND idteams is null');
        $getPlayersFromTop->execute();
        return $getPlayersFromTop->fetchAll();
    }

    public function updatePlayerClub($idteams, $int)
    {
        $updatePlayerClub = $this->connection->prepare('UPDATE players SET idteams='.$idteams.' WHERE idteams is null AND idplayers='.$int);
        $updatePlayerClub->execute();
        
    }

    public function updateUserFinances($idteams,$comment, $money, $price)
    {
       $updateUserFinances = $this->connection->prepare('INSERT INTO finances VALUES (null, $idteams, "$comment", $money, $cena, $money-$cena, DEFAULT)');
       $updateUserFinances->execute();
        
    }

    public function takeMoneyFromUser($price, $idteams)
    {
        $takeMoneyFromUser = $this->connection->prepare('UPDATE teams SET money=money-'.$price.' where idteams='.$idteams);
        $takeMoneyFromUser->execute();
        
    }

}



