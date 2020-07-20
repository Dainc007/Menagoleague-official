<?php      
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once"connect.php";

  session_start();

$idteams = $_SESSION['idteams'];
$idfire = $_POST['idfire'];

if (!isset($_SESSION['zalogowany']))
  {
  header('Location: index.php');
  exit();
  }

$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
                          }

$sql = "UPDATE players SET idteams=0 WHERE idplayers=$idfire AND idteams=$idteams";
$result = $conn->query($sql);
header('Location: ok.php');
$conn->close();

