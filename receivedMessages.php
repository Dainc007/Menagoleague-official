<?php
$idteams = $_SESSION['idteams'];
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");
// Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

$sql = "SELECT * from mailbox where ToID=$idteams";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row

while($row = $result->fetch_assoc()) {

    echo  " Wiadomość od " . $row["fromID"].
    " Treść wiadomości<br><br>: " . $row["message"].
    "<br>";
}
} else {
echo "Nie masz żadnych wiadomości";
}
