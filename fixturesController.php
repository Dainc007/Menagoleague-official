<?php
  require_once"DatabaseConnection.php";
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
        $selectFixturesByLeague = $this->connection->prepare('SELECT * from Terminarz where Lig='.$idLeague); 
        $selectFixturesByLeague->execute();
        return $selectFixturesByLeague->fetchAll();
    }

    public function getTeamNames()
    {
         $selectTeamNames = $this->connection->prepare('SELECT teamname FROM teams');
        $selectTeamNames->execute();
        return $selectTeamNames->fetchAll();
    }
   

  }