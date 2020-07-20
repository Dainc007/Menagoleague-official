<?php
require_once"../DatabaseConnection.php";
session_start();
class MyTeamController
{
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

     public function getAllPlayersFromUserTeam($idteams)
    {   
        $idteams = $_SESSION['idteams'];
        $getAllPlayersFromUserTeam = $this->connection->prepare('
        SELECT playername, players.idplayers, pozycja, skill,pensja, AVG(ocena) as ocena,AVG(gole),AVG(asysty), SUM(gole) as gole,
         SUM(asysty) as asysty,SUM(zolte) as z,SUM(czerwone) as c FROM players 
        LEFT JOIN Stats
        ON players.idplayers=Stats.idplayers
        WHERE idteams='.$idteams.'
        GROUP BY players.idplayers');
        $getAllPlayersFromUserTeam->execute();
        return $getAllPlayersFromUserTeam->fetchAll();
    }

    public function getAllPlayersStats($idteams)
    {   
        $idteams = $_SESSION['idteams'];
        $getAllPlayersStats = $this->connection->prepare('
        SELECT playername, players.idplayers, pozycja, skill,pensja, AVG(ocena) as ocena,AVG(gole),AVG(asysty), SUM(gole) as gole,
         SUM(asysty) as asysty,SUM(zolte) as z,SUM(czerwone) as c FROM players 
        LEFT JOIN FullStats
        ON players.idplayers=FullStats.idplayers
        WHERE idteams='.$idteams.'
        GROUP BY players.idplayers');
        $getAllPlayersStats->execute();
        return $getAllPlayersStats->fetchAll();
    }

    public function firePlayer($idfire)
    {   
        
        $idfire = $_POST['idfire'];
        $firePlayer = $this->connection->prepare('UPDATE players SET idteams=0 WHERE idplayers='.$idfire);
        $firePlayer->execute();
        
    }

}



