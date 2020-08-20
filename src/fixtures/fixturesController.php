<?php
  require_once"../DatabaseConnection.php";
  session_start();

  class  FixturesController
  {
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }
    
    public function getGroupFixtures($idGroup)
    { 
        $selectFixturesByGroup = $this->connection->prepare('SELECT * from TerminarzLM where Lig='.$idGroup); 
        $selectFixturesByGroup->execute();
        return $selectFixturesByGroup->fetchAll();
    }

    public function getLeagueFixtures($idLeague)
    { 
        $selectFixturesByLeague = $this->connection->prepare('SELECT * from summerCupFixtures where Lig='.$idLeague); 
        $selectFixturesByLeague->execute();
        return $selectFixturesByLeague->fetchAll();
    }

    public function getTeamNames()
    {
         $selectTeamNames = $this->connection->prepare('SELECT teamname FROM teams');
        $selectTeamNames->execute();
        return $selectTeamNames->fetchAll();
    }

    public function getUserFixtures($idteams)
    {
        $getUserFixtures = $this->connection->prepare('SELECT * FROM `summerCupFixtures` WHERE idteam1='.$idteams.' OR idteam2='.$idteams.' ORDER BY data ASC');
        $getUserFixtures->execute();
        return $getUserFixtures->fetchAll();
    }

    public function getUserNextGame($data, $idteams)
    {
        $getUserNextGame = $this->connection->prepare('SELECT * FROM `summerCupFixtures` WHERE data >= '.$data.' AND idteam1='.$idteams.' AND g_1 is null OR data >= '.$data.' AND idteam2='.$idteams.' AND g_1 is null  ORDER BY data ASC LIMIT 1');
        $getUserNextGame->execute();
        return $getUserNextGame->fetchAll();
    }
   

  }

  