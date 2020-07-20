

<?php
include"myTeamController.php";
include"checkUser.php";

$checkUser = new CheckUser();
$setHedders = $checkUser->setHedders();
$checkIfUserIsLogged = $checkUser->checkIfUserIsLogged();
$checkifMoneyIsSet = $checkUser->checkIfMoneyIsSet();
$checkifUserHasTeam = $checkUser->checkIfUserHasTeam($idteams);

$myTeamController = new MyTeamController();

if(isset($_POST['idfire'])) {

    $idfire = $_POST['idfire'];
    $firePlayer = $myTeamController->firePlayer($idfire);
    header('Location: redirect.php');
}

if(isset($_GET['stats']))
{
    $getAllPlayersStats = $myTeamController->getAllPlayersStats($idteams);
    echo '<div class="players"> <table class="container">
    <tr><th><img src="/CSS/pictures/id.png" alt="Zawodnik" title="Piłkarz"  /></th>
    <th><img src="/CSS/pictures/muscle.png" alt="Skills" title="Średnia Umiejętności" /></th>
    <th><img src="/CSS/pictures/position.png" alt="pozycja" title="Pozycja" /></th>
    <th><img src="/CSS/pictures/money.png" alt="tygodniówka" title="Wysokość Tygodniówki" /></th>
    <th><img src="/CSS/pictures/star.png" alt="ocena meczowa" title="Średnia ocen meczowych" /></th>
    <th><img src="/CSS/pictures/soccer.png" alt="zdobyte bramki" title="Bramki" />
    </th><th><img src="/CSS/pictures/graph.png" alt="Średnia bramek na mecz" title="Średnia bramek na mecz"  /></th>
    <th><img src="/CSS/pictures/asist.png" alt="asysty" title="Asysty"></th>
    <th><img src="/CSS/pictures/graph.png" alt="Średnia Asyst na mecz" title="Średnia asyst na mecz"  /></th><th>
    <img src="/CSS/pictures/yellow-card.png" alt="żółta" title="Żółte Kartki" /></th>
    <th><img src="/CSS/pictures/red-card.png" alt="czerwona" title="Czerwone Kartki" /></th></tr>';
        foreach($getAllPlayersStats as $player) {
        echo  "<tr><td>(".$player["idplayers"].
        ")" . $player["playername"].
        " </td><td> " . $player["skill"].
        " </td><td>" . $player["pozycja"].
         " </td><td> " . $player["pensja"].
          "</td><td>" . $player["ocena"].
        "</td><td>" . $player["gole"].
        "</td><td>" . $player["AVG(gole)"].
        "</td><td>" . $player["asysty"].
        "</td><td>" . $player["AVG(asysty)"].
        "</td><td>" . $player["z"].
         "</td><td>" . $player["c"].
        "</td></tr>";
    } echo '</table></div>';
    exit();
}

$getAllPlayersFromUserTeam = $myTeamController->getAllPlayersFromUserTeam($idteams);

echo '<div class="menu">
<a href="../kontogracza.php"> <img src="/CSS/pictures/exit.png" alt="Powrót" title="Wyjście"></a> 
</div>';

if(empty($getAllPlayersFromUserTeam)){

echo 'Twój klub jest pusty.';

} else { 
    echo '<form method="GET"><input type="submit" name="stats" value="Statystyki Kariery Piłkarskiej"></form>';
    echo '<div class="players"> <table class="container">
    <tr><th><img src="/CSS/pictures/id.png" alt="Zawodnik" title="Piłkarz"  /></th>
    <th><img src="/CSS/pictures/muscle.png" alt="Skills" title="Średnia Umiejętności" /></th>
    <th><img src="/CSS/pictures/position.png" alt="pozycja" title="Pozycja" /></th>
    <th><img src="/CSS/pictures/money.png" alt="tygodniówka" title="Wysokość Tygodniówki" /></th>
    <th><img src="/CSS/pictures/star.png" alt="ocena meczowa" title="Średnia ocen meczowych" /></th>
    <th><img src="/CSS/pictures/soccer.png" alt="zdobyte bramki" title="Bramki" />
    </th><th><img src="/CSS/pictures/graph.png" alt="Średnia bramek na mecz" title="Średnia bramek na mecz"  /></th>
    <th><img src="/CSS/pictures/asist.png" alt="asysty" title="Asysty"></th>
    <th><img src="/CSS/pictures/graph.png" alt="Średnia Asyst na mecz" title="Średnia asyst na mecz"  /></th><th>
    <img src="/CSS/pictures/yellow-card.png" alt="żółta" title="Żółte Kartki" /></th>
    <th><img src="/CSS/pictures/red-card.png" alt="czerwona" title="Czerwone Kartki" /></th></tr>';
        foreach($getAllPlayersFromUserTeam as $player) {
        echo  "<tr><td>(".$player["idplayers"].
        ")" . $player["playername"].
        " </td><td> " . $player["skill"].
        " </td><td>" . $player["pozycja"].
         " </td><td> " . $player["pensja"].
          "</td><td>" . $player["ocena"].
        "</td><td>" . $player["gole"].
        "</td><td>" . $player["AVG(gole)"].
        "</td><td>" . $player["asysty"].
        "</td><td>" . $player["AVG(asysty)"].
        "</td><td>" . $player["z"].
         "</td><td>" . $player["c"].
        "</td></tr>";
    } echo '</table></div>';
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8"/>
  <title>Moja Drużyna</title>
  <link rel="stylesheet" href="/CSS/myTeam.css" type="text/css">
</head>

<body>
<div class="options">


<div class="form">
            <h5> Wystaw piłkarza na <a href="http://menagoleague.pl/transferlist.php?order=idtransferlist&szukaj=Poka%C5%BC+List%C4%99">listę transferową</a> </h5>
            <form action="../transferlist.php" method="post">
                <input type="text" name="playername" value="" placeholder="Piłkarz" required>
                <input type="number" name="idplayers" value="" placeholder="ID Piłkarza" required>
                <input type="text" name="position" value="" placeholder="Pozycja" required>
                <input type="number" name="skill" value="" placeholder=" Overall" required> 
                <input type="number" name="price" value="" placeholder="Cena" required>
                <input type="text" name="contact" value="" placeholder="Dane kontaktowe" required> 
                <input type="submit" name="submit" value="Dodaj" onclick="return confirm('Czy na pewno?');"> </form>

                <h5> Zaproponuj podwyżkę</h5>
  <form action="myTeamView.php" method="POST">
      <input type="number" name="id" placeholder="ID Piłkarza"> <br>
      <input type="number" placeholder="Nowa Tygodniówka">  <br>
      <input type="submit" name="raise" value="Zaproponuj Podwyżkę" onclick="return confirm('Czy na pewno?');" disabled>
  </form>
  <h5> Zwolnij Piłkarza </h5>
  <form action="myTeamView.php" method="POST">
      <input type="number" name="idfire" placeholder="ID Piłkarza">
      <input type="submit" name="release" value="Zwolnij zawodnika" onclick="return confirm('Jesteś pewien, że chcesz zwolnić piłkarza?');"disabled>
  </form>
  </div>
  </div>
  <body>
    </html>

