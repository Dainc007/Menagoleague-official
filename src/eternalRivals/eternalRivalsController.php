<?php
require_once"../DatabaseConnection.php";

class EternalRivalsController 
{
    private $connection;

    public function __construct()
    {
        $database = new DatabaseConnection();
        $this->connection = $database->getNewConnection();
    }

    public funtion getUserEternalRivals($idteams)
    {
        $getUserEternalRivals = $this->connection->prepare('SELECT * FROM eternal_rivals WHERE status is not null AND idteams='.$idteams);
        $getUserEternalRivals->execute();
        return $getUserEternalRivals->fetchAll();
    }
}