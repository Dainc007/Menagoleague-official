<?php

class CheckUser {


    public function setHedders()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache"); //HTTP 1.0
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    }

    public function checkIfUserIsLogged()
    {

        if (!isset($_SESSION['zalogowany']))
        {
        header('Location: index.php');
        exit();
        }
    }

    public function checkIfMoneyIsSet()
    {
        if (!isset($_SESSION['money']))
        {
        header('Location: ../kontogracza.php');
        exit();
        }
    }

    function checkIfAdmin()
    {
        if ($_SESSION['idteams'] !=1)
        {  
        echo "Nie masz uprawnień by tu być!";
        exit();
        }
    }

    function checkIfUserHasTeam($idteams)
    {   
        if ($_SESSION['idteams'] ==0) {
        echo "Nie masz klubu<br>";
        echo '<a href="http://menagoleague.pl/kontogracza.php">Powrót!</a>';
        echo "Nie masz klubu<br>";
        exit();
        }
        
    }

}

