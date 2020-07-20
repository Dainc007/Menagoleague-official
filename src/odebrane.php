<?php
header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  header('Content-Type: text/html; charset=UTF-8');
require_once"connect.php";

session_start();
if (!isset($_SESSION['zalogowany']))
{
header('Location: index.php');
exit();
}

    $idteams = $_SESSION['idteams'];
    $idteams2 = $_POST['idteams'];
    // Create connection
    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($conn,"SET CHARSET utf8");
    mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");
    // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

    $sql = "SELECT * from mailbox where idodbiorcy=$idteams";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

        echo  " Wiadomość od " . $row["idnadawcy"].
        " Treść wiadomości<br><br>: " . $row["message"].
        "<br>";
    }
} else {
    echo "W Twojej drużynie nie ma jeszcze piłkarzy";
}
