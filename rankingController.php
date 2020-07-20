<?php
require_once"DatabaseConnection.php";

class RankingController
{
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

    public function getTeamsByPoints()
    {
        $selectTeamsByPoints = $this->connection->prepare('SELECT spot from ranking ORDER BY pkt DESC');
        $selectTeamsByPoints->execute();
        return $selectTeamsByPoints->fetchAll();
    }

    public function getTeamsByID()
    {
        $getTeamsByID = $this->connection->prepare('SELECT idteams from ranking  ORDER BY pkt DESC ');
        $getTeamsByID->execute();
        return $getTeamsByID->fetchAll();
    }


    public function showRanking()
    {
        $showRanking = $this->connection->prepare('SELECT gamertag,teamname,pkt,spot FROM uzytkownicy JOIN teams
        ON uzytkownicy.idteams=teams.idteams
        JOIN ranking on uzytkownicy.idteams=ranking.idteams
        ORDER By ranking.pkt DESC, ranking.spot ASC');
        $showRanking->execute();
        return $showRanking->fetchAll();
    }

    public function setTeamsSpots($teamSpot)
    {
        for ($a = 1; $a < count($teamSpot); $a++) {
            $setTeamsSpots = $this->connection->prepare('UPDATE ranking2 SET spot=' . $a . ' WHERE ' . $teamSpot[$a - 1]);
            $setTeamsSpots->execute();
        }


    }

    public function updateRanking($teamID)
    {

        for ($i = 1; $i < count($teamID); $i++) {
            
            $updateRanking = $this->connection->prepare('UPDATE ranking SET spot=' . $i . ' Where idteams=' . $teamID[$i - 1]);
            $updateRanking->execute();
        }

    }


}

