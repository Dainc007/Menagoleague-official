<?php
include"functions.php";
include"fixturesController.php";
     

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

