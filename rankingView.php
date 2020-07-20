<link rel="stylesheet" href="/CSS/myTeam.css" type="text/css">
<?php
include"functions.php";
include"rankingController.php";

$rankingController = new rankingController();
$showRanking = $rankingController->showRanking();
 echo ' Ranking w Budowie';
 echo '<table><tr><th>Miejsce</th><th>Drużyna</th><th>GamerTag</th><th>Punkty</th></tr>';
 $i=1;
foreach ($showRanking as $team) 
{
echo "<tr><td>".$i++."</td><td> ".$team['teamname']."</td><td> ".$team['gamertag']."</td><td> ".$team['pkt']."</td></tr>";
}
echo '<table>';




