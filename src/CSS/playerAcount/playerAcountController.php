<?php
require_once"../DatabaseConnection.php";
session_start();

class PlayerAcountController {
   
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


}