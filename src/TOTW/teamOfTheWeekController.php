<?php
require_once"../DatabaseConnection.php";

class TOTWController
{
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

    public function getTwoBestStrikers($lig, $kol)
    { 
        $getTwoBestStrikers = $this->connection->prepare('SELECT AVG(ocena), playername, teamname,pozycja FROM Stats
    JOIN Terminarz ON Stats.idgame=Terminarz.idgame
    JOIN players ON Stats.idplayers=players.idplayers
    JOIN teams ON players.idteams=teams.idteams
    WHERE players.pozycja Like "	ST%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	CF%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	RW%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	LW%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    GROUP By Stats.idplayers
    ORDER BY AVG(ocena) DESC LIMIT 2');

        $getTwoBestStrikers->execute();
        return $getTwoBestStrikers->fetchAll();
    } //OR "	CF%" OR "	LW%" OR "	RW%"
    
    public function getFourBestMiddle($lig, $kol)
    { 
        $getFourBestMiddle = $this->connection->prepare('SELECT AVG(ocena), playername, teamname,pozycja FROM Stats
    JOIN Terminarz ON Stats.idgame=Terminarz.idgame
    JOIN players ON Stats.idplayers=players.idplayers
    JOIN teams ON players.idteams=teams.idteams
    WHERE players.pozycja Like "	CM%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	CAM%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	CDM%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	LM%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	RM%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'

    GROUP By Stats.idplayers
    ORDER BY AVG(ocena) DESC LIMIT 4');

        $getFourBestMiddle->execute();
        return $getFourBestMiddle->fetchAll();
    }

    public function getFourBestDefenders($lig, $kol)
    { 
        $getFourBestDefenders = $this->connection->prepare('SELECT AVG(ocena), playername, teamname,pozycja FROM Stats
    JOIN Terminarz ON Stats.idgame=Terminarz.idgame
    JOIN players ON Stats.idplayers=players.idplayers
    JOIN teams ON players.idteams=teams.idteams
    WHERE players.pozycja Like "	CB%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	LB%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	RB%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	RWB%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    OR players.pozycja Like "	LWB%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    GROUP By Stats.idplayers
    ORDER BY AVG(ocena) DESC LIMIT 4');
        

        $getFourBestDefenders->execute();
        return $getFourBestDefenders->fetchAll();
    }

    public function getBestGk($lig, $kol)
    { 
        $getBestGk = $this->connection->prepare('SELECT AVG(ocena), playername, teamname,pozycja FROM Stats
    JOIN Terminarz ON Stats.idgame=Terminarz.idgame
    JOIN players ON Stats.idplayers=players.idplayers
    JOIN teams ON players.idteams=teams.idteams
    WHERE players.pozycja LIKE "%GK%" AND Terminarz.Lig='.$lig.' AND Terminarz.kolejka='.$kol.'
    GROUP By Stats.idplayers
    ORDER BY AVG(ocena) DESC LIMIT 1');

        $getBestGk->execute();
        return $getBestGk->fetchAll();
    }

}