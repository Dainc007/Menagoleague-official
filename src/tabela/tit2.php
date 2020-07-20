<?php
  header("Cache-Control: no-cache, must-revalidate"); 
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../CSS/tit.css" type="text/css">
  <title></title>
</head>

<body>
  <ul>
  <li><a href="../kontogracza.php">Menu Główne</a>
               <li><a href="">Premier League</a>
                    <ul>
                         <li><a href="/tabela/ang.php">Tabela</a></li>
                         <li><a href="http://menagoleague.pl/fixturesView.php?idLeague=1">Terminarz</a></li>
                         <li><a href="http://menagoleague.pl/tabela/playerstats.php?liga=1&order=gole&szukaj=Poka%C5%BC+List%C4%99">Statystyki Piłkarzy</a></li>
                         <li><a href="http://menagoleague.pl/TOTW/teamOfTheWeekView.php?lig=1&kol=1">11'stka kolejki</a></li>
                 </ul>
     <li><a href="">LaLiga</a>
          <ul>
               <li><a href="/tabela/hiszp.php">Tabela</a></li>
               <li><a href="http://menagoleague.pl/fixturesView.php?idLeague=2">Terminarz</a></li>
               <li><a href="http://menagoleague.pl/tabela/playerstats.php?liga=2&order=gole&szukaj=Poka%C5%BC+List%C4%99">Statystyki Piłkarzy</a></li>
               <li><a href="http://menagoleague.pl/TOTW/teamOfTheWeekView.php?lig=2&kol=1">11'stka kolejki</a></li>
</ul>
  
               <li><a href="#">Seria A</a>
                    <ul>
                         <li><a href="/tabela/wlochy.php">Tabela</a></li>
                         <li><a href="http://menagoleague.pl/fixturesView.php?idLeague=3">Terminarz</a></li>
                         <li><a href="http://menagoleague.pl/tabela/playerstats.php?liga=3&order=gole&szukaj=Poka%C5%BC+List%C4%99">Statystyki Piłkarzy</a></li>
                         <li><a href="http://menagoleague.pl/TOTW/teamOfTheWeekView.php?lig=3&kol=1">11'stka kolejki</a></li>
                 </ul>
     <li><a href="#">Ekstraklasa</a>
          <ul>
               <li><a href="/tabela/eks.php">Tabela</a></li>
            <li><a href="http://menagoleague.pl/fixturesView.php?idLeague=4">Terminarz</a></li> 
            <li><a href="http://menagoleague.pl/tabela/playerstats.php?liga=4&order=gole&szukaj=Poka%C5%BC+List%C4%99">Statystyki Piłkarzy</a></li>
            <li><a href="http://menagoleague.pl/TOTW/teamOfTheWeekView.php?lig=4&kol=1">11'stka kolejki</a></li>
            </ul>
     <li><a href="">1. Liga</a>
          <ul>
               <li><a href="/tabela/eks2.php">Tabela</a></li>
            <li><a href="http://menagoleague.pl/fixturesView.php?idLeague=5">Terminarz</a></li>
            <li><a href="http://menagoleague.pl/tabela/playerstats.php?liga=5&order=gole&szukaj=Poka%C5%BC+List%C4%99">Statystyki Piłkarzy</a></li>
            <li><a href="http://menagoleague.pl/TOTW/teamOfTheWeekView.php?lig=5&kol=1">11'stka kolejki</a></li>
            </ul>
<li><a href="#">Champions League</a>
          <ul>
               <li><a href="/tabela/lm.php">Tabela Fazy Grupowej</a></li>
               <li><a href="../fixturesView.php">Terminarz</a></li></ul>
<li><a href="#">Turnieje Przedsezonowe</a>
          <ul>
               <li><a href="../preSeasonTournamentsView.php">Dołącz do turnieju</a></li>
               <li><a href="../createPreseasonTournament.php">Stwórz Turniej</a></li></ul>
               
  </body>
    </html>