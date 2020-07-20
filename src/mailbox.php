<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header('Content-Type: text/html; charset=UTF-8');
session_start();

require_once"connect.php";
require_once"functions.php";

checkLogged();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title>Poczta</title>
</head>

<body>
 <h4>Wysłane wiadomości</h4>
 <?php include_once"sentMessages.php"; ?>
 <h4>Odebrane wiadomości</h4>
<?php include_once"receivedMessages.php"; ?>

</body>
    </html>
