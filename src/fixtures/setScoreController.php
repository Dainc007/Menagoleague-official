<?php
  require_once"../DatabaseConnection.php";
  session_start();

  class SetScoreController
  {
      private $connection;

      public function __construct()
      {
          $database = new DatabaseConnection();
          $this->connection = $database->getNewConnection();
      }


      public function setGameScore($g1, $g2, $raport, $idteam1, $date, $idteam2)
        { 
            $setGameScore = $this->connection->prepare('UPDATE summerCupFixtures SET g_1='.$g1.', g_2='.$g2.', raport="'.$raport.'" WHERE idteam1='.$idteam1.' AND data="'.$date.'" AND idteam2='.$idteam2); 
            $setGameScore->execute();
            
            
        }


        public function setHostsGameResult($g1, $g2, $idteam1)
        { 
            $setHostsGameResult = $this->connection->prepare('UPDATE summerCupTable SET scored=scored+'.$g1.', lost=lost+'.$g2.', GP=GP+1, bilans=scored-lost WHERE idteams='.$idteam1); 
            $setHostsGameResult->execute();
            
            
        }

        public function setVisitorsGameResult($g2, $g1, $idteam2)
        { 
            $setVisitorsGameResult = $this->connection->prepare('UPDATE summerCupTable SET scored=scored+'.$g2.', lost=lost+'.$g1.', GP=GP+1, bilans=scored-lost WHERE idteams='.$idteam2); 
            $setVisitorsGameResult->execute();
            
            
        }

         public function setWinner($winner)
        { 
            $setWinner = $this->connection->prepare('UPDATE summerCupTable SET pkt=pkt+3, W=W+1 WHERE idteams='.$winner); 
            $setWinner->execute();

        }

         public function setLooser($looser)
        { 
            $setLooser = $this->connection->prepare('UPDATE summerCupTable SET L=L+1 WHERE idteams='.$looser); 
            $setLooser->execute();
              
        }

        public function setDraw($idteam1,$idteam2)
        { 
            $setDraw = $this->connection->prepare('UPDATE summerCupTable SET D=D+1, pkt=pkt+1 WHERE idteams='.$idteam1.' OR idteams='.$idteam2); 
            $setDraw->execute();
              
        }


  }