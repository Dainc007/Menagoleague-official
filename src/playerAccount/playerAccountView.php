<?php
require_once"playerAccountController.php";
require_once"checkUser.php";

$checkUser = new CheckUser();
$setHedders = $checkUser->setHedders();
$checkIfUserIsLogged = $checkUser->checkIfUserIsLogged();
$checkifMoneyIsSet = $checkUser->checkIfMoneyIsSet();
$checkifUserHasTeam = $checkUser->checkIfUserHasTeam($idteams);

$playerAccountController = new PlayerAccountController();

?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="/CSS/playeraccount.css" type="text/css">
		<title>Centrala</title>
	</head>
	<body>
</body>
</html>