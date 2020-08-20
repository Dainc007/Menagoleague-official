<?php
  require_once"../DatabaseConnection.php";
  session_start();

  class RescheduleController
  {
      private $connection;

      public function __construct()
      {
          $database = new DatabaseConnection();
          $this->connection = $database->getNewConnection();
      }


      public function rescheduleUserGame($new_date, $old_date, $idgame)
        { 
            $rescheduleUserGame = $this->connection->prepare('UPDATE summerCupFixtures SET data="'.$new_date.'" WHERE data="'.$old_date.'" AND idgame='.$idgame); 
            $rescheduleUserGame->execute();
            
        }


  }