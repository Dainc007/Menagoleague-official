<?php
include"functions.php";
include"fixturesController.php";



if(isset($_GET['set_score']))
{ 
    $idteams = $_SESSION['idteams'];
    $gamertag = $_SESSION['gamertag'];
    $fixturesController = new FixturesController();
    $getUserFixtures = $fixturesController->getUserFixtures($idteams);

    $selectTeamNames = $fixturesController->getTeamNames();
    $teamname = array_column($selectTeamNames, 'teamname');

    if(empty($getUserFixtures))
    {
        echo 'W Twoim kalendarzu nie ma nadchodzących spotkań';
        exit();
    } else 
       echo ' <a href="https://gamerdvr.com/gamer/'.$gamertag.'/videos" target="_blank">Twoje raporty xboxdvr.com</a>';
    {  
         echo '<table><tr><th>kolejka</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>';

        foreach($getUserFixtures as $match)
        {
            if($match['g_1'] !== NULL)
            {   $raport = $match['raport'];
                echo "<tr><td> ".$match['kolejka']." </td><td>".$teamname[$match['idteam1']-1]."</td><td>".$match['g_1']." : </td><td>".$match['g_2']."</td>
                <td>".$teamname[$match['idteam2']-1]."</td><td>".$match['data']."</td><td>".'<a href="'.$raport.'">'.$raport.'</a>';
                
            }
            else { $idteam1 = $match['idteam1']; $idteam2 = $match['idteam2']; $date = $match['data']; $raport = $match['raport'];
                    $confirmMessage = "'Upewnij się, że podałeś poprawny wynik i wszystkie pola zostały uzupełnione'";
                echo '<form method="POST" action="setScore">
                <input type="number" value="'.$idteam1.'" name="idteam1" hidden>
                <input type="number" value="'.$idteam2.'" name="idteam2" hidden>
                <input type="date" value="'.$date.'" name="data" hidden>  ';
                echo "<tr><td> ".$match['kolejka']." </td><td>".$teamname[$match['idteam1']-1].
                '</td><td><input type="number" name="g1" placeholder="Gole Gospodarzy" required></td> 
                <td> <input type="number" name="g2" placeholder="Gole Gości" required></td>
                <td>'.$teamname[$match['idteam2']-1]."</td><td>".$match['data']."</td>";
                echo '
                <td><input type="text" name="raport" placeholder="link do raportu z meczu" ></td>
                <td><input type="submit" name="report_score" value="Ustaw wynik" onclick="return confirm('.$confirmMessage.')" ></td>
                </tr> 
                </form>';
           
        }
    }
        echo '</table>';
        exit();
       
    }

}



if(isset($_GET['reschedule']))
{   $data = date(" Y-m-d ");
    $idteams = $_SESSION['idteams'];
    $fixturesController = new FixturesController();
    $getUserNextGame = $fixturesController->getUserNextGame($data, $idteams);

    $selectTeamNames = $fixturesController->getTeamNames();
    $teamname = array_column($selectTeamNames, 'teamname');

    if(empty($getUserNextGame))
    {
        echo 'Wystąpił Problem podczas próby przełożenia meczu';
        exit();
    } else 
    {   
        foreach($getUserNextGame as $match)
        { $idgame = $match['idgame'];
            $old_date = $match['data'];
           echo "kolejka ".$match['kolejka']." ".$teamname[$match['idteam1']-1]." v".$match['g_1']."s".$match['g_2']." ".$teamname[$match['idteam2']-1]." ".$match['data'].'
           <form action="reschedule.php" method="POST">
           <input type="submit" name="reschedule_game" value="Zaproponuj inny Termin">
           <input type="number" name="idgame" value='.$idgame.' hidden>
           <input type="date" name="new_date" placeholder="RRRR-MM-DD" require min="2020-08-19" max="2020-08-26">
           <input type="date" name="old_date" value='.$old_date.' hidden>
            </form> ';
        }
        
         
         exit();
        
    }
}


if(isset($_GET['idGroup']))
{
    $idGroup = $_GET['idGroup'];   
    $fixturesController = new FixturesController();
    $selectFixturesByGroup = $fixturesController->getGroupFixtures($idGroup);
    if (empty($selectFixturesByGroup)) 
    {
    echo' Wystąpił problem podczas wyświetlania terminarza';
    } else
     {  
        $selectTeamNames = $fixturesController->getTeamNames();
        $teamname = array_column($selectTeamNames, 'teamname');
        echo '<table><tr><th>kolejka</th><th></th><th></th><th></th><th></th><th></th></tr>';
        foreach ($selectFixturesByGroup as $match)
        {
        echo "<tr><td> ".$match['kolejka']." </td><td>".$teamname[$match['idteam1']-1]."</td><td>".$match['g_1']." : </td><td>".$match['g_2']."</td><td>".$teamname[$match['idteam2']-1]."</td><td>".$match['data']."</td></tr>";
        }
        echo '</table>';
    }

} else 
{ 
    echo '<h5>Liga Mistrzów </h5>
    <form method="GET" action="fixturesView.php">
    <input type="radio" name="idGroup" value="1">A
    <input type="radio" name="idGroup" value="2">B
    <input type="radio" name="idGroup" value="3">C
    <input type="radio" name="idGroup" value="4">D <br><br> 
    <input type="submit" value="Pokaż"> </form> ';
}
  
if(isset($_GET['idLeague']))
{
    $idLeague = $_GET['idLeague'];   
    
    
    $fixturesController = new FixturesController();
    $selectFixturesByLeague = $fixturesController->getLeagueFixtures($idLeague);
    
    if (empty($selectFixturesByLeague)) 
    {
    echo' Wystąpił problem podczas wyświetlania terminarza';
    } else
     {  
        $selectTeamNames = $fixturesController->getTeamNames();
        
        $teamname = array_column($selectTeamNames, 'teamname');
        
        echo '<table><tr><th>Kolejka</th><th>Gospodarz</th><th> </th><th> </th><th>Gość</th><th>Data<th></tr>';
        foreach ($selectFixturesByLeague as $match)
        {
        echo "<tr><td> ".$match['kolejka']." </td><td>".$teamname[$match['idteam1']-1]."</td><td>".$match['g_1']." : </td><td>".$match['g_2']."</td><td>".$teamname[$match['idteam2']-1]."</td><td>".$match['data']."</td></tr>";
        }
        echo '</table>';
    }
    

} else 
{
    echo '<form method="GET" action="fixturesView.php">
    <input type="radio" name="idLeague" value="1">Premier league
    <input type="radio" name="idLeague" value="2">La Liga
    <input type="radio" name="idLeague" value="3">Serie A
    <input type="radio" name="idLeague" value="4">Ekstraklasa
    <input type="radio" name="idLeague" value="5">Fortuna 1 liga <br><br> 
    <input type="submit" value="Pokaż"> </form> ';
}


