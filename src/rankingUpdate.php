<?php
include"functions.php";
include"rankingController.php";

$rankingController = new rankingController();
$selectTeamsByPoints = $rankingController->getTeamsByPoints();
$selectTeamsByID = $rankingController->getTeamsByID();
$teamSpot = array_column($selectTeamsByPoints, 'spot');
$teamID = array_column($selectTeamsByID, 'idteams');

$rankingController->updateRanking($teamID);
print_r($teamID);


