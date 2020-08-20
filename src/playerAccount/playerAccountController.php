<?php
require_once"../DatabaseConnection.php";
session_start();

class PlayerAccountController {
   
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

    public function getUserRivals($idteams)
    {
        $getUserRivals = $this->connection->prepare('SELECT * from eternal_rivals where idteams='.$idteams); 
        $getUserRivals->execute();
        return $getUserRivals->fetchAll();
    }

     public function getLastTransfers()
    {
        $getLastTransfers = $this->connection->prepare('SELECT * FROM oferty
            JOIN players
            ON oferty.idplayers=players.idplayers
            where status=1
            ORDER BY oferty.idoferty DESC
            LIMIT 10'); 
        $getLastTransfers->execute();
        return $getLastTransfers->fetchAll();
    }

    public function getUserLeague($idteams)
    {
        $getUserLeague = $this->connection->prepare('SELECT lig FROM summerCupTable WHERE idteams='.$idteams); 
        $getUserLeague->execute();
        return $getUserLeague->fetchAll();
    }

    public function getUserLeagueTable($lig)
    {
        $getUserLeagueTable = $this->connection->prepare('SELECT teamname, summerCupTable.idteams, pkt, GP FROM summerCupTable JOIN teams ON summerCupTable.idteams=teams.idteams WHERE lig='.$lig.' ORDER by pkt DESC, bilans DESC, scored DESC'); 
        $getUserLeagueTable->execute();
        return $getUserLeagueTable->fetchAll();
    }

    public function getUserLeagueTopScorer($lig)
    {
        $getUserLeagueTopScorer = $this->connection->prepare('SELECT SUM(gole) AS gole, playername,teamname, teams.idteams FROM Stats
                          JOIN Terminarz
                          ON Stats.idgame=Terminarz.idgame
                          JOIN players
                          ON Stats.idplayers=players.idplayers
                          JOIN teams
                          ON players.idteams=teams.idteams
                          Where lig='.$lig.' AND gole>0
                          Group By Stats.idplayers
                          Order by gole DESC
                          LIMIT 20'); 
        $getUserLeagueTopScorer->execute();
        return $getUserLeagueTopScorer->fetchAll();
    }

    public function getUserLeagueTopAsistants($lig)
    {
        $getUserLeagueTopAsistants = $this->connection->prepare('SELECT SUM(asysty), playername,teamname, teams.idteams FROM Stats
                          JOIN Terminarz
                          ON Stats.idgame=Terminarz.idgame
                          JOIN players
                          ON Stats.idplayers=players.idplayers
                          JOIN teams
                          ON players.idteams=teams.idteams
                          Where lig='.$lig.'
                          Group By Stats.idplayers
                          Order by SUM(asysty) DESC'); 
        $getUserLeagueTopAsistants->execute();
        return $getUserLeagueTopAsistants->fetchAll();
    }

    public function getUserNextGame($idteams)
    {
        $getUserNextGame = $this->connection->prepare('select * from summerCupFixtures
        WHERE idteam1='.$idteams.' AND g_1 is null
        OR idteam2='.$idteams.' AND g_1 is null
        ORDER BY data ASC
        LIMIT 1'); 
        $getUserNextGame->execute();
        return $getUserNextGame->fetchAll();
    }


}


